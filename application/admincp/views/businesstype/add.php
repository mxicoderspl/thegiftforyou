<?php echo form_open_multipart('BusinessType/add', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Add Business Type</h4>
</div>

<div class="modal-body">
    <div class="form-group col-md-6">
        <label class="form-lable">Business Type Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="title"/>
    </div>
    <!-- <div class="form-group">
         <label class="form-lable">Link <span class="text-danger">*</span></label>
         <input type="text" class="form-control" name="elink" value="<?php // echo $slide['link']; ?>" />
     </div>-->
    <div class="form-group col-md-6">
        <label class="form-lable">status </label>
        <select class="form-control" name="status">
            <option value="Enable">Enable</option>
            <option value="Disable">Disable</option>
        </select>
    </div>
  
    <div class="clearfix"></div>
    
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Add" />
</div>
<?php echo form_close(); ?>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>../ckeditor/ckeditor.js"></script>

<script>

    jQuery("#frmEdit").validate({

        rules: {

            title: {
                required: true,
            },
            /* elink: {
             required: true,
             },*/

        },
        messages: {
            title: {
                required: "Please enter title"
            },
            /* elink: {
             required: "Please enter Link"
             },*/

        }

    });
</script>


