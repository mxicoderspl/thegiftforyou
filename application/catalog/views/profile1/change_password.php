<?php echo $header; 
echo $sidebar;?>
 <div class="content-page">
    <div class="content">
      <div class="m-t-10">
        <div class="page-header-title"> </div>
      </div>
      <div class="page-content-wrapper ">
        <div class="container">
          
          <div class="panel col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel-body">
              <h4 class="m-b-30 m-t-0"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Change Password
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
<?php echo form_open('Profile/update_password',array('class'=>'form-horizontal','name' => 'change','id'=>'change'));?>
                  <div class="form-group">

				  <label class="col-md-3 control-label"> Old Password</label>
				  <div class="col-md-9">
					<input type="password" name="old_password" id="old_password" value="" class="form-control">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-md-3 control-label"> New Password</label>
				  <div class="col-md-9">
					<input type="password" name="new_password" id="new_password" value="" class="form-control">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-md-3 control-label">Confirm Password</label>
				  <div class="col-md-9">
					<input type="password" name="confirm" id="confirm" value="" class="form-control">
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
					<button class="btn btn-info waves-effect waves-light" type="submit">Change Password</button>
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

                                        $("#change").validate({
                                            rules: {
                                                old_password: {
                                                    required: true
                                                },
						new_password: {
							required: true
						},
                                                confirm: {
                                                    required: true,
                                                    equalTo: "#new_password"
                                                },
                                                authcode:{
                                                    required: true,
                                                }
                                            },
                                            messages: {
                                                old_password: {
                                                    required: "Old Password is required "
                                                },
						new_password: {
                                                    required: "New Password is required "
                                                },
                                                confirm: {
                                                    required: "Confirm Password is required",
                                                    equalTo: "Password didn't match"
                                                },
                                                authcode:{
                                                    required: "Athentication code is required",
                                                }

                                            },
                                        });
                                    });
        </script>
