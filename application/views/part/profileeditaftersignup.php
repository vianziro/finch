<?=form_open_multipart(base_url()+'background', ['class'=>'ui form'])?>
						<div class="ui edit-after-signup segment">
							
		    				<input type="file" style="display:none" class="form-control" id="upload-image" name="userfile" multiple="multiple"></input>
		    				<div id="upload" class="uploadaftersignup" title="Upload Foto Profile">
		    					<div id="thumbnail"><img src="<?php echo $sitesrc; ?>emptyprofileimage.png"/></div>
		    				</div>
							<h2 class="ui after-signup header" style="text-align:center;">
							  <div class="content">
							    <?php echo lang('account_settings'); ?>
							    <div class="sub header"><?php echo lang('account_settings_desc'); ?></div>
							  </div>
							</h2>

						  	<div class="required field">
							    <label><?php echo lang('borndate') ?></label>
								<div class="ui left icon input">
							    	<input title="<?php echo lang('borndate_popup') ?>" name="borndate" placeholder="<?php echo lang('borndate_ph') ?>" type="text">
								  	<i class="calendar icon"></i>
								</div>
						  	</div>

						  	<div class="required field">
							    <label><?php echo lang('gender') ?></label>
								<div tabindex="0" class="ui selection dropdown" title="<?php echo lang('gender_popup'); ?>">
								  <input name="gender" type="hidden">
								  <i class="dropdown icon"></i>
								  <div class="default text"><?php echo lang('gender') ?></div>
								  <div tabindex="-1" class="menu">
								    <div class="item" data-value="1"><i class="male icon"></i> <?php echo lang('male') ?></div>
								    <div class="item" data-value="0"><i class="female icon"></i> <?php echo lang('female') ?></div>
								  </div>
								</div>
						  	</div>

						  	<div class="required field">
							    <label><?php echo lang('bio') ?></label>
								<div class="ui tiny input">
							    	<textarea style="height:45px;" name="bio" title="<?php echo lang('bio_popup'); ?>" placeholder="<?php echo lang('bio_ph'); ?>"></textarea>
								</div>
						  	</div>

						  	<div class="required field">
							    <label><?php echo lang('address') ?></label>
								<div class="ui left icon input">
							    	<input title="<?php echo lang('address_popup') ?>" name="address" placeholder="<?php echo lang('address') ?>" type="text">
								  	<i class="home icon"></i>
								</div>
						  	</div>
						  	<input type="text" style="display:none;" value="6" name="wdyw">
						</div>
						<button class="bb green rounded fluid btn">LANJUTKAN</button>
<?php form_close(); ?>
						<script type="text/javascript">
						$('.ui.checkbox').checkbox();
						$('.ui.dropdown').dropdown();
$(document).ready(function(){
	
	var fileDiv = document.getElementById("upload");
	var fileInput = document.getElementById("upload-image");
	
	fileInput.addEventListener("change",function(e){
	  var files = this.files
	  showThumbnail(files)
	},false)

	fileDiv.addEventListener("click",function(e){
	  $(fileInput).show().focus().click().hide();
	  e.preventDefault();
	},false)

	fileDiv.addEventListener("dragenter",function(e){
	  e.stopPropagation();
	  e.preventDefault();
	},false);

	fileDiv.addEventListener("dragover",function(e){
	  e.stopPropagation();
	  e.preventDefault();
	},false);

	fileDiv.addEventListener("drop",function(e){
	  e.stopPropagation();
	  e.preventDefault();

	  var dt = e.dataTransfer;
	  var files = dt.files;

	  showThumbnail(files)
	},false);
	
});

function showThumbnail(files){
  for(var i=0;i<files.length;i++){
	var file = files[i]
	var imageType = /image.*/

	if(!file.type.match(imageType)){
	  console.log("Not an Image");
	  continue;
	}

	var image = document.createElement("img");
	// image.classList.add("")
	var thumbnail = document.getElementById("thumbnail");
	image.file = file;
	
	while(thumbnail.hasChildNodes()) {
		thumbnail.removeChild(thumbnail.lastChild);
	}
	
	thumbnail.appendChild(image)
	
	$('#addImage').hide();
	
	var reader = new FileReader()
	reader.onload = (function(aImg){
	  return function(e){
		aImg.src 	= e.target.result;
	  };
	}(image))
	var ret = reader.readAsDataURL(file);
	var canvas = document.createElement("canvas");
	ctx = canvas.getContext("2d");
	image.onload= function(){
	  ctx.drawImage(image,128,128)
	}
  }
}
						</script>