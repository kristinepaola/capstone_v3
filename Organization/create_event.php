<?php
require ("../sql_connect.php");
include ("Header_Organization.php");
$org_query = "SELECT * FROM organization_details";
$org_data = mysqli_query ($sql, $org_query);
if(!$org_data){
	echo "ERROR IN QUERY";
}
$id = $_SESSION['num'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
	<head>
		
		<link rel="stylesheet" href="../daterangepicker/daterangepicker.css">
	</head>
    <body>

        
        <!-- Body content -->
        
        <!--End top header -->

        <!-- End of nav bar -->

        <!-- End page header --> 

        <!-- property area -->
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form action="insert_event.php" method="POST" enctype="multipart/form-data">

                            <div class="profiel-header">
                                <h3>
                                    <b>CREATE</b> AN EVENT <br>
                                    <small>All change will be displayed on your profile.</small>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">

                                <div class="col-sm-6">
									<div class="form-group">
                                        <label>Image <small>(required)</small></label>
                                        <input name="eventImage" type="file" id="event_img">
                                    </div>
                                    <div class="form-group">
                                        <label>Event Title <small>(required)</small></label>
                                        <input name="event_name" type="text" id="event_name" class="form-control-event">
                                    </div> 
									<div class="form-group">
                                        <label>Event Description <small>(required)</small></label>
                                        <textarea name="event_description" id="event_description" rows ="5" class="form-control"></textarea>
                                    </div> 
									<div class="form-group">
                                        <label>Location<small>(required)</small></label>
                                        <input name="event_location" type="text" id="event_location" class="form-control-event">
                                    </div> 
									<div class="form-group">
                                        <div id="map"></div>
                                    </div>						
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Date</label><small>(required)</small>
                                        <input type="text" name="daterange" id="daterange" class="form-control-event"/>
                                    </div>
									<div class="form-group">
                                        <label>Materials To Bring<small>(equipments to bring)</small></label>
                                        <textarea rows ="5" name="event_material_req" type="text" id="event_material_req" class="form-control"></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Age Requirement <small>(required)</small></label>
                                        <input name="event_age_req" type="number" id="event_age_req" class="form-control-event">
                                    
                                        <label>Gender Requirement<small>(required)</small></label>
                                        <select name="event_gender_req" class="form-control-event">
											<option></option>
										  <option value="Female">Female</option>
										  <option value="Male">Male</option>
										  <option value="Both(Female/Male)">Both(Female/Male)</option>
										</select>
                                    </div>
									<div id="container">
										  Occupation Name:<input name="occupation_name[]" type="text" id="occupation_name" class="form-control-event">
										  No. of Volunteers:<input name="no_volunteer[]" type="number" id="no_volunteer" class="form-control-event">
										  <a href="#" id="add">Add</a>
									</div>
									<br>
									<div id="partnership">
										   Partnership with Other Organization/s:
										   <select name='partnership[]' class="form-control-event">
												<option></option>
												<?php
													while ($org_row = mysqli_fetch_array($org_data)){
														echo "<option>".$org_row['organization_name']."</option>";
													}
												?>
											</select>
											 <a href="#" id="addPartnership">Add</a>
									</div>
								</div>	
                                </div>
								
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type='submit' class='btn btn-finish btn-primary pull-right' name='submit' value='Submit' />
                                </div>
                                
                            </div>
 
                    
                            
                            
                    </form>

                </div>
            </div><!-- end row -->

        </div>
    </div>

  <!-- Footer area-->
<script src="../assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../daterangepicker/daterangepicker.js"></script>
<script>
//ADD  OCCUPATION
$(document).ready(function(){
	
	//check date
		$("#daterange").blur(function(){
			var date = $(this).val();
			var x = $.ajax({
				url: "checkDate.php",
				method: "POST",
				data: {date:date},
				dataType: "json",
				success: function(resp){
					$("#prompt").html(resp[0]);
					if (resp[1] == "no"){
						$("#next").click(function(event){
						$("#next").prop('disabled', true);
						});
					}else{
						$("#next").prop('disabled', false);
					}
				}
			});
			console.log(x);
		});
	
	
	
	var disp_date = moment().add(1, 'days');
	
	//date range picker
	$('#daterange').daterangepicker({
			"timePicker": true,
			"minDate": disp_date,
			 "endDate": disp_date,
			 "locale": {
				format: 'MM/DD/YYYY h:mm A'
			}
	});
	
	
  //Variables
   var display = '<p/><div id="container">Occupation Name:<input name="occupation_name[]" type="text" id="occupation_name" class="form-control-event">No. of Volunteers:<input name="no_volunteer[]" type="number" id="no_volunteer" class="form-control-event"><a href="#" id="delete_occ">Delete</a></div>';
  //Add rows to the form
  $("#add").click(function(e){
	  e.preventDefault();
    $("#container").append(display);
  });
  //Remove
  $("#container").on("click", "#delete_occ", function(e){
	  e.preventDefault();
    $(this).parent("div").remove();
  });

// ADD PARTNERSHIP

  $("#addPartnership").click(function(e){
	e.preventDefault();
    fetch();
  });
  //Remove
  $("#partnership").on("click", "#delete_partner", function(e){
	e.preventDefault();
    $(this).parent("div").remove();
  });
});

function fetch(){
	var orgList = "<div id='partnership'>Partnership with Other Organization/s:<select name='partnership[]' class='form-control-event'><option></option>";
		$.ajax({
			url: "displayListOrg.php",
			method: "POST",
			dataType: "json",
			success: function(retval){
				for (var i = 0; i<retval.length; i++){
					 orgList +="<option>"+retval[i].organization_name+"</option>";
					
					
				}
				orgList += "</select><a href='#' id='delete_partner'>Delete</a></div>";    
				$("#partnership").append(orgList);
			}
		})
	}

//google search API
function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.3157, lng: 123.8854},
          zoom: 15,
          mapTypeId: 'roadmap'
        });
		
		var input = document.getElementById('event_location');
        var searchBox = new google.maps.places.SearchBox(input);
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		
		map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
		
		var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
			 var marker = new google.maps.Marker({
				  position: place.geometry.location,
				  map: map
				});
  
            markers.push(new google.maps.Marker({
              map: map,
              icon: marker,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {

              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initAutocomplete" async defer></script>
	</script>


    </body>
</html>