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
            <h4 class="page-title">Disable Users</h4>
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
                            <h4 class="m-b-30 m-t-0">Disable Users</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatable" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr role="row">
							<th class="col-xs-2">Profile Pic</th>
							   <th class="col-xs-3">Name</th>
                                                            <th class="col-xs-4">Email</th>
							   <th class="col-xs-4">Mobile No</th>
                                                           <th class="col-xs-3 text-center"><span class='text-center'>Payment Verified</span></th>
                                                            <th class="col-xs-3"><span class="pull-right">Balance</span></th>
							    <th class="col-xs-6 text-center">Status</th>
                                                            <th class="col-xs-1 text-center">Action</th>

                                                        </tr>
                                                    </thead>
                                                   <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($userdata as $sdata) {
                                                            
							?>
                                                            <tr role="row" class="odd">
                                                               
                                                                <td>
								<?php if(!empty($sdata['profilepic'])){?>
								<img class="img-circle" src="<?php echo base_url().$this->config->item('upload_path_profilepic_thumb').$sdata['profilepic']; ?>" style="height:71px;width:89px">
								<?php }else{ ?>
									<img class="img-circle" src="<?php echo base_url(); ?>../assets/images/user4.png" style="height:71px;width:89px">
								<?php } ?>
								</td>

								<td><?php echo $sdata['firstname']." ".$sdata['lastname']; ?></td>
								<td><?php echo $sdata['email']; ?></td>
								<td><?php echo $sdata['mobile_no']; ?></td>
                                                                <td class='text-center'>
								<?php if ($sdata['payment_verified'] == "Yes") { ?>
                                                                        <a class="btn btn-success btn-xs st"><?php echo $sdata['payment_verified']; ?></a>
                                                                    <?php } else { ?>
                                                                         <a class="btn btn-danger btn-xs st"><?php echo $sdata['payment_verified']; ?></a>
                                                                    <?php } ?>
							</td>
								<td><span class="pull-right"><?php echo $this->config->item('currency_icon') ?>&nbsp;<?php echo $sdata['wallet_balance']; ?></span></td>
								
                                                                <td class="text-center"><?php if ($sdata['status'] == "Enable") { ?>
                                                                        <a class="btn btn-success btn-xs st" href="#change_status" data-id="<?php echo $sdata['id'] ?>" data-status="<?php echo $sdata['status'] ?>" data-toggle="modal">Enable</a>
                                                                    <?php } else { ?>
                                                                        <a class="btn btn-danger btn-xs st"  href="#change_status"  data-id="<?php echo $sdata['id'] ?>" data-status="<?php echo $sdata['status'] ?>" data-toggle="modal">Disable</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                   <!-- <a href="#editmodal" title="Edit" id="edit_btn" data-toggle="modal" onclick="edit_slider('<?php echo base64_encode($sdata['id']); ?>');"> <i class="glyphicon glyphicon-edit"></i></a>
                                                                   
                                                                     <a href="#walletmodal" title="Editwallet" id="edit_btns" data-toggle="modal" onclick="edit_wallet('<?php echo base64_encode($sdata['id']); ?>');"> <i class="fa fa-money"></i></a>-->
                                                                    <a class="dt" href="#deletemodal" data-id="<?php echo $sdata['id'] ?>"  title="Delete" data-toggle="modal" > <i class="glyphicon glyphicon-trash"></i></a> 
                                                                </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
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
<!---wallet--->
<div id="walletmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="walletmodel_data">

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
            <?php echo form_open('Users/update_status', array('class' => 'form-horizontal')); ?>
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
            <?php echo form_open('Users/delete', array('class' => 'form-horizontal')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete User</h3>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this user ?</h5>
                <input type="hidden" value="" id="deleteuserid" name="deleteuserid"/>

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

<script type="text/javascript">

    $(document).on("click", ".st", function () {

        var id = $(this).data('id');
        var st = $(this).data('status');

        $('#slideid').val(id);
        $('#old_status').val(st);

    });
    $(document).on("click", ".dt", function () {

        var id = $(this).data('id');
      
          $('#deleteuserid').val(id);
     
    });

    function edit_slider(id)
    {

        var user_id = id;
        $('#model_data').html('');
        $.ajax({
            url: "<?php echo site_url() . 'Users/update' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'user_id': user_id, },
            catch : false,
            success: function (data) {
                $('#model_data').append(data);

            }
        });
    }
     

            function edit_wallet(id)
            {
         var user_id = id;
                $('#walletmodel_data').html('');
                $.ajax({
                    url: "<?php echo site_url() . 'Users/wallet' ?>",
                    type: "POST",
                    dataType: "html",
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'user_id': user_id, },
                    catch : false,
                    success: function (data) {
                        $('#walletmodel_data').append(data);

                    }
                });
            }
</script>



