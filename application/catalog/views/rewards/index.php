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
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Reward Transaction
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
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <div id="ebctransaction_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                        <table class=" table table-hover m-b-0   dataTable no-footer" id="datatables" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Transaction Id</th>
                                                    <th>Reward From</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Date</th>
                                                    <th></th>
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
                                                    url: "<?php echo site_url('Wallet/getrewardsdata'); ?>",
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

                                                    {"taregts": 0, "sClass": "text-center",'data': 'id'

                                                    },
                                                    {"taregts": 1,"sClass": "text-center", render: function (data, type, row) {

                                                            return row.email;
                                                        }

                                                    },

                                                    {"taregts": 2, "sClass": "text-center",render: function (data, type, row) {

                                                            return '<?php echo $this->config->item('currency_icon') ?> ' + row.amount;
                                                        }

                                                    },
                                                    
                                                    {"taregts": 3, "sClass": "text-center",'data': 'created_datetime',

                                                    },
                                                    {"taregts": 4, "sClass": "text-center", "orderable": false, "searchable": false,
                                                        "render": function (data, type, row) {
                                                            var wtid= btoa(row.wallet_transaction_id);
                                                            var tid = btoa(row.id);
                                                            var out = '';
                                                            out += '<a title="View" href="<?php echo site_url('Wallet') ?>?wtid=' + wtid + '&tid=' + tid + '"><i class="fa fa-eye"></i></a>&nbsp;';
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
