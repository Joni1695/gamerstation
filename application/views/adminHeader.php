<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GamerStation</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/local.css" />

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />
    <link href="<?php echo base_url(); ?>jquery-autocomplete/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="<?php echo base_url(); ?>jquery-autocomplete/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>
</head>
<body>
    <div id="wrapper">
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>adminpanel">Admin Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li <?php if($active=='admin_dashboard') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                    <li <?php if($active=='admin_products') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/products"><i class="fa fa-gamepad"></i> Products</a></li>
                    <li <?php if($active=='admin_users') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/users"><i class="fa fa-users"></i> Users</a></li>
                    <li <?php if($active=='admin_landing') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/landing"><i class="fa fa-home"></i> Landing Page</a></li>
                    <li <?php if($active=='admin_orders') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/orders"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                    <li <?php if($active=='admin_feedback') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/feedback"><i class="fa fa-rss"></i> Feedback</a></li>
                    <li <?php if($active=='admin_threads') echo 'class=\'selected\''; ?>><a href="<?php echo base_url(); ?>adminpanel/threads"><i class="fa fa-book"></i> Reported Threads</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username'); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Return to Page</a></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <?php if($active=='admin_products' || $active=='admin_users') :?>
                      <li>
                          <form class="navbar-search">
                              <input type="text" id="search" placeholder="Search" class="form-control">
                          </form>
                      </li>
                    <?php endif;?>
                    <?php if($active=='admin_products') : ?>
                      <li>
                        <a href="<?php echo base_url(); ?>adminpanel/createGame" class="btn btn-default btn-danger">Create Game</a>
                      </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
