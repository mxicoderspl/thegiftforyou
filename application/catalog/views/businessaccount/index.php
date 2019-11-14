<?php echo $header; ?>
<?php echo $sidebar; ?>
<!-- Dashboard_menu Session-->

<style>
    #map1 {
        height: 300px !important;

    }
</style> 
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */

    /* Optional: Makes the sample page fill the window. */

</style>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<style>
    #locationField, #controls {
        position: relative;
        width: 480px;
    }
    #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
        z-index: 9999;
    }
    .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
    }
    #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
    }
    #address td {
        font-size: 10pt;
    }
    .field {
        width: 99%;
    }
    .slimField {
        width: 80px;
    }
    .wideField {
        width: 200px;
    }
    #locationField {
        height: 20px;
        margin-bottom: 2px;
    }


    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */

    /* Optional: Makes the sample page fill the window. */

    #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }

</style>

<div class="db-content col-md-9 col-xs-12">
    <div class="mngac-detail">
<!--        <h2>Manage Account</h2>
        <div class="classes-tablist col-xs-12">
            <ul class="custommanageaccounttab nav nav-tabs db-tab" role="tablist">
                <li class="active"><a href="#ContactDetail" aria-controls="ContactDetail" role="tab" data-toggle="tab">Contact Details</a></li>
                <li><a href="#ProfilePhot" aria-controls="ProfilePhot" role="tab" data-toggle="tab">Profile Photo</a></li>
                <li><a href="#ManageSchedule" aria-controls="ManageSchedule" role="tab" data-toggle="tab">Manage Schedule</a></li>
                <li><a href="#About" aria-controls="About" role="tab" data-toggle="tab">About</a></li>
                <li><a href="#ServiceArea" aria-controls="ServiceArea" role="tab" data-toggle="tab">Service Area</a></li>
            </ul>
        </div>-->
    </div>
    <div class="tab-content">
        <!------------ Contact Detail Session-------------->
        <div role="tabpanel" class="tab-pane active" id="ContactDetail">
            <?php echo form_open(site_url('#'), array('class' => '', 'id' => 'profilefrm', 'name' => 'profilefrm')); ?>
            <div class="col-md-12 col-xs-12">
                <h2 class="col-xs-12 padng_rmv">Enter Contact Information Below</h2>

                <div class="col-md-offset-3 col-md-8 col-xs-12  padngrmv-input">
                    <div class="mngac-note">
                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i><p>&nbsp;To active your listing, Please fill in all of the required fields below. </p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-12" style="margin-bottom: 15px">

                    </div> 
                    <form class=>
                        <div class="form-group col-xs-12 padng_rmv">
                            <label for="businessname" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Business Name</label>
                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                <input type="text" class="form-control" id="businessname" name="businessname" placeholder="Business Name" value="<?php // echo $login_business_info['businessname']; ?>"/>
                            </div>   
                        </div>
                        <div class="form-group col-xs-12 padng_rmv">
                            <label for="business_type" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Business Type</label>
                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                <select id="business_type" name="business_type" class="form-control">
                                    <option value="">Select business type</option>
                                    <?php // foreach ($business_type as $type): ?>
                                        <option <?php // echo ($login_business_info['business_type'] == $type['id']) ? 'selected' : ''; ?> value="<?php // echo $type['id']; ?>"><?php // echo $type['type_name']; ?></option>
                                    <?php // endforeach; ?>
                                </select>  
                            </div>   
                        </div>
                        <div class="form-group col-xs-12 padng_rmv">
                            <label for="ownername" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Owner Name</label>
                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                <input type="text" class="form-control" id="ownername" name="ownername" placeholder="Business Owner Name" value="<?php // echo $login_business_info['ownername']; ?>">
                            </div>   
                        </div>
                        <div class="form-group col-xs-12 padng_rmv">
                            <label for="Email" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Email<span id="verifiedemail">
                                    <?php
//                                    if ($login_business_info['email_verified'] == 0) {
                                        echo '<i style="color:red" title="Not verified" aria-hidden="true" class="fa fa-times-circle"></i>';
//                                    } else {
//                                        echo '<i style="color:green" title="Verified" aria-hidden="true" class="fa fa-check-circle"></i>';
//                                    }
                                    ?>


                                </span></label>
                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php // echo $login_business_info['email']; ?>">
                            </div>   
                        </div>
                        <div class="form-group col-xs-12 padng_rmv">
                            <label for="phone" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Phone Number</label>
                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php // echo $login_business_info['phone']; ?>"/>
                            </div>   
                        </div>


                    </form>
                </div>

                <input type="hidden" class="field" id="street_number"
                       disabled="true"></input>
                <input type="hidden" class="field" id="route"
                       disabled="true"></input>
                <input type="hidden" class="field" id="locality"
                       disabled="true"></input>
                <input type="hidden" class="field"
                       id="administrative_area_level_1" disabled="true"></input>

                <input type="hidden" class="field" id="postal_code"
                       disabled="true"></input>
                <input type="hidden" class="field"
                       id="country" disabled="true"></input>

                <h2 class="col-xs-12 padng_rmv">Where are you located?</h2>

                <div class="col-md-offset-3 col-md-8 col-xs-12">
                    <div class="db-map1">
                        <div class="col-md-12 col-xs-12 padngrmv-input">
                            <input type="text" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" class="form-control ">
                        </div>  





                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <div id="map1" ></div>
                        <p></p><div class="clearfix"></div>

                        <label for="geolocation" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Geo Location</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="geolocation" name="geolocation" placeholder="Enter Lat-long" value="<?php // echo $login_business_info['geolocation']; ?>">
                            <span id="locationtext"></span>
                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="addressline1" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Address Line 1</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="addressline1" name="addressline1" placeholder="Address Line 1" value="<?php // echo $login_business_info['addressline1']; ?>">
                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="addressline2" class="col-md-3 col-xs-12 lb1 padngrmv-input">Address Line 2</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="addressline2" name="addressline2" placeholder="Address Line 2" value="<?php // echo $login_business_info['addressline2']; ?>">Optional
                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="city" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>City</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="city" name="city" placeholder="City" value="<?php // echo $login_business_info['city']; ?>">
                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="state" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>State</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="state" name="state" placeholder="State" value="<?php // echo $login_business_info['state']; ?>">
                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="country" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Country</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <select class="form-control" id="country1" name="country">
                                <option value="">Select country</option>
<?php // foreach ($countries as $country): ?>
                                    <option <?php // echo ($login_business_info['country'] == $country['id']) ? 'selected' : ''; ?> value="<?php // echo $country['id']; ?>"><?php // echo $country['name']; ?></option>
                                <?php // endforeach; ?>
                            </select>

                        </div>   
                    </div>
                    <div class="form-group col-xs-12 padng_rmv">
                        <label for="zipcode" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Zip Code</label>
                        <div class="col-md-9 col-xs-12 padngrmv-input">
                            <input type="text" class="form-control " id="zipcode" name="zipcode" placeholder="Zip Code" value="<?php // echo $login_business_info['zipcode']; ?>">
                        </div>   
                    </div>

                    <button class="db-button"   id="update_contact_info">Submit</button> 

                </div>

            </div>   
<?php echo form_close(); ?> 
        </div>

        <!------------ Contact Detail Session-------------->




        <!--------- Profile Photo session ------------>

<!--        <div role="tabpanel" class="tab-pane" id="ProfilePhot">
            <div class="col-md-12 col-xs-12">
                <h2 class="col-xs-12 padng_rmv">Upload Profile Photo</h2>
                <div class="col-md-offset-3 col-md-8 col-xs-12">
<?php echo form_open_multipart('#', array('id' => 'profilephoto')); ?>
                    <div class="profile-cntent col-md-12">

                        <h4>Profile Photo</h4>
                        <img id="main" src="
<?php
if ($login_business_info['image'] != '') {
    echo base_url() . $this->config->item('business_thumb_upload_path') . $login_business_info['image'];
} else {
    echo base_url() . $this->config->item('business_noimage');
}
?>
                             " class="img-thumbnail img-responsive profile-phot"/>
                        <div class="chs"><span>Upload Photo</span><input onchange="previewFile()" id="image" name="image" type="file" class="upload hide_file" value="Upload Photo"/></div>

                    </div>
                        <?php echo form_close(); ?>


                </div>  
            </div>
        </div>-->

        <!--------- Profile Photo session ------------>



        <!--------- Listing Detail Session ------------>

        <div role="tabpanel" class="tab-pane" id="ManageSchedule">
            <div class="col-md-12 col-xs-12">

                <div class="col-xs-12 col-md-12">
                    <div class="pull-right">
                        <button onclick="addschedulemodal()" class="btn btn-default">Add</button>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12">

                    <table id="scheduletable" class="table table-responsive table-striped responsive nowrap">
                        <thead class="">
                            <tr class="bg-info">
                                <th>ID</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Max Appointment</th>
                                <th>Appointment minutes</th>
                                <th>Weekends</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table> 


                </div>







            </div>
        </div>
        <!--------- Listing Detail Session ------------>



        <!--------- About Session ------------>


        <div role="tabpanel" class="tab-pane" id="About">
            <div class="col-md-12 col-xs-12">
                <h2 class="col-xs-12 padng_rmv">Write About You And Your Company</h2>
                <div class=" col-md-12 col-xs-12">

                    <div class="form-group col-xs-12 padng_rmv">

                        <div class="col-md-12 col-xs-12 padngrmv-input">
                            <textarea class="form-control" id="description" name="description"><?php echo $login_business_info['description']; ?> </textarea>  

<?php echo display_ckeditor($ckeditor); ?>
                        </div>   
                    </div>
                    <button id="savedescription" class="db-button">Save</button>


                </div>
            </div>
        </div>

        <!--------- About Session ------------>


        <!--------- Service Area Session ------------>

        <div role="tabpanel" class="tab-pane" id="ServiceArea">
            <div class="col-md-12 col-xs-12">
                <h2 class="col-xs-12 padng_rmv">Get Your Services </h2>
                <div class=" col-md-12 col-xs-12">

                    <div class="form-group col-xs-12 padng_rmv">


<?php //echo form_open('#', array('id' => 'Editfrm', 'class' => 'form-horizontal', 'method' => 'POST'));  ?>









                        <span class="addtherapycustomcalss">
                            <div class="col-md-3 col-xs-12 padngrmv-servicedrop">
                                <label>Choose therapies</label>   
                            </div> 
                            <div class="col-md-3 col-xs-12 padngrmv-servicedrop">
                                <select id="therapy" name="therapy[]" data-placeholder="Select therapy" class="form-control service-drop category-dropdown minimal">

                                </select>    
                                <span class="therpyerror error"></span>
                            </div> 

                            <div class="col-md-3 col-xs-12 padngrmv-input " style="display: none">
                                <input type="text" class="form-control  service-input" id="exampleInputName2" placeholder="$ price">
                            </div>   


                            <div class="col-md-3 col-xs-12">
                                <button class="db-button3" onclick="addtherapy()">Add Therapy</button>
                            </div>
                        </span>
                        <div class="col-md-12 col-xs-12">
                            <br>
                            <span id="therapymanage"></span> 

                        </div>


<?php //echo form_close();  ?>
                    </div>





                </div>
            </div>
        </div>
        <!--------- Service Area Session ------------>
    </div>
    <!-----------------Ads Session--------------------->
    <div class="ads-session">
<?php echo $leaderboard_ad; ?>
    </div>

    <!-----------------Ads Session--------------------->
</div>
<!-- Modal -->
<div id="addschedulemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new schedule</h4>
            </div>
<?php echo form_open('#', array('id' => 'frmAdd', 'class' => '', 'method' => 'POST')); ?>
            <div class="modal-body">
                <div class="col-md-6 form-group">
                    <div class="input-group">

                        <input type="text" id="start_date" name="start_date" placeholder="Start Date" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                    </div>
                    <label for="start_date" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="end_date" name="end_date" placeholder="End Date" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                    <label for="end_date" class="error"></label>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="start_time" name="start_time" placeholder="Start Time" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <label for="start_time" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="end_time" name="end_time" placeholder="End Time" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <label for="end_time" class="error"></label>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="max_appointment" name="max_appointment" placeholder="Maximum Appointment" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hash"></i></span>
                    </div>
                    <label for="max_appointment" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="appointment_minutes" name="appointment_minutes" placeholder="Appointment Minutes" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hash"></i></span>
                    </div>
                    <label for="appointment_minutes" class="error"></label>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 form-group">
                    <div class="input-group col-md-12">
                        <select class="form-control js-example-basic-multiple" multiple='multiple' name="week_end[]" id="week_end" placeholder="Select Your WeekEnds">
                            <option value="" disabled="selected">Choose Weekend </option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                        </select>

                    </div>
                </div>

            </div>

<?php echo form_close(); ?>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button id="addnewschedule" type="button" class="btn btn-default"  >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div> 





<div id="editschedulemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new schedule</h4>
            </div>
<?php echo form_open('#', array('id' => 'frmedit', 'class' => '', 'method' => 'POST')); ?>
            <div class="modal-body">
                <div class="col-md-6 form-group">
                    <div class="input-group">

                        <input type="text" id="edit_start_date" name="edit_start_date" placeholder="Start Date" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                    </div>
                    <label for="edit_start_date" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="edit_end_date" name="edit_end_date" placeholder="End Date" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                    <label for="edit_end_date" class="error"></label>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="edit_start_time" name="edit_start_time" placeholder="Start Time" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <label for="edit_start_time" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="edit_end_time" name="edit_end_time" placeholder="End Time" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <label for="edit_end_time" class="error"></label>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="edit_max_appointment" name="edit_max_appointment" placeholder="Maximum Appointment" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hash"></i></span>
                    </div>
                    <label for="edit_max_appointment" class="error"></label>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <input type="text" id="edit_appointment_minutes" name="edit_appointment_minutes" placeholder="Appointment Minutes" class="form-control hasDatepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hash"></i></span>
                    </div>
                    <label for="edit_appointment_minutes" class="error"></label>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 form-group">
                    <div class="input-group col-md-12">
                        <select class="form-control js-example-basic-multiple" multiple='multiple' name="edit_week_end[]" id="edit_week_end" placeholder="Select Your WeekEnds">
                            <option value="" disabled="selected">Choose Weekend </option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                        </select>

                    </div>
                </div>

            </div>

<?php echo form_close(); ?>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button id="editschedulebutton" type="button" class="btn btn-default"  >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>   
<div id="deleteschedulemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>

            <div class="modal-body">

                Are you sure you want to delete this schedule?

                <div class="clearfix"></div>


            </div>


            <div class="clearfix"></div>
            <div class="modal-footer">
                <button id="deleteschedulebutton" type="button" class="btn btn-danger"  >Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>   
<input type="hidden" id="scheduleid" name="scheduleid" value=""/>   
<?php echo $dashboard_footer; ?>
<script type="text/javascript">
    $.fn.dataTableExt.oApi.fnStandingRedraw = function (oSettings) {
        //redraw to account for filtering and sorting
        // concept here is that (for client side) there is a row got inserted at the end (for an add)
        // or when a record was modified it could be in the middle of the table
        // that is probably not supposed to be there - due to filtering / sorting
        // so we need to re process filtering and sorting
        // BUT - if it is server side - then this should be handled by the server - so skip this step
        if (oSettings.oFeatures.bServerSide === false) {
            var before = oSettings._iDisplayStart;
            oSettings.oApi._fnReDraw(oSettings);
            //iDisplayStart has been reset to zero - so lets change it back
            oSettings._iDisplayStart = before;
            oSettings.oApi._fnCalculateEnd(oSettings);
        }

        //draw the 'current' page
        oSettings.oApi._fnDraw(oSettings);
    };


    $(".js-example-basic-multiple").select2();
</script>
<script type="text/javascript">

    function addschedulemodal() {
        $('#addschedulemodal').modal();
    }
    function editschedule(id) {
        $('#scheduleid').val(id);
        $.ajax({
            url: "<?php echo site_url('ManageAccount/filleditschedule') ?>",
            type: "POST",
            dataType: "json",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'scheduleid': $('#scheduleid').val()
            },

            success: function (data) {

                if (data.status == 'true') {

                    $('#edit_start_date').val(data.data.start_date);
                    $('#edit_end_date').val(data.data.end_date);
                    $('#edit_start_time').val(data.data.start_time);
                    $('#edit_end_time').val(data.data.end_time);
                    $('#edit_max_appointment').val(data.data.max_appointment);
                    $('#edit_appointment_minutes').val(data.data.appointment_minutes);

                    var arra = data.data.week_ends.split(',');

                    jQuery("#edit_week_end").select2('val', arra);
                } else {
                    flash_alert_msg(data.msg, 'error', 1000);

                }


            }

        });
        $('#editschedulemodal').modal();
    }
    function deleteschedule(id) {
        $('#scheduleid').val(id);
        $('#deleteschedulemodal').modal();
    }


    $('#editschedulebutton').click(function (e) {
        if ($("#frmedit").valid())
        {

            var formData = new FormData($("#frmedit")[0]);
            formData.append('scheduleid', $('#scheduleid').val());
            $.ajax({
                url: "<?php echo site_url('ManageAccount/editschedule') ?>",
                type: "POST",
                dataType: "json",
                data: formData,
                catch : false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == 'true') {

                        flash_alert_msg(data.msg, 'success', 15000);

                    } else {
                        flash_alert_msg(data.msg, 'error', 15000);

                    }
                    $('#editschedulemodal').modal('hide');
                    var oTable1 = $('#scheduletable').dataTable();
                    oTable1.fnStandingRedraw();


                }

            });

        }

    });

    $('#deleteschedulebutton').click(function (e) {
        $.ajax({
            url: "<?php echo site_url('ManageAccount/deleteschedule') ?>",
            type: "POST",
            dataType: "json",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'scheduleid': $('#scheduleid').val()
            },

            success: function (data) {
                $('#deleteschedulemodal').modal('hide');
                if (data.status == 'true') {

                    flash_alert_msg(data.msg, 'success', 1000);
                } else {
                    flash_alert_msg(data.msg, 'error', 1000);

                }

                var oTable1 = $('#scheduletable').dataTable();
                oTable1.fnStandingRedraw();

            }

        });
    });




    $('#savedescription').click(function (e) {




        $.ajax({
            url: "<?php echo site_url('ManageAccount/updatedescription') ?>",
            type: "POST",
            dataType: "json",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'description': CKEDITOR.instances.description.getData()
            },

            success: function (data) {
                if (data.status == 'true') {

                    flash_alert_msg(data.msg, 'success', 15000);
                } else {
                    flash_alert_msg(data.msg, 'error', 15000);

                }


            }

        });

    });
    $('#update_contact_info').click(function (e) {

        //e.preventDefault();
        $("#profilefrm").valid();


    });

    $('#addnewschedule').click(function (e) {

        //e.preventDefault();
        if ($("#frmAdd").valid())
        {

            var formData = new FormData($("#frmAdd")[0]);

            $.ajax({
                url: "<?php echo site_url('ManageAccount/addnewschedule') ?>",
                type: "POST",
                dataType: "json",
                data: formData,
                catch : false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == 'true') {

                        flash_alert_msg(data.msg, 'success', 15000);
                        $('#frmAdd').trigger("reset");
                    } else {
                        flash_alert_msg(data.msg, 'error', 15000);

                    }
                    $('#addschedulemodal').modal('hide');
                    var oTable1 = $('#scheduletable').dataTable();
                    oTable1.fnStandingRedraw();


                }

            });

        }

    });


    $(document).ready(function () {
        $('#start_date').datepicker({format: 'yyyy-mm-dd', });
        $('#end_date').datepicker({format: 'yyyy-mm-dd', });
        $('#start_time').timepicker(
                {
                    showMeridian: false,
                });
        $('#end_time').timepicker(
                {
                    showMeridian: false,
                });


        $('#edit_start_date').datepicker({format: 'yyyy-mm-dd', });
        $('#edit_end_date').datepicker({format: 'yyyy-mm-dd', });
        $('#edit_start_time').timepicker(
                {
                    showMeridian: false,
                });
        $('#edit_end_time').timepicker(
                {
                    showMeridian: false,
                });
        jQuery("#frmAdd").validate({

            rules: {

                'start_date':
                        {
                            required: true,
                        },
                'end_date':
                        {
                            required: true,
                        },
                'start_time':
                        {
                            required: true,
                        },
                'end_time':
                        {
                            required: true,
                        },
                'max_appointment':
                        {
                            required: true,
                        },
                'appointment_minutes':
                        {
                            required: true,
                        },

            },
            messages: {

                'start_date': {
                    required: "Start date is required",
                },
                'end_date': {
                    required: "End date is required",
                },

                'start_time': {
                    required: "Start time is required",
                },
                'end_time': {
                    required: "End time is required",
                },
                'max_appointment': {
                    required: "Maximum appointment is required",
                },
                'appointment_minutes': {
                    required: "Appointment minutes is required",
                },

            },

        });

        jQuery("#frmedit").validate({

            rules: {

                'edit_start_date':
                        {
                            required: true,
                        },
                'edit_end_date':
                        {
                            required: true,
                        },
                'edit_start_time':
                        {
                            required: true,
                        },
                'edit_end_time':
                        {
                            required: true,
                        },
                'edit_max_appointment':
                        {
                            required: true,
                        },
                'edit_appointment_minutes':
                        {
                            required: true,
                        },

            },
            messages: {

                'edit_start_date': {
                    required: "Start date is required",
                },
                'edit_end_date': {
                    required: "End date is required",
                },

                'edit_start_time': {
                    required: "Start time is required",
                },
                'edit_end_time': {
                    required: "End time is required",
                },
                'edit_max_appointment': {
                    required: "Maximum appointment is required",
                },
                'edit_appointment_minutes': {
                    required: "Appointment minutes is required",
                },

            },

        });







        $('#profilefrm').validate({
            rules: {
                businessname: {
                    required: true,
                    remote: {
                        url: "<?php echo site_url('ManageAccount/businessnameexist') ?>",
                        type: "post",
                        data: {

                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
                    },
                },
                business_type: {
                    required: true,
                },
                ownername: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo site_url('ManageAccount/emailExits') ?>",
                        type: "post",
                        data: {

                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
                    }
                },
                phone: {
                    required: true,
                },
                geolocation: {
                    required: true,
                },
                addressline1: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                country: {
                    required: true,
                },
                zipcode: {
                    required: true,
                },

            },
            messages: {
                businessname: {
                    required: "Please enter business name",
                    remote: "Business name already exist"
                },
                business_type: {
                    required: "Please select business type",
                },
                ownername: {
                    required: "Please enter business owner name",
                },
                email: {
                    required: "Email is required",
                    email: "Please enter valid email",
                    remote: "Email already exist"
                },
                phone: {
                    required: "Please enter phone number",
                },
                geolocation: {
                    required: "Please enter geo location",
                },
                addressline1: {
                    required: "Please enter address line1",
                },
                city: {
                    required: "Please enter city",
                },
                state: {
                    required: "Please enter state",
                },
                country: {
                    required: "Please select country",
                },
                zipcode: {
                    required: "Please enter zipcode",
                },

            },
            submitHandler: function (form) {

                var formData = new FormData(form);

                $.ajax({
                    url: "<?php echo site_url('ManageAccount/update_contact_info') ?>",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    catch : false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'true') {

                            flash_alert_msg(data.msg, 'success', 15000);
                        } else {
                            flash_alert_msg(data.msg, 'error', 15000);

                        }
                        if (data.email_verified == 1) {
                            $('#verifiedemail').html('<i style="color:green" title="Verified" aria-hidden="true" class="fa fa-check-circle"></i>');
                        } else {
                            $('#verifiedemail').html('<i style="color:red" title="Not verified" aria-hidden="true" class="fa fa-times-circle"></i>');
                        }


                    }

                });



            }

        });
    });


</script>

<script>
    var globalmarker;

    $(document).ready(function () {
        setTimeout(
                function ()
                {
                    //do something special

                    var arr = new Array();
                    arr[0] =<?php echo $this->config->item('default-latitude'); ?>;
                    arr[1] =<?php echo $this->config->item('default-longitude'); ?>;
                    if (document.getElementById('geolocation').value != '') {
                        arr = document.getElementById('geolocation').value.split(',');
                    }

                    var mylatlong = {lat: parseFloat(arr[0]), lng: parseFloat(arr[1])};
                    var map = new google.maps.Map(document.getElementById('map1'), {
                        zoom: 15,
                        center: mylatlong

                    });
                    globalmarker = new google.maps.Marker({
                        position: mylatlong,
                        map: map,
                        draggable: true,

                    });
                    google.maps.event.addListener(globalmarker, 'dragend', function (evt) {
                        document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
                        document.getElementById('geolocation').value = evt.latLng.lat() + ',' + evt.latLng.lng();
                    });

                    google.maps.event.addListener(globalmarker, 'dragstart', function (evt) {
                        document.getElementById('locationtext').innerHTML = '<p>Currently dragging marker...</p>';
                    });
                }, 1000);
    });


    // function getlatlongfrommarker(){


    // }
    function initMap() {
        var arr = new Array();
        arr[0] =<?php echo $this->config->item('default-latitude'); ?>;
        arr[1] =<?php echo $this->config->item('default-longitude'); ?>;
        if (document.getElementById('geolocation').value != '') {
            arr = document.getElementById('geolocation').value.split(',');
        }

        var mylatlong = {lat: parseFloat(arr[0]), lng: parseFloat(arr[1])};
        var map = new google.maps.Map(document.getElementById('map1'), {
            zoom: 15,
            center: mylatlong

        });
        globalmarker = new google.maps.Marker({
            position: mylatlong,
            map: map,
            draggable: true,

        });
        google.maps.event.addListener(globalmarker, 'dragend', function (evt) {
            document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            document.getElementById('geolocation').value = evt.latLng.lat() + ',' + evt.latLng.lng();
        });

        google.maps.event.addListener(globalmarker, 'dragstart', function (evt) {
            document.getElementById('locationtext').innerHTML = '<p>Currently dragging marker...</p>';
        });

    }
</script>

<script>


    function initMap1(latlong) {


        var map = new google.maps.Map(document.getElementById('map1'), {
            zoom: 15,
            center: latlong

        });
        globalmarker = new google.maps.Marker({
            position: latlong,
            map: map,
            draggable: true,

        });
        google.maps.event.addListener(globalmarker, 'dragend', function (evt) {
            document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            document.getElementById('geolocation').value = evt.latLng.lat() + ',' + evt.latLng.lng();
        });

        google.maps.event.addListener(globalmarker, 'dragstart', function (evt) {
            document.getElementById('locationtext').innerHTML = '<p>Currently dragging marker...</p>';
        });

    }
    function geocodeAddress(geocoder, resultsMap) {
        var address = "925 Princes Highway, Heathmere, Victoria, Australia";// document.getElementById('autocomplete').value;
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                globalmarker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }


    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'short_name',
        postal_code: 'short_name'
    };
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
    function initAutocomplete() {
        initMap();
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.




        //document.getElementById('addressline1').value=street_number+street;





        for (var i = 0; i < place.address_components.length; i++) {

            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                // alert(JSON.stringify(place.address_components));
                //alert(JSON.stringify(componentForm[addressType]));
                var val = place.address_components[i][componentForm[addressType]];

                document.getElementById(addressType).value = val;
            }
        }

        if (document.getElementById('street_number').value != '') {
            document.getElementById('addressline1').value = document.getElementById('street_number').value + ' ' + document.getElementById('route').value;
        } else {
            document.getElementById('addressline1').value = document.getElementById('route').value;
        }
        // var latlong=JSON.stringify(place.geometry['location']);
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        document.getElementById('geolocation').value = latitude + ',' + longitude;// latlong.replace(/"/g, "").replace(/'/g, "").replace(/\(|\)/g, "");



        document.getElementById('city').value = document.getElementById('locality').value;
        document.getElementById('state').value = document.getElementById('administrative_area_level_1').value;
        document.getElementById('zipcode').value = document.getElementById('postal_code').value;

        $.ajax({
            url: "<?php echo site_url('Home/getCountry') ?>",
            type: "POST",
            dataType: "html",
            data: {'code': $('#country').val(), '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},

            success: function (data) {


                $('#country1')
                        .find('option')
                        .remove()
                        .end()
                        .append(data);
                ;
                /*set location in map*/
                initMap1(place.geometry['location']);

            }

        });




    }


</script>



<script>

    function previewFile() {
        var preview = document.querySelector('#main');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        // when user select an image, `reader.readAsDataURL(file)` will be triggered
        // reader instance will hold the result (base64) data
        // next, event listener will be triggered and we call `reader.result` to get
        // the base64 data and replace it with the image tag src attribute
        reader.addEventListener("load", function () {
            console.log('before preview');
            preview.src = reader.result;
            console.log('after preview');
        }, false);

        if (file) {
            console.log('inside if');
            reader.readAsDataURL(file);
        } else {
            console.log('inside else');
        }




        var formData = new FormData($('#profilephoto')[0]);

        $.ajax({
            url: "<?php echo site_url('ManageAccount/uploadprofilephoto') ?>",
            type: "POST",
            dataType: "json",
            data: formData,
            catch : false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'true') {

                    flash_alert_msg(data.msg, 'success', 15000);
                } else {
                    flash_alert_msg(data.msg, 'error', 15000);

                }


            }
        });




    }




    function addtherapy() {

        if ($('#therapy').val() == '' || $('#therapy').val() == undefined) {
            $('.therpyerror').html("Please select therapy");
            setTimeout(function () {
                $(".therpyerror").html('')
            }, 1000);
        } else {
            $.ajax({
                url: "<?php echo base_url() . 'ManageAccount/addTherapy' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'id': $('#therapy').val()},
                catch : false,
                success: function (data) {


                    gettherapies();
                    getBusinessTherapy();


                }
            });
        }

    }
    function gettherapies() {
        $.ajax({
            url: "<?php echo base_url() . 'ManageAccount/getTherapy' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', },
            catch : false,
            success: function (data) {


                $('#therapy')
                        .find('option')
                        .remove()
                        .end()
                        .append(data);
                if ($('#therapy').has('option').length > 0) {
                    $('.addtherapycustomcalss').css('display', 'block');
                } else {
                    $('.addtherapycustomcalss').css('display', 'none');
                }

            }
        });
    }

    function getBusinessTherapy() {
        $.ajax({
            url: "<?php echo base_url() . 'ManageAccount/getBusinessTherapy' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            catch : false,
            success: function (data) {


                $('#therapymanage').html(data);



            }
        });
    }
    function savetherapy(id) {
        $.ajax({
            url: "<?php echo base_url() . 'ManageAccount/savetherapy' ?>",
            type: "POST",
            dataType: "json",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'id': id,

                'price': $('#pricetherapytb-' + id).val(),
                'slot': $('#slottherapytb-' + id).val(),
            },
            catch : false,
            success: function (data) {
                if (data.status == 'success') {
                    flash_alert_msg(data.msg, 'success', 1000);

                    gettherapies();
                    getBusinessTherapy();
                } else {
                    flash_alert_msg(data.msg, 'danger', 1000);

                    gettherapies();
                    getBusinessTherapy();
                }

            }
        });
    }
    function deletetherapy(id) {
        $.ajax({
            url: "<?php echo base_url() . 'ManageAccount/deletetherapy' ?>",
            type: "POST",
            dataType: "json",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'id': id,

            },
            catch : false,
            success: function (data) {
                if (data.status == 'success') {
                    flash_alert_msg(data.msg, 'success', 1000);

                    gettherapies();
                    getBusinessTherapy();
                } else {

                    flash_alert_msg(data.msg, 'danger', 1000);
                }

            }
        });
    }



    jQuery(document).ready(function () {

        gettherapies();
        getBusinessTherapy();



        $('#scheduletable').DataTable({
            "oLanguage": {
                "sProcessing": '<img alt src="<?php echo site_url('assets/images/loaders/bx_loader.gif'); ?>" style="opacity: 1.0;filter: alpha(opacity=100);">'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            //"aLengthMenu":[[5,10,25,50,200,,500,-1],[5,10,25,50,200,500,"All"]],
            //"iDisplayLength":'5',
            "order": [[0, "DESC"]],
            "ajax": {
                url: "<?php echo base_url('ManageAccount/getSchedule'); ?>",
                data: function (d) {
                    // d.parent_id = parent_id
                }
            },

            "columns": [
                {"taregts": 0, "data": "id"},
                {"taregts": 1, "data": "start_date"},
                {"taregts": 2, "data": "end_date"},
                {"taregts": 3, "data": "start_time"},
                {"taregts": 4, "data": "end_time"},
                {"taregts": 5, "data": "max_appointment"},
                {"taregts": 6, "data": "appointment_minutes"},
                {"taregts": 7,
                    "sClass": "test-center",
                    "render": function (data, type, row) {
                        var arra = row.week_ends.split(',');
                        var wdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        var str = '';

                        for (i = 0; i < arra.length; i++) {
                            if (arra[i] != '') {
                                str += wdays[(parseInt(arra[i]) - 1)] + '<br>';
                            }
                        }
                        return str;
                    }
                },
                {"taregts": 8, "searchable": false,
                    "orderable": false,
                    "sClass": "text-center",
                    "render": function (data, type, row) {
                        var id = row.id;

                        return ' <a class="actioncol cursor view" onclick="editschedule(\'' + id + '\')" href="#" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>\n\
                                <a class="actioncol cursor view" href="#" onclick="deleteschedule(\'' + id + '\')"  title="Delete"><i class="glyphicon glyphicon-trash"></i></a>\n\
                                ';
                    }
                },
                        //{"taregts": 4, "visible": false, "data": "id"}
            ]
        });

    });
</script>    

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google-map-api-key'); ?>&libraries=places&callback=initAutocomplete"
async defer></script>
<!--<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google-map-api-key'); ?>&callback=initMap">
</script>-->