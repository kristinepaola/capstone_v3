<?php
  require ("../sql_connect.php");
  include ('nameTitle.php');
  
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

  //display following
$follow_query = "SELECT * FROM follow WHERE volunteer_id = '$id'";
$follow_data = mysqli_query($sql, $follow_query);
  if (!$follow_data){
    echo "ERROR QUERY IN follow TABLE";
  }
$follow_count = mysqli_num_rows($follow_data);
//

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
  <title>Your Profile</title>

<?php
include ('css.php');
?>
<body>
<div class="content-area recent-property" style="background-color: #FFF;">
  <div class="container"> 
    <div class="row">
      <div class="section"> 
        <div id="list-type" class="proerty-th-list">
         <div class="col-md-4 p0">
         <div class="box-two proerty-item">
        <div class="item-thumb">
        <?php
        $name = $row['user_prof_pic'];
        $img_src = "../admin/userProfPic/" .$name; ?>

        <img src="<?php echo $img_src?>">
        </div>
        <div class="item-entry overflow">
            <h3><a href=""><?php echo $row['first_name']." ".$row['last_name']; ?> </a></h3>
            <div class="dot-hr"></div>
              <div class="col-sm-4">
                <span class="pull-left"><b> Location:</b> <?php echo $row['user_location']; ?></span><br>
                <span class="pull-left"><b> Birthday:</b> <?php echo $row2['volunteer_birthday']; ?></span><br>
                <span class="pull-left"><b> Occupation:</b> <?php echo $row2['volunteer_occupation']; ?></span><br>
                <span class="pull-left"><b> Schedule:</b> <?php echo $row2['volunteer_schedule']; ?></span><br>
                <span class="proerty-price pull-left"> Advocacies </span>
                <?php 
                $row = mysqli_fetch_array($disp_ad_data);
                
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
                //while ($row = mysqli_fetch_array($disp_ad_data)){
                  //echo $row['advocacies']." ";
                //}
              ?>
              </div>
                
                
                <span class="pull-left"><b> About Me:</b> <?php echo $row2['volunteer_about_me']; ?></span><br>
                <span class="pull-left"><b> Hobbies:</b> <?php echo $row2['volunteer_hobbies']; ?></span><br>
        </div>
        </div>
      </div>              
    </div>
    </div>
    </div>
  </div>
</div>
             
  <div class="row">
  </div>
  <div class="content-area recent-property padding-top-20" style="background-color: #FFF;">
    <div class="container">
      <div class="col-md-9">
        <div class="" id="contact1">
          <div class="row">
            <div class="col-md-6">
            <h2> UPCOMING ACTIVITIES </h2>
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
          </div>
            <div class="col-sm-5">
            <h2></i> RECENT ACTIVITIES </h2>
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
      </form>
      </div>
    </div>

  <div class="col-md-3 pl0 padding-top-2">
   <div class="blog-asside-right pl0">
     <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
      <div class="panel-body search-widget">
        <form action="" class=" form-inline"> 
       <div class="panel panel-default sidebar-menu wow fadeInRight animated">
         <div class="panel-heading">
          <h3 class="panel-title">Followed Organizations</h3>
         </div>
         <div class="panel-body recent-property-widget">
          <ul>
            <li>
            <?php 
        while($org=mysqli_fetch_array($follow_data)){
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
          
          echo '<li>
                  <div class="col-md-3 col-sm-2 col-xs-3 blg-thumb p0">
                    <img src="'.$img_src.'" class="following_icon" height="100" width="100">
                  </div>
                  <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                    <h6>
                    <a href="organization_profile_public.php?id='.$org['org_id'].'"> '.$orgname_row['first_name'].' </a></h6>
                  </div>
                </li>';
        }
      ?>
            </li>
          </ul>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


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

      </body>
  </html>
