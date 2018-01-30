<?php
require ("../sql_connect.php");
  session_start();
  $id =  $_SESSION['num'];
  $query = "SELECT * FROM user WHERE user_id = '$id'";
  $data = mysqli_query($sql, $query);
  if (!$data){
    echo "error";
  }
  $row = mysqli_fetch_array($data);
  $volunteer_img = $row['user_prof_pic'];
  $img_src = "../admin/userProfPic/".$volunteer_img;

	
?>
<html>
<head>  
   <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
          <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
          <link rel="icon" href="favicon.ico" type="image/x-icon">

          <link rel="stylesheet" href="../assets/css/normalize.css">
          <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
          <link rel="stylesheet" href="../assets/css/fontello.css">
          <link href="../assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
          <link href="../assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
          <link href="../assets/css/animate.css" rel="stylesheet" media="screen">
          <link rel="stylesheet" href="../assets/css/bootstrap-select.min.css">
          <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="../assets/css/icheck.min_all.css">
          <link rel="stylesheet" href="../assets/css/price-range.css">
          <link rel="stylesheet" href="../assets/css/owl.carousel.css">
          <link rel="stylesheet" href="../assets/css/owl.theme.css">
          <link rel="stylesheet" href="../assets/css/owl.transitions.css">
          <link rel="stylesheet" href="../assets/css/style.css">
          <link rel="stylesheet" href="../assets/css/responsive.css">
		  
		  <link rel="stylesheet" href="../assets/css/webportal.css">

  <nav class="navbar navbar-default ">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
               <div class="navbar-header">
                <a class="navbar-brand" href="nameTitle.php"><img src="../assets/img/iHelplogo.png" height="48px" width="149px" alt=""></a>
            </div>
          </div>

              <div class="collapse navbar-collapse yamm" id="navigation">
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="volunteerHome.php">Home</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="events.php">Event</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="organizations.php">Organization</a></li>
                           <li align="right" class="wow fadeInDown" data-wow-delay="0.1s">
                          </li>
            <li class="dropdown ymm-sw" data-wow-delay="0.1s">
                            <a href="organization_profile.php" data-toggle="dropdown" data-hover="dropdown"   data-delay="200">
                
                <?php
									if ($volunteer_img == ""){
										echo '<img src="../admin/default.gif" class="prof_pic_icon" >';
										echo $row['first_name'];
									}else{
										echo '<img src="'.$img_src.'" class="prof_pic_icon">';
										echo $row['first_name'];
									}
								?>

              <b class="caret"></b></a>
                            <ul class="dropdown-menu navbar-nav">
                                <li>
                                    <a href="volunteerProfile_1.php?<?php echo $id; ?>">My Profile</a>
                                </li>
								<li>
                                    <a href="editProfile.php">Edit Profile</a>
                                </li>
								<li>
                                    <a href="#">Volunteered Resources</a>
                                </li>
                                <!--<li>
                                    <a href="#">View Reports</a>
                                </li>-->
                                <li>
                                    <a href="../logout.php">Log Out</a>
                                </li>
                            </ul>
                </li>
                    </ul>
                </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>
  <!-- End of nav bar -->
</head>
</html>

<script src="../assets/js/modernizr-2.6.2.min.js"></script>

<script src="../assets/js/jquery-1.10.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-select.min.js"></script>
<script src="../assets/js/bootstrap-hover-dropdown.js"></script>

<script src="../assets/js/easypiechart.min.js"></script>
<script src="../assets/js/jquery.easypiechart.min.js"></script>

<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/wow.js"></script>

<script src="../assets/js/icheck.min.js"></script>
<script src="../assets/js/price-range.js"></script>

<script src="../assets/js/main.js"></script>

<script src='../fullcalendar/lib/jquery.min.js'></script>
<script src='../fullcalendar/lib/moment.min.js'></script>
<script src='../fullcalendar/fullcalendar.min.js'></script>
<script src='../bootstrap/js/bootstrap.min.js'></script>

