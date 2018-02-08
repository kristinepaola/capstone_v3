 <?php
    require ("../sql_connect.php");
    include ("nameTitle.php");
    $org_id = $_GET['id'];

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
  
  //GET FEEDBACKS
  $feedback_query = "SELECT A.event_name, B.first_name, C.org_id, C.event_comment, B.user_prof_pic, C.timestamp
  FROM event A, user B, event_feedback C
  WHERE B.user_id = C.user_id
  AND B.user_type = 'volunteer' 
  AND C.org_id = '$org_id' 
  AND A.event_id = C.event_id
  ";
  $feedback_data = mysqli_query($sql, $feedback_query);
  
  //org details query
  $org_query = "SELECT B.organization_name, A.user_prof_pic, A.email_address, A.user_location, A.advocacies, B.organization_mission, B.organization_vision, C.advocacy_name, C.advocacy_icon  
  FROM user A, organization_details B, advocacies C
  WHERE A.user_id = '$org_id'
  AND A.user_id = B.user_id";
  
  $org_data = mysqli_query($sql, $org_query);
  $org_row = mysqli_fetch_array($org_data);
  $org_icon = $org_row['user_prof_pic'];
    $img_src = "../admin/userProfPic/".$org_icon;
  
  // display events status = upcoming
  $event_query = "SELECT * FROM event 
          WHERE user_id = ".$org_id." AND event_status = 'Upcoming'
          LIMIT 4
          ";
  $event_data = mysqli_query($sql, $event_query);
  if (!$event_data){
    echo "ERROR IN QUERY 4";
    exit();
  }
  
  //for cnt nga upcoming
  $cnt_query = "SELECT * FROM event 
          WHERE user_id = ".$org_id." AND event_status = 'Upcoming'
          LIMIT 4";
  $cnt_data = mysqli_query($sql, $cnt_query);
  if (!$cnt_data){
    echo "ERROR IN QUERY 4";
    exit();
  }
  $cnt = mysqli_num_rows($cnt_data);
  //display past events
  $past_query = "SELECT * FROM event WHERE user_id = ".$org_id." AND event_status = 'Done' LIMIT 4";
  $past_data = mysqli_query($sql, $past_query);
  if (!$past_data){
    echo "ERROR IN QUERY 5";
    exit();
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
      .prof_pic_logo{
        height: 150px;
        width: 150px
        margin-left: 20px;
        
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
                                
                                  <h5>Welcome to <strong><?php echo $org_row['organization_name']; ?></strong> Public Profile</h5>
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
                            while ($row = mysqli_fetch_array($org_data)){
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
                                    <h4><?php echo $org_row['organization_mission'];?></h4>   
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
                                    <h4><?php echo $org_row['organization_vision'];?></h4>  
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
                          if ($cnt > 1){
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
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                          }
                          ?>
                          <br/>
                        </div>
                      </div>
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
                                <?php
                                  if ($cnt > 2){
                                    echo '<a href="report_feedbackprofile.php?id='.$id.'">SEE MORE</a>';
                                  }else{
                                    echo "";
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
          <h3><i class="fa fa-calendar-check-o" style="font-size:36px"></i><strong>RECENT ACTIVITIES </strong>
            <?php 
                          if ($cnt_recent > 1){
                            echo '<h5><a href="dashboard_report_recent.php?id='.$id.'">SEE MORE</a></h5>';
                          }
            ?></h3>
            <div id="list-type" class="proerty-th">
              <?php
              while ($recent_row = mysqli_fetch_array($past_data)){
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

                            <button class="btn btn-success feedbacks"  class="feedbacks" data-id='.$recent_row['event_id'].'>Give Feedbacks</button>
              
                            
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
              <div id="feedbacksmodal" class="modal fade" role="dialog" action="insert_feedback.php">
              <div class="modal-dialog">
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
              <br>
              <a class="volresources">Volunteer Resources</a>
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
  </head>
</html>
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




  }); 


    // UPCOMING ACTIVITIES
  function fetchData (event_id){
    $.ajax({
        url:"getEvent.php",
        method: "GET",
        data:{
          cid:event_id
        },

        dataType: "json",

        success:function(retval){

          $("#event_img").html("");
          $("#event_title").html("");
          $(" #event_description").html("");
          $("#event_start").html("");
          $("#event_material_req").html("");

          event_img = "../admin/eventImages/"+retval[0].event_img;
          event_id = retval[0].event_id;
          event_name = retval[0].event_name;
          event_description = retval[0].event_description;
          event_location = retval[0].event_location;
          event_start = retval[0].event_start;
          event_material_req = retval[0].event_material_req;
            
        
        $("#event_img").attr("src", event_img);
        $("#event_title").append(event_name);
        $("#event_description").append(event_description);
        $("#event_start").append(event_start);
        $("#event_material_req").append(event_material_req);
        $("#readmore").modal("show");   
        }  
    });
  }


  
        // RECENT ACTIVITIES

  

  function submitFeedback(event_id){
    var id = event_id;


      <!--pag tawag sa modal-->
      $("#submit").on("click", function(){
      
      var eventFeedback = $("#feedbacks").val();
      var rating = $(".star").val();
      

     var feedback = {
      ev_id:id,
      event_rating: rating,
      event_comment: eventFeedback,
      user_id: 2
     };

     console.log(feedback);
     var x = $.ajax({
        url: "../volunteer/insertFeedback.php",
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
