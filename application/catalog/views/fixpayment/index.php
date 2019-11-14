<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $general_setting[0]['setting_value']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <link rel="icon" href="<?php echo base_url(); ?>images/credible_favicon.ico" type="images/favicon.ico" sizes="16x16">
       
         <?php $this->minify->css(array('bootstrap.min.css', 'icons.css', 'style.css'));
        echo $this->minify->deploy_css();
        ?>
    </head>
     <body class="">
	<div id="particles-bg"></div>
<div id="particles-js"></div>
        <style>
            
            html{background:none;}
           
        </style>
        <div class="accountbg back_bg"></div>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                    <!-- <img class="img-responsive logo-l" src="<?php echo base_url() . 'userdash/'; ?>assets/images/logo.png">-->
                    <h3 class="text-muted text-center m-t-0"> 
            <span style="color:orange ">The</span>giftsfor<span style="color:orange">you</span>
                    </h3>
                    <br>
                    <h4 class="text-muted text-center m-t-0"><b>payment</b></h4>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?> 


                    <?php echo form_open(site_url('Fixpayment/pay'), array('class' => 'form-horizontal', 'id' => 'otp_frm', 'method' => 'post')); ?>
                  
                    <div class="form-group">
                        <div class="form-control waves-effect waves-light lgi"> Registraction Amount is :<?php echo $registration_fee ;?>/- </div>
                        <input type="hidden" name="user_id" value="<?php echo $ragi_id ;?>" >
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-5"></label>
                        <div class="col-md-7 ">
                            <button type="submit" class="btn btn-primary lg-btn ">Pay</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>


         <?php
        $this->minify->js(array('jquery.min.js', 'bootstrap.min.js', 'modernizr.min.js', 'detect.js', 'fastclick.js', 'jquery.slimscroll.js', 'jquery.blockUI.js', 'waves.js', 'wow.min.js', 'jquery.nicescroll.js', 'jquery.scrollTo.min.js', 'app.js', 'jquery.validate.min.js', 'additional-methods.min.js'));
        echo $this->minify->deploy_js();
        ?>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#otp_frm').validate({
                    rules: {
                        code: {
                            required: true,

                        }
                    },
                    messages: {
                        code: {required: "code is required"}
                    }
                });

            });
        </script>

    </body>

</html>






