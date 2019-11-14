<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<!--<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">-->


<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title"> Wallet TO Wallet</h4>
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
                            <h4 class="m-b-30 m-t-0">Wallet TO Wallet </h4>
				<div class="row">
                                    <div class="col-sm-3">
                               <select name="selUser" id="selUser" class=" form-control " style="width:100%;">
                                   <option value="">Please select user</option>
                                <?php foreach ($user as $val) { ?>
                                <option value="<?php echo $val['id'] ?>" <?php echo (isset($_GET['id'])&&base64_decode($_GET['id'])==$val['id'])?'selected':'' ?>><?php echo $val['email']; ?></option>					
                                <?php } ?>				
                            </select>

                            <div id='result'></div>
                          </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <input type="text" class="form-control  hasDatepicker" id="startdate" placeholder="Start Date">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <input type="text" class="form-control hasDatepicker" id="enddate" placeholder="End Date">
                        </div>
                        
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <input type="button" class="btn btn-primary"  name="search" id="search" value="Search" />
                        </div>
                    </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <a href="<?php echo base_url();?>/Wallet/paymentsheet"><button type="button" class="btn btn-primary"  >Generate  Sheet</button></a>
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
                                                            <th >Sender  User </th>
                                                             <th >Receiver User </th>
                                                             <!-- <th >Type</th>-->
                                                               <th >Amount</th>
							       <!--<th >Comment</th>-->
                                                               <th >Total Tax</th>
                                                               <th >Transaction Date</th>

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
                <h3 class="modal-title">Change Status</h3>
            </div>
            <?php echo form_open('Faq/update_status', array('class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <input type="hidden" id="slideid" name="slideid"/>
                <input type="hidden" id="old_status" name="old_status"/>

                <h5>Are you sure you want to change the <b>STATUS</b> ?</h5>

            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                    <button type="submit" class="btn btn-success">Yes</button>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('Faq/delete', array('class' => 'form-horizontal')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete FAQ</h3>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this FAQ ?</h5>
                <input type="hidden" value="" id="deletefaqid" name="deletefaqid"/>

            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default">No</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<?php echo $footer ?>




	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!--jquer, javascript and ajax-->
<script type="text/javascript">
    function load_data(){
        var table = jQuery('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[4, "ASC"]],
            "ajax": {
                url: "<?php echo site_url('Wallet/getgrdUserData'); ?>",
                 type: "GET",
                data: function (d) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.user_id = function () {
                        return btoa($('#selUser').val());
                    };
                    d.from_date = function () {
                        return $('#startdate').val();
                    };
                    d.to_date = function () {
                        return $('#enddate').val();
                    };
                },
            },
            "columns": [
                {"taregts": 0, render: function (data, type, row) {

                        return row.from_username ;
                    }

                },
                {"taregts": 1, render: function (data, type, row) {

                        return row.to_username ;
                    }

                },
                
		/* {"taregts": 2, "sClass": "text-center",
                    "data": "type",
                    "render": function (data, type, row) {
                        var id = row.id ;
                        
                             var out = '';
                        if (data == 'credit') {
                            out+= '<span   class="btn btn-success btn-xs st" >Credit</a>';
                        } else  {
                            out+= '<span  class="btn btn-danger btn-xs st" >Debit</a>';
                        } 
                        return out;
                    }
                },*/
                
                {"taregts": 2, render: function (data, type, row) {

                        return '<span class="pull-right"><?php echo $this->config->item("currency_icon") ?>'+' '+ row.amount+'</span>'  ;
                    }

                },
               
		/*{"taregts": 3, render: function (data, type, row) {
                        
                     
                    var str1 =row.comment ;
                    var str2 = str1.replace(/(([^\s]+\s\s*){10})(.*)/,"$1…");
                      
                    return '<span type="button"  data-toggle="tooltip" data-placement="top" title="'+ row.comment+'">' + str2 +'</span>'  ;
                    }

                },*/
                    {"taregts": 3, render: function (data, type, row) {

                        return '<span class="pull-right"><?php echo $this->config->item("currency_icon") ?>'+' '+ row.Total_tax+'</span>'  ;
                    }

                },
                {"taregts": 4, 'data': 'created_date'

                },
            ]
        });
        $('#search').on('click', function () {
            reload_transaction_table();
        });
    }
    $(document).ready(function () {
    $("#selUser").select2();
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
<script type="text/javascript">
    
    function payment_sheet(){
        $.ajax({
            url: "<?php echo base_url() . 'Wallet/paymentsheet' ?>",
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
    </script>
