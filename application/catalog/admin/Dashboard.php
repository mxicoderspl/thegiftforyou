<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $site_name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="Eblockcoin" name="description" />
<meta content="Eblockcoin" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body class="fixed-left layout2 cstm-page">
<div id="wrapper">
  <div class="topbar">
    <div class="topbar-left">
      <div class="text-center"> <a href="index.html" class="logo">Eblockcoin</a> <a href="index.html" class="logo-sm"><img src="image/toc.png" class="img-responsive bt-icon" /></a></div>
    </div>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="">
          <div class="pull-left">
            <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button>
            <span class="clearfix"></span></div>
          <div class="">
            <nav class="cstm-menu" role="navigation">
              <div class="navbar-header">
                <button data-target="#navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <div id="navbar-collapse-1" class="collapse navbar-collapse p-0">
                <ul class="nav navbar-nav">
                  <li>1 Btc = 8305 USD</li>
                  <li>1 Eth = 366.7 USD</li>
                  <li>1 UCH = 0.88 USD</li>
                  <li>Hitesh123</li>
                  <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
      <div id="sidebar-menu">
        <ul>
          <li class="active"> <a href="index.html" class="waves-effect active"><i class="mdi mdi-home"></i><span> Dashboard </span></a></li>
          <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="mdi mdi-album"></i> <span> ICO </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
            <ul class="list-unstyled" style="display:none">
              <li><a href="icon-information.html">ICO information</a></li>
              <li><a href="icon-buy.html">Buy UCH Token</a></li>
            </ul>
          </li>
          <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"> <i class="fa fa-briefcase"></i> <span> Wallet</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
            <ul class="list-unstyled" style="display:none">
              <li><a href="#">Deposits & Withdrawals</a></li>
              <li><a href="#">History</a></li>
            </ul>
          </li>
          <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-exchange"></i> <span> Exchanges</span></a></li>
          <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-credit-card"></i> <span> Transaction</span></a></li>
          <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-cog"></i> <span> Settings</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
            <ul class="list-unstyled" style="display:none">
              <li><a href="#">My Profile</a></li>
              <li><a href="#">Change Password</a></li>
            </ul>
          </li>
          <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Affilate</span></a></li>
          <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-headphones"></i> <span> Support and Ticket</span></a></li>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="content-page">
    <div class="content">
      <div class="m-t-10">
        <div class="page-header-title">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <div class="col-md-6 p-0">
                    <form role="form" class="form-inline">
                      <div class="form-group">
                        <label for="exampleInputEmail2" class="sr-only">Copy your URL</label>
                        <input type="email" placeholder="Copy your URL" id="" class="form-control">
                      </div>
                      <button class="btn btn-success waves-effect waves-light m-l-10" type="submit">Copy</button>
                      <p class="m-t-10">Get Bouns by referring new members <a href="" data-target="#learn-more" data-toggle="modal">learn more</a></p>
                    </form>
                  </div>
                  <div class="col-mf-6 p-0 pull-right"> <a class="btn-cstm" data-target="#Staking" data-toggle="modal">Staking</a> <a class="btn-cstm" data-target="#Lending" data-toggle="modal">Lending</a> <a class="btn-cstm" href="">Exchange</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="page-content-wrapper ">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="panel text-center">
                <div class="panel-body p-t-10">
                  <div class="pull-left"><img src="image/bitocin.png" class="bt-icon" /></div>
                  <div class="pull-left">
                    <h2 class="m-t-0 m-b-10 text-left"><b>BTC</b></h2>
                    <p class="text-muted m-b-0 text-left"><b>0.0000000000</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel text-center">
                <div class="panel-body p-t-10">
                  <div class="pull-left"><img src="image/toc.png" class="bt-icon" /></div>
                  <div class="pull-left">
                    <h2 class="m-t-0 m-b-10 text-left"><b>TOC</b></h2>
                    <p class="text-muted m-b-0 text-left"><b>0.0000000000</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel text-center">
                <div class="panel-body p-t-10">
                  <div class="pull-left"><img src="image/eth.png" class="bt-icon" /></div>
                  <div class="pull-left">
                    <h2 class="m-t-0 m-b-10 text-left"><b>ETH</b></h2>
                    <p class="text-muted m-b-0 text-left"><b>0.0000000000</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel text-center">
                <div class="panel-body p-t-10">
                  <div class="pull-left"><img src="image/usd.png" class="bt-icon" /></div>
                  <div class="pull-left">
                    <h2 class="m-t-0 m-b-10 text-left"><b>USD</b></h2>
                    <p class="text-muted m-b-0 text-left"><b>0.0000000000</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-lg-4">
              <div class="panel text-center">
                <div class="panel-heading">
                  <h4 class="panel-title text-muted font-light">Total Earn</h4>
                </div>
                <div class="panel-body p-t-10">
                  <h2 class="m-t-0 m-b-15"><i class="ion-social-usd text-warning m-r-10"></i><b>0 USD</b></h2>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="panel text-center">
                <div class="panel-heading">
                  <h4 class="panel-title text-muted font-light">Total Earn</h4>
                </div>
                <div class="panel-body p-t-10">
                  <h2 class="m-t-0 m-b-15"><i cl<i class="ion-social-usd text-warning m-r-10"></i><b>0 USD</b></h2>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="panel text-center">
                <div class="panel-heading">
                  <h4 class="panel-title text-muted font-light">Total Lending</h4>
                </div>
                <div class="panel-body p-t-10">
                  <h2 class="m-t-0 m-b-15"><i class="ion-social-usd text-warning m-r-10"></i><b>0 USD</b></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <h4 class="m-b-30 m-t-0"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Balance Systems</h4>
                  <div class="row">
                    <div class="col-xs-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Percent</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>2017-11-23</td>
                            <td>1.5%</td>
                          </tr>
                          <tr>
                            <td>2017-11-22</td>
                            <td>1.5%</td>
                          </tr>
                          <tr>
                            <td>2017-11-21</td>
                            <td>1.5%</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <h4 class="m-b-30 m-t-0"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;History Lending</h4>
                  <div class="row">
                    <div class="col-xs-12">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Package Lending</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer"> © 2017 Eblockcoin - All Rights Reserved. </footer>
  </div>
</div>

<!--Modal  -->
<div class="modal fade" id="Staking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Staking ( Profit from balance TOC ) : </h3>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Balance (TOC)</th>
              <th>Daily get %</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>100-5000</td>
              <td>0.2</td>
            </tr>
            <tr>
              <td>1000 - 10,000</td>
              <td>0.3</td>
            </tr>
            <tr>
              <td>10,000 - 20,000</td>
              <td>0.4</td>
            </tr>
            <tr>
              <td>20,000 - More</td>
              <td>0.5</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="learn-more" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Refferal Commision</h3>
        <p class="text-center">Get bonus by Reffering new members</p>
        <form class="form-inline form-popup" role="form">
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Copy your URL</label>
            <input type="email" class="form-control" id="" placeholder="Copy your URL">
          </div>
          <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">Copy</button>
        </form>
        <br>
        <table class="table table-hover table-bordered">
          <tbody>
            <tr>
              <td>Level 1</td>
              <td>1.5%</td>
            </tr>
            <tr>
              <td>Level 2</td>
              <td>2.0%</td>
            </tr>
            <tr>
              <td>Level 3</td>
              <td>1.0%</td>
            </tr>
            <tr>
              <td>Level 4</td>
              <td>0.5%</td>
            </tr>
            <tr>
              <td>Level 5 - 20</td>
              <td>0.1%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Lending" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;LENDING BEGIN AT</h3>
        <div id="clockdiv2">
          <div><span class="days"></span>
            <div class="smalltext">Days</div>
          </div>
          <div><span class="hours"></span>
            <div class="smalltext">Hr</div>
          </div>
          <div><span class="minutes"></span>
            <div class="smalltext">Min</div>
          </div>
          <div><span class="seconds"></span>
            <div class="smalltext">Sec</div>
          </div>
        </div>
        <br>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Lending Amount</th>
              <th>Profit</th>
              <th>withdraw</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>100$ - 10,000%</td>
              <td>1.5%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>10,000$ - 50,000%</td>
              <td>2.0%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>50,000$ - 1,00,000%</td>
              <td>2.5%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>1,00,000$ - More</td>
              <td>3.0%</td>
              <td>10%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script> <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script> <script src="<?php echo base_url();?>assets/js/detect.js"></script> <script src="<?php echo base_url();?>assets/js/fastclick.js"></script> <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script> <script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script> <script src="<?php echo base_url();?>assets/js/waves.js"></script> <script src="<?php echo base_url();?>assets/js/wow.min.js"></script> <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script> <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script> <script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
var deadline = 'Jan 05 2018 18:22:18 GMT-0400';
function time_remaining(endtime){
	var t = Date.parse(endtime) - Date.parse(new Date());
	var seconds = Math.floor( (t/1000) % 60 );
	var minutes = Math.floor( (t/1000/60) % 60 );
	var hours = Math.floor( (t/(1000*60*60)) % 24 );
	var days = Math.floor( t/(1000*60*60*24) );
	return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
}
function run_clock(id,endtime){
	var clock = document.getElementById(id);
	
	// get spans where our clock numbers are held
	var days_span = clock.querySelector('.days');
	var hours_span = clock.querySelector('.hours');
	var minutes_span = clock.querySelector('.minutes');
	var seconds_span = clock.querySelector('.seconds');

	function update_clock(){
		var t = time_remaining(endtime);
		
		// update the numbers in each part of the clock
		days_span.innerHTML = t.days;
		hours_span.innerHTML = ('0' + t.hours).slice(-2);
		minutes_span.innerHTML = ('0' + t.minutes).slice(-2);
		seconds_span.innerHTML = ('0' + t.seconds).slice(-2);
		
		if(t.total<=0){ clearInterval(timeinterval); }
	}
	update_clock();
	var timeinterval = setInterval(update_clock,1000);
}
run_clock('clockdiv2',deadline);
</script>
</body>
<!-- Mirrored from themesdesign.in/webadmin_1.1/layouts/blue/layouts-menu2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2017 03:56:31 GMT -->
</html>