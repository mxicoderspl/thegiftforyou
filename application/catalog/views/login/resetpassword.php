<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $general_setting[0]['setting_value']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'userdash/'; ?>assets/images/favicon.ico">
        <?php $this->minify->css(array('bootstrap.min.css', 'icons.css', 'style.css'));
        echo $this->minify->deploy_css();
        ?>
    </head>
    <body>
        <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                    <a href="<?php echo site_url('Home')?>"><img class="img-responsive logo-l" src="<?php echo base_url(); ?>images/logo.png"><br></a>
                    <h4 class="text-muted text-center m-t-0"><b>Reset Password</b></h4>

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



                    <?php echo form_open(site_url('Login/updatePassword'), array('class' => 'form-horizontal m-t-20', 'id' => 'login_frm', 'method' => 'post')); ?>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $userdata[0]['id']; ?>"/>
                    <div class="form-group">
                        <label for="" class="">New Password <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="">Confirm Password <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="password" class="form-control" id="confirmpasswd" name="confirmpasswd" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Submit</button>
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

        <script type="text/javascript">
            $(document).ready(function () {

                $('#login_frm').validate({
                    ignore: [],
                    rules: {

                        password: {
                            required: true,
                            
                        },
                        confirmpasswd: {
                            required: true,
                            equalTo: "#password"
                        },
                    },
                    messages: {

                        password: {
                            required: "Password is required."
                        },

                        confirmpasswd: {
                            required: "Confirm password is required.",
                            equalTo: "Confirm password didn't match. "
                        },
                    },

                });
            });
        </script>


    </body>

</html>

