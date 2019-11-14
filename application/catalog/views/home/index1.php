<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="" name="keywords">
<meta content="" name="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="icon" href="<?php echo base_url();?>assets/images/mlogo.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/mlogo.ico" type="image/x-icon"/>-->
<meta name="theme-color" content="#FF6100" />
<title> <?php echo  $title;?> </title>

<?php 
$this->minify->css(array( 'bootstrap.min.css','font-awesome.min.css','style.css','animate.css'));
echo $this->minify->deploy_css();
?>

</head>
<body>
<!--<div class="showbox">
  <div class="loader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
  </div>
</div>-->
<div id="sticky-anchor"></div>
<div class="header-top">
  <div class="pull-right">
      <ul style="height: 18px">
      <li><span id="top_time"></span></li>
                 
    </ul>
  </div>
</div>
<header id="sticky">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 Col-sm-2 col-xs-2 padng_rmv wow slideInLeft animated"> <!--<a href=""><img alt="thegiftsforyou" src="<?php echo base_url();?>assets/images/eblockv.png" class="img-responsive" /></a> -->
        <h3> 
            <span style="color:orangered ">The</span>giftsfor<span style="color:orangered ">you</span>
                    </h3>
        </div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="pull-right wow  slideInRight animated">
        <nav id="navbar" class="navbar-collapse collapse petsub-nav">
          <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="#about">ICO</a></li>
            <li><a href="#road-map">RoadMap</a></li>
            <li><a href="#" data-toggle="modal" data-target="#myModal" class="">White Paper</a></li>
            <li><a href="#price" class="">Exchange</a></li>
            <li><a href="#affiliate" class="">Affiliate</a></li>
            <li><a href="#faq" class="">FAQ</a></li>-->
              <?php if (!$this->session->userdata('user_id')) {?>
 	<li class="hidden-xs"><a href="<?php echo site_url('Login');?>" class="compaign">SIGN IN</a></li>
   	<li class="hidden-xs"><a href="<?php echo site_url('Register');?>" class="active">SIGN UP</a></li>           
             <?php }else{?>
           <li class="hidden-xs"><a href="<?php echo site_url('Dashboard');?>" class="compaign">My Dashboard</a></li>
             <?php } ?>
          
          </ul>
        </nav>
        <!--/.nav-collapse --> 
      </div>
    </div>
  </div>
</header>
<div class="col-xs-12 mb-btn visible-sm visible-xs"> <a href="<?php echo site_url('Login');?>" class="compaign">SIGN IN</a> <a href="<?php echo site_url('Register');?>" class="active">SIGN UP</a> </div>

  <div class="slider-section">
      <div class="container" style="height: 400px">
    <div class="row">
    
   

</div>
     
  </div></div>
<section id="footer">
  <div class="container">
    <div class="row">
       
      <ul class="btm-ul">
        <li><a class="des-white t-color-gray" href="">© <?php echo date('Y')." ".$site_name ;?> . All rights reserved.</a></li>
      </ul>
    </div>
  </div>
</section>





<?php
$this->minify->js(array('jquery-1.12.4.min.js','bootstrap.min.js','countdown.js','app.js','wow.min.js'));
echo $this->minify->deploy_js();
?>


<script>new WOW().init();</script>

<script>
    
   
   



</script>
 
</body>
</html>
