<?php
echo $header;
echo $sidebar;
?>
<style>
    .btn-cstm-balance{
        background: #fff none repeat scroll 0 0;
        color: #F79521;
        border: 1px solid #F79521;
        margin: 20px 5px 0;
        padding: 5px 15px;
        border-radius: 0px;
        float: left;

    }
    .availabletext{
        background: #fff none repeat scroll 0 0;
        color: #F79521;

    }

    #bnk{
        margin-top: auto;
        margin-bottom:123px;
        margin-left: 265px;
        height: 85px;
        width: 500px;
    }
</style>
<div style="display:none; position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 9999999; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px;" id="ajaxLoading2">
    <img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url(); ?>userdash/assets/images/ajax-loading.gif"><p style="margin:0;font-size:14px;color:#fff">loading...</p>
</div>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="m-t-10">
                <div class="page-header-title">
                    <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4" style="padding-left: 30px;padding-right: 15px  ">
            <div class="panel" style="padding-bottom:34px;">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-user" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                      <p class="card-category text-center" style="font-size: 20px">  My Referal</p>
                      <h4 class="card-title pull-right"><small>Total : </small> <img src="<?php echo base_url() . $this->config->item('upload_path_rupee'); ?>" style="height:18px;"/> <?php echo $referal[0]['total_referal']; ?>
                          <!--<small>RS</small>-->
                      </h4>
			<h4></h4>
                      </div>
                  </div>
             
                  <div class=" row modal-footer" >
                        <div class="pull-left">
                          <i class="  material-icons"> View </i>
                          <a href="<?php echo site_url('Network'); ?>"> Referal Records</a>
                     </div>
                     
                      
                  </div>
              </div>
             </div>
		<div class="col-lg-4 col-md-4 col-sm-4" style="padding-left: 30px;padding-right: 15px  ">
            <div class="panel" style="padding-bottom: 12px;">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-money" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                      <p class="card-category text-center" style="font-size: 20px"> PayOuts</p>
                      <h4 class="card-title pull-right">
                          <small>Withdrawn : </small><img src="<?php echo base_url() . $this->config->item('upload_path_rupee'); ?>" style="height:18px;"/> <?php echo $totaldeposite[0]['totaldeposite']; ?>
                      </h4>
		      <h4 class="card-title pull-right">
                          <small>Available : </small><img src="<?php echo base_url() . $this->config->item('upload_path_rupee'); ?>" style="height:18px;"/> <?php echo $wallet_balance; ?>
                      </h4>
                      </div>
                  </div>
              
                  <div class=" row modal-footer" >
                        <div class="pull-left">
                          
                     </div>
                     
                      
                  </div>
              </div>
             </div>
<div class="col-lg-4 col-md-4 col-sm-4" style="padding-left: 30px;padding-right: 15px  ">
            <div class="panel" style="padding-bottom: 12px;">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-rupee" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                      <p class="card-category text-center" style="font-size: 20px">Balance</p>
                      <h4 class="card-title pull-right">
                          <small>Wallet : </small><img src="<?php echo base_url() . $this->config->item('upload_path_rupee'); ?>" style="height:18px;"/> <?php echo $wallet_balance; ?>
                      </h4>
			<h4 class="card-title pull-right">
                          <small>Company Wallet : </small><img src="<?php echo base_url() . $this->config->item('upload_path_rupee'); ?>" style="height:18px;"/> <?php echo $balance[0]['company_wallet_balance']; ?>
                      </h4>
                      </div>
                  </div>
              
                  <div class=" row modal-footer" >
                        <div class="pull-left">
                          <!--<i class="  material-icons text-danger">Show </i>
                          <a href="" data-toggle="modal" data-target="#transaction"> Transaction ...</a>-->
                     </div>
                     
                      
                  </div>
              </div>
             </div>

<div class="col-lg-4 col-md-4 col-sm-4" style="padding-left: 30px;padding-right: 15px  ">
            <div class="panel" style="padding-bottom: 12px;">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-ticket" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                      <p class="card-category text-center" style="font-size: 20px">Tickets</p>
                      <h4 class="card-title pull-right">
                          <small>Open : </small><?php echo $open_ticket[0]['total_open']; ; ?>
                      </h4>&nbsp;&nbsp;&nbsp;&nbsp;
			
			<h4 class="card-title pull-right">
                          <small>Close : </small><?php echo $close_ticket[0]['total_close']; ?>
                      </h4>
                      </div>
                  </div>
              
                  <div class=" row modal-footer" >
                        <div class="pull-left">
                          <!--<i class="  material-icons text-danger">Show </i>
                          <a href="" data-toggle="modal" data-target="#transaction"> Transaction ...</a>-->
                     </div>
                     
                      
                  </div>
              </div>
             </div>

                        <div class="col-md-12">
			
                            <div class="panel panel-primary">

                                <?php if (!empty($transaction_status) && $transaction_status[0]['status'] != "Pending" && $transaction_status[0]['status'] != "Declined" && !empty($bank_detail)) { ?>

                                    <div class="panel-body">

                                        <?php if ($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-danger">
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                                                <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">×</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success">
                                                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                                <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">×</button>
                                            </div>
                                        <?php } ?>

                                        <div class="col-md-6 p-0">
                                            <?php echo $sponser_text; ?>
                                            <form role="form" class="form-inline">
                                                <div class="form-group col-md-10 p-0">
                                                    <label for="exampleInputEmail2" class="sr-only">Copy your URL</label>
                                                    <input  style="width: 100%;" value="<?php echo $ref_url; ?>" type="url" placeholder="Copy your URL" id="copyTarget" class="form-control">
                                                </div>
                                                <div class="form-group col-md-2 p-0">
                                                    <button id="copyButton" class="btn btn-success waves-effect waves-light m-l-10 " type="button" onclick="mycopyFunction()">Copy</button>
                                                </div>

                                                <p class="m-t-10"><!--Get Bouns by referring new members <a href="" data-target="#learn-more" data-toggle="modal">learn more</a>--></p>
                                                <div class="clearfix"></div>
                                                <br/>
                                                <div class="share">

                                                    <div class="addthis_default_style"><a class="addthis_button_compact"></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
                                                    <script type="text/javascript">

                                                        var addthis_share = {
                                                            url: "<?php echo $ref_url; ?>"



                                                        }
                                                    </script>	
                                                    <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script>
                                                </div>
                                            </form>
                                        </div>
                                        <!--<div class="col-mf-6 p-0 pull-right">
                                            <a class="btn-cstm" href="#" onclick="convertmoney()">Convert $ <i class="fa fa-exchange"></i> EBC</a> </div>
                                    </div>-->

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if (empty($bank_detail)) { ?>
                        <div class="row">
                            <div class="alert alert-warning" id="bnk">

                                <p style="font-size:18px;padding-top: 8px;width: 336px;margin-left: 12px;"><i class="fa fa-warning" style="font-size:30px;"></i> Please fillup your Bank details </p>
                                <button type="button" class='btn btn-info btn-lg' data-toggle="modal" data-target="#bankdetail" style="margin-top: -46px;margin-left: 341px;"> Fillup Now</button>
                            </div>
                        </div>


                        <!--                        <div class="clearfix"></div>-->
                    <?php } ?>

                    <?php if (!empty($transaction_status) && $transaction_status[0]['status'] != "Pending" && $transaction_status[0]['status'] != "Declined" && !empty($bank_detail)) { ?>
                        <div class="row">
				<div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                        <h4 class="panel-title text-muted font-light">My Referal</h4>
                                    </div>
                                    <div class="panel-body p-t-10">
                                        <h4 class="m-t-0 m-b-15">Total : <?php echo $referal[0]['total_referal']; ?></h4>
                                       <a class="" href="<?php echo site_url('Network'); ?>" style="margin-left:82px">View referal records</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                        <h4 class="panel-title text-muted font-light">PayOuts</h4>
                                    </div>
                                    <div class="panel-body p-t-10">
                                        <h4 class="m-t-0 m-b-15">Withdrawn : <i class="fa fa-rupee m-r-10"></i><?php echo $totaldeposite[0]['totaldeposite']; ?></h4>
                                        <h4 class="m-t-0 m-b-15" style="margin-left: 78px;">Available : <i class="fa fa-rupee m-r-15"></i><?php echo $wallet_balance; ?></h4>
                                        <!--<a class="" href="<?php // echo site_url('Wallet'); ?>" style="margin-left:82px">View Transactions</a>-->
                                    </div>
                                </div>
                            </div>
			          <div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                        <h4 class="panel-title text-muted font-light">Balance</h4>
                                    </div>
                                    <div class="panel-body p-t-10">
				        <h4 class="m-t-0 m-b-15" style="margin-left: 78px;">Wallet : <i class="fa fa-rupee m-r-15"></i><?php echo $wallet_balance; ?></h4>
                                        <h4 class="m-t-0 m-b-15">Company Wallet : <i class="fa fa-rupee m-r-10"></i><?php echo $balance[0]['company_wallet_balance']; ?></h4>
                                        
                                        <!--<a class="" href="<?php // echo site_url('Wallet'); ?>" style="margin-left:82px">View Transactions</a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                          <a href="<?php echo base_url();?>/Support"> <h4 class="panel-title text-muted font-light">Tickets </h4></a>
                                    </div>
                                    <div class="panel-body p-t-10">
                                      <a href="<?php echo base_url();?>/Support"> 
					 <h4 class="m-t-0 m-b-15">Open : <?php echo $open_ticket[0]['total_open']; ?></h4>
                                        <h4 class="m-t-0 m-b-15" style="margin-left: 78px;">Close : <?php echo $close_ticket[0]['total_close']; ?></h4></a>
                                        <!--<a class="" href="<?php echo site_url('Wallet'); ?>" style="margin-left:82px">View Transactions</a>-->
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                        <h4 class="panel-title text-muted font-light">Wallet Balance</h4>
                                    </div>
                                    <div class="panel-body p-t-10">
                                        <h2 class="m-t-0 m-b-15"><i class="fa fa-rupee m-r-10"></i><b><?php echo $wallet_balance; ?></b></h2>
					<a class="" href="<?php echo site_url('Wallet');?>" style="margin-left:82px">View Transactions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4col-lg-4">
                                <div class="panel text-center">
                                    <div class="panel-heading">
                                        <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                        <h4 class="panel-title text-muted font-light">Transfered Balance</h4>
                                    </div>
                                    <div class="panel-body p-t-10">
                                        <h2 class="m-t-0 m-b-15"><i class="fa fa-rupee m-r-10"></i><b><?php echo $totaldeposite[0]['totaldeposite']; ?></b></h2>
<a class="" href="<?php echo site_url('Wallet');?>" style="margin-left:82px">View Transactions</a>
                                    </div>
                                </div>
                            </div>
                            <?php for ($i = 1; $i < 11; $i++) { ?>
                                <div class="col-sm-4 col-md-4col-lg-4">
                                    <div class="panel text-center">
                                        <div class="panel-heading">
                                            <div class="pull-left"><img src="<?php echo base_url() ?>/images/Flat_Currency_Rupee-512.png" style="width:78px;height:78px"/></div>
                                            <h4 class="panel-title text-muted font-light">Reward At Level <?php echo $i; ?></h4>
                                        </div>
                                        <div class="panel-body p-t-10">
                                            <h2 class="m-t-0 m-b-15"><i class="fa fa-rupee m-r-10"></i><b><?php echo $totalre[$i][0]['totalamount']; ?></b></h2>
<a class="" href="#" data-toggle="modal" data-target="#transactionmdl" onclick="viewdata(<?php echo $i ?>)" style="margin-left:82px">View Transactions</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>-->
                        </div>
                    <?php } else {
				
				if(empty($transaction_status) || $transaction_status[0]['status'] != "Approved"){				
			 ?>
                        <div class="page-content-wrapper ">
                            <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                                <div class="panel-body" id="paymentinfo" >
                                    <h4 class="m-b-30 m-t-0"><i class="fa fa-money"></i>&nbsp;&nbsp;Payment  </h4>

                                    <?php if ($this->session->flashdata('error')) { ?>
                                        <div class="alert alert-danger">
                                            <?php echo $this->session->flashdata('error'); ?>                        
                                            <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true" style="margin-top:-19px;">×</button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-success">
                                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                            <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">×</button>
                                        </div>
                                    <?php } ?> 
                                    <div class="col-sm-2 pull-right"> 

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">

                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <span class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Registration Amount: <i  class="fa fa-rupee "></i><?php echo ' ' . $registration_fee; ?></span>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-9">
                                                    <div class="  form-group ">
                                                        <label class=" col-md-4"> Bank Name</label>
                                                        <span class="  control-label" > <?php echo ' ' . $general_setting[6]['setting_value']; ?></span>
                                                    </div>
                                                    <div class=" form-group ">
                                                        <label class="col-md-4 "> IFSC Code</label>
                                                        <span class="control-label"  > <?php echo ' ' . $general_setting[7]['setting_value']; ?></span>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-md-4 "> Account Holder Name</label>
                                                        <span class=" control-label" > <?php echo ' ' . $general_setting[8]['setting_value']; ?></span>                                  </div>
                                                    <div class="form-group ">
                                                        <label class=" col-md-4 "> Account Number</label>

                                                        <span class=" control-label" > <?php echo ' ' . $general_setting[9]['setting_value']; ?></span>

                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <center>
                                                        <a href="#" data-target="#" data-toggle="modal" data-href="" class="text-muted">
                                                            <button class="btn btn-info waves-effect waves-light" type="submit"  onclick="checkrequeststatus()"> Pay Now </button>
                                                        </a>

                                                    </center>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div><!--end body-->
                            </div>
                        </div>
                    <?php }} ?>
                </div>
            </div>

            <div class="modal fade" id="bankdetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 >Fillup Your Bank Details</h4>
                        </div>

                        <?php echo form_open('Dashboard/bankdetail', array('id' => 'dtlfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

                        <div class="modal-body" id="">

                            <div class="form-group"> 
                                <label class=" control-label col-md-4">Bank Name <span class="text-danger">*</span></label> 
                                <div class="col-md-7">
                                    <input type="text" name="banknm" id="banknm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group "> 
                                <label class="col-md-4 control-label">Account Name <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="accountnm" id="accountnm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group "> 
                                <label class="col-md-4 control-label">Account No <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="accountno" id="accountno" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group "> 
                                <label class="col-md-4 control-label">IFSC Code <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="ifsccode" id="ifsccode" class="form-control"/>
                                </div>
                            </div>
                            <div class=""clearfix></div>
			    <div>
                                <p class="error">Note: Before submitting, Make sure that all the details are correct. Otherwise you may lost the money</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Submit" class="btn btn-info" >
                        </div>
                        <?php echo form_close(); ?> 
                    </div>
                </div>
            </div>



            <div class="modal fade" id="payment_frm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 >Fill Payment Information</h4>
                        </div>

                        <?php echo form_open('Fixpayment/pay', array('id' => 'addfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

                        <div class="modal-body" id="confirm_status_body">
                            <!--p>To reset your password, enter the email address you use to sign in to Foqoh. This can be your Foqoh email address associated with your Foqoh account.</p-->
                            <div class="form-group"> 
                                <label class=" control-label col-md-4">Payment Information <span class="text-danger">*</span></label> 
                                <div class="col-md-8">
                                    <textarea type="text"  rows="3" class="form-control rounded-0" name="paymentinfo" id="paymentinfo" placeholder="Enter Payment Information" value=""></textarea>
                                </div>
                            </div>


                            <div class="form-group "> 
                                <label class="col-md-4 control-label">Upload Payment related information</label>
                                <div class="col-md-8">
                                    <input type="file" class="filestyle"  name="image" >
                                </div>
                            </div>

                            <div class=""clearfix></div>
                            <!-- <div class="input-group" style="width:40px">
                                
                                
                             </div>  -->
                        </div>
                        <div class="modal-footer">

                            <input type="submit" value="Submit" class="btn btn-success" >

                        </div>
                        <?php echo form_close(); ?> 
                    </div>
                </div>
            </div>
            <div class="modal fade" id="paymentalert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php
                            if ($paymentstatus == 'Pending') {

                                $statement = ' Your Account Activation Request Is Pending , please wait';
                            } elseif ($paymentstatus == 'Declined') {
                                $statement = ' Your Account  Is  deactivated  by Admin ';
                            }
                            ?>
                            <h4 ></h4>
                        </div>

                        <?php echo form_open('Fixpayment/pay', array('id' => 'addfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

                        <div class="modal-body" id="confirm_status_body">
                            <!--p>To reset your password, enter the email address you use to sign in to Foqoh. This can be your Foqoh email address associated with your Foqoh account.</p-->
                            <div class="form-group"> 

                                <div class="col-md-12">

                                    <div class="alert alert-danger">
                                        <strong><?php echo $statement; ?></strong>                        
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($paymentcomment)) { ?>
                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Reason </label>
                                    <div class="col-md-10">

                                        <label class=" control-label">   <?php echo $paymentcomment; ?> </label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="input-group" style="width:40px">


                            </div>  
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>
                        <?php echo form_close(); ?> 
                    </div>
                </div>
            </div>

	<!----------------------reward transaction modal-------------------------------->


            <div class="modal fade bd-example-modal-lg" id="transactionmdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 >Transactions Information</h4>
                        </div>
                        <div class="modal-body" id="confirm_status_body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Reward From</th>
                                            <th>Amount</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <input type="hidden" id="levelid" value="0"/>
        <?php echo $footer;
        ?>
        <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        <script>


 $(document).ready(function () {
       var table = jQuery('#datatables').DataTable({
                                                                    "processing": true,
                                                                    "serverSide": true,
                                                                    "responsive": true,
                                                                    "order": [[0, "DESC"]],
                                                                    "ajax": {
                                                                        url: "<?php echo site_url('Wallet/listofrewards'); ?>",
                                                                        type: "GET",
                                                                        data: function (d) {
                                                                            d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                                                                            d.tid = $('#levelid').val();
                                                                           
                                                                        },
                                                                    },
                                                                    "columns": [

                                                                        {"taregts": 0, "sClass": "text-center", 'data': 'id'

                                                                        },
                                                                        {"taregts": 1, "sClass": "text-center", render: function (data, type, row) {

                                                                                return row.email;
                                                                            }

                                                                        },

                                                                        {"taregts": 2, "sClass": "text-center", 'data': 'amount'

                                                                        },

                                                                        {"taregts": 3, "sClass": "text-center", 'data': 'created_datetime',

                                                                        },
                                                                   
                                                                    ]
                                                                });
 });


                                                                jQuery("#addfrm").validate({

                                                                    rules: {

                                                                        paymentinfo: {
                                                                            required: true,
                                                                        },
                                                                    },
                                                                    messages: {
                                                                        paymentinfo: {
                                                                            required: "Enter Your payment varification code"
                                                                        },
                                                                    }
                                                                });

                                                                jQuery("#dtlfrm").validate({

                                                                    rules: {

                                                                        banknm: "required",
                                                                        accountnm: "required",
                                                                        accountno: "required",
                                                                        ifsccode: "required"
                                                                    },
                                                                    messages: {
                                                                        banknm: "please enter bank name ",
                                                                        accountnm: "please enter account holder name",
                                                                        accountno: "please enter account number",
                                                                        ifsccode: "please enter ifsc code of bank"
                                                                    }
                                                                });


                                                                function checkrequeststatus() {

                                                                    $.ajax({
                                                                        url: "<?php echo site_url() . 'Dashboard/checkrequeststatus' ?>",
                                                                        type: "POST",
                                                                        dataType: "json",
                                                                        data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                                                                        catch : false,
                                                                        success: function (data) {
                                                                            if (data.data == 1) {

                                                                                window.location.href = "<?php echo site_url() . 'Registrationpayment/index' ?>";
                                                                            } else {

                                                                                $('#payment_frm').modal();
                                                                            }
                                                                        }
                                                                    }
                                                                    );
                                                                }

							function viewdata(id) {
                                                        $('#levelid').val(id);
                                                              	$('#transactionmdl').show();
								refresh_table();
                                                              
                                                            }

                                                                function mycopyFunction() {

                                                                    var copyText = document.getElementById("copyTarget");
                                                                    copyText.select();
                                                                    document.execCommand("copy");
                                                                }
                                                                
                                                                
            function refresh_table() {
        var oTable1 = $('#datatables').dataTable();
        oTable1.fnStandingRedraw();
    }                                                    

    $.fn.dataTableExt.oApi.fnStandingRedraw = function (oSettings) {
        //redraw to account for filtering and sorting
        // concept here is that (for client side) there is a row got inserted at the end (for an add)
        // or when a record was modified it could be in the middle of the table
        // that is probably not supposed to be there - due to filtering / sorting
        // so we need to re process filtering and sorting
        // BUT - if it is server side - then this should be handled by the server - so skip this step
        if (oSettings.oFeatures.bServerSide === false) {
            var before = oSettings._iDisplayStart;
            oSettings.oApi._fnReDraw(oSettings);
            //iDisplayStart has been reset to zero - so lets change it back
            oSettings._iDisplayStart = before;
            oSettings.oApi._fnCalculateEnd(oSettings);
        }

        //draw the 'current' page
        oSettings.oApi._fnDraw(oSettings);
    };    

$(document).ready(function () {
                                                                //called when key is pressed in textbox
                                                                $("#accountno").keypress(function (e) {
                                                                    //if the letter is not digit then display error and don't type anything
                                                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                                                        //display error message
                                                                        $("#errmsg").html("Digits Only").show().fadeOut("slow");
                                                                        return false;
                                                                    }
                                                                });

                                                                //Only allow Alphanumerics
                                                                $('#ifsccode').bind('keyup', function (e) {
                                                                    $(this).val($(this).val().replace(/[^0-9a-zA-Z]/g, ''));
                                                                    if (e.which >= 97 && e.which <= 122) {
                                                                        var newKey = e.which - 32;
                                                                        e.keyCode = newKey;
                                                                        e.charCode = newKey;
                                                                    }
                                                                    $(this).val(($(this).val()).toUpperCase());
                                                                });

                                                                //Only allow Letters and Whitespace

                                                                $('#accountnm').keydown(function (e) {
                                                                    if (e.shiftKey || e.ctrlKey || e.altKey) {
                                                                        e.preventDefault();
                                                                    } else {
                                                                        var key = e.keyCode;
                                                                        if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                                                                            e.preventDefault();
                                                                        }
                                                                    }
                                                                });

                                                            });                                                            
        </script>
