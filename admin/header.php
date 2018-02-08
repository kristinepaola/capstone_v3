<!DOCTYPE html>
<html>
<?php include("../sql_connect.php");?>
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
</head>
<body class="hold-transition skin-white layout-top-nav" onload="viewData()">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="admin_dashboard.php"><h3>Home</h3></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><h3>Manage Accounts <span class="caret"></span></h3></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="list_volunteers.php"><h3><i class="glyphicon glyphicon-user"></i> Volunteer</h3></a></li>
                    <li class="divider"></li>
                    <li><a href="list_organizations.php"><h3><i class="glyphicon glyphicon-user"></i> Organizations</h3></a></li>
                  </ul>
                </li>
                <li><a href="list_events.php"><h3>Manage Events</h3></a></li>
              </ul>
            </div>
            <div class="navbar-custom-menu pull-right">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <h3><img src="assets/image1.jpg" class="user-image" alt="User Image">
                    Welcome Admin!</h3>
                  </a>
                  <ul class="dropdown-menu" role="menu">                    
                    <li class="divider"></li>
                    <li><a href="../logout.php">Sign Out</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
  </header>
</div>
</body>
</html>