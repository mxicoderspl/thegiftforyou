<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">


<div class="content">
    <div class="">
        <div class="page-header-title">
            <!--<h4 class="page-title">Payments</h4>-->
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
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">

                    </a>
                            <h4 class="m-b-30 m-t-0">Payments</h4>
				<div class="row">
                                 
                    <div class="col-sm-3">
                        <div class="form-group">
                        <input type="text" class="form-control  hasDatepicker" id="startdate" placeholder="Start Date">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <input type="text" class="form-control hasDatepicker" id="enddate" placeholder="End Date">
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <input type="button" class="btn btn-primary"  name="search" id="search" value="Search" />
                        <button type="button" class="btn btn-primary" onclick="payment_sheet()" >Generate Payment Sheet</button>
                        </div>
                    </div>
                </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th >ID</th>
                                                            <th >File Name</th>
                                                            <th >Start Time</th>
							     <th >End Time</th>
                                                            <th >Created date</th>
                                                            <th >Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                           
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------- edit modal-------------------------->
<div id="editmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="model_data">

        </div>
    </div>
</div>

<div class="modal fade" id="change_status" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="panelt panel-success-head">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Confirm Payment</h3>
            </div>
          
            <div class="modal-body">
                
                <h5>Are you sure you want to confirm payment?</h5>
                
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <input type="hidden" id="csvid" value="0" />
                    <button type="button" class="btn btn-success" onclick="confirm_sheet()">Yes</button>

                </div>
            </div>
         
        </div>
    </div>
</div>



<?php echo $footer ?>




	


<script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!--jquer, javascript and ajax-->
<script type="text/javascript">
    
    function payment_sheet(){
        $.ajax({
            url: "<?php echo base_url() . 'Payment/paymentsheet' ?>",
            type: "POST",
            dataType: "json",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            catch : false,
            success: function (data) {
               if(data.status=='success'){
                   flash_alert_msg(data.msg,'success',2000);
                   reload_transaction_table();
               }
               else{
                   flash_alert_msg(data.msg,'error',2000);
               }

            }
        });
    }
    function exportsheet(id){
         $.ajax({
            url: "<?php echo base_url() . 'Payment/exportsheet' ?>",
            type: "POST",
            dataType: "json",
               contentType: 'text/csv',
                 context: this,
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
            
            success: function (data) {
               if(data.status=='success'){
                   flash_alert_msg(data.msg,'success',2000);
                   
               }
               else{
                   flash_alert_msg(data.msg,'error',2000);
               }

            }
        });
    }
    
    function confirm_sheet(){
    $.ajax({
            url: "<?php echo base_url() . 'Payment/confirm_sheet' ?>",
            type: "POST",
            dataType: "json",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',id:$('#csvid').val()},
            catch : false,
            success: function (data) {
               if(data.status=='success'){
                   flash_alert_msg(data.msg,'success',2000);
                   reload_transaction_table();
               }
               else{
                   flash_alert_msg(data.msg,'error',2000);
               }
                $('#change_status').modal('hide');

            }
        });
    }
    function confirmmodal(id){
        $('#change_status').modal();
        $('#csvid').val(id);
    }
    
    function load_data(){
        var table = jQuery('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Payment/transaction'); ?>",
                 type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                   
                    d.from_date = function () {
                        return $('#startdate').val();
                    };
                    d.to_date = function () {
                        return $('#enddate').val();
                    };
                },
            },
            "columns": [
                {"taregts": 0,'data': 'id'

                },
                {"taregts": 1,render: function (data, type, row) {
                        
                        return '<a target="_blank" href="<?php echo site_url('Payment/exportsheet/');?>'+row.id+'">'+row.filename+'</a>';
                }

                },
                {"taregts": 2,'data': 'start_time'

                },
                {"taregts": 3,'data': 'end_time'

                },
                {"taregts": 4,'data': 'created_date'

                },
                
		 
               
		{"taregts": 5, render: function (data, type, row) {
                        
                    if(row.status=='Pending'){
                    return '<a class="btn btn-warning btn-xs st"   href="#" onclick="confirmmodal('+row.id+')" title="Change Status">Pending</a>'  ;
                     }
                     else{
                         return '<a class="btn btn-success btn-xs st"   title="Confirmed">Confirmed</a>';
                     }
                    }

                },
                
            ]
        });
        $('#search').on('click', function () {
            reload_transaction_table();
        });
    }
    $(document).ready(function () {
    
       load_data();
        
    });
function reload_transaction_table(){
    var oTable1 = $('#datatables').dataTable();
oTable1.fnStandingRedraw();
}   
    $('#startdate').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#enddate').datepicker({
        format: "yyyy-mm-dd"
    });
$.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
    //redraw to account for filtering and sorting
    // concept here is that (for client side) there is a row got inserted at the end (for an add)
    // or when a record was modified it could be in the middle of the table
    // that is probably not supposed to be there - due to filtering / sorting
    // so we need to re process filtering and sorting
    // BUT - if it is server side - then this should be handled by the server - so skip this step
    if(oSettings.oFeatures.bServerSide === false){
        var before = oSettings._iDisplayStart;
        oSettings.oApi._fnReDraw(oSettings);
        //iDisplayStart has been reset to zero - so lets change it back
        oSettings._iDisplayStart = before;
        oSettings.oApi._fnCalculateEnd(oSettings);
    }
      
    //draw the 'current' page
    oSettings.oApi._fnDraw(oSettings);
};
</script>
