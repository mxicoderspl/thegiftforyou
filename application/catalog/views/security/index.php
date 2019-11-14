<?php echo $header; 
echo $sidebar;?>
<style>
    .p-10{
        padding: 25px !important;
    }
</style>
<div class="content-page">
    <div class="content">
      <div class="m-t-10">
        <div class="page-header-title">
          <div class="row">
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <div class="col-md-12 p-0">

                        <p>Enable 2-factor Google authentication? <input <?php if($logged_use['auth_enable']=='Yes'){ ?> checked="" <?php } ?> id="auth_enable" data-toggle="toggle" type="checkbox"></p> 

                        <div class="col-xs-12">
                            <?php echo $qrCode; ?>
                        </div>
                    </div>
                    <div class="row">
                        <p>To setup two factor authentication you first need to download Google Authenticator:</p>
                        <div>
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">
                                <img src="<?php echo base_url('userdash/image/android.png'); ?>" style="max-width: 150px;" />
                            </a>
                            <a target="_blank" href="https://itunes.apple.com/in/app/google-authenticator/id388497605?mt=8">
                                <img src="<?php echo base_url('userdash/image/ios.png'); ?>" style="max-width: 150px;" />
                            </a>
                        </div>
                        
                        <p>Then scan the above barcode or, if you are not able to scan the barcode, you can enter the "Security Key" manually.</p>
                        <h4>Security Key: <?php echo $logged_use['google_code']; ?></h4>
                    </div>
                </div>
            </div>
            </div>
            
             <div class=" col-md-6  col-xs-12">
                <div class="panel panel-body p-10">
                        <h3 class="m-t-md">
                            Google Authenticator Guide
                        </h3>
                         
                        <ol>
                            <li>Install Google Authenticator for <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank" class="text-black">Android</a> or <a href="https://itunes.apple.com/en/app/google-authenticator/id388497605?mt=8" target="_blank" class="text-black">Apple</a> and open Google Authenticator</li>
                            <li>Go to <code>Menu</code> -&gt; <code>Setup Account</code></li>
                            <li>Choose <code>Scan a barcode</code> option, and scan the barcode shown on this page</li>
                            <li><em><b>If you are unable to scan the barcode</b>: Choose <code>Enter provided key</code> and type in the "Security Key"</em></li>
                            <li>A six digit number will now appear in your Google Authenticator app home screen</li>
                            <li>Every time you login to thegiftforyou you must enter the new 2FA code.</li>
                        </ol>
                    </div>
      
        </div>
      </div>


<div id="authcodemodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Authentication code alert</h4>
      </div>
      <div class="modal-body">
        
                                                    <div class="form-group">
                                                        <label for="ethtext">6 digit Authentication code:</label>
                                                        <input type="text" placeholder="Enter code" class="form-control" id="authcode">
                                                    </div>
        
      </div>
      <div class="modal-footer">
          <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="updatestatus()">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>

  </div>
</div>
<?php echo $footer; ?> 
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
function updatestatus(){
    if(!$(this).prop('checked')){
        var auth_enable='No';
        
        
        $.ajax({
                url: "<?php echo site_url('Security/update'); ?>",
                data: {auth_enable:auth_enable ,authcode:$('#authcode').val(),
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status=='success'){
                          if(data.data=='Yes'){
                             $('.toggle').removeClass('off'); 
                             $('#auth_enable').prop('checked', true);
                        }
                        else{
                            $('.toggle').addClass('off');   
                             $('#auth_enable').prop('checked', false);
                        }
                         
                    }
                    else{
                        flash_alert_msg(data.msg,'error',10000);
                         if(data.data=='Yes'){
                             $('.toggle').removeClass('off'); 
                             $('#auth_enable').prop('checked', true);
                        }
                        else{
                            $('.toggle').addClass('off');   
                             $('#auth_enable').prop('checked', false);
                        }
                    }
                }
       });
    }
    else{
        var auth_enable='Yes';
        
        
    }
    
     
}
    $(function () {
        $('#auth_enable').change(function () { 
            
            if($(this).prop('checked')){
                var auth_enable='Yes';
                $.ajax({
                url: "<?php echo site_url('Security/update'); ?>",
                data: {auth_enable:auth_enable ,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status=='success'){
                        if(data.data=='Yes'){
                             $('.toggle').removeClass('off'); 
                             $('#auth_enable').prop('checked', true);
                        }
                        else{
                            $('.toggle').addClass('off');   
                             $('#auth_enable').prop('checked', false);
                        }
                         
                    }
                    else{
                        flash_alert_msg(data.msg,'error',10000);
                         if(data.data=='Yes'){
                             $('.toggle').removeClass('off'); 
                             $('#auth_enable').prop('checked', true);
                        }
                        else{
                            $('.toggle').addClass('off');   
                             $('#auth_enable').prop('checked', false);
                        }
                    }
                }
                   });
                
            }
            else{
                var auth_enable='No';
                  $('#authcodemodal').modal();
                   $('.toggle').removeClass('off');  
                 $('#auth_enable').prop('checked', true);
            }
           
            
            

        });
    })
</script>
