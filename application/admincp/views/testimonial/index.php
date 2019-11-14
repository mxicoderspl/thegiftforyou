<?php echo $header; ?>
<?php echo $sidebar; ?>
 <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">
<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Testimonial</h4>
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
<!--                <div class="col-md-3"></div>-->
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">Testimonials</h4>
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatable" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="col-xs-3">Client</th>
                                                            <th class="col-xs-3">Location</th>
                                                            <th class="col-xs-6">Description</th>
                                                            <th class="col-xs-3 text-center">Status</th>
                                                            <th class="col-xs-3 text-center">Actions</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($testimonials as $tm) {
                                                            ?>
                                                            <tr role="row" class="odd">
                                                               
                                                                <td><?php echo $tm['client_name']; ?></td>
                                                                <td><?php echo $tm['location']; ?></td>
                                                                <td><?php echo $tm['testimonial']; ?></td>
                                                                <td><?php if ($tm['status'] == "Enable") { ?>
                                                                        <a class="btn btn-success btn-xs st" href="#change_status" data-id="<?php echo $tm['id'] ?>" data-status="<?php echo $tm['status'] ?>" data-toggle="modal">Enable</a>
                                                                    <?php } else { ?>
                                                                        <a class="btn btn-danger btn-xs st"  href="#change_status"  data-id="<?php echo $tm['id'] ?>" data-status="<?php echo $tm['status'] ?>" data-toggle="modal">Disable</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <!--<a href="#editmodal" title="Edit" id="edit_btn" data-toggle="modal" onclick="edit_page('<?php echo $tm['id']; ?>');"> <i class="glyphicon glyphicon-edit"></i></a>-->
                                                                    <a href="<?php echo site_url('testimonial/edit/' . base64_encode($tm['id'])); ?>" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                                                    <a class="dt" href="#deletemodal" data-id="<?php echo $tm['id'] ?>"  title="Delete" data-toggle="modal" > <i class="glyphicon glyphicon-trash"></i></a>
                                                                </td>

                                                            </tr>
                                                            <?php
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
                <!--<div class="col-md-1"></div>-->
            </div>
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
            <?php echo form_open('Testimonial/update_status', array('class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <input type="hidden" id="testid" name="testid"/>
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
            <?php echo form_open('Testimonial/delete', array('class' => 'form-horizontal')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete Testimonial</h3>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Testimonial ?</h5>
                <input type="hidden" value="" id="deletetestid" name="deletetestid"/>

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

        $('#testid').val(id);
        $('#old_status').val(st);

    });
    $(document).on("click", ".dt", function () {

        var id = $(this).data('id');
        $('#deletetestid').val(id);

    });

</script>
