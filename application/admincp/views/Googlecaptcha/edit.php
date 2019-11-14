<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $Google_Captcha['Title']; ?></h3>
    </div>
    <?php echo form_open('Googlecaptcha/update', array('id' => 'frmEdit')); ?>
    <input type="hidden" name="id" value="<?php echo base64_encode($Google_Captcha['id'])."%"; ?>" />
    <div class="panel-body">
        <div class="form-group">
           
            <input type="text" class="form-control" readonly name="Title" value="<?php echo $Google_Captcha['Title']; ?>" />
        </div>
        <div class="form-group">
                <input type="text" class="form-control" name="value" value="<?php echo $Google_Captcha['Value']; ?>" />
            
        </div>
        <div class="form-group pull-right">
            <input type="submit" class="btn modal-btn" value="Update" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $('#frmEdit').validate({
    rules:{
    value:{
    required:true,
    
    }
    },
       messages:{
            value:{
            required:"Please enter Value",
            
            }
            }
    });
</script>