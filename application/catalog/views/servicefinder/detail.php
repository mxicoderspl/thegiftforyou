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
<style>
.filter {float: left;width: 100%;}
.filter .row {background: rgba(0,174,239,0.9);padding: 15px;margin-top: -100px;z-index: 111111;position: relative;}
.filter .btn.btn-primary.btn-block {background: #77C04B !important;}
.cstm-t-box {border: 1px solid #e1e1e1 !important;box-shadow: none;border-radius: 3px;font-size: 16px;padding: 6px 10px;}
.column img {display: block;width: 100%;height: 300px;}
/*With Simple Caption*/
.all-bx .column#caption {position: relative;}
.all-bx .column#caption .text {position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 10;opacity: 0;transition: all 0.8s ease;}
.all-bx .column#caption .text h1 {margin: 0;color: white;}
.all-bx .column#caption:hover .text {opacity: 1;
}
/* Craeted refering to LittleSnippets.net Pen: https://codepen.io/littlesnippets/pen/adLELd */
.frame {text-align: center;position: relative;cursor: pointer;perspective: 500px;}
.all-bx .frame .details {width: 80%;padding: 5% 8%;position: absolute;content: "";top: 30%;left: 50%;transform: translate(-50%, -50%) rotateY(90deg);transform-origin: 50%;background: rgba(255,255,255,0.9);opacity: 0;transition: all 0.4s ease-in;}
.all-bx:hover .frame .details {transform: translate(-50%, -50%) rotateY(0deg);opacity: 1;}
.bx-wi {float: left;width: 100%;padding: 50px 0;background: #F7F8FA}
.details h4 {font-size: 15px;text-align: center;text-transform: capitalize;}
.full-info {font-size: 18px;text-align: center;margin: 15px 0;}
.all-bx {background: #fff;border: 1px solid #F0F0F0;float: left;width: 100%; margin-bottom:30px}
.u-name {margin: 0;margin-top: 22px;}
.u-service {font-size: 14px;color: #808080;margin-top: 7px;margin-bottom: 30px;}
a.full-info-btn {background: #00AEEF;color: #fff;float: left;width: 100%;margin: 0;font-size: 16px;padding: 10px 0;}
.type-services {background: #FF650D;margin-top: -29px;position: relative;float: left;margin-left: 5px;padding: 0px 8px;text-transform: uppercase;color: #fff;font-weight: bold;font-size: 13px;}
.float-left.pt-3 {margin-right: 10px;}
.custom-select {min-width: 126px;}
.cstm-t-box.grid1, .cstm-t-box.list1 {padding: 10px 10px;background: #fff;}
.total-result p {font-size: 25px;text-transform: uppercase;color: #666666;margin: 25px 0;}
.b-top-bottom {margin-bottom: 30px; float:left; width:100%;border-top: 1px solid #e1e1e1;border-bottom: 1px solid #e1e1e1;}
.total-result{float:left}
.list-item .u-name, .list-item .u-service {text-align: left;}
.list-item-about {color: #767676;text-align: left;font-size: 14px;}
.list-item .u-service {margin-bottom: 15px;}
.list-item .all-bx .frame .details{top:70%;}
.page-link:hover, .page-link.active{background:#00AEEF; border:1px solid #00AEEF; color:#fff;}
.u-name a{color:#212529}
.total-result span {color: #00AEEF;}
</style>
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
        <div class="col-lg-3 col-12 mr-auto wow animated fadeInLeft"> <a href=""><img src="assets/home/images/logo.png" class="img-fluid" alt="" title="" /></a> </div>
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
      <div class="carousel-item <?php echo ($i==0)?'active':''; ?>"> <img class="d-block w-100" src="<?php echo base_url('uploads/slider/') . $sliders[0]['image']; ?>" alt="First slide">
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
<section class="filter">
  <div class="container">
    <div class="row">
      <div class="col-md-3 pt-3">
        <div class="form-group ">
          <input type="text" class="form-control cstm-t-box" name="keywords" id="" placeholder="Keywords">
        </div>
      </div>
      <div class="col-md-3 pt-3">
        <div class="form-group">
          <input type="text" class="form-control cstm-t-box" name="keywords" id="" placeholder="Address">
        </div>
      </div>
      <div class="col-md-3 pt-3">
        <div class="form-group">
          <select id="inputState" class="form-control cstm-t-box">
            <option selected>Select Category</option>
            <option>BMW</option>
            <option>Audi</option>
            <option>Maruti</option>
            <option>Tesla</option>
          </select>
        </div>
      </div>
      <div class="col-md-3 pt-3">
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-block">Search</button>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="bx-wi">
  <div class="container">
	<div class="b-top-bottom">
	<div class="row">
	<div class="col-12">
	<div class="total-result">
		<p><span>1</span> Result FOund</p>
	</div>
	<div class="float-right">
	  <div class="float-left pt-3">
        <div class="form-group">
          <select id="inputState" class="form-control cstm-t-box custom-select">
            <option selected>Sort by</option>
            <option>Rating</option>
            <option>Title</option>
          </select>
        </div>
      </div>
      <div class="float-left pt-3">
        <div class="form-group">
          <select id="inputState" class="form-control cstm-t-box custom-select">
            <option selected>Desc</option>
            <option>ASC</option>
            <option>DESC</option>
          </select>
        </div>
      </div>
      
      <div class="float-left pt-3">
        <div class="form-group">
          <div class="cstm-t-box grid1"><i class="fa fa-th"></i></div>
        </div>
      </div>
	  <div class="float-left pt-3">
        <div class="form-group">
		<div class="cstm-t-box list1">
		  <i class="fa fa-th-list"></i></div>
        </div>
      </div>
	</div></div>
	</div></div>
	<div class="clearfix"></div>
    
      </div>
	  <div class="clearfix"></div>
	  
    </div>
	<section class="section-full bg-gray about-info" id="sf-provider-info">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4">
          <div class="sf-provider-des">
            <div class="sf-thum-bx overlay-black-light">
              <img src="http://aonetheme.com/extend/wp-content/uploads/2016/08/dreamstime_l_32995065-600x600.jpg" alt="">              <div class="rating-bx"> <div class="sf-show-rating default-hidden" style="display: block;"><div class="star-rating rating-sm rating-disabled"><div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i></div><div class="rating-container rating-gly-star" data-content=""><div class="rating-stars" data-content="" style="width: 0%;"></div><input class="display-ratings form-control hide" value="0" min="0" max="5" step="0.5" data-size="sm" disabled="disabled" type="number"></div><div class="caption"><span class="label label-default">Not Rated</span></div></div></div> </div>
            </div>
            <span class="sf-provider-name">
            Sturat            Bill            </span>
            <ul class="social-bx list-inline">
                                                                                                              </ul>
                        <button class="btn btn-sm btn-primary sf-review-btn">Write A Review</button>
                        <span class="sf-featured-approve"><i class="fa fa-check"></i><span>Verified Provider</span></span>                      </div>
        </div>
        <div class="sf-about-box">
          <h2 class="sf-title">LEVITTOWN FORD DEALERS</h2>
          <span class="tagline">Best Car Dealer Service in your area</span>
          <div class="sf-provider-cat">
            <strong>Categories: </strong>
            <a href="http://aonetheme.com/extend/providers-category/car-dealers/">Car Dealers</a>        </div>
          <div class="shared-bx">
            <ul class="sharebtn-bx">
                            <li>
                <a href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-heart"></i>Add to Fav</a>              </li>
                                                        
              <li><a href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-briefcase"></i>Invite for Job</a></li>              
                                          <li><a href="javascript:void(0);" data-providerid="32" data-toggle="modal" data-target="#quotes-Modal">
        <i class="fa fa-hand-o-right"></i> Request a Quote        </a> </li>
                    </ul>
                        <ul class="share-social-bx">
                            <li class="fb"><a onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=http://aonetheme.com/extend/author/levit_ford/', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript:;"> <i class="fa fa-facebook"></i>
                Share                </a></li>
                                          <li class="tw"><a onclick="javascript:window.open('https://twitter.com/intent/tweet?text=Sturat Bill&amp;url=http://aonetheme.com/extend/author/levit_ford/', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript:;"> <i class="fa fa-twitter"></i>
                Share                </a></li>
                                          <li class="lin"><a onclick="javascript:window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=http://aonetheme.com/extend/author/levit_ford/', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript:;"> <i class="fa fa-linkedin"></i>
                Share                </a></li>
                                          <li class="pin"><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"> <i class="fa fa-pinterest"></i>
                Share                </a></li>
                                          <li class="gp"><a onclick="javascript:window.open('https://plus.google.com/share?url=http://aonetheme.com/extend/author/levit_ford/', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript:;"> <i class="fa fa-google-plus"></i>
                Share                </a></li>
                                          <li class="dig"><a onclick="javascript:window.open('http://www.digg.com/submit?url=http://aonetheme.com/extend/author/levit_ford/', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript:;"> <i class="fa fa-digg"></i>
                Share                </a></li>
                          </ul>
                      </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus tortor nec tellus sollicitudin lacinia id ultricies enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus tortor nec tellus sollicitudin lacinia id ultricies enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus tortor nec tellus sollicitudin lacinia id ultricies enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus tortor nec tellus sollicitudin lacinia id ultricies enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
        </div>
      </div>
    </div>
  </section>
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
