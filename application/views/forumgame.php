<div class="content">
  <div class="col-md-10">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="forumgametitle"><?php echo $product[0]->title; ?></h2>

      </div>
      <div class="panel-body">
        <?php if(sizeof($threads)!=0) :?>
        <table class="table table-hover">
          <tbody>
            <?php foreach($threads as $th) :?>
            <tr class="forumrow" data-id='<?php echo $th->id; ?>'>
              <td class="forumgametitle"><?php echo $th->title; ?></td>
              <td class="forumgamelast"><br><span class="bold">Created at: </span><span class="time"><?php echo time_since(strtotime($th->created_at));?></span><br><span class="bold">Created by: <span class="forumgameuser"> <?php echo $th->username; ?></span></span></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else : ?>
          <p>
            Seems like no body has created any thread so far. You can create your own by clicking the button to the side.
          </p>
          <br><br><br><br><br>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <button type="button" class="btn btn-default btn-warning btn-lg add">Add Thread</button>
  </div>
  <div class="clearfix"> </div>
  <?php echo $links; ?>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="GameModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1>Create Thread</h1>
            </div>
            <div class="modal-body">
              <span class="greentext">Title: </span><input type="text" class="title"><hr>
              <span class="greentext">Description: </span><textarea class="desc"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-success post">Post</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('.forumrow').click(function(){
    document.location.href="<?php echo base_url().'thread/'; ?>"+$(this).data('id');
  });
  $('.add').click(function(){
    $('#createModal').modal('toggle');
  });
  $('.post').click(function(){
    if($('.title').val().trim()!='' && $('.desc').val().trim()!='') $.post('<?php echo base_url(); ?>createThread',{
      thread_title: $('.title').val().trim(),
      thread_desc: $('.desc').val().trim(),
      game_id: <?php echo $product[0]->id; ?>,
      <?php echo echocsrf_js();?>
    },function(data){
      alert('Thread was succesfully added.');
      location.reload();
    });
  });
</script>
