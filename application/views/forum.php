<div class="content">
  <div class="col-md-9">
    <input type="text" class="searchforum" placeholder="Search...    ">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="forumgametitle">Forum</h2>

      </div>
      <div class="panel-body">
        <table class="table table-hover">
          <tbody>
            <?php for($i=0;$i<sizeof($products);$i++) :?>
            <tr class="forumrow" data-id='<?php echo $products[$i]->id; ?>'>
              <td><img src="<?php echo base_url().$products[$i]->gameImagePath; ?>" class="forumgameimage" alt=""></td>
              <td class="forumgametitle"><?php echo $products[$i]->title; ?></td>
              <td class="forumgamelast"><br><span class="bold">Last Activity: </span><span class="time"><?php if($threads[$i]!=null) echo time_since(strtotime($threads[$i][0]->created_at)); else echo 'No activity';?></span><br>
                <?php if($threads[$i]!=null) :?><i class="fa fa-bookmark" aria-hidden="true"></i><a href="<?php echo base_url().'thread/'.$threads[$i][0]->id; ?>"> <?php echo $threads[$i][0]->title; ?></a> by <span class="forumgameuser"><?php echo $threads[$i][0]->username; ?></span><?php endif; ?>
              </td>
            </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="forumgametitle">Recent Activity</h4>
      </div>
      <div class="panel-body">
        <ul class="recentlist">
          <?php foreach($recent as $r) :?>
          <li><i class="fa fa-bookmark" aria-hidden="true"><a href="<?php echo base_url().'thread/'.$r->id; ?>"></i> <?php echo $r->title; ?></a> by <span class="forumgameuser"><?php echo $r->username; ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="clearfix"> </div>
  <?php echo $links; ?>
</div>
<script type="text/javascript">
  var offset=0;
  var gamearray=[
    <?php foreach($autocomplete as $a): ?>
    {
      value:"<?php echo $a->id;?>",
      label:"<?php echo $a->title; ?>"
    },
    <?php endforeach; ?>
  ];
  $('.searchforum').autocomplete({
    source : gamearray,
    select : function(event,ui){
      document.location.href="<?php echo base_url(); ?>"+"Products/forumgame/"+ui.item.value;
    }
  });
  $('.forumrow').click(function(){
    document.location.href="<?php echo base_url().'Products/forumgame/'; ?>"+$(this).data('id');
  });
</script>
