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
											<div class="form-group col-sm-12">
												<label>No. of Volunteers Needed *</label>
											</div>
											<!--START OF DIV SA FORM-->
											<div id="volunteers">
												<div class="form-group col-sm-12">
													<div class="form-group col-sm-3">
														<label>Qty</label>
														<input min="1" required name="num_vol[]" type="number" id="num_vol_1" class="form-control" required">
													</div>
													<div class="form-group col-sm-6">
														<label>Gender Requirement</label>
														<select name="event_gender_req" class="form-control" required>
															<option value="Both(Female/Male)">Both(Female/Male)</option>
															<option value="Female">Female</option>
															<option value="Male">Male</option>	
														</select>
													</div>
													<div class="form-group col-sm-3">
														<label>Add</label>
														<a class="btn btn-success" id="add_vol"><span class="glyphicon glyphicon-plus"></span></a>
													</div>
												</div>		
											</div>
											<!--END OF DIV SA FORM-->
											<div id="container">
												<label>Occupation *</label>
												<label><small>(If you have specific volunteer occupation for your event, provide it here. If there aren't any, click on "No Specific Occupation Needed")</small></label>
												<div class="form-group col-sm-12">
														<div class="form-group col-sm-3">
															<label>Qty </label>
															<input required name="no_volunteer[]" type="number" id="no_volunteer_1" class="form-control">
														</div>
														<div class="form-group col-sm-6">
															<label>Occupation Name </label>
															<input required name="occupation_name[]" type="text" id="occupation_name" class="form-control">
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
																		echo "<option>".$org_row['organization_name']."</option>";
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
																echo "<input type='checkbox' name = 'advocacy[]' value='".$row['advocacy_id']."'> <label>".$row['advocacy_name']."</label>";
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
<script src="assets/js/icheck.min.js"></script>
<script>
$(document).ready(function(){
	//noVolNeeded function
	function noVolNeeded(num_vol_1){
		$("#num_vol_1").focusout(function(){
			var num_vol_1 = parseInt($("#num_vol_1").val());
			console.log(num_vol_1);
			$("#no_volunteer_1").val(num_vol_1);
		});
		
		
	}



