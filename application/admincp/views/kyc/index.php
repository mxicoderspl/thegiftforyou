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

#myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modallg {
        visibility: visible;
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 11; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        margin: 100px 80px 100px 300px;
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0); /* Black w/ opacity */
	/*min-height: 700px;
	min-width: 1000px;*/
    }

    /* Modal Content (image) */
    .modal-contentlg {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 1000px;
 	
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 1000%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-contentlg, #caption {    
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #141010;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-contentlg {
            width: 100%;
        }
    }
</style>
<?php echo $sidebar; ?>

<div class="content-page">



    <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url(); ?>/assets/images/ajax-loading.gif">
        <p style="margin:0;font-size:14px;color:#fff">loading...</p>
    </div>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">


    <div class="content">
        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">KYC Users </h4>
            </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="catm-alert-msg">
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success myerror">
                                    <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger myerror">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                                    <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('info')) { ?>
                                <div class="alert alert-info myerror">
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
                            <div class="panel-body" id="cxcx">

                                </a>

                                <h4 class="m-b-30 m-t-0">KYC Users</h4>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select name="selUser" id="selUser" class=" form-control " style="width:100%;">
                                            <option value="">Please select user</option>
                                            <?php foreach ($user as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo (isset($_GET['id']) && base64_decode($_GET['id']) == $val['id']) ? 'selected' : '' ?>><?php echo $val['email']; ?></option>					
                                            <?php } ?>				
                                        </select>

                                        <div id='result'></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control  hasDatepicker" id="startdate" placeholder="Start Date" value="<?php
                                            if (isset($startdate)) {
                                                echo $startdate;
                                            }
                                            ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control hasDatepicker" id="enddate" placeholder="End Date" value="<?php
                                            if (isset($startdate)) {
                                                echo $startdate;
                                            }
                                            ?>">
                                        </div>

                                    </div>

                                    <div class="col-sm-3">
                                        <select name="status" id="status" class=" form-control " style="width:100%;">
                                            <option value="">Please Select Status</option>
                                            <option value="Approved" >Approved</option>
                                            <option value="Declined" >Declined</option>
                                            <option value="Pending" >Pending</option>
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
                                                                <th >User</th>
                                                               
                                                                <th class="col-md-3">Aadhar Photo</th>
                                                                <th >Passbook Photo</th>
                                                                 <th>Pancard Photo</th>
                                                                <th>Status</th>
                                                                <th>Created date</th>

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
                <?php echo form_open('Userkyc/update_status', array('class' => 'form-horizontal', 'id' => 'changestatus')); ?>
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id" val=""/>
                    <!--<input type="hidden" id="old_status" name="old_status"/>-->
                    <div class="form-group"> 
                        <label class="col-md-2 control-label"> Status <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="status" id="status" class=" form-control " style="width:100%;">
                                <option value="">Please Select Status</option>
                                <option value="Approved" >Approved</option>
                                <option value="Declined" >Declined</option>
                                <!--<option id="hides" value="Pending" >Pending</option>-->
                            </select> 
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Comment <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control"  rows="3" name="comment" id="comment"  placeholder="Enter Comment" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success">Change</button>
                         
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>


<!-- The Modal -->
    <div id="myModal" class="modallg">
        <span class="close">&times;</span>
        <img class="modal-contentlg" id="img01">
        <div id="caption"></div>
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

                                            $('#user_id').val(id);
                                            $('#old_status').val(st);
//                                            if ($('#old_status').val() == 'Approved') {
//                                                $('#hides').hide();
//                                            } else
//                                            {
//                                                $('#hides').show();
//                                            }
                                        });
//                                        $(document).ready(function () {

 $('#myerror').slideDown(function () {
            setTimeout(function () {
                $('#myerror').slideUp();
            }, 3000);
        });
                                            function load_data() {
                                                //alert("datatable");
                                                var table = jQuery('#datatables').DataTable({
                                                    "processing": true,
                                                    "serverSide": true,
                                                    "responsive": true,
                                                    "order": [[0, "DESC"]],
                                                    "ajax": {
                                                        url: "<?php echo site_url('Userkyc/kycusersdata'); ?>",
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

                                                                return row.firstname;
                                                            }

                                                        },

                                                        {"taregts": 1, "sClass": "text-center",
                                                            "data": "adhar_photo",
                                                            "render": function (data, type, row) {
                                                                return '<img id="myimage1" src="<?php echo base_url() . $this->config->item('upload_path_adharphoto_thumb'); ?>'+ row.adhar_photo + '" style="height:71px;width:89px" onclick="myfunction(this)">';
                                                            }
                                                        },

                                                        {"taregts": 2, "render": function (data, type, row) {
                                                                return '<img id="myimage2" src="<?php echo base_url() . $this->config->item('upload_path_passbookphoto_thumb'); ?>' + row.passbook_photo + '" style="height:71px;width:89px" onclick="myfunction(this)">';
                                                            }

                                                        },

                                                        {"taregts": 3, render: function (data, type, row) {

                                                                return '<img id="myimage3" src="<?php echo base_url() . $this->config->item('upload_path_pancardphoto_thumb'); ?>' + row.pancard_photo + '" style="height:71px;width:89px" onclick="myfunction(this)">';
                                                            }

                                                        },

                                                        {"taregts": 4, "sClass": "text-center",
                                                            "data": "status",
                                                            "render": function (data, type, row) {
                                                                var id = row.user_id;

                                                                var out = '';
                                                                if (data == 'Approved') {
                                                                    out += '<a title="Change Status"  class="btn btn-success btn-xs st" >Approved</a>';
                                                                } else if (data == 'Declined') {
                                                                    out += '<a title="Change Status" class="btn btn-danger btn-xs st" >Declined</a>';
                                                                } else {
                                                                    out += '<a title="Change Status" href="#change_status" data-id="' + id + '" data-status="Pending" data-toggle="modal"  class="btn btn-warning btn-xs st" >Pending</a>';
                                                                }
                                                                return out;
                                                            }
                                                        },
                                                        {"taregts": 5, 'data': 'created_datetime'

                                                        },
                                                    ]
                                                });
                                                $('#search').on('click', function () {
                                                    reload_transaction_table();
                                                });
                                            }
                                        //});
                                        $(document).ready(function () {
                                            $("#selUser").select2();
                                            load_data();

                                        });
                                        function reload_transaction_table() {
                                            var oTable1 = $('#datatables').dataTable();
                                            oTable1.fnStandingRedraw();
                                        }
                                        $('#startdate').datepicker({
                                            format: "yyyy-mm-dd"
                                        });
                                        $('#enddate').datepicker({
                                            format: "yyyy-mm-dd"
                                        });
                                        $.fn.dataTableExt.oApi.fnStandingRedraw = function (oSettings) {
                                            //redraw to account for filtering and sorting
                                            // concept here is that (for client side) there is a row got inserted at the end (for an add)
                                            // or when a record was modified it could be in the middle of the table
                                            // that is probably not supposed to be there - due to filtering / sorting
                                            // so we need to re process filtering and sorting
                                            // BUT - if it is server side - then this should be handled by the server - so skip this step
                                            if (oSettings.oFeatures.bServerSide === false) {
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
	function myfunction(obj) {
		
            var modals = document.getElementById('myModal');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
		
            modals.style.display = "block";
		modalImg.src = obj.src;
//            modalImg.src = '<?php // echo base_url() . $this->config->item('upload_path_adharphoto_thumb') ?>';
            captionText.innerHTML = obj.alt;
	$("#cxcx").css("opacity", "0.2");
	
	//$(".content-page").css("position", "relative");
		$(".modallg").css("position", "absolute");

            $('.close').on('click', function (e) {
                modals.style.display = "none";
		$(".content-page").css("visibility", "visible");
		$("#cxcx").css("opacity", "1");
            });
        }


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
       
    </script>
<script>
 $('#confirm-status').on('show.bs.modal', function (e) {
            $(this).find('.addhref').attr('href', $(e.relatedTarget).data('href'));
        });
</script>
