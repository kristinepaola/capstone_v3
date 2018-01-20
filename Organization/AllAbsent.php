<?php
	session_start();
	$id = $_SESSION['num'];
	require ("../sql_connect.php");
	$query = "SELECT * FROM user WHERE no_missed_activities >= 1";
	$result = mysqli_query($sql, $query);

	$output=array();

	while($row=mysqli_fetch_assoc($result)){
		$output[] = $row;
	}

	
	
	echo json_encode($output);
?>

