<?php echo form_open_multipart('Users/wallet', array('id' => 'addfrm')); ?>
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Edit  Wallet</h4>
</div>

<input type="hidden" name="user_id" value="<?php echo base64_encode($user['id']); ?>" />
<div class="modal-body" style="min-height: 240px">
                         <div class="form-group">
                            <label class="control-label ">Amount</label>
                           
                                <input type="text" class="form-control"   name="newbalance" id="newbalance" value="" placeholder="000.00" />
                           
                        </div>
                        <div class="form-group">
                            <label class="control-label ">Transaction Type</label>
                          
                            <select class="form-control" name="transaction">debit
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                           
                        </div>
                       
                       
                        
                        <div class="form-group">
                            <label class="control-label ">Comment</label>
                            
                                <textarea type="text" class="form-control"   name="comment" id="comment" value="" placeholder="Enter comment" ></textarea>
                           
                        </div>
    
   
</div>
<div class="modal-footer "> 
    <input type="submit" class="btn btn-primary" value="Submit" />
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
       
        jQuery("#addfrm").validate({
            rules: {
                newbalance: "required",
                comment: "required",
            },
            messages: {
                newbalance: "Amount is required",
                 comment: "Amount is required",
                             
            },
            errorPlacement: function (error, element) {
                error.insertAfter($(element).parent('div')).addClass('control-label');
            }
        });
       
    });
</script>    
