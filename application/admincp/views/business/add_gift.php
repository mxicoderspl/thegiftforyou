<?php echo form_open_multipart('Business/update_gift', array('id' => 'frmEdit','enctype'=>'multipart/form-data')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title"> Gifts </h4>
</div>

    <input type="hidden" name="setting_id" value="<?php if(isset($business[0]['id'])){ echo base64_encode($business[0]['id']); } ?>" />
<div class="modal-body">
    
    
    <div class="row">
        <div class="col-md-3">Title</div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="title" id="title"  value="<?php  if(isset($business[0]['title'])){ echo $business[0]['title'];  } ?>" /><br>
                 
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Photo</div>
        <div class="col-md-9">
            <input type="file" class="filestyle" data-buttonbefore="true" id="eimage" name="eimage" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
        <div class="bootstrap-filestyle input-group">

        </div>
          <div>
        <img src="<?php echo base_url() . $this->config->item('upload_path_gift') . $business[0]['photo'] ?>" style="width:160px;height:70px"/>
    </div>
        </div>
    </div>
         
                 
       
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
  <?php echo form_close(); ?>

  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
  
    

<script>
    jQuery(document).ready(function () {
       
        jQuery("#frmEdit").validate({
            rules: {
                
               
                
                title: {
                    required: true,
                    
                    
                },
                               
                
                
             
            },
            messages: {
               
                
               
                title:{
                    required:"title  is required",
                },
                
		 },
            
        });
       
    });
</script>
    

