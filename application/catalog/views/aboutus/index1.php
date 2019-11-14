
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
                <meta content="<?php echo $about_page[0]['meta_keywords'];?>" name="keywords">
                    <meta content="<?php echo $about_page[0]['meta_description'];?>" name="description">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="theme-color" content="#00AEEF" />
                            <title><?php echo $about_page[0]['pagetitle'];?></title>
			<link rel="icon" href="<?php echo base_url(); ?>images/sm-logo.png" type="image/x-icon"/>
                            <?php
                            $this->minify->css(array('bootstrap.min.css', 'fontawesome-all.css', 'style.css', 'animate.css'));
                            echo $this->minify->deploy_css();
                            ?>
                            <!-- Bootstrap CSSS -->
                            <!--<link rel="stylesheet" href="assetshome/css/bootstrap.min.css">
                             Custom CSSS 
                            <link rel="stylesheet" href="assetshome/css/style.css">
                             Custom CSSS 
                            <link rel="stylesheet" href="css/fontawesome-all.css">
                             Animation CSSS 
                            <link rel="stylesheet" href="assetshome/css/animation.css">
                             bx slider -->
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css">
                                </head>
                                <body>
                                    <!-- Loader -->
                                    <!--<div class="bg-all">
                                      <div class="sk-double-bounce">
                                        <div class="sk-child sk-double-bounce1"></div>
                                        <div class="sk-child sk-double-bounce2"></div>
                                      </div>
                                    </div>-->
                                    <div id="header">
                                        <header class="fix-all">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-3 col-12 mr-auto wow animated fadeInLeft"> <a href=""><img src="assetshome/images/logo.png" class="img-fluid" alt="" title="" /></a> </div>
                                                    <div class="float-righ wow animated fadeInRight">
                                                        <div class="signin"><a href="<?php echo site_url('Login'); ?>">Sign in</a></div>
                                                        <nav class="navbar navbar-expand-md navbar-light">
                                                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                                                            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
                                                                <ul class="navbar-nav mr-auto float-right">
                                                                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Home');?>">Home</a> </li>
                                                                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('About')?>">About Us</a> </li>
                                                                    <!--<li class="nav-item"> <a class="nav-link" href="#">Business Plan</a> </li>
                                                                    <li class="nav-item"> <a class="nav-link" href="#">Testmonials</a> </li>-->
                                                                    <li class="nav-item"> <a class="nav-link" data-toggle="modal" href="" data-target="#contact">Contact Us</a> </li>
                                                                </ul>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </header>
                                        <div class="header-heigh fix-all"></div>
                                    </div>

                                    <section class="bg-white wow animated fadeInUp">
                                       <div class="container">
                                            <div class="row">
                                                <div class="all-cmn-title text-center col-12 padng_rmv"><?php echo $about_page[0]['pagetitle']?></div>
                                                <div class="clearfix"></div>
                                                <br />
                                                <div class="">
                                                  <?php echo $about_page[0]['description']?>

                                                </div>
                                            </div>
                                        </div>
                                    </section>
			
                         <?php echo $common_footer; ?>
