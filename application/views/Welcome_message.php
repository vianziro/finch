<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $sitetitle; ?></title>
	<link rel="stylesheet" href="<?php echo $sitesrc; ?>style.css">
</head>
<body>
	<div class="welcome-body">
		<?php $this->load->view('part/topmenu'); ?>

		<div class="ui welcome container">
			<div class="ui grid">
				<div class="ten wide column">
					<div class="ui segment">
						<video autoloop class="introduction">
							<source src="<?php echo $sitesrc; ?>introduction.mp4">
						</video>
					</div>
					<h3 class="ui horizontal divider header"><?php echo lang('popular_user_text'); ?></h3>
					<div class="ui five doubling welcome cards">
					  <a class="card" title="Rubi Jihantoro">
					    <div class="image">
					    	<img src="<?php echo $sitesrc; ?>a.jpg">
					    </div>
					  </a>
					  <a class="card" title="Rubi Jihantoro">
					    <div class="image">
					    	<img src="<?php echo $sitesrc; ?>a1.jpg">
					    </div>
					  </a>
					  <a class="card" title="Rubi Jihantoro">
					    <div class="image">
					    	<img src="<?php echo $sitesrc; ?>a2.jpg">
					    </div>
					  </a>
					  <a class="card" title="Rubi Jihantoro">
					    <div class="image">
					    	<img src="<?php echo $sitesrc; ?>a3.jpg">
					    </div>
					  </a>
					  <a class="card" title="Rubi Jihantoro">
					    <div class="image">
					    	<img src="<?php echo $sitesrc; ?>a1.jpg">
					    </div>
					  </a>
					</div>
				</div>
				<div class="six wide column">
					<div class="ui welcome-reg segment">
						<b class="reg now"><?php echo lang('reg_form') ?></b>
					</div>
					<div class="come form">
					<div class="ui welcome-log segment" style="display:none;">
						<b class="log now"><?php echo lang('log_form') ?></b>
					</div>
						<form class="ui welcome-log form" style="display:none;">
							
							<div class="ui log-form segment">
								  <div class="ui log-dim dimmer">
								    <div class="ui text loader">Memproses</div>
								  </div>
								  <div class="ui fail-log-dim dimmer" style="cursor:pointer;">
								    <div class="content">
								      <div class="center">
								        <h2 class="ui inverted icon header">
								          <i class="frown icon"></i>
								          Gagal Login!
								        </h2>
								        <p>Klik Disini</p>
								      </div>
								    </div>
								  </div>
								  <div class="required field">
								    <label><?php echo lang('account_identity') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('account_identity_popup') ?>" name="logidentity" placeholder="<?php echo lang('account_identity') ?>" type="text">
									  	<i class="user icon"></i>
									</div>
								  </div>
								  <div class="required field">
								    <label><?php echo lang('account_password') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('account_password_popup') ?>" name="logpassword" placeholder="<?php echo lang('account_password') ?>" type="text">
									  	<i class="lock icon"></i>
									</div>
								  </div>
								  <div class="ui divider"></div>
								  	<div class="fields">
								  		<div class="ten wide field">
								  			<label><?php echo lang('hide_ol_status') ?></label>
								  		</div>
								  		<div class="six wide field">
											<div title="<?php echo lang('hide_ol_status_popup') ?>" class="ui fitted toggle checkbox" style="float:right;">
											    <input class="hidden" name="logolstatus" tabindex="0" type="checkbox">
											</div>
								  		</div>
								  	</div>
								  	<div class="fields">
								  		<div class="ten wide field">
								  			<label><?php echo lang('mute_mode') ?></label>
								  		</div>
								  		<div class="six wide field">
											<div title="<?php echo lang('mute_mode_popup') ?>" class="ui fitted toggle checkbox" style="float:right;">
											    <input class="hidden" name="logmutemode" tabindex="0" type="checkbox">
											</div>
								  		</div>
								  	</div>
								  	<div class="fields">
								  		<div class="ten wide field">
								  			<label><?php echo lang('rem_and_save') ?></label>
								  		</div>
								  		<div class="six wide field">
											<div title="<?php echo lang('rem_and_save_popup') ?>" class="ui fitted toggle checkbox" style="float:right;">
											    <input class="hidden" name="logremsave" tabindex="0" type="checkbox">
											</div>
								  		</div>
								  	</div>
								<button class="bb green rounded fluid btn">MASUK</button>
							</div>
							<img class="log-ads" src="<?php echo $sitesrc; ?>ciayo.jpg" alt="">
						</form>

						<form class="ui welcome-reg form" id="ayam">
							<div class="ui reg-form segment">
								  <div class="ui dimmer">
								    <div class="ui text loader">Memproses</div>
								  </div>
								  <div class="required field">
								    <label><?php echo lang('first_name_reg') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('first_name_reg_popup') ?>" name="firstname" placeholder="<?php echo lang('first_name_reg') ?>" type="text">
									  	<i class="user icon"></i>
									</div>
								  </div>
								  <div class="field">
								    <label><?php echo lang('last_name_reg') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('last_name_reg_popup') ?>" name="lastname" placeholder="<?php echo lang('last_name_reg') ?>" type="text">
									  	<i class="user icon"></i>
									</div>
								  </div>
								  <div class="username required field">
								    <label><?php echo lang('user_name_reg') ?></label>
									<div class="ui left icon input">
									  	<div class="ui dimmer unamedim"></div>
								    	<input title="<?php echo lang('user_name_reg_popup') ?>" name="username" placeholder="<?php echo lang('user_name_reg') ?>" type="text">
								 		<i class="street view icon"></i>
									</div>
								  </div>
								  <div class="email required field">
								    <label><?php echo lang('email_reg') ?></label>
									<div class="ui left icon input">
									  	<div class="ui dimmer emaildim"></div>
								    	<input title="<?php echo lang('email_reg_popup') ?>" name="email" placeholder="<?php echo lang('email_reg') ?>" type="text">
								  		<i class="mail outline icon"></i>
									</div>
								  </div>
								  <div class="required field">
								    <label><?php echo lang('password_reg') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('password_reg_popup') ?>" name="password" placeholder="<?php echo lang('password_reg') ?>" type="password">
								  		<i class="unlock alternate icon"></i>
									</div>
								  </div>
								  <div class="required field">
								    <label><?php echo lang('repassword_reg') ?></label>
									<div class="ui left icon input">
								    	<input title="<?php echo lang('repassword_reg_popup') ?>" name="repassword" placeholder="<?php echo lang('repassword_reg') ?>" type="password">
								  		<i class="lock icon"></i>
									</div>
								  </div>
								  <div class="inline field">
								    <div class="ui checkbox">
								      <input class="hidden" name="agreetos" tabindex="0" type="checkbox">
								      <label><?php echo lang('agree_tos'); ?></label>
								    </div>
								  </div>
								  <div class="inline field">
								    <div class="ui checkbox">
								      <input class="hidden" name="subscribe" tabindex="0" type="checkbox">
								      <label><?php echo lang('subscribe_check'); ?></label>
								    </div>
								  </div>
							</div>
							<button class="bb green rounded fluid btn"><?php echo lang('signup_btn') ?></button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>
	
	<script src="<?php echo $sitesrc; ?>bundle.js"></script>
	
</body>
</html>