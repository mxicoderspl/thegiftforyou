<?php echo form_open_multipart('States/update', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit Business Type</h4>
</div>

<input type="hidden" name="state_id" value="<?php echo base64_encode($state['id']); ?>" />
<div class="modal-body">
   <div class="form-group col-md-6">
       			 <label class="form-lable">State Name<span class="text-danger">*</span></label>
       			 <input type="text" class="form-control" name="state" id="state" value="<?php echo $state['name']?>"/>
    			</div>
  
    			<div class="form-group col-md-6">
       			 <label class="form-lable">Country</label>
	
        			<select class="form-control" name="country" id="country">
            				<option value="">Select Country</option>
					<?php foreach($countries as $country){ ?>
						<option <?php echo ($state['country_id'] == $country['id']) ? 'selected':'' ?> value="<?php echo $country['id']?>"><?php echo $country['name']?></option>		
					<?php }?>
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

            state: {
                required: true,
            },
           country: {
             required: true,
             },

        },
        messages: {
            state: {
                required: "Please enter State"
            },
            country: {
             	required: "Please select Country"
             },

        }

    });
</script>


