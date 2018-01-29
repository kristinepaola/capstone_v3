 <?php  
 $connect = mysqli_connect("localhost", "root", "", "webportal");  

 $query ="SELECT *
          FROM user
          WHERE user_type = 'organization' ORDER BY user_id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>iHelp | Organization</title>  
           <script src="plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="plugins/dataTables/bootstrap.min.css" />  
           <script src="plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="plugins/dataTables/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
        <br/>
           <div class="container">
            <div class="pull-right"><a href="admin_dashboard.php" class="btn btn-info">
              <span class="glyphicon glyphicon-home"></span> Back to Home
            </a> </div>
           <br/>
                <h3>iHelp | Organization</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Organization Name</td>
                                    <td>Status</td>
                                    <td>Date Registered</td>      
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["user_status"].'</td>
                                    <td>'.$row["timestamp"].'</td>  
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
      $('#employee_data').DataTable();  
 });  
 </script>  