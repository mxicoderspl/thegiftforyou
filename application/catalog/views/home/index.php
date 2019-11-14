<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.error{
	color:red;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta content="THEGIFT FOR YOU" name="keywords">
<meta content="THEGIFT FOR YOU" name="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#00AEEF" />
<title><?php echo $title; ?></title>
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
	
          <?php if(!empty($logged_use)) { ?>
             <div class="signin"><a href="<?php echo site_url('Dashboard'); ?>">Dashboard</a></div>
            <?php } else {?>
            <div class="signin"><a href="<?php echo site_url('Login'); ?>">Sign in</a></div>
            <?php } ?>
          <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto float-right">
                <li class="nav-item"> <a class="nav-link" href="#home">Home</a> </li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url('ServiceFinder');?>">Find Services</a></li>
                <li class="nav-item"> <a class="nav-link" href="#about">About Us</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#business">Business Plan</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#testmonials">Testmonials</a> </li>
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
  <?php if(!empty($sliders)){?>
<section class="slider-section" id="home">
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php for ($i = 0; $i < count($sliders); $i++) { ?>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
                                                <?php } ?>

                                            </ol>
                                            <div class="carousel-inner">
                                                <?php for ($i = 0; $i < count($sliders); $i++) { ?>
                                                    <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
                                                        <img class="d-block w-100" src="<?php echo base_url('uploads/slider/') . $sliders[$i]['image']; ?>" alt="First slide">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <div class="main-title-slider"> <?php echo $sliders[$i]['title'];?></div>
                                                                <?php echo $sliders[$i]['description'];?>
                                                                <a class="signin-slider">Sign in</a> 
                                                            </div>
                                                    </div>
                                                <?php } ?>


                                            </div>
                                        </div>

  
</section>
  <?php } ?>

<section class="about-us wow animated fadeInUp" id="about">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1><?php echo $about_section[0]['pagetitle'];?></h1>
        <p>
            <?php echo $about_section[0]['description'];?>
            
        </p>
        <a class="signin-slider all-center-read-more" href="<?php echo site_url('About')?>">Read More</a> </div>
    </div>
  </div>
</section>
<section class="bg-white " id="business">
  <div class="container">
    <div class="col-12">
      <div class="row">
        <div class="all-cmn-title col-12 wow animated fadeInUp"><?php echo $welcome_section[0]['pagetitle']; ?> </div>
       <?php echo $welcome_section[0]['description']; ?>
      </div>
    </div>
  </div>
  <div class="r-step">
    <div class="container">
      <div class="col-12">
        <div class="row">
          <div class="col-lg-3 col-sm-6 col-12 wow animated fadeInUp">
            <div class="r-box">
              <div class="icon"> <i class="fas fa-pencil-alt fa-2x"></i> </div>
              <div class="r-box-title">Register</div>
              <div class="r-box-des">Register at The Gift For You website using your email. </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 wow animated fadeInUp">
            <div class="r-box">
              <div class="icon"> <i class="fas fa-credit-card fa-2x"></i> </div>
              <div class="r-box-title">Pay Registration Fee</div>
              <div class="r-box-des">Pay Rs. 500 registration fee as membership of Gift For You website. </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 wow animated fadeInUp">
            <div class="r-box">
              <div class="icon"> <i class="fas fa-users fa-2x"></i> </div>
              <div class="r-box-title">Refer Friends</div>
              <div class="r-box-des">Share your referral links with your friends and your connections. </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12 wow animated fadeInUp">
            <div class="r-box">
              <div class="icon"> <i class="fas fa-gift fa-2x"></i> </div>
              <div class="r-box-title">Get Gifts</div>
              <div class="r-box-des">Get rewards when your friends pay the registration fee, you will get rewards up to 10 levels. </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="testmonial wow animated fadeInUp" id="testmonials">
  <div class="container">
    <div class="all-cmn-title text-center">Our Happy Customers</div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="10000">
     <div class="carousel-inner">
        <?php for($i=0;$i<count($testimonials);$i++) { ?>
            <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
                                                      
              <div class="client-img"> 
               <img src="<?php echo $this->config->item('upload_path_testimonial_thumb') . $testimonials[$i]['image']; ?>" class="img-fluid" alt="" title="" /> 
              </div>
               <p class="client-name"><?php echo $testimonials[$i]['client_name']; ?></p>
                <p class="client-location"><?php echo $testimonials[$i]['location']; ?></p>
               <p class="client-word"><?php echo $testimonials[$i]['testimonial']; ?></p>
                           
            </div>
        <?php } ?>                                        
    </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
  </div>
</section>
<section class="bg-white wow animated fadeInUp">
  <div class="container">
    <div class="row">
      <div class="all-cmn-title text-center col-12 padng_rmv">Our Recent Earners</div>
      <div class="clearfix"></div>
      <br />
      <div class="slider">
	<?php for($i=0;$i<count($users_info);$i++){?>
        <div>
	<?php if(!empty($users_info[$i]['profilepic'])){ ?>
	<img src="<?php echo base_url().$this->config->item('upload_path_profilepic_thumb') . $users_info[$i]['profilepic']?>" class="img-fluid" />
	<?php }else{?>
	<img src="assetshome/images/useravt.png" class="img-fluid" />
	<?php }?>
		
          <!--<p class="user-name" style="overflow:hidden"><?php echo ucfirst($users_info[$i]['firstname']).' '.ucfirst($users_info[$i]['lastname'])?></p>-->
<p class="user-name" style="overflow:hidden"><?php echo $users_info[$i]['referer_code']?></p>
          <p class="user-name1"><i class="fas fa-rupee-sign"></i><?php echo $users_info[$i]['amount']?></p>
        </div>
	<?php }?>
        
      </div>
    </div>
  </div>
</section>
<footer id="contact-us">
  <div class="container">
    <ul class="footer-menu-left float-left">
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About us</a></li>
      <li><a href="#business">Business Plan</a></li>
     <li><a href="#testmonial">Testmonials</a></li>
      <li><a href="<?php echo site_url('ServiceFinder');?>">Find Services</a></li>
      <li><a class="nav-link" data-toggle="modal" href="" data-target="#contact">Contact Us</a></li>
    </ul>
    <ul class="footer-menu-left float-right">
      <li><a title="Facebook" href="https://www.facebook.com"><i class="fab fa-facebook fa-2x"></i></a></li>
      <li><a title="Twitter" href="https://www.twitter.com/"><i class="fab fa-twitter-square fa-2x"></i></a></li>
      <li><a title="Linkedin" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-2x"></i></a></li>
    </ul>
  </div>
  <p>Design and Development by <a href="">Mxiocders Pvt LTD</a></p>
</footer>

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <?php echo form_open('contact/send', array('id' => 'contactform', 'class' => '', 'role' => 'form')); ?>
                                                    <div class="modal-body all-form">
                                                        <div class="form-group">
                                                            <label for="">First Name</label>
                                                            <input type="text" class="form-control" id="fname" name="fname" aria-describedby="" placeholder="First Name">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Last Name</label>
                                                            <input type="text" class="form-control" id="lname" name="lname" aria-describedby="" placeholder="Last Name">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="" placeholder="Your Email">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Message</label>
                                                            <textarea type="text" class="form-control" id="message" name="message" placeholder="Your Message"></textarea>
                                                        </div>


                                                    </div>
                                               
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                   
                                                </div>
                                            <?php echo form_close(); ?>
    </div>
  </div>
</div>
  <?php
 $this->minify->js(array('jquery-1.11.1.min.js','bootstrap.min.js', 'fontawesome-all.min.js', 'wow.min.js','jquery.validate.min.js'));
 echo $this->minify->deploy_js();
    ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.js"></script> 
<script type="text/javascript">
// JavaScript Document
/*function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}*/
	$(window).load(function() {
    $('.bg-all').hide();
  });
  new WOW().init();

  // Set Equal Height 

                equalheight = function (container) { 
                    var currentTallest = 0,
                            currentRowStart = 0,
                            rowDivs = new Array(),
                            $el,
                            topPosition = 0;
                    $(container).each(function () {

                        $el = $(this);
                        $($el).height('auto')
                        topPostion = $el.position().top;

                        if (currentRowStart != topPostion) {
                            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                                rowDivs[currentDiv].height(currentTallest);
                            }
                            rowDivs.length = 0; // empty the array
                            currentRowStart = topPostion;
                            currentTallest = $el.height();
                            rowDivs.push($el);
                        } else {
                            rowDivs.push($el);
                            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                        }
                        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                            rowDivs[currentDiv].height(currentTallest);
                        }
                    });
                }

                $(window).load(function () {
                    equalheight('#header .fix-all');
                });

                $(window).resize(function () {
                    equalheight('#header .fix-all');
                });		
				$(document).ready(function(){
    				$('.slider').bxSlider({
						slideWidth: 165,
                        minSlides: 1,
						moveSlides:1,
                        maxSlides: 6,
                        slideMargin: 30,
						ticker:true,
						speed:70000,
						tickerHover:true,
                    });
               });
			   
			   
			   $('.navbar-collapse a').click(function(){
    $(".navbar-collapse").collapse('hide');
});
			   
			   var sections = $('section')
  , nav = $('nav')
  , nav_height = nav.outerHeight();

$(window).on('scroll', function () {
  var cur_pos = $(this).scrollTop();
  
  sections.each(function() {
    var top = $(this).offset().top - nav_height,
        bottom = top + $(this).outerHeight();
    
    if (cur_pos >= top && cur_pos <= bottom) {
      nav.find('a').removeClass('active');
      sections.removeClass('active');
      
      $(this).addClass('active');
      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
	
    }
  });
});


$(document).ready(function(){

    if($(window).width() <= 767)
    {
        nav.find('a').on('click', function () {
  var $el = $(this)
    , id = $el.attr('href');

  $('html, body').animate({
    scrollTop: $(id).offset().top - 96
  }, 500);
  
  return false;
});
    }

});



$(document).ready(function(){

    if($(window).width() >= 768)
    {
        nav.find('a').on('click', function () {
  var $el = $(this)
    , id = $el.attr('href');
  
  $('html, body').animate({
    scrollTop: $(id).offset().top - 24
  }, 500);
  
  return false;
});
   }

 /*
if(getUrlVars()=='testmonials'){
    alert("e");
    $("#testmonials").trigger("click");
    nav.find('a').removeClass('active');
      sections.removeClass('active');
      nav.find('a[href="#testmonials"]').addClass('active');
     
   
       $('html, body').animate({
    scrollTop: $('#testmonials').offset().top - 75
  }, 500);
      
}
*/



});
</script> 
<script>
                                        $(document).ready(function () {
                                            $('#contactform').validate({

                                                rules: {

                                                    fname: {
                                                        required: true
                                                    },
                                                    lname: {
                                                        required: true
                                                    },
                                                    email: {
                                                        required: true
                                                    },

                                                    message: {
                                                        required: true
                                                    },
                                                },
                                                messages: {

                                                    fname: {
                                                        required: "Firstname is required"
                                                    },
                                                    lname: {
                                                        required: "Lastname is required"
                                                    },
                                                    email: {
                                                        required: "Email is required"
                                                    },
                                                    message: {
                                                        required: "Message is required"
                                                    },
                                                },
                                                
                                            });
                                        });
//                  
                                    </script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]--> 
<!-- End Bootstrap JS -->
</body>
</html>
