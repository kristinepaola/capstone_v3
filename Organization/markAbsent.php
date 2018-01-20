<?php
require ("../sql_connect.php");
$id = $_GET['cid'];
$query = "SELECT * FROM user WHERE user_id = '$id'";
$data = mysqli_query ($sql, $query);

if($data){
	$absent_query = "UPDATE user 
						SET no_missed_activities = no_missed_activities + 1
						WHERE user_id = '$id';";
	$absent_data = mysqli_query($sql, $absent_query);
	if (!$absent_data){
		echo "error in incrementing";
	}
}

$output = array();
$row=mysqli_fetch_assoc($data);
$output[] = $row;
echo json_encode($output);
?>