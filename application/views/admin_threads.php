<div class="col-md-12">
  <table class="table table-striped table-hover mytable">
    <thead>
      <tr>
        <th>
          Nr.report
        </th>
        <th>
          Username
        </th>
        <th>
          Game
        </th>
        <th>
          Thread Title
        </th>
        <th>
          Thread Description
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($threads as $t): ?>
        <tr>
          <td>
            <?php echo $t->num_report; ?>
          </td>
          <td>
            <?php echo $t->username; ?>
          </td>
          <td>
            <?php echo $t->products; ?>
          </td>
          <td>
            <?php echo $t->title; ?>
          </td>
          <td>
            <?php echo $t->desc; ?>
          </td>
          <td>
            <div class="btn-group-vertical">
              <button type="button" class="btn btn-default btn-primary reset" data-id='<?php echo $t->id; ?>'>Reset</button>
              <button type="button" class="btn btn-default btn-warning del" data-id='<?php echo $t->id; ?>'>Delete Thread</button>
              <button type="button" class="btn btn-default btn-danger delban" data-id='<?php echo $t->id; ?>' data-userid='<?php echo $t->user_id; ?>'>Delete And Ban User</button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.reset').click(function(){
      $.post('<?php echo base_url(); ?>adminService/resetReport',{thread_id: $(this).data('id'),<?php echo echocsrf_js(); ?>},function(data){
        document.location.href=document.location.href;
      });
    });
    $('.del').click(function(){
      $.post('<?php echo base_url(); ?>adminService/deleteThread',{thread_id: $(this).data('id'),<?php echo echocsrf_js(); ?>},function(data){
        document.location.href=document.location.href;
      });
    });
    $('.delban').click(function(){
      $.post('<?php echo base_url(); ?>adminService/delbanThread',{thread_id: $(this).data('id'),user_id: $(this).data('userid'),<?php echo echocsrf_js(); ?>},function(data){
        document.location.href=document.location.href;
      });
    });
  });
</script>
