<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo (isset($title)) ? $title : $site_name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="icon" href="<?php echo base_url(); ?>images/sm-logo.png" type="image/x-icon"/>
        <?php
        $this->minify->css(array('bootstrap.min.css', 'icons.css', 'jquery.dataTables.css', 'datepicker.css'));
        echo $this->minify->deploy_css();
        ?>
        <?php
        $this->minify->css(array('style.css'), 'main');
        echo $this->minify->deploy_css();
        ?>
        <style>
/*            .nav{
                margin-top:-7px;
                margin-left: 93%;
            }*/
.badge-notify{
   background:red;
   position:absolute;
   top:3px;
   
  }

        </style>
    </head>
    <body class="fixed-left layout2 cstm-page">
        <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left">
                    <div class="text-center"> 
                            <h3 class="text-center m-t-0 m-b-15" style="margin-top: 15px" > 
                                <a href="<?php echo site_url('Home')?>" class="logo"><img class="img-responsive logo-l" src="<?php echo base_url() ; ?>images/logo.png"></a>
                            </h3>
<a href="<?php echo site_url('Dashboard');?>" class="logo-sm"><img src="<?php echo base_url()?>images/sm-logo.png" /></a>
                            <!--<img src="<?php echo base_url(); ?>userdash/assets/images/logo.png"></a> <a class="logo-sm" href=""><img class="img-responsive bt-icon" src="<?php echo base_url(); ?>userdash/assets/images/logo-sm.png"></a>--></div>
                </div>
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button>
                                <span class="clearfix"></span>
                            
                            </div>
                            <div class="">
                                
                                <nav class="pull-right">
                                   
                                    <ul class="nav navbar-nav ">
                                        <li class="rf" style=" padding-top: 14px"     >
                                            <div class="container">
  <button class="btn btn-default btn-lg btn-link" >
   <i class="fa fa-bell "></i>
  </button>
                                                <span class="badge badge-notify pull-right   "  style=" padding-left: 5px" >3</span>
</div>
                                        </li> 
                                        <li class="dropdown">
					    
                                            <a href="#" title="<?php //echo $logged_use['email']; ?>" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"> <img src="<?php echo base_url(); ?>assets/images/user6.jpeg" alt="user-img" class="img-circle" /><span class="referer_code"> <?php echo ucfirst($logged_use['firstname']).' '.ucfirst($logged_use['lastname']); ?></span>
                                            </a> 
                                            <ul class="dropdown-menu" >
                                                <?php if (!empty($bank_detail)) { ?>
                                                   <li><a href="<?php echo site_url('Bankdetail/index'); ?>"> Bank Detail</a></li>
                                                   
                                                    <?php } ?>
						   <li><a href="<?php echo site_url('Changepassword/index'); ?>">Change <br/> Password</a></li>	
						    <li><a href="<?php echo site_url('Profile'); ?>">My Profile</a></li>
						   <li class="divider"></li>

                                                <li><a href="<?php echo site_url('Dashboard/logout'); ?>" data-target="<?php echo site_url('logout'); ?>"> Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
