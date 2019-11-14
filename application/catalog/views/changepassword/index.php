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
                                <!--<form method="post" action="<?php // echo site_url('') ?>" id="detailfrm">-->
                                <?php echo form_open('Changepassword/update', array('id' => 'changepassfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="form-horizontal">

                                    <div class="">
                                        <h4>Change Password</h4>
                                    </div>
                                    <hr>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11">
                                        <div class="form-group ">
                                            <label class="col-md-4">Old Password <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="password" name="oldpass" id="oldpass"/>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-md-4">New Password <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="password" name="newpass" id="newpass" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="password" name="confirmpass" id="confirmpass" />  
                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="form-group">

                                  <button type="submit" name="submit" class="btn btn-info" style="margin-left: 258px;margin-top: 16px;">Update</button>&nbsp;&nbsp;
                                        <a href="<?php echo site_url('Dashboard/index');?>" class="btn btn-default waves-effect" style="margin-right:12px;margin-top: 16px;">Cancel</a>
                                   
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

                                    jQuery("#changepassfrm").validate({
                                            
                                        rules: {

                                            oldpass: {
                                                required: true,
                                                remote: {
                                                    url: "<?php echo site_url('Changepassword/passwordExits') ?>",
                                                    type: "post",
                                                    data: {
                                                        oldpass: function () {
                                                            return $("#oldpass").val();

                                                        },
                                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                                    }
                                                }
                                            },
                                            newpass: "required",
                                            confirmpass: {
                                                required: true,
                                                equalTo: "#newpass"
                                            }
                                        },
                                        messages: {
                                            oldpass:{ required:"please enter old password",
                                                    remote:"wrong old password"
                                                },
                                            newpass: "please enter new password",
                                            confirmpass: {
                                                required: "please enter confirm password",
                                                equalTo: "confirm password did not match"
                                            }

                                        }
                                    });
                                    

    </script>
