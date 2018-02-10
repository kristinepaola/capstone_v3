<?php
include('../sql_connect.php');
include('Header_Organization.php');
$id = $_SESSION['num'];
$_SESSION['event_id'] = $id;

date_default_timezone_set('Asia/Manila');
//display following
$follow_query = "SELECT A.user_id, B.user_id, D.first_name, D.last_name, B.organization_name, D.user_prof_pic
FROM volunteer_details A, organization_details B, follow C, user D, user E
WHERE org_id = '$id'
AND C.volunteer_id = A.user_id 
AND C.org_id = B.user_id
AND D.user_id = A.user_id
AND E.user_id = B.user_id";

$follow_data = mysqli_query($sql, $follow_query);
	if (!$follow_data){
		echo "ERROR QUERY IN follow TABLE";
	}
$follow_count = mysqli_num_rows($follow_data);
//GET FEEDBACKS
$feedback_query = "SELECT A.event_name, B.first_name, C.org_id, C.event_comment, B.user_prof_pic, C.timestamp
FROM event A, user B, event_feedback C
WHERE B.user_id = C.user_id
AND B.user_type = 'volunteer' 
AND C.org_id = '$id' 
AND A.event_id = C.event_id 
LIMIT 5
";
$feedback_data = mysqli_query($sql, $feedback_query);
$feedback_count = mysqli_num_rows($feedback_data);
//GET ALL EVENT FROM THIS USER - PARA UPDATE
$current_date = date('Y-m-d H:i:s');
$query = "SELECT * FROM event WHERE user_id = '$id'";
$data = mysqli_query($sql,$query);
while($row = mysqli_fetch_array($data)){
	$datetime = $row['event_end'];
	$event_id = $row['event_id'];
	if ($current_date > $datetime){
		$status_query = "UPDATE event 
						SET event_status = 'Done'
						WHERE event_id = '$event_id'";
		$status_data = mysqli_query ($sql, $status_query);
	}
}

//display events status = upcoming
$event_query = "SELECT * FROM event 
				WHERE user_id = ".$id." AND event_status = 'Upcoming'
				ORDER BY event_start ASC
				LIMIT 2
				";
$event_data = mysqli_query($sql, $event_query);
if (!$event_data){
	echo "ERROR IN QUERY 4";
	exit();
}

//for cnt nga upcoming
$cnt_query = "SELECT * FROM event 
				WHERE user_id = ".$id." AND event_status = 'Upcoming'
				";
$cnt_data = mysqli_query($sql, $cnt_query);
if (!$cnt_data){
	echo "ERROR IN QUERY 4";
	exit();
}
$cnt = mysqli_num_rows($cnt_data);
//display past events
$past_query = "SELECT * FROM event WHERE user_id = ".$id." AND event_status = 'Done' LIMIT 3";
$past_data = mysqli_query($sql, $past_query);
if (!$past_data){
	echo "ERROR IN QUERY 5";
	exit();
}
$count = mysqli_num_rows($past_data);
//display advocacies
$useradv_query = "SELECT A.advocacy_name, A.advocacy_icon, B.user_id, B.first_name, B.advocacies
					FROM advocacies A, user B
					WHERE B.user_type = 'organization' AND B.user_id = '$id'";
$useradv_data = mysqli_query ($sql, $useradv_query);
	
//partnership
$partnership = "SELECT A.event_name, B.organization_name, A.event_id 
FROM event A, organization_details B, event_partnership C, user D
WHERE A.event_id = C.event_id
AND B.user_id = D.user_id
AND C.partner_org_id = B.user_id
AND C.partner_org_id = '$id'";
$partner_data = mysqli_query ($sql, $partnership);
?>
<!DOCTYPE html>
<html>
<title>Organization | Dashboard </title>
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
      width: 50px;
      height: 50px;
      border: solid 1px black;
      margin: 5px;
    }
    #map{
      margin: 5px;
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
										<h2 class="dealer-name">
											<h4>Welcome! <a href="organization_profile.php">
												<?php echo $user_row['organization_name']; ?></a></h4>
										</h2>
										<div>
											<a class="btn btn-primary" href="create_event.php" id = 'addevent'>Add an Event</a>
										</div>
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
							            echo "<img src='".$img_src."' class='adv'>";
							          }
							        }
							      }
							    ?>
							</ul>
						</div>
						<div class="panel-heading">
                           <h3 class="panel-title"><i class="glyphicon glyphicon-bullhorn" style="font-size:24px"></i> Partnership Requests</h3>
						</div>		
						<div class='col-xs-12 col-sm-12'>
						<?php
							while($row=mysqli_fetch_array($partner_data)){
								echo "<div id=".$row['event_id'].">";
								echo "<small><b>".$row['organization_name']."</b> wants to partner with you in their event <b>".$row['event_name']."</b></small>";
								echo "<br><button data-partner=".$row['event_id']." class='btn btn-success btn-xs accept'><span class='glyphicon glyphicon-ok'></span></button>";
								echo "<button data-partner=".$row['event_id']." class='btn btn-danger btn-xs decline'><span class='glyphicon glyphicon-remove'></span></button>";
								
								echo "</div>";
								}
						?>
						</div>
						<div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-heart-o" style="font-size:24px;"></i>Followers</h3><h3>(<a id="followers" data-target="<?php echo $id ?>" ><?php echo $follow_count?></a>)</h3>
						</div>
						<div class="col-xs-12 col-sm-12 ">
						<?php 
							while($row=mysqli_fetch_array($follow_data)){
								$follower = $row['user_prof_pic'];
								if ($follower == ""){
									echo '<div class="col-xs-4 col-sm-4 ">';
									echo '<a href="volunteerProfile.php?id='.$row[0].'"><img src="../admin/default.gif" class="prof_pic_icon" alt='.$row['first_name'].'></a>';
									echo "<a href='volunteerProfile.php?id=".$row[0]."'><label>".$row['first_name']."</label></a>";
									echo '</div>';
								}else{
									$img_src = "../admin/userProfPic/".$follower;
									echo '<div class="col-xs-4 col-sm-4 ">';
									echo '<a href="volunteerProfile.php?id='.$row[0].'"><img src="'.$img_src.'" class="following_icon" alt='.$row['first_name'].'></a>';
									echo "<a href='volunteerProfile.php?id=".$row[0]."'><label>".$row['first_name']."</label></a>";
									echo '</div>';
								}
								
							}
						?>	
						</div>
						<div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-calendar-check-o" style="font-size:24px"></i>Past Activities</h3>
						</div>
						<div class="panel-body recent-property-widget">
							<ul>
								<?php
								while ($done_row=mysqli_fetch_array($past_data)){
									if($done_row['event_img']==""){
										
									}
								$event_img = $done_row['event_img'];
								echo $event_img;
								$img_src = "../admin/eventImages/".$event_img;
								echo '<li>
									<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
										<img src="'.$img_src.'">
									</div>
									 <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
										<h6>'.$done_row['event_name'].'</h6>
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
			      <h3><i class="fa fa-calendar" style="font-size:36px"></i><strong> Upcoming Activities </strong><?php 
			        if ($cnt > 1){
			          echo '<h5><a href="dashboard_report_upcoming.php?id='.$id.'">SEE MORE</a></h5>';
			        }else{
			          echo "";
			        }
			      
			      ?></h3>
			      <div id="list-type" class="proerty-th">
			        <?php
			        while ($event_row = mysqli_fetch_array($event_data)){
			          $event_img = $event_row['event_img'];
			          if ($event_img == ""){
			            $img_src = "../admin/assets/n_event.png";
			          }else{
			            $img_src = "../admin/eventImages/".$event_img;
			          }
			          echo '<div class="col-sm-6 p0">
			                <div class="box-two proerty-item">
			                  <div class="item-thumb">
			                    <img src="'.$img_src.'" class="img_event_size">
			                  </div>
			                  <div class="item-entry overflow">
			                    <h5><a href="property-1.html">'.$event_row['event_name'].'</a></h5>
			                  <div class="dot-hr"></div>
			                    <span class="pull-left"><b> Date: </b>'.date("M d, Y h:i A", strtotime($event_row['event_start'])).'</span>
			                    <span class="pull-left"><b>Location: </b>'.$event_row['event_location'].'</span>
			                    <div class="property-icon">
			                      <button class="btn btn-success read"  data-target='.$event_row['event_id'].'>Read More</button>
			                      <button class="btn btn-danger pull-right editEvent"><a href="editEvent.php?num='.$event_row['event_id'].'">Edit Event</a></button>
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
						<div id='calendar' class='col-sm-12'></div>
					</div>
					<div class="col-md-4">
				        <h3><i class="fa fa-comments-o" style="font-size:24px"></i> Feedbacks</h3>
				        <?php 
					        if ($feedback_count > 1){
					          echo '<a href="dashboard_report_feedback.php?id='.$id.'">SEE MORE</a>';
					        }else{
					          echo "";
					        }
					      
					      ?>
				        <section id="comments" class="comments"> 
				          <?php
				          while($feedback_row = mysqli_fetch_array($feedback_data)){
				            $user_prof_pic = $feedback_row['user_prof_pic'];
				            $img_src = "../admin/userProfPic/".$user_prof_pic;
				             echo '<div class="row comment">
				              <div class="col-sm-3 col-md-2 text-center-xs">
				                <p>
				                  <img src="'.$img_src.'" class="img-responsive img-circle" alt="">
				                </p>
				              </div>
				              <div class="col-sm-9 col-md-10">
				                <strong><h5 class="text-uppercase">'.$feedback_row['first_name'].'</h5></strong>
				                <span class="posted"><i class="fa fa-clock-o"></i>'.date("M d, Y h:i A", strtotime($feedback_row['timestamp'])).'</span>
				                <p><i class="fa fa-commenting-o"></i>'.$feedback_row['event_comment'].'</p>
				              </div>
				            </div>';
				          }
				          ?>

				        </section>
				      </div>
					</div>
				</div>
			</div>
		</div>
		<!-- FOLLOWER MODAL! -->
					  <div id="viewFollow" class="modal fade bd-example-modal-lg" role="dialog">
					    <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					      <button type="button" class="close" data-dismiss="modal">&times;</button>
					      <h4><strong>Followers</strong></h4>
					      </div>
					      <div class="modal-body">
					      <div class="row">
					        <div class="col-xs-12" id="display_followers">
					          
					        </div>
					      </div> 
					      </div>
					      <div class="modal-footer">
					      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					    </div>
					  </div>
					  <!-- FOLLOWER MODAL -->
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
									<h3 class='glyphicon glyphicon-user'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="partnership"></span>
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
						</div>
							<div class="col-xs-12">	
								<div class="col-xs-6">
									<a class="prereg btn btn-info">View Pre-Registered Volunteers</a>
								</div>
								<div class="col-xs-6">
									<a class="volresources btn btn-warning">View Volunteered Resources</a>
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
	<!-- PARTNERSHIP MODAL -->
			<div id="partner_alert" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="partner_head">Partnership Request</h4>
					</div>
					<div class="modal-body">
						<center>You have <label id="partner_text"></label> the partnership</center>
						
					</div> 
				  </div>
				</div>
			  </div>
			</div>
	<!-- PARTNERSHIP MODAL -->
	</body>
</html>
<script>
	$(document).ready(function(){

		checkStatus();
		checkRequests();
		
		//partnership
		$(".accept").on("click", function(){
			var event_id = $(this).data("partner");
			var x = $.ajax({
				url: "reqPartnership.php",
				method: "POST",
				data:{
					id:event_id,
					status:'Accepted'
				},
				dataType: "json",
				success:function(retval){
					$("#partner_text").html("");
					if (retval == 1){
						var accept = "<label class='text-success'>ACCEPTED</label>";
						$("#"+event_id).remove();
						$("#partner_text").append(accept);
					}
					$("#partner_alert").modal("show");
				}
			});
			
			
		});
		$(".decline").on("click", function(){
			var event_id = $(this).data("partner");
			
			var x = $.ajax({
				url: "reqPartnership.php",
				method: "POST",
				data:{
					id:event_id,
					status:'Rejected'
				},
				dataType: "json",
				success:function(retval){
					$("#partner_text").html("");
					
					if (retval == 0){
						var decline = "<label class='text-danger'>DECLINED</label>";
						$("#"+event_id).remove();
						$("#partner_text").append(decline);
					}
					$("#partner_alert").modal("show");
				}
			});
			
			
		});
		$("#followers").on("click", function(){
			var user_id = $(this).data("target");
				$("#viewFollow").modal("show");	
				
				$.ajax({
					url:"getFollowers.php",
					method: "GET",
					data:{
						cid:user_id
					},
					dataType: "json",
					success:function(retval){
						$("#display_followers").html("");
						for(var i = 0; i<retval.length; i++){
							if (retval[i].user_prof_pic == ""){
								img_icon = '<div class="col-xs-3 col-sm-3"><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><img src="../admin/default.gif" class="prof_pic_icon"><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><p>'+retval[i].first_name+'</p></a></div>';
							}else{
								var img_icon = '<div class="col-xs-3 col-sm-3"><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><img src="../admin/userProfPic/'+retval[i].user_prof_pic+'" class="prof_pic_icon"></a><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><p>'+retval[i].first_name+'</p></a></div>';
							}
							$("#display_followers").append(img_icon);
						}
					}
					
				});
		});
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
function checkRequests() {
	var x=$.ajax({
		url: "checkRequests.php",
		method: "GET",
		dataType: "json",
		data: {id:<?php echo $id ?>},
		success: function(retval){
				for(var i=0; i<retval.length; i++){
					$("#"+retval[i].event_id+"").remove();
				}
		}
	});
	
}
function checkStatus(){
		var x =	$.ajax({
			url:"checkStatus.php",
			method: 'GET',
			data:{
				user_id: <?php echo $id ?>
			},
			dataType: "json",
			success:function(retval){
				
				if(retval[0] == 'Pending'){
					var stat = "<h3>Your account is still pending</h3>";
					$("#addevent").remove();
					$("#cannotadd").html(stat);
				}else if (retval[0] == 'Rejected'){
					var stat = "<h3>Your account is still rejected</h3>";
					$("#addevent").remove();
					$("#cannotadd").html(stat);
				}else{
					$("#addevent").show();
				}
			}

		});
		
}
function fetchData (event_id){
	
	var x = $.ajax({
			url:"getEvent.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",
			success:function(retval){
				$("#adv_target").html("");
				$("#event_img").html("");
				$("#event_location").html("");
				$("#event_title").html("");
				$("#event_description").html("");
				$("#event_start").html("");
				$("#event_material_req").html("");
				$("#event_occupation").html("");
				
				
				var start  = moment(retval[0].event_start).toDate();
					start_time = moment(start).format('MMMM DD YYYY h:mm A');
				
				event_img = "../admin/eventImages/"+retval[0].event_img;
				event_id = retval[0].event_id;
				event_location = retval[0].event_location;
				event_name = retval[0].event_name;
				event_description = retval[0].event_description;
				event_location = retval[0].event_location;
				event_start = start_time;
				event_material_req = retval[0].event_material_req;
				
				
				$("#event_img").attr("src", event_img);
				$("#event_location").append(event_location);
				$("#event_title").append(event_name);
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				
				
				
				$(".prereg").attr("href", "listPreRegistered.php?cid="+event_id);
				$(".volresources").attr("href", "list_VolResources.php?cid="+event_id);
				partnership(event_id);
				occupation(event_id);
				getAdv(event_id);
				initMap(event_location);
				
				$("#readmore").modal("show");
			}
				
		});
		
		
}
function partnership(event_id){
	$.ajax({
		url: "checkPartnership.php",
		method: "GET",
		data:{
			cid:event_id
		},
		dataType: "json",
		success: function(retval){
			console.log(retval);
		}
	});
}
function getAdv(event_id){
	$.ajax({
		url:"getAdv.php",
		method: "GET",
		data:{
			cid:event_id
		},
		dataType: "json",
		success:function(retval){
			console.log(retval);
			for(var i=0; i<retval.length; i++){
				var adv_icon = "<img src='../admin/advocaciesIcon/"+retval[i]+"' class='adv'>";
				$("#adv_target").append(adv_icon);
			}
		}
	});
}

function occupation(event_id){
	var x = $.ajax({
			url:"getOcc.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",
			success:function(retval){
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