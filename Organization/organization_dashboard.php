<?php
include('../sql_connect.php');
include('Header_Organization.php');
$id = $_SESSION['num'];

//display followers
$follow_query = "SELECT * FROM follow WHERE org_id = '$id'";
$follow_data = mysqli_query($sql, $follow_query);
	if (!$follow_data){
		echo "ERROR QUERY IN follow TABLE 1";
	}
$follow_count = mysqli_num_rows($follow_data);



//display advocacy sa user
$disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";
$disp_ad_data = mysqli_query($sql, $disp_ad_query);
		if (!$disp_ad_query){
			echo "Error in Query! 2";
			exit(); 
		}


//advocacies para sa compare sa ubos		
$adv_query = "SELECT * FROM advocacies";
$adv_data = mysqli_query($sql, $adv_query);
if (!$adv_data){
	echo "ERROR IN QUERY 3";
}
// display events
$event_query = "SELECT * FROM event WHERE user_id = ".$id." AND event_status = ''";
$event_data = mysqli_query($sql, $event_query);
if (!$event_data){
	echo "ERROR IN QUERY 4";
	exit();
}
//display past events
$past_query = "SELECT * FROM event WHERE user_id = ".$id." AND event_status = 'DONE'";
$past_data = mysqli_query($sql, $past_query);
if (!$past_data){
	echo "ERROR IN QUERY 5";
	exit();
	


}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>iHelp | Dashboard </title>
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
	<div class="container">
	<div class="col-xs-8">
		<h3>Welcome! <a href="organization_profile.php"><?php echo $user_row['organization_name']; ?></a></h3>
		<a class="btn btn-success" href="create_event.php">Add an Event</a>
		<h5>ADVOCACIES</h5>
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
	<div class="col-xs-4">
		<h3>FOLLOWERS (<a href="#"><?php echo $follow_count?></a>)</h3>
		<div class="col-xs-12">
			<?php 
				while($row=mysqli_fetch_array($follow_data)){
					$vol_id = $row['volunteer_id'];
					$disp_query = "SELECT user_prof_pic FROM user WHERE user_id = '$vol_id'";
					$disp_data = mysqli_query($sql, $disp_query);
					$icon = mysqli_fetch_array($disp_data);
					$follower = $icon['user_prof_pic'];
					if ($follower == ""){
						echo '<img src="../admin/default.gif" class="prof_pic_icon" >';
					}else{
						$img_src = "../admin/userProfPic/".$follower;
						echo '<img src="'.$img_src.'" class="following_icon">';
					}
					
				}
			?>
		</div>
	</div>
	<div class="col-xs-12"> 
		<div class="col-md-8">
			<h3>UPCOMING ACTIVITIES</h3>
			<div id="list-type" class="proerty-th">
				<?php
				
				while ($event_row = mysqli_fetch_array($event_data)){
					$event_img = $event_row['event_img'];
					$img_src = "../admin/eventImages/".$event_img;
					echo '<div class="col-sm-6 p0">
							<div class="box-two proerty-item">
								<div class="item-thumb">
									<img src="'.$img_src.'" class="img_event_size">
								</div>
								<div class="item-entry overflow">
									<h5><a href="property-1.html">'.$event_row['event_name'].'</a></h5>
								<div class="dot-hr"></div>
									<span class="pull-left"><b> Date: </b>'.date("Y-m-d h:i A", strtotime($event_row['event_start'])).'</span>
									<span class="pull-left"><b>Location: </b>'.$event_row['event_location'].'</span>
									<div class="property-icon">
										<button class="btn btn-success read"  data-target='.$event_row['event_id'].'>Read More</button>
									</div>
								</div>
							</div>
						</div>';
				}
				?>
			</div>
			<!-- READ MORE MODAL! -->
			<div id="readmore" class="modal fade bd-example-modal-lg" role="dialog">
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
							<div id="floating-panel">
							<b>Start: </b>
							<input type = "text" id = "start" class="form-control">
							</div>
							<div id="map"></div>
						</div>
						<div class="col-xs-6">
							<p id="event_description"></p>
							<h6>WHERE</h6>
							<p id="event_location"></p>
							<h6>WHEN</h6>
							<p id="event_start"></p>
							<h6>WHO</h6>
							<p id="occupation"></p>
							<h6>WHAT TO BRING</h6>
							<p id="event_material_req"></p>
							<a class="prereg">View Pre-Registered Volunteers</a><br>
							<a class="volresources">View Volunteered Resources</a>
						</div>
						<div class="col-xs-6">
							
						</div>
					</div> 
				  </div>
				  <div class="modal-footer">
					<a class="pubToPast"><button class="btn btn-danger">Publish to Past Activity</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>
			<!-- END OF READ MORE MODAL -->
		</div>
		<div class="col-xs-4">
			<h3>PAST ACTIVITIES</h3>
			<?php 
				while ($past_row = mysqli_fetch_array($past_data)){
					$event_img = $past_row['event_img'];
					$img_src = "../admin/eventImages/".$event_img;
					echo '<div class="col-xs-12"> 
							<div class="col-xs-3">
								<img src="'.$img_src.'" class="past_event">
							</div>
							<div class="col-xs-9">
								<p>'.$past_row['event_name'].'</p>
								<small>RATING</small>
							</div>
							</div>';
				}
			
			
			?>
			
			
		</div>
		<div class="col-xs-12"> 
			<div class="col-xs-9">
				<h3>CALENDAR OF EVENTS</h3>
					<div id='calendar' class='col-sm-12'></div>
			</div>
			<div class="col-xs-3">
				<h3>FEEDBACKS</h3>
			</div>
		</div>
	</div>
	
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
					$calendar_query = "SELECT * FROM event WHERE user_id = ".$id."";
					$calendar_data = mysqli_query($sql, $calendar_query);
					if (!$calendar_data){
						echo "ERROR IN QUERY 5";
						exit();
					}

					
					while ($row = mysqli_fetch_assoc($calendar_data)){

						echo "{
							title : '".$sql->real_escape_string($row['event_name'])."',
							start : '".$row['event_start']."',
							

							color : 'blue'

						},";
					}
					?>
			]
		});
		
		
		$(".read").click(function(){
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