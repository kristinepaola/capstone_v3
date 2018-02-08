<?php
session_start();
$conn = new mysqli("localhost","root","","webportal");
$id = $_SESSION['num'];

$countFollow =0;
$countPre =0;

$sql2 = "SELECT *
		FROM follow
			WHERE notif_status != 'seen' AND org_id = ".$id.""; 
$result2=mysqli_query($conn, $sql2);
$countFollow=mysqli_num_rows($result2);


$sql3 = "SELECT * 
		 FROM event_preregistration
		 WHERE notif_status != 'seen' AND user_id = ".$id.""; 
		 
$result3=mysqli_query($conn, $sql3);
$countPre=mysqli_num_rows($result3);

	echo '<li id="notificationsBody" class="notifications">
			 <li><a href="">'. $countFollow . ' people followed you!</a></li>
			 <li><a href="">'. $countPre . ' people pre-registered to your event!</a></li>
			 </li>
		';


$sql="UPDATE follow SET notif_status = 'seen' WHERE notif_status='unseen'";	
$result=mysqli_query($conn, $sql);

$sql2="UPDATE event_preregistration SET notif_status = 'seen' WHERE notif_status='unseen'";	
$result=mysqli_query($conn, $sql2);


?>