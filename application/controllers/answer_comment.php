<?php foreach($comments as $comment){ ?>
  <div class="comment">
    <a class="avatar">
      <img src="Comment%20_%20Semantic%20UI_files/elliot.jpg">
    </a>
    <div class="content">
      <a class="author">Elliot Fu</a>
      <div class="metadata">
        <span class="date">Yesterday at 12:30AM</span>
      </div>
      <div class="text">
        <p>This has been very useful for my research. Thanks as well!</p>
      </div>
      <div class="actions">
        <a class="reply" reply-id="<?php echo $comment->ckey; ?>" status="N">Reply</a>
      </div>
    </div>
    <div class="comments" reply-show="<?php echo $comment->ckey; ?>" style="display:none;">

    </div>
  </div>
<?php } ?>
  <script type="text/javascript">
$("[reply-id]").each(function (){
  $(this).click(function () {
      var data = $(this).attr("reply-id");
      background(16,1,data);
  });
});
  </script>