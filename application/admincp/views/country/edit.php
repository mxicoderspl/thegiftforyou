<?php echo form_open('country/update', array('id' => 'frmEdit')); ?>

		              <input type="hidden" name="setting_id" value="<?php if(isset($country['id'])){ echo base64_encode($country['id']); } ?>" />
		            <div class="col-md-12 col-xs-12">
		                <div class="form-group1">
		                    <label >Name</label><span class="error">*</span>
		                    <input class="form-control" name="title" id="title" placeholder="Name" type="text" value="<?php if(isset($country['name'])){ echo $country['name'];} ?>">
		                </div>
		            </div>
		            
		            

		           
		            <div class="clearfix"></div><br>
		            
		        </div>
		   
		    <div class="modal-footer">
		        <button type="submit" id="" class="btn btn-primary lg-btn">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		   

  <?php echo form_close(); ?>

    
    <script>
        
        
        $(document).ready(function() {
              $('#tprice').val($('#price').val() * $('#personno').val());
         }); 
            $("#personno,#price").keyup(function () {

             $('#tprice').val($('#price').val() * $('#personno').val());

        });
    
    
    
    </script>

<script>
    jQuery(document).ready(function () {
       
        jQuery("#frmEdit").validate({
            rules: {
                
               
                
                personno: {
                    required: true,
                    
                    
                },
                               
                
                
             
            },
            messages: {
               
                
               
                password:{
                    required:"Person Number is required",
                },
                
		 },
            
        });
       
    });
</script>
    

