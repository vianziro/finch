<?php 
	$this->session->set_userdata('lastwatchedpost', $this->uri->segment(2).'/'.$this->uri->segment(3));
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $post->title; ?></title>
	<meta type="description" content="<?php echo $post->description; ?>">
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>
	<div class="ui fluid container" style="height:460px;background: url(<?php echo $isrc;?><?php echo $post->image; ?>) fixed;background-size:contain;">
		
	</div>
	<div class="ui container"><br>
<div class="ui tiny statistics" style="float:right;display:inline-block;">
  <div class="ui tiny statistic" title="Perkiraan Waktu Lamanya Membaca Post Ini">
    <div class="value">
      <i class="wait icon"></i>
      <?php 
      
      if(strlen($post->content) < 1501)
      	echo '1';
      elseif(strlen($post->content) < 3002)
      	echo '2';
      elseif(strlen($post->content) < 4502)
      	echo '3';
      elseif(strlen($post->content) < 6002)
      	echo '4';
      elseif(strlen($post->content) < 7502)
      	echo '5';
      elseif(strlen($post->content) < 8002)
      	echo '6';
      elseif(strlen($post->content) < 9502)
      	echo '7';
      elseif(strlen($post->content) < 11002)
      	echo '8';
      elseif(strlen($post->content) < 12502)
      	echo '9';
      elseif(strlen($post->content) < 14002)
      	echo '10';
      elseif(strlen($post->content) < 15502)
      	echo '11';
       ?>
    </div>
    <div class="label">
      Menit Membaca
    </div>
  </div>
  <div class="ui statistic" style="float:right;display:inline-block;" title="Perkiraan Waktu Lamanya Membaca Post Ini">
    <div class="value">
      <i class="eye icon"></i> <?php echo $post->viewer; ?>
    </div>
    <div class="label">
      X Dibaca
    </div>
  </div>
</div>
<div class="ui list">
  	<div class="item">
    <img class="ui avatar image" src="<?php echo $isrc; ?><?php echo $writer->image; ?>">
    <div class="content">
      <a href="<?php echo base_url('profile'); ?>/<?php echo $writer->username; ?>" class="header"><?php echo $writer->first_name.' '.$writer->last_name; ?></a>
     	<?php echo $writer->bio; ?>
    </div>
</div>
		</div>
		<h1><?php echo $post->title; ?></h1>
		<div>
			<?php echo $post->content; ?>
		</div><br><br>
	</div>
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
</body>
</html>