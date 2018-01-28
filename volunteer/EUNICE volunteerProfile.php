<?php
	require ("../sql_connect.php");
	include ('nameTitle.php');
	
	//select from event_preregistration
	$prereg_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
	FROM event_preregistration A, event B, user C
	WHERE C.user_id = '$id'
	AND A.event_id = B.event_id
	AND A.user_id = C.user_id";
	$prereg_data = mysqli_query ($sql, $prereg_query);
	if (!$prereg_data){
		echo "ERROR IN event_preregistration QUERY";		
	}
	
	//display following
	$follow_query = "SELECT A.user_id, B.user_id, D.first_name, D.last_name, B.organization_name, E.user_prof_pic
	FROM volunteer_details A, organization_details B, follow C, user D, user E
	WHERE volunteer_id = '$id'
	AND C.volunteer_id = A.user_id 
	AND C.org_id = B.user_id
	AND D.user_id = A.user_id
	AND E.user_id = B.user_id";
	$follow_data = mysqli_query($sql, $follow_query);
		if (!$follow_data){
			echo "ERROR QUERY IN follow TABLE";
		}
	$follow_count = mysqli_num_rows($follow_data);
	
	//display advocacies
	$useradv_query = "SELECT A.advocacy_name, A.advocacy_icon, B.user_id, B.first_name, B.advocacies
					FROM advocacies A, user B
					WHERE B.user_type = 'volunteer' AND B.user_id = '$id'";
	$useradv_data = mysqli_query ($sql, $useradv_query);
  
	
	//select from event_preregistration
	$prereg_query = "SELECT A.event_id, A.user_id, B.event_name, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
	FROM event_preregistration A, event B, user C
	WHERE C.user_id = '$id'
	AND A.event_id = B.event_id
	AND A.user_id = C.user_id
	AND B.event_status = 'Upcoming'";
	$prereg_data = mysqli_query ($sql, $prereg_query);
	if (!$prereg_data){
		echo "ERROR IN event_preregistration QUERY";		
	}

  
  //karaan
  $query = "SELECT * FROM user where user_id = $id";
  $data = mysqli_query($sql, $query);
  if (!$data)
  {
    echo "error";
  }
  
		$row = mysqli_fetch_array($data);
		$volunteer_img = $row['user_prof_pic'];
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
  <head>
  <title>Your Profile</title>
	<style>
	.adv{
		width: 40px;
		height: 40px;
		margin: 1px;
	}
	</style>
  </head>
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
        $img_src = "admin/userProfPic/" .$name; ?>

        <img src="<?php echo $img_src?>" height="100" width="100">
        </div>
        <div class="item-entry overflow">
            <h3><a href=""><?php echo $row['first_name']." ".$row['last_name']; ?> </a></h3>
            <div class="dot-hr"></div>
              <div class="col-sm-4">
                <span class="pull-left"><b> Location:</b> <?php echo $row['user_location']; ?></span><br>
                <span class="pull-left"><b> Birthday:</b> <?php echo $row2['volunteer_birthday']; ?></span><br>
                <span class="pull-left"><b> Occupation:</b> <?php echo $row2['volunteer_occupation']; ?></span><br>
                <span class="pull-left"><b> Schedule:</b> <?php echo $row2['volunteer_schedule']; ?></span><br>
                <a href='editProfile.php?vol_id=<?php echo $row['user_id'];?>'>Edit</a>
              </div>
                <span class="proerty-price pull-right"> Advocacies </span>
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
                <form>
                <span class="pull-left"><b> About Me:</b> <?php echo $row2['volunteer_about_me']; ?></span><br></form>
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
  <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
    <div class="container">
      <div class="col-md-9">
        <div class="" id="contact1">
          <div class="row">
            <?php
			
			?>
			<div class="col-md-6">
				<h2> UPCOMING ACTIVITIES </h2>
				<?php
				while($prereg_row = mysqli_fetch_array($prereg_data)){
				$event_img = $prereg_row['event_img'];
				$img_src = "../admin/eventImages/".$event_img;
				echo '<img src="'.$img_src.'" alt="'.$prereg_row['event_name'].'" width="250" height="250">
						<p><h3>'.$prereg_row['event_name'].'</h3></p>
						<button class="btn btn-success read"  data-target='.$prereg_row['event_id'].'>Read More</button>';				
				}
				?>

			</div>
			<div class="col-sm-5">
				<h2></i> RECENT ACTIVITIES </h2>
				<img src="uploads/feeding.png" alt="feeding" width="170" height="170">
				<p><strong>Feeding Program</strong></p>
				<p> Location: Brgy. Kasambagan </p>
				<p> Date: June 29, 2017 </p>
				<img src="uploads/treePlanting.png" alt="tree planting" width="170" height="170">
				<p><strong> Tree Planting </strong> </p>
				<p> Location: Brgy. Talamban </p>
				<p> Date: April 15, 2017 </p>
				</p>
			</div>
      </div>
      </form>
      </div>
    </div>

  <div class="col-md-3 pl0 padding-top-40">
   <div class="blog-asside-right pl0">
     <div class="panel panel-default sidebar-menu" >
      <div class="panel-body search-widget">
        <form action="" class=" form-inline"> 
       <div class="panel panel-default sidebar-menu">
         <div class="panel-heading">
          <h3 class="panel-title">Followed Organizations (<a id=""><?php echo $follow_count ?></a>)</h3>
         </div>
         <div class="panel-body recent-property-widget">
          <ul>
            <?php
			while($row=mysqli_fetch_array($follow_data)){
			$org_id = $row[1];
			$follower = $row['user_prof_pic'];
			$img_src = "../admin/userProfPic/".$follower;				
			echo '<li>
				<div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
					<a href="single.html"><img src="'.$img_src.'"></a>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
					<h6> <a href="organization_profile_public.php?id='.$org_id.'">'.$row['organization_name'].' </a></h6>
				</div>
			</li>';	
			}			
			?>
          </ul>
          </div>
        </div>
      </div>
    </div>
  </div>           
</div>
</body>
</html>
