
 <?php
    require ("../sql_connect.php");
    include ("Header_Organization.php");
    $id = $_SESSION['num'];
	
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
    $event_query ="SELECT * FROM event WHERE user_id =".$id." AND event_status = 'Upcoming'";
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
<!DOCTYPE html>
<html>
<head>
  <title>Your Profile</title>
  <style>
      .prof_pic_logo{
        height: 150px;
        width: 150px
        margin-left: 20px;
        border-radius: 50%;
      }
      .banner-color{
        /*background-color: #f9ef9f;*/
      }
      .adv{
      width: 40px;
      height: 40px;
      margin: 1px;
    }
  </style>

</head>
<body>

  <div class="banner-color" style="background-color:#f9ef9f;">
    <div class="col-md-12">  
     <div class="col-xs-6"> 

        <h2>Welcome <strong><?php echo $user_row['organization_name']; ?></strong></h2>

       <!--  Organization's logo -->
       <div class="col-md-4" id="">
           <?php echo "<img src='".$img_src."' class='prof_pic_logo'>"; ?>

       </div>


        <div class="col-md-4">
          <h6><strong>Address: </strong><?php echo $org_row['user_location'];?></h6>
          <h6><strong>Email: </strong><?php echo $org_row['email_address'];?></h6>
          <h4><strong>ADVOCACIES:</strong></h4>
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
        <div class="col-md-4">
            <h3><strong>Mission</strong></h3>
            <?php echo $user_row['organization_mission'];?>
            <h3><strong>Vision</strong></h3>
            <?php echo $user_row['organization_vision'];?>
        </div>
   </div>
</div>

  <div class="col-xs-12">
    <div class="col-xs-4">
     <h2><strong>Upcoming Activities</strong></h2>
    <div id="list-type" class="proerty-th">
         <?php
        while ($event_row =mysqli_fetch_array($event_data)){
          $event_img = $event_row['event_img']; 
          $img_src = "../admin/eventImages/".$event_img;
		  
          echo '<div class="col-sm-8 p0">
            <div class="box-two proerty-item">
                <div class="item-thumb">
                    <a href="#" ><img src ="'.$img_src.'"></a>
                </div>
                <div class="item-entry overflow">
                    <h5><a href="#">'.$event_row['event_name'].'</a></h5>
                    <div class="dot-hr"></div>
                    <div class="property-icon">
                     <button class="btn btn-success read"  id = "read" data-target='.$event_row['event_id'].'>Read More</button>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
	</div> 
</div>
    <div class="col-xs-4">
    <h2><strong>Recent Activities</strong></h2>
		<div id="list-type" class="proerty-th">
       <?php 
        while ($recent_row = mysqli_fetch_array($recent_data)){
              $event_img = $recent_row['event_img'];
              $img_src = "../admin/eventImages/".$event_img;
              echo '<div class="col-sm-8 p0">
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
						
						</div>
					</div>';
        }
      ?>
		</div>
	</div>
	<div class="col-xs-4">
    <div class="panel panel-default sidebar-menu wow fadeInRight animated">
      <div class="panel-heading">
          <h2><strong>Feedbacks</strong></h2>
        </div>
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
      					<h5 class="text-uppercase">'.$feedback_row['first_name'].'</h5>
      					<p class="posted"><i class="fa fa-clock-o"></i> '.date("M d, Y h:i A", strtotime($feedback_row['timestamp'])).'</p>
      					<p>'.$feedback_row['event_comment'].'</p>
      				</div>
      			</div>';
      		}
      		?>
      	</section>
      	</div>
      </div>
  </div>


        <!-- Add Feedback Modal -->
        <div id="feedbacksmodal" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
                  <p><strong>GIVE YOUR FEEDBACKS!</strong></p>
                </div>
                <div class="modal-body">
                  <textarea row="10" cols="70"id ="feedbacks" placeholder ="Type your comment here..."></textarea>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                
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
      $(".read").click(function(){
        var event_id = $(this).data("target");
        fetchData(event_id);
      }); 
      $(".feedbacks").click(function(){
        var event_id = $(this).data("id");
        console.log(event_id);
         $("#feedbacksmodal").modal("show");
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
          $("#event_description").html("");
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

  
</script>