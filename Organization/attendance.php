<?php
require ("../sql_connect.php");
$user_id = $_POST['cid'];
$status = $_POST['status'];
$event_id = $_POST['event_id'];

if($status == "Absent"){
	$attendance_query = "UPDATE user 
						SET no_missed_activities = no_missed_activities + 1
						WHERE user_id = '$user_id';";
	$attendance_data = mysqli_query($sql, $attendance_query);
	if ($attendance_data){
		$absent_query = "INSERT INTO attendance VALUES ('',
														'$user_id',
														'$event_id',
														'Absent')";
		$absent_data = mysqli_query($sql, $absent_query);
	}else{
		echo "error in incrementing";
	}
}else{
	$present_query = "INSERT INTO attendance VALUES ('',
														'$user_id',
														'$event_id',
														'Present')";
	$present_query = mysqli_query($sql, $present_query);
}

// $output = array();
//$row=mysqli_fetch_assoc($data);
// $output[] = $row;
// echo json_encode($output);
?>