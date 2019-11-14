<?php echo $header; ?>
<?php echo $sidebar; ?>
<style>
    .alert{
        margin-left:141px;
        margin-right: 141px;
    }
</style>
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


                        <div class="row">
                            <div class="col-xs-12">
                                <!--<form method="post" action="<?php echo site_url('') ?>" id="detailfrm">-->
                                    <?php echo form_open('Bankdetail/update', array('id' => 'detailfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="form-horizontal">

                                        <div class="">
                                            <h4>Edit Bank Detail</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group ">
                                                <label class="col-md-4">Bank Name <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="banknm" id="banknm" value="<?php echo $bank_detail[0]['bank_name']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-md-4">Account Holder Name <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="accountnm" id="accountnm" value="<?php echo $bank_detail[0]['account_name']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4">Account Number <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="accountno" id="accountno" value="<?php echo $bank_detail[0]['account_no']; ?>"/>  
                                                </div>
                                            </div>
                                            <div class=" form-group ">
                                                <label class="col-md-4">IFSC Code <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="ifsccode" id="ifsccode" value="<?php echo $bank_detail[0]['ifsc_code']; ?>"/>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="form-group m-r-13">

                                        <center><button type="submit" name="submit" class="btn btn-info">Update</button></center>
                                    </div>
                                   <?php echo form_close(); ?> 
                                <!--</form>-->
                            </div>
                        </div>

                    </div>
                </div>

                <!--</div>-->
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

                                        jQuery("#detailfrm").validate({

                                            rules: {

                                                banknm: "required",
                                                accountnm: "required",
                                                accountno: "required",
                                                ifsccode: "required",
                                            },
                                            messages: {
                                                banknm: "please enter bank detail",
                                                accountnm: "please enter account holder name",
                                                accountno: "please enter account number",
                                                ifsccode: "please enter ifsc code",
                                            }
                                        });
                                        function edit(id) {

                                            $.ajax({
                                                url: "<?php echo site_url() . 'Registrationpayment/getpaymentinfo' ?>",

                                                type: "POST",
                                                dataType: "json",
                                                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', id: id},
                                                catch : false,
                                                success: function (data) {
                                                    if (data.status == 'success') {


                                                        $('#repayment_frm').modal();

                                                        $('#rpid').val(data.data.id);
                                                        $('#paymentinfo1').val(data.data.payment_information);

//                                                        $('#imageshow').attr("src", '<?php // echo base_url() . $this->config->item('upload_path_ads_thumb');                           ?>' + data.data.image);

                                                    } else {
                                                        flash_alert_msg(data.msg, 'error', 3000);
                                                    }

                                                }
                                            });
                                        }

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
