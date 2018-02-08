<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "webportal");
$output = '';

if(isset($_POST["query"]))
  {
     $search = mysqli_real_escape_string($connect, $_POST["query"]);
     $query = "
      SELECT * FROM user 
      WHERE user_type = 'volunteer' AND first_name LIKE '%".$search."%'
      OR user_status LIKE '%".$search."%' 
      OR last_name LIKE '%".$search."%' 
      OR no_missed_activities LIKE '%".$search."%'
     ";
    }else{
     $query = "
      SELECT * FROM user ORDER BY user_id
     ";
  }

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="content-wrapper" onload="viewData()">
    <section class="container">
      <div class="row">
        <div class="col-xl-8">
          <div class="box">
            <section>
               <div class="box-body table-responsive no-padding">
                      <table id="tabledit" class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>No. of Missed Activities</th>
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
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
        <tr>
           <td><?php echo $row[0] ?></td>
            <td><?php echo $row[4] ?></td><!--First Name-->
            <td><?php echo $row[6] ?></td><!--Last Name-->
            <td><?php echo $row[9] ?></td><!--Missed Activities-->
            <td><?php echo $row[12] ?></td><!--User Status-->
        </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
<script src="dist/jquery-3.2.1.js"></script>
<script src="plugins/jqueryplugin/jquery.tabledit.js"></script>

<script>
  $(document).ready(function(){
    function viewData(){
          $.ajax({
            url: "Model/a_edit.php?p=view",
            method: "GET"
          }).done(function(data){
            $("tbody").html(data)
            tableData()
          })
      }
        function tableData(){
          $("#tabledit").Tabledit({
            url: "Model/a_edit.php",
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
              editable:[[1, "firstname"], [2, "lastname"], [4, 'stat', '{"1": "Active", "2": "Blocked"}']]
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