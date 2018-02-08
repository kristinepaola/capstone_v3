<?php
require ("../sql_connect.php");
include("nameTitle.php");
$id = $_SESSION['num'];



//attendance
$attendance_query = "SELECT A.status, A.event_id, B.event_name FROM attendance A, event B WHERE volunteer_id = '$id' AND B.event_status = 'Done' AND A.event_id = B.event_id";
$attendance_data = mysqli_query ($sql, $attendance_query);
$attendance_row = mysqli_fetch_array($attendance_data);
$attendance_count = mysqli_num_rows($attendance_data);
//recommended activities
$recommended_query = "SELECT DISTINCT A.advocacy_name, B.advocacy_id, B.event_id, C.event_name, C.user_id, D.user_id, D.first_name, D.advocacies, E.organization_name, C.event_img
FROM advocacies A, event_advocacy B, event C, user D, organization_details E
WHERE A.advocacy_id = B.advocacy_id 
AND B.event_id = C.event_id 
AND D.user_id = '$id'
AND C.user_id = E.user_id
AND C.event_status = 'Upcoming'
Group by c.event_name";

$recommended_data = mysqli_query($sql, $recommended_query);
//display advocacies
$useradv_query = "SELECT A.advocacy_name, A.advocacy_icon, B.user_id, B.first_name, B.advocacies
					FROM advocacies A, user B
					WHERE B.user_type = 'volunteer' AND B.user_id = '$id'";
$useradv_data = mysqli_query ($sql, $useradv_query);

//display following
$follow_query = "SELECT A.user_id, B.user_id, D.first_name, D.last_name, B.organization_name, E.user_prof_pic
FROM volunteer_details A, organization_details B, follow C, user D, user E
WHERE volunteer_id = '$id'
AND C.volunteer_id = A.user_id 
AND C.org_id = B.user_id
AND D.user_id = A.user_id
AND E.user_id = B.user_id";
$follow_data = mysqli_query($sql, $follow_query);
	if (!$follow_data){
		echo "ERROR QUERY IN follow TABLE";
	}
$follow_count = mysqli_num_rows($follow_data);

//select from event_preregistration
$prereg_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
FROM event_preregistration A, event B, user C
WHERE C.user_id = '$id'
AND A.event_id = B.event_id
AND A.user_id = C.user_id
AND B.event_status = 'Upcoming'
LIMIT 2";
$prereg_data = mysqli_query ($sql, $prereg_query);
if (!$prereg_data){
	echo "ERROR IN event_preregistration QUERY";		
}


//cnt para upcoming
$cnt_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
FROM event_preregistration A, event B, user C
WHERE C.user_id = '$id'
AND A.event_id = B.event_id
AND A.user_id = C.user_id
AND B.event_status = 'Upcoming'
";
$cnt_data = mysqli_query ($sql, $cnt_query);
if (!$cnt_data){
	echo "ERROR IN event_preregistration QUERY";		
}
$cnt = mysqli_num_rows($cnt_data);


//select from event_preregistration status='done'
$done_query = "SELECT A.event_id, A.user_id, B.event_name, B.user_id, D.organization_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location 
FROM event_preregistration A, event B, user C, organization_details D 
WHERE C.user_id = '$id' 
AND A.event_id = B.event_id 
AND A.user_id = C.user_id 
AND B.event_status = 'Done' 
AND B.user_id = D.user_id";
$done_data = mysqli_query ($sql, $done_query);
if (!$prereg_data){
	echo "ERROR IN event_preregistration QUERY";		
}



?>
  <!DOCTYPE html>
<html class="no-js">
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>Your Profile</title>
	  
	  <style>
		.following_icon{
		width: 50px;
		height: 50px;
		border: solid 1px black;
		margin: 5px;
		}
		.adv{
			width: 40px;
			height: 40px;
			margin: 1px;
		}
		.box-two{
			width: 300px;
		}
		.modal_img{
			width: 150px;
			height: 150px;
		}
		#map {
		width: 300px;
		height: 300px;
		}
		.pac-container {
		z-index: 100000;
		}
		.past_event{
			width: 500px;
			height: 50px;
			border: solid 1px black;
			margin: 5px;
		}
		.alert{
			display:inline-block;
		}
		.container{
			margin: 15px;
		}
	  </style>
	  <link rel='stylesheet' href='../fullcalendar/fullcalendar.min.css'/>
	</head>
	<body>
		<div class="container">
			<div class="col-md-4">
				<aside class="sidebar sidebar-property blog-asside-left">
					<div class="dealer-widget">
						<div class="dealer-content">
							<div class="inner-wrapper">
								<div class="clear">
									<div class="col-xs-8 col-sm-8 ">
										<h3 class="dealer-name">
											<?php echo $row['first_name']." ".$row['last_name']."!"; ?>
											<span>Volunteer</span>        
										</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default sidebar-menu">
						<div class="panel-heading">
                           <h3 class="panel-title">Advocacies</h3>
						</div>
						<div class="panel-body recent-property-widget">
							<ul class="dealer-contacts">                                        
								<?php 
									while ($row = mysqli_fetch_array($useradv_data)){
									$exp = explode (', ', $row['advocacies']);
									$size = count($exp);
									$adv_icon = $row['advocacy_icon'];
									$img_src = "../admin/advocaciesIcon/".$adv_icon;
									for ($i=0; $i<$size; $i++){
										
											if ($exp[$i] == $row['advocacy_name']){
												echo "<li><img src='".$img_src."' class='adv'>
													<label>".$row['advocacy_name']."</label>
												</li>";
											}
										}
									}
								?>
							</ul>
						</div>
						<div class="panel-heading">
                           <h3 class="panel-title">Following</h3>
						</div>
						<?php 
						while($row=mysqli_fetch_array($follow_data)){
							$follower = $row['user_prof_pic'];
							$img_src = "../admin/userProfPic/".$follower;
							if ($follower == ""){
								echo '<img src="../admin/default.gif" class="prof_pic_icon" alt='.$row['first_name'].'>';
							}else{
								echo '<img src="'.$img_src.'" class="following_icon">';
							}
						}
						?>
						<div class="panel-heading">
                           <h3 class="panel-title">Attended Activities</h3>
						</div>
						<div class="panel-body recent-property-widget">
							<ul>
								<?php
								while ($done_row=mysqli_fetch_array($done_data)){
								$event_img = $done_row['event_img'];
								$img_src = "../admin/eventImages/".$event_img;
								echo '<li>
									<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
										<img src="'.$img_src.'">
									</div>
									 <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
										<h6>'.$done_row['event_name'].'</h6>
										<a href="organization_profile_public.php?id='.$done_row['3'].'"><span class="property-price">By: '.$done_row['organization_name'].'</span></a>
									</div>
								</li>';					
								}
								?>
							</ul>
						</div>
						<div class="panel-heading">
                           <h3 class="panel-title">Recommended Activities</h3>
						</div>
						<div class="panel-body recent-property-widget">
							<ul>
								<?php
								while ($row = mysqli_fetch_array($recommended_data)){
								$user_prof_pic = $row['event_img'];
								$img_src = "../admin/eventImages/".$user_prof_pic;
								echo '<li>
									<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
										<img src="'.$img_src.'">
									</div>
									 <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
										<h6>'.$row['event_name'].'</h6>
										<h6>'.$done_row['event_name'].'</h6>
										<a href="organization_profile_public.php?id='.$done_row[4].'"><span class="property-price">By: '.$row['event_name'].'</span></a>
										<span id="alert'.$row['event_id'].'" class="label label-danger red">Pre-registered</span>										
									</div>
									<div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
										<button class="btn btn-warning read" data-target='.$row['event_id'].'>VIEW </button> 
										<button id = '.$row['event_id'].' class="btn btn-success prereg" data-target='.$row['event_id'].'>Pre Register </button>
									</div>
								</li>';					
								}
								?>
							</ul>
						</div>
				</aside>
			</div>
			<div class="col-md-8">
				<div class="col-md-12">
					<div class="panel-heading">
						<h3>Upcoming Activities 
							<?php
							if ($cnt > 2){
							echo "<a href='moreEvents.php?id=".$id."'>SEE MORE</a>";
							}else{
							echo "";
							}
							?>	
						</h3>
					</div>
					<div id="list-type" class="proerty-th">
					<?php 
						while($prereg_row = mysqli_fetch_array($prereg_data)){
								$event_img = $prereg_row['event_img'];
								$img_src = "../admin/eventImages/".$event_img;
								echo '<div class="col-sm-6 p0">
										<div class="box-two proerty-item">
											<div class="item-thumb">
												<img src="'.$img_src.'" class="img_event_size">
											</div>
											<div class="item-entry overflow">
												<h5><a href="property-1.html">'.$prereg_row['event_name'].'</a></h5>
											<div class="dot-hr"></div>
												<span class="pull-left"><b> Date: </b>'.date("Y-m-d h:i A", strtotime($prereg_row['event_start'])).'</span>
												<span class="pull-left"><b>Location: </b>'.$prereg_row['event_location'].'</span>
												<div class="property-icon">
												<button class="btn btn-success read"  data-target='.$prereg_row['event_id'].'>Read More</button>
												</div>
											</div>
										</div>
									</div>';
						}
					
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-8">
					<br>
						<div id='calendar' class='col-sm-12'></div>
					</div>	
					</div>
				</div>
			</div>
		</div>
	</body>
		<!-- READ MORE MODAL! -->
			<div id="readmore" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="event_title"></h4>
				  </div>
				  <div class="modal-body">
					<div class="col-xs-12">
						<div class="col-xs-12" id="adv_target"></div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="col-xs-12 padding-bottom-15">
								<label>How To Get There? (Choose your starting point)</label>
							</div>
								<div class="col-xs-12 padding-bottom-15" id="floating-panel">
									<h3><span class='glyphicon glyphicon-map-marker text-success'></span></h3> 
									<input type = "text" id = "start" class="form-control">
								</div>
							<div class="col-xs-12 padding-bottom-15">
								<div id="map"></div>
							</div>
							
							
						</div>
						<div class="col-xs-6">
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3><span class='glyphicon glyphicon-calendar'></span></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_description"><span>
								</div>
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-map-marker text-danger'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_location"></span>
								</div>
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-time'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_start"></span>
								</div>																
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-check'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_material_req"></span>
								</div>															
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-user'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<table class='table'>
										<thead>
											<th>Qty</th>
											<th>Occupation</th>
										</thead>
										<tbody id="occ_target"></tbody>
									</table>
								</div>															
							</div>
							<div class="col-xs-12">	
								<div class="col-xs-6">
									<a class="volresources btn btn-warning">Volunteer Resources</a>
								</div>
							</div>
						</div>
					</div> 
				  </div>
				  <div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>
			<!-- END OF READ MORE MODAL -->
			<!-- END OF ALERT MODAL -->
			<div id="alert" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="head"></h4>
					</div>
					<div class="modal-body">
						<center><strong class="text-success" id="text"></strong></center>
						
					</div> 
				  </div>
				</div>
			  </div>
			</div>
			<!-- END OF ALERT MODAL -->
</html>
<script>
	$(document).ready(function(){
			$(".red").hide();
			disableButton();
			$(".view").click(function(){
			var event_id = $(this).data("target");
			viewEvent(event_id);
			});
			$(".prereg").click(function(){
			var event_id = $(this).data("target");

			preRegister(event_id);
			});
			
			$("#calendar").fullCalendar({
			header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
			},
			
			events: [
			<?php
			//select from event_preregistration
			$calendar_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
			FROM event_preregistration A, event B, user C
			WHERE C.user_id = '$id'
			AND A.event_id = B.event_id
			AND A.user_id = C.user_id
			AND B.event_status = 'Upcoming'
			";
			$calendar_data = mysqli_query ($sql, $calendar_query);
			if (!$prereg_data){
				echo "ERROR IN event_preregistration QUERY";		
			}
				while ($row = mysqli_fetch_assoc($calendar_data)){
					
					echo "{
						title : '".$sql->real_escape_string($row['event_name'])."',
						start : '".$row['event_start']."',
						
						color : 'blue'
					}";
				}
				?>
			]
		});
		
		$(".read").on("click", function(){
			var event_id = $(this).data("target");
			console.log(event_id);
			fetchData(event_id);
		});	
	});
	function fetchData (event_id){
	
	var x = $.ajax({
			url:"../Organization/getEvent.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",

			success:function(retval){
				$("#event_img").html("");
				$("#event_title").html("");
				$("#event_description").html("");
				$("#event_start").html("");
				$("#event_material_req").html("");
				$("#event_occupation").html("");
				
				event_img = "../admin/eventImages/"+retval[0].event_img;
				event_id = retval[0].event_id;
				event_name = retval[0].event_name;
				event_description = retval[0].event_description;
				event_location = retval[0].event_location;
				event_start = moment().format('MMMM Do YYYY, h:mm a', retval[0].event_start);
				event_material_req = retval[0].event_material_req;
				
				
				$("#event_img").attr("src", event_img);
				$("#event_title").append(event_name);
				$("#event_location").append(event_location);
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				$(".volresources").attr("href", "volunteer_Resources.php?cid="+event_id);
				$("#readmore").modal("show");
				occupation(event_id);
				getAdv(event_id);
				prereg(event_id);
				initMap(event_location);
			}
				
		});
		
		
}
function getAdv(event_id){
	$.ajax({
		url:"../Organization/getAdv.php",
		method: "GET",
		data:{
			cid:event_id
		},
		dataType: "json",
		success:function(retval){

			for(var i=0; i<retval.length; i++){
				$("#adv_target").html("");
				var adv_icon = "<img src='../admin/advocaciesIcon/"+retval[i]+"' class='adv'>";
				$("#adv_target").append(adv_icon);
			}
		}
	});
}
function occupation(event_id){
	var x = $.ajax({
			url:"../Organization/getOcc.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",
			success:function(retval){
					console.log("occ retval"+retval);
					$("#occ_target").html("");
				for(var i=0; i<retval.length; i++){
					rowstr = "<tr><td>"+retval[i].noVolunteers+"</td>";
					 rowstr += "<td>"+retval[i].occupationName+"</td>";
					 $("#occ_target").append(rowstr);
				}
				
			}
				
		});	
		console.log(x);
}
function preRegister(event_id){
	var x = $.ajax({
		url: "preRegister.php",
		method: "GET",
		data: {id:event_id},
		dataType: "json",
		success: function(retval){
			console.log(retval);
			var head = retval[0];
			var text = retval[1];
			$("#head").html("");
			$("#text").html("");
			$("#head").append(head);
			$("#text").append(text);
			$("#alert").modal("show");
			check(event_id);
		}
	});
	console.log(x);
}
function check(event_id){
	var x = $.ajax({
		url: "checkPreReg.php",
		method: "GET",
		data: {id:event_id},
		dataType: "json",
		success: function (retval){
			var id = retval[1];
			$("#"+id+"").hide();
			$("#alert"+id+"").show();
			$("#notif").show();
		}
	});
}
function disableButton(){
	var x = $.ajax({
		url: "checkAllPreReg.php",
		method: "GET",
		//data: {id:event_id},
		dataType: "json",
		success: function (retval){
				
				for(var i=0; i<retval.length; i++){
					 $("#"+retval[i].event_id+"").hide();
					 $("#alert"+retval[i].event_id+"").show();
					 
				}
		}
	});
	console.log(x);
}
function initMap(event_location) {
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 10.3157, lng: 123.8854},
		  zoom: 15,
          mapTypeId: 'roadmap'
        });
        directionsDisplay.setMap(map);
		var input = document.getElementById('start');
		var autocomplete = new google.maps.places.Autocomplete(input);
		
        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('event_location').addEventListener('change', onChangeHandler);
      }
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		  
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('event_location').innerHTML,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>

