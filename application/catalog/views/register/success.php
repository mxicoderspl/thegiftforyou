<?php echo $header; ?>
<div class="header-height"></div>
<style>.suss-pg i {
    color: #45a5f2;
    display: table;
    float: none;
    font-size: 60px;
    margin: 0 auto 19px;
    text-align: center;
}
.btm-tx{font-size: 15px;
    text-align: center;}
.email-link {
    float: left;
    font-size: 14px;
    margin-bottom: 15px;
    margin-top: 10px;
    text-align: center;
    width: 100%;
}
.email-link a {
    text-decoration:underline
}
.vrfy {
    display: table;
    float: none;
    font-size: 18px;
    font-weight: 600;
    margin: 0 auto 25px;
    text-align: center;
}</style>
<div class="bg-white">
    <div class="container">
        <div class="col-md-8 col-xs-12 col-md-offset-2">
            <div style="display: none;" class="alert alert-success" id="resend_success">
                <strong>Success!</strong> Activation link sent on your email id successfully.
            </div>
            <div style="display: none;" class="alert alert-error" id="resend_fail">
                <strong>Error!</strong> Error Occurred. Try Again.
            </div>
        </div>
        <div class="col-md-8 col-xs-12 col-md-offset-2">
            <div class="bg-gray-light suss-pg">
                <div class="col-xs-12">
				<p><i class="fa fa-envelope-o"></i></p>
				<b class="vrfy">Verify your email address</b>
                    <p class="btm-tx"><?php if ($this->session->flashdata('success')) { ?>
                        <?php echo $this->session->flashdata('success'); ?>
                    <?php } ?></p>
                    

                </div>
<!--                <div class="col-xs-12">
                    <p class="text-center"><?php echo $this->session->userdata('qrcode') ?></i></p>
				<b class="vrfy">Your Authenticator secrete is <?php echo $this->session->userdata('authenticator_secrete') ?></b>
                    

                </div>-->
            </div>
            <p class="email-link">Did not get activation email? <a href="#" onclick="resend_email();" class="">Click here to Re-send</a></p>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<script>
    function resend_email() {
        $('#resend_success').hide();
        $('#resend_fail').hide();
        $.ajax({
            url: "<?php echo site_url('Register/resend_email'); ?>",
            type: "POST",
            dataType: "JSON",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function (data) {
                if (data.status == 'success') {
                    $('#resend_success').show();
                } else {
                    $('#resend_fail').show();
                }
            }
        });
    }
</script>