<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>ToxiCoin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'userdash/'; ?>assets/images/favicon.ico">
        <link href="<?php echo base_url() . 'userdash/'; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'userdash/'; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'userdash/'; ?>assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="accountbg"></div>
        <div class="wrapper-page contact_frm">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body ">
                    <div class="col-md-7">
                        <h3 class="text-center m-t-0 m-b-15"> <a href="<?php echo site_url(); ?>" class="logo logo-admin"><img src="<?php echo base_url() . 'userdash/'; ?>image/logo.png" class="img-responsive" /></a></h3>
                        <h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>

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


                        <?php echo form_open(site_url('Contact/send'), array('class' => 'form-horizontal m-t-20', 'id' => 'frmContact', 'method' => 'post')); ?>
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="firstname">Firstname </label>&nbsp;<span class="error">*</span>
                                        <input id="firstname" name="firstname" class="form-control" placeholder="Please enter your firstname " type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="lastname">Lastname </label>&nbsp;<span class="error">*</span>
                                        <input id="lastname" name="lastname" class="form-control" placeholder="Please enter your lastname " type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="email">Email </label>&nbsp;<span class="error">*</span>
                                        <input id="email" name="email" class="form-control" placeholder="Please enter your email " type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="subject">Subject </label>&nbsp;<span class="error">*</span>
                                        <input id="subject" name="subject" class="form-control" placeholder="Please enter subject" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <label for="message">Message </label>&nbsp;<span class="error">*</span>
                                        <textarea id="message" name="message" class="form-control" placeholder="Message" rows="4" ></textarea>
                                    </div>
                                </div>
                                 <div class="clearfix"></div><br>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="g-recaptcha" data-sitekey="6Lf36xQUAAAAACZS40E2FnCNbhUDH8BO3fvfeVi2" style="transform:scale(1.1);-webkit-transform:scale(1.1);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="col-md-12">
                                    <input class="btn btn-primary" value="Send message" type="submit">
                                    <button type="button" onclick="window.location.href='<?php echo site_url(); ?>';" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                            
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-sm-5">
                        <iframe src="//www.google.com/maps/embed/v1/place?q=<?php echo $lat . ',' . $lng ?>&zoom=16&key=AIzaSyDiJ1iZbbvFJYJS3r8NfqyP5L-WcZIVQv4" style="border:0" allowfullscreen="" width="100%" height="230px" frameborder="0"></iframe><p></p>
                        <div class="row col1">
                            <div class="col-xs-3"> <i class="fa fa-map-marker" style="font-size:16px;"></i> &nbsp; Address </div>
                            <div class="col-xs-9"> <?php echo $general_setting[2]['setting_value']; ?> </div>
                        </div>
                        <div class="row col1">
                            <div class="col-sm-3"> <i class="fa fa-phone"></i> &nbsp; Phone </div>
                            <div class="col-sm-9"> <?php echo $general_setting[3]['setting_value']; ?><br /></div>
                        </div>
                        <div class="row col1">
                            <div class="col-sm-3"> <i class="fa fa-envelope"></i> &nbsp; Email </div>
                            <div class="col-sm-9"> <a href="mailto:<?php echo $general_setting[1]['setting_value']; ?>"><?php echo $general_setting[1]['setting_value']; ?></a> <br>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>
            </div>
        </div>



        <script src="<?php echo base_url() . 'userdash/'; ?>assets/js/jquery.min.js"></script> 
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url('assets/js/additional-methods.min.js'); ?>" ></script>


        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#frmContact').validate({
                    ignore: [],
                    rules: {
                        'g-recaptcha-response': {
                            required: true,
                            remote: {
                                url: "<?php echo site_url('login/captcha_chellange') ?>",
                                type: "post",
                                data: {'g-recaptcha-response': function () {
                                        return $('[name="g-recaptcha-response"]').val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                },
                            }
                        },
                        firstname: {
                            required: true
                        },
                        lastname: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        subject: {
                            required: true
                        },
                        message: {
                            required: true
                        },
                    },
                    messages: {
                        'g-recaptcha-response': {
                            required: 'Please complete captcha chellange',
                            remote: 'Invalid Captcha'
                        },
                        firstname: {
                            required: "First name is required"
                        },
                        lastname: {
                            required: "Last name is required"
                        },
                        email: {
                            required: "Email is required"
                        },
                        subject: {
                            required: "Subject is required"
                        },
                        message: {
                            required: "Message is required"
                        },
                    },
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "g-recaptcha-response") {
                            error.appendTo(element.parent("div").parent("div"));
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
            });
        </script>

    </body>

</html>

