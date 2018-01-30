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
      <body>  
        <br/>
           <div class="container">
            <div class="pull-right"><a href="admin_dashboard.php" class="btn btn-info">
              <span class="glyphicon glyphicon-home"></span> Back to Home
            </a> </div>
           <br/>
                <h3>iHelp | Events</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="event_data" class="table table-striped table-bordered">  
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
      $('#event_data').DataTable();  
 });  
 </script>  