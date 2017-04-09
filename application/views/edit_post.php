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
  <a href="<?php echo base_url('my-post'); ?>" post-menu="all-post" class="item">
    Semua Post
  </a>
  <a href="<?php echo base_url('my-post'); ?>" class="item" post-menu="post-act">
    Post Baru
  </a>
  <a class="active item" post-menu="edit-post">
    Edit Post
  </a>
</div>
			</div>
			<div class="thirteen wide p-content column">
<div class="ui segment">
<?php echo form_open_multipart(base_url().'edit/post/'.$post->ckey, ['class'=>'ui form']); ?>
	<div class="fields">
		<div class="six wide field">
			<div class="required field">
				<label>Judul Post</label>
				<div class="ui left icon input">
					<i class="newspaper icon"></i>
					<input value="<?php echo $post->title; ?>" name="title" id="title" placeholder="Judul Post.." type="text">
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
	  <input name="url" id="url" value="<?php echo $post->url; ?>" placeholder="your-post-url" type="text">
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
		<textarea name="description" placeholder="Ringkasan Singkat Tentang Post" style="max-height:45px;"><?php echo $post->description; ?></textarea>
	</div>
	<div class="required field">
		<label>Konten Post</label>
		<textarea id="editor" class="ckeditor" name="content" placeholder="Konten Post"><?php echo $post->content; ?></textarea>
	</div>
	<input style="display:none;" name="ckey" value="<?php echo $post->ckey; ?>">
	<button class="ui fluid green button">SIMPAN POST!</button>
<?php echo form_close(); ?>
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