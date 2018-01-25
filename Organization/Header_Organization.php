<?php
session_start();
include('../sql_connect.php');

$id = $_SESSION['num'];
$query = "SELECT * FROM user where user_id = ".$id."";
$data = mysqli_query ($sql, $query);
if (!$data){
    echo "ERROR IN QUERY";
    exit();
}
$row = mysqli_fetch_array($data);
$user_prof_pic = $row['user_prof_pic'];

$user_query = "SELECT * FROM organization_details where user_id = ".$id."";

$user_data = mysqli_query ($sql, $user_query);
if (!$user_data){
	echo "ERROR IN QUERY";
	exit();
}
$user_row = mysqli_fetch_array($user_data);
$img_src = "../admin/userProfPic/".$user_prof_pic;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="company is a real-estate template">
        <meta name="author" content="Kimarotec">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

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
		
		
		<!-- date range picker -->
		<link rel="stylesheet" href="../daterangepicker/daterangepicker.css">
		
		

		
    </head>
    <body>
        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="organization_dashboard" href="organization_dashboard.php">Home</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="events.php">Event</a></li>
						<li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="organizations.php">Organization</a></li>
						
						
						
						<li class="dropdown ymm-sw" data-wow-delay="0.1s">
                            <a href="organization_profile.php" data-toggle="dropdown" data-hover="dropdown" 	data-delay="200">
								
								<?php 
								echo "<img src='".$img_src."' class='prof_pic_icon'>";
								echo $user_row['organization_name']; 
								?>

							<b class="caret"></b></a>
                            <ul class="dropdown-menu navbar-nav">
								 <li>
                                    <a href="organization_profile.php?id=<?php echo $id?>">My Profile</a>
                                </li>
                                <li>
                                    <a href="editOrganizationProfile.php">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="index-3.html">View Reports</a>
                                </li>
                                <li>
                                    <a href="../index.php">Log Out</a>
                                </li>
                            </ul>
                        </li>
		
						
						
						

						
						
						
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->
    </body>
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

<!-- date range picker -->
<script type="text/javascript" src="../daterangepicker/daterangepicker.js"></script>