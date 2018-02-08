<?php
require("../sql_connect.php");
$user_id = $_GET['user_id'];
$output = array();
//attendance
$attendance_query = "SELECT A.status, A.event_id, B.event_name, B.event_start FROM attendance A, event B WHERE volunteer_id = '$user_id' AND B.event_status = 'Done' AND A.event_id = B.event_id";
$attendance_data = mysqli_query ($sql, $attendance_query);

echo $attendance_query;
while($attendance_row = mysqli_fetch_array($attendance_data)){
	$output[] = $attendance_row;
}

echo json_encode($output);



?>