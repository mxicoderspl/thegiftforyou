<?php echo form_open_multipart('Rewards/update', array('id' => 'addfrm')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit Rewards</h4>
</div>

<input type="hidden" name="level_id" value="<?php echo base64_encode($Rewardsdata['id']); ?>" />
<div class="modal-body">
                        <div class="form-group">
                            <label class="control-label ">Price</label>
                            
                                <input type="text" class="form-control"  name="price" id="price" value="<?php echo $Rewardsdata['price'] ?>" placeholder="" />
                           
                        </div>
    
                        
                        
    
   
</div>
<div class="modal-footer "> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
       
        jQuery("#addfrm").validate({
            rules: {
               
               price: {
                   required: true,
                    number: true,
                    //  phoneUS: true, 
                },
              
               
               
             
            },
            messages: {
                
              price: {
                   required:"price Number is required",
                    number:"price field required only numbers",
                },
                             
            },
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div')).addClass('control-label');
            }
        });
       
    });
</script>    
