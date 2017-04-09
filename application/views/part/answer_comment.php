<?php foreach($comments as $comment){ ?>
<?php 
  $profile = $this->db->query("SELECT * FROM users WHERE username='$comment->username' LIMIT 1;")->row();
?>
  <div class="comment">
    <a class="avatar">
      <img src="<?php echo $isrc; ?><?php echo $profile->image; ?>">
    </a>
    <div class="content">
      <a class="author"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a>
      <div class="metadata">
        <span class="date" blurbs-date="<?php echo date('M d, Y H:i:s', strtotime($comment->date)); ?>"></span>
      </div>
      <div class="text">
        <p><?php echo $comment->content; ?></p>
      </div>
      <div class="actions">
        <a class="reply" reply-id="<?php echo $comment->ckey; ?>" status="N">Reply</a>
        <?php if($comment->username == $this->session->userdata('username')){ ?>
        <a class="reply" delete-id="<?php echo $comment->ckey; ?>">Delete</a>
        <?php } ?>
      </div>
    </div>
    <div class="comments" reply-show="<?php echo $comment->ckey; ?>">

    </div>
  </div>
<?php } ?>
  <script type="text/javascript">
$('[blurbs-date]').blurbs_date({
    ago: ' Detik Yang Lalu',
    minute: ' menit yang lalu',
    hours: ' Jam Yang Lalu',
    ytd: ' Kemarin Pada Pukul ',
    day: ' Hari Yang Lalu',
    server: ''
});
$("[reply-id]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("reply-id");
      background(16,1,data);
  });
});
  </script>