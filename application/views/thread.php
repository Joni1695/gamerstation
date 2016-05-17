<div class="content">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h2 class="forumgametitle"><?php echo $thread[0]->title; ?></h2>
          <button type="button" data-id="<?php echo $thread[0]->id; ?>" class="btn btn-default btn-danger pull-right report">Report</button>
      </div>
      <div class="panel-body">
        <p><?php echo $thread[0]->desc; ?></p><hr>
        <p>
          <span class="bold pull-left">Posted by: </span>
          <span class="forumgameuser pull-left" style="margin-left:5px;">
            <?php echo $thread[0]->username; ?>
          </span>
          <?php if($thread[0]->username==$this->session->userdata('username') || $this->session->userdata('status')=='admin') :?>
            <span style="margin-left:5px;" class="action pull-left">| <i data-id="<?php echo $thread[0]->id; ?>" class="edited">Edit</i></span>
            <span style="margin-left:5px;" class="action pull-left delete"><i data-id="<?php echo $thread[0]->id; ?>" class="delete">Delete</i></span>
          <?php endif; ?>
          <span class="time pull-right">
            <?php echo time_since(strtotime($thread[0]->created_at));?>
          </span>
        </p><br><br>
        <div id="disqus_thread"></div>
        <script>
        var disqus_config = function () {
            this.page.title = "<?php echo $thread[0]->title;?>";
        };
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//gamerstation123.disqus.com/embed.js';

        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
      </div>
    </div>
  </div>
  <div class="clearfix"> </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete').click(function(e){
      document.location.href="<?php echo base_url().'deleteThread/'; ?>"+$(this).data('id');
      e.stopPropagation();
    });
    $('.report').click(function(){
      $.post('<?php echo base_url(); ?>reportThread',{thread_id: $(this).data('id')},function(data){});
    });
    $('.edit').click(function(e){
      document.location.href="<?php echo base_url().'editThread/'; ?>"+$(this).data('id');
      e.stopPropagation();
    });
  });
</script>
<script id="dsq-count-scr" src="//gamerstation123.disqus.com/count.js" async></script>
