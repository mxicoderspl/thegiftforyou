<!DOCTYPE html>
<html>
    <!-- Mirrored from themesdesign.in/webadmin_1.1/layouts/blue/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2017 03:56:33 GMT -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $general_setting[0]['setting_value']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
       <link rel="icon" href="<?php echo base_url();?>images/sm-logo.png" type="image/x-icon"/>
        <?php $this->minify->css(array('bootstrap.min.css', 'icons.css', 'style.css'));
        echo $this->minify->deploy_css();
        ?>
	
    </head>
    <body class="widescreen ">
        <div id="particles-bg"></div>
        <div id="particles-js"></div>
        
        <div class="accountbg back_bg"></div>
        <div class="accountbg back_bg"></div>
        <div class="wrapper-page register-new">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                     <a href="<?php echo base_url();?>"><!--<img class="img-responsive logo-l" src="<?php echo base_url() . 'userdash/'; ?>assets/images/logo.png">-->
                    <h3 class="text-muted text-center m-t-0"> 
            <img class="img-responsive logo-l" src="<?php echo base_url() ; ?>images/logo.png">
                    </h3>
                    </a>
                    <h4 class="text-muted text-center m-t-0"><b>Sign Up</b></h4>

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

                    <?php echo form_open_multipart('Register/user_register', array('class' => "form-horizontal m-t-20", 'id' => "user_register", 'name' => 'user_register')); ?>
                     
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="firstname" value="" name="firstname" placeholder="Firstname*">
                    </div>
		    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="lastname" value="" name="lastname" placeholder="Lastname*">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    
		    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="mobile_no" value="" name="mobile_no" placeholder="Mobile No.*" maxlength="10">
                    </div>
		    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="pan_no" value="" name="pan_no" placeholder="PAN Card No.*">
                    </div>
		    <div class="clearfix"></div><br>
		    
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="email" value="" name="email" placeholder="Email*"><br>
                    </div>
                     <?php if($refby!=''){?>
                    <div class="col-md-6 col-xs-6">
                        <div>Your Referral ID is <?php echo $refby;?></div>
                    </div>
                     <?php } else {?>
                            <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" id="ref_by" value="" name="ref_by" placeholder="Referral Code*"><br>
                    </div>    
                            <?php }?>
                  
                    <div class="clearfix"></div>
		    <div class="col-md-6 col-xs-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password*" ><br>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password*" ><br>
                    </div>
                   
                    <div class="clearfix"></div>
			
                    <div class="col-md-12 col-xs-12">
                        <div class="g-recaptcha" data-sitekey="<?php echo $general_setting[4]['setting_value']; ?>" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                    </div>
                    
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12"><br>
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12 text-center"> <a href="<?php echo site_url('Login'); ?>" class="text-muted">Already have an account?</a></div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        
        
        <?php
        $this->minify->js(array('jquery.min.js', 'bootstrap.min.js', 'modernizr.min.js', 'detect.js', 'fastclick.js', 'jquery.slimscroll.js', 'jquery.blockUI.js', 'waves.js', 'wow.min.js', 'jquery.nicescroll.js', 'jquery.scrollTo.min.js', 'app.js', 'jquery.validate.min.js', 'additional-methods.min.js'));
        echo $this->minify->deploy_js();
        ?>
        <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.min.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/detect.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/fastclick.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.slimscroll.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.blockUI.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/waves.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/wow.min.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.nicescroll.js"></script> 
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/userdash/assets/js/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url('userdash/assets/js/additional-methods.min.js'); ?>" ></script>-->
        <script src='https://www.google.com/recaptcha/api.js'></script>

        
        <script>



            $(document).ready(function (e) {
                jQuery("#user_register").validate({
                    ignore: [],
                    rules: {
                        
                        firstname: {
                            required: true,
                        },
			lastname: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "<?php echo site_url('Register/emailExits') ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#email").val();

                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                }
                            }
                        },
			pan_no: {
                            required: true,
                            remote: {
                                url: "<?php echo site_url('Register/pan_no_Exist') ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#pan_no").val();

                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                }
                            }
                        },
                        mobile_no: {
                            required: true,
                            remote: {
                                url: "<?php echo site_url('Register/mobile_no_Exist') ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#mobile_no").val();

                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                }
                            }
                        },
                       	ref_by: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        cpassword: {
			 required: true,	
			 equalTo: "#password",
                        },
                    },
                    messages: {
			firstname : {
				required:"Firstname is require."
			},
			lastname : {
				required:"Lastname is require."
			},
                        email: {
			    required: "Email Id is require",	
                            remote: "Email already exists.",
                        },
			pan_no: {
                            required: "PAN card Number is require",
                            remote: "PAN Number is already exists.",
                        },
                        mobile_no:{
                            required: "Mobile No is require",
                            remote: "Mobile No is already exists."
                        },
			password:{
				 required: "Password is require",		
			},
			ref_by : {
				required:"Referral Code is require."
			},
			cpassword:{
				required: "Confirm password is require.",	
				equalTo:"Confirm password didn't match.", 
			},
                    }

                });

            });
        </script> 

    </body>

</html>
