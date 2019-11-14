

<?php echo form_open('sem/updatesem', array('id' => 'frmsemEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><?php echo $sem['field_name']; ?></h4>
</div>

    <input type="hidden" name="sem_id" value="<?php echo base64_encode($sem['sem_id']); ?>" />
<div class="modal-body">
    <div class="form-group">
            <input type="text" class="form-control" name="field_value" value="<?php echo $sem['field_value']; ?>" />
        </div>
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
  <?php echo form_close(); ?>

    


<script>
    $('#frmsemEdit').validate({
        rules: {
            field_value: {
                required: true,
                
            }
        },
        messages: {
            field_value: {
                required: "Please enter <?php echo ucfirst($sem['field_name']); ?>",
                
            }
        }
    });
</script>