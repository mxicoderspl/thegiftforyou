<?php
echo $header;
echo $sidebar;
?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">

                <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                    <div class="panel-body">
                        <h4 class="m-b-30 m-t-0"><i class="fa fa-user"></i>&nbsp;&nbsp;My Profile

                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger" id="myerror">
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success" id="myerror">
                                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?> 
                            <div class="col-sm-2 pull-right"> 

                            </div>
                        </h4>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-horizontal">
                                    <?php echo form_open('Profile/update', array('class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'profile', 'id' => 'profile')); ?>
                                    <?php // echo form_open('Profile/update', array('id' => 'profile', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
				   <div class="form-group">
                                        <label class="col-md-3 control-label">FirstName <span style="color:#FF0000">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">LastName <span style="color:#FF0000">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact </label>
                                        <div class="col-md-9">
                                            <input type="text" name="mobile_no" value="<?php echo $mobile_no; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group "> 
                                        <label class="col-md-3 control-label">Upload Profile pic</label>
                                        <div class="col-md-6">
                                            <input type="file" class="filestyle" name="image" id="image">
                                        </div>
                                        <div class="col-md-3">
                                           <?php if(!empty($profilepic)){?>
                                            <img src="<?php echo base_url().$this->config->item('upload_path_profilepic_thumb') . $profilepic?>" style="height:60px;width:80px"/>
                                           <?php } ?>
                                        </div>
                                    </div>

                                    <?php if ($logged_use['auth_enable'] == 'Yes') { ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="googlecode">Authentication code:</label>
                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" id="authcode" name="authcode">
                                            </div>
                                        </div>
                                    <?php } ?>    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">  &nbsp;</label>
                                        <div class="col-md-9">
                                            <button class="btn btn-info waves-effect waves-light" type="submit">Update profile</button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
    <script>
        $('#myerror').slideDown(function () {
            setTimeout(function () {
                $('#myerror').slideUp();
            }, 3000);
        });
         $("#mobile_no").keypress(function (e) {

            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && ((e.which > 64 && e.which <= 91) || (e.which > 96 && e.which < 123))) {
                return false;
            }

        });
        $(document).ready(function () {

            $("#profile").validate({
                rules: {
                   firstname:"required",
                    lastname:"required",
                    email: {
                        required: true,
                        email: true
                    },
                    mobile_no: {
                        required: true,
                        number: true
                    },
                    authcode: {
                        required: true,
                    }
                },
                messages: {
		    firstname:"Please enter Firstname",
                    lastname:"Please enter Lastname",
                    mobile_no: {
                        required: "Please enter Mobile no",
                        number: "Please Enter Only Digits"
                    },
                    authcode: {
                        required: "Athentication code is required",
                    }

                },
            });
        });
    </script>
    <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
