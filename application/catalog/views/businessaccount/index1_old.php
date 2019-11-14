<?php
echo $header;
echo $sidebar;
?>

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
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">

                <div class="panel col-md-12 col-xs-10">
                    <div class="panel-body">
                        <h4 class="m-b-30 m-t-0"><i class="fa fa-user"></i>&nbsp;&nbsp;Enter Business Information

                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger" id="myerror">
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success" id="myerror">
                                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?> 
                            <div class="col-sm-2 pull-right"> 

                            </div>
                        </h4>
                        <div class="row">
                            <?php echo form_open(site_url('BusinessAccount/business'), array('class' => '', 'id' => 'profilefrm', 'name' => 'profilefrm')); ?>
                            <div class="col-md-12">
                                <!--<h2 class="col-xs-12 padng_rmv">Enter Contact Information Below</h2>-->

                                <div class="col-md-10 col-xs-12  padngrmv-input">
                                    <div class="mngac-note">
                                        <!--<i class="fa fa-lightbulb-o" aria-hidden="true"></i><p>&nbsp;To active your listing, Please fill in all of the required fields below. </p>-->
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-12" style="margin-bottom: 15px">

                                    </div> 
                                    <form class=>
                                        <div class="form-group col-xs-12 padng_rmv">
                                            <label for="businessname" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Business Name</label>
                                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                                <input type="text" class="form-control" id="businessname" name="businessname" placeholder="Business Name"/>
                                            </div>   
                                        </div>
                                        <div class="form-group col-xs-12 padng_rmv">
                                            <label for="business_type" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Business Type</label>
                                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                                <select id="business_type" name="business_type" class="form-control">
                                                    <option value="">Select business type</option>
                                                    <?php  foreach ($business_type as $type): ?>
                                                    <option value="<?php echo $type['id'];   ?>"><?php  echo $type['type_name'];   ?></option>
                                                    <?php  endforeach; ?>
                                                </select>  
                                            </div>   
                                        </div>
                                        <div class="form-group col-xs-12 padng_rmv">
                                            <label for="ownername" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Owner Name</label>
                                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                                <input type="text" class="form-control" id="ownername" name="ownername" placeholder="Business Owner Name" value="<?php // echo $login_business_info['ownername'];   ?>">
                                            </div>   
                                        </div>
                                        <div class="form-group col-xs-12 padng_rmv">
                                            <label for="Email" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Email<span id="verifiedemail">
                                                    <?php
                                    if ($this->data['logged_use']['active_email'] == 'No') {
                                                    echo '<i style="color:red" title="Not verified" aria-hidden="true" class="fa fa-times-circle"></i>';
                                 } else {
                                     echo '<i style="color:green" title="Verified" aria-hidden="true" class="fa fa-check-circle"></i>';
                                   }
                                                    ?>


                                                </span></label>
                                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php  echo $this->data['logged_use']['email']; ?>" readonly>
                                            </div>   
                                        </div>
                                        <div class="form-group col-xs-12 padng_rmv">
                                            <label for="phone" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Phone Number</label>
                                            <div class="col-md-9 col-xs-12 padngrmv-input">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" />
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

                                <!--<h2 class="col-xs-12 padng_rmv">Where are you located?</h2>-->

                                <div class="col-md-10 col-xs-12">
                                    <div class="db-map1">
                                        <div class="col-md-8 col-md-offset-3 col-xs-12 padngrmv-input">
                                            <input type="text" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" class="form-control ">
                                        </div>  

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <div id="map1"></div>
                                        <p></p><div class="clearfix"></div>

                                        <label for="geolocation" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Geo Location</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="geolocation" name="geolocation" placeholder="Enter Lat-long">
                                            <span id="locationtext"></span>
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="addressline1" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Address Line 1</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="addressline1" name="addressline1" placeholder="Address Line 1" value="<?php // echo $login_business_info['addressline1'];   ?>">
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="addressline2" class="col-md-3 col-xs-12 lb1 padngrmv-input">Address Line 2</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="addressline2" name="addressline2" placeholder="Address Line 2" value="<?php // echo $login_business_info['addressline2'];   ?>">Optional
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="city" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>City</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="city" name="city" placeholder="City" value="<?php // echo $login_business_info['city'];   ?>">
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="state" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>State</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="state" name="state" placeholder="State" value="<?php // echo $login_business_info['state'];   ?>">
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="country" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Country</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <select class="form-control" id="countries" name="countries">
                                                <!--<option value="">Select country</option>-->
                                                <?php foreach ($countries as $country): ?>
                                                <option <?php // echo ($login_business_info['country'] == $country['id']) ? 'selected' : '';   ?> value="<?php  echo $country['id'];   ?>"><?php  echo $country['name'];   ?></option>
                                                <?php  endforeach; ?>
                                            </select>

                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 padng_rmv">
                                        <label for="zipcode" class="col-md-3 col-xs-12 lb1 padngrmv-input"><span style="color: red">*</span>Zip Code</label>
                                        <div class="col-md-9 col-xs-12 padngrmv-input">
                                            <input type="text" class="form-control " id="zipcode" name="zipcode" placeholder="Zip Code" value="">
                                        </div>   
                                    </div>

                                    <button type="submit" class="btn btn-default pull-right" id="">Submit</button> 

                                </div>

                            </div>   
                            <?php echo form_close(); ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>
    <script>
 $('#myerror').slideDown(function () {
            setTimeout(function () {
                $('#myerror').slideUp();
            }, 3000);
        });
$(document).ready(function () {
    $('#profilefrm').validate({
                rules: {
                    businessname:{
                        required: true,
                        remote: {
                            url: "<?php echo site_url('BusinessAccount/businessnameexist');?>",
                            type: "post",
                            data: {
                                
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            }
                        },
                    },
                    business_type:{
                        required: true,
                    },
                    ownername:{
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "<?php echo site_url('BusinessAccount/emailExits');?>",
                            type: "post",
                            data: {
                                
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            }
                        }
                    },
                    phone:{
                        required: true,
                    },
                    geolocation:{
                        required: true,
                    },
                    addressline1:{
                        required: true,
                    },
                    city:{
                        required: true,
                    },
                    state:{
                        required: true,
                    },
                    country:{
                        required: true,
                    },
                    zipcode:{
                        required: true,
                    },
                    
                },
                messages: {
                    businessname:{
                        required: "Please enter business name",
                        remote:"Business name already exist"
                    },
                    business_type:{
                        required: "Please select business type",
                    },
                    ownername:{
                        required: "Please enter business owner name",
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter valid email",
                        remote:"Email already exist"
                    },
                    phone:{
                        required: "Please enter phone number",
                    },
                    geolocation:{
                        required: "Please enter geo location",
                    },
                     addressline1:{
                        required: "Please enter address line1",
                    },
                    city:{
                        required: "Please enter city",
                    },
                    state:{
                        required: "Please enter state",
                    },
                    country:{
                        required: "Please select country",
                    },
                    zipcode:{
                        required: "Please enter zipcode",
                    },
                    
                },
             
            });
   });


</script>
<script>
    var globalmarker;
   
    $(document).ready(function(){
        setTimeout(
  function() 
  {
    //do something special
 
        var arr= new Array();
        arr[0]=23.037419;
        arr[1]=72.512215;
    if(document.getElementById('geolocation').value!=''){
        arr = document.getElementById('geolocation').value.split(',');
    }
    
      var mylatlong = {lat: parseFloat(arr[0]), lng:parseFloat(arr[1])};
        var map = new google.maps.Map(document.getElementById('map1'), {
          zoom: 15,
          center: mylatlong
          
        });
         globalmarker = new google.maps.Marker({
          position: mylatlong,
          map: map,
           draggable: true,
         


        });
        google.maps.event.addListener(globalmarker, 'dragend', function(evt){
    document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
    document.getElementById('geolocation').value= evt.latLng.lat()+','+evt.latLng.lng();
});

google.maps.event.addListener(globalmarker, 'dragstart', function(evt){
    document.getElementById('locationtext').innerHTML = '<p>Currently dragging marker...</p>';
});
     }, 1000);
    }); 
    
    
   // function getlatlongfrommarker(){
       
         
   // }
      function initMap() {
      var arr= new Array();
        arr[0]=23.037419;
        arr[1]=72.512215;
          if(document.getElementById('geolocation').value!=''){
            arr = document.getElementById('geolocation').value.split(',');
        }
        
        var mylatlong = {lat: parseFloat(arr[0]), lng:parseFloat(arr[1])};
        var map = new google.maps.Map(document.getElementById('map1'), {
          zoom: 15,
          center: mylatlong
          
        });
        globalmarker = new google.maps.Marker({
          position: mylatlong,
          map: map,
           draggable: true,
         
        });
          google.maps.event.addListener(globalmarker, 'dragend', function(evt){
    document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
    document.getElementById('geolocation').value= evt.latLng.lat()+','+evt.latLng.lng();
});

google.maps.event.addListener(globalmarker, 'dragstart', function(evt){
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
         google.maps.event.addListener(globalmarker, 'dragend', function(evt){
    document.getElementById('locationtext').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
    document.getElementById('geolocation').value= evt.latLng.lat()+','+evt.latLng.lng();
});

google.maps.event.addListener(globalmarker, 'dragstart', function(evt){
    document.getElementById('locationtext').innerHTML = '<p>Currently dragging marker...</p>';
});
      
      }
      function geocodeAddress(geocoder, resultsMap) {
        var address ="925 Princes Highway, Heathmere, Victoria, Australia";// document.getElementById('autocomplete').value;
        geocoder.geocode({'address': address}, function(results, status) {
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
          navigator.geolocation.getCurrentPosition(function(position) {
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
        
        if(document.getElementById('street_number').value!=''){
            document.getElementById('addressline1').value=document.getElementById('street_number').value+' '+document.getElementById('route').value;
        }
        else{
            document.getElementById('addressline1').value=document.getElementById('route').value;
        }
       // var latlong=JSON.stringify(place.geometry['location']);
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng(); 
        document.getElementById('geolocation').value=latitude +','+ longitude;// latlong.replace(/"/g, "").replace(/'/g, "").replace(/\(|\)/g, "");
        
        
        
        document.getElementById('city').value=document.getElementById('locality').value;
        document.getElementById('state').value=document.getElementById('administrative_area_level_1').value;
        document.getElementById('zipcode').value=document.getElementById('postal_code').value;
        
        /*$.ajax({
                        url: "<?php echo site_url('BusinessAccount/getCountry');?>",
                        type: "POST",
                        dataType: "html",
                        data: {
				'code':$('#country').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			},
                      
                        success: function (data) {
                           

                        $('#country1')
                            .find('option')
                            .remove()
                            .end()
                            .append(data);
;
//set location in map
initMap1(place.geometry['location']);

                        }
                    
                    });*/
                    
                    
                    
                    
      }

     
    </script>

    
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google-map-api-key'); ?>&libraries=places&callback=initAutocomplete"
async defer></script>


    <script src="<?php echo base_url('/'); ?>admincp/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
