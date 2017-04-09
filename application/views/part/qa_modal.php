<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if($type == 'q'){ ?>
<?php 
  $qk = $question->ckey;
  $countdv  = $this->db->query("SELECT * FROM questions_votes WHERE qkey='$question->ckey' AND status='0';")->num_rows();
  $countfl  = $this->db->query("SELECT * FROM log_follow WHERE log_info='3' AND identity='$question->ckey'")->num_rows();
  $qv = $this->db->query("SELECT * FROM questions_votes WHERE ukey='$me' AND qkey='$qk' AND status='0' LIMIT 1;")->row();
  $qf = $this->db->query("SELECT * FROM log_follow WHERE ukey='$me' AND identity='$qk' AND log_info='3' LIMIT 1;")->row();
  $c  = $this->db->query("SELECT * FROM questions_comments WHERE qkey='".$this->db->escape_str($question->ckey)."';")->result();
  $answers  = $this->db->query("SELECT * FROM answers WHERE qkey='".$this->db->escape_str($question->ckey)."';")->result();
?>
<div class="header">
  <?php echo $question->topic; ?> - 
  <i style="font-size: 13px !important;" class="red level down icon"></i><i qdv-m-info="<?php echo $question->ckey; ?>"><?php echo $countdv; ?></i> <i qdv-m-info>Downvote</i> 
  <i style="font-size: 13px !important;" class="blue alarm icon"></i><i qfl-m-info="<?php echo $question->ckey; ?>"><?php echo $countfl; ?></i> <i qdv-m-info>Followers</i> 
</div>
<div class="image content">
  <div class="ui medium image">
    <img src="<?php echo $sitesrc; ?>anez.jpg">
  </div>
  <div class="description" style="width:100%;">
        <div class="ui header"><?php echo $question->title; ?></div>
        <p><?php echo $question->content; ?></p>
<div class="ui divider"></div>
<div class="ui mini comment-quest list" style="max-height:140px;overflow-y:auto;min-width:100%;">
<?php foreach($c as $comment){ ?>
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$comment->username' LIMIT 1;")->row();
 ?>
  <div class="item"> <i style="float:right;font-style:normal;" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($comment->date)); ?>"></i>
    <img class="ui avatar image" src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
    <div class="content">
      <a class="header" href="<?php echo base_url('profile'); ?>/<?php echo $comment->username; ?>"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
      <?php echo $comment->content; ?>
    </div>
  </div>
<?php } ?>
</div>


<div class="ui comments">
  <div class="comment">
    <div class="content">
      <div class="actions">
        <a class="reply"><i class="write icon"></i> Write Answer</a>
        <a class="reply"><i class="reply icon"></i> Write Comment</a>

                <?php if(empty($qv)){ ?>
                <a class="hide" qdv-m-btn="<?php echo $question->ckey; ?>"><i class="level down icon"></i><i qdv-m-text="<?php echo $question->ckey; ?>">Downvote</i></a>
                <?php } else { ?>
                <a class="hide q-downvoted" qdv-m-btn="<?php echo $question->ckey; ?>"><i class="level down icon"></i><i qdv-m-text="<?php echo $question->ckey; ?>">Downvoted</i></a>
                <?php } ?>

                <?php if(empty($qf)){ ?>
                <a class="hide" qfl-m-btn="<?php echo $question->ckey; ?>"><i class="alarm icon"></i><i qfl-m-text="<?php echo $question->ckey; ?>">Follow</i></a>
                <?php } else { ?>
                <a class="hide q-followed" qfl-m-btn="<?php echo $question->ckey; ?>"><i class="alarm icon"></i><i qfl-m-text="<?php echo $question->ckey; ?>">Followed</i></a>
                <?php } ?>

      </div>
    </div>
  </div>
</div>

<h3 class="ui dividing header">Answers</h3>
<div class="ui answer-quest comments" style="max-width:90%;">

<?php foreach($answers as $answer){ ?>  
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$answer->username' LIMIT 1;")->row();
    $cl     = $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='2'")->num_rows();
    $cd     = $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='0'")->num_rows();
    $cc     = $this->db->query("SELECT * FROM answers_comments WHERE akey='$answer->ckey'")->num_rows();
 ?>
  <div class="comment">
    <a class="avatar">
      <img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
    </a>
    <div class="content">
      <a class="author"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
        <div class="metadata">
          <div class="rating">
            <i class="green reply icon"></i>
            <?php echo $cc; ?> Comment
          </div>
          <div class="rating">
            <i class="blue heart icon"></i><i al-m-info="<?php echo $answer->ckey; ?>"><?php echo $cl; ?></i> Like
          </div>
          <div class="rating">
            <i class="red level down icon"></i><i ad-m-info="<?php echo $answer->ckey; ?>"><?php echo $cd; ?></i> Downvote
          </div>
        </div>
      <div class="metadata" style="float:right;">
        <div class="date" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($answer->date)); ?>"></div>
      </div>
      <div class="text" style="text-align:justify;">
        <?php echo $answer->content; ?>
      </div>
      <div class="actions">
              <?php 
                $akey   = $answer->ckey;
                $dv   = $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='0' LIMIT 1;")->row();
                $li   = $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='2' LIMIT 1;")->row();
               ?>
              <?php if(empty($li)){ ?>
            <a class="hide" al-m-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-m-text="<?php echo $answer->ckey; ?>">Like</i></a>
              <?php } else { ?>
            <a class="hide a-liked" al-m-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-m-text="<?php echo $answer->ckey; ?>">Liked</i></a>
              <?php } ?>

              <?php if(empty($dv)){ ?>
                <a class="hide" ad-m-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-m-text="<?php echo $answer->ckey; ?>">Downvote</i></a>
            <?php } else { ?>
                <a class="hide a-downvoted" ad-m-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-m-text="<?php echo $answer->ckey; ?>">Downvoted</i></a>
            <?php } ?>
        <a href=""><i class="external link icon"></i>Read Answer</a>
      </div>
    </div>
  </div>
  <?php } ?>

</div>
  </div>
</div>
<div class="actions">
  <div class="ui cancel blue button">
    Tutup
    <i class="right chevron icon"></i>
  </div>
</div>
<script type="text/javascript">
$("[qdv-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("qdv-m-btn");
      background(10,'dv',data);
  });
});
$("[qfl-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("qfl-m-btn");
      background(10,'fl',data);
  });
});
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
});
$("[ad-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("ad-btn");
      background(10,'ad',data);
  });
});
$("[al-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("al-btn");
      background(10,'al',data);
  });
});
$("[ad-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("ad-m-btn");
      background(10,'ad-m',data);
  });
});
$("[al-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("al-m-btn");
      background(10,'al-m',data);
  });
});
</script>
<?php } elseif($type == 'a'){ ?>
<?php 
  $question = $this->db->query("SELECT * FROM questions WHERE ckey='$answer->qkey' LIMIT 1;")->row();
  $profile = $this->db->query("SELECT * FROM users WHERE username='$answer->username' LIMIT 1;")->row();
 ?>
 <?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$answer->username' LIMIT 1;")->row();
    $cl     = $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='2'")->num_rows();
    $cd     = $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='0'")->num_rows();
    $cc     = $this->db->query("SELECT * FROM answers_comments WHERE akey='$answer->ckey'")->num_rows();
 ?>
    <div class="header">
      <?php echo $question->title; ?>
    </div>
    <div class="image content">
      <div class="ui medium image">
        <img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
      </div>
      <div class="description" style="width:100%;">
        <div class="ui header"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?> 
          <div class="rating" style="float:right;font-size:12px;">
            <i class="red level down icon"></i><i ad-m-info="<?php echo $answer->ckey; ?>"><?php echo $cd; ?></i> Downvote
          </div>
          <div class="rating" style="float:right;font-size:12px;">
            <i class="blue heart icon"></i><i al-m-info="<?php echo $answer->ckey; ?>"><?php echo $cl; ?></i> Like
          </div>

        </div>
        <p><?php echo $answer->content; ?></p>
        <div class="ui divider"></div>
<div class="ui comments" style="margin-top:-5px;">
  <div class="comment">
    <div class="content">
      <div class="actions">
        <a class="reply"><i class="write icon"></i> Write Comment</a>
              <?php 
                $akey   = $answer->ckey;
                $dv   = $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='0' LIMIT 1;")->row();
                $li   = $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='2' LIMIT 1;")->row();
               ?>
              <?php if(empty($li)){ ?>
            <a class="hide" al-m-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-m-text="<?php echo $answer->ckey; ?>">Like</i></a>
              <?php } else { ?>
            <a class="hide a-liked" al-m-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-m-text="<?php echo $answer->ckey; ?>">Liked</i></a>
              <?php } ?>

              <?php if(empty($dv)){ ?>
                <a class="hide" ad-m-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-m-text="<?php echo $answer->ckey; ?>">Downvote</i></a>
            <?php } else { ?>
                <a class="hide a-downvoted" ad-m-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-m-text="<?php echo $answer->ckey; ?>">Downvoted</i></a>
            <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="ui form" style="margin-top:-15px;">
    <div class="ui right icon tiny fluid input">
      <input type="text" class="foristyping" placeholder="Tekan Enter Untuk Mengirim Komentar." comment-id="<?php echo $answer->ckey; ?>" id="answer-new-comment">
      <i class="send icon"></i>
    </div>
</div>

<?php 
$comments = $this->db->query("SELECT * FROM answers_comments WHERE akey='$answer->ckey' ORDER BY id DESC;")->result();
 ?>
<div class="ui threaded answer-comment comments">
<?php foreach($comments as $comment){ ?>
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$comment->username' LIMIT 1;")->row();
?>
  <div class="comment">
    <a class="avatar">
      <img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
    </a>
    <div class="content">
      <a class="author"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
      <div class="metadata">
        <span class="date" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($comment->date)); ?>"></span>
      </div>
      <div class="text">
        <p><?php echo $comment->content; ?></p>
      </div>
      <div class="actions">
        <a class="reply" reply-id="<?php echo $comment->ckey; ?>" status="N">Reply</a>
        <?php if($comment->username == $this->session->userdata('username')){ ?>
        <a class="reply" delete-id="<?php echo $comment->ckey; ?>">Delete</a>
        <?php } ?>
      </div>
    </div>
    <div class="comments" reply-show="<?php echo $comment->ckey; ?>">

    </div>
  </div>
<?php } ?>
  <script type="text/javascript">
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
});
$("[reply-id]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("reply-id");
      background(16,1,data);
  });
});
var pid = $("#answer-new-comment").attr("comment-id");
$('.foristyping').keyup(function () {
  background(17,0,pid);
});
var whoact = setInterval(function(){background(18,0,pid)},1000);
  </script>
</div>

    </div>
    </div>
    <div class="actions">
    <b style="font-weight:normal;" class="istyping"></b>
      <div class="ui primary approve button">
        Kembali
        <i class="right chevron icon"></i>
      </div>
    </div>
<script type="text/javascript">
$("[ad-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("ad-m-btn");
      background(10,'ad-m',data);
  });
});
$("[al-m-btn]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("al-m-btn");
      background(10,'al-m',data);
  });
});
$("[comment-id]").each(function (){
  $(this).keypress(function (e) {
      if(e.which == 13)
      {
        var data = $(this).attr("comment-id")
        ,   cont = $("#answer-new-comment").val();
        background(15,0,data,cont);
      }
  });
});
background(16,0,'<?php echo $answer->ckey; ?>');
</script>
<?php } ?>