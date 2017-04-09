<?php if(!$this->ion_auth->logged_in() && !$this->uri->segment(1) || $this->uri->segment(1) == 'home' && !$this->ion_auth->logged_in()){ ?>
	<div class="ui borderless inverted main menu">
		<div class="ui container">
  		<div class="item">
    		<img src="<?php echo $sitesrc; ?>logo.png">
  		</div>
	  	<div class="header item" style="font-size:20px;padding-top:25px;margin-left:-15px !important;">
	    	<?php echo lang('main_site_title'); ?>
	  	</div>
	  <div class="right menu">
		  <a class="welcome-log-btn item">
		    <?php echo lang('login_text'); ?>
		  </a>
		  <a class="active welcome-reg-btn item">
		    <?php echo lang('signup_text'); ?>
		  </a>
	  </div>
	</div>
	</div>
<?php } ?>

<?php if($this->ion_auth->logged_in()){ ?>
<div class="ui pointing fixed borderless menu" style="border-top:0px solid #FFFFFF;">
	<div class="ui container">

	  <a href="<?php echo base_url(); ?>" class="
      <?php if(!$this->uri->segment(1)) echo 'active item'; else echo 'item';  ?>
      ">
	  	<i class="home icon"></i>
	    Beranda
	  </a>

	  <a class="item" title="" style="width:30% !important;">
			<div class="ui main search" style="width:100% !important;border-radius:3px !important;">
				<div class="ui icon input" style="width:100% !important;border-radius:3px !important;">
					<input autocomplete="on" class="prompt" style="" placeholder="Pilih Topik..." name="qto-f" type="text">
					<i class="newspaper icon"></i>
				</div>
				<div style="width:100% !important;" class="results"></div>
			</div>
	  </a>

	  <div class="right menu">
    <a href="<?php echo base_url('explore'); ?>" class="
    <?php if($this->uri->segment(1) == 'explore') echo 'active item'; else echo 'item';  ?>
    ">
      <i class="newspaper icon"></i>
      Explore
    </a>
    <a class="item">
      <i class="write icon"></i>
      Answer
    </a>
      <div tabindex="0" class="ui dropdown item">
        <i class="alarm icon"></i> Notifikasi <div class="ui mini basic green label">22</div>
        <div tabindex="0" class="ui menu list" style="max-height:485px !important;overflow-y:auto !important;overflow-x:hidden !important;">
        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('uploads/images'); ?>/<?php echo $this->session->userdata('image'); ?>">
          <div class="content">
            <a class="header">Lindsay</a>
            <div class="description">Last seen watching <a><b>Bob's Burgers</b></a> 10 hours ago.</div>
          </div>
        </div>

        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('lib'); ?>/anez.jpg">
          <div class="content">
            <a class="header">Matthew</a>
            <div class="description">Last seen watching <a><b>The Godfather Part 2</b></a> yesterday. &nbsp;&nbsp;&nbsp;</div>
          </div>
        </div>
        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('lib'); ?>/anez.jpg">
          <div class="content">
            <a class="header">Jenny Hess</a>
            <div class="description">Last seen watching <a><b>Twin Peaks</b></a> 3 days ago.</div>
          </div>
        </div>
        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('lib'); ?>/anez.jpg">
          <div class="content">
            <a class="header">Veronika Ossi</a>
            <div class="description">Has not watched anything recently</div>
          </div>
        </div>
        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('lib'); ?>/anez.jpg">
          <div class="content">
            <a class="header">Matthew</a>
            <div class="description">Last seen watching <a><b>The Godfather Part 2</b></a> yesterday. &nbsp;&nbsp;&nbsp;</div>
          </div>
        </div>
        <div class="item">
          <img class="ui avatar image" src="<?php echo base_url('lib'); ?>/anez.jpg">
          <div class="content">
            <a class="header">Jenny Hess</a>
            <div class="description">Last seen watching <a><b>Twin Peaks</b></a> 3 days ago.</div>
          </div>
        </div>
        </div>

      </div>
    <a class="item">
      <i class="users icon"></i>
      Friends
    </a>

<div tabindex="0" class="ui dropdown item" style="font-weight:bold;">
  <img src="<?php echo base_url('uploads/images'); ?>/<?php echo $this->session->userdata('image'); ?>" alt="Your Profile Picture">&nbsp;
  <?php echo $this->session->userdata('first_name'); ?> <i class="dropdown icon"></i>
  <div tabindex="-1" class="menu">
      <a href="<?php echo base_url('profile'); ?>/<?php echo $this->session->userdata('username'); ?>" class="item">
        <i class="user icon"></i>
        Profile
      </a>
      <a href="<?php echo base_url('my-post'); ?>" class="item">
        <i class="write icon"></i>
        Posts
      </a>
      <div class="item">
        <i class="inbox icon"></i>
          <span class="description">26</span> 
        Pesan
      </div>
      <div class="divider"></div>
      <div class="item">
        <i class="setting icon"></i>
        Pengaturan Akun
      </div>
      <a href="<?php echo base_url('logout'); ?>" class="item">
        <i class="sign out icon"></i>
        Keluar
      </a>
  </div>
</div>

	  </div>
	</div>	
</div>
<?php } ?>

<?php if(!$this->ion_auth->logged_in() && $this->uri->segment(1) == 'profile'){ ?>
<div class="ui pointing fixed borderless menu" style="border-top:0px solid #FFFFFF;">
  <div class="ui container">
    <a class="active item">
      <i class="home icon"></i>
      Beranda
    </a>

    <div class="right menu">
      <a href="<?php echo base_url(); ?>" class="item" style="font-weight:bold;">
        Signup
      </a>
      <a href="<?php echo base_url(); ?>" class="item" style="font-weight:bold;">
        Login
      </a>
    </div>
  </div>  
</div>
<?php } ?>

<?php if(!$this->ion_auth->logged_in() && $this->uri->segment(1) == 'read'){ ?>
<div class="ui pointing fixed borderless menu" style="border-top:0px solid #FFFFFF;">
  <div class="ui container">
    <a class="item">
      <i class="home icon"></i>
      Beranda
    </a>
    <a class="active item">
      <i class="newspaper icon"></i>
      Read
    </a>

    <div class="right menu">
      <a href="<?php echo base_url(); ?>" class="item" style="font-weight:bold;">
        Signup
      </a>
      <a href="<?php echo base_url(); ?>" class="item" style="font-weight:bold;">
        Login
      </a>
    </div>
  </div>  
</div>
<?php } ?>