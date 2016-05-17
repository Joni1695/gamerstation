<div class="col-md-12">
  <table class="table table-striped table-hover mytable table-bordered">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>
          Username
        </th>
        <th>
          Email
        </th>
        <th>
          Status
        </th>
        <th>
          Banned
        </th>
        <th>
          Join Date
        </th>
      </tr>
    </thead>
    <tbody>
    <?php if(sizeof($users)==0) echo '<div class="alert alert-info">There are no games that fit your criteria.</div>'; else for($i=0;$i<sizeof($users);$i++) :?>
      <tr class="gamerow" data-id="<?php echo $users[$i]->id; ?>">
        <td>
          <?php echo $users[$i]->first_name; ?>
        </td>
        <td>
          <?php echo $users[$i]->last_name; ?>
        </td>
        <td>
          <?php echo $users[$i]->username; ?>
        </td>
        <td>
          <?php echo $users[$i]->email; ?>
        </td>
        <td>
          <?php echo $users[$i]->status; ?>
        </td>
        <td>
          <?php echo $users[$i]->banned; ?>
        </td>
        <td>
          <?php echo $users[$i]->join_date; ?>
        </td>
      </tr>
    <?php endfor; ?>
    </tbody>
  </table>
</div>
</div>

<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="GameModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="username"></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default btn-danger pull-left ban">Ban</button>
                <button type="submit" class="btn btn-default btn-success changestatus">Status Change</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('.gamerow').click(function(){
    var id=$(this).data('id');
    $.post('<?php echo base_url(); ?>adminService/getUserData',{user_id: id},function(data){
      var response=$.parseJSON(data);
      $('.username').text(response.user[0].username);
      if(response.user[0].banned=='N') $('.ban').text('Ban');
      else $('.ban').text('Unban');
      $('.ban').attr('data-id',id);
      $('.changestatus').attr('data-id',id);
    });
    $('#UserModal').modal('toggle');
  });
  $('.ban').click(function(){
    $.post('<?php echo base_url(); ?>adminService/banUser',{user_id: $(this).data('id')},function(data){
      document.location.href="<?php echo base_url().'adminpanel/users'; ?>";
    });
  });
  $('.changestatus').click(function(){
    $.post('<?php echo base_url(); ?>adminService/changeUser',{user_id: $(this).data('id')},function(data){
      document.location.href="<?php echo base_url().'adminpanel/users'; ?>";
    });
  });
  var gamearray=[
    <?php foreach($users as $a): ?>
    {
      value:"<?php echo $a->id;?>",
      label:"<?php echo $a->username; ?>"
    },
    <?php endforeach; ?>
  ];
  $('#search').autocomplete({
    source : gamearray,
    select : function(event,ui){
      $.post('<?php echo base_url(); ?>adminService/getUserData',{user_id: ui.item.value},function(data){
        var response=$.parseJSON(data);
        $('.username').text(response.user[0].username);
        if(response.user[0].banned=='N') $('.ban').text('Ban');
        else $('.ban').text('Unban');
        $('.ban').attr('data-id',ui.item.value);
        $('.changestatus').attr('data-id',ui.item.value);
      });
      $('#UserModal').modal('toggle');
    }
  });
</script>
</body>
</html>
