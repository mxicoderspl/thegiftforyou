<footer class="footer"> © <?php echo date('Y');?> <?php echo $site_name; ?> - All Rights Reserved. </footer>
  </div>
</div>

<!--Modal  -->
<div class="modal fade" id="Staking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Staking ( Profit from balance EBC ) : </h3>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Balance (EBC)</th>
              <th>Daily get %</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>100-5000</td>
              <td>0.2</td>
            </tr>
            <tr>
              <td>1000 - 10,000</td>
              <td>0.3</td>
            </tr>
            <tr>
              <td>10,000 - 20,000</td>
              <td>0.4</td>
            </tr>
            <tr>
              <td>20,000 - More</td>
              <td>0.5</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="learn-more" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Refferal Commision</h3>
        <p class="text-center">Get bonus by Reffering new members</p>
        <form class="form-inline form-popup" role="form">
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Copy your URL</label>
            <input type="email" class="form-control" id="" placeholder="Copy your URL">
          </div>
          <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">Copy</button>
        </form>
        <br>
        <table class="table table-hover table-bordered">
          <tbody>
            <tr>
              <td>Level 1</td>
              <td>1.5%</td>
            </tr>
            <tr>
              <td>Level 2</td>
              <td>2.0%</td>
            </tr>
            <tr>
              <td>Level 3</td>
              <td>1.0%</td>
            </tr>
            <tr>
              <td>Level 4</td>
              <td>0.5%</td>
            </tr>
            <tr>
              <td>Level 5 - 20</td>
              <td>0.1%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Lending" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;LENDING BEGIN AT</h3>
        <div id="clockdiv2">
          <div><span class="days"></span>
            <div class="smalltext">Days</div>
          </div>
          <div><span class="hours"></span>
            <div class="smalltext">Hr</div>
          </div>
          <div><span class="minutes"></span>
            <div class="smalltext">Min</div>
          </div>
          <div><span class="seconds"></span>
            <div class="smalltext">Sec</div>
          </div>
        </div>
        <br>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Lending Amount</th>
              <th>Profit</th>
              <th>withdraw</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>100$ - 10,000%</td>
              <td>1.5%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>10,000$ - 50,000%</td>
              <td>2.0%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>50,000$ - 1,00,000%</td>
              <td>2.5%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td>1,00,000$ - More</td>
              <td>3.0%</td>
              <td>10%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
 var js_base_url='<?php echo base_url();?>';   
 
</script>    
<?php
$this->minify->js(array('jquery.min.js','bootstrap.min.js','modernizr.min.js','detect.js','fastclick.js','jquery.slimscroll.js','waves.js','wow.min.js','jquery.nicescroll.js','jquery.scrollTo.min.js','app.js','jquery.dataTables.min.js','dataTables.responsive.js','ajax-loading.js','bootstrap-datepicker.js','jquery.bootstrap-growl.min.js','jquery.validate.min.js','additional-methods.min.js'));
echo $this->minify->deploy_js();
?>

        <script>
    
    
	    var loading = $.loading();

	    
	    function openLoading(time) {
		loading.open(time);
	    }

	    function closeLoading() {
		loading.close();
	    }

    
    
    



function flash_alert_msg(msg, msg_type='success',delay='60000') {
    if(msg_type=='success'){
         $.bootstrapGrowl("<i class='fa fa-check-circle' aria-hidden='true'></i><strong>&nbsp;&nbsp;"+msg+"</strong> ", {
        type: 'success',
        delay:delay,
        width: 'auto',
        align:'center',
        
        allow_dismiss: true
    });
    }
    
    
    if(msg_type=='error'){
         $.bootstrapGrowl("<i class='fa fa-times-circle-o' aria-hidden='true'></i><strong>&nbsp;&nbsp;"+msg+"</strong> ", {
        type: 'danger',
        delay:delay,
        width: 'auto',
        allow_dismiss: true,
        align:'center'
    });
    }
    
    if(msg_type=='info'){
         $.bootstrapGrowl("<i class='fa fa-exclamation-circle' aria-hidden='true'></i><strong>&nbsp;&nbsp;"+msg+"</strong> ", {
        type: 'info',
        delay:delay,
        width: 'auto',
        allow_dismiss: true,
        align:'center'
    });
    }
    }

</script>
</body>
<!-- Mirrored from themesdesign.in/webadmin_1.1/layouts/blue/layouts-menu2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2017 03:56:31 GMT -->
</html>
