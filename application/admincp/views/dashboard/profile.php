
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Edit Profile</h3>
    </div>
    <?php echo form_open('dashboard/editProfile', array('id' => 'frmEdit')); ?>
    <div class="modal-body">
       
            <div class="form-group">
                <label class="control-label">First Name <span class="text-maroon"> *</span></label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $admin['firstname']; ?>" />
            </div>
        
        
            <div class="form-group">
                <label class="control-label">Last Name <span class="text-maroon"> *</span></label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $admin['lastname']; ?>" />
            </div>
       
            <div class="form-group">
                <label class="control-label">Email <span class="text-maroon"> *</span></label>
                <input type="text" class="form-control" name="email" value="<?php echo $admin['email']; ?>" />
            </div>
       
            <div class="form-group">
                <label class="control-label">User Name <span class="text-maroon"> *</span></label>
                <input type="text" class="form-control" name="user_name" value="<?php echo $admin['user_name']; ?>" />
            </div>
        
         <div class="modal-footer">
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Update" />
            </div>
        </div>

    </div>
    <?php echo form_close(); ?>

<script>
    $('#frmEdit').validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {required: true, email: true},
            user_name: "required"
        },
        messages: {
            first_name: "Please enter first name",
            last_name: "Please enter last name",
            email: {
                required: "Please enter email",
                email: "Please enter valid email"},
            user_name: "Please enter user name"
        }
    });
</script>
