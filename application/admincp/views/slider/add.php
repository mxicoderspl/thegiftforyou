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
            <h4 class="page-title">Add New Banner</h4>
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
                                <h4 class="m-b-30 m-t-0">Add new Banner</h4>
                                <?php echo form_open('Slider/add/', array('id' => 'addfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
                                <!--<form class="form-horizontal" action="add_sl" method="post">-->
                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="title" value=""/>
                                    </div>
                                </div>
                                <!--<div class="form-group"> 
                                    <label class="col-md-2 control-label">Link <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="link" value=""/>
                                    </div>
                                </div>-->
                             <div class="form-group">
                                    <label class="col-md-2 control-label">Image <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="file" class="filestyle" data-buttonbefore="true"  name="image" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                        <label for="filestyle-0" class="error"></label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description<span class="text-danger"> *</span></label>
                                    <div class="col-sm-8">
                                        <textarea  class="form-control ckeditor" name="description" id="description"></textarea>

                                    </div>
                                   
                                </div>


                                <div class="form-group" style="margin-right:157px">
                                    <div class="pull-right"> 
                                        <input type="submit" value="Submit" class="btn btn-primary"/>
                                        <a href="<?php echo base_url('Slider'); ?>" class="btn btn-default waves-effect m-l-5">Cancel</a>
                                    </div>
                                </div>
                                </form>
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
<script src="<?php echo base_url(); ?>../ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>

jQuery("#addfrm").validate({

                                                rules: {
							/*link: {
                                                        required: true,
                                                        remote: {
                        url: "<?php echo site_url('Slider/valid_link') ?>",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#link").val();

                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
                    }
                                                    },*/
                                                    title: {
                                                        required: true,
                                                    },
                                                    
						image: {
                                                        required: true,
                                                    },                                                   
                                                },
                                                messages: {
                                                   /* title: {
                                                        required: "Please enter title",
                                                    },*/
						
                                                    link: {
                                                        required: "Please enter Link",
                                                        remote: " Please Enter valid link for example http://anytext.com .",
                                                    },
						    image: {
                                                        required: "banner image require",
                                                    },
                                                    
                                                }

                                            });
</script>

