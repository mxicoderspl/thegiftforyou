<?php echo $header; ?>
<?php echo $sidebar; ?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">
	 <div class="col-lg-6 col-md-6 col-sm-6" style="padding-left: 30px;padding-right: 15px  ">
            <div class="panel">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-money" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                      <p class="card-category text-center" style="font-size: 20px">MY Wallet </p>
                      <h3 class="card-title pull-right"><?php echo $wallet_balance; ?>
                          <small>RS</small>
                      </h3>
                      </div>
                  </div>
              
                  <div class=" row modal-footer" >
                        <div class="pull-left">
                          <i class="  material-icons text-danger">Transfer </i>
                          <a href="#" data-toggle="modal" data-target="#transfer_to_other"> To Other Wallet ...</a>
                     </div>
                      <div class="pull-right">
                          <i class="  material-icons text-danger">Transfer </i>
                          <a href="" data-toggle="modal" data-target="#transfer"> To Company Wallet ...</a>
                     </div>
                      
                  </div>
              </div>
             </div>
            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-left: 10px ; padding-right: 30px ">
            <div class="panel">
                  <div class=" col-md-12 panel-heading-header card-header-warning card-header-icon">
                      <div class=" pull-left">
                          <i class="fa fa-credit-card" style=" color:#00b0ee; font-size:500% "></i>
                      </div>
                      <div class=" modal-body ">
                          <p class="card-category text-center" style="font-size: 20px">Company Wallet</p>
                      <h3 class="card-title pull-right"><?php echo $conpanyWallet_balance; ?>
                          <small>RS</small>
                      </h3>
                      </div>
                  </div>
              
                  <div class=" row modal-footer" >
                    <div class="pull-left">
                          <i class="  material-icons text-danger">Show </i>
                          <a href="<?php echo base_url(); ?>Companywallet"> Transaction...</a>
                     </div>
                  </div>
              </div>
             </div>
            <!--<div class="container">-->
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
                <div class="col-xs-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Wallet Transaction
                                    <div class="col-sm-2 pull-right"> 
                                    </div>
                                </h4>
                                <div class="col-xs-2"><label class="datefilterlabel">Date Filter:</label></div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="startdate" placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" value="" id="enddate" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-default" onclick="reload_transaction_table()" >Search</button>
                                </div>
				<!-- <div class="col-xs-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transfer">Transfer Amount</button>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <input type="hidden" id="wtid" name="wtid" value="<?php echo (isset($_GET['wtid']) && $_GET['wtid'] != '') ? $_GET['wtid'] : ''; ?>" />
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Transaction Id</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Comment</th>
                                                    <th>Transaction Date</th>

                                                </tr>
                                            </thead>

                                        </table>

                                        <!--</div>-->
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>



                </div>

                <!--</div>-->
            </div>
        </div>
    </div>

 <div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="panelt panel-success-head">-->
                <?php echo form_open('Wallet/transfer', array('id' => 'frmtransfer')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Transfer Amount to Company Wallet</h4>
                </div>

                <div class="modal-body">
                    <!--                    <h5>Are you sure you want to confirm payment?</h5>-->
                    <!--<form action="<?php // echo site_url('Companywallet/transfer')    ?>" method="post">-->
			<input type="hidden" name="tax" id="tax"/>
                    <div class="form-group">
                        <label class="form-lable col-sm-4">Enter Amount You want to Transfer <span class="text-danger">*</span> :</label>
			<div class="col-sm-8">
                        <input type="text" class="form-control" name="amount" id="amount" value="" />
			</div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="clearfix"></div>
                    
                    <!--<div id="mydemo"></div>
                   
                    <div class="form-group col-md-6">
                        <label class="form-lable">Total Tax Amount :</label>
                        <span class="" name="totaltax" id="totaltax"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-6">
                        <label class="form-lable">Total Amount :</label>
                        <span class="" name="totalamount" id="totalamount"></span>
                    </div>-->
                    <div class="clearfix"></div>

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

<div class="modal fade" id="transfer_to_other" tabindex="-1" role="dialog" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="panelt panel-success-head">-->
                <?php echo form_open('Wallet/transfer_to_other', array('id' => 'frm_transfer')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Transfer Amount to Other's  Wallet</h4>
                </div>

                <div class="modal-body">
                    <!--                    <h5>Are you sure you want to confirm payment?</h5>-->
                    <!--<form action="<?php // echo site_url('Companywallet/transfer')                    ?>" method="post">-->
                    <input type="hidden" name="tax" id="tax"/>
                    <div class="form-group col-12">
                        <label class="form-lable col-md-4">Enter Mobile No:<span class="text-danger">*</span> :</label>
                        <div class="col-md-8">
                        <input type="text" class="form-control" name="mobile" id="mobile" value="" />
                        </div>
                    </div>
			<div class="clearfix"></div>
                    <div id="profile" style="margin-left:12px"></div>
                    <div class="clearfix"></div>
                    <div class="form-group col-12"><br>
                        <label class="form-lable col-md-4">Enter Amount You want to Transfer <span class="text-danger">*</span> :</label>
                        <div class="col-md-8">
                        <input type="text" class="form-control" name="transfer_amount" id="transfer_amount" value="" />
                       </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="form-group col-12">
                        <label class="col-md-4">Applied Taxes: </label>
			<div class="col-md-8">
                        <p class="" id="mydemo"></p>
			</div>
                    </div>
		   <div class="clearfix"></div>
                    <div class="form-group col-12">
                        <label class="col-md-4">Total Amount: </label>
			<div class="col-md-8">
                        <p class="" id="totalamount" ></p>
			</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btn_transfer" onclick="confirm_modal()">Transfer</button>
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
		  
                    <input type="hidden" value="" id="deleteadsid" />
                    <div class="pull-right">
                        <a id="confirm_btn" href="#" onclick="confirm_transfer()" class="btn btn-danger">Yes</a>
                        <button data-dismiss="modal" class="btn btn-default">No</button>
                    </div>
		  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cnfrmtransfer" tabindex="-1" role="dialog" aria-hidden="true"> 
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
                            <a id="confirm_btn" href="#" onclick="confirm_transfer1()" class="btn btn-danger">Yes</a>
                            <button data-dismiss="modal" class="btn btn-default">No</button>
                        </div>
                        <?php //echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $footer ?>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    <!--jquer, javascript and ajax-->
    <script type="text/javascript">
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
				 function confirm_modal() {
                                    if ($('#transfer_amount').val()) {
                                        //user_profile();
                                        $('#transfer_to_other').modal('hide');
                                        $('#cnfrmtransfer').modal('show');

                                    } else {
                                        $('#frmtransfer').submit();
                                    }
                                }
                                function confirm_transfer1() {

                                    $('#frm_transfer').submit();
                                  
                                }
                                        function load_data() {
                                            var table = jQuery('#datatables').DataTable({
                                                "processing": true,
                                                "serverSide": true,
                                                "responsive": true,
                                                "order": [[0, "DESC"]],
                                                "ajax": {
                                                    url: "<?php echo site_url('wallet/getwalletdata'); ?>",
                                                    type: "GET",
                                                    data: function (d) {
                                                        d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                                                        d.from_date = function () {
                                                            return $('#startdate').val();
                                                        };
                                                        d.to_date = function () {
                                                            return $('#enddate').val();
                                                        };
                                                        d.wtid = function () {
                                                            return $('#wtid').val();
                                                        };

                                                    },
                                                },
                                                "columns": [

                                                    {"taregts": 0,"sClass": "text-center", 'data': 'id'

                                                    },
                                                    {"taregts": 1, "sClass": "text-center",'data': 'type'

                                                    },
                                                    {"taregts": 2, "sClass": "text-center",'data': 'amount'

                                                    },

                                                    {"taregts": 3, 'data': 'comment',

                                                    },
                                                    {"taregts": 4, 'data': 'created_datetime'

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


                                        function transfer() {
                                            $.ajax({
                                                url: "<?php echo site_url() . 'Wallet/transfer' ?>",
                                                type: "POST",
                                                dataType: "json",
                                                data: $('frmtransfer').serialize(),
                                                catch : false,
                                                success: function (data) {

                                                    return $('#tax').val(data.tax);

                                                }
                                            });
                                        }


		   $("#transfer_amount").keyup(function () {

                                    var amount = $('#transfer_amount').val();
					
                                    $.ajax({
                                        url: "<?php echo site_url() . 'Wallet/countTax' ?>",
                                        type: "POST",
                                        dataType: "json",
                                        data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                                            amount: amount
                                        },
                                        catch : false,
                                        success: function (data) {
                                            var tax_amount = new Array();
//                                            $('#totaltax').text('Rs. ' + data.total_tax);
                                            $('#tax').val(data.total_tax);
                                            $('#totalamount').text('Rs. ' + data.total_amount);
                                            $('#mydemo').empty();
                                            for (var i = 0; i < data.tax.length; i++) {
                                                var amount = $('#transfer_amount').val();

                                                   $('#mydemo').append(
                                               
                                                        +'<span class="">' + data.tax[i].title + ':' + data.tax[i].percentage + ' %' + ' ,' +'</span>'
//                                                        
                                                        );

                                            }

                                        }
                                    });
                                });


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
jQuery("#frm_transfer").validate({

                                    rules: {

                                        transfer_amount: {
                                            required: true,
                                        },
                                        mobile: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo site_url('Wallet/contactExist') ?>",
                                                type: "post",
                                                data: {
                                                    mobile_no: function () {
                                                        return $("#mobile").val();
                                                    },
                                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                                },

                                            }
                                        }

                                    },
                                    messages: {
                                        transfer_amount: {
                                            required: "Please enter amount you want to transfer."
                                        },
                                        mobile: {
                                            required: "Please enter Mobile number",
                                            remote: "Mobile number not Registered.Please try again"
                                        }

                                    }


                                });

 $("#mobile").keyup(function () {

                                    var mobile = $('#mobile').val();
					if(mobile){
                                    $.ajax({
                                        url: "<?php echo site_url() . 'Wallet/getAllinfo' ?>",
                                        type: "POST",
                                        dataType: "json",
                                        data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                            mobile_no: mobile,

                                        },
                                        catch : false,
                                        success: function (data) {
                                            $('#profile').empty();
                                            $('#profile').append('<div class="form-group col-md-6">'
                                                    + '<label class="form-lable "></label>'
                                                    + '<span class=""><img class="img-circle" src="<?php echo base_url() . $this->config->item('upload_path_profilepic_thumb'); ?>' + data.profile.profilepic + '"style="height:45px;width:45px"/>' + '</b></span>&nbsp;&nbsp;&nbsp;'
                                                    + '<span class=""><b>' + data.profile.firstname + ' ' + data.profile.lastname + '</b></span>&nbsp;&nbsp;'
//                                                    + '<span class="">' + data.profile.mobile_no + '</span>'
                                                    + '</div>'
                                                    );

                                        }
                                    });
}else{ $('#profile').hide(); }
                                });


    </script>
