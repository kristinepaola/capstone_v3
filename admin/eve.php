 <?php  
 $count = 0;
 $connect = mysqli_connect("localhost", "root", "", "webportal");  

 $query ="SELECT A.event_id, A.event_name, A.event_status, A.event_no_of_people, A.timestamp, A.pre_registered_count,
 				 B.user_id, B.first_name
		          FROM event A, user B 
		          WHERE A.event_name != '' AND A.user_id = B.user_id ORDER BY B.user_id DESC";  
 $result = mysqli_query($connect, $query);  

 // $prere ="SELECT *
 // 		FROM event_preregistration";
    	             
 //    	$info = mysqli_query($connect, $prere);

 //    	while($outrow = mysqli_fetch_array($result)){
 //    		$eventid = $outrow["event_id"];
 //    		while($inrow = mysqli_fetch_array($info)){
 //    				if($inrow[1] == $eventid){
 //    					$count++;
 //    				}
 //    		}
 //    	}
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
              <span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Home
            </a> </div>
           <br/>
                <h3>iHelp | Events</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Event Name</td>
                                    <td>Event Organizer</td>
                                    <td>Event Status</td>
                                    <td>No. of People Needed</td>
                                    <td>Pre-registered</td>
                                    <td>Date Registered</td>      
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["event_name"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["event_status"].'</td>
                                    <td>'.$row["event_no_of_people"].'</td>
                                    <td>'.$row["pre_registered_count"].'</td>
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