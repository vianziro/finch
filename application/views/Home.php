<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $topic = $this->db->query("SELECT title,description FROM questions_topics")->result();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $sitetitle; ?></title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>

<div class="ui container" style="margin-top:90px;">
	<div class="ui grid">
		<div class="ten wide column">
			<form class="ui new-question form" id="woigblk">
				<div class="ui basic segment">
				  	<div class="ui new-q dimmer">
				    	<div class="ui text loader">Loading</div>
				  	</div>
				  	<div class="ui fail-new-q dimmer" style="cursor:pointer;">
					    <div class="content">
					      <div class="center">
					        <h2 class="ui inverted icon header">
					          <i class="frown icon"></i>
					          Gagal Membuat Pertanyaan
					        </h2>
					        <p>(Klik Disini)</p>
					      </div>
					    </div>
				  	</div>
								<div class="field">
									<div class="ui input">
								    	<input q-data="qt-f" placeholder="Judul Pertanyaan" type="text">
									</div>
								</div>
								<div class="field">
									<div class="ui input">
								    	<textarea style="height:45px;" q-data="qd-f" title="deskripsi" placeholder="Deskripsi Pertanyaan"></textarea>
									</div>
								</div>
								<div class="fields">
									<div class="nine wide field">
										<div class="field">
											<div class="ui topic search">
											  <div class="ui icon input">
											    <input autocomplete="on" class="prompt" placeholder="Pilih Topik..." q-data="qto-f" type="text">
											    <i class="newspaper icon"></i>
											  </div>
											  <div class="results"></div>
											</div>
										</div>
									</div>
									<div class="seven wide field">
										<button class="bb green rounded fluid btn">KIRIM</button>
									</div>
								</div>	
						</div>
					</form>

			<div class="ui dividing header"></div>
					<div class="ui seven doubling person cards">
					<?php foreach($tofriends as $friend){ ?>
					  <a title="<?php echo $friend->first_name.' '.$friend->last_name.', '.$friend->bio; ?>" href="<?php echo base_url('profile'); ?>/<?php echo $friend->username; ?>" class="card">
					    <div class="image">
					    	<img src="<?php echo $isrc; ?><?php echo $friend->image; ?>">
					    </div>
					  </a>
					<?php } ?>
					</div>

<div class="ui two cards">
<?php 
	foreach($twopost as $post){
 ?>
	<div class="ui link card">
	  <div class="content">
	    <a href="<?php echo base_url('read'); ?>/<?php echo $post->username; ?>/<?php echo $post->url; ?>" class="header"><?php echo $post->title; ?></a>
	    <div class="meta">
	      <span class="category">
      <?php 
     $writer =  $this->db->query("SELECT * FROM users WHERE username='".$this->db->escape_str($post->username)."';")->row();
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
       ?> Menit Bacaan
	      </span>
	    </div>
	    <div class="description">
	      <p><?php echo $post->description; ?>.</p>
	    </div>
	  </div>
	  <div class="extra content">
	    <a href="<?php echo base_url('profile'); ?>/<?php echo $writer->username; ?>" class="right floated author">
	      <img class="ui avatar image" src="<?php echo $isrc; ?><?php echo $writer->image; ?>"> <?php echo $writer->first_name.' '.$writer->last_name; ?>
	    </a>
	  </div>
	</div>
<?php } ?>

</div>	
		<div class="ui timeline comments" style="max-width:100%;"></div>	

		</div>
		<div class="six wide column">
			<img src="<?php echo $sitesrc; ?>anez.jpg" style="margin-top:15px;border-radius:3px;width:100%;height:200px;" alt="">
		</div>
</div>

</div>
<div class="ui coupled long test q-mod modal"></div>

<div class="ui small new-a second coupled long modal">
    <div class="header">
      Tulis Jawaban
    </div>
    <div class="content">
      	<div class="description">
	        <div class="ui form">
	        	<div class="field">
	        		<textarea new-a-data=""></textarea>
	        	</div>
	        </div>
      	</div>
    </div>
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
      	<div new-a-btn="" class="ui new-a-btn green button">
	        <i class="save icon"></i>
	        Kirim
      	</div>
    </div>
</div>

<div class="ui small new-c second coupled long test scrolling modal" id="newc">
    <div class="header">
      Tulis Komentar
    </div>
    <div class="content">
      <div class="description">
        <div class="ui form">
        	<div class="field">
        		<textarea new-c-data=""></textarea>
        	</div>
        </div>
      </div>
    </div>
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
	    <div new-c-btn="" class="ui new-c-btn green button">
	        <i class="save icon"></i>
	        Kirim
	    </div>
    </div>
</div>

<div class="ui small new-ca second coupled long modal">
    <div class="header">
      Tulis Komentar
    </div>
    <div class="content">
      <div class="description">
        <div class="ui form">
        	<div class="field">
        		<textarea new-c-data=""></textarea>
        	</div>
        </div>
      </div>
    </div>
    <div class="actions">
    	<div class="ui cancel basic button">
	        <i class="close icon"></i>
	        Batal
	    </div>	
	    <div new-ca-btn="" class="ui new-ca-btn green button">
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

	<script type="text/javascript">
		var base_url = "<?php echo base_url(); ?>";
	</script>
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
	<script type="text/javascript">


        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Anez Mengomentari Pertanyaan Anda!',
            // (string | mandatory) the text inside the notification
            text: 'Anez Mengomentari Pertanyaan Anda, "Ayam Goreng Enak Rasanya",  <a href="">Klik Disini</a>.',
            // (string | optional) the image to display on the left
            image: 'http://localhost/by/uploads/images/9f49a5bba26026b817ab379e532f545d.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
         setTimeout(function(){

         $.gritter.remove(unique_id, {
         fade: true,
         speed: 'slow'
         });

         }, 2000)
        return false;
        });
$('.combo.dropdown').dropdown({action:'combo'});
var topics = [ {"title":"Social","description":"Topic"}];
$('.topic.search')
  .search({
    source: topics,
    error : {noResults   : 'Topik Tidak Ditemukan'}
  });
 $('.person.cards > .card')
  .transition({
    animation : 'jiggle',
    duration  : 800,
    interval  : 200
  });
$('.two.cards > .card')
  .transition({
    animation : 'pulse',
    reverse   : false,
    interval  : 200
  });
var mainSearch = [
 {"title":"Social","url":"localhost","price":"Topic"}
,{"title":"IDK Why But My Wife Is So Fucked Up","description":"Social  & Life Style","image":"http://localhost/by/lib/anez.jpg","url":"localhost"}
,{"title":"People","url":"localhost","price":"People"}
,{"title":"Rubi Jihantoro","description":"Web Developer","image":"http://localhost/by/lib/ruby.jpg","url":"localhost"}
];
$('.main.search')
  .search({
    source: mainSearch,
    error : {noResults   : 'Topik Tidak Ditemukan'},
    minCharacters : 1
  });
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: 'Menit Yang Lalu',
    hours: 'Jam Yang Lalu',
    ytd: 'Kemarin Pada Pukul',
    day: 'Hari Yang Lalu',
    server: ''
});
$('.coupled.modal')
  .modal({
    allowMultiple: false
  });
$('[new-c-btn]').click(function(){
	var pid 	= $(this).attr("new-c-btn")
	, 	cont 	= $('[new-c-data]').val();
	background(12,'new-c-btn',pid,cont);
});
$('[new-a-btn]').click(function(){
	var pid 	= $(this).attr("new-a-btn")
	, 	cont 	= $('[new-a-data]').val();
	background(12,'new-a-btn',pid,cont);
});
<?php if($this->session->userdata('username')){ ?>
background(8);
<?php } ?>
	</script>
</body>
</html>