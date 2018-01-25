<?php 
//index.php
include("../sql_connect.php");

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
?>
<!DOCTYPE html>
<html>
 <head>
  <title>iHelp | System Performance</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
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
                <li><a href="reports.php" ><h3>Reports</h3></a></li>
              </ul>
            </div>
            <div class="navbar-custom-menu pull-right" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <h3><img src="assets/image1.jpg" class="user-image" alt="User Image">
                    Welcome Admin!</h3>
                  </a>
                   <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="assets/image1.jpg" class="img-circle" alt="User Image">

                        <p>
                          Admin
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-footer">
                          <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
  </header>
  <div>
    <br /><br/>
      <div class="container" style="width:900px;">
       <h2 align="center">System Performance</h2>
       <div id="chart"></div>
  </div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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

<script>

$(document).ready(function(){
 
 var donut_chart = Morris.Donut({
     element: 'chart',
     data: <?php echo $data; ?>
    });
  
 $('#like_form').on('submit', function(event){
  event.preventDefault();
  var checked = $('input[name=user_type]:checked', '#like_form').val();
  if(checked == undefined)
  {
   alert("");
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