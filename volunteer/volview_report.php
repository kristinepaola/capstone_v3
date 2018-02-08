 <?php  
  include("../sql_connect.php");
  require("nameTitle.php");
  $id = $_SESSION['num'];
 
  $query = "SELECT A.volunteer_id,  A.event_id, A.status, B.event_name, B.event_description, B.event_start, B.timestamp
            FROM attendance A, event B
            WHERE A.volunteer_id = ".$id."
            AND A.event_id=  B.event_id
            ";

  $data = mysqli_query($sql, $query);
  if(!$data){
    echo "ERROR IN QUERY ";
  }
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title> Event| Reports </title>  
          <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      </head>  
      <body>  
        <br/>
           <div class="container"><a href="volunteer_report.php" class="btn btn-info" background-color: "black">
              <span class="fa fa-mail-reply"></span> Back to View Reports
            </a>
            <div class="pull-right"></div>
           <br/>
              <h3><b>Attended Event</b>  |   Report <br></h3>  
                <br/>  
              <div class="table-responsive">  
                   <table id="attendance" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                   
                                    <td width="20%"><center><strong>Event Name</strong></center></td>
                                    <td width="10%"><center><strong>Description</strong></center></td>
                                    <td width="20%"><center><strong>Date of the Event</strong></center></td>
                                    <td width="25%"><center><strong>Attendance</strong></center></td>
                                    
                                          
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($data))  
                          {  
                          
                               echo '  
                               <tr>  
                                   
                                    <td><h4><center>'.$row['event_name'].'</center></h4></td>
                                    <td><h5><center>'.$row['event_description'].'</center></h5></td>
                                    
                                    <td><h5><center>'.date("M d, Y h:i A", strtotime($row['timestamp'])).'</center></h5></td>
                                     <td><h5><center>'.$row['status'].'</center></h5></td>
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
      $('#attendance').DataTable();  
 });  
 </script>  