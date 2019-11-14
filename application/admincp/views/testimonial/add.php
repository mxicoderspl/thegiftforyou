<?php echo $header; ?>
<?php echo $sidebar; ?>

<div class="content-page">



    <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url(); ?>/assets/images/ajax-loading.gif">
        <p style="margin:0;font-size:14px;color:#fff">loading...</p>
    </div>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">


    <div class="content">
        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">Add Testimonial</h4>
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
                    <div class="col-sm-10">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-t-0 m-b-30">Add new Testimonial</h4>
                                <?php echo form_open_multipart('testimonial/add', array('id' => 'addfrm', 'name' => '')); ?>
                                <div class="form-group col-md-6"> 
                                    <label>Name<span class="text-danger">*</span></label> 
                                    <input type="text" class="form-control" placeholder="" name="cname" id="cname">
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label>Location <span class="text-danger">*</span></label> 
                                    <input type="text" class="form-control" placeholder="" name="location" id="location">
                                </div> 
                                <div class="clearfix"></div>
                                <div class="form-group  col-md-6">
                                    <label>Testimonial<span class="text-danger">*</span></label>
                                    <div>
                                        <textarea class="form-control" rows="3" name="testimonial"></textarea>
                                    </div>
                                </div>

                                <div class="form-group  col-md-6">
                                    <label class="control-label">Image </label>
                                    <input type="file" class="filestyle" data-buttonbefore="true" id="image" name="image" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                   
                                    <br/>
<!--                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" id="home" name="home">
                                        <label class="control-label">Show on Home</label>
                                    </div>-->
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                                        <a href="<?php echo base_url('Testimonial'); ?>" class="btn btn-default waves-effect m-l-5">Cancel</a>
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
<!--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
-->

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>

                                    jQuery("#addfrm").validate({

                                        rules: {

                                            cname: {
                                                required: true,
                                            },

                                            location: {
                                                required: true,
                                            },
                                            testimonial: {
                                                required: true,
                                            },
                                            image: {
                                                required: true,
                                            },
                                        },
                                        messages: {

                                            cname: {
                                                required: "Please enter Customer's Name",
                                            },
                                            location: {
                                                required: "Please enter Location",
                                            },
                                            testimonial: {
                                                required: "Please enter Description",
                                            },
                                            image: {
                                                required: "Image is required",
                                            },

                                        }

                                    });
</script>

