<!DOCTYPE HTML>
<html>
<head>
<title>Gamerstation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>jquery-autocomplete/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>jquery-autocomplete/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url(); ?>assets/js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('feedback_success').slideUp();
    $('.feedback').click(function(){
      $('.feedback_error').html('');
      $('.feedback_error').attr('class','feedback_error hide');
      $('#feedbackModal').modal('toggle');
    });
    $('.send_feedback').click(function(){
      var error='';
      if($('#fb_name').val().trim()=='') error+='You have to input your name in order to post feedback.<br>';
      if($('#fb_message').val().trim()=='') error+='You have to input your message in order to post feedback.<br>';
      if($('#fb_contact').val().trim()=='') error+='You have to input your contact in order to post feedback.<br>';
      if(error!=''){
        $('.feedback_error').html(error);
        $('.feedback_error').attr('class','feedback_error show');
      } else{
        $.post('<?php echo base_url(); ?>postFeedback',{
          name: $('#fb_name').val().trim(),
          contact: $('#fb_contact').val().trim(),
          message: $('#fb_message').val().trim()
        },function(data){
          var response= $.parseJSON(data);
          if(response.type='success'){
            $('#feedbackModal').modal('toggle');
            $('.feedback_success').html(response.msg);
            $('.feedback_success').slideDown('slow');
          } else{
            $('.feedback_error').html(response.msg);
            $('.feedback_error').attr('class','feedback_error show');
          }
        });
      }
    });
  });
</script>
</head>
<body>
<div class="container">

		<div class="header_top">
		    <div class="col-sm-3 logo"><a style="text-decoration: none !important; color: #107c10;" href="<?php echo base_url(); ?>"><h2>GamerStation</h2></a></div>
		    <div class="col-sm-6">
			  <ul class="ulime">
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="Games">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <img src="<?php echo base_url(); ?>assets/images/gamepad.png" width="32px">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <?php foreach(get_categories_h() as $category) :?>
              <li class="hovearble"><a href="<?php echo base_url().'Products/search/0?category='.$category->id.'&platform=&order=0&searchterm='; ?>"><?php echo $category->name; ?></a></li>
              <?php endforeach; ?>
              <li role="separator" class="divider"></li>
              <?php foreach(get_platforms_h() as $category) :?>
              <li class="hovearble"><a href="<?php echo base_url().'Products/search/0?category=&platform='.$category->id.'&order=0&searchterm='; ?>"><?php echo $category->name; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </span>
         </li>
         <li>
          <a href="<?php echo base_url().'Products/forum'; ?>"><span class="simptip-position-bottom simptip-movable" data-tooltip="Forum"><img src="<?php echo base_url(); ?>assets/images/forum-message.png" width="32px"></span></a>
         </li>
         <li>
          <div class="dropdown">

            <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class="simptip-position-bottom simptip-movable" data-tooltip="Shopping-Cart"><img src="<?php echo base_url(); ?>assets/images/shopping-cart.png" width="32px"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <form action="<?php echo base_url();?>cart/update" method="POST">
                <table class="table">
                  <li><thead class="cart-thead"><tr><th>Quantity</th><th colspan="9">Name</th><th>Price</th></tr></thead></li>
                  <tbody class="cart-tbody">
                  <?php $i=1;?>
                  <?php foreach($this->cart->contents() as $item) :?>
                    <input type="hidden" name="<?php echo $i.'[rowid]';?>" value="<?php echo $item['rowid'];?>"/>
                    <li><tr><td><input name="<?php echo $i.'[qty]';?>" type="text" size="6" value="<?php echo $item['qty'];?>"></td><td colspan="9"><?php echo $item['name'];?></td><td>$<?php echo $item['price'];?></td></tr></li>
                  <?php $i++;?>
                  <?php endforeach;?>
                    <li><tr class="cart-total"><td colspan="2" class="cart-total-td">Total</td><td colspan="9" class="cart-total-price">$<?php echo $this->cart->total();?></td></tr></li>
                  </tbody>
                </table>
              <li class="cart-shopping"><a href="<?php echo base_url();?>cart">View Shopping Cart</a></li>
              <li class="cart-move"><input type="submit" value="Update Cart"/></li>
              </form>
            </ul>
          </div>

         </li>
         </ul>
			</div>
			<div class="col-sm-3 header_right">
        <?php if($this->session->userdata('username')) :?>
        <div class="dropdown user">
         <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
           <?php echo $this->session->userdata('username'); ?>
           <span class="caret"></span>
         </button>
         <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
           <?php if($this->session->userdata('status')=='admin') :?><li><a href="<?php echo base_url().'adminpanel' ?>">Admin Panel</a></li><?php endif; ?>
           <li><a href="<?php echo base_url().'profile' ?>">Profile</a></li>
           <li><a href="<?php echo base_url().'mypurchases' ?>">My Purchases</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="<?php echo base_url().'logout' ?>">Log out</a></li>
         </ul>
        </div>
      <?php else: ?> <a href="<?php echo base_url().'login'; ?>" class="btn btn-default dropdown-toggle nothing pull-right">Sign in</a><?php endif; ?>
			</div>
			<div class="clearfix"> </div>

	      </div>
        <p class="feedback_success"></p>
        <div class="feedback">
          FeedBack
        </div>
        <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header mymodal-title">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Feedback</h4>
              </div>
              <div class="modal-body">
                <p>Tell us what you think of our page, suggestions, criticism, anything you'd like really.</p>
                <p class="feedback_error hide"></p>
                <hr>
                <div class="input-group">
                  <span class="input-group-addon fb_addon" id="basic-addon3">Your name:</span>
                  <input id="fb_name" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon fb_addon" id="basic-addon3">Your contact email:</span>
                  <input id="fb_contact" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon fb_addon" id="basic-addon3">Your message:</span>
                  <textarea id="fb_message" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-success send_feedback">Send feed</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
