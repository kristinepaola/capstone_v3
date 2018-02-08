 <?php  
 $count = 0;
  require('../sql_connect.php');
  require('Header_Organization.php');
  $id = $_SESSION['num'];

  $query = "SELECT * FROM event WHERE user_id = ".$id."";
  $data = mysqli_query($sql, $query);
  if(!$data){
    echo "ERROR IN QUERY";
  }  

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Event | Reports </title>  
          <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      </head>  
      <style>
            .img{
            height: 75px;
            width: 75px;
            text-align: center;

            }
      </style>   
      <body>  
        <br/>
           <div class="container"><a href="view_report.php" class="btn btn-info" background-color: "black">
              <span class="fa fa-mail-reply"></span> Back to View Reports
            </a>
            <div class="pull-right"></div>
           <br/>
              <h3><b>Event</b>  |   Report <br></h3>  
                <br/>  
              <div class="table-responsive">  
                   <table id="reportEvent" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td width="20%"><center><strong>Image</strong></center></td>
                                    <td width="20%"><center><strong>Name</strong></center></td>
                                    <td width="10%"><center><strong>Status</strong></center></td>
                                    <td width="20%"><center><strong>Location</strong></center></td>
                                    <td width="15%"><center><strong>Date Start</strong></center></td>
                                    <td width="15%"><center><strong>Date End</strong></center></td>
                                    <td width="25%"><center><strong>(#)Needed Volunteers</strong></center></td>
                                    <td width="25%"><center><strong>(#)Pre-Registered</strong></center></td>
                                          
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($data))  
                          {  
                              $item_img = $row['event_img'];
                              $img_src = "../admin/eventImages/".$item_img;
                               echo '  
                               <tr>  
                                    <td><center><img src='.$img_src.' class="img"></center></td>
                                    <td><h4><center>'.$row['event_name'].'</center></h4></td>
                                    <td><h5><center>'.$row['event_status'].'</center></h5></td>
                                    <td><h5><center>'.$row['event_location'].'</center></h5></td>
                                    <td><h5><center>'.date("M d, Y h:i A", strtotime($row['event_start'])).'</center></h5></td>
                                    <td><h5><center>'.date("M d, Y h:i A", strtotime($row['event_end'])).'</center></h5></td>
                                    <td><h5><center>'.$row['event_no_of_people'].'</center></h5></td>
                                    <td><h5><center>'.$row['pre_registered_count'].'</center></h5></td>  
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
      $('#reportEvent').DataTable();  
 });  
 </script>  