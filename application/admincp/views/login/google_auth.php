
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

        <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon"/>

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
                        <a href="index.html" class="logo logo-admin"><span>Thegifts</span>foryou</a>
                    </h3>
                    
                   
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
                       
                     <?php echo form_open(site_url('Login/verify_google_auth'), array('class' => 'form-horizontal', 'id' => 'otp_frm', 'method' => 'post')); ?>
                    
                    <div class="form-group">
                        <label for="" class="col-md-3">Enter code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3"></label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary lg-btn">Verify</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                    
                    
                    
                    
                </div>
            </div>
        </div>
     

    </body>
</html>



 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url('assets/js/additional-methods.min.js'); ?>" ></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script src="<?php echo base_url(); ?>/userdash/assets/js/particle.js"></script> 
        <script  src="<?php echo base_url(); ?>/userdash/assets/js/index.js"></script>
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




