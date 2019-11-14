<?php echo $header; ?>
<?php echo $sidebar; ?>

<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">

            <!--<div class="container">-->
            <div class="container">

                <div class="col-xs-12">
		    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#debittransaction" >Debit Transaction</a></li>
                        <li><a data-toggle="tab" href="#credittransaction">Credit Transaction</a></li>

                    </ul>
                    <div class="panel">
                        <div class="panel-body tab-content">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Wallet to Wallet Transaction
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
                                    <button type="button" class="btn btn-default" onclick="reload_transaction_table()" >Search</button>
                                </div>
                            </div>
                            <div id="debittransaction" class="row tab-pane fade in active">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <div id="ebctransaction_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Wallet Transaction Id</th>
                                                    <th >Transfer to</th>
                                                    
                                                    <!-- <th >Type</th>-->
                                                    <th >Amount</th>
                                                    <!--<th >Comment</th>-->
                                                    <th >Total Tax</th>
                                                    <th >Date</th>

                                                </tr>
                                            </thead>

                                        </table>

                                        <!--</div>-->
                                    </div>
                                </div>


                            </div>
			    <div id="credittransaction" class="row tab-pane fade in">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <div id="ebctransaction_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables1" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Id</th>
                                                    <th >Transfer from</th>
                                                    <th >Amount</th>

                                                    <th >Date</th>

                                                </tr>
                                            </thead>

                                        </table>

                                        <!--</div>-->
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
</div>



<?php echo $footer ?>




<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!--jquer, javascript and ajax-->
<script type="text/javascript">
                                        function load_data() {
                                            var table = jQuery('#datatables').DataTable({
                                                "processing": true,
                                                "serverSide": true,
                                                "responsive": true,
                                                "order": [[0, "DESC"]],
                                                "ajax": {
                                                    url: "<?php echo site_url('Wallet_to_wallet/getdata'); ?>",
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

                                                    {"taregts": 0, "sClass": "text-center", 'data': 'wallet_transaction_id'

                                                    },
                                                    {"taregts": 1, "sClass": "text-center", render: function (data, type, row) {

                                                            return row.to_username;
                                                        }

                                                    },

                                                    {"taregts": 2, "sClass": "text-center", render: function (data, type, row) {

                                                            return '<?php echo $this->config->item('currency_icon') ?> ' + row.amount;
                                                        }

                                                    },
                                                    {"taregts": 3, "sClass": "text-center", 'data': 'Total_tax'

                                                    },

                                                    {"taregts": 3, "sClass": "text-center", 'data': 'created_date',

                                                    },

                                                ]
                                            });
                                            $('#search').on('click', function () {
                                                reload_transaction_table();
                                            });
                                        }

					 function load_data1() {
                                            var table = jQuery('#datatables1').DataTable({
                                                "processing": true,
                                                "serverSide": true,
                                                "responsive": true,
                                                "order": [[0, "DESC"]],
                                                "ajax": {
                                                    url: "<?php echo site_url('Wallet_to_wallet/getdata1'); ?>",
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

                                                    {"taregts": 0, "sClass": "text-center", 'data': 'wallet_transaction_id'

                                                    },
                                                    {"taregts": 1, "sClass": "text-center", render: function (data, type, row) {

                                                            return row.from_username;
                                                        }

                                                    },

                                                    {"taregts": 2, "sClass": "text-center", render: function (data, type, row) {

                                                            return '<?php echo $this->config->item('currency_icon') ?> ' + row.amount;
                                                        }

                                                    },
                                                 
                                                    {"taregts": 3, "sClass": "text-center", 'data': 'created_date',

                                                    },

                                                ]
                                            });
                                            $('#search').on('click', function () {
                                                reload_transaction_table();
                                            });
                                        }
                                        $(document).ready(function () {

                                            load_data();
					    load_data1();

                                        });
                                        function reload_transaction_table() {
                                            if ($('#debittransaction').hasClass('active')) {
                                                    var oTable1 = $('#datatables').dataTable();

                                                } else {
                                                    var oTable1 = $('#datatables1').dataTable();
                                                }
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
