<?php echo $header; ?>
<?php echo $sidebar; ?>
<style>
    .alert{
        margin-left:141px;
        margin-right: 141px;
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
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
                <div class="page-content-wrapper ">
                    <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                        <div class="panel-body" id="paymentinfo" >
                            <h4 class="m-b-30 m-t-0"><i class="fa fa-money"></i>&nbsp;&nbsp;KYC Detail</h4>

                            <div class="col-sm-2 pull-right"> 

                            </div>
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <span class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Your submitted details for KYC</span>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-9">
                                            <div class="  form-group ">
                                                <label class=" col-md-4">Adhar Card No:</label>
                                                <span class="  control-label" > <?php echo ' ' . $alldetail[0]['adhar_no']; ?></span>
                                            </div>
                                            <div class=" form-group ">
                                                <label class="col-md-4 ">PAN Card No:</label>
                                                <span class="control-label"  > <?php echo ' ' . $pan_no[0]['pan_no']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-md-4 ">Adhar Card Photo</label>
                                                <span class=" control-label" ><img id="myImg" src="<?php echo base_url().$this->config->item('upload_path_adharphoto_thumb') . $alldetail[0]['adhar_photo']; ?>" class='gallerythumbnail' style="height:80px;width:150px"> </span>     
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Passbook Photo</label>

                                                <span class=" control-label" ><img id="myImg1" src="<?php echo base_url().$this->config->item('upload_path_passbookphoto_thumb') . $alldetail[0]['passbook_photo']; ?>" class='gallerythumbnail' style="height:80px;width:150px"> </span>

                                            </div>
					 <div class="form-group ">
                                                <label class=" col-md-4 ">PAN Card Photo</label>

                                                <span class=" control-label" ><img id="myImg2" src="<?php echo base_url().$this->config->item('upload_path_pancardphoto_thumb') . $alldetail[0]['pancard_photo']; ?>" class='gallerythumbnail' style="height:80px;width:150px"> </span>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div><!--end body-->
                    </div>
                </div>
                
                <!------------------------------ if your request is in pending mode --------------------->
                
<!--                <div class="page-content-wrapper ">
                    <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                        <div class="panel-body" id="paymentinfo" >
                            <h4 class="m-b-30 m-t-0"><i class="fa fa-money"></i>&nbsp;&nbsp;KYC Detail</h4>

                            <div class="col-sm-2 pull-right"> 

                            </div>
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <span class="btn btn-primary btn-block btn-lg waves-effect waves-light lgi" type="submit">Your submitted details for KYC</span>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-9">
                                            <div class="  form-group ">
                                                <label class=" col-md-4">Adhar Card No:</label>
                                                <span class="  control-label" > <?php echo ' ' . $alldetail[0]['adhar_no']; ?></span>
                                            </div>
                                            <div class=" form-group ">
                                                <label class="col-md-4 ">PAN Card No:</label>
                                                <span class="control-label"  > <?php echo ' ' . $pan_no[0]['pan_no']; ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-md-4 ">Adhar Card Photo</label>
                                                <span class=" control-label" ><img id="myImg" src="<?php echo $this->config->item('upload_path_adharphoto_thumb') . $alldetail[0]['adhar_photo']; ?>" class='gallerythumbnail' style="height:80px;width:150px"> </span>     
                                            </div>
                                            <div class="form-group ">
                                                <label class=" col-md-4 ">Passbook Photo</label>

                                                <span class=" control-label" ><img id="myImg1" src="<?php echo $this->config->item('upload_path_passbookphoto_thumb') . $alldetail[0]['passbook_photo']; ?>" class='gallerythumbnail' style="height:80px;width:150px"> </span>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>end body
                    </div>
                </div>-->
                <!----------------------------------- pending end --------------------------->
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
    <script>
                                    // Get the modal
                                    var modal = document.getElementById('myModal');

                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var img = document.getElementById('myImg');
                                    var img1 = document.getElementById('myImg1');
                                    var img2 = document.getElementById('myImg2');

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

                                    // Get the <span> element that closes the modal
                                    var span = document.getElementsByClassName("close")[0];

                                    // When the user clicks on <span> (x), close the modal
                                    span.onclick = function () {
                                        modal.style.display = "none";
                                    }
    </script>
