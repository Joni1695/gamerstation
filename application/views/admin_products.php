<?php if($this->session->flashdata('deletefail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('deletefail'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('deletesuccess')) : ?>
<div class="alert alert-success">
  <?php echo $this->session->flashdata('deletesuccess'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('updatesuccess')) : ?>
<div class="alert alert-success">
  <?php echo $this->session->flashdata('updatesuccess'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('updatefail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('updatefail'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('badext')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('badext'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('createsuccess')) : ?>
<div class="alert alert-success">
  <?php echo $this->session->flashdata('createsuccess'); ?>
</div>
<?php endif; ?>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<div class="col-md-12 games">
  <table class="table table-striped table-hover mytable table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>
          Description
        </th>
        <th>
          Price
        </th>
        <th>
          Trailer Video
        </th>
        <th>
          Created At
        </th>
        <th>
          Sales
        </th>
        <th>
          Rating
        </th>
      </tr>
    </thead>
    <tbody>
    <?php if(sizeof($products)==0) echo '<div class="alert alert-info">There are no games that fit your criteria.</div>'; else for($i=0;$i<sizeof($products);$i++) :?>
      <tr class="gamerow" data-id="<?php echo $products[$i]->id; ?>">
        <td>
          <?php echo $products[$i]->title; ?>
        </td>
        <td>
          <?php $products[$i]->description = (strlen($products[$i]->description) > 100) ? substr($products[$i]->description,0,100).'...' : $products[$i]->description; echo $products[$i]->description; ?>
        </td>
        <td>
          <?php echo $products[$i]->price; ?>
        </td>
        <td>
          <?php echo $products[$i]->trailer_video; ?>
        </td>
        <td>
          <?php echo $products[$i]->created_at; ?>
        </td>
        <td>
          <?php if($products[$i]->qty==NULL) echo "No Sales"; else echo $products[$i]->qty; ?>
        </td>
        <td>
          <?php if($ratings[$i][0]->rating==NULL) echo "No Rating"; else echo $ratings[$i][0]->rating; ?>
        </td>
      </tr>
    <?php endfor; ?>
    </tbody>
  </table>
</div>


</div>

<div class="modal fade" id="GameModal" tabindex="-1" role="dialog" aria-labelledby="GameModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input class="mymodal-title name nothing editable"></input>
            </div>
            <div class="modal-body">
              <span class="greentext">Description: </span><textarea class="desc nothing editable"></textarea>
              <hr>
              <label for="categories">Select Categories</label>
              <select multiple="" name="categories[]" id="categories_product" form="formaime" class="form-control">
                  <?php foreach(get_categories_h() as $category): ?>
                  <option><?php echo $category->name; ?></option>
                  <?php endforeach; ?>
              </select>
              <hr>
              <label for="categories">Select Platforms</label>
              <select multiple="" name="platforms[]" id="platforms_product" form="formaime" class="form-control">
                <?php foreach(get_platforms_h() as $platform): ?>
                <option><?php echo $platform->name; ?></option>
                <?php endforeach; ?>
              </select>
              <hr>
              <span class="greentext">Trailer: </span><input type="text" class="trailer nothing editable"><br>
              <span class="game_sale"></span><br>
              <span class="game_rating"></span><br>
              <span class="greentext">Price: $</span><input type="text" class="price nothing editable"><hr>
              <img class="game_image1" src="" alt="NoImage" />
            </div>
            <div class="modal-footer">
                <form id="formaime" action="<?php echo base_url(); ?>adminpanel/delUpGame" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="game_id" name="id" value="">
                    <input type="hidden" id="game_name" name="name" value="">
                    <input type="hidden" id="game_desc" name="desc" value="">
                    <input type="hidden" id="game_trailer" name="trailer" value="">
                    <input type="hidden" id="game_price" name="price" value="">
                    <input type="file" class="hide" id="game_image1" name="image1">


                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete_game" class="btn btn-default btn-danger pull-left delete_game" value="notempty">Delete</button>
                    <button type="submit" name="update_game" class="btn btn-default btn-success save_game" value="notempty">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.gamerow').click(function(){
      $.post('<?php echo base_url(); ?>adminService/getGameData',{game_id : $(this).data('id')},function(data){
        var response=$.parseJSON(data);
        console.log(response);
        if(response.type=='success'){
          $('#game_image1').val('');
          $('#game_id').val(response.product[0].id);
          $('#game_name').val(response.product[0].title);
          $('#game_desc').val(response.product[0].description);
          $('#game_trailer').val(response.product[0].trailer_video);
          $('#game_price').val(response.product[0].price);

          $('.name').val(response.product[0].title);
          $('.desc').val(response.product[0].description);
          $('.trailer').val(response.product[0].trailer_video);
          $('.price').val(response.product[0].price);
          $('.game_sale').html('<span class="greentext">Sales: </span>'+response.product[0].qty);
          $('.game_rating').html('<span class="greentext">Rating: </span>'+parseFloat(response.rating[0].rating).toFixed(2));
          $('.game_image1').attr('src','<?php echo base_url(); ?>'+response.product[0].gameImagePath);

          $('#GameModal').modal('toggle');
        } else{
          $('#msg-outer').html('<div class="alert alert-danger">'+response.msg+'</div>');
        }
      });

    });

    $('.editable').change(function(){
      var selector='';
      if($(this).attr('class').indexOf('name')>-1) selector='input[name="name"]';
      else if($(this).attr('class').indexOf('desc')>-1) selector='input[name="desc"]';
      else if($(this).attr('class').indexOf('trailer')>-1) selector='input[name="trailer"]';
      else if($(this).attr('class').indexOf('price')>-1) selector='input[name="price"]';
      $(selector).val($(this).val());
    });



    $('.game_image1').click(function(){
      $('#game_image1').trigger('click');
    });
    var gamearray=[
      <?php foreach($products as $a): ?>
      {
        value:"<?php echo $a->id;?>",
        label:"<?php echo $a->title; ?>"
      },
      <?php endforeach; ?>
    ];
    $('#search').autocomplete({
      source : gamearray,
      select : function(event,ui){
        $.post('<?php echo base_url(); ?>adminService/getGameData',{game_id : ui.item.value},function(data){
          var response=$.parseJSON(data);
          console.log(response);
          if(response.type=='success'){
            $('#game_image1').val('');
            $('#game_id').val(response.product[0].id);
            $('#game_name').val(response.product[0].title);
            $('#game_desc').val(response.product[0].description);
            $('#game_trailer').val(response.product[0].trailer_video);
            $('#game_price').val(response.product[0].price);

            $('.name').val(response.product[0].title);
            $('.desc').val(response.product[0].description);
            $('.trailer').val(response.product[0].trailer_video);
            $('.price').val(response.product[0].price);
            $('.game_sale').html('<span class="greentext">Sales: </span>'+response.product[0].qty);
            $('.game_rating').html('<span class="greentext">Rating: </span>'+parseFloat(response.rating[0].rating).toFixed(2));
            $('.game_image1').attr('src','<?php echo base_url(); ?>'+response.product[0].gameImagePath);

            $('#GameModal').modal('toggle');
          } else{
            $('#msg-outer').html('<div class="alert alert-danger">'+response.msg+'</div>');
          }
        });
      }
    });
  });
</script>

</body>
</html>
