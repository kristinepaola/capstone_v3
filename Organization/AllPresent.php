<?php
	session_start();
	$id = $_SESSION['num'];
	$event_id = $_GET['id'];
	require ("../sql_connect.php");
	$query = "SELECT * FROM attendance WHERE status = 'Present' AND event_id = '$event_id'";
	$result = mysqli_query($sql, $query);

	$output=array();

	while($row=mysqli_fetch_assoc($result)){
		$output[] = $row;
	}

	
	
	echo json_encode($output);
?>

