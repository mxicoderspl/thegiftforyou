
<?php echo form_open('sem/change_status', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><?php echo $sem['field_name']; ?></h4>
</div>

    <input type="hidden" name="sem_id" value="<?php echo base64_encode($sem['sem_id']); ?>" />
<div class="modal-body">
    <h5>Are you sure you want to change status of <?php echo $sem['field_name']; ?>?</h5>
        <div class="pull-right">
           
        </div>
</div>
<div class="modal-footer"> 
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <?php if ($sem['status'] == 'Enable'): ?>
                <button type="submit" class="btn btn-danger">Yes</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success">Yes</button>
            <?php endif; ?>
</div>
  <?php echo form_close(); ?>
