<?php echo $header; ?>
<div class="header-height"></div>
<div class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xs-12 col-md-offset-3">
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php echo form_open(site_url('Login/verifyotp'), array('class' => 'form-horizontal', 'id' => 'otp_frm', 'method' => 'post')); ?>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <h1 class="main-title">OTP Verification</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3">Enter OTP</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP Code">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary lg-btn">Verify</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <button type="button" id="resend_otp" class="btn btn-default lg-btn">Resend OTP</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#otp_frm').validate({
            rules: {
                otp: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url('login/verifyotp') ?>",
                        type: "post",
                        data: {
                            otp: function () {
                                return $("#otp").val();
                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.verify === true) {
                                return '"true"';
                            }
                            return "\"" + json.message + "\"";
                        }
                    }
                }
            },
            messages: {
                otp: {required: "OTP code is required"}
            }
        });
        $('#resend_otp').on('click', function () {
            $.ajax({
                url: "<?php echo site_url('login/resendotp'); ?>",
                type: "post",
                dataType: "json",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (data) {
                    if (data.success) {
                        alert(data.message);
                        $('#resend_otp').attr('disabled', true);
                        setTimeout(function () {
                            $('#resend_otp').attr('disabled', false);
                        }, 10000);
                    }
                }
            });
        });
    });
</script>