<?php
require ("../sql_connect.php");
include("nameTitle.php");
$id = $_SESSION['num'];
  
//recommended activities
$recommended_query = "SELECT DISTINCT A.advocacy_name, B.advocacy_id, B.event_id, C.event_name, C.user_id, D.user_id, D.first_name, D.advocacies, E.organization_name, C.event_img
FROM advocacies A, event_advocacy B, event C, user D, organization_details E
WHERE A.advocacy_id = B.advocacy_id 
AND B.event_id = C.event_id 
AND D.user_id = '$id'
AND C.user_id = E.user_id
Group by c.event_name";
$recommended_data = mysqli_query($sql, $recommended_query);
  
//advocacies JOIN query
$useradv_query = "SELECT A.advocacy_name, A.advocacy_icon, B.user_id, B.first_name, B.advocacies
					FROM advocacies A, user B
					WHERE B.user_type = 'volunteer' AND B.user_id = '$id'";
$useradv_data = mysqli_query ($sql, $useradv_query);

//display following
$follow_query = "SELECT * FROM follow WHERE volunteer_id = '$id'";
$follow_data = mysqli_query($sql, $follow_query);
	if (!$follow_data){
		echo "ERROR QUERY IN follow TABLE";
	}
$follow_count = mysqli_num_rows($follow_data);

//select from event_preregistration
$prereg_query = "SELECT * FROM event_preregistration WHERE user_id = '$id'";
$prereg_data = mysqli_query ($sql, $prereg_query);
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
		  </style>
		  <link rel='stylesheet' href='../fullcalendar/fullcalendar.min.css'/>
      </head>
      <body>
<div class="container">
		  <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
	<div class="col-md-9">
				  <div class="" id="contact1">
					<div class="row">
							<div class="col-md-12">
							  <h2 class="wow fadeInLeft animated">Welcome <?php echo $row['first_name']." ".$row['last_name']."!"; ?> </h2>
							</div>
							<div class="col-md-12">
							  <h5 class="wow fadeInLeft animated">PERSONAL ADVOCACIES:</h5>
							  <?php 
								while ($row = mysqli_fetch_array($useradv_data)){
								$exp = explode (', ', $row['advocacies']);
								$size = count($exp);
								$adv_icon = $row['advocacy_icon'];
								$img_src = "../admin/advocaciesIcon/".$adv_icon;
								for ($i=0; $i<$size; $i++){
									
										if ($exp[$i] == $row['advocacy_name']){
											echo "<img src='".$img_src."' class='adv'>";
										}
									}
								}
							?>
							</div>
					</div>
					<div class="row">
						<h2 class="wow fadeInLeft animated">Upcoming Activities</h2>
							<div id="list-type" class="proerty-th">
						<?php 
							while($prereg_row = mysqli_fetch_array($prereg_data)){
								//kuha event_id sa event para query sa event table
								$event_id = $prereg_row['event_id'];
								
								//query event nga gi pre-register sa user
								$curevent_query = "SELECT * FROM event WHERE event_id = '$event_id'";
								$curevent_data = mysqli_query ($sql, $curevent_query);
								
								if (!$curevent_data){
									echo "ERROR QUERY IN EVENT TABLE";
								}
								while ($curevent_row = mysqli_fetch_array($curevent_data)){
									$event_img = $curevent_row['event_img'];
									$org_id = $curevent_row['user_id'];
									$img_src = "../admin/eventImages/".$event_img;
									$orgname_query = "SELECT first_name FROM user WHERE user_id = '$org_id'";
									$orgname_data = mysqli_query($sql, $orgname_query);
									$orgname_row = mysqli_fetch_array($orgname_data);
									$org_name = $orgname_row['first_name'];
									echo '<div class="col-sm-6 p0">
											<div class="box-two proerty-item">
												<div class="item-thumb">
													<img src="'.$img_src.'" class="img_event_size">
												</div>
												<div class="item-entry overflow">
													<h5><a href="property-1.html">'.$curevent_row['event_name'].'</a></h5>
												<div class="dot-hr"></div>
													<span class="pull-left"><b> Date: </b>'.date("Y-m-d h:i A", strtotime($curevent_row['event_start'])).'</span>
													<span class="pull-left"><b>Location: </b>'.$curevent_row['event_location'].'</span>
													<div class="property-icon">
														<button class="btn btn-success read"  data-target='.$curevent_row['event_id'].'>Read More</button>
													</div>
												</div>
											</div>
										</div>';
								}
								
							}
						
						?>
					 
						<div class="col-xs-12"> 
								<h3>CALENDAR OF EVENTS</h3>
									<div id='calendar' class='col-sm-12'></div>
						</div>
					</div>
				</div>
			  <!-- /.col-md-9 -->
			</div>
  </div>                  
<div class="col-md-3">
	<div class="panel panel-default sidebar-menu wow fadeInRight animated" >
		<h3>Following</h3>
			<?php 
				while($row=mysqli_fetch_array($follow_data)){
					$org_id = $row['org_id'];
					$disp_query = "SELECT user_prof_pic FROM user WHERE user_id = '$org_id'";
					$disp_data = mysqli_query($sql, $disp_query);
					$icon = mysqli_fetch_array($disp_data);
					$follower = $icon['user_prof_pic'];
					$img_src = "../admin/userProfPic/".$follower;
					echo '<img src="'.$img_src.'" class="following_icon">';
				}
			?>
	</div>
</div>
<div class="col-md-3">
	<div class="blog-asside-right">
		<div class="panel panel-default sidebar-menu wow fadeInRight animated" >
			<div class="panel-body search-widget">
				<form action="" class=" form-inline"> 
		<div class="panel panel-default sidebar-menu wow fadeInRight animated">
			<div class="panel-heading">
				<h3 class="panel-title">Recent Activities</h3>
			</div>
			<div class="panel-body recent-property-widget">
				<ul>
					<li>
						<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
							<a href="single.html"><img src="assets/img/demo/small-property-2.jpg"></a>
							<span class="property-seeker">
								<b class="b-1">A</b>
								<b class="b-2">S</b>
							</span>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
							<h6> <a href="single.html">Super nice villa </a></h6>
							<span class="property-price">3000000$</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="panel panel-default sidebar-menu wow fadeInRight animated">
			<div class="panel-heading">
				<h3 class="panel-title">Recommended Activities For You</h3>
			</div>
			<div class="panel-body recent-property-widget">
				<ul>
				<?php 
				while($row = mysqli_fetch_array($recommended_data)){
				$user_prof_pic = $row['event_img'];
				$img_src = "../admin/eventImages/".$user_prof_pic;
				echo '<li>
						<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
							<a href="single.html"><img src="'.$img_src.'"></a>
							<span class="property-seeker">
							</span>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
							<h6> <a href="single.html">'.$row['event_name'].'</a></h6>
							<span class="property-price">'.$row['organization_name'].'</span>
							<button class="btn btn-warning view" data-target='.$row['event_id'].'>VIEW </button> 
							<button id = '.$row['event_id'].' class="btn btn-success prereg" data-target='.$row['event_id'].'>Pre Register </button>
							<div id="alert'.$row['event_id'].'" class="alert alert-danger red">
								<span>You are already pre-registered in this event</span>.
							</div>
							</div>	
						</div>
					</li>';					
				}
				
				?>
				</ul>
			</div>
		</div>
	</div>
	</div>
	</div>           
	</div>
	
</div>
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
					<div class="row">
						<div class="col-xs-6">
							<img id="event_img">
							<h6>HOW TO GET THERE</h6>
						</div>
						<div class="col-xs-6">
							<p id="event_description"></p>
							<h6>WHEN</h6>
							<p id="event_start"></p>
							<h6>WHO</h6>
							<p id="occupation"></p>
							<h6>WHAT TO BRING</h6>
							<p id="event_material_req"></p>
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
</body>
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
					
					
					
					echo "{
								title : 'animal',
								start : '2018-01-21 12:00 AM',
								color : 'blue'

							},";		
						
				?>
			]
		});
		
		$(".read").on("click", function(){
			var event_id = $(this).data("target");
			fetchData(event_id);
		});	
	});
	function fetchData (event_id){
	
	var x = $.ajax({
			url:"getEvent.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",

			success:function(retval){
				$("#event_img").html("");
				$("#event_location").html("");
				$("#event_title").html("");
				$("#event_description").html("");
				$("#event_start").html("");
				$("#event_material_req").html("");
				$("#event_occupation").html("");
				
				event_img = "../admin/eventImages/"+retval[0].event_img;
				event_id = retval[0].event_id;
				event_location = retval[0].event_location;
				event_name = retval[0].event_name;
				event_description = retval[0].event_description;
				event_location = retval[0].event_location;
				event_start = retval[0].event_start;
				event_material_req = retval[0].event_material_req;
				
				
				$("#event_img").attr("src", event_img);
				$("#event_location").append(event_location);
				$("#event_title").append(event_name);
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				$("#readmore").modal("show");
				
				$(".prereg").attr("href", "listPreRegistered.php?cid="+event_id);
				$(".pubToPast").attr("href", "updateToPast.php?id="+event_id);
				
				
				
				
				
				initMap(event_location);
			}
				
		});
		
		
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
function viewEvent(event_id){
		$.ajax({
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
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				$("#readmore").modal("show");
				
				//prereg(event_id);
			}
				
		});
}
function preRegister(event_id){
	var x = $.ajax({
		url: "preRegister.php",
		method: "GET",
		data: {id:event_id},
		dataType: "json",
		success: function(retval){	
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>
</script>
