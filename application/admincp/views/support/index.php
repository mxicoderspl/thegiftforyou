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
            <h4 class="page-title">Support Ticket</h4>
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
                            <h4 class="m-b-30 m-t-0">Support Ticket</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12">
                                               <table class="table table-striped table-bordered dataTable " id="datatable" role="grid" aria-describedby="datatable_info">
                                <thead >
                                <th>Tikit ID</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                    <?php if(!empty($support_data)){ ?>
                                    <?php foreach ($support_data as $support) { ?>
                                        <tr>
                                            <td><?php echo "10000".$support['id']."10"; ?></td>
                                            <td><?php echo $support['title']; ?></td>
                                            <td><?php echo nl2br($support['message']); ?></td>
                                             <td><?php if ($support['status'] == 'Open') : ?>
                                                 <a href="<?php echo site_url('Support/update/').  base64_encode($support['id']) ;?>" class="btn btn-success btn-xs" title="Open"><?php echo ($support['status']); ?></a>
                                                    <?php else: ?>
                                                        <a href="#" class="btn btn-danger btn-xs" title="Colse"><?php echo ($support['status']); ?></a>
                                                    <?php endif; ?></td>
                                            <td><?php echo $support['created_date']; ?></td>
                                        </tr>
                                    <?php } } else{ ?>
                                        <tr>
                                            <td colspan="3">No support request available.</td>
                                        </tr>
                                    <?php } ?>
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





<?php echo $footer ?>
<!--alkesh-->

<script>
$(document).ready(function(){
   $('#support_frm').validate({
       ignore: [],
       rules:{
           title:{
               required:true
           },
           message:{
               required: true
           }
       }
   }); 
});

</script>
