<?php if($tt == '1'){ ?>
<div class="ui segment">
<?php echo form_open_multipart(base_url().'home/savepost', ['class'=>'ui form']); ?>
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
	<button class="ui fluid green button">BUAT POST!</button>
<?php echo form_close(); ?>
</div>
<?php } else { ?>


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
<?php } ?>
