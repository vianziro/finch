<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?> - Profile | Starda.id</title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<div>
		<?php $this->load->view('part/topmenu'); ?>
			<div class="ui fluid container" style="margin-top:55px;">
				<div class="head" style="height:350px;background: url(<?php echo $isrc; ?><?php echo $profile->coverimage; ?>) fixed;">
					<div class="ui container">
						<div class="ui profile top grid">
							<div class="four wide column">
								<img src="<?php echo $isrc; ?><?php echo $profile->image; ?>" class="profile image" alt="">
							</div>
							<div class="five wide column"></div>
							<div class="two wide column"></div>
							<div class="five wide column" style="margin-top:165px;">
<?php if($this->session->userdata('mykey') != $profile->mykey){ ?>
<?php 
	$me = $this->session->userdata('username');
	$im = $this->session->userdata('mykey');
	$username = $profile->username;
	$identity = $profile->mykey;
	$cekfol = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity' AND username='$me' AND ukey='$im' LIMIT 1;")->row();
	if(empty($cekfol))
	{
		$count = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity';")->num_rows();
		echo '<div class="ui labeled right floated button" tabindex="0">
  <div class="ui basic green button" follow-id="'.$profile->mykey.'" follow-username="'.$profile->username.'">
    <i class="add icon"></i> Follow
  </div>
  <a class="ui basic left pointing green label" follow-total="'.$profile->username.'">
    '.$count.'
  </a>
</div>';

	}
	else
	{
		$count = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity';")->num_rows();
		echo '<div class="ui labeled right floated button" tabindex="0">
  <div class="ui green button" follow-id="'.$profile->mykey.'" follow-username="'.$profile->username.'">
    <i class="checkmark icon"></i> Followed
  </div>
  <a class="ui basic left pointing green label" follow-total="'.$profile->username.'">
    '.$count.'
  </a>
</div>';
	}

 ?>

<a class="ui basic icon right floated button">
	<i class="send icon"></i> Chat
</a>
<?php } else { ?>
<button class="ui green right floated button">
  <i class="edit icon"></i>
  Edit Profile
</button>
<?php } ?>
							</div>
						</div>
						<div class="ui grid">
							<div class="five wide column">
								<h1 class="profile name"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?><i class="check circle outline green icon"></i></h1>
								<p><?php echo $profile->bio; ?></p>
<div class="ui secondary vertical menu" style="width:87%;">
  <a profile-menu="0" class="active item">
    Answers
  </a>
  <a profile-menu="1" class="item">
    Question
  </a>
  <a profile-menu="2" class="item">
    Post
  </a>
  <a profile-menu="3" class="item">
    Meeting
  </a>
  <a profile-menu="4" class="item">
    Following
  </a>
  <a profile-menu="5" class="item">
    Followers
  </a>
  <a profile-menu="6" class="item">
    Topics
  </a>
</div>
							</div>
							<div class="eleven wide column">
<?php if(!$this->session->userdata('username')){ ?>
<div class="ui relaxed divided items">
    <center style="margin-top:200px;margin-bottom:200px;">
    	<b style="color:#7B7B7B;text-transform:capitalize;">Anda Harus Masuk Untuk Melihat Lebih Jauh</b>
    </center>
</div>
<?php } else { ?>
<div class="ui timeline-profile comments" style="max-width:100%;"></div>
<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
<div class="ui coupled long test q-mod modal"></div>
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
	</div>
	<script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
<?php if($this->session->userdata('username')){ ?>
	<script type="text/javascript">
		$('[follow-username]').click(function () {
			var username = $(this).attr("follow-username")
			,   id 		 = $('[follow-username="'+username+'"]').attr("follow-id");
			background(19,username,id);
		});
		background(20,'<?php echo $profile->mykey; ?>','<?php echo $profile->username; ?>','0');
		$('[profile-menu]').each(function(){
			$(this).click(function () {
				var dow = $(this).attr("profile-menu");
				background(20,'<?php echo $profile->mykey; ?>','<?php echo $profile->username; ?>',dow);

			})
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
	</script>
<?php } ?>


<?php if(!$this->session->userdata('username')){ ?>
 <div class="ui d-for-log page dimmer">
  <div class="content">
    <div class="center">
      <h2 class="ui inverted icon header">
        <i class="sign in icon"></i>
        Mohon Maaf <br><br>	
        <div class="sub header">Anda Harus <a href="<?php echo base_url(); ?>" title="Masuk">Masuk</a> / <a href="<?php echo base_url(); ?>" title="Daftar">Daftar</a> Untuk Melihat Konten</div>
      </h2>
    </div>
  </div>
</div>
<script type="text/javascript">
$('.d-for-log.dimmer').dimmer('show');
</script>
<?php } ?>
</body>
</html>