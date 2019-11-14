<?php echo form_open_multipart('slider/update', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit Banner</h4>
</div>

<input type="hidden" name="slide_id" value="<?php echo base64_encode($slide['id']); ?>" />
<div class="modal-body">
   <div class="form-group col-md-6">
        <label class="form-lable">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="etitle" value="<?php echo $slide['title']; ?>" />
    </div>
    <!-- <div class="form-group">
         <label class="form-lable">Link <span class="text-danger">*</span></label>
         <input type="text" class="form-control" name="elink" value="<?php // echo $slide['link']; ?>" />
     </div>-->
    <div class="form-group col-md-6">
        <label class="form-lable">status </label>
        <select class="form-control" name="estatus">
            <option value="Enable" <?php echo ($slide['status'] == 'Enable') ? 'selected' : ''; ?>>Enable</option>
            <option value="Disable" <?php echo ($slide['status'] == 'Disable') ? 'selected' : ''; ?>>Disable</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <div class="">
            <label class="form-lable">Image </label><br>
            <input type="file" class="filestyle" data-buttonbefore="true" id="eimage" name="eimage" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
        </div>

    </div>
    <div class="form-group col-md-4">
        <img src="<?php echo base_url() . $this->config->item('upload_path_slider') . $slide['image'] ?>" style="width:160px;height:70px"/>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-md-12">
        <label class="control-label">Description<span class="text-danger"> *</span></label>

        <textarea  class="form-control ckeditor" name="edescription" id="edescription"><?php echo $slide['description'] ?></textarea>

        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('edescription');
</script>
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


