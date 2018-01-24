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
                <li><a href="list_events.php"><h3>Reports</h3></a></li>
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
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out</a></li>
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
            <div class="col-md-4"><div class="box box-widget widget-user" data-toggle="modal" data-target="#modal-volunteer">
            <a href="#">
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
              <img class="img-circle" src="assets/n_volunteer.jpg" alt="User Avatar">
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
        <div class="modal fade" id="modal-volunteer">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Lists of Volunteers</h3>
                  </div>
                  <div class="modal-body">
                  	<div class="box">
			            <section>
			               <div class="box-body table-responsive no-padding">
			                      <table class="table table-striped">
			                        <thead>
			                          <tr>
			                            <th>Name</th>
			                          </tr>
			                        </thead>
			                        <tbody>
			                        	<p><?php
					                        $result = "SELECT *
					                                  FROM user
					                                  WHERE user_type = 'volunteer'";

					                        $info = mysqli_query($sql, $result);

					                       while($row = mysqli_fetch_array($info)){
					                        ?>
					                        <tr>
					                        	<td><?php echo $row[4] ?>
					                            <?php echo $row[6] ?></td>
					                        </tr>
					                        <?php
					                       }
					                    ?></p>
			                        </tbody>
			                      </table>
			                    </div>
			            </section>
			          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>            
            </div>
        <div class="col-md-4"><div class="box box-widget widget-user" data-toggle="modal" data-target="#modal-organization">
            <a href="#">
            <div class="widget-user-header bg-white-active">
              <h3 class="widget-user-username">
	                   	<?php
	                   		$count = 0;
	                   		$result = "SELECT *
					                    FROM user
					                    WHERE user_type = 'organization'";

					         $info = mysqli_query($sql, $result);

					         while($row = mysqli_fetch_array($info)){
					         	$count++;
					         }
					          ?>
					          <?php echo $count?> <?php if($count<=1){ echo 'Organization';}else{ echo 'Organizations';}?>
	            </h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="assets/n_organization.jpg" alt="User Avatar">
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

        <div class="modal fade" id="modal-organization">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Lists of organizations</h3>
                  </div>
                  <div class="modal-body">
                  	<div class="box">
			            <section>
			               <div class="box-body table-responsive no-padding">
			                      <table id="tabledit" class="table table-striped">
			                        <thead>
			                        </thead>
			                        <tbody>
			                        	<p><?php
					                        $result = "SELECT *
					                                  FROM user
					                                  WHERE user_type = 'organization'";

					                        $info = mysqli_query($sql, $result);

					                       while($row = mysqli_fetch_array($info)){
					                        ?>
					                        <tr>
					                        	<td><?php echo $row[4] ?></td>
					                        </tr>
					                        <?php
					                       }
					                    ?></p>
			                        </tbody>
			                      </table>
			                    </div>
			            </section>
			          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>            
            </div>
        <div class="col-md-4"><div class="box box-widget widget-user" data-toggle="modal" data-target="#modal-event">
            <a href="#">
            <div class="widget-user-header bg-white-active">
              <h3 class="widget-user-username">
	                   	<?php
	                   		$count = 0;
	                   		$result = "SELECT *
					                    FROM event";

					         $info = mysqli_query($sql, $result);

					         while($row = mysqli_fetch_array($info)){
					         	$count++;
					         }
					          ?>
					          <?php echo $count?> Upcoming <?php if($count<=1){ echo 'Event';}else{ echo 'Events';}?>
	            </h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="assets/n_event.jpg" alt="User Avatar">
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
      </div>
      <div class="modal fade" id="modal-event">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Upcoming Events</h3>
                  </div>
                  <div class="modal-body">
                  	<div class="box">
			            <section>
			               <div class="box-body table-responsive no-padding">
			                      <table id="tabledit" class="table table-striped">
			                        <thead>
			                        </thead>
			                        <tbody>
			                        	<p><?php
					                        $result = "SELECT *
					                                  FROM event";

					                        $info = mysqli_query($sql, $result);

					                       while($row = mysqli_fetch_array($info)){
					                        ?>
					                        <tr>
					                        	<td><?php echo $row[1] ?></td>
					                        </tr>
					                        <?php
					                       }
					                    ?></p>
			                        </tbody>
			                      </table>
			                    </div>
			            </section>
			          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>            
            </div>

      <!-- DONUT CHART -->
          <div class="box box-danger">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">System Performance</h3>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="542.237" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; top: -0.2px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#3c8dbc" d="M271.1185,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,359.34625519497706,180.44625304313007" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#3c8dbc" stroke="#ffffff" d="M271.1185,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,362.18214732624415,181.4248826052307L398.7336459070204,194.03833029452744A135,135,0,0,1,271.1185,285Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#f56954" d="M359.34625519497706,180.44625304313007A93.33333333333333,93.33333333333333,0,0,0,187.4033462783141,108.73398312817662" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#f56954" stroke="#ffffff" d="M362.18214732624415,181.4248826052307A96.33333333333333,96.33333333333333,0,0,0,184.71250205154564,107.40757544301087L145.54576941747115,88.10097469226493A140,140,0,0,1,403.46013279246563,195.6693795646951Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#00a65a" d="M187.4033462783141,108.73398312817662A93.33333333333333,93.33333333333333,0,0,0,271.0891784690488,243.333328727518" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#00a65a" stroke="#ffffff" d="M184.71250205154564,107.40757544301087A96.33333333333333,96.33333333333333,0,0,0,271.0882359912682,246.3333285794739L271.0760884998742,284.9999933380171A135,135,0,0,1,150.0305097954186,90.31165416754118Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="271.1185" y="140" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1.4524,0,0,1.4524,-122.741,-68.2181)" stroke-width="0.6885230654761905"><tspan dy="6.015625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">In-Store Sales</tspan></text><text x="271.1185" y="160" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1.9444,0,0,1.9444,-256.151,-143.5556)" stroke-width="0.5142857142857143"><tspan dy="4.8125" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan></text></svg></div>
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
</body>
</html>
