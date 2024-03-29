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
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;EBC Transaction
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
                                    <button type="button" class="btn btn-default" onclick="reload_ebctransaction_table()" >Search</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="ebctransaction" class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>EBC</th>
                                                    <th>Type</th>
                                                    <th>Date</th>
                                                    <th>Transaction Comment</th>
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


<?php echo $footer; ?>
<script>
    
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
       load_ebc_transaction();
    });
function reload_ebctransaction_table(){
    var oTable = $('#ebctransaction').dataTable();
    oTable.fnStandingRedraw();
}
function load_ebc_transaction(){
    
        
        var table = jQuery('#ebctransaction').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/get_ebc_transaction'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.from_date=function(){ return $('#startdate').val();};
                    d.to_date=function(){ return $('#enddate').val();};
                },  
            },
            "columns": [

                {"taregts": 0,"data":'id'},
                {"taregts": 1,'data':'ebc'},
                {"taregts": 2,'data':'type'},
                {"taregts": 3,'data':'created_date'},
                {"taregts": 4,'data':'comment'},
                
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