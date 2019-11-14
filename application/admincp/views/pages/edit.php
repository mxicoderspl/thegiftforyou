<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">


<div class="content">
    <div class="">
        <div class="page-header-title">
           <!-- <h4 class="page-title">Edit</h4>-->
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
                            <h4 class="m-b-30 m-t-0">Edit</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    

                                        
                <!--<div class="row row-stat">-->

                <?php
                echo form_open('pages/update/' . base64_encode($page_data[0]['page_id']), array(
                    "id" => "update_page", "class" => "form-horizontal", "name" => "about_us"));
                ?>
                <!--<form action="<?php echo base_url('pages/update/' . base64_encode($page_data[0]['page_id'])); ?>"  >-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Page Title<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $page_data[0]['pagetitle']; ?>" class="form-control" name="page_title" id="page_title">
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>
<?php if( $page_data[0]['page']==1){ ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Meta Keywords<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <textarea  class="form-control" name="metakey" id="metakey"><?php echo trim($page_data[0]['meta_keywords']); ?></textarea>
                       
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Meta Description<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <textarea  class="form-control" name="metadesc" id="metadesc"><?php echo trim($page_data[0]['meta_description']); ?></textarea>
                       
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>
<?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <textarea  class="form-control ckeditor" name="description" id="description"><?php echo trim($page_data[0]['description']); ?></textarea>
                       
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label"> </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="Update">
                        <a class="btn btn-default" href="<?php echo base_url('pages'); ?>" >Cancel</a>
                    </div>
                </div>
                </form>
            

                                  
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


<?php echo $footer ?>
 <script src="<?php echo base_url(); ?>../ckeditor/ckeditor.js"></script>
<script type="text/javascript">

    
</script>



