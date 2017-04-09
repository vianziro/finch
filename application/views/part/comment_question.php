<?php foreach($c as $comment){ ?>
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$comment->username' LIMIT 1;")->row();
 ?>
  <div class="item"> <i style="float:right;font-style:normal;" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($comment->date)); ?>"></i>
    <img class="ui avatar image" src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
    <div class="content">
      <a class="header" href="<?php echo base_url('profile'); ?>/<?php echo $comment->username; ?>"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
      <?php echo $comment->content; ?>
    </div>
  </div>
<?php } ?>