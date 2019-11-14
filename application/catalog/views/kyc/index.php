<?php echo $header; ?>
<?php echo $sidebar; ?>
<style>
    .alert{
        margin-left:141px;
        margin-right: 141px;
    }
    #adharImg,#passbookImg,#pancardImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #adharImg,#passbookImg,#pancardImg:hover {opacity: 0.5;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 11; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        margin: 100px 80px 100px 300px;
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {    
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #141010;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }

</style>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">

            <!--<div class="container">-->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="catm-alert-msg">
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success" id="myerror">
                                    <!--<button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger" id="myerror">
                                   <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>-->
                                    <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('info')) { ?>
                                <div class="alert alert-info" id="myerror">
                                    <<!--button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                    <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if (empty($alldetail)) { ?>
                    <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                        <div class="panel-body" id="paymentinfo">


                            <div class="row">
                                <div class="col-xs-12">
                                    <!--<form method="post" action="<?php echo site_url('') ?>" id="detailfrm">-->
                                    <?php echo form_open('Userkyc/save', array('id' => 'detailfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="form-horizontal">

                                        <div class="">
                                            <h4>Fillup the Details for KYC</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
					   <div class="form-group ">
                                                <label class="col-md-4">PAN Card No</label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="panno" id="panno" value="<?php echo $pan_no[0]['pan_no']; ?>" readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-md-4">Adhar Card No<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="adhar_no" id="adhar_no" value="" maxlength="12"/>
                                                </div>
                                            </div>
   
                                            <div class="form-group ">
                                                <label class="col-md-4">Upload Adhar Card Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="file" class="filestyle" name="adharimage" id="adharimage"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4">Bank Passbook Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="file" class="filestyle" name="passbookimage" id="passbookimage"/>
                                                </div>
                                            </div>
                                            
					     <div class="form-group">
                                                <label class="col-md-4">Upload PAN Card Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="file" class="filestyle" name="pancardimage" id="pancardimage"/>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group m-r-13">

                                        <center><button type="submit" name="submit" class="btn btn-info">Submit</button></center>
                                    </div>
                                    <?php echo form_close(); ?> 
                                    <!--</form>-->
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
                <!--------------------------------------  if status is pending ---------------->
                <?php if(!empty($alldetail[0]['status'])){ if ($alldetail[0]['status'] == "Pending" || $alldetail[0]['status'] == "Declined") { ?>
                    <div class="col-md-1"></div>
                    <div class="panel col-md-10 col-xs-12">
                        <div class="panel-body" id="paymentinfo">
                            <?php if ($alldetail[0]['status'] == "Declined") { ?>
                                <div class="alert alert-info">
                                    <center><p class="error">Hello User ! Your given details declined by the Admin.Please Resend the Details</p></center>
                                </div>
                            <?php }else{ ?>
				<div class="alert alert-info">
                                    <center><p class="">Hello User ! Your Request for KYC is Pending..!</p></center>
                                </div>
			    <?php }?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--<form method="post" action="<?php echo site_url('') ?>" id="detailfrm">-->
                                    <?php echo form_open('Userkyc/update', array('id' => 'editdetailfrm', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="form-horizontal">

                                        <div class="">
                                            <h4>Update the Details for KYC</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
					       <div class="form-group ">
                                                <label class="col-md-4">PAN Card No</label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="epanno" id="epanno" value="<?php echo $pan_no[0]['pan_no']; ?>" readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-md-4">Adhar Card No<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="eadhar_no" id="eadhar_no" value="<?php echo $alldetail[0]['adhar_no']; ?>" maxlength="12"/>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="col-md-4">Upload Adhar Card Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="file" class="filestyle" name="adharimage" id="adharimage">
                                                </div>
                                                <div class="col-md-4">
                                                    <img id="adharImg" src="<?php echo base_url().$this->config->item('upload_path_adharphoto_thumb') . $alldetail[0]['adhar_photo']; ?>" class='gallerythumbnail' style="height:65px;width:160px">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4">Bank Passbook Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="file" class="filestyle" name="passbookimage" id="passbookimage">
                                                </div>
                                                <div class="col-md-4">
                                                    <img id="passbookImg" src="<?php echo base_url().$this->config->item('upload_path_passbookphoto_thumb') . $alldetail[0]['passbook_photo']; ?>" class='gallerythumbnail' style="height:65px;width:160px">
                                                </div>
                                            </div>
                                     
					      <div class="form-group">
                                                <label class="col-md-4">Upload PAN Card Photo<span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="file" class="filestyle" name="pancardimage" id="pancardimage">
                                                </div>
                                                <div class="col-md-4">
                                                    <img id="pancardImg" src="<?php echo base_url().$this->config->item('upload_path_pancardphoto_thumb') . $alldetail[0]['pancard_photo']; ?>" class='gallerythumbnail' style="height:65px;width:160px">
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group m-r-13">

                                        <center><button type="submit" name="update" class="btn btn-info">Update</button></center>
                                    </div>
                                    <?php echo form_close(); ?> 
                                    <!--</form>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-1"></div>
                <?php } }?>
                <!----------------------------- end pending --------------------->

                <!--------------------------------------  if status is Decline ---------------->

                <!--</div>-->
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <?php echo $footer; ?>
    <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    <!--jquer, javascript and ajax-->
    <script type="text/javascript">
  $('#myerror').slideDown(function () {
            setTimeout(function () {
                $('#myerror').slideUp();
            }, 3000);
        });

                                    jQuery("#detailfrm").validate({

                                        rules: {

                                            adhar_no: "required",
                                            adharimage: "required",
                                            passbookimage: "required",

                                        },
                                        messages: {
                                            adhar_no: "please enter your adhar card number",
                                            adharimage: "please upload photo of adhar card",
                                            passbookimage: "please upload photo of passbook",

                                        },

                                    });
                              jQuery("#editdetailfrm").validate({

                                        rules: {

                                            eadhar_no: "required",
                                            
                                        },
                                        messages: {
                                            eadhar_no: "please enter your adhar card number",
                                        },

                                    });

                                    

$("#adhar_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

    </script>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('adharImg');
        var img1 = document.getElementById('passbookImg');
	var img2 = document.getElementById('pancardImg');
        //var eimg1 = document.getElementById('emyImg1');

        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img1.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img2.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        //eimg1.onclick = function () {
          //  modal.style.display = "block";
          //  modalImg.src = this.src;
        //    captionText.innerHTML = this.alt;
       // }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>

