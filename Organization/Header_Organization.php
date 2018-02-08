<?php
session_start();
if(empty($_SESSION['num'])){
	header('location:../index.php');
}


include('../sql_connect.php');
$id = $_SESSION['num'];

$totalCount = 0;
$followCount = 0;
$preRegCount = 0;


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

$sql2="SELECT * FROM follow WHERE notif_status = 'unseen' AND org_id = ".$id."";
$result=mysqli_query($sql, $sql2);
$followCount=mysqli_num_rows($result);

$sql3 ="SELECT * FROM event_preregistration WHERE notif_status = 'unseen' AND user_id = ".$id."";
$result3=mysqli_query($sql, $sql3);
$preRegCount=mysqli_num_rows($result3);

$totalCount = $followCount + $preRegCount;

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
		<link rel="stylesheet" href="../daterangepicker/daterangepicker.css">
        
        <style>
      #navno{list-style:none;margin: 0px;padding: 0px;}
      #navno li {
        /*margin-right: 20px;*/
        font-family: Roboto;
        font-size: 20px;
        font-weight:bold;
      }
      #navno li a{color:#333333;text-decoration:none}
      #navno li a:hover{color:#000000;text-decoration:none}
      #notification_li
      {
        position:relative
      }
      #notificationContainer 
      {
      background-color: #fff;
      border: 1px solid rgba(100, 100, 100, .4);
      -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
      overflow: visible;
      position: absolute;
      top: 50px;
      margin-left: -170px;
      width: 300px;
      z-index: 1;
      display: none;
      }
      #notificationTitle
      {
      font-weight: bold;
      padding: 8px;
      font-size: 13px;
      background-color: #ffffff;
      position: fixed;
      z-index: 1000;
      width: 300px;
      border-bottom: 1px solid #dddddd;
      }
      #notificationsBody
      {
      padding: 8px 0px 0px 0px !important;
      min-height:30px;
      }
      #notificationFooter
      {
      background-color: #e9eaed;
      text-align: center;
      font-weight: bold;
      padding: 8px;
      font-size: 12px;
      border-top: 1px solid #dddddd;
      }
    #notification_count 
    {
    padding: 3px 7px 3px 7px;
    background: #cc0000;
    color: #ffffff;
    font-weight: bold;
    margin-left: 77px;
    border-radius: 9px;
    -moz-border-radius: 9px; 
    -webkit-border-radius: 9px;
    position: absolute;
    margin-top: -11px;
    font-size: 11px;
    }
</style>
    </head>
    <body>
        <nav class="navbar navbar-default ">
            <div class="container">
                <div class="navbar-header">
                <a class="navbar-brand" href="organization_dashboard.php"><img src="../assets/img/iHelplogo.png" height="48px" width="149px" alt=""></a>
                </div>
                <div class="collapse navbar-collapse yamm" id="navigation">
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="organization_dashboard" href="organization_dashboard.php">Home</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="events.php">Event</a></li>
						<li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="organizations.php">Organization</a></li><li id="notification_li">
                             <div id="navno">
                                  <a href="#" id="notificationLink">Notifications</a>
                                <span id="notification_count"><?php if($totalCount > 0) { echo $totalCount; } ?></span>
                                <div id="notificationContainer">
                                <div id="notificationTitle">Notifications</div>
                                <div id="notificationsBody" class="notifications"></div>
                              </div>
                              </div>
                            </li>
						  <li class="dropdown ymm-sw" data-wow-delay="0.1s">
                            <a href="organization_profile.php" data-toggle="dropdown" data-hover="dropdown" data-delay="200">
								
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
                                <!--<li>
                                    WALA SA FOR NOW<a href="index-3.html">View Reports</a>
                                </li>-->
                                <li>
                                    <a href="../logout.php">Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
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
<script type="text/javascript" src="../daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    function myFunction() {
                    $.ajax({
                        url: "view_notification.php",
                        type: "POST",
                        processData:false,
                        success: function(data){
                            $("#notification_count").fadeOut("slow");                   
                            $("#notificationsBody").show();$("#notificationsBody").html(data);
                        },
                        error: function(){}           
                    });
                 }
                 
                 $(document).ready(function() {
                    $('body').click(function(e){
                        if ( e.target.id != 'notification-icon'){
                            $("#notification-latest").hide();
                        }
                    });
                });
 // SAMPLE
 $("#notificationLink").click(function()
      {
      $("#notificationContainer").fadeToggle(300);
      $("#notification_count").fadeOut("slow");  
       myFunction();
      return false;
      });

      $(document).click(function()
      {
      $("#notificationContainer").hide();
      });

      $("#notificationContainer").click(function()
      {
        return false;
      });
 
});
</script>