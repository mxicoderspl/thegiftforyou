<?php echo $header; ?>
<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>

<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title"> Business Service </h4>
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
                            <h4 class="m-b-30 m-t-0">Business Service</h4>
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
                        <input type="text" class="form-control  hasDatepicker" id="startdate" placeholder="Start Date" value="<?php if(isset($startdate)){  echo $startdate ; } ?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <input type="text" class="form-control hasDatepicker" id="enddate" placeholder="End Date" value="<?php //if(isset($startdate)){  echo $startdate ; } ?>">
                        </div>
                        
                    </div>
                    
		<div class="col-sm-3">
                              <select name="status" id="status" class=" form-control " style="width:100%;">
                              <option value="">Please Select Status</option>
                              <option value="Enable" >Enable</option>
                               <option value="Disable" >Disable</option>
                              
                           </select> 

                            <div id='result'></div>
                          </div>
			<div class="col-sm-2">
                        <div class="form-group">
                        <input type="button" class="btn btn-primary"  name="search" id="search" value="Search" />
                        </div>
                    </div>
                </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr >
							   <th>Image</th>
                                                            <th >Email</th>
                                                            <th>Business Name</th>
                                                             <th >Owner Name</th>
                                                            <th >Business Type</th>
							    <!-- <th >Comment</th>-->
                                                             <th>Status</th>
                                                            <th> Date</th>
							    <th>Action</th>
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
            <?php echo form_open('Service/update_status', array('class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <input type="hidden" id="userid" name="slideid"/>
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


    <!------------------ view business modal------------->


    <div id="view_business"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header "> 
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Business service Detail</h4>
                </div>
                <div class="modal-body" style="background-color:#ffffff; ">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label ">User :</label>&nbsp;
                                <span id="name"></span>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label ">Business Name :</label>&nbsp;
                                <span id="businessname"></span>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label ">Business Type:</label>&nbsp;
                                <span id="businesstype"></span>

                            </div> 
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label ">About Business :</label>&nbsp;
                                <span id="about"></span>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">Location :</label>&nbsp;
                                <span id="address"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">Image:</label>&nbsp;
                                <span id="image"><img id="imageshow" style="height:85px;width:152px"/></span>

                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">Status :</label>&nbsp;
                                <span id="businessstatus"></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">Date:</label>&nbsp;
                                <span id="date"></span>

                            </div>
                        </div>

                        <div class="clearfix"></div> 

                    </div>
                </div>


            </div>
        </div>
    </div>


<?php echo $footer ?>




	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!--jquer, javascript and ajax-->
<script type="text/javascript">
   
    $(document).on("click", ".st", function () {

        var id = $(this).data('id');
        var st = $(this).data('status');

        $('#userid').val(id);
        $('#old_status').val(st);

    });
    function load_data(){
        var table = jQuery('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo site_url('service/servicedata'); ?>",
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
		     d.status = function () {
                        return $('#status').val();
                    };
                },
            },
            "columns": [

		{"taregts": 0, render: function (data, type, row) {

                        return '<img src="<?php echo base_url().$this->config->item('upload_path_business_thumb') ?>'+ row.image +'" style="height:62px;width:72px"/>' ;
                    }

                },
                {"taregts": 0, render: function (data, type, row) {

                        return row.email  ;
                    }

                },
                {"taregts": 1, render: function (data, type, row) {

                        return row.businessname  ;
                    }

                },
                {"taregts": 2, render: function (data, type, row) {

                        return row.ownername  ;
                    }

                },
                {"taregts": 3, render: function (data, type, row) {

                        return row.type_name  ;
                    }

                },
               
                
                
		
                {"taregts": 4, "sClass": "text-center",
                    "data": "status",
                    "render": function (data, type, row) {
                        var id = row.id ;
                        
                             var out = '';
                        if (data == 'Enable') {
                            out+= '<a title="Change Status" href="#change_status" data-id="'+ id +'" data-status="Enable" data-toggle="modal" class="btn btn-success btn-xs st" >Enable</a>';
                        
                        } else {
                            out+= '<a title="Change Status" href="#change_status" data-id="'+ id +'" data-status="Disable" data-toggle="modal"  class="btn btn-warning btn-xs st" >Disable</a>';
                        }
                        return out;
                    }
                },
                {"taregts": 5, 'data': 'created_datetime'

                },
		
		{"taregts": 6, "render": function (data, type, row) {
			var id = btoa(row.id);
			var out = '<a href="<?php echo site_url('Service/edit_business'); ?>?id=' + id + '" title="Edit user business" id="edit_btn" > <i class="glyphicon glyphicon-edit"></i></a>';
                                                        out += '<a href="#view_business" title="View business detail" data-toggle="modal" onclick="view(' + row.id + ')"> <i class="glyphicon glyphicon-eye-open"></i></a>';

                                                        return out;
		}
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
<script>

jQuery("#addfrm").validate({

                                                rules: {

                                                    image: {
                                                        required: true,
                                                    },
                                                   
                                                   
                                                },
                                                messages: {
                                                    image: {
                                                        required: "Please Upload any images "
                                                    },
                                                    
                                                }


    });
jQuery("#changestatus").validate({

                                                rules: {

                                                    status: {
                                                        required: true,
                                                    },
                                                   comment: {
                                                        required: true,
                                                    },
                                                   
                                                },
                                                messages: {
                                                   
                                                    comment: {
                                                        required: "please put the comment ",
                                                    },
                                                }


    });
     $('#confirm-status').on('show.bs.modal', function (e) {
            $(this).find('.addhref').attr('href', $(e.relatedTarget).data('href'));
        });

function view(id) {
            //alert(id);
            $.ajax({
                url: "<?php echo base_url() . 'Service/getbusinessinfo' ?>",

                type: "POST",
                dataType: "json",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', id: id},
                catch : false,
                success: function (data) {
                    if (data.status == 'success') {

                        // $('#adsid').val(id);
                        $('#view_business').modal();

                        $('#name').text(data.business.email);

                        $('#businessname').text(data.business.businessname);
                        $('#businesstype').text(data.business.typename);

                        if (data.business.description == '') {
                            $('#about').text("No information found");
                        } else {
                            $('#about').text(data.business.description);
                        }

                        $('#address').text(data.business.addressline1 + ' , ' + data.business.addressline2 + ' , ' + data.business.city + '- ' + data.business.zipcode + ' , ' + data.business.statename + ' , ' + data.business.countryname);
                        $('#date').text(data.business.created_datetime);

                        $('#businessstatus').text(data.business.status);
//                        $('#status').text(data.data.status);
                        $('#imageshow').attr("src", '<?php echo base_url() . $this->config->item('upload_path_business_thumb'); ?>' + data.business.image);

                    } else {
                        flash_alert_msg(data.msg, 'error', 3000);
                    }

                }
            });
        }
</script>
