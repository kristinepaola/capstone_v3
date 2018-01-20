<?php
	session_start();
	$user_id = $_SESSION['num'];
	include("../sql_connect.php");
	$event_id = $_POST['ev_id'];
	$user = "SELECT user_id FROM event WHERE event_id = '$event_id'";
	$user_data = mysqli_query($sql, $user);
	$user_row = mysqli_fetch_array($user_data);
		$org_id = $user_row['user_id'];
	$query = "INSERT INTO event_feedback VALUES ('',
												".$_POST['event_rating'].",
												'".$_POST['event_comment']."',
												".$_POST['ev_id'].",
												".$org_id.",
												'$user_id')";


	
	echo $query;
	$result = mysqli_query($sql, $query);
/* 	var_dump($result);
	$output=array();

	while($row=mysqli_fetch_assoc($result)){
		$output[] = $row;
	}

		
	echo json_encode($output); */

?>




