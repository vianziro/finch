<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($sw == 'tl'){
 foreach($timeline_data as $timeline) { ?>
	<?php 
	$key 	=	$timeline->ckey;
	$tt 	= 	$timeline->type;
	$me 	= 	$this->session->userdata('mykey');
	if($tt == '0') { ?>
	<?php 
		$question 	= $this->db->query("SELECT * FROM questions WHERE tkey='$key' LIMIT 1;")->row();
		if($question){
	 ?>
	 <?php 
		$countdv 	= $this->db->query("SELECT * FROM questions_votes WHERE qkey='$question->ckey' AND status='0';")->num_rows();
		$countfl 	= $this->db->query("SELECT * FROM log_follow WHERE log_info='3' AND identity='$question->ckey'")->num_rows();
		$countaw 	= $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey';")->num_rows();
		$whogiveaw  = $this->db->query("SELECT * FROM answers WHERE qkey='$question->ckey' ORDER BY id DESC LIMIT 15;")->result();
	  ?>
			<div class="ui piled segment">
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
				    <img class="last answer" src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
				<?php } ?>
				     
				     <div class="actions">
				     	
				        <a class="reply" q-more-btn="new-a<?php echo $question->ckey; ?>"><i class="write icon"></i>Write Answer</a>
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

				        <a class="save" q-more-btn="new-c<?php echo $question->ckey; ?>"><i class="reply icon"></i>Comment</a>
				        <a q-more-btn="<?php echo $question->ckey; ?>">
				          <i class="expand icon"></i>
				          Read More
				        </a>
				        <?php if($question->username == $this->session->userdata('username')){ ?>
				        <a><i class="trash icon"></i>Delete
				        </a>        	
				        <?php } ?>
			      	</div>
				    </div>
			  	</div>
			</div>
		<?php } ?>
<?php } elseif($tt == '1'){ ?>
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
			      	<a a-more-btn="<?php echo $answer->ckey; ?>"><i class="reply icon"></i>Komentar</a>
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
				        <a a-more-btn="<?php echo $answer->ckey; ?>">
				          <i class="expand icon"></i>
				          Baca Lebih
				        </a>
				        <?php if($answer->username == $this->session->userdata('username')){ ?>
				        <a del-btn="<?php echo $answer->ckey; ?>" del-type="0"><i class="trash icon"></i>Delete
				        </a>        	
				        <?php } ?>
			      	</div>
				    </div>
			  	</div>
			</div>
	<?php } ?>
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
<?php } elseif($sw == 'pt'){ ?>
<div class="ui link divided items">
<?php foreach($post_data as $post){ ?>
  <div class="item">
    <div class="ui tiny image">
      <img src="<?php echo $isrc; ?><?php echo $post->image; ?>">
    </div>
    <div class="content">
      <a href="<?php echo base_url('read'); ?>/<?php echo $post->username; ?>/<?php echo $post->url; ?>" class="header"><?php echo $post->title; ?></a>
      <div class="description">
				      	<?php if(strlen($post->content) > 288){ ?>
				      		<?php echo substr(strip_tags($post->content), 0, 288).' ..(Read More)'; ?>
				      	<?php } else { ?>
				      		<?php echo $post->content; ?>
				      	<?php } ?>
      </div> 
    </div>
  </div>
<?php } ?>
</div>
<?php } elseif($sw == 'mt'){ ?>

<?php } elseif($sw == 'fg'){ ?>
					<div class="ui seven doubling person cards">
				<?php foreach($u_data as $followed){ ?>
					<?php 
						$profile = $this->db->query("SELECT * FROM users WHERE username='$followed->followed_username' LIMIT 1;")->row();
					 ?>
					  <a href="<?php echo base_url('profile'); ?>/<?php echo $profile->username; ?>" class="card" title="<?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?>">
					    <div class="image">
					    	<img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
					    </div>
					  </a>

				<?php } ?>
					</div>
<?php } elseif($sw == 'fs'){ ?>
					<div class="ui seven doubling person cards">
				<?php foreach($u_data as $followed){ ?>
					<?php 
						$profile = $this->db->query("SELECT * FROM users WHERE username='$followed->username' LIMIT 1;")->row();
					 ?>
					  <a href="<?php echo base_url('profile'); ?>/<?php echo $profile->username; ?>" class="card" title="<?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?>">
					    <div class="image">
					    	<img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
					    </div>
					  </a>

				<?php } ?>
					</div>
<?php } elseif($sw == 'tp') { ?>
	<div class="ui link divided items">
	<?php foreach($t_data as $topic){ ?>
	<?php 
		$data = $this->db->query("SELECT * FROM questions_topics WHERE identity='$topic->topic_id' LIMIT 1;")->row();
	 ?>
	  <div class="item">
	    <div class="ui tiny image">
	      <img src="<?php echo $isrc; ?><?php echo $data->image; ?>">
	    </div>
	    <div class="content">
	      <div class="header"><?php echo $data->title; ?></div>
	      <div class="description">
					      	<?php if(strlen($data->description) > 288){ ?>
					      		<?php echo substr(strip_tags($data->description), 0, 288).' ..(Read More)'; ?>
					      	<?php } else { ?>
					      		<?php echo $data->description; ?>
					      	<?php } ?>
	      </div> 
	    </div>
	  </div>
	<?php } ?>
	</div>
<?php } ?>