 <?php
    require ("../sql_connect.php");
    include ("nameTitle.php");
    $org_id = $_GET['id'];
	
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
	$past_query = "SELECT * FROM event WHERE user_id = ".$org_id." AND event_status = 'Done'";
	$past_data = mysqli_query($sql, $past_query);
	if (!$past_data){
		echo "ERROR IN QUERY 5";
		exit();
	}

	?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $org_row['organization_name'] ?></title>
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
  </style>

</head>
<body>

  <div class="banner-color">
    <div class="col-md-12">  
     <div class="col-md-8"> 

        <h2><strong><?php echo $org_row['organization_name']; ?></strong></h2>

       <!--  Organization's logo -->
       <div class="col-md-4" id="">
           <?php echo "<img src='".$img_src."' class='prof_pic_logo'>"; ?>

       </div>


        <div class="col-md-4">
          <h6><strong>Address: </strong><?php echo $org_row['user_location'];?></h6>
          <h6><strong>Email: </strong><?php echo $org_row['email_address'];?></h6>
          <h4><strong>ADVOCACIES:</strong></h4>
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
          

       <!--  //advocacies -->
      </div>
        <div class="col-md-4">
            <h3><strong>Mission</strong></h3>
            <?php echo $org_row['organization_mission'];?>
            <h3><strong>Vision</strong></h3>
            <?php echo $org_row['organization_vision'];?>
        </div>
   </div>
</div>

<div class="col-md-12">
  <div class="col-md-12">
    			<h3><strong>UPCOMING ACTIVITIES</strong> <?php 
				if ($cnt > 4){
					echo '<a href="moreEvents.php?id=<?php echo $id?>">(SEE MORE)</a>';
				}else{
					echo "";
				}
			
			?></h3>
    <div id="list-type" class="proerty-th">
         <?php
        while ($event_row =mysqli_fetch_array($event_data)){
          $event_img = $event_row['event_img']; 
          $img_src = "../admin/eventImages/".$event_img;
          echo '<div class="col-sm-3 p0">
            <div class="box-two proerty-item">
                <div class="item-thumb">
                    <a href="#" ><img src ="'.$img_src.'"></a>
                </div>
                <div class="item-entry overflow">
                    <h5>wefawe<a href="#">'.$event_row['event_name'].'</a></h5>
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
</div>
  <div class="col-md-12">
    <h2><strong>Recent Activities</strong></h2>
		<div id="list-type" class="proerty-th">
       <?php 
        while ($recent_row = mysqli_fetch_array($past_data)){
              $event_img = $recent_row['event_img'];
              $img_src = "../admin/eventImages/".$event_img;
              echo '<div class="col-sm-3 p0">
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
	<div class="col-xs-12">
	<h2><strong>Feedbacks</strong></h2>
	<div class="col-xs-4">
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
                            <input id="star-5" type="radio" name="excellent" value="star-5" id="excellent">
                            <label for="star-5" title="5 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" type="radio" name="Very Good" value="star-4" id="Very Good">
                            <label for="star-4" title="4 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-3" type="radio" name="Good" value="star-3" id="Good">
                            <label for="star-3" title="3 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-2" type="radio" name="Fair" value="star-2" id="Fair">
                            <label for="star-2" title="2 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-1" type="radio" name="Poor" value="star-1" id="Poor">
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
      var rating = 5;
      

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