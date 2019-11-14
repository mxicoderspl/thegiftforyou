<?php echo $header; ?>
<?php echo $sidebar; ?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">

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
                <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                    <div class="panel-body" id="paymentinfo">

                        <h4 class="m-b-30 m-t-0"><i class="fa fa-money"></i>&nbsp;&nbsp;Registration Fee Payment Information</h4>
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-horizontal">
                                    <?php if (!empty($register_payment_detail)) { ?>
                                        <div class="form-group">
                                            <span class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Registration Amount: <i  class="fa fa-rupee "></i><?php echo ' ' . $registration_fee; ?></span>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
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
                                                <span class=" control-label" > <?php echo ' ' . $general_setting[8]['setting_value']; ?></span>                                  
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 "> Account Number</label>
                                                <span class=" control-label" > <?php echo ' ' . $general_setting[9]['setting_value']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 "> Transaction Id</label>
                                                <span class=" control-label" > <?php echo ' ' . $register_payment_detail[0]['id']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Amount</label>
                                                <span class=" control-label" > <i class="fa fa-rupee"></i><?php echo ' ' . $register_payment_detail[0]['amount']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Status</label>
                                                <span class=" control-label" > <?php echo ' ' . $register_payment_detail[0]['status']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Transaction Date</label>
                                                <span class=" control-label" > <?php echo ' ' . $register_payment_detail[0]['created_datetime']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Comment</label>
                                                <span class=" control-label" > <?php echo ' ' . $register_payment_detail[0]['comment']; ?></span>
                                            </div>

                                        </div>
                                        <?php if ($register_payment_detail[0]['status'] == "Declined") { ?>
                                            <div class="form-group">
                                                <center>

                                                    <a href="#" onclick="edit(<?php echo $register_payment_detail[0]['id'] ?>)" class=" btn btn-info text-muted">Re-send Payment Request</a>
                                                </center>
                                            </div>
                                        <?php } else if ($register_payment_detail[0]['status'] == "Pending") { ?>
                                            <div class="form-group">
                                                <center>
                                                    <a href="#" onclick="edit(<?php echo $register_payment_detail[0]['id'] ?>)" class=" btn btn-info text-muted">Edit Paymentment Detail</a>
                                                </center>
                                            </div>

                                        <?php } else { ?>
                                            <div class="form-group">
                                                <center>
                                                    <a href="<?php echo site_url('Registrationpayment/viewrewarddetail');?>" class=" btn btn-info text-muted">Registration Fee Distribution</a>
                                                </center>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <p>Opps!! No information Found..</p>
                                        <br/>
                                        <div class="form-group">
                                            <center><a href="<?php echo site_url('Dashboard/index') ?>" class="btn btn-info">Please send payment Request</a></center>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="modal fade" id="repayment_frm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 >Re-Fill Payment Information</h4>
                </div>

                <?php echo form_open('Registrationpayment/updaterequest', array('id' => 'editfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

                <div class="modal-body" id="confirm_status_body">
                    <!--p>To reset your password, enter the email address you use to sign in to Foqoh. This can be your Foqoh email address associated with your Foqoh account.</p-->
                    <input type="hidden" name="rpid" id="rpid" />
                    <div class="form-group"> 
                        <label class=" control-label col-md-4">Payment Information <span class="text-danger">*</span></label> 
                        <div class="col-md-8">
                            <textarea type="text"  rows="3" class="form-control rounded-0" name="paymentinfo1" id="paymentinfo1" placeholder="Enter Payment Information" value=""></textarea>
                        </div>
                    </div>


                    <div class="form-group "> 
                        <label class="col-md-4 control-label">Upload Payment related information</label>
                        <div class="col-md-8">
                            <input type="file" class="filestyle"  name="image" >
                        </div>
                    </div>

                    <div class=""clearfix></div>

                </div>

                <div class="modal-footer">

                    <input type="submit" value="Submit" class="btn btn-success" >

                </div>
                <?php echo form_close(); ?> 
            </div>
        </div>
    </div>

    <?php echo $footer; ?>
    <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    <!--jquer, javascript and ajax-->
    <script type="text/javascript">

                                                        jQuery("#editfrm").validate({

                                                            rules: {

                                                                paymentinfo1: {
                                                                    required: true,
                                                                },
                                                            },
                                                            messages: {
                                                                paymentinfo1: {
                                                                    required: "Enter Your payment varification code"
                                                                },
                                                            }
                                                        });

//                                                        function showdetail(id) {
//                                                            $.ajax({
//                                                                url: "<?php echo site_url() . 'Registrationpayment/showrewardinfo' ?>",
//
//                                                                type: "POST",
//                                                                dataType: "json",
//                                                                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', id: id},
//                                                                catch : false,
//                                                                success: function () {
//                                                                    if (data.status == 'success') {
//                                                                        
//
//                                                                    } else {
//                                                                        flash_alert_msg(data.msg, 'error', 3000);
//                                                                    }
//
//                                                                }
//                                                            });
//                                                        }

                                                        function edit(id) {

                                                            $.ajax({
                                                                url: "<?php echo site_url() . 'Registrationpayment/getpaymentinfo' ?>",

                                                                type: "POST",
                                                                dataType: "json",
                                                                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', id: id},
                                                                catch : false,
                                                                success: function (data) {
                                                                    if (data.status == 'success') {

//                                                        $('#adsid').val(id);
                                                                        $('#repayment_frm').modal();

                                                                        $('#rpid').val(data.data.id);
                                                                        $('#paymentinfo1').val(data.data.payment_information);

//                                                        $('#imageshow').attr("src", '<?php // echo base_url() . $this->config->item('upload_path_ads_thumb');        ?>' + data.data.image);

                                                                    } else {
                                                                        flash_alert_msg(data.msg, 'error', 3000);
                                                                    }

                                                                }
                                                            });
                                                        }

                                                        function load_data() {
                                                            var table = jQuery('#datatables').DataTable({
                                                                "processing": true,
                                                                "serverSide": true,
                                                                "responsive": true,
                                                                "order": [[0, "DESC"]],
                                                                "ajax": {
                                                                    url: "<?php echo site_url('Registrationpayment/getdata'); ?>",
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

                                                                    {"taregts": 0, "sClass": "text-center", 'data': 'id'

                                                                    },

                                                                    {"taregts": 2, "sClass": "text-center", render: function (data,type,row) {

                                                            			return '<?php echo $this->config->item('currency_icon') ?> ' + row.amount;
				                                        }

                                                                    },

                                                                    {"taregts": 3, 'data': 'comment',

                                                                    },
                                                                    {"taregts": 4, "sClass": "text-center", 'data': 'status',

                                                                    },
                                                                    {"taregts": 5, "sClass": "text-center", 'data': 'created_datetime'

                                                                    },
                                                                    {"taregts": 6, "render": function (data, type, row) {
                                                                            if (row.status == "Declined") {
                                                                                var out = '';
                                                                                out += '<a href="#" onclick="edit(' + row.id + ')" class="text-muted"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                                                                                return out;
                                                                            } else {
//                                                               var out += '';
                                                                                return out = '';
                                                                            }
                                                                        }
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
    </script>
