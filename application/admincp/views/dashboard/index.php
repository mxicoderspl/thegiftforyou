<?php echo $header; ?>
<script>
            .border_tops{
                border-top:1px solid #eee;
                
            }
    
    
    </script>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
   
<div class="content">
      <div class="">
        <div class="page-header-title">
          <h4 class="page-title">Dashboard</h4>
        </div>
      </div>
     <div class="page-content-wrapper ">
        <div class="container">
	                  
 		 <div class="row">
                <div class="col-xs-12">
                        <div class="catm-alert-msg">
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                                    <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('info')) { ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
            </div>
			<div class="col-md-12">
		<div class="row">
                    <div class="col-md-4 pointt" >
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right" ><i class="fa fa-user" style="font-size:  30px; padding-top: 8px"></i></div>
                                    <div class="media-body">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5 pull-left">User</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="<?php echo site_url('Users'); ?>"><h4 class="nomargin" style="color:#999;font-family: sans-serif">Total users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin" style="color:#999;font-family: sans-serif"><?php //echo $total_users; ?>0</h4>
                                    </div>

                                </div>
                                <div class="clearfix" style="border-top:1px solid #eee">
                                    <div class="pull-left " >
                                        <h5 class="md-title nomargin " ></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin " style="color:#999;font-family: sans-serif">Total active users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin" style="color:#999;font-family: sans-serif"><?php //echo $total_enable_user; ?>0</h4>
                                    </div>
                                </div>
                                <div class="clearfix" style="border-top:1px solid #eee">
                                    <div class="pull-left border-top">
                                        <h5 class="md-title nomargin"></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin" style="color:#999;font-family: sans-serif">Total Inactive users</h4></a>
                                    </div>
                                    <div class="pull-right" style="border-top:1px solid #eee">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin" style="color:#999;font-family: sans-serif"><?php //echo $total_disable_user; ?>0</h4>
                                    </div>
                                </div>
                                <div class="clearfix " style="border-top:1px solid #eee ;">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin" ></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin" style="color:#999;font-family: sans-serif" >Payment verified users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin" style="color:#999;font-family: sans-serif"><?php //echo $total_verified; ?>0</h4>
                                    </div>
                                </div>
                                <!--<div class="clearfix">
                                   <div class="pull-left">
        <h5 class="md-title nomargin"></h5>
        <!--<a href="<?php //echo site_url('Users');   ?>"><h4 class="nomargin"></h4></a>
    </div>
    <div class="pull-right">
        <h5 class="md-title nomargin"></h5>
        <h4 class="nomargin"></h4>
    </div>
                                </div>-->

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light">Total User </h4>
                            </div>
                            <div class="panel-body p-t-10">
                                
				<h4 class="m-t-0 m-b-15">&nbsp;<b><?php //echo $totaluser ; ?></b></h4>
                            </div> 
                        </div>
                    </div>
		<div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light"><a href="<?php //echo site_url('Users')?>" style="color:#898989">Enable User</a></h4>
                            </div>
                            <div class="panel-body p-t-10">
				
                                <h4 class="m-t-0 m-b-2"><b>&nbsp;<a href="<?php //echo site_url('Users')?>" style="color:black"><?php //echo $enableuser ;?></a></b></h4> 
				
                            </div>
                        </div>
                    </div>
			<div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light"><a href="<?php echo site_url('Users/disableuser')?>" style="color:#898989">Disable User</a> </h4>
                            </div>
                            <div class="panel-body p-t-10">
                                
				<h4 class="m-t-0 m-b-2"><b>&nbsp;<a href="<?php echo site_url('Users/disableuser')?>" style="color:black"><?php //echo $disableuser ;?></a></b></h4>
                            </div> 
                        </div>
                    </div>
           	</div>
		</div>
		<div class="col-md-12">
		<div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light">Wallet Balance<br/></h4>
                            </div>
                            <div class="panel-body p-t-10">
                                
				<h4 class="m-t-0 m-b-15"><?php //echo $this->config->item('currency_icon') ?>&nbsp;<b><?php //echo $wallet_balance ;?></b></h4>
                            </div> 
                        </div>
                    </div>
			<div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light"><a href="<?php echo site_url('Payment')?>" style="color:#898989">Last csv file download datetime </a></h4>
                            </div>
                            <div class="panel-body p-t-10">
                                
				<h4 class="m-t-0 m-b-15">&nbsp;<b><a href="<?php echo site_url('Payment')?>" style="color:black	"><?php //echo $lastdownloaddate ; ?></a></b></h4>
                            </div> 
                        </div>
                    </div>
			
			<div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="panel text-center">
                            <div class="panel-heading">
                                <h4 class="panel-title text-muted font-light">Today Payment Request</h4>
                            </div>
                            <div class="panel-body p-t-10">
                                
				<h4 class="m-t-0 m-b-15"><i class="fas fa-rupee-sign text-warning m-r-10"></i><b ><a href="<?php echo site_url('Fixpayment/registerpayment')?>/<?php echo 'Approved'?>" style="color:black"><?php //echo $paymentapproveduser ;?></a></b></h4>
                            </div> 
                        </div>
                    </div>
			</div>
           	</div>
        	</div>
            </div>
        </div>
      </div>
</div>
</div>
<?php echo $footer ?>
 <script>
            jQuery(document).ready(function() {
               // $('.summernote').wysihtml5();
                $('.summernote').summernote({
                    height: 200,
                    minHeight: null,
                    maxHeight: null,
                    focus: true
                });
            });
        </script>
<!--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
-->
