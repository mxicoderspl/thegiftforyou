<?php echo $header;
echo $sidebar; ?>
  <div class="content-page">
    <div class="content">
      <div class="m-t-10">
        <div class="page-header-title"> </div>
      </div>
      <div class="page-content-wrapper ">
        
          <div class="container">
              
              <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#transaction1" >Transaction</a></li>
                  <li><a data-toggle="tab" href="#rewardtransaction">Block Transaction</a></li>
                  <li><a data-toggle="tab" href="#rewardtransaction1">Reward Transaction</a></li>
                  <li><a data-toggle="tab" href="#extrapayout">Extra Payouts</a></li>
              </ul>

              <div class="tab-content">
                  <div id="transaction1" class="tab-pane fade in active">
                     
                    <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Transaction
                      <div class="col-sm-2 pull-right"> 
                       
                      </div>
                    </h4>
                      <div class="row">
                          <div class="col-xs-2">
                              <select class="form-control" id="eblockid1" onchange="reload_transaction_table()" >
                                  <option value="0">All</option>
                                  <?php foreach ($eblocks as $b) { ?>
                                  
                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          
                          <div class="col-xs-2">
                              <select class="form-control" id="block_type_id" onchange="refresh_eblock_dropdown();" >
                                  <?php foreach ($block_type as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="col-xs-3">
                              <div class="form-group">
                                  <input type="text" class="form-control" id="startdate" placeholder="Start Date">
                              </div>
                          </div>
                          <div class="col-xs-3">
                              <input type="text" value="" id="enddate" class="form-control" placeholder="End Date">
                          </div>
                          <div class="col-xs-2">
                              <button type="button" class="btn btn-default" onclick="reload_transaction_table()" >Search</button>
                          </div>
                      
                      
                      
                      
                      </div>
                      
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table id="transaction" class="table table-hover m-b-0">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>E-Block</th>
                                <th>Type</th>
                                <th>E-Block Price</th>
                                <th>E-Block QTY</th>
                                <th>One EBC Price (USD)</th>
                                <th>Currency</th>
                                <th>Payment Amount</th>
                                <!--<th>Transaction Fee</th>
                                <th>Network Fee</th>-->
                                <th>Amount withdrawn</th>

                              </tr>
                            </thead>
                            <tbody>
                            <!--  <tr>
                                <td colspan="3" class="text-center"> You have not made any transactions. Once you do, they will appear here. </td>
                              </tr>-->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                      
                      
                  </div>
                  <div id="rewardtransaction" class="tab-pane fade">
                      
                      <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Block Transaction
                          <div class="col-sm-4 pull-right">
                             
                              <div class="col-md-6">
                              <select class="form-control" id="eblockid" onchange="refreshtable()">
                                  <option value="0">All</option>
                                  <?php foreach ($eblocks as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                              <div class="col-md-6">
                              <select class="form-control" id="blocktypeid" onchange="refresh_eblock_dropdown1()" >
                                  <?php foreach ($block_type as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                          </div>
                          
                          
                    </h4>
                     
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table id="rtransaction" class="table table-hover m-b-0">
                            <thead>
                              <tr>
                                <th>Block No.</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Package</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>EBC</th>
                                <th>One EBC Price(USD)</th>
                                <th>Currency</th>
                              </tr>
                            </thead>
                            <tbody>
                            <!--  <tr>
                                <td colspan="3" class="text-center"> You have not made any transactions. Once you do, they will appear here. </td>
                              </tr>-->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                      
                      
                  </div>
                  
                  
                  
                  
                  <div id="rewardtransaction1" class="tab-pane fade">
                      
                      <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Reward Transaction
                          <div class="col-sm-8 pull-right">
                             
                              <div class="col-md-4">
                              <select class="form-control" id="eblockid2" onchange="noderefresh();refreshrewardtable()">
                                  <option value="0">All</option>
                                  <?php foreach ($eblocks as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                              <div class="col-md-4">
                              <select class="form-control" id="blocktypeid2" onchange="refresh_eblock_dropdown12();" >
                                  <?php foreach ($block_type as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                              
                              <div class="col-md-4">
                                  <select class="form-control" id="node_id" onchange="refreshrewardtable()" >
                                  
                              </select>
                              </div>
                          </div>
                          
                          
                    </h4>
                     
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table id="rtransaction1" class="table table-hover m-b-0">
                            <thead>
                              <tr>
                                <th>Block No.</th>
                                <th>Amount (USD)</th>
                                <th>Level</th>
                                <th>Date</th>
                                
                            </thead>
                            <tbody>
                            <!--  <tr>
                                <td colspan="3" class="text-center"> You have not made any transactions. Once you do, they will appear here. </td>
                              </tr>-->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                      
                      
                  </div>
                  
                  
                  
                  <div id="extrapayout" class="tab-pane fade">
                      
                      <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Extra Payouts Transaction
                          <div class="col-sm-8 pull-right">
                             
                              <div class="col-md-4">
                                  <select class="form-control" id="eblockid3" onchange="noderefresh_extra();refreshextrapayouttable()">
                                  <option value="0">All</option>
                                  <?php foreach ($eblocks as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                              <div class="col-md-4">
                              <select class="form-control" id="blocktypeid3" onchange="refresh_eblock_dropdown14();" >
                                  <?php foreach ($block_type as $b) { ?>

                                      <option value="<?php echo $b['id']; ?>"><?php echo $b['title']; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                              
                              <div class="col-md-4">
                                  <select class="form-control" id="node_id3" onchange="refreshextrapayouttable()" >
                                  
                              </select>
                              </div>
                          </div>
                          
                          
                    </h4>
                     
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table id="extrapayouttransaction" class="table table-hover m-b-0">
                            <thead>
                              <tr>
                                <th>Block No.</th>
                                <th>Amount (USD)</th>
                                <th>Level</th>
                                <th>Date</th>
                                
                            </thead>
                            <tbody>
                            <!--  <tr>
                                <td colspan="3" class="text-center"> You have not made any transactions. Once you do, they will appear here. </td>
                              </tr>-->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                      
                      
                  </div>
                   
              </div>   
              
              
              
              
          <!--<div class="panel col-md-12 col-xs-12">
            <div class="panel-body">
              <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Transaction
                <div class="col-sm-2 pull-right"> 
                
                </div>
              </h4>
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table id="transaction1" class="table table-hover m-b-0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>E-Block</th>
                          <th>E-Block Price</th>
                          <th>E-Block QTY</th>
                          <th>EBC Price</th>
                          <th>Currency</th>
                          <th>Payment Amount</th>
                          <th>Transaction Fee</th>
                          <th>Network Fee</th>
                          <th>Amount withdrawn</th>
                          
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
              -->
              
              
              
              
              
        </div>
          
          
      </div>
    </div>
      
      
      
      
<!-- Modal -->
<div id="myrewardModal" class="modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reward Detail</h4>
      </div>
      <div class="modal-body">
          <br>
          <div class="row">
            
                            <div class="col-xs-12">
                                <div class="table-responsive" id="rewardtabledata">
                                
                              </div>
                            </div>
                          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>      
<?php echo $footer; ?>
<script>
    $(document).ready(function () {
        load_transactiontable();
        load_rewardtransactiontable();
        load_rewardtransactiontable1();
        noderefresh();
        noderefresh_extra();
        load_extrapayout();
    });
    
    
    function noderefresh()
    {
        $.ajax({
                url: "<?php echo base_url() . 'Transaction/node_refresh' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',eblock_id:$('#eblockid2').val(),block_type_id:$('#blocktypeid2').val(),node_id:$('#node_id').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#node_id').empty();
                    $("#node_id").append('<option value="0">All</option>');
                    for (var i = 0; i < data.nodes.length; i++) {
                        $("#node_id").append('<option value="' + data.nodes[i].eblocks_node_id + '">' + data.nodes[i].eblocks_node_id + '</option>');

                    }
                     setTimeout(function () {
                     refreshrewardtable();
                    }, 500);
                   

                }
            });
    }
    function noderefresh_extra()
    {
        $.ajax({
                url: "<?php echo base_url() . 'Transaction/node_refresh_extra' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',eblock_id:$('#eblockid3').val(),block_type_id:$('#blocktypeid3').val(),node_id:$('#node_id3').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#node_id3').empty();
                    $("#node_id3").append('<option value="0">All</option>');
                    for (var i = 0; i < data.nodes.length; i++) {
                        $("#node_id3").append('<option value="' + data.nodes[i].eblocks_node_id + '">' + data.nodes[i].eblocks_node_id + '</option>');

                    }
                     setTimeout(function () {
                     refreshextrapayouttable();
                    }, 500);
                   

                }
            });
    }
    function reward_modal(id){
        $('#myrewardModal').modal();
        $('#rewardtabledata').html('');
        
        
        $.ajax({
                url: "<?php echo base_url() . 'Transaction/getRewardTable' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',id:id},
                catch : false,
                
                success: function (data) {
                     
                    data = JSON.parse(data);
                    if(data.status=='success'){
                        $('#rewardtabledata').html(data.data);
                    }
                   

                }
            });
    }
    
    
    function refresh_eblock_dropdown() {
            //$('#ajaxLoading1').css('display', 'block');
            $.ajax({
                url: "<?php echo base_url() . 'Transaction/refresh_eblock_dropdown' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',block_type_id:$('#block_type_id').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#eblockid1').empty();
                    $("#eblockid1").append('<option value="0">All</option>');
                    for (var i = 0; i < data.eblocks.length; i++) {
                        $("#eblockid1").append('<option value="' + data.eblocks[i].id + '">' + data.eblocks[i].title + '</option>');

                    }
                     setTimeout(function () {
                     reload_transaction_table();
                    }, 500);
                   

                }
            });
        }
    
    
    function refresh_eblock_dropdown1() {
            //$('#ajaxLoading1').css('display', 'block');
            $.ajax({
                url: "<?php echo base_url() . 'Transaction/refresh_eblock_dropdown' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',block_type_id:$('#blocktypeid').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#eblockid').empty();
                    $("#eblockid").append('<option value="0">All</option>');
                    for (var i = 0; i < data.eblocks.length; i++) {
                        $("#eblockid").append('<option value="' + data.eblocks[i].id + '">' + data.eblocks[i].title + '</option>');

                    }
                     setTimeout(function () {
                     refreshtable();
                    }, 500);
                   

                }
            });
        }
    function refresh_eblock_dropdown12() {
            //$('#ajaxLoading1').css('display', 'block');
            $.ajax({
                url: "<?php echo base_url() . 'Transaction/refresh_eblock_dropdown' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',block_type_id:$('#blocktypeid2').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#eblockid2').empty();
                    $("#eblockid2").append('<option value="0">All</option>');
                    for (var i = 0; i < data.eblocks.length; i++) {
                        $("#eblockid2").append('<option value="' + data.eblocks[i].id + '">' + data.eblocks[i].title + '</option>');

                    }
                     setTimeout(function () {
                         noderefresh();
                   refreshrewardtable();
                 
                    }, 500);
                   

                }
            });
        }
        
        function refresh_eblock_dropdown14() {
            //$('#ajaxLoading1').css('display', 'block');
            $.ajax({
                url: "<?php echo base_url() . 'Transaction/refresh_eblock_dropdown' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',block_type_id:$('#blocktypeid3').val()},
                catch : false,
                
                success: function (data) {

                    data = JSON.parse(data);

                    $('#eblockid3').empty();
                    $("#eblockid3").append('<option value="0">All</option>');
                    for (var i = 0; i < data.eblocks.length; i++) {
                        $("#eblockid3").append('<option value="' + data.eblocks[i].id + '">' + data.eblocks[i].title + '</option>');

                    }
                     setTimeout(function () {
                         noderefresh_extra();
                   refreshextrapayouttable();
                 
                    }, 500);
                   

                }
            });
        }
    function load_transactiontable(){
        var table;
        var table = jQuery('#transaction').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/getTransaction'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                   d.eblock=function(){ return $('#eblockid1').val();};
                   d.block_type_id=function(){ return $('#block_type_id').val();};
                    d.from_date=function(){ return $('#startdate').val();};
                    d.to_date=function(){ return $('#enddate').val();};
                },  
            },
            "columns": [

                {"taregts": 0,'data':'id'
                   
                },
                {"taregts": 1,'data':'created_date'
                   
                },
                {"taregts": 2,'data':'title',
                   
                },
                {"taregts": 3,"searchable": false,'data':'title1',    
                   
                },
                {"taregts": 4,'data':'eblock_price'
                   
                },
                {"taregts": 5,'data':'eblock_quantity'
                   
                },
                {"taregts": 6,'data':'coin_price'
                   
                },
                 {"taregts": 7,
                "data":'payment_currency',"searchable": false,    
                "render": function (data, type, row) { if(row.payment_currency=='EBC'){ return 'Eblock Coin'; } if(row.payment_currency=='BTC'){ return 'Bitcoin'; } }
                },
               
                {"taregts": 8,'data':'payment_amount'
                   
                },
               
                {"taregts": 9,'data':'amount_withdrawn'
                   
                },
                /*
                {"taregts": 9, 
                    "data": "status","sClass":"text-center",
                    "render": function (data, type, row) {
                        var id=btoa(row.id);
                        //  alert(data);
                        if(data == 'Enable')
                        {
                            return '<a title="Change Status" class="btn btn-success btn-xs" data-user="'+id+'" data-status="'+data+'" href="#change_status" data-toggle="modal" onclick="change_status(this)">Enable</a>';
                        }
                        else
                        {
                            return '<a title="Change Status" class="btn btn-danger btn-xs" data-user="'+id+'" data-status="'+data+'" href="#change_status" data-toggle="modal" onclick="change_status(this)">Disable</a>';
                        }                        
                    }
                },
                {"taregts": 10,"searchable":false,"orderable":false,
                    "render": function (data, type, row) {
                        var id=btoa(row.id);
			var out='';
                       // var out='<a title="View" href="<?php echo site_url('Tradegroup/view_Tradegroup') ?>/'+id+'"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;'; 
                        out+='<a title="Edit" href="<?php echo site_url('Users/edit_view') ?>/' + id + '"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                        
                        out+='<a title="Delete" data-href="<?php echo site_url('Users/delete') ?>/'+id+'" href="#confirm-delete" data-toggle="modal" onClick="show_confirm_modal(this);"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;';
                      
                        return out;
                    }
                },*/
            ]
        });     
       /* $('#search').on('click',function(){
         //   alert("dfgbdfgb");
            table.draw();
        });*/
    }
    
    function load_rewardtransactiontable(){
        var table;
        var table = jQuery('#rtransaction').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/getRTransaction'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.eblock_filter=function(){ return $('#eblockid').val();};
                    d.block_type_id=function(){ return $('#blocktypeid').val();};
                   /* d.to_date=function(){ return $('#enddate').val();}; */
                },  
            },
            "columns": [

                {"taregts": 0,
                "data":'id',    
                "render": function (data, type, row) { var e='<a onclick="reward_modal('+row.id+')">'+row.id+'</a>'; return e; }
                },
                {"taregts": 1,'data':'block_transaction_id',
                "render": function (data, type, row) { 
                    if(row.block_transaction_id==0)
                    { return '<center>Bonus<br>(<a onclick="reward_modal('+row.bonus_eblocks_node_id+')">'+row.bonus_eblocks_node_id+'</a>)</center>';}
                    else 
                    { return '<center>'+row.block_transaction_id;+'</center>'}
                }
                },
                {"taregts": 2,'data':'created_date',
                "render": function (data, type, row) { var e=row.created_date; return e; }
                },
                {"taregts": 3,'data':'title'},
                {"taregts": 4,'data':'title1'},
                {"taregts": 5,'data':'eblock_price',
                "render": function (data, type, row) { 
                    if(row.eblock_price==null)
                    { return '---';}
                    else 
                    { return row.eblock_price;}
                }
                },
                {"taregts": 6,
                "data":'ebc',"searchable": false,    
                "render": function (data, type, row) { 
                    var e=parseFloat(row.ebc); 
                    if(row.ebc==null){ return '---'; }
                    return e.toFixed(4);
                }
                },
                {"taregts": 7,'data':'coin_price',
                    "render": function (data, type, row) { 
                    if(row.coin_price==null)
                    { return '---';}
                    else 
                    { return row.coin_price;}
                }
                },
                {"taregts": 8,
                "data":'payment_currency',"searchable": false,    
                "render": function (data, type, row) { if(row.payment_currency=='EBC'){ return 'Eblock Coin'; } else if(row.payment_currency=='BTC'){ return 'Bitcoin'; } else{ return '---'; } }
                },
               
            ]
        });     
      
    }
    
    function load_rewardtransactiontable1(){
    
        
        var table = jQuery('#rtransaction1').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/getRTransaction1'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.eblock_filter=function(){ return $('#eblockid2').val();};
                    d.block_type_id=function(){ return $('#blocktypeid2').val();};
                    d.node_id=function(){ return $('#node_id').val();}; 
                },  
            },
            "columns": [

                {"taregts": 0,"data":'eblocks_node_id'},
                {"taregts": 1,'data':'reward_amount'},
                {"taregts": 2,'data':'level',"searchable": false,},
                {"taregts": 3,'data':'created_date'},
            ]
        });     
      
    }
function refreshtable(){
var oTable1 = $('#rtransaction').dataTable();
oTable1.fnStandingRedraw();
}  

function refreshrewardtable(){
    
var oTable1 = $('#rtransaction1').dataTable();
oTable1.fnStandingRedraw();


}
function refreshextrapayouttable(){
    
var oTable1 = $('#extrapayouttransaction').dataTable();
oTable1.fnStandingRedraw();


}
    
function reload_transaction_table(){
    var oTable1 = $('#transaction').dataTable();
oTable1.fnStandingRedraw();
}    
   
   
function load_extrapayout(){
         var table = jQuery('#extrapayouttransaction').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('Transaction/extrapayout'); ?>",
                // type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.eblock_filter=function(){ return $('#eblockid3').val();};
                    d.block_type_id=function(){ return $('#blocktypeid3').val();};
                    d.node_id=function(){ return $('#node_id3').val();}; 
                },  
            },
            "columns": [

                {"taregts": 0,"data":'eblocks_node_id'},
                {"taregts": 1,'data':'reward_amount'},
                {"taregts": 2,'data':'level',"searchable": false,},
                {"taregts": 3,'data':'created_date'},
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
                /*  $('#startdate').datetimepicker({
                   format: 'yyyy-MM-dd',
                  });
                  $('#enddate').datetimepicker({
                   format: 'yyyy-MM-dd',
                  });*/
              });
</script>