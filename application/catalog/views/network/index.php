<?php echo $header; ?>
<?php echo $sidebar; ?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper">

            <!--<div class="container">-->
            <div class="container">

                <div class="col-xs-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;My Network
                                    <div class="col-sm-2 pull-right"> 
                                        <a href="<?php echo site_url('Registrationpayment/index');?>" class="btn btn-default waves-effect m-l-5">Go Back</a>
                                    </div>
                                </h4>
                                <!--                                <div class="col-xs-2"><label class="datefilterlabel">Date Filter:</label></div>
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
                                                                </div>-->

                                <div class="col-xs-2">
                                    <!--<button type="button" class="btn btn-default" onclick="exportdata()" >Export</button>-->
                                    <!--<a href='<?= base_url('wallet/exportfiledata'); ?>'>Export</a><br><br>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <!--<input type="hidden" id="wtid" name="wtid" value="<?php echo (isset($_GET['wtid']) && $_GET['wtid'] != '') ? $_GET['wtid'] : ''; ?>" />-->
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables1" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <!--<th>User id</th>-->
                                                    <th class="col-xs-3 text-center">Level</th>
                                                    <th class="col-xs-3 text-center">Total Users</th>
                                                    <th class="col-xs-3 text-center">Total Earning</th>
                                                    <th class="col-xs-3 text-center">Action</th>

                                                </tr>
                                            </thead>
                                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#userlistmdl" onclick="viewdata(<?php echo $i ?>)" ><?php echo $totaluser[$i]; ?></a></td>

                                                    <td class="text-center"><?php echo $this->config->item('currency_icon') . $totalrewardamount[$i][0]['totalamount']; ?></td>
                                                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#userlistmdl" onclick="viewdata(<?php echo $i ?>)" ><i class="fa fa-eye"></i></a></td>
                                                </tr>

                                            <?php } ?>

                                        </table>

                                        <!--</div>-->
                                    </div>
				<div class="pull-left">
                            		Legend(s): &nbsp; 
                            		<i class="fa fa-eye"></i>&nbsp; View &nbsp;
                            		
                        	</div>
                                </div>


                            </div>

                        </div>

                    </div>



                </div>

                <!--</div>-->
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
                                                        function viewdata(id) {
                                                            $('#levelid').val(id);
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
