<?php 

$this->session->set_userdata('ltq',$this->uri->segment(2));
if($fw == 'qs'){ ?>
	<?php 
		$question 	= $this->db->query("SELECT * FROM questions WHERE tkey='$timeline->ckey' LIMIT 1;")->row();
		if($question){
	 ?>
	 <?php 
		$countdv 	= $this->db->query("SELECT * FROM questions_votes WHERE qkey='$question->ckey' AND status='0';")->num_rows();
		$countfl 	= $this->db->query("SELECT * FROM log_follow WHERE log_info='3' AND identity='$question->ckey'")->num_rows();
		$countaw 	= $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey';")->num_rows();
		$whogiveaw  = $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey' ORDER BY id DESC LIMIT 12;")->result();
  $c  = $this->db->query("SELECT * FROM questions_comments WHERE qkey='".$this->db->escape_str($question->ckey)."' ORDER BY id DESC;")->result();
  $answers  = $this->db->query("SELECT * FROM answers WHERE qkey='".$this->db->escape_str($question->ckey)."';")->result();
	$me 	= 	$this->session->userdata('key');
	  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $question->title; ?> - Question | Starda.id</title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>
	<div class="ui container" style="margin-top:90px;">
		<div class="ui grid">
			<div class="ten wide column">
	<div class="ui detail comments" style="max-width:100%;">
			<div class="ui raised segment">
			  	<div class="comment">

				    <div class="content">
				      <a class="author"><?php echo $question->topic; ?></a>
				      <div class="metadata">
				        <div class="rating">
				          <i class="green write icon"></i><?php echo $countaw; ?> Jawaban
				        </div>
				        <div class="rating">
				          <i class="red level down icon"></i><i qdv-info="<?php echo $question->ckey; ?>"><?php echo $countdv; ?></i> Downvote
				        </div>
				        <div class="rating">
				          <i class="blue alarm icon"></i><i qfl-info="<?php echo $question->ckey; ?>"><?php echo $countfl; ?></i> Follower
				        </div>
				      </div>
				      <div class="metadata" style="float:right;">
				        <div class="date"><?php echo lang('asked_ago'); ?>  <i style="font-style:normal;" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($question->date)); ?>"></i></div>
				      </div>
				      <div class="text" style="font-size:23px;">
				        	<?php echo $question->title; ?>
				      </div>
				      <?php if($question->content){ ?>
				      <div class="text" style="font-size:13px;opacity:0.8;text-align:justify;color:#595959;">
				      	<?php if(strlen($question->content) > 549){ ?>
				      		<?php echo substr(strip_tags($question->content), 0, 550).' ..(Read More)'; ?>
				      	<?php } else { ?>
				      		<?php echo $question->content; ?>
				      	<?php } ?>
				      </div>
				      <?php } ?>
				      <div class="ui divider"></div>
				<?php foreach($whogiveaw as $as){ ?>
					<?php 
						$profile = $this->db->query("SELECT * FROM users WHERE username='$as->username' LIMIT 1;")->row();
					 ?>
				    <img class="last answer" title="<?php echo $as->content; ?>" src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
				<?php } ?>
				     
				     <div class="actions">
				     	
				        <a class="reply" onclick="$('.new-a-detail').modal('show');"><i class="write icon"></i>Write Answer</a>
				        <?php 
				        	$qk = $question->ckey;
				        	$qv = $this->db->query("SELECT * FROM questions_votes WHERE ukey='$me' AND qkey='$qk' AND status='0' LIMIT 1;")->row();
				        	$qf = $this->db->query("SELECT * FROM log_follow WHERE ukey='$me' AND identity='$qk' AND log_info='3' LIMIT 1;")->row();
				         ?>

				        <?php if(empty($qv)){ ?>
				        <a class="hide" qdv-btn="<?php echo $question->ckey; ?>"><i class="level down icon"></i><i qdv-text="<?php echo $question->ckey; ?>">Downvote</i></a>
				        <?php } else { ?>
				        <a class="hide q-downvoted" qdv-btn="<?php echo $question->ckey; ?>"><i class="level down icon"></i><i qdv-text="<?php echo $question->ckey; ?>">Downvoted</i></a>
				        <?php } ?>

				        <?php if(empty($qf)){ ?>
				        <a class="hide" qfl-btn="<?php echo $question->ckey; ?>"><i class="alarm icon"></i><i qfl-text="<?php echo $question->ckey; ?>">Follow</i></a>
				        <?php } else { ?>
				        <a class="hide q-followed" qfl-btn="<?php echo $question->ckey; ?>"><i class="alarm icon"></i><i qfl-text="<?php echo $question->ckey; ?>">Followed</i></a>
				        <?php } ?>

				        <a class="save" onclick="$('.new-c-detail').modal('show');"><i class="reply icon"></i>Comment</a>
				        <?php if($question->username == $this->session->userdata('username')){ ?>
				        <a><i class="trash icon"></i>Delete
				        </a>        	
				        <?php } ?>
			      	</div>
				    </div>
			  	</div>
<div class="ui divider"></div>
<div class="ui mini comment-quest list" style="max-height:220px;overflow-y:auto;min-width:100%;">
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
<h3 class="ui dividing header">Answers</h3>
<div class="ui answer-quest comments" style="max-width:100%;">

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
        <a href="<?php echo base_url('answer'); ?>/<?php echo $answer->tkey; ?>" target="_blank"><i class="external link icon"></i>Read Answer</a>
      </div>
    </div>
  </div>
  <?php } ?>

</div>
			</div>
		<?php } ?>
	</div>		
			</div>
			<div class="six wide column">
<h3 class="ui dividing header">
	Editor <a style="float:right;" onclick="$('.edit-question').modal('show');" class="ui mini basic label">Bantu Sempurnakan</a>
</h3>
<div class="ui relaxed divided list">
<?php 
	$editors = $this->db->query("SELECT * FROM questions_edits WHERE qkey='$question->ckey' AND isapprove='Y' LIMIT 10;")->result();
	$te = $this->db->query("SELECT * FROM questions_edits WHERE qkey='$question->ckey';")->num_rows();
 ?>
<?php if(empty($editors)){ ?>
    <center style="margin-top:50px;margin-bottom:50px;">
    	<b style="color:#7B7B7B;text-transform:capitalize;">Belum Ada Editor</b>
    </center>
<?php } ?>
<?php foreach($editors as $editor){ ?>
  	<div class="item">
	    <img class="ui avatar image" src="<?php echo base_url('uploads/images'); ?>/<?php echo $this->session->userdata('image'); ?>">
	    <div class="content">
	      <a class="header" href="<?php echo base_url('profile'); ?>/<?php echo $editor->username; ?>"><?php echo $editor->username; ?> </a>
	      <div class="description" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($editor->date)); ?>"></div>
	    </div>
  	</div>
<?php } ?>

</div>
<h3 class="ui dividing header">
	Statistik Pertanyaan
</h3>
<?php 
	$qf = $this->db->query("SELECT * FROM log_follow WHERE log_info='3' AND identity='$question->tkey';")->num_rows();
	$tc = $this->db->query("SELECT * FROM questions_comments WHERE qkey='$question->ckey';")->num_rows();
	$ta = $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey';")->num_rows();
	$tv = $this->db->query("SELECT * FROM timeline WHERE ckey='$question->tkey';")->num_rows();
	$la = $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey' ORDER BY id DESC LIMIT 1;")->row();

?>
<div class="ui list">
  <a class="item">
    <i class="alarm icon"></i>
    <div class="content">
      <div class="description"><?php echo $qf; ?> Follower</div>
    </div>
  </a>
  <a class="item">
    <i class="users icon"></i>
    <div class="content">
      <div class="description"><?php echo $te; ?> Editor</div>
    </div>
  </a>
  <a class="item">
    <i class="comment icon"></i>
    <div class="content">
      <div class="description"><?php echo $tc; ?> Comment</div>
    </div>
  </a>
  <a class="item">
    <i class="write icon"></i>
    <div class="content">
      <div class="description"><?php echo $ta; ?> Answer</div>
    </div>
  </a>
  <a class="item">
    <i class="eye open icon"></i>
    <div class="content">
      <div class="description"><?php echo $tv; ?> Viewer</div>
    </div>
  </a>
</div>

			</div>
		</div>
	</div>
	<div class="ui coupled long test q-mod modal"></div>

<div class="ui small edit-question second coupled long modal">
    <div class="header">
      Sempurnakan Pertanyaan
    </div>
    <div class="content">
      	<div class="description">
	        <div class="ui form">
				<div class="fields">
					<div class="nine wide field">
						<div class=" required field">
							<label>Judul Pertanyaan</label>
							<input q-edit="title" type="text" value="<?php echo $question->title; ?>">
						</div>
					</div>
					<div class="seven wide required field">
						<div class="required field">
							<label>Topik Pertanyaan</label>
							<div class="ui topic search">
								<div class="ui icon input">
									<input value="<?php echo $question->topic; ?>" autocomplete="on" class="prompt" placeholder="Pilih Topik..." q-edit="topic" type="text">
									<i class="newspaper icon"></i>
								</div>
								<div class="results"></div>
							</div>
						</div>
					</div>
				</div>	
	        	<div class="field">
	        		<label>Isi Pertanyaan</label>
	        		<textarea q-edit="content"><?php echo $question->content; ?></textarea>
	        	</div>
	        </div>
      	</div>
    </div>
    <input style="display:none;" q-edit="fu" value="<?php echo $question->username; ?>">
    <input style="display:none;" q-edit="fk" value="<?php echo $question->ukey; ?>">
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
      	<div onclick="background(21,'<?php echo $question->ckey; ?>');" class="ui new-a-btn green approve button">
	        <i class="save icon"></i>
	        Kirim
      	</div>
    </div>
</div>

<div class="ui small new-a-detail second coupled long modal">
    <div class="header">
      Tulis Jawaban
    </div>
    <div class="content">
      	<div class="description">
	        <div class="ui form">
	        	<div class="field">
	        		<textarea new-a-data="<?php echo $question->ckey; ?>"></textarea>
	        	</div>
	        </div>
      	</div>
    </div>
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
      	<div new-a-btn="<?php echo $question->ckey; ?>" class="ui new-a-btn green button">
	        <i class="save icon"></i>
	        Kirim
      	</div>
    </div>
</div>

<div class="ui small new-c-detail second coupled long test scrolling modal" id="newc">
    <div class="header">
      Tulis Komentar
    </div>
    <div class="content">
      <div class="description">
        <div class="ui form">
        	<div class="field">
        		<textarea new-c-data="<?php echo $question->ckey; ?>"></textarea>
        	</div>
        </div>
      </div>
    </div>
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
	    <div new-c-btn="<?php echo $question->ckey; ?>" class="ui new-c-btn green button">
	        <i class="save icon"></i>
	        Kirim
	    </div>
    </div>
</div>
<div class="ui small basic to-del test modal">
    <div class="ui icon del-info header">
      	<i class="archive icon"></i>
      	Archive Old Messages
    </div>
    <div class="content" style="text-align:center;">
      <p>Apakah Anda Yakin Ingin Menghapus Ini?</p>
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        Batal
      </div>
      <div class="ui green ok inverted basic button">
        <i class="checkmark icon"></i>
        Hapus
      </div>
    </div>
</div>
	<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
	<script src="<?php echo $sitesrc;?>bundle.js"></script>
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
$('.coupled.modal')
  .modal({
    allowMultiple: false
  });
  $('[new-c-btn]').click(function(){
	var pid 	= $(this).attr("new-c-btn")
	, 	cont 	= $('[new-c-data]').val();
	background(12,'new-c-btn',pid,cont);
	$('.new-c-detail').modal('hide');
});
$('[new-a-btn]').click(function(){
	var pid 	= $(this).attr("new-a-btn")
	, 	cont 	= $('[new-a-data]').val();
	background(12,'new-a-btn',pid,cont);
	$('.new-a-detail').modal('hide');
});
</script>
<script type="text/javascript">
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
});
$("[qdv-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("qdv-btn");
	    background(10,'dv',data);
	});
});
$("[qfl-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("qfl-btn");
	    background(10,'fl',data);
	});
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

$("[q-more-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("q-more-btn");
	    if(data.search('new-a') == 0){
	    	var pid = data.replace(/new-a/i,'');
	    	background(11,'q',pid,'new-a');
	    	$(".new-a-btn").attr("new-a-btn", pid);
	    } 
	    	else if(data.search('new-c') == 0)
	    {
	    	var pid = data.replace(/new-c/i,'');
	    	background(11,'q',pid,'new-c');
	    	$(".new-c-btn").attr("new-c-btn", pid);
	    }
	    	else
	    {
	    	background(11,'q',data,'b');
	    }
	});
});

$("[a-more-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("a-more-btn");
	    if(data.search('new-ca') == 0){
	    	var pid = data.replace(/new-ca/i,'');
	    	background(11,'a',pid,'new-ca');
	    	$(".new-ca-btn").attr("new-ca-btn", pid);
	    }
	    	else
	    {
	    	background(11,'a',data,'ba');
	    }
	});
});

$("[del-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("del-btn")
		, 	type = $('[del-btn="'+data+'"]').attr("del-type");
		background(14,type,data);
	});
});
</script>
</body>
</html>
<?php } elseif($fw == 'aw'){ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>
	<div class="ui container" style="margin-top:90px;">
		<div class="ui comments">
	<?php 
		$answer 	= $this->db->query("SELECT * FROM answers WHERE tkey='$timeline->ckey' LIMIT 1;")->row();
		$question 	= $this->db->query("SELECT * FROM questions WHERE ckey='$answer->qkey' LIMIT 1;")->row();
		$profile 	= $this->db->query("SELECT * FROM users WHERE username='$answer->username' LIMIT 1;")->row();
		$cl 		= $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='2'")->num_rows();
		$cd 		= $this->db->query("SELECT * FROM answers_votes WHERE akey='$answer->ckey' AND status='0'")->num_rows();
		$cc 		= $this->db->query("SELECT * FROM answers_comments WHERE akey='$answer->ckey'")->num_rows();
	?>
			<div class="ui piled td<?php echo $answer->ckey; ?> segment">
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
				          <i class="blue heart icon"></i><i al-info="<?php echo $answer->ckey; ?>"><?php echo $cl; ?></i> Like
				        </div>
				        <div class="rating">
				          <i class="red level down icon"></i><i ad-info="<?php echo $answer->ckey; ?>"><?php echo $cd; ?></i> Downvote
				        </div>
				      </div>
				      <div class="metadata" style="float:right;">
				        <div class="date"><?php echo lang('answer_ago'); ?>  <i style="font-style:normal;" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($answer->date)); ?>"></i></div>
				      </div>
				      <div class="text" style="font-size:20px;">
				        <?php echo $question->title; ?>
				      </div>
				      <div class="text" style="font-size:13px;opacity:0.8;color:#595959;">
				        <?php echo $answer->content; ?>
				        
				      </div>
				      <div class="ui divider"></div>
			      	<div class="actions">
			      	<?php 
			      		$akey 	= $answer->ckey;
			      		$dv 	= $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='0' LIMIT 1;")->row();
			      		$li 	= $this->db->query("SELECT * FROM answers_votes WHERE akey='$akey' AND status='2' LIMIT 1;")->row();
			      	 ?>
			      	<a onclick="$('.foristyping').focus();"><i class="reply icon"></i>Komentar</a>
			      	<?php if(empty($li)){ ?>
						<a class="hide" al-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-text="<?php echo $answer->ckey; ?>">Like</i></a>
			      	<?php } else { ?>
 						<a class="hide a-liked" al-btn="<?php echo $answer->ckey; ?>"><i class="heart icon"></i><i al-text="<?php echo $answer->ckey; ?>">Liked</i></a>
			      	<?php } ?>

			      	<?php if(empty($dv)){ ?>
				        <a class="hide" ad-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-text="<?php echo $answer->ckey; ?>">Downvote</i></a>
				    <?php } else { ?>
				        <a class="hide a-downvoted" ad-btn="<?php echo $answer->ckey; ?>"><i class="level down icon"></i><i ad-text="<?php echo $answer->ckey; ?>">Downvoted</i></a>
				    <?php } ?>

				        <?php if($answer->username == $this->session->userdata('username')){ ?>
				        <a del-btn="<?php echo $answer->ckey; ?>" del-type="0"><i class="trash icon"></i>Delete
				        </a>        	
				        <?php } ?>
			      	</div>
<div class="ui form" style="margin-top:10px;">
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
</div>
				    </div>
			  	</div>
			</div>	
		</div>		
	</div>
	<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
<script type="text/javascript">
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
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
});
$("[qdv-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("qdv-btn");
	    background(10,'dv',data);
	});
});
$("[qfl-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("qfl-btn");
	    background(10,'fl',data);
	});
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

$("[q-more-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("q-more-btn");
	    if(data.search('new-a') == 0){
	    	var pid = data.replace(/new-a/i,'');
	    	background(11,'q',pid,'new-a');
	    	$(".new-a-btn").attr("new-a-btn", pid);
	    } 
	    	else if(data.search('new-c') == 0)
	    {
	    	var pid = data.replace(/new-c/i,'');
	    	background(11,'q',pid,'new-c');
	    	$(".new-c-btn").attr("new-c-btn", pid);
	    }
	    	else
	    {
	    	background(11,'q',data,'b');
	    }
	});
});

$("[a-more-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("a-more-btn");
	    if(data.search('new-ca') == 0){
	    	var pid = data.replace(/new-ca/i,'');
	    	background(11,'a',pid,'new-ca');
	    	$(".new-ca-btn").attr("new-ca-btn", pid);
	    }
	    	else
	    {
	    	background(11,'a',data,'ba');
	    }
	});
});

$("[del-btn]").each(function (){
	$(this).click(function () {
	    var data = $(this).attr("del-btn")
		, 	type = $('[del-btn="'+data+'"]').attr("del-type");
		background(14,type,data);
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
</script>
</body>
</html>
<?php } ?>