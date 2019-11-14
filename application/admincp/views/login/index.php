
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
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link rel="icon" href="<?php echo base_url('../'); ?>images/sm-logo.png" type="image/x-icon"/>
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
                    
                    
                    <div class="logo text-center">
                        <!--<a href="<?php echo base_url();?>"><img style="height:100px;min-width:235px"  src="<?php echo base_url('../admincp/assets/images/imageslogo.png'); ?>" alt="thegiftsforyou" class="logo-site" ></a>-->
			<h3 class="text-center m-t-0 m-b-15"> 
                        <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url()?>../images/logo.png" style="height: 46px;"/></a>
                    </h3>
                    </div>
                    <h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>
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
                        <?php echo form_open('login/authenticate', array('id' => 'loginfrm', 'class' => 'form-horizontal m-t-20', 'role' => 'form')); ?>
                    
                        <div class="form-group">
                            <div class="col-xs-12"> 
                                <input class="form-control" type="text" id="username" name="user_name" placeholder="Username">
                            <label for="username" class="error" style="color:red;display:none"></label>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12"> 
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                            <label for="password" class="error" style="color:red;display:none"></label>
                            </div>
                            
                            
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" name="remember" type="checkbox"> 
                                    <label for="checkbox-signup"> Remember me </label></div>
                            </div></div>
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                               
                               <!-- <div class="col-sm-5 text-right"> 
                                    <a href="pages-register.html" class="text-muted">Create an account</a>
                                </div>--> 
                                <div class="col-sm-7 form-group">
                                    
                                    <span class="msg-error error"></span>
                                  <!--  <div class="g-recaptcha" name="grecaptcha"  id="recaptcha" data-sitekey="<?php echo $sitekey; ?>"></div> -->   
                                 <label for="password" class="error" style="color:red;display:none"></label>
                          
                                </div>
                                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="btn-validate" type="submit">Log In</button></div></div><div class="form-group m-t-30 m-b-0">
                                
                                 <div class="col-sm-7 form-group">
                                    <a data-href="<?php echo site_url('Forgotpassword'); ?>" title="Forgot your password?" data-toggle="modal" data-target="#confirm-status" href="#"  class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                </div>
                                </div>
                   <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div> 
        
      <div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="confirm_status_title">Forgot your password?</h4>
                        </div>
                        <?php echo form_open('ForgotPassword', 'class="form-horizontal" id="forgotfrm"'); ?>
                        <div class="modal-body" id="confirm_status_body">
                            <div class="col-xs-12">

                                <input type="text" maxlength="70" class="form-control" name="forgot_email" id="forgot_email" placeholder="Email" value="">
                            </div>
                            <label for="forgot_email" class="error" style="color:red;display:none">&nbsp;</label>

                            <div class="input-group">                            
                            </div>  
                        </div><br><br><br>
                        <div class="modal-footer">
                            <input type="submit"  value="Send" class="btn btn-success" >
                        </div>
                        <?php echo form_close(); ?> 
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
        
        <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#confirm-status').on('show.bs.modal', function (e) {
                                        $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                                    });
                                });
        </script> 
        <script>
            $(document).ready(function () {
                $("#loginfrm").validate({
                    rules: {
                        user_name: {
                            required: true

                        },
                        password: {
                            required: true

                        },
                        grecaptcha: {
                            required: true

                        }
                        
                    },
                    messages: {
                        user_name: {
                            required: "User name is required "
                        },
                        password: {
                            required: "Password is required"
                        },
                        grecaptcha: {
                            required: "google recaptcha is required"
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#forgotfrm").validate({
                    rules: {
                        forgot_email: {
                            required: true,
                            email: true
                        },
                    },
                    messages: {
                        forgot_email: {
                            required: "Email is required ",
                            email: "Please enter Valid email"
                        }
                    }
                });
            });
    /*  $( '#btn-validate' ).click(function(){
  var $captcha = $( '#recaptcha' ),
      response = grecaptcha.getResponse();
  
  if (response.length === 0) {
    $( '.msg-error').text( "reCAPTCHA is mandatory" );
    if( !$captcha.hasClass( "error" ) ){
      $captcha.addClass( "error" );
    }
  } else {
    $( '.msg-error' ).text('');
    $captcha.removeClass( "error" );
    alert( 'reCAPTCHA marked' );
  }
})*/
        </script>
        
    </body>
</html>
