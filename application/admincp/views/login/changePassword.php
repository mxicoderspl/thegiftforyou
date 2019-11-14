<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
        
        <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css">

        <link rel="icon" href="<?php echo base_url(); ?>assets/images/faviconm.ico" type="image/x-icon"/>

    </head>
    
    <body>
        
     <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                    <div class="row">
                <div class="col-sm-4"></div>
                
                <div class="col-sm-4"></div>
            </div>  
                    
                    <h3 class="text-center m-t-0 m-b-15"> 
                        <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url()?>../images/logo.png"/></a>
                    </h3>
                    
                    <h4 class="text-muted text-center m-t-0"><b>Reset Password</b></h4>
                    <div class="">
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
                       
                    <?php echo form_open($this->uri->uri_string(), array('id' => 'changepasswd', 'class' => 'form-horizontal login_frm tp_mrgn4', 'role' => 'form')); ?>
                    <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="New Password"  name="password" id="password" >
                    </div><!-- input-group -->
                    <div>&nbsp;
                        <label for="password" class="error"></label>
                    </div>
                    <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cnfpassword" id="cnfpassword">
                    </div><!-- input-group -->
                    <div>
                        &nbsp;
                        <label for="cnfpassword" class="error"></label>
                    </div>
                    
                    
                    <input type="submit" class="btn btn-block btn-primary" value="Change Password" />
                
                <?php
                echo form_close();
                ?>
                    
                    
                    
                    
                </div>
            </div>
        </div>
     <script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/modernizr.min.js"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/jquery.blockUI.js"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/jquery.nicescroll.js"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery.scrollTo.min.js"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/app.js"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery.validate.min.js"></script> 
        


        <script>
                                    $(document).ready(function () {

                                        $("#changepasswd").validate({
                                            rules: {
                                                password: {
                                                    required: true
                                                },
                                                cnfpassword: {
                                                    required: true,
                                                    equalTo: "#password"
                                                }
                                            },
                                            messages: {
                                                password: {
                                                    required: "New Password is required "
                                                },
                                                cnfpassword: {
                                                    required: "Confirm Password is required",
                                                    equalTo: "Confirm Password must mach with New Passowrd"
                                                }

                                            },
                                        });
                                    });
        </script>

        <script>
            $(document).ready(function () {

                $("#forgotfrm").validate({
                    rules: {
                        forgot_email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "<?php echo site_url('ForgotPassword/emailExist') ?>",
                                type: "post",
                                data: {
                                    forgot_email: function () {
                                        return $("#forgot_email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                }
                            }

                        }
                    },
                    messages:
                            {
                                forgot_email: {
                                    required: "Email is required ",
                                    email: "Enter Valid EmailId",
                                    remote: "Email id not exits"
                                }

                            },
                });
            });
        </script>
        <script type="text/javascript">
            function closediv()
            {
                $(".closediv").hide();
            }
        </script> 


    </body>
</html>
