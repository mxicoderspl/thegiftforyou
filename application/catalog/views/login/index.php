<!DOCTYPE html>	
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $general_setting[0]['setting_value']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="icon" href="<?php echo base_url(); ?>images/sm-logo.png" type="image/x-icon"/>
        <?php $this->minify->css(array('bootstrap.min.css', 'icons.css', 'style.css'));
        echo $this->minify->deploy_css();
        ?>


    </head>
    <body class="widescreen">
        <style>
            @media (max-width:384px){.form-group.m-t-30.m-b-0 > div{text-align:center; width:100%;}}
        </style>
        <div id="particles-bg"></div>
        <div id="particles-js"></div>
        <div class="accountbg back_bg"></div>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                     <h3 class="text-muted text-center m-t-0"> 
            <a href="<?php echo base_url('Home')?>"><img class="img-responsive logo-l" src="<?php echo base_url() ; ?>images/logo.png"></a>
                    </h3> <h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>

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


<?php echo form_open(site_url('Login/authenticate'), array('class' => 'form-horizontal m-t-20', 'id' => 'login_frm', 'method' => 'post')); ?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-9">
                            <div class="g-recaptcha" data-sitekey="<?php echo $sitekey ; ?>" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-15">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-xs-7"> <a href="#" data-target="#forgot_frm" data-toggle="modal" data-href="<?php echo site_url('Forgotpassword'); ?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a></div>
                        <div class="col-xs-5 text-right"> <a href="<?php echo site_url('Register'); ?>" class="text-muted">Create an account</a></div>
                    </div>
<?php echo form_close(); ?>

                </div>
            </div>
        </div>

        <div class="modal fade" id="forgot_frm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 >Forgot your password?</h4>
                    </div>
<?php echo form_open('Forgotpassword', 'class="form-horizontal" method="post" id="frmForgotPassword"'); ?>

                    <div class="modal-body" id="confirm_status_body">
                        <!--p>To reset your password, enter the email address you use to sign in to Foqoh. This can be your Foqoh email address associated with your Foqoh account.</p-->
                        <div class="input-group">
                            <span class="input-group-addon">&nbsp;Email&nbsp;&nbsp;</span>
                            <input type="text" maxlength="70" class="form-control" name="forgot_email" id="forgot_email" placeholder="Email" value="">

                        </div>
                        <div class="input-group">
                            &nbsp;
                            <label for="forgot_email" class="error">&nbsp;</label>
                        </div>  
                    </div>
                    <div class="modal-footer">

                        <input type="submit" value="Submit" class="btn btn-success" >

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


        <script>
            $(document).ready(function () {
                $('#login_frm').validate({
                    ignore: [],
                    rules: {
                       
                        password: {
                            required: true
                        },
                        user_name: {
                            required: true
                        }
                    },
                    messages: {
                        //                'g-recaptcha-response': {
                        //                    required: 'Please complete captcha chellange',
                        //                    remote: 'Invalid Captcha'
                        //                },
                        password: {
                            required: "Password is require"
                        },
                        user_name: {
                            required: 'Email id is require'
                        }
                    },
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "g-recaptcha-response") {
                            error.appendTo(element.parent("div").parent("div"));
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
                $('#frmForgotPassword').validate({
                    ignore: [],
                    rules: {
                        'forgot_email': {
                            required: true,
                            email: true,
                        }
                    },
                    messages: {
                        'forgot_email': {
                            required: "Email is require",
                            email: "Invalid email",
                        }
                    },
                });
            });
        </script>

    </body>

</html>

