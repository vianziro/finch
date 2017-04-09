<div class="ui form" style="margin-top:-15px;">
    <div class="ui right icon tiny fluid input">
      <input placeholder="Tekan Enter Untuk Mengirim Komentar." type="text" reply-form="<?php echo $key; ?>" id="c<?php echo $key; ?>">
      <i class="send icon"></i>
    </div>
</div>
<?php foreach($replys as $reply){ ?>
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$reply->username' LIMIT 1;")->row();
?>
      <div class="comment">
        <a class="avatar">
          <img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
        </a>
        <div class="content">
          <a class="author" href="<?php echo base_url('profile'); ?>/<?php echo $profile->username; ?>"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
          <div class="metadata">
            <span blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($reply->date)); ?>"></span>
          </div>
          <div class="text">
            <?php echo $reply->content; ?>
          </div>
      <div class="actions">
        <?php if($reply->username == $this->session->userdata('username')){ ?>
        <a class="reply" delete-id="<?php echo $reply->ckey; ?>">Delete</a>
        <?php } ?>
      </div>
        </div>
      </div>
  <?php } ?>
<script type="text/javascript">
$("[reply-form]").each(function (){
  $(this).keypress(function (e) {
      if(e.which == 13)
      {
        var data = $(this).attr("reply-form")
        ,   cont = $("#c"+data).val();
        background(15,1,data,cont);
      }
  });
});
</script>