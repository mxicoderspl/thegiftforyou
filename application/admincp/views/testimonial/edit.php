<?php echo $header; ?>
<?php echo $sidebar; ?>

<div class="content-page">



    <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url(); ?>/assets/images/ajax-loading.gif">
        <p style="margin:0;font-size:14px;color:#fff">loading...</p>
    </div>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">


<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Edit Testimonial</h4>
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
<div class="col-sm-1">
                    </div>
                <div class="col-md-10">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">Edit Testimonial</h4>
                            <div class="row">
                                <?php echo form_open_multipart('testimonial/update_test', array('id' => 'frmEdit')); ?>
                                <!--<div class="modal-body">-->
                                <input type="hidden" name="testid" id="testid" value="<?php echo $page_info['id']; ?>"/>
                                <div class="form-group col-md-12"> 
                                    <label>Customer <span class="text-danger">*</span></label> 
                                    <input type="text" class="form-control" required="" placeholder="" name="cname" id="cname" value="<?php echo $page_info['client_name']; ?>">
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label>Testimonial<span class="text-danger">*</span></label>
                                    <div>
                                        <textarea class="form-control" rows="3" name="testimonial"><?php echo $page_info['testimonial']; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12"> 
                                    <label>Location <span class="text-danger">*</span></label>
                                    <div> <input type="text" class="form-control"  placeholder="" name="location" id="location" value="<?php echo $page_info['location']; ?>"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Image </label>
                                    <input type="file" class="filestyle" data-buttonbefore="true" id="image" name="image" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                    <div class="bootstrap-filestyle input-group">

                                    </div>
                                </div>
				 <div class="form-group col-md-6">
                                    <img src="<?php echo base_url() . $this->config->item('upload_path_testimonial_thumb') . $page_info['image'] ?>" style="width:160px;height:70px" id="img1" name="img1"/>
                                </div>
                                <div class="form-group">
<!--                                    <label>Show on Home</label>
                                    <div class="">
					<div class="checkbox checkbox-primary">
					 <input type="checkbox" name="home" <?php echo($page_info['on_home'] == 1) ? 'checked' : '' ?>>
					 <label for="checkbox">  </label>
					</div>
                                        <input id="home" name="home" type="checkbox" <?php // echo($page_info['on_home'] == 1) ? 'checked' : '' ?>>
                                    </div>-->
                                </div>
                                <div class="clearfix"></div>
                               
                                <div class="form-group col-md-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                                        <a href="<?php echo base_url('Testimonial'); ?>" class="btn btn-default waves-effect m-l-5">Cancel</a>
                                    </div>
                                </div>
                                <!--</div>-->
                                <?php form_close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
<div class="col-sm-1">
                    </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer ?>

<script>
    jQuery("#frmEdit").validate({

        rules: {

            project: {
                required: true,
            },
            client: {
                required: true,
            },
            url: {
                required: true,
               
            },
            testimonial: {
                required: true,
               
            },

        },
        messages: {
            project: {
                required: "Please enter project "
            },
            client: {
                required: "Please enter client name"
            },
            url: {
                required: "Please enter url",
               
            },
            testimonial: {
                required: "Please enter testimonial"
            },

        }

    });
</script>
