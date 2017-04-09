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
      <a class="author" href="<?php echo base_url('profile'); ?>/<?php echo $profile->username; ?>"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
        <div class="metadata">
          <div class="rating">
            <i class="green reply icon"></i>
            <?php echo $cc; ?> Comment
          </div>
          <div class="rating">
            <i class="blue heart icon"></i><i al-info="<?php echo $answer->ckey; ?>"><?php echo $cl; ?></i> Like
          </div>
          <div class="rating">
            <i class="red level down icon"></i><i ad-info="<?php echo $answer->ckey; ?>"><?php echo $cd; ?></i> Downvote
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
        <a title=""><i class="external link icon"></i>Read Answer</a>
      </div>
    </div>
  </div>
<script type="text/javascript">
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
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
  <?php } ?>