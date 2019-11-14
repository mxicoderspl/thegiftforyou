<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>



<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Edit User Support</h4>
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
                                <h4 class="m-b-30 m-t-0">Edit User Support</h4>
                               <?php echo form_open('Support/updatedata', array('id' => 'frmsemEdit')); ?>
                            <input type="hidden" name="id" value="<?php echo $this->data['support_data'][0]['id']?>" />
                             <input type="hidden" name="user_id" value="<?php echo $this->data['support_data'][0]['user_id']?>" />
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" readonly name="title" value="<?php echo $this->data['support_data'][0]['title']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="8" class="form-control" readonly name="message"/><?php echo nl2br($this->data['support_data'][0]['message']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Reply</label>
                                    <textarea rows="8" class="form-control"  name="reply"/></textarea>
                                </div>
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn modal-btn" value="Update" />
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer ?>





<script>
    $(document).ready(function () {
        $('#frmsemEdit').validate({
            ignore: [],
            rules: {
                title: {
                    required: true
                },
                message: {
                    required: true
                },
                reply: {
                    required: true
                },
            }
        });
    });

</script>
