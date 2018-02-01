 <?php  
 $connect = mysqli_connect("localhost", "root", "", "webportal");  

 $query ="SELECT *
          FROM user
          WHERE user_type = 'volunteer' ORDER BY user_id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>iHelp | Volunteeers</title>  
           <script src="plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="plugins/dataTables/bootstrap.min.css" />  
           <script src="plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="plugins/dataTables/dataTables.bootstrap.min.css" />
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
      <body >  
        <br/>
           <div class="container">
            <div class="pull-right"><a href="admin_dashboard.php" class="btn btn-info">
              <span class="glyphicon glyphicon-home"></span> Back to Home
            </a> </div>
           <br/>
                <h3>iHelp | Volunteer</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="volunteer_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>First Name</td>
                                    <td>Last Name</td> 
                                    <td>Status</td>
                                    <td>Date Registered</td> 
                                    <td>No. of Missed Activities</td>      
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["user_status"].'</td>
                                    <td>'.$row["timestamp"].'</td>
                                    <td>'.$row["no_missed_activities"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#volunteer_data').DataTable();  
 });  
 </script>  