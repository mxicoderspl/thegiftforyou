<?php
echo $header;
echo $left_menu;
?>
<div id="content">
    <div id="content-header">
        <h1>General Setting</h1>        
    </div>
    <div id="breadcrumb">
        <a href="<?php echo site_url(); ?>" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
        <a href="<?php echo site_url('Setting'); ?>">General Setting</a>
        <a href="" class="current">Edit</a>
    </div>
    <div class="row">
        <div class="row">
            <p class="text-right" >All fields marked with (<span class="text-maroon">*</span>) are mandatory.</p>
            <div class="col-sm-8 padng_rgtrmv">

                <div class="alert alert-danger spanerror" id="txtvalueerror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    <?php echo $settings[0]['field_name']; ?> is required </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtnumbererror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    Please enter valid number.(Eg: 1234567890) </div>
            </div> 
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtsitenameerror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    Site  name less then 50 character </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtsiteownererror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    Site owner name less then 60 character </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtemailerror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    Please enter valid Email </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtlinkerror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    Please enter valid link.(Eg: http://www.xyz.com) </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-danger spanerror" id="txtpasserror" style="display: none;">
                    <button type="button" class="close" onClick="closediv()">×</button>
                    <strong>Please enter aplhanumeric password.(Minimum length 6)</strong> </div>
            </div>

        </div>
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="fa fa-align-justify"></i>									
                    </span>
                    <h5>General Setting</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open($this->uri->segment(1) . '/update', array('class' => 'form-horizontal', 'enctype' => "multipart/form-data", 'id' => 'myform', 'name' => 'myform')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-lg-2 control-label padng_rmv_left"><?php echo $settings[0]['field_name']; ?><span class="text-maroon"> *</span></label>
                        <div class="col-sm-7 col-md-6 col-lg-6 padng_rmv_right">
                            <input type="text" value="<?php echo ($settings[0]['field_value']); ?>" class="form-control col-sm-12" name="fieldvalue" id="fieldvalue" >
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $this->encrypt->encode($settings[0]['setting_id']); ?>" name="setting_id">
                    <input type="hidden" name="txtd" id="txtd" value="<?php echo $settings[0]['field_name']; ?>" />
                    <div class="form-actions">
                        <button class="btn btn-primary" name="btnupdate" id="btnupdate" type="submit" title="Save"><i class="icon-save"></i> Save</button>
                        <input type="hidden" name="btnsubmit" value="btnsubmit" />
                        <button type="button" title="Cancel" class="btn btn-blck" onclick="window.location.href = '<?php echo site_url('setting'); ?>'">Cancel</button>
                    </div>
                    <?php
                    echo form_close();
                    ?> 
                </div>
            </div>			
        </div>
    </div>   
</div>
<?php echo $footer; ?>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {

        // When the browser is ready...
        $(function () {

            // Setup form validation on the #register-form element
            $("#myform").validate({
                // Specify the validation rules

                rules: {
                    fieldvalue: "required",
                },
                // Specify the validation error messages
                messages: {
                    fieldvalue: "Please enter field value",
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

        });
    });


</script>
