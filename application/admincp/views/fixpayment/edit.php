<?php echo form_open_multipart('Fixpayment/update', array('id' => 'addfrm')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit Registration fee </h4>
</div>

<input type="hidden" name="pay_id" value="<?php echo base64_encode($fixpaydata['admin_id']); ?>" />
<div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">Price</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control"  name="price" id="price" value="<?php echo $fixpaydata['registration_fee'] ?>" placeholder="" />
                            </div>
                        </div>
    <div style="height: 110px"></div>
                        
                        
    
   
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
                   price: "price is required",
             //   user_type: "User Type is required",
		 number:"price required only numbers",
                },
              
                             
            },
	    
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div')).addClass('control-label');
            }
        });
       
    });
</script>    
