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
          ";
  $cnt_data = mysqli_query($sql, $cnt_query);
  if (!$cnt_data){
    echo "ERROR IN QUERY 4";
    exit();
  }
  $cnt = mysqli_num_rows($cnt_data);
  //display past events
  $past_query = "SELECT * FROM event WHERE user_id = ".$org_id." AND event_status = 'Done' LIMIT 5";
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
                                 while ($event_row = mysqli_fetch_array($event_data)){
                                $event_img = $event_row['event_img'];
                                if ($event_img == ""){
                                  $img_src = "../admin/assets/img/default_event.png";
                                }else{
                                  $img_src = "../admin/eventImages/".$event_img;
                                }
                                  echo '<div class="col-sm-10 p0">
                                      <div class="box-two proerty-item">
                                        <div class="item-entry overflow">
                                        <div class="item-thumb">
                                          <img src="'.$img_src.'">
                                        </div>
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
          </div> 
          </div>
          <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

        </div>
      </div>
      <!-- END OF READ MORE MODAL -->
                           <!-- Recent Modal -->
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
                        while ($recent_row = mysqli_fetch_array($past_data)){
                          $event_img = $recent_row['event_img'];
                          if ($event_img == ""){
                            $img_src = "../admin/assets/img/default_event.png";
                          }else{
                            $img_src = "../admin/eventImages/".$event_img;
                          }
                          echo '<div class="col-md-4 p0">
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
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
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
        url:"../Organization/getEvent.php",
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
      var rating = 5;
      

     var feedback = {
      ev_id:id,
      event_rating: rating,
      event_comment: eventFeedback,
      user_id: 2
     };

     console.log(feedback);
     var x = $.ajax({
        url: "../Organization/insertFeedback.php",
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>   

  
</script>
