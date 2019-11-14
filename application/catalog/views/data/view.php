<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta content="THEGIFT FOR YOU" name="keywords">
<meta content="THEGIFT FOR YOU" name="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#00AEEF" />
<title><?php echo $title; ?></title>
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
                <li class="nav-item"> <a class="nav-link" href="#home">Home</a> </li>
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
  
<section class="slider-section" id="home">
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
         <?php for($i=0;$i<count($sliders);$i++){ ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo ($i==0)?'active':''; ?>"></li>
         <?php } ?>
      
    </ol>
    <div class="carousel-inner">
        <?php for($i=0;$i<count($sliders);$i++){ ?>
      <div class="carousel-item <?php echo ($i==0)?'active':''; ?>">
          <img class="d-block w-100" src="<?php echo base_url('uploads/slider/') . $sliders[0]['image']; ?>" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <div class="main-title-slider">Lorem ipsum dolor</div>
          <div class="main-des-slider1">Lorem Ipsum is simply dummy text of the printing and
            typesetting industry. Lorem Ipsum has been the industry's standard
            dummy text ever since the 1500s</div>
          <a class="signin-slider">Sign in</a> </div>
      </div>
         <?php } ?>
      
      
    </div>
  </div>
    
  
</section>

  <?php
 $this->minify->js(array('jquery-1.11.1.min.js', 'bootstrap.min.js', 'fontawesome-all.min.js', 'wow.min.js'));
 echo $this->minify->deploy_js();
    ?>
<!--<script src="assetshome/js/jquery-1.11.1.min.js"></script> 
<script src="assetshome/js/bootstrap.min.js"></script> 
<script src="assetshome/js/fontawesome-all.min.js"></script> 
<script src="assetshome/js/wow.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.js"></script> 
<script type="text/javascript">
// JavaScript Document

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
    scrollTop: $(id).offset().top - 95
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
    scrollTop: $(id).offset().top - 25
  }, 500);
  
  return false;
});
    }

});
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
