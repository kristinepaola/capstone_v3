<?php 
//index.php
include("../sql_connect.php");
$countUser = 0;
$countEvent = 0;
$totalCount = 0;

$sub_query = "
   SELECT user_type, count(*) as no_of_like FROM user 
   GROUP BY user_type 
   ORDER BY user_id ASC";
$result = mysqli_query($sql, $sub_query);
$data = array();
while($row = mysqli_fetch_array($result))
{
 $data[] = array(
  'label'  => $row["user_type"],
  'value'  => $row["no_of_like"]
 );
}
$data = json_encode($data);

$query="SELECT * FROM user WHERE notif_status = 'unseen' AND user_type != 'admin'";
$result=mysqli_query($sql, $query);
$countUser=mysqli_num_rows($result);

$query2="SELECT * FROM event WHERE notif_status = 'unseen'";
$result=mysqli_query($sql, $query2);
$countEvent=mysqli_num_rows($result);

$totalCount = $countUser + $countEvent;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin| Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
      <style>
      #navno{list-style:none;margin: 0px;padding: 0px;}
      #navno li {
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
      display: none; // Enable this after jquery implementation 
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
      min-height:200px;
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

<body class="hold-transition skin-gray layout-top-nav" onload="viewData()">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
              <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php"><img src="../assets/img/iHelplogo.png" height="48px" width="149px" alt=""></a>
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="admin_dashboard.php"><h4>Home</h4></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><h4>Manage Accounts <span class="caret"></span></h4></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="list_volunteers.php"><h4><i class="glyphicon glyphicon-user"></i> Volunteer</h4></a></li>
                    <li class="divider"></li>
                    <li><a href="list_organizations.php"><h4><i class="glyphicon glyphicon-user"></i> Organizations</h4></a></li>
                  </ul>
                </li>
                <li><a href="eve.php"><h4>Manage Events</h4></a></li>
              </ul>
            </div>
                 <div class="navbar-custom-menu pull-right">
                        <ul class="nav navbar-nav">
                          
                              <li id="notification_li">
                                <div id="navno">
                                  <a href="#" id="notificationLink"><h3>Notifications</h3></a>
                                <span id="notification_count"><?php if($totalCount > 0) { echo $totalCount; } ?></span>
                                <div id="notificationContainer">
                                <div id="notificationTitle">Notifications</div>
                                <div id="notificationsBody" class="notifications"></div>
                              </div>
                              </div>
                            </li>
                            <li class="dropdown user user-menu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <h5><img src="assets/image1.jpg" class="user-image" alt="User Image">
                                Welcome Admin!</h5>
                              </a>
                                  <ul class="dropdown-menu">
                                      <li class="user-header">
                                        <img src="assets/image1.jpg" class="img-circle" alt="User Image">
                                        <p> Admin </p>
                                      </li>
                                      <li class="user-body">
                                        <a href="../logout.php" class="btn btn-default btn-flat">Sign Out</a>
                                      </li>
                                  </ul>
                            </li>
                        </ul>
                  </div>
              </div>
        </nav>
  </header>
  <div class="content-header">
    <section class="content">
      <div class="row">
        <div class="row">
            <div class="col-md-3" ><!-- <div class="box box-widget widget-user" data-toggle="modal" data-target="#modal-volunteer"> -->
            <div class="box box-widget widget-user">
            <a href="vol.php">
            <div class="widget-user-header bg-white-active">
              <h3 class="widget-user-username">
	                   	<?php
	                   		$count = 0;
	                   		$result = "SELECT *
					                    FROM user
					                    WHERE user_type = 'volunteer'";

					         $info = mysqli_query($sql, $result);

					         while($row = mysqli_fetch_array($info)){
					         	$count++;
					         }
					          ?>
					          <?php echo $count?> <?php if($count<=1){ echo 'Volunteer';}else{ echo 'Volunteers';}?>
	            </h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="assets/volunteer.png" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="col-sm-12">
                  <div class="description-block">
                  </div>
                </div>
            </div>
            </a>
          </div>
        </div>
        <div class="col-md-3"><!-- <div class="box box-widget widget-user" data-toggle="modal" data-target="#modal-organization"> -->
          <div class="box box-widget widget-user">
            <a href="org.php">
            <div class="widget-user-header bg-white-active">
              <h3 class="widget-user-username">
	                   	<?php
	                   		$count = 0;
	                   		$result = "SELECT *
					                    FROM organization_details
					                    WHERE organization_status = 'Pending' ";

					         $info = mysqli_query($sql, $result);

					         while($row = mysqli_fetch_array($info)){
					         	$count++;
					         }
					          ?>
					          <?php echo $count?> <?php if($count<=1){ echo 'Pending Organization';}else{ echo 'Pending Organizations';}?>
	            </h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="assets/organization.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-12">
                  <div class="description-block">
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        </div>
        <div class="col-md-3">
              <div class="box box-widget widget-user">
                <a href="eve.php">
                <div class="widget-user-header bg-white-active">
                  <h3 class="widget-user-username">
    	                   	<?php
    	                   		$count = 0;
    	                   		$result = "SELECT *
    					                    FROM event
                                  WHERE event_name != '' AND event_status = 'Upcoming'";

    					         $info = mysqli_query($sql, $result);

    					         while($row = mysqli_fetch_array($info)){
    					         	$count++;
    					         }
    					          ?>
    					          <?php echo $count?>  <?php if($count<=1){ echo 'Upcoming Event';}else{ echo 'Upcoming Events';}?>
    	            </h3>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="assets/event_admin.png" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="description-block">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <div class="box box-widget widget-user">
              <div class="container" style="width:300px;">
                 <h3 align="center">System Performance</h3>
                 <div id="chart"></div>
                </div>
              </div>
        </div>
      </div>
    </section>
  </div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/dataTables/jquery.dataTables.min.js"></script>
</body>
</html>
<script>
$(document).ready(function(){

    function myFunction() {
                    $.ajax({
                        url: "view_notification_admin.php",
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
// END OF SAMPLE CODE
 var donut_chart = Morris.Donut({
     element: 'chart',
     data: <?php echo $data; ?>
    });
  
 $('#like_form').on('submit', function(event){
  event.preventDefault();
  var checked = $('input[name=user_type]:checked', '#like_form').val();
  if(checked == undefined)
  {
   alert("undefined");
   return false;
  }
  else
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"action.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data)
    {
     $('#like_form')[0].reset();
     donut_chart.setData(data);
    }
   });
  }
 });
});
</script>

