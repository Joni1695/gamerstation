<?php if($this->session->flashdata('editfail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('editfail'); ?>
</div>
<?php endif; ?>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<div class="content">
     <div class="register">
  <form action="<?php echo base_url().'profile' ?>" method="POST">
 <div class="register-top-grid">
  <h3>Personal Information</h3>
   <div>
    <span>First Name<label>*</label></span>
    <input type="text" value="<?php echo $user->first_name; ?>" name="first_name">
   </div>
   <div>
    <span>Last Name<label>*</label></span>
    <input type="text" value="<?php echo $user->last_name; ?>" name="last_name">
   </div>
   <div>
     <span>Username<label>*</label></span>
     <input type="text" value="<?php echo $user->username; ?>" name="username">
   </div>
    <div>
     <span>Email Address<label>*</label></span>
     <input type="text" value="<?php echo $user->email; ?>" name="email">
   </div>
</div>
     <div class="register-bottom-grid">
       <div>
        <span>Password<label>*</label></span>
        <input class="inputlog" type="password" name="password">
       </div>
       <div>
        <span>Confirm Password<label>*</label></span>
        <input type="password" class="inputlog" name="password2">
       </div>
       <div class="clearfix"> </div>
   </div>

<div class="clearfix"> </div>
<div class="register-but">
     <input type="submit" class="mybutton" value="submit">
     <div class="clearfix"> </div>
   </form>
</div>
</div>
   </div>
</div>
</div>
