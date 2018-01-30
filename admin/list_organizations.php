<!DOCTYPE html>
<html>
<?php include("../sql_connect.php");?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  
  <link rel="stylesheet" href="plugins/dataTables/dataTables.bootstrap.min.css" />
</head>
<body class="hold-transition skin-white layout-top-nav" onload="viewData()">
  <div class="content-wrapper">
    <section class="container">
      <h1>Lists of Organizations <div class="pull-right"><a href="admin_dashboard.php" class="btn btn-info">
              <span class="glyphicon glyphicon-home"></span> Back to Home
            </a> </div>
           <br/></h1> 
      <br/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <section>
               <div class="box-body table-responsive no-padding">
                      <table id="tabledit" class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Organization Name</th>
                            <th>Mission</th>
                            <th>Vision</th>
                            <th>Date Established</th>
                            <th>Status</th>
                            <th>Date Registered</th>
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

  <script src="plugins/dataTables/jquery.min.js"></script>
  <script src="plugins/dataTables/jquery.dataTables.min.js"></script>
  <script src="plugins/jqueryplugin/jquery.tabledit.js"></script>
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
          editable:[[4, 'stat', '{"1": "Active", "2": "Blocked"}']]
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
