<?php if($this->session->flashdata('changesuccess')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('changesuccess'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('changefail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('changefail'); ?>
</div>
<?php endif; ?>
  <div class="col-md-12">
    <?php foreach($products as $product) : ?>
    <div class="col-md-12">
      <div class="panel panel-default panel-mycolor">
        <div class="panel-heading">
          <h3><?php echo $product->title; ?></h3><button type="button" onclick="changeGame(<?php echo $product->product_id; ?>)" class="btn btn-default btn-warning"> Change Game</button>
        </div>
        <div class="panel-body">
          <img class="game_image_first" src="<?php echo base_url().$product->gameImagePath; ?>" alt="" />

        </div>
      </div>

    </div>
  <?php endforeach; ?>

  </div>
</div>

<div class="modal fade" id="GameModal" tabindex="-1" role="dialog" aria-labelledby="GameModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Select the game from the list below</h3>
            </div>
            <div class="modal-body">
              <form class="myform" action="<?php echo base_url(); ?>adminpanel/changeFirstPage" method="post">
                <?php echo echocsrf_html(); ?>
                <input type="hidden" name="oldValue">
                <select name="newValue" class="myselect">
                  <?php $i=1; foreach($changeproducts as $p) :?>
                    <option value="<?php echo $p->id; ?>"><?php echo $i.' | '.$p->title; $i++;?></option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-default btn-success" name="button"> Save </button>
              </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function changeGame(id){
      $('input[name="oldValue"]').val(id);
      $('#GameModal').modal('toggle');
  }
</script>
</body>
</html>
