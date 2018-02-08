<?php
	require('../sql_connect.php');
	require('Header_Organization.php');
	$id = $_SESSION['num'];

	 $query = "SELECT * FROM event 
            WHERE user_id = ".$id." AND event_status = 'Happening Now'
			 ";
	$data = mysqli_query($sql, $query);
	if(!$data){
		echo "ERROR IN QUERY";
	}

?>
<html>  
      <head>  
           <title>Recent | Reports </title>  
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
           <div class="container"><a href="organization_dashboard.php" class="btn btn-warning pull-left">
              <span class="fa fa-mail-reply"> Back to Dashboard </span>
              <a href="organization_profile.php" class="btn btn-success pull-right">
              Go to Profile <span class="fa fa-mail-forward"></span>

            </a>
            <div class="pull-right"></div>
           <br/>
              <h3><b>Recent Activity</b>  |   Reports <br></h3>  
                <br/>  
              <div class="table-responsive">  
                   <table id="reportFeedback" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>   
                                    <td width="20%"><center><strong>Volunteer Name</strong></center></td>
                                    <td width="10%"><center><strong>Event Name</strong></center></td>
                                    <td width="20%"><center><strong>Comment</strong></center></td>
                                    <td width="15%"><center><strong>Rating</strong></center></td>
                                    <td width="15%"><center><strong>Date Commented</strong></center></td>
                                          
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($data))  
                          {  
                          
                               echo '  
                               <tr> 
                               		<td><center><a href="../volunteer/publicvolunteerProfile_1.php?id='.$row['user_id'].'">'.$row['first_name'].' '.$row['last_name'].'</center></td>
                               		<td><h5><center>'.$row['event_name'].'</center></h5></td>
                                    <td><h5><center>'.$row['event_comment'].'</center></h5></td>
                                    <td><h5><center>'.$row['event_rating'].'</center></h5></td>
                                    <td><h5><center>'.date("M d, Y h:i A", strtotime($row['timestamp'])).'</center></h5></td>
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
      $('#reportFeedback').DataTable();  
 });  
 </script>  