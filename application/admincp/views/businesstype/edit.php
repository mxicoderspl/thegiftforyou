<?php echo form_open_multipart('BusinessType/update', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit Business Type</h4>
</div>

<input type="hidden" name="slide_id" value="<?php echo base64_encode($business_type['id']); ?>" />
<div class="modal-body">
    <div class="form-group col-md-6">
        <label class="form-lable">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="etitle" value="<?php echo $business_type['type_name']; ?>" />
    </div>
    <!-- <div class="form-group">
         <label class="form-lable">Link <span class="text-danger">*</span></label>
         <input type="text" class="form-control" name="elink" value="<?php // echo $slide['link']; ?>" />
     </div>-->
    <div class="form-group col-md-6">
        <label class="form-lable">status </label>
        <select class="form-control" name="estatus">
            <option value="Enable" <?php echo ($business_type['status'] == 'Enable') ? 'selected' : ''; ?>>Enable</option>
            <option value="Disable" <?php echo ($business_type['status'] == 'Disable') ? 'selected' : ''; ?>>Disable</option>
        </select>
    </div>
  
    <div class="clearfix"></div>
    
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
<?php echo form_close(); ?>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>../ckeditor/ckeditor.js"></script>

<script>

    jQuery("#frmEdit").validate({

        rules: {

            etitle: {
                required: true,
            },
            /* elink: {
             required: true,
             },*/

        },
        messages: {
            etitle: {
                required: "Please enter title"
            },
            /* elink: {
             required: "Please enter Link"
             },*/

        }

    });
</script>


