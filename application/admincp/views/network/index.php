<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">


<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Network</h4>
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
                            <h4 class="m-b-30 m-t-0">Network</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                    <div class="table-responsive">

                                        <!--<input type="hidden" id="wtid" name="wtid" value="<?php echo (isset($_GET['wtid']) && $_GET['wtid'] != '') ? $_GET['wtid'] : ''; ?>" />-->
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables1" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <!--<th>User id</th>-->
                                                    <th class="col-xs-3 text-center">Level</th>
                                                    <th class="col-xs-3 text-center">Total Users</th>
                                                    <th class="col-xs-3 text-center">Level Status</th>
                                                    <th class="col-xs-3 text-center">Total Earning</th>
                                                    <th class="col-xs-3 text-center">Action</th>

                                                </tr>
                                            </thead>
                                            <?php for ($i = 0; $i < 10; $i++) { ?>
                                             
                                                <tr>
                                                    <td class="text-center"><?php echo $i+1; ?></td>
                                                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#userlistmdl" onclick="viewdata(<?php echo $i+1 ?>,<?php echo $user_iddata ?>)" ><?php echo $totaluser[$i]; ?></a></td>
                                                    <td class="text-center"><?php  if((($totaluser[$i]==$dtlreward[$i]['person_number']) || ($totaluser[$i]>$dtlreward[$i]['person_number']) && !empty($dtlreward[$i]['person_number']))&&!empty($totaluser[$i])){ ?> <a class="btn btn-success"> <?php echo 'Complated'; ?></a> <?php }else{ ?> <a class="btn btn-danger">  <?php echo 'Not Complated' ;} ?></a></td>
                                                    <td class="text-center"><?php echo $totalrewardamount[$i][0]['totalamount']; ?></td>
                                                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#userlistmdl" onclick="viewdata(<?php echo $i+1 ?>,<?php echo $user_iddata ?>)" ><i class="fa fa-eye"></i></a></td>
                                                </tr>

                                            <?php } ?>

                                        </table>

                                        <!--</div>-->
                                 
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
    <!----------------------reward transaction modal-------------------------------->


    <div class="modal fade bd-example-modal-lg" id="userlistmdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 >Transactions Information</h4>
                </div>
                <div class="modal-body" id="confirm_status_body">
                    <input type="hidden" id="levelid" value="0"/>
                     <input type="hidden" id="userid" value="0"/>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatables">
                            <thead>
                                <tr>
                                    <th>Id</th>
				    <th>Name</th>
                                    <th>Reward From</th>
                                    <th>Amount</th>
                                    <th>Date</th>

                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>


    <?php echo $footer ?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
                                                        function viewdata(id,user) {
                                                            $('#levelid').val(id);
                                                             $('#userid').val(user);
                                                            
                                                            $('#userlistmdl').show();
                                                            refresh_table();

                                                        }
                                                        function refresh_table() {
                                                            var oTable1 = $('#datatables').dataTable();
                                                            oTable1.fnStandingRedraw();
                                                        }
                                                        $(document).ready(function () {
                                                            var table = jQuery('#datatables').DataTable({
                                                                "processing": true,
                                                                "serverSide": true,
                                                                "responsive": true,
                                                                "order": [[0, "DESC"]],
                                                                "ajax": {
                                                                    url: "<?php echo site_url('Network/listofusers'); ?>",
                                                                    type: "GET",
                                                                    data: function (d) {
                                                                        d.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
                                                                        d.tid = $('#levelid').val();
                                                                        d.userid= $('#userid').val();

                                                                    },
                                                                },
                                                                "columns": [

                                                                    {"taregts": 0, "sClass": "text-center", 'data': 'id'

                                                                    },
								    {"taregts": 1, "sClass": "text-center", render: function (data, type, row) {

                                                                            return row.firstname + row.lastname;
                                                                        }

                                                                    },
                                                                    {"taregts": 2, "sClass": "text-center", render: function (data, type, row) {

                                                                            return row.email;
                                                                        }

                                                                    },

                                                                    {"taregts": 3, "sClass": "text-center", 'data': 'amount'

                                                                    },

                                                                    {"taregts": 4, "sClass": "text-center", 'data': 'created_datetime',

                                                                    },
                                                                ]
                                                            });
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
