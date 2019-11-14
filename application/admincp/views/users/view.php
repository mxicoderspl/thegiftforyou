
<div class="modal-header"> 
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title">User Profile</h4>
</div>


   				
<div class="form-group"><br>
                             <div class="row ">
                                  <div class="col-md-4 ">
                            <label class="control-label ">Name:</label>
                                  </div>
                                 <div class="col-md-8 ">
                            <span><?php echo ucwords($user['firstname'].' '.$user['lastname']); ?></span>
                                 </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">
                            <label class="control-label ">Email:</label>
                            </div>
                            <div class="col-md-4 ">
                            <span><?php echo $user['email'] ?></span>
                            </div>
                        </div>
                        
                        <div class="row ">
                            <div class="col-md-4 ">
                            <label class="control-label ">Contact No:</label>
                            </div>
                            <div class="col-md-8 ">
                            <span><?php echo $user['mobile_no'] ?></span>
                            </div>
                        </div>
                        
                        
                         <div class="row ">
                             <div class="col-md-4 ">
                            <label class="control-label ">Pan Card No:</label>
                             </div>
                             <div class="col-md-8 ">
                            <span><?php echo $user['pan_no'] ?></span>
                             </div>
                        </div>  
                         <div class="row">
                             <div class="col-md-4 ">
                            <label class="control-label "> Wallet Balance :</label>
                             </div><div class="col-md-8 ">
                            <span><?php echo $user['wallet_balance'] ?></span>
                             </div>
                        </div>
                         <div class="row ">
                             <div class="col-md-4 ">
                            <label class="control-label ">Company Wallet Balance:</label>
                             </div><div class="col-md-8 ">
                            <span><?php echo $user['company_wallet_balance'] ?></span>
                             </div>
                        </div>
                         <div class="row">
                             <div class="col-md-4 ">
                            <label class="control-label ">Email Activation Status:</label>
                             </div>
                             <div class="col-md-8 ">
                            <span><?php echo $user['active_email'] ?></span>
                             </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-4 ">
                            <label class="control-label ">Payment Status:   </label>
                            </div>
                            <div class="col-md-8 ">
                            <span><?php echo $user['payment_verified'] ?></span>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-4 ">
                            <label class="control-label ">Account status:</label>
                            </div><div class="col-md-8 ">
                            <span><?php echo $user['status'] ?></span>
                            </div> 
                        </div>
                        
    
   
</div>
<div class="modal-footer "> 
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

