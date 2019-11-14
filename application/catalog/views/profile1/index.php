<?php echo $header;
echo $sidebar; ?>
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
                        <div class="alert alert-danger">
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?> 
                <div class="col-sm-2 pull-right"> 
                  
                </div>
              </h4>
              <div class="row">
                <div class="col-xs-12">
				<div class="form-horizontal">
<?php echo form_open('Profile/update',array('class'=>'form-horizontal','name' => 'profile','id'=>'profile'));?>
                  		<div class="form-group">
				  <label class="col-md-3 control-label">Firstname</label>
				  <div class="col-md-9">
					<input type="text" name="firstname" value="<?php echo $firstname;?>" class="form-control" >
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-md-3 control-label">Lastname</label>
				  <div class="col-md-9">
					<input type="text" name="lastname" value="<?php echo $lastname;?>" class="form-control" >
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-md-3 control-label"> Email</label>
				  <div class="col-md-9">
					<input type="text" name="email" value="<?php echo $email;?>" class="form-control" readonly>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-md-3 control-label">  Phone number</label>
				  <div class="col-md-9">
					<input type="text" name="mobile_no" value="<?php echo $mobile_no;?>" class="form-control">
				  </div>
				</div>
                                   
                                <?php if($logged_use['auth_enable']=='Yes') {?>
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
<?php echo form_close();?> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php echo $footer;?>
<script>
                                    $(document).ready(function () {

                                        $("#profile").validate({
                                            rules: {
                                                firstname: {
                                                    required: true
                                                },
						lastname: {
							required: true
						},
                                                mobile_no: {
                                                    required: true,
                                                    number: true
                                                },
                                                 authcode:{
                                                    required: true,
                                                }
                                            },
                                            messages: {
                                                firstname: {
                                                    required: "Firstname is required "
                                                },
						lastname: {
                                                    required: "Lastname is required "
                                                },
                                                mobile_no: {
                                                    required: "Mobile Number is required",
                                                    number: "Please Enter Only Digits"
                                                },
                                                authcode:{
                                                    required: "Athentication code is required",
                                                }

                                            },
                                        });
                                    });
        </script>
