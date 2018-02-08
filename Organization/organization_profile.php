<?php
    require ("../sql_connect.php");
    include ("Header_Organization.php");
    $id = $_SESSION['num'];

    //query for upcoming    
    $query= "SELECT * FROM event 
            WHERE user_id = ".$id." AND event_status = 'Upcoming'
            LIMIT 4";
    $data = mysqli_query($sql, $query);
    if (!$data){
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
    //for cnt nga recent activity
    $cnt_recent_query = "SELECT * FROM event 
            WHERE user_id = ".$id." AND event_status = 'Happening Now'
            ";
    $cnt_recent_data = mysqli_query($sql, $cnt_recent_query);
    if (!$cnt_recent_data){
      echo "ERROR IN QUERY 4";
      exit();
    }
    $cnt_recent = mysqli_num_rows($cnt_recent_data);


  //GET FEEDBACKS
  $feedback_query = "SELECT A.event_name, B.first_name, C.org_id, C.event_comment, B.user_prof_pic, C.timestamp
                    FROM event A, user B, event_feedback C
                    WHERE B.user_id = C.user_id
                    AND B.user_type = 'volunteer' 
                    AND C.org_id = '$id' 
                    AND A.event_id = C.event_id 
                    ";
  $feedback_data = mysqli_query($sql, $feedback_query);
  
  
  //karaan
    //display Upcoming Events
    $event_query ="SELECT * FROM event WHERE user_id =".$id." AND event_status = 'Upcoming' LIMIT 4";
    $event_data = mysqli_query($sql, $event_query);


    ////Organization's Profile Logo and Details
    $org_profile_query ="SELECT * FROM user WHERE user_id=".$id."";
    $org_profile_data = mysqli_query($sql, $org_profile_query);
      if(!$org_profile_data){
        echo "ERROR IN QUERY 2";
      }
      $org_row = mysqli_fetch_array($org_profile_data);

	// Display Recent Events
	$recent_query = "SELECT * FROM event WHERE user_id = ".$id." AND event_status = 'DONE'";
	$recent_data = mysqli_query($sql, $recent_query);
	if (!$recent_data){
	  echo "ERROR IN QUERY 3";
	  exit();
	}
    ///display advocacy sa user
    $disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";
    $disp_ad_data = mysqli_query($sql, $disp_ad_query);
        if (!$disp_ad_query){
      echo "Error in Query! 4";
      exit(); 
    }


    //advocacies para sa compare sa ubos    
    $adv_query = "SELECT * FROM advocacies";
    $adv_data = mysqli_query($sql, $adv_query);
    if (!$adv_data){
      echo "ERROR IN QUERY 5";
    }

    
?>
<html>
  <head>
    <title>Organization Profile</title>
    <style>
        .prof_pic_logo{
          height: 150px;
          width: 150px
          margin-left: 20px;
          border-radius: 50%;
        }
        .banner-color{
          background-color: pink;
        }
        .adv{
        width: 40px;
        height: 40px;
        margin: 1px;
      }
    </style>
    <body>
      <div class="content-area recent-property" ></div>
        <div class="container"> 
          <div class="row">
            <div id="list-type" class="proerty-th-list">
              <div class="col-md-12 p0">
                <div class="col-sm-4">
                  <aside class="sidebar sidebar-property blog-asside-left">
                    <div class="dealer-widget">
                      <div class="item-thumb">
                      <h2>
                        <?php
                        $name = $row['user_prof_pic'];
                        $img_src = "../admin/userProfPic/" .$name; ?>
                        <img src="<?php echo $img_src?>">
                   </div>
                      <div class="dealer-content">
                        <div class="inner-wrapper">
                          <div class="clear">
                            <div class="col-xs-8 col-sm-8 ">
                              <h2 class="dealer-name">
                                <h2><strong><?php echo $org_row['first_name']; ?></strong><h2>
                                  <h5>Welcome to your Profile</h5>
                              </h2>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default sidebar-menu">
                      <div>
                          <h4><strong>Advocacies:</strong></h4>
                      </div>
                      <div class="panel-body recent-property-widget">
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
                          ?>
                      </div>
                  </aside>
                </div>
                <div class="item-entry overflow">
                  <div class="dot-hr"></div>
                  <div>
                       <h3><strong>Address: </strong><h4><?php echo $org_row['user_location'];?></h4></3>
                    </div>
                    <div>
                      <h3><strong>Email: </strong><h4><?php echo $org_row['email_address'];?></h4></3>
                      </div>

                      <div class="col-md-4">
                        <div class="dealer-widget">
                          <div class="dealer-content">
                            <div class="inner-wrapper">
                              <div class="clear">
                                  <h3 class="dealer-name">
                                    <h4><strong>Mission</strong></h4>
                                    <h4><?php echo $user_row['organization_mission'];?></h4>   
                                  </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="dealer-widget">
                          <div class="dealer-content">
                            <div class="inner-wrapper">
                              <div class="clear">
                                  <h3 class="dealer-name">
                                    <h4><strong>Vision</strong></h4>
                                    <h4><?php echo $user_row['organization_vision'];?></h4>  
                                  </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 </div>
               </div>
            <div class="content-area recent-property" ></div>
              <div class="container"> 
                <div class="row">
                  <div id="list-type" class="proerty-th-list">
                    <div class="col-sm-12 p0">
                      <div class="item-entry overflow pull-left">
                        <div class="dot-hr"></div>
                          <div class="col-md-12">
                            <div class="col-sm-9 p0">
                        <h3><i class="fa fa-calendar" style="font-size:36px"></i><strong>UPCOMING ACTIVITIES </strong><?php 
                          if ($cnt > 4){
                            echo '<h5><a href="dashboard_report_upcoming.php?id='.$id.'">SEE MORE</a></h5>';
                          }
                        ?></h3>
                        <div id="list-type" class="proerty-th">
                          <?php
                          while ($event_row = mysqli_fetch_array($event_data)){
                            $event_img = $event_row['event_img'];
                            if ($event_img == ""){
                              $img_src = "../admin/assets/img/default_event.png";
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
                          <br/>
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
                  <div class="col-sm-3">
                   <div class="blog-asside-right pl0">
                     <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                       <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                         <div class="panel-heading">
                          <h3><i class="fa fa-comments-o" style="font-size:36px"></i><strong>Feedbacks</strong></h3>
                          <?php 
                            if ($cnt > 1){
                              echo '<a href="dashboard_report_feedback.php?id='.$id.'">SEE MORE</a>';
                            }else{
                              echo "";
                            }
                          
                          ?>
                         </div>
                          <section id="comments" class="comments"> 
                                <?php
                                while($feedback_row = mysqli_fetch_array($feedback_data)){
                                  $user_prof_pic = $feedback_row['user_prof_pic'];
                                  $img_src = "../admin/userProfPic/".$user_prof_pic;
                                   echo '<div class="row comment">
                                    <div class="col-sm-3 col-md-2 text-center-xs">
                                      <p>
                                        <img src="'.$img_src.'" class="img-responsive img-rectangle" height="75 px" width="75 px">
                                      </p>
                                    </div>
                                    <div class="col-sm-9 col-md-10">
                                      <h5 class="text-uppercase"><strong>'.$feedback_row['first_name'].'</strong></h5>
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
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <div class="col-md-9">
        <div class="col-md-12">
          <h3><i class="fa fa-calendar-check-o" style="font-size:36px"></i><strong>RECENT ACTIVITIES </strong><?php 
                          if ($cnt_recent > 1){
                            echo '<h5><a href="dashboard_report_recent.php?id='.$id.'">SEE MORE</a></h5>';
                          }
                        ?></h3>
            <div id="list-type" class="proerty-th">
              <?php
              while ($recent_row = mysqli_fetch_array($recent_data)){
                $event_img = $recent_row['event_img'];
                if ($event_img == ""){
                  $img_src = "../admin/assets/img/default_event.png";
                }else{
                  $img_src = "../admin/eventImages/".$event_img;
                }
                echo '<div class="col-md-6 p0">
                      <div class="box-two proerty-item">
                        <div class="item-thumb">
                          <img src="'.$img_src.'" class="img_event_size">
                        </div>
                        <div class="item-entry overflow">
                          <h5>'.$recent_row['event_name'].'</h5>
                        <div class="dot-hr"></div>
                          <span class="pull-left"><b> Date: </b>'.date("M d, Y h:i A", strtotime($recent_row['event_start'])).'</span>
                          <span class="pull-left"><b>Location: </b>'.$recent_row['event_location'].'</span>
                          <div class="property-icon">
                            
                          </div>
                        </div>
                      </div>
                    </div>';
              }
              ?>
            </div>
          </div>
          </div>
        </div>
          
           
     
    </body>
  </head>
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
				occupation(event_id);
				getAdv(event_id);
				initMap(event_location);
				
				$("#readmore").modal("show");
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
