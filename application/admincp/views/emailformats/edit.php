<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<style type="text/css">
            .error{
                color: red;
                font-size: 16px;
            }
            .button{
                text-align: center;
            }
            
        </style>
<div class="content">
      <div class="">
        <div class="page-header-title">
          <h4 class="page-title">Edit Email Template</h4>
        </div>
      </div>
      <div class="page-content-wrapper ">
        <div class="container">
            <div class="panel">
               <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Edit Email Template</h4>
            <div class="row">
                 <?php
                echo form_open(site_url('emailformat/update/' . base64_encode($email_template[0]['id'])), array(
                    "id" => "update_page", "class" => "form-horizontal", "name" => "about_us"));
                ?>
                <!--form action="<?php echo site_url('emailformat/update/' . base64_encode($email_template[0]['id'])); ?>"  id="update_page" class="form-horizontal" method="post" name="about_us" -->                            
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $email_template[0]['title']; ?>" class="form-control" name="title" disabled="true" id="title">
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Subject<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $email_template[0]['subject']; ?>" class="form-control" name="subject" id="subject">
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Variables<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <label><?php echo $email_template[0]['variables']; ?></label>
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Format<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <textarea style="width:494px;height:233px;margin: 0px -0.015625px 0px 0px;" class="form-control ckeditor" name="description" id="description" onchange="getinst()"><?php echo trim($email_template[0]['emailformat']); ?></textarea>
                        <?php //echo display_ckeditor($ckeditor); ?>
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label"> </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="Update">
                        <a class="btn btn-default" href="<?php echo site_url('emailformat'); ?>" >Cancel</a>
                    </div>
                </div>
             <?php echo form_close();?>
                
            </div>
                            </div></div>
            
        </div>
      </div>
</div>

   <?php echo $footer; ?>

      
        
        <script src="<?php echo base_url('../admincp/assets/js/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo base_url(); ?>../ckeditor/ckeditor.js"></script>

        <script type="text/javascript">
                            $(document).ready(function () {
                                $('.close').click(function () {
                                    $('.alert').hide();
                                });
                                $('#update_page').validate({
                                    debug: false,
                                    ignore: [],
                                    rules: {
                                        title: "required",
                                        subject: "required",
                                        description: {
                                            required: function ()
                                            {
                                                CKEDITOR.instances.description.updateElement();
                                            }
                                        }

                                    },
                                    messages: {
                                        title: " Email Title is required",
                                        subject: "Email subject is required",
                                        description: {
                                            required: "Mail format is required"
                                        }
                                    },
                                    errorElement: 'div',
                                    errorClass: 'error'

                                });

                            });

        </script>
