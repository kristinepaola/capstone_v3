<?php
	require('../sql_connect.php');
	require('Header_Organization.php');
	$id = $_SESSION['num'];

	 $query = "SELECT A.event_feedback_id, A.event_rating, A.event_comment, A.event_id, A.org_id, A.timestamp, B. user_id, B.first_name, B.last_name, C.event_name
				FROM event_feedback A, user B, event  C
				WHERE  A.user_id = B.user_id
				AND A.event_id = C.event_id
				AND A.org_id = ".$id."
			 ";
	$data = mysqli_query($sql, $query);
	if(!$data){
		echo "ERROR IN QUERY";
	}

?>
<html>  
      <head>  
           <title>Organization | Reports </title>  
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
              <h3><b>Feedback</b>  |   Report <br></h3>  
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