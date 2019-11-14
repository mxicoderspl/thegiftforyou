<?php echo form_open_multipart('Users/update', array('id' => 'addfrm')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit user</h4>
</div>

<input type="hidden" name="user_id" value="<?php echo base64_encode($user['id']); ?>" />
<div class="modal-body">
   				
                        <div class="form-group">
                            <label class="control-label ">Email</label>
                           
                                <input type="text" class="form-control"   name="email" id="email" value="<?php echo $user['email'] ?>" placeholder="Email address" />
                          
                        </div>
                        
                        <div class="form-group ">
                            <label class="control-label ">Contact No</label>
                            
                                <input type="text" class="form-control"  name="contact_no" id="contact_no" value="<?php echo $user	['mobile_no'] ?>" placeholder="Contact no" />
                           
                        </div>
                        
    <div class="form-group ">
        <label class="form-label ">status </label>
        <select class="form-control" name="estatus">
            <option value="Enable" <?php echo ($user['status'] == 'Enable') ? 'selected' : ''; ?>>Enable</option>
            <option value="Disable" <?php echo ($user['status'] == 'Disable') ? 'selected' : ''; ?>>Disable</option>
        </select>
    </div>
   
</div>
<div class="modal-footer "> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
       
        jQuery("#addfrm").validate({
            rules: {
               
                email: {
                    required: true,
                    email: true,
                },
               contact_no: {
                  //  required: true,
                    number: true,
                    //  phoneUS: true, 
                },
              
               
             
            },
            messages: {
               
             //   user_type: "User Type is required",
                email: {
                    required: "Email is required.",
                    email: "Please enter valid email address.",
                   // remote: "Email id already exists."
                },
               
               contact_no: {
                  //  required:"Contact Number is required",
                    number:"Contact field required only numbers",
                },            
                             
            },
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div')).addClass('control-label');
            }
        });
       
    });
</script>    
