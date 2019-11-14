<?php echo $header; ?>
<?php echo $sidebar; ?>

<div class="content-page">



    <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url(); ?>admincp/assets/images/ajax-loading.gif">
        <p style="margin:0;font-size:14px;color:#fff">loading...</p>
    </div>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">


    <div class="content">
        <div class="">
            <div class="page-header-title pull-left col-xs-12 padng_rmv" style="padding-bottom:0px;">
		<?php if(!empty($bank_detail) && !empty($registration_payment)){ ?>
		<div class="col-lg-4 col-xs-12 cstm-p">
            <div class="panel" style="margin-bottom:0px;">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class="pull-left img-bx">
                         <!-- <i class="fa fa-money" style=" color:#00b0ee; font-size:500% "></i>-->
			<img src="<?php echo base_url(); ?>/images/symbols/Company-Wallet.png" style=""/>
                      </div>
                      <div class="modal-body pull-left">
                      <p class="card-category text-center"> Company Wallet</p>
					  </div>
					  <div class="clearfix"></div>
					  <div class="col-xs-12 padng_rmv">
                      <h4 class="card-title pull-left">
			<small>Total : </small><i class="fa fa-inr font-16"></i>  <?php echo $conpanyWallet_balance; ?>
                          <!--<small>RS</small>-->
                      </h4>
					  </div>
					  <div class="pull-left">
                         <i class="  material-icons">&nbsp;&nbsp;Transfer </i>
                          <a href="" data-toggle="modal" data-target="#transaction"> To MY Wallet</a>
			  <!--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#transaction">Transfer Amount</button>-->
                     </div>
                      </div>
                  </div>
              
                  
              </div>
             
            <div class="col-lg-4 col-xs-12 cstm-p">
            <div class="panel"  style="margin-bottom:0px;">
                  <div class="col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class="pull-left img-bx">
                          <!--<i class="fa fa-credit-card" style=" color:#00b0ee; font-size:500% "></i>-->
			<img src="<?php echo base_url(); ?>/images/symbols/My Wallet.png" style=""/>
                      </div>
                      <div class="modal-body pull-left">
                          <p class="card-category text-center" style="font-size: 20px">MY Wallet</p>
						  </div>
						   <div class="clearfix"></div>
					  <div class="col-xs-12 padng_rmv">
                      <h4 class="card-title pull-left"> <small>Total : </small><i class="fa fa-inr font-16"></i> <?php echo $wallet_balance; ?>
                         
                      </h4>
					  </div>
					  <div class="pull-left">
                          <i class="  material-icons ">&nbsp;&nbsp;Show </i>
                          <a href="<?php echo base_url(); ?>Wallet">Transaction</a>
                     </div>
                      </div>
                  </div>
              
                 
              </div>
             </div>

	<?php } ?>
                <!--<h4 class="page-title">Payments</h4>-->
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="margin-bottom:85px;">

                                </a>
                                <h4 class="m-b-30 m-t-0">Company Wallet</h4>
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control  hasDatepicker" id="startdate" placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control hasDatepicker" id="enddate" placeholder="End Date">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary"  name="search" id="search" value="Search" />
                                            <!--<button type="button" class="btn btn-primary" onclick="payment_sheet()" >Transfer Amount</button>-->
                                           <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaction">Transfer Amount</button>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-hover m-b-0   dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th>Transaction ID</th>
								<th>Type</th>
								<th>Amount</th>
                                                                <!--<th>Total TAX</th>-->
								<th>Comment</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


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
            </div>
        </div>
    </div>
    <!----------- edit modal-------------------------->
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="model_data">

            </div>
        </div>
    </div>

    <div class="modal fade" id="transaction" tabindex="-1" role="dialog" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="panelt panel-success-head">-->
                <?php echo form_open('Companywallet/transfer', array('id' => 'frmtransfer')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Transfer Amount to your Wallet</h4>
                </div>

                <div class="modal-body">
                    <!--                    <h5>Are you sure you want to confirm payment?</h5>-->
                    <!--<form action="<?php // echo site_url('Companywallet/transfer')    ?>" method="post">-->
		    <input type="hidden" name="tax" id="tax"/>
                    <div class="form-group">
                        <label class="form-lable col-sm-4">Enter Amount You want to Transfer <span class="text-danger">*</span> :</label>
			<div class="col-sm-8">
                        <input type="text" class="form-control" name="amount" id="amount" value="" maxlength="12"/>
			</div>
                    </div>
                    <!--<div class="col-md-4"></div>-->
                    <div class="clearfix"></div>
                    
                    <div id="mydemo" style="margin-left:12px"></div>
                   
                    <!--<div class="form-group col-md-12" style="display:none">
                        <label class="form-lable col-sm-6">Total Tax Amount :</label>
			<div class="col-sm-6">
                        <span class=""  class="" name="totaltax" id="totaltax"></span>
			</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12">
                        <label class="form-lable col-sm-3">Total Amount :</label>
			<div class="col-sm-6">
                        <span class="" name="totalamount" id="totalamount"></span>
			</div>
                    </div>
                    <div class="clearfix"></div>-->

                </div>
                <div class="modal-footer">
                    <div class="pull-right">
			<button type="button" class="btn btn-success" onclick="modal()">Transfer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="hidden" id="csvid" value="0" />
                        

                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
<!---------------- confirm modal ------------------->

<div class="modal fade" id="confirm-transfer" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panelt panel-success-head">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="panel-title">Confirm Transfer</h3>
                </div>
                <div class="panel-body">
                    <h5>Are you sure you want to transfer this Amount to Company wallet ?</h5>
		   <?php //echo form_open('Companywallet/transfer', array('id' => 'frmtransfer1')); ?>
                    <input type="hidden" value="" id="deleteadsid" />
                    <div class="pull-right">
                        <a id="confirm_btn" href="#" onclick="confirm_transfer()" class="btn btn-danger">Yes</a>
                        <button data-dismiss="modal" class="btn btn-default">No</button>
                    </div>
		   <?php //echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php echo $footer ?>

    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script>
				 function modal() {
                                    if ($('#amount').val()) {

                                        $('#confirm-transfer').modal('show');
                                        $('#transaction').modal('hide');
                                    } else {
                                        $('#frmtransfer').submit();
                                    }
                                }
                                function confirm_transfer() {

                                    $('#frmtransfer').submit();
                                  
                                }
                                    function load_data() {
                                        var table = jQuery('#datatables').DataTable({
                                            "processing": true,
                                            "serverSide": true,
                                            "responsive": true,
                                            "order": [[0, "DESC"]],
                                            "ajax": {
                                                url: "<?php echo site_url('Companywallet/transaction'); ?>",
                                                type: "GET",
                                                data: function (d) {
                                                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";

                                                    d.from_date = function () {
                                                        return $('#startdate').val();
                                                    };
                                                    d.to_date = function () {
                                                        return $('#enddate').val();
                                                    };
                                                },
                                            },
                                            "columns": [
                                                {"taregts": 0, 'data': 'wallet_transaction_id'

                                                },
                                           	{"taregts": 1, 'data': 'type'

                                                },
 						{"taregts": 2, render: function (data, type, row) {

                                                            return '<?php echo $this->config->item('currency_icon') ?> ' + row.amount;
                                                        }

                                                },
                                                //{"taregts": 3, 'data': 'total_tax'

                                                //},
                                                {"taregts": 3, 'data': 'comment'

                                                },    	                                          
                                                {"taregts": 4, 'data': 'created_date'

                                                },
                                            ]
                                        });
                                        $('#search').on('click', function () {
                                            reload_transaction_table();
                                        });
                                    }
                                    $(document).ready(function () {

                                        load_data();

                                    });
                                    function reload_transaction_table() {
                                        var oTable1 = $('#datatables').dataTable();
                                        oTable1.fnStandingRedraw();
                                    }
                                    $('#startdate').datepicker({
                                        format: "yyyy-mm-dd"
                                    });
                                    $('#enddate').datepicker({
                                        format: "yyyy-mm-dd"
                                    });
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

//                            function countTax() {
                                  /*  $("#amount").keyup(function () {
                                        var amount = $('#amount').val();
                                        //alert(amount);
                                        $.ajax({
                                            url: "<?php echo site_url() . 'Companywallet/countTax' ?>",
                                            type: "POST",
                                            dataType: "json",
                                            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', amount: amount},
                                            catch : false,
                                            success: function (data) {
                                                  var tax_amount = new Array();
                                                    $('#totaltax').text(data.total_tax );
						    $('#tax').val(data.total_tax);
                                                    $('#totalamount').text('Rs. ' + data.total_amount);
                                                    $('#mydemo').empty();
                                                    for (var i = 0; i < data.tax.length; i++) {
                                                        //var amount = $('#amount').val();

                                                        //tax_amount[i] = (amount * data.tax[i].percentage) / 100;
                                                        $('#mydemo').append('<div class="form-group col-md-6">'
                                                                + '<label class="form-lable ">' + data.tax[i].title + ' : ' + '</label>'
                                                                + '<span class="">' +' '+ data.tax[i].percentage +  ' %' +'</span>'
                                                                + '</div>'
                                                                //+ '<div class="form-group col-md-6">'
                                                              //  + '<label class="form-lable ">' + data.tax[i].title + ' Amount: ' + '</label>'
                                                               // + '<input type="text" class="form-control" value="'+ tax_amount[i] +'" disabled readonly class="">'
                                                               // + '</div>'
                                                               // + '<div class="clearfix"></div>'
);

                                                    }


                                            }
                                        });
                                    });*/

                                    function transfer() {
                                        $.ajax({
                                            url: "<?php echo site_url() . 'Companywallet/transfer' ?>",
                                            type: "POST",
                                            dataType: "json",
                                            data: $('frmtransfer').serialize(),
                                            catch : false,
                                            success: function (data) {

                                                return $('#tax').val(data.tax);

                                            }
                                        });
                                    }
jQuery("#frmtransfer").validate({

            rules: {

                amount: {
                    required: true,
                },

            },
            messages: {
                amount: {
                    required: "Please enter amount you want to transfer. "
                },

            }


        });
	$("#amount").keypress(function (event) {

            //$(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if (event.which != 8 && (event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                return false;
            }
        });

    </script>
