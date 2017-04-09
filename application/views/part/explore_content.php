
	<div class="ui divided items">

<?php
	foreach($timeline_data as $timeline){
	$tt = $timeline->type;
	if($tt == 0){
		$question = $this->db->query("SELECT * FROM questions WHERE tkey='$timeline->ckey' LIMIT 1;")->row();
?>
	<div class="item" style="background: url(<?php echo $sitesrc; ?>e_ask.png) no-repeat;background-position: right top;">
	    <a class="ui tiny image">
	      <img src="http://localhost/by/uploads/images/9f49a5bba26026b817ab379e532f545d.jpg">
	    </a>
	    <div class="content">
	      <i class="yellow big bookmark icon" style="float:right;margin-top:-12px;"></i>
	      <a href="<?php echo base_url('q'); ?>/<?php echo $timeline->ckey; ?>" class="header"><?php echo $question->title; ?></a>
      		<div class="meta">
        		<span><?php echo $question->topic; ?></span>
      		</div>
	      <div class="description">
	        <p><?php echo $question->content; ?></p>
	      </div>
	      <div class="extra">
	        <a href="<?php echo base_url('q'); ?>/<?php echo $timeline->ckey; ?>" class="ui right floated green mini button">
	          Beri Jawaban
	          <i class="right chevron icon"></i>
	        </a>
	      </div>
	    </div>
	</div>
	<?php } elseif($tt == 1){  ?>
	<?php 
		$answer = $this->db->query("SELECT * FROM answers WHERE tkey='$timeline->ckey' LIMIT 1;")->row();
	 ?>
	  <div class="item" style="background: url(<?php echo $sitesrc; ?>e_answer.png) no-repeat;background-position: right top;">
	    <a class="ui tiny image">
	      <img src="http://localhost/by/uploads/images/9f49a5bba26026b817ab379e532f545d.jpg">
	    </a>
	    <div class="content">
	      <a class="header"><?php echo $answer->username; ?> Menjawab Bagaimana Cara Menjadi Seorang Superman</a>
	      <div class="description">
	        <p><?php echo $answer->content; ?></p>
	      </div>
	      <div class="extra">
<div class="ui basic tiny right floated icon button">
	Lihat Jawaban
	<i class="chevron right icon"></i>
</div>
	      </div>
	    </div>
	  </div>
	  <?php }elseif($tt == 2){ ?>
	  
	  <div class="item" style="background: url(<?php echo $sitesrc; ?>e_post.png) no-repeat;background-position: right top;">
	    <a class="ui tiny image">
	      <img src="http://localhost/by/uploads/images/9f49a5bba26026b817ab379e532f545d.jpg">
	    </a>
	    <div class="content">
	      <i class="yellow big bookmark icon" style="float:right;margin-top:-12px;"></i>
	      <a class="header">Rubi Jihantoro</a>
	      	<div class="meta">
	      		<span>5 Menit Bacaan</span>
	      		<span>524x Dilihat</span>
	      	</div>
	      <div class="description">
	        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ven</p>
	      </div>
	      <div class="extra">
<div class="ui basic tiny right floated icon button">
	Baca Post
	<i class="chevron right icon"></i>
</div>
	      </div>
	    </div>
	  </div>

	</div>
<?php } ?>
<?php } ?>