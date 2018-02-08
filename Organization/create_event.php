<?php
require ("../sql_connect.php");


include ("Header_Organization.php");
$org_query = "SELECT * FROM organization_details";
$org_data = mysqli_query ($sql, $org_query);
if(!$org_data){
	echo "ERROR IN QUERY";
}
//query for adv
$dispAdv_query = "SELECT * FROM advocacies";
$dispAdv_data = mysqli_query ($sql, $dispAdv_query);
if (!$dispAdv_data){
"Error in query";
}

$occupation_query = "SELECT occupation_name FROM occupations";
$occupation_data = mysqli_query ($sql, $occupation_query);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
	<head>
		<link rel="stylesheet" href="../assets/css/icheck.min_all.css">
		
	</head>
    <body>
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
					<div class="col-sm-10 col-sm-offset-1 profiel-container">
						<form action="insert_event.php" method="POST" enctype="multipart/form-data">
									<hr>
									<div class="profiel-header">
										<h3>
											<b>CREATE</b> AN EVENT <br>
											<small>Fill in the required (*) fields below. iHelp will find the right volunteers for you.</small>
										</h3>
										<hr>
									</div>

									<div class="clear">
										<div class="col-sm-6">
											<div class="form-group col-sm-12">
												<label>Image *</label>
												<input name="eventImage" type="file" id="event_img">
											</div>
											<div class="form-group col-sm-12" >
												<label>Event Title *</small></label>
												<input required name="event_name" type="text" id="event_name" class="form-control">
											</div> 
											<div class="form-group col-sm-12">
												<label>Event Description *</label>
												<label><small>(A brief summary of the activity you're organizining, description of the volunteers that you need, and other important details that you woud like potential volunteers to know.)</small></label>
												<textarea required name="event_description" id="event_description" rows ="5" class="form-control"></textarea>
											</div> 
										</div>
										<div class="col-sm-6">
											<div class="form-group col-sm-12">
												<label>Location *</label>
												<input required name="event_location" type="text" id="event_location" class="form-control">
											</div> 
											<div class="form-group col-sm-12">
												<div id="map"></div>
											</div>
										</div>
									</div>
									<hr>
									<div class="profiel-header">
										<h3>
											<b>OCCUPATION</b> SPECIFICS <br>
											<small>Next step is to start creating a criteria for your needed volunteers. The fields below will help volunteers that are registered to iHelp know what kind of volunteers you are looking for.</small>
										</h3>
										<hr>
									</div>
									<div class="clear">
										<div class="col-sm-6">
											<div class="form-group col-sm-12">
												<label>Date *</label>
												<input required type="text" name="daterange" id="daterange" class="form-control"/>
												<label><small id="prompt"></small></label>
											</div>
											<div class="form-group col-sm-12">
												<label>What To Bring * </label>
												<label><small>(Specify what are the things adviced to bring and materials that will be needed)</small></label>
												<textarea rows ="5" name="event_material_req" type="text" id="event_material_req" class="form-control" required></textarea>
											</div>

											<div class="form-group col-sm-12">
												<label>Age Requirement *</label>
												<label><small>(Provide volunteer characteristics for easier recruitment)</small></label>
											</div>
											<div class="form-group  col-sm-12">
												<div class="form-group col-sm-3">
													<label>Minimum</label>
													<input min="1" max="70" name="age_req[]" type="number" id="num_vol" class="form-control"  required">
												</div>
												<div class="form-group col-sm-3">
													<label>Maximum</label>
													<input min="1" max="70" name="age_req[]" type="number" id="num_vol" class="form-control" required">
												</div>
											</div>											
										</div>	
										<div class="col-sm-6">
											<!--END OF DIV SA FORM-->
											<div id="container">
												<label>Number of Volunteer Required</label>
												<label><small>(If you have specific volunteer occupation for your event, different occupation groups are provided below. If there aren't any, click on "No Specific Occupation Needed")</small></label>
												<div class="form-group col-sm-12">
												</div>
												<div class="form-group col-sm-12">
														<div class="form-group col-sm-3">
															<label>Qty </label>
															<input name="no_volunteer[]" type="number" id="no_volunteer_1" class="form-control">
														</div>
														<div class="form-group col-sm-6">
															<label>Occupation Name </label>
															<select name='occupation_name[]' class="form-control">
																<option></option>
																<option>No Occupation Required</option>
																																															<?php
																	while ($occ_row = mysqli_fetch_array($occupation_data)){
																		echo "<option>".$occ_row['occupation_name']."</option>";
																	}
																?>
															</select>
														</div>
														<div class="form-group col-sm-3">
															<label>Add</label>
															<a class="btn btn-success" id="add"><span class="glyphicon glyphicon-plus"></span></a>
														</div>
												</div>												
											</div>
											<div class="form-group col-sm-12">
												<label>Partnership with Other Organization/s *</label>
												<label><small>(If you have specific volunteer occupation for your event, provide it here. If there aren't any, click on "No Specific Occupation Needed")</small></label>
											</div>											
											<div id="partnership">
												<div class="form-group col-sm-12">
													<div class="form-group col-sm-6">
														<label>Organization Name</label>
														<select name='partnership[]' class="form-control">
															<option></option>
															
																<?php
																		while ($org_row = mysqli_fetch_array($org_data)){
																			echo "<option value=".$org_row['user_id'].">".$org_row['organization_name']."</option>";
																		}
																?>
														</select>
													</div>
													<div class="form-group col-sm-3">
														<label>Add</label>
														<a class="btn btn-success" id="addPartnership"><span class="glyphicon glyphicon-plus"></span></a>
													</div>												
												</div>	
											</div>
												
										</div>
									</div>
									<div class="clear">
											<div class="form-group col-sm-12">
												<hr>
												<div class="profiel-header">
												<h3>
													<b>CHOOSE</b> ADVOCACIES <br>
													<small>(Select advocacies for this event)</small>
												</h3>
												</div>
												<hr>
											</div>			
											<div class="form-group col-sm-12">
													<?php
															while ($row = mysqli_fetch_array($dispAdv_data)){
															$advicon = $row['advocacy_icon'];
															$img_src = "../admin/advocaciesIcon/".$advicon;
																echo '<div class="form-group col-sm-4">';
																echo "<img src='".$img_src."' class='advicon'>";
																echo "<input type='checkbox' name = 'advocacy[]' value='".$row['advocacy_id']."' class='icheckbox_square-red'> <label>".$row['advocacy_name']."</label>";
																echo '</div>';
														  }
														  
														?>
											</div>
									</div>
									<div class="form-group col-sm-12">
										<div class="col-sm-10 col-sm-offset-1">
											<input type='submit' class='btn btn-finish btn-primary pull-right' name='submit' value='Submit' id='submit'/>
										</div>	
									</div>
					</div>
						</form>					
					</div>             	
                </div>
            </div><!-- end row -->
        </div>
    </body>
</html>
<script src="../assets/js/icheck.min.js"></script>
<script>
$(document).ready(function(){
	//check num of volunteers 
	$("#num_vol_1").focusout(function(){
		var num_vol_1 = parseInt($("#num_vol_1").val());
		
		addMoreVol(num_vol_1);
		addOcc(num_vol_1);
	});	
	//check date
		var x = $("#daterange").blur(function(){
			var date = $(this).val();
			console.log(date);
			var x = $.ajax({
				url: "checkDate.php",
				method: "GET",
				data: {event_start:date},
				dataType: "json",
				success: function(resp){
					if(resp[1] == 1){
						alert("ERROR: Cannot at event with the same date and time.");
						$("#submit").remove();
					}else{
						alert("Date and Time is available");
						$("#submit").show();
					}
				}
			});
			
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

   var display = '<div id="container"><div class="form-group col-sm-12"><div class="form-group col-sm-3"><label>Qty</label><input required name="no_volunteer[]" type="number" id="no_volunteer" class="form-control"></div><div class="form-group col-sm-6"><label>Occupation Name </label><input required name="occupation_name[]" type="text" id="occupation_name" class="form-control"></div><div class="form-group col-sm-3"><label>Delete</label><a class="btn btn-danger" id="delete_occ"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';
	//add an occupation field
	  $("#add").click(function(e){
		  e.preventDefault();
		fetchOcc();
	  });
	//remove an occupation field
	  $("#container").on("click", "#delete_occ", function(e){
		e.preventDefault();
		$(this).parentsUntil("#container").remove();
	  });
	//add partnership field
	  $("#addPartnership").click(function(e){
		e.preventDefault();
		fetch();
	  });
	//remove occupation field
	  $("#partnership").on("click", "#delete_partner", function(e){
		e.preventDefault();
		$(this).parentsUntil("#partnership").remove();
		y--;
	  });
});
//add occ
function addOcc(num_vol_1){
	
	$("#no_volunteer_1").val(num_vol_1);
}

//add more vol qty
function addMoreVol(num_vol_1){
	var max = 3;
	var i = 1;
	//add volunteer gender req field
	$("#add_vol").click(function(e){
		e.preventDefault();
		i++;
		if (i <= max){
		var addvol_display = '<div id="volunteers"><div class="form-group col-sm-12"><div class="form-group col-sm-3"><label>Qty</label><input required min="1" name="num_vol[]" type="number" id="num_vol_'+i+'" class="form-control"></div><div class="form-group col-sm-6"><label>Gender Requirement</label><select name="event_gender_req[]" class="form-control" required><option value="Both(Female/Male)">Both(Female/Male)</option><option value="Female">Female</option><option value="Male">Male</option></select></div><div class="form-group col-sm-3"><label>Remove</label><a class="btn btn-danger" id="delete_vol"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';
		$("#volunteers").append(addvol_display);
			$("#num_vol_"+i+"").focusout(function(){
				var cur_num_vol = parseInt($("#num_vol_"+i+"").val());
				num_vol_1 = num_vol_1 + cur_num_vol;
				console.log("num_vol_1 = "+num_vol_1);
				addOcc(num_vol_1);
			});
		}
	});	
	  //remove volunteer gender req field
	$("#volunteers").on("click", "#delete_vol", function(e){
		e.preventDefault();
		i--;
		
		var x = i - 1;
		var cur_num_vol = parseInt($("#num_vol_"+i+"").val());
		var prev_num_vol = parseInt($("#num_vol_"+x+"").val());
		if (i == 1){
			num_vol = parseInt($("#num_vol_"+i+"").val());
		}else{
			num_vol = cur_num_vol + prev_num_vol;
			
		}
		$(this).parentsUntil("#volunteers").remove();
		addOcc(num_vol);
		
	});	
}


//get organization list for partnership
function fetch(){

	var orgList = '<div id="partnership"><div class="form-group col-sm-12"><div class="form-group col-sm-6"><label>Organization Name</label><select name="partnership[]" class="form-control"><option></option>';
		var x = $.ajax({
			url: "displayListOrg.php",
			method: "POST",
			dataType: "json",
			success: function(retval){
				var count = retval.length;
				for (var i = 0; i<count; i++){
					 orgList +="<option>"+retval[i].organization_name+"</option>";			
				}
					orgList += '</select></div><div class="form-group col-sm-3"><label>Delete</label><a class="btn btn-danger" id="delete_partner"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';    
					$("#partnership").append(orgList);					
			}
		});
		
	}

function fetchOcc(){

	var occList = '<div id="container"><div class="form-group col-sm-12"><div class="form-group col-sm-3"><label>Qty </label><input name="no_volunteer[]" type="number" id="no_volunteer_1" class="form-control"></div><div class="form-group col-sm-6"><label>Occupation Name </label><select name="occupation_name[]" class="form-control"><option></option><option>No Occupation Required</option>';																							
		var x = $.ajax({
			url: "displayListOcc.php",
			method: "POST",
			dataType: "json",
			success: function(retval){
				var count = retval.length;
				for (var i = 0; i<count; i++){
					 occList +="<option>"+retval[i].occupation_name+"</option>";			
				}
					occList += '</select></div><div class="form-group col-sm-3"><label>Delete</label><a class="btn btn-danger" id="delete_occ"><span class="glyphicon glyphicon-minus"></span></a></div>';    
					$("#container").append(occList);					
			}
			
		});
		
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
