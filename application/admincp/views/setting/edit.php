<?php echo form_open('setting/update', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><?php echo $setting['setting_name']; ?></h4>
</div>

    <input type="hidden" name="setting_id" value="<?php echo base64_encode($setting['setting_id']); ?>" />
<div class="modal-body">
    
            <?php if ($setting['setting_name'] != 'Location'): ?>
                <input type="text" class="form-control" name="setting_value" value="<?php echo $setting['setting_value']; ?>" />
            <?php else: ?>
                <textarea class="form-control" rows="4" name="setting_value"><?php echo $setting['setting_value']; ?></textarea>
            <?php endif; ?>
       
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
  <?php echo form_close(); ?>

    


<script>
    $('#frmEdit').validate({
    rules:{
    setting_value:{
    required:true<?php if ($setting['setting_id'] == 2): echo ','; ?>
                email:true<?php endif; ?>
    }
    },
            messages:{
            setting_value:{
            required:"Please enter <?php echo ucfirst($setting['setting_name']); ?>"<?php if ($setting['setting_id'] == 2): echo ','; ?>
                email:"Please enter valid email"<?php endif; ?>
            }
            }
    });
</script>
