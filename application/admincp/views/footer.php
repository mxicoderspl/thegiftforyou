 <footer class="footer"> ©  <?php echo date('Y').' '. $app_name; ?> - All Rights Reserved. </footer>
  </div>
</div>

<div class="modal fade" id="edt_profile" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade " id="change-password" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog ">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade " id="chng_psw" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('dashboard/changepassword', array('id' => 'frmchngPsw')); ?>
		<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Change Password</h3>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-md-3">Old Password <span class="text-maroon"> *</span></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="old_password" id="old_password" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">New Password <span class="text-maroon"> *</span></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="new_password" id="new_password" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">Confirm Password<span class="text-maroon"> *</span></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="confirm_password" value="" />
                    </div>
                </div>
                <div class="modal-footer form-group text-center row">
                    <input type="submit" class="btn btn-success" value="Change Password" />
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>

    var js_base_url = '<?php echo base_url(); ?>';
</script>

<script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/detect.js"></script>
<script src="<?php echo base_url();?>/assets/js/fastclick.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url();?>/assets/js/waves.js"></script>
<script src="<?php echo base_url();?>/assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery.scrollTo.min.js"></script>

<!--<script src="<?php echo base_url();?>/assets/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/raphael/raphael-min.js"></script>
<script src="<?php echo base_url();?>/assets/pages/dashborad.js"></script>-->
<script src="<?php echo base_url();?>/assets/js/app.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/buttons.bootstrap.min.js"></script> 
<!--<script src="<?php echo base_url(); ?>/assets/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/vfs_fonts.js"></script> 
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/buttons.html5.min.js"></script> 
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/buttons.print.min.js"></script> -->
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script> 
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/responsive.bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.scroller.min.js">
</script>
<script src="<?php echo base_url(); ?>/assets/pages/datatables.init.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/ajax-loading.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.bootstrap-growl.min.js"></script>

<script>


    var loading = $.loading();


    function openLoading(time) {
        loading.open(time);
    }

 function closeLoading() {
		loading.close();
	    }

jQuery(document).ready(function () {
       // $('.wysihtml5').wysihtml5();
       // $('.summernote').summernote({height: 200, minHeight: null, maxHeight: null, focus: false});
    });
    function closeLoading() {
        loading.close();
    }
    function flash_alert_msg(msg, msg_type = 'success', delay = '60000') {
        if (msg_type == 'success') {
            $.bootstrapGrowl("<i class='fa fa-check-circle' aria-hidden='true'></i><strong>&nbsp;&nbsp;" + msg + "</strong> ", {
                type: 'success',
                delay: delay,
                width: 'auto',
                align: 'center',

                allow_dismiss: true
            });
        }


        if (msg_type == 'error') {
            $.bootstrapGrowl("<i class='fa fa-times-circle-o' aria-hidden='true'></i><strong>&nbsp;&nbsp;" + msg + "</strong> ", {
                type: 'danger',
                delay: delay,
                width: 'auto',
                allow_dismiss: true,
                align: 'center'
            });
        }

        if (msg_type == 'info') {
            $.bootstrapGrowl("<i class='fa fa-exclamation-circle' aria-hidden='true'></i><strong>&nbsp;&nbsp;" + msg + "</strong> ", {
                type: 'info',
                delay: delay,
                width: 'auto',
                allow_dismiss: true,
                align: 'center'
            });
    }
    }
</script>

<script>
    jQuery(document).ready(function () {
        jQuery('#content').on('hidden.bs.modal', '.modal', function () {
            jQuery(this).removeData('bs.modal');
        });
    });
</script>
<script>
    $('#frmchngPsw').validate({
        rules: {
            old_password: {required: true,
                remote: {
                    url: "<?php echo site_url('Dashboard/pwdexist') ?>",
                    type: "post",
                    data: {
                        old_password: function ()
                        {
                            return $("#old_password").val();
                        },
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                }

            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 15,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password",
            },
        },
        messages: {
            old_password: {
                required: "Old password is required!",
                remote: "Wrong old password!",
            },
            new_password: {
                required: "Enter new password!",
                minlength: "Password length must be 6 to 16 characters",
                maxlength: "Password length must be 6 to 16 characters",
            },
            confirm_password: {
                required: "Enter confirm password!",
                equalTo: "The confirm password must be same as a password",
            },
        },
    });
</script>
<script>
    function show_modal(obj) {
        var modal_id = $(obj).attr('href');
        var content = $(modal_id).children('div.modal-dialog').children('div.modal-content');
        var data_url = $(obj).attr('data-href');
        $(content).html('');
        $.ajax({
            url: data_url,
            dataType: "html",
            catch : false,
            success: function (data) {
                $(content).html(data);
            }
        });
    }
    function show_confirm_modal(obj) {
        var modal_id = $(obj).attr('href');
        var content = $(modal_id).children('div.modal-dialog').children('div.modal-content');
        var data_url = $(obj).attr('data-href');
        $(content).find('#confirm_btn').attr('href', data_url);
    }
</script>
</body>
</html>
