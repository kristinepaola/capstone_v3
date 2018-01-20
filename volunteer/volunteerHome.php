<?php
require ("../sql_connect.php");
include("nameTitle.php");
$id = $_SESSION['num'];
  
//display advocacy sa user
$disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";
$disp_ad_data = mysqli_query($sql, $disp_ad_query);
	if (!$disp_ad_query){
		echo "Error in Query!";
		exit(); 
	}
	
//advocacies para sa compare sa ubos		
$adv_query = "SELECT * FROM advocacies";
$adv_data = mysqli_query($sql, $adv_query);
if (!$adv_data){
	echo "ERROR IN QUERY";
}

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
								$row = mysqli_fetch_array($disp_ad_data);
								
								$exp = explode (', ', $row['advocacies']);
								$size = count($exp);
								while ($adv_row = mysqli_fetch_array($adv_data)){
								$adv_icon = $adv_row['advocacy_icon'];
								$img_src = "../admin/advocaciesIcon/".$adv_icon;
								for ($i=0; $i<$size; $i++){
									
										if ($exp[$i] == $adv_row['advocacy_name']){
											echo "<img src='".$img_src."' class='adv'>";
										}
									}
								}
								//while ($row = mysqli_fetch_array($disp_ad_data)){
									//echo $row['advocacies']." ";
								//}
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
	</div>
	</div>
	</div>           
	</div>
	
</div>
</body>
</html>
<script>
	$(document).ready(function(){
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>
</script>
