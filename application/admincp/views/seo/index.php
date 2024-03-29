<?php echo $header; ?>    
 <?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>

<div class="content">
      <div class="">
        <div class="page-header-title">
          <h4 class="page-title">SEO Setting</h4>
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
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-t-0"></h4>
                             <div class="table-responsive">
                            <table class="table table-primary mb30 table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Value</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($settings) > 0) { ?>
                                        <?php for ($i = 0; $i < count($settings); $i++) { ?>   
                                            <tr class="gradeX">
                                                <td><?php echo $i + 1; ?></td>

                                                <td><?php echo ucfirst($settings[$i]['fieldname']); ?></td>
                                                <td><?php echo ($settings[$i]['value']); ?></td>
                                                <td class="text-center">
                                                    <a href="#myModal" title="Edit" id="edit_btn" onclick="edit_setting('<?php echo base64_encode($settings[$i]['id']); ?>');" data-toggle="modal"> <i class="glyphicon glyphicon-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?> 
                                        <tr><td colspan="3" class="text-center"> <?php echo "No record found" ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        <div class="pull-leftpadng_rmv">
                            Legend(s): &nbsp; 
                            <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                        </div>
                        
                        </div>  
                    </div>  
                </div>
            </div>
                
                <!--Bootstrap model for edit start-->
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content" id="model_data">
                        </div>
                    </div>
                </div>
                
        </div>
      </div>
</div>

<?php echo $footer; ?>
<script type="text/javascript">

    $(document).ready(function () {
        $("#errorMsg").hide();
    });
    $('#myModal').on('hidden.bs.modal', function () {
        $('#model_data').html('');
    });
    function edit_setting(id)
    {

        var setting_id = id;

        $.ajax({
            url: "<?php echo site_url() . 'Seo/editform' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'setting_id': setting_id},
            catch : false,
            success: function (data) {
                $('#model_data').append(data);

            }
        });
    }
</script>

