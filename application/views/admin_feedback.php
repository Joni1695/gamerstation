<div class="col-lg-12" id="msg-outer">
  <?php if(sizeof($feedback)==0) echo '<div class="alert alert-info">There are no new feedback.</div>';?>
</div>
<?php  if(sizeof($feedback)!=0) foreach($feedback as $feed) :?>
  <div class="col-lg-4">
    <div class="panel panel-mycolor">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $feed->name; ?><i class="fa fa-times-circle pull-right delete_feedback" data-id="<?php echo $feed->id; ?>" aria-hidden="true"></i></h3>

      </div>
      <div class="panel-body">
        <span style="color:white;">Contact:</span> <?php echo $feed->contact; ?><br>
        <span style="color:white;">Description:</span> <?php echo $feed->text; ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete_feedback').click(function(){
      var ori=$(this);
      $.post('<?php echo base_url(); ?>adminService/delete',{feedback_id: $(this).data('id')},function(data){
        var response=$.parseJSON(data);
        var string='<div class="alert alert-';
        if(response.type=='success') string=string+'success">'+response.msg+'</div>';
        else string=string+'danger">'+response.msg+'</div>';
        $('#msg-outer').html(string);
        ori.parent().parent().parent().parent().slideUp();
      });
    });
  });
</script>
</body>
</html>
