<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My Post | Starda.id</title>
	<link rel="stylesheet" href="<?php echo base_url('lib'); ?>/style.css">
</head>
<body>
	<?php $this->load->view('part/topmenu'); ?>
	<div class="ui container" style="margin-top:90px;">
		<div class="ui grid">
			<div class="three wide column">
<div class="ui vertical pointing menu">
  <a post-menu="all-post" class="item active">
    Semua Post
  </a>
  <a class="item" post-menu="post-act">
    Post Baru
  </a>
</div>
			</div>
			<div class="thirteen wide p-content column">

<div class="ui segment list-post">
<div class="ui link divided items">
<?php foreach($post_data as $post){ ?>
  <div class="item" style="cursor:default;">
    <div class="ui tiny image">
      <img src="<?php echo base_url('uploads/images'); ?>/<?php echo $post->image; ?>">
    </div>
    <div class="content">
      <div class="header" style="cursor:pointer;"><?php echo $post->title; ?></div>
      <div class="description">
				      	<?php if(strlen($post->content) > 288){ ?>
				      		<?php echo substr(strip_tags($post->content), 0, 288).' ..(Read More)'; ?>
				      	<?php } else { ?>
				      		<?php echo $post->content; ?>
				      	<?php } ?>
      </div> 

      <div class="extra">
        <a href="<?php echo base_url('edit/post'); ?>/<?php echo $post->ckey; ?>" style="font-weight:normal;cursor:pointer;"><i class="blue edit icon"></i>Edit Post</a>
        <b href="" style="font-weight:normal;cursor:pointer;"><i class="red trash icon"></i>Delete Post</b>
      </div>
    </div>
  </div>
<?php } ?>
</div> 
</div>
<div class="for-form" style="display:none;">
<div class="ui segment">
<?php echo form_open_multipart(base_url().'home/savepost', ['class'=>'ui form']); ?>
	<div class="fields">
		<div class="six wide field">
			<div class="required field">
				<label>Judul Post</label>
				<div class="ui left icon input">
					<i class="newspaper icon"></i>
					<input name="title" id="title" placeholder="Judul Post.." type="text">
				</div>
			</div>
		</div>
		<div class="ten wide field">
			<div class="required field">
				<label>URL Post</label>
	<div class="ui labeled input">
	  <div class="ui label">
	    http://starda.id/profile/<?php echo $this->session->userdata('username'); ?>/
	  </div>
	  <input name="url" id="url" placeholder="your-post-url" type="text">
	</div>
			</div>
		</div>
	</div>
	<div class="field">
		<label>Gambar Utama Post</label>
		<div class="ui left icon input">
			<i class="image icon"></i>
			<input name="mainimage" id="title" placeholder="Gambar Utama" type="file">
		</div>
	</div>
	<div class="required field">
		<label>Deskripsi Post</label>
		<textarea name="description" placeholder="Ringkasan Singkat Tentang Post" style="max-height:45px;"></textarea>
	</div>
	<div class="required field">
		<label>Konten Post</label>
		<textarea id="editor" class="ckeditor" name="content" placeholder="Konten Post"></textarea>
	</div>
	<button class="ui fluid green button">BUAT POST!</button>
<?php echo form_close(); ?>
</div>
</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
	<script src="<?php echo base_url('lib'); ?>/bundle.js"></script>
	<script src="<?php echo base_url('lib'); ?>/speakingurl.js"></script>
	<script src="<?php echo base_url('lib/ckeditor'); ?>/ckeditor.js"></script>
	<script type="text/javascript">
	$("#title").on("keyup",function(){
        var t_url=getSlug($(this).val());
        $("#url").val(t_url);
    });
	$('.post.form')
	  .form({
	    fields: {
	      title    : 'empty',
	      url 	   : 'empty',
	      mainimage: 'empty',
	      description : ['minLength[6]', 'empty'],
	      content   : ['minLength[6]', 'empty']
	    }
	  });
	$('[post-menu="all-post"]').click(function () {
		$('.for-form').hide();
		$('.list-post').show();
		$('[post-menu="all-post"]').addClass('active');
		$('[post-menu="post-act"]').removeClass('active');
	});
	$('[post-menu="post-act"]').click(function () {
		$('.list-post').hide();
		$('.for-form').show();
		$('[post-menu="post-act"]').addClass('active');
		$('[post-menu="all-post"]').removeClass('active');
	});

	</script>
</body>
</html>