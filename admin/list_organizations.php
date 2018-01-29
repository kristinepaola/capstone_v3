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
  <link rel="stylesheet" href="plugins/dataTables/dataTables.bootstrap.min.css" />
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
  <div class="content-wrapper">
    <section class="container">
      <h1>Lists of Organizations</h1>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <section>
               <div class="box-body table-responsive no-padding">
                      <table id="tabledit" class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Organization Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
            </section>
          </div>
        </div>
      </div>
    </section>
  </div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dis/js/pages/jquery-3.2.1.js"></script>
<script src="plugins/jqueryplugin/jquery.tabledit.js"></script>  
<script src="plugins/dataTables/jquery.dataTables.min.js"></script>  
<script src="plugins/dataTables/dataTables.bootstrap.min.js"></script>      
</body>
</html>
<script>

$(document).ready(function(){  
      $('#tabledit').DataTable();  
 }); 
function viewData(){
      $.ajax({
        url: "Model/o_edit.php?p=view",
        method: "GET"
      }).done(function(data){
        $("tbody").html(data)
        tableData()
      })
    }
    function tableData(){
      $("#tabledit").Tabledit({
        url: "Model/o_edit.php",
          editButton: true,
          deleteButton: false,
          hideIdentifier: true,
          buttons: {
              edit: {
                  class: "btn btn-sm btn-success",
                  html: "<span class='glyphicon glyphicon-pencil'></span>UPDATE",
                  action: "edit"
              },
              save: {
                  class: "btn btn-sm btn-warning",
                  html: "Save"
              }
          },
        columns: {
          identifier: [0, "id"],
          editable:[[2, 'stat', '{"1": "Active", "2": "Blocked"}']]
        },
          onSuccess: function(data, textStatus, jqXHR) {
              viewData()
          },
           onFail: function(jqXHR, textStatus, errorThrown) {
              console.log('onFail(jqXHR, textStatus, errorThrown)');
              console.log(jqXHR);
              console.log(textStatus);
              console.log(errorThrown);
          },
          onAjax: function(action, serialize) {
              console.log('onAjax(action, serialize)');
              console.log(action);
              console.log(serialize);
          }
        });
    }
</script>
