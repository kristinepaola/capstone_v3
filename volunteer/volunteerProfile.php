<?php
  require ("../sql_connect.php");
  include ('nameTitle.php');
  include('css.php');
  $id = $_SESSION['num'];


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

    //select from event_preregistration
    $prereg_query = "SELECT * FROM event_preregistration WHERE user_id = '$id'";
    $prereg_data = mysqli_query ($sql, $prereg_query);
    if (!$prereg_data){
      echo "ERROR IN event_preregistration QUERY";    
    }

      $query = "SELECT * FROM user where user_id = $id";
      $data = mysqli_query($sql, $query);
      if (!$data)
      {
        echo "error";
      }
      //

    //display following with limit
    $followlimit_query = "SELECT * FROM follow WHERE volunteer_id = '$id' LIMIT 3";
    $followlimit_data = mysqli_query($sql, $followlimit_query);
      if (!$followlimit_data){
        echo "ERROR QUERY IN follow TABLE";
      }

    //
	
	//display following 
    $follow_query = "SELECT * FROM follow WHERE volunteer_id = '$id'";
    $follow_data = mysqli_query($sql, $follow_query);
      if (!$follow_data){
        echo "ERROR QUERY IN follow TABLE";
      }
    $follow_count = mysqli_num_rows($follow_data);

    // Display Recent Events
    $recent_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
                    FROM event_preregistration A, event B, user C
                    WHERE C.user_id = '$id'
                    AND A.event_id = B.event_id
                    AND A.user_id = C.user_id
                    AND B.event_status = 'Done'";
                      $recent_data = mysqli_query($sql, $recent_query);
                      if (!$recent_data){
                      echo "ERROR IN QUERY";
                      exit();
    }
  
    $row = mysqli_fetch_array($data);
    $volunteer_img = $row[13];
    $img_src = "../admin/userProfPic/".$volunteer_img;

    $vol = "SELECT * FROM volunteer_details WHERE user_id = $id";
    $data2 = mysqli_query($sql, $vol);
    $num_rows = mysqli_num_rows($data2);
  
  if (!$data2){
    echo "error";
  }else{

  $row2 = mysqli_fetch_array($data2);

  $disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";

  $advoc = mysqli_query($sql, $disp_ad_query);
    if (!$disp_ad_query){
      echo "Error in Query!";
      exit(); 
    }
  }

?>
<!DOCTYPE html>
  <html class="no-js">
  <title>iHelp | Volunteer Profile</title>

<html>
  <head>
    <style>
      .prof_pic_logo{
        height: 150px;
        width: 150px
        margin-left: 20px;
        border-radius: 50%;
      }
      .banner-color{s
        background-color: pink;
      }
      .adv{
      width: 40px;
      height: 40px;
      margin: 1px;
    }
    .star-rating {
    direction: rtl;
    display: inline-block;
    padding: 20px
    }

    .star-rating input[type=radio] {
        display: none
    }

    .star-rating label {
        color: #bbb;
        font-size: 18px;
        padding: 0;
        cursor: pointer;
        -webkit-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input[type=radio]:checked ~ label {
        color: #f2b600
    }
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
                         if($name == ""){
                          $img_src = "../admin/default.gif";
                        }else{
                        $img_src = "../admin/userProfPic/" .$name; }?>
                        <img src="<?php echo $img_src?>">
                          
                   </div>
                      <div class="dealer-content">
                        <div class="inner-wrapper">
                          <div class="clear">
                            <div class="col-xs-8 col-sm-8 ">
                              <h2 class="dealer-name">
                                  <h5>Welcome to your Profile!<h4><strong><?php echo $row['first_name']." ".$row['last_name']; ?></strong></h4></h5>
                              </h2>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default sidebar-menu">
                      <form action="" class=" form-inline"> 
                       <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                         <div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-heart-o" style="font-size:15px;"></i> FOLLOWING
						   <?php
							if($follow_count>3){
								echo '<h5>(<a id="following" data-target="'.$id.'" >'.$follow_count.'</a>)</h5></h3>';
							}else{
								echo "";
							}
						   ?>
						   
                         </div>
                         <div class="panel-body recent-property-widget">
                          <div class="col-xs-12 col-sm-12 ">
                            <?php 
                              while($org=mysqli_fetch_array($followlimit_data)){
                                $org_id = $org['org_id'];
                                $disp_query = "SELECT user_prof_pic FROM user WHERE user_id = '$org_id'";
                                $disp_data = mysqli_query($sql, $disp_query);
                                $icon = mysqli_fetch_array($disp_data);
                                $follower = $icon['user_prof_pic'];
                                $img_src = "../admin/userProfPic/".$follower;
                                $orgname_query = "SELECT first_name FROM user WHERE user_id = '$org_id'";
                                $orgname_data = mysqli_query($sql, $orgname_query);
                                $orgname_row = mysqli_fetch_array($orgname_data);
                                $org_name = $orgname_row['first_name'];
                                $org_profile = "SELECT * FROM user WHERE user_type = 'organization'";
                                $orgProf = mysqli_query($sql,$org_profile);
                                
                                echo '    <div class="col-xs-4 col-sm-4 ">
                                          <a href="../volunteer/organization_profile_public.php?id='.$org['org_id'].'"><img src="'.$img_src.'" class="following_icon" class="following_icon"></a>
                                          <a href="../volunteer/organization_profile_public.php?id='.$org['org_id'].'"> '.$orgname_row['first_name'].'</a><br>
                                          </div>
                                      
                                      ';
                              }
                            ?>
                         </div>
                        </div>
                      </div>
                      </form>
                    </div>
                  </aside>
                </div>
                <div class="item-entry overflow">
                   <div>
                         <b> LOCATION:</b><h5><?php echo $row['user_location']; ?></h5>
                      </div>
                      <div>
                        <b> BIRTHDAY:</b><h5><?php echo date("M d, Y ", strtotime($row2['volunteer_birthday'])) ?></h5>
                      </div>
                      <div>
                        <b> OCCUPATION:</b><h5><?php echo $row2['volunteer_occupation']; ?></h5>
                      </div>
                      
                      <h3 class="dealer-name">
                          <h5><strong>ABOUT ME</strong></h5>
                         <h5><?php echo $row2['volunteer_about_me']; ?></h5>   
                      </h3>
                       <h3 class="dealer-name">
                          <h5><strong>HOBBIES</strong></h5>
                         <h5><?php echo $row2['volunteer_hobbies']; ?></h5>   
                      </h3>
                      <br>
                      <br>
                    <div class="dealer-widget">
                          <div class="dealer-content">
                            <div class="inner-wrapper">
                              <div class="clear">
                                  <div>
                                      <h4><strong>ADVOCACIES:</strong></h4>
                                  </div>
                                  <div class="panel-body recent-property-widget">
                                      <?php 
                                        $row = mysqli_fetch_array($advoc);
                                        
                                        $exp = explode (', ', $row['advocacies']);
                                        $size = count($exp);
                                        while ($adv_row = mysqli_fetch_array($adv_data)){
										
                                        $adv_icon = $adv_row['advocacy_icon'];
                                        $img_src = "../admin/advocaciesIcon/".$adv_icon;
                                        for ($i=0; $i<$size; $i++){
                                          
                                            if ($exp[$i] == $adv_row['advocacy_name']){
                                              echo "<img src='".$img_src."' class='adv' height='60' width='60'>";
                                            }
                                          }
                                        }
                                        
                                      ?>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      <div class="col-md-4">
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
                            <div class="col-sm-6 p0">
                              <h3><i class="fa fa-calendar" style="font-size:36px"></i><strong>UPCOMING ACTIVITIES </strong>
                                <?php 
                                if ($cnt > 0){
                                  echo '<h5><a href="dashboard_report_upcoming.php?id='.$id.'">SEE MORE</a></h5>';
                                }
                                 ?>
                            </h3>
                        <div id="list-type" class="proerty-th">
                          <?php 
                              while($prereg_row = mysqli_fetch_array($prereg_data)){
                                //kuha event_id sa event para query sa event table
                                $event_id = $prereg_row['event_id'];
                                
                                //query event nga gi pre-register sa user
                                $curevent_query = "SELECT * FROM event WHERE event_id = '$event_id' AND event_status='Upcoming'";
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
                                  echo '<div class="col-sm-10 p0">
                                      <div class="box-two proerty-item">
                                        <div class="item-entry overflow">
                                        <div class="item-thumb">
                                          <img src="'.$img_src.'">
                                        </div>
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
		<div id="feedbacksmodal" class="modal fade" role="dialog" action="insert_feedback.php">
              <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                        <p><strong>GIVE YOUR FEEDBACKS!</strong></p>
                    
                    <div class="modal-body">
                        <textarea row="10" cols="70" id ="feedbacks" placeholder ="Type your comment here..."></textarea>
                      <div class="modal-footer"></div>
                    </div>
                      <!--Star Rating-->
                      <p><strong>Rate this Event:</strong></p>
                        <div class="star-rating">
                            <input id="star-5" class="star" type="radio" name="rating" value="5" id="excellent">
                            <label for="star-5" title="5 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" class="star" type="radio" name="rating" value="4" id="Very Good">
                            <label for="star-4" title="4 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-3" class="star" type="radio" name="rating" value="3" id="Good">
                            <label for="star-3" title="3 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-2" class="star" type="radio" name="rating" value="2" id="Fair">
                            <label for="star-2" title="2 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-1" class="star" type="radio" name="rating" value="1" id="Poor">
                            <label for="star-1" title="1 star">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div>
                           <button type="submit" class="btn btn-default" data-dismiss="modal" id="submit">Submit</button>
                        </div>
                  </div>
              </div>
            </div>
          </div>
                  <div class="col-sm-6">
                  <h3><i class="fa fa-calendar-check-o" style="font-size:36px"></i><strong>RECENT ACTIVITIES </strong>
                    <?php 
                        while ($recent_row = mysqli_fetch_array($recent_data)){
                          $event_img = $recent_row['event_img'];
                    $img_src = "../admin/eventImages/".$event_img;
                          echo '<div class="col-sm-12 p0">
                        <div class="box-two proerty-item">
                          <div class="item-thumb">
                          <img src="'.$img_src.'">
                          </div>
                            <div class="item-entry overflow">
                            <h5><a href="property-1.html">'.$recent_row['event_name'].'</a></h5>
                            <div class="dot-hr"></div>
                            <span class="pull-left"><b>Location: </b>'.$recent_row['event_location'].'</span> 
                            <span class="pull-left"><b> Date: </b>'.date("M d, Y h:i A", strtotime($recent_row['event_start'])).'</span>
                              
                        </div>
                          <div class="property-icon">
                          <button class="btn btn-success feedbacks"  class="feedbacks" data-id='.$recent_row['event_id'].'>Give Feedbacks</button>
                          </div>
                        </div>
                        </div>';
                    }
                  ?>
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
				<!-- FOLLOWER MODAL! -->
					  <div id="viewFollow" class="modal fade bd-example-modal-lg" role="dialog">
					    <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					      <button type="button" class="close" data-dismiss="modal">&times;</button>
					      <h4><strong>Following</strong></h4>
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
    </body>
  </head>
</html>


</html>
        <script src="assets/js/modernizr-2.6.2.min.js"></script>

        <script src="assets/js/jquery-1.10.2.min.js"></script> 
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>

        <script src="assets/js/icheck.min.js"></script>
        <script src="assets/js/price-range.js"></script>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="assets/js/gmaps.js"></script>        
        <script src="assets/js/gmaps.init.js"></script>

        <script src="assets/js/main.js"></script>

<script>
  $(document).ready(function(){
      $(".read").click(function(){
        var event_id = $(this).data("target");
        fetchData(event_id);
      }); 
       $(".feedbacks").click(function(){
        var event_id = $(this).data("id");
        
         $("#feedbacksmodal").modal("show");

         submitFeedback(event_id);
      });
	  		$("#following").on("click", function(){
			var user_id = $(this).data("target");
				$("#viewFollow").modal("show");	
				
				$.ajax({
					url:"getFollowing.php",
					method: "GET",
					data:{
						cid:user_id
					},
					dataType: "json",
					success:function(retval){
						$("#display_followers").html("");
						for(var i = 0; i<retval.length; i++){
							if (retval[i].user_prof_pic == ""){
								img_icon = '<div class="col-xs-3 col-sm-3"><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><img src="../admin/default.gif" class="prof_pic_icon"><a href="organization_profile_public.php?id='+retval[i].org_id+'"><p>'+retval[i].first_name+'</p></a></div>';
							}else{
								var img_icon = '<div class="col-xs-3 col-sm-3"><a href="volunteerProfile.php?id='+retval[i].volunteer_id+'"><img src="../admin/userProfPic/'+retval[i].user_prof_pic+'" class="prof_pic_icon"></a><a href="organization_profile_public.php?id='+retval[i].org_id+'"><p>'+retval[i].first_name+'</p></a></div>';
							}
							$("#display_followers").append(img_icon);
						}
					}
					
				});
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
  function submitFeedback(event_id){
    var id = event_id;


      <!--pag tawag sa modal-->
      $("#submit").on("click", function(){
      
      var eventFeedback = $("#feedbacks").val();
      var rating = $('input[name="rating"]:checked').val()
		console.log(rating);

     var feedback = {
      ev_id:id,
      event_rating: rating,
      event_comment: eventFeedback,
      user_id: 2
     };

     console.log(feedback);
     var x = $.ajax({
        url: "insertFeedback.php",
        data: feedback,
        method: "POST",
        dataType: "json",
        success: function(json){
          console.log(json);
        }
     })

     console.log(x);

  });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>   

  
</script>