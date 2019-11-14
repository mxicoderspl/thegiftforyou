


<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Bank Information</h4>
</div>

<input type="hidden" name="level_id" value="" />
<div class="modal-body" style="height: 150px">
<?php if($user) {?>
    <div class="col-md-3"></div>
    <div class="col-md-9">

    <div class="row"> <label class="col-md-4">Bank Name:</label><span class="col-md-3"><?php echo $user['bank_name']?></span><br></div>
    <div class="row"><label class="col-md-4">IFSC Code:</label><span class="col-md-3"><?php echo $user['ifsc_code']?></span><br></div>
    <div class="row"><label class="col-md-4">Account Name:</label><span class="col-md-3"><?php echo $user['account_name']?></span><br></div>
    <div class="row"><label class="col-md-4">Account NO:</label><span class="col-md-3"><?php echo $user['account_no']?></span><br></div>
	</div>      
   
</div>
<?php } else {?>
	
	 <div class="alert alert-info col-md-12">
                                    <label type="button" class="close" data-dismiss="alert" aria-hidden="true"></label>
                                    <strong><label class="text-center" > No Bank Information Fill By User...</label> </strong>
                                </div>
<?php }?>    
</div>
<div class="modal-footer "> 
    <button data-dismiss="modal" class="btn btn-success">Close</button>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>


