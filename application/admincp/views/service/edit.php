<?php echo form_open('Business/update', array('id' => 'frmEdit')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title"> Business Plan</h4>
</div>

    <input type="hidden" name="setting_id" value="<?php if(isset($business[0]['level'])){ echo base64_encode($business[0]['id']); } ?>" />
<div class="modal-body">
    
    <div class="row">
        <div class="col-md-3">Level</div>
        <div class="col-md-9">
             <input type="text" class="form-control" name="level" readonly value="<?php if(isset($business[0]['level'])){ echo $business[0]['level'];} ?>" /><br>
             
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Price</div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="price" id="price" readonly value="<?php if(isset($business[0]['price'])){ echo $business[0]['price']; } ?>" /><br>
               
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Person Number</div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="personno" id="personno"  value="<?php  if(isset($business[0]['person_number'])){ echo $business[0]['person_number'];  } ?>" /><br>
                 
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Total Price</div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="tprice" readonly id="tprice" value="" /><br>
                 
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Product</div>
        <div class="col-md-9">
            <select name="product[]" style="width:400px;" multiple>
                
                <?php if (count($business) > 0) { ?>
                <?php for ($i = 0; $i < count($product); $i++) { ?>   
                                       
                <option value="<?php echo $product[$i]['id'];?>"><?php echo $product[$i]['title'];?></option>
                <?php } }?>
  </select>    
        </div>
    </div>       
                 
       
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Update" />
</div>
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
    

