<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Explore | Starda.id</title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>
	<div class="ui container" style="margin-top:90px;">
		<div class="ui grid" style="display:none;">
			<div class="four wide column">
<h3 class="ui dividing header">
  	Saring
</h3>

<div class="ui secondary vertical menu" style="width:100%;">
<!--   <a class="active item">
    Pertanyaan Tersimpan
    <div class="ui teal left pointing label">52</div>
  </a>
  <a class="item">
    Jawaban Tersimpan
    <div class="ui teal left pointing label">21</div>
  </a> -->
  <a class="item">
    Pertanyaan
  </a>
  <a class="item">
    Jawaban
  </a>
  <a class="item">
    Post
  </a>
  <div tabindex="0" class="ui dropdown item">
    <i class="dropdown icon"></i>
    Topik Pilihan
    <div tabindex="-1" class="menu">

      	<a class="item">Social</a>
    </div>
  </div>
</div>

<h3 class="ui dividing header">
  	Sedang Populer
</h3>
<div class="ui secondary vertical menu" style="width:100%;">
  <a class="active item">
    How I Can Make This Site
  </a>
  <a class="item">
    How To Blow Up Stupidity
  </a>
  <div tabindex="0" class="ui dropdown item">
    <i class="dropdown icon"></i>
    Display Options
    <div tabindex="-1" class="menu">
      <div class="header">Text Size</div>
      <a class="item">Small</a>
      <a class="item">Medium</a>
      <a class="item">Large</a>
    </div>
  </div>
</div>
			</div>
			<div class="twelve wide column">

<br>
<!-- <div class="ui labeled right floated icon top right pointing dropdown basic button">
  <i class="filter icon"></i>
  <span class="text">Filter Konten</span>
  <div tabindex="-1" class="menu">
    <div class="ui search icon input">
      <i class="search icon"></i>
      <input tabindex="0" name="search" placeholder="Cari Filter..." value="" type="text">
    </div>
    <div class="divider"></div>
    <div class="header">
      <i class="calendar icon"></i>
      Filter Tanggal
    </div>
    <a onClick="loadC(1,3,3);" class="item">
      <i class="olive circle icon"></i>
      Terbaru
    </a>
    <a onClick="loadC(1,3,4);" class="item">
      <i class="orange circle icon"></i>
      Terlama
    </a>
    <div class="divider"></div>
    <div class="header">
      <i class="eye icon"></i>
      Filter Statistik
    </div>
    <a onClick="loadC(1,3,1);" class="item">
      <div class="ui red empty circular label"></div>
      Paling Banyak Dilihat
    </a>
    <div onClick="loadC(1,3,2);" class="item">
      <div class="ui blue empty circular label"></div>
      Paling Sedikit Dilihat
    </div>
    <div class="divider"></div>
    <div class="header">
      <i class="sort alphabet ascending icon"></i>
      Filter Huruf
    </div>
    <a onClick="loadC(1,3,3);" class="item">
      <i class="olive circle icon"></i>
      A - Z
    </a>
    <a onClick="loadC(1,3,4);" class="item">
      <i class="orange circle icon"></i>
      Z - A
    </a>
  </div>
</div> -->

        <input style="display:none;" type="text" value="" name="e_topic">
        <input style="display:none;" type="text" value="" name="e_filter">
<br><br><br>

			</div>
		</div>



          <div class="ui left labeled fluid icon input">
            <input name="dynamicfilter" placeholder="Ketik Lalu Tekan Enter..." type="text">
            <i class="search icon"></i>
          </div><br><br>
<div class="explore-content">

</div>
	</div>
  <script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
  <script type="text/javascript">
  background(23,0);
  </script>
</body>
</html>