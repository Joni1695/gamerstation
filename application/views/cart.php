<?php if($this->cart->contents()) :?>
<div class="content">
  <form action="<?php echo base_url();?>cart/process" method="POST">
  <?php echo echocsrf_html();?>
  <h2>Shopping Cart</h2>
  <table class="table table-striped table-hover mytable">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=0;?>
      <?php foreach($this->cart->contents() as $item) :?>
      <input type="hidden" name="item_name[<?php echo $i;?>]" value="<?php echo $item['name'];?>"/>
      <input type="hidden" name="item_code[<?php echo $i;?>]" value="<?php echo $item['id'];?>"/>
      <input type="hidden" name="item_qty[<?php echo $i;?>]" value="<?php echo $item['qty'];?>"/>
      <tr>
        <td><?php echo $item['name'];?></td>
        <td>$<?php echo $item['price'];?></td>
        <td><?php echo $item['qty'];?></td>
        <td>$<?php echo $item['qty']*$item['price'];?></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
      <tr>
        <td colspan='3'>
          Total:
        </td>
        <td>
          $<?php echo $this->cart->total();?>
        </td>
      </tr>
    </tbody>
  </table>
  <hr class="ourhr" style="margin: 50px 0 50px 0;">
  <?php if($this->session->userdata('logged_in')) :?>
  <h2>Shipping Info</h2>
    <div class="col-md-10 col-md-offset-1 login-right" >
      <div>
      <span>Adress<label>*</label></span>
      <input type="text" name="adress">
      </div>
      <div>
      <span>Adress2<label>*</label></span>
      <input type="text" name="adress2">
      </div>
      <div>
      <span>State<label>*</label></span>
      <input type="text" name="city">
      </div>
      <div>
      <span>City<label>*</label></span>
      <input type="text" name="state">
      </div>
      <div>
      <span>Zipcode<label>*</label></span>
      <input type="text" name="zipcode">
      </div>
      <input type="submit" value="Checkout">
    </div>
  </form>
  <?php else: ?>
    <div class="col-md-12">
      You have to login to purchase anything in our page.
    </div>
  <?php endif; ?>
  <div class="clearfix"></div><br><br><br>
</div>
</div>
</div>
<?php else : ?>
<div class="content">
  <p>
    Cart is empty. Add items to cart so they show up here.
  </p>
  <div class="clearfix"></div><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php endif; ?>
