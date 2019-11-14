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
                <?php echo form_open(site_url('Login/authenticate'), array('class' => 'form-horizontal', 'id' => 'change_mobile_frm', 'method' => 'post')); ?>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <h1 class="main-title">Change Mobile Number</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3">Email address</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>

               
                <div class="form-group">
                    <label for="" class="col-md-3">Mobile No</label>
                    <div class="col-md-3">
                          <select class="form-control" id="phone_code" name="phone_code">
                                <?php foreach ($country_code as $id => $country) { ?><option value="<?php echo $country['phonecode']; ?>"  ><?php  echo $country['phonecode']; ?></option><?php } ?>
                            </select>
                        </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" style="margin-left: -31px;width: 245px" id="mobile" name="mobile" placeholder="Mobile No">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <div class="g-recaptcha" data-sitekey="<?php echo $general_setting[5]['setting_value']; ?>" style="transform:scale(1.1);-webkit-transform:scale(1.1);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-md-3"></label>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary lg-btn">Change</button>
                    </div>
                </div>


                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<?php echo $footer; ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">

    window.onload = function () {
        var myInput = document.getElementById('password');
        myInput.onpaste = function (e) {
            e.preventDefault();
        }
    };

    $(document).ready(function () {
        $('#change_mobile_frm').validate({
            ignore: [],
            rules: {
                'g-recaptcha-response': {
                    required: true,
                    remote: {
                        url: "<?php echo site_url('login/captcha_chellange') ?>",
                        type: "post",
                        data: {'g-recaptcha-response': function () {
                                return $('[name="g-recaptcha-response"]').val();
                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                    }
                },
                password: {
                    required: true
                },
                email: {
                    required: true,
                    email:true
                },
                mobile: {
                    required: true,
                    number: true
                }
            },
            messages: {
                'g-recaptcha-response': {
                    required: 'Please complete captcha chellange',
                    remote: 'Invalid Captcha'
                },
                password: {
                    required: "Password is required"
                },
                email: {
                    required: 'Email id is required'
                },
                mobile: {
                    required: "Mobile is required",
                    number: "Character not allowed."
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "g-recaptcha-response") {
                    error.appendTo(element.parent("div").parent("div"));
                } else {
                    error.insertAfter(element);
                }
            }
        });

    });
</script>