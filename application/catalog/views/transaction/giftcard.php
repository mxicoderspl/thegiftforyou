<?php
echo $header;
echo $sidebar;
?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">


                <div class="col-xs-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-gift"></i>&nbsp;&nbsp;Gift Card Transaction
                                    <div class="col-sm-2 pull-right"> 
                                    </div>
                                </h4>
                                <div class="col-xs-2"><label class="datefilterlabel">Date Filter:</label></div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="startdate" placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" value="" id="enddate" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-default" onclick="reload_producttransaction_table()" >Search</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="producttransaction" class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Product Name</th>
                                                    <th>USD Amount</th>
                                                    <th>EBC (%)</th>
                                                    <th>Payable EBC</th>
                                                    <th>Quantity</th>
                                                    <th>BTC Rate</th>
                                                    <th>Payable BTC</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
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

    <div id="codeModal" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Secret codes</h4>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-xs-12" id="codedata">
                            
                            
                            
                            
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" id="user_product_id" value="" />
                </div>
            </div>

        </div>
    </div>  
<?php echo $footer; ?>
<script>
    function view_codes(){
        var authcode=$('#authcode').val();
        if(authcode=='' || authcode==undefined){
            flash_alert_msg('Please enter 6 digit Authentication code!', 'error', 10000);
        }
        else{
             $.ajax({
                url: "<?php echo base_url() . 'Transaction/view_codes' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>','user_product_id':$('#user_product_id').val(),'auth_code':authcode},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);
                    if(data.status=='success'){
                        $('#codedata').html(data.data);
                    }
                    else{
                        flash_alert_msg(data.msg, 'error', 2000);
                    }
                    
                    /* setTimeout(function () {
                     refreshrewardtable();
                    }, 500);*/
                   

                }
            });
        }
    }
    function open_code_modal(id){
       
        
        
        $.ajax({
                url: "<?php echo base_url() . 'Transaction/google_auth' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);
                    if(data.status=='success'){
                         $('#codeModal').modal();
                         $('#user_product_id').val(id);
                         
                         $('#codedata').html('<div class="form-group">'
                                +'<label for="ethtext">6 digit Authentication code:</label>'
                                +'<input type="text" placeholder="Enter code" class="form-control" id="authcode">'
                            +'</div>'
                            +'<button type="button" class="btn btn-dark waves-effect waves-light lgi" onclick="view_codes()">Submit</button>');
                    }
                    else{
                        flash_alert_msg(data.msg, 'error', 10000);
                    }
                    
                    /* setTimeout(function () {
                     refreshrewardtable();
                    }, 500);*/
                   

                }
            });
    }
    
     $(document).ready(function () {
          $("#startdate").datepicker({ 
                format: 'yyyy-mm-dd',
                autoclose: true, 
                todayHighlight: true
                })
                $("#enddate").datepicker({ 
                    format: 'yyyy-mm-dd',
            autoclose: true, 
            todayHighlight: true
            })
       load_product_transaction();
    });
function reload_producttransaction_table(){
    var oTable = $('#producttransaction').dataTable();
    oTable.fnStandingRedraw();
}
function load_product_transaction(){
    
        
        var table = jQuery('#producttransaction').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/get_product_transaction'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.from_date=function(){ return $('#startdate').val();};
                    d.to_date=function(){ return $('#enddate').val();};
                },  
            },
            "columns": [

                {"taregts": 0,"data":'id'},
                {"taregts": 1,'data':'product_name'},
                {"taregts": 2,'data':'usd_amount'},
                {"taregts": 3,'data':'ebc'},
                {"taregts": 4,'data':'payable_ebc'},
                {"taregts": 5,'data':'qty'},
                {"taregts": 6,'data':'btc_rate'},
                {"taregts": 7,'data':'payable_btc'},
                {"taregts": 8,'data':'created_date'},
                /*{"taregts": 9,'data':'status'},*/
                {"taregts": 9, 
                    "data": "status","sClass":"text-center",
                    "render": function (data, type, row) {
                        var id=btoa(row.id);
                        //  alert(data);
                        if(data == 'Confirmed')
                        {
                            return data+'&nbsp;<a title="View" href="#" onclick="open_code_modal('+row.id+')"><i class="fa fa-eye"></i></a>';
                        }
                        else
                        {
                            return data;
                        }                        
                    }
                },
                
            ]
        });     
      
    }

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