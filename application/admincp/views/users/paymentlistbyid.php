<?php echo $header; ?> 
 <?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
   
<div class="content">
      <div class="">
        <div class="page-header-title">
          <h4 class="page-title">Registration free distribution  </h4>
        </div>
      </div>
      <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                    <div class="col-xs-12">
                        <div class="catm-alert-msg">
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                                    <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('info')) { ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-t-0"></h4>
                            <div class="table-responsive">
                            <table class="table table-primary mb30 table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <!--th>#</th-->
                                       
                                                            <th class="col-xs-3">User Info</th>
                                                            <th class="col-xs-3">Amount </th>
                                                            <th class="col-xs-3"> Date</th>
                                                             </tr>
                                </thead>
                                <tbody>
                                      <?php
                                                        $i = 0;
                                                        foreach ($users as $sdata) {
                                                            
							?>
                                                            <tr role="row" class="odd">
                                                               
                                                                <td><?php echo $sdata['email'].'('.$sdata['referer_code'].')' ;?></td>
                                                                <td><?php echo $this->config->item('currency_icon') ?>&nbsp;<?php echo $sdata['amount']; ?></td>
								<td><?php echo $sdata['created_datetime']; ?></td>
                                                                
                                                                
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        <div class="pull-left">
                            Legend(s): &nbsp; 
                            <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                        </div>
                        </div>  
                    </div>  
                </div>
            </div>
           
                <!--Bootstrap model for edit start-->
                <div id="edit-modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content" id="model_data">
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="change-status" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog">
                        <div class="modal-content">
                        </div>
                    </div>
                </div>
            
        </div>
      </div>
</div>

<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
    /*function edit_setting(id)
     {
     var sem_id = id;
     $('#model_data').html('');
     $.ajax({
     url: "<?php echo site_url() . 'Sem/update' ?>",
     type: "POST",
     dataType: "html",
     data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'sem_id': sem_id},
     catch : false,
     success: function (data) {
     $('#model_data').append(data);
     }
     });
     }
     function change_status(id,status){
     $("input[name=sem_id]").val(id);
     if(status){
     $("#cnfMessage").text('Are you sure you want to disable this SEM? ');
     $("#btnchange").removeClass('btn-success').addClass('btn-danger');
     }else{
     $("#cnfMessage").text('Are you sure you want to enable this SEM? ');
     $("#btnchange").removeClass('btn-danger').addClass('btn-success');
     }
     }*/
</script>


   		
