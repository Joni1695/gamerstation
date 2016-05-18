<?php if($this->session->flashdata('fail_login')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('fail_login'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('ban_login')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('ban_login'); ?>
</div>
<?php endif; ?>
<div class="content">
     <div class="register">
 <div class="col-md-6 login-left">
   <h3>Don't have an account? Please Signup</h3>
 <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
 <a class="acount-btn" href="<?php echo base_url().'signup' ?>">Create an Account</a>
 </div>
 <div class="col-md-6 login-right">
  <h3>Login</h3>
<form action="<?php echo base_url().'login' ?>" method="POST">
  <?php echo echocsrf_html(); ?>
  <div>
  <span>Username<label>*</label></span>
  <input class="inputlog" type="text" name="username">
  </div>
  <div>
  <span>Password<label>*</label></span>
  <input class="inputlog" type="password" name="password">
  </div>
  <input type="submit" value="Login">
  </form>
 </div>
 <div class="clearfix"> </div>
 </div>
   </div>
</div>
</div>
