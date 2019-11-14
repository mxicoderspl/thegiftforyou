<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php if (isset($title)) { echo $title;  } ?></title>
        <link href="<?php echo base_url(); ?>assets/plugins/morris/morris.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url('../');?>images/sm-logo.png" type="image/x-icon"/>
	<link href="<?php echo base_url(); ?>/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel='stylesheet' type='text/css'>     
	 <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
	
	</head>
    
    <body class="fixed-left">
<div id="wrapper">
  <div class="topbar">
    <div class="topbar-left">
      <div class="text-center"> 
          <!--<a href="<?php echo base_url();?>"><img style="height:74px;min-width:235px" src="<?php echo base_url('../admincp/assets/images/imageslogo.png'); ?>" alt="thegiftsforyou" class="logo" width="200px"></a>-->
		<h3 class="text-center m-t-0 m-b-15"> 
                        <a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url()?>../images/logo.png" style="height: 35px;"/></a>
                    </h3>
         <a href="index.html" class="logo-sm"><img src="<?php echo base_url()?>../images/sm-logo.png" style="height: 24px;"/></a>
      </div>
    </div>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="">
          <div class="pull-left">
            <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button>
            <span class="clearfix"></span></div>
          <form class="navbar-form pull-left" role="search">
           
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
          </form>
          <ul class="nav navbar-nav navbar-right pull-right">
           
            <li class="hidden-xs"> <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"> <img src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> <span class="profile-username"> <?php echo $user_name; ?> <br/>
              </span> </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('dashboard/editProfile'); ?>" data-toggle="modal" data-target="#edt_profile" title="Profile"> Profile</a></li>
		<li><a href="<?php echo site_url('Security'); ?>"> Setting</a></li>
		
                <li><a href="#" data-target="#chng_psw" data-toggle="modal" >Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('dashboard/logout'); ?>" data-target="<?php echo site_url('logout'); ?>"> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
 
    
  
        
