<?php
	require("../sql_connect.php");
	session_start();
	$id = $_SESSION['id'];
	$name = $_FILES['advIcon']['name'];

	$target_dir = "advocaciesIcon/";
	$target_file = $target_dir . basename($_FILES['advIcon']['name']);

	// select file type
	$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

	//valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");
	$query = "UPDATE advocacies SET advocacy_name = '".$_POST['advName']."',
									advocacy_icon = '$name'
									WHERE advocacy_id = $id";
	
	$data = mysqli_query ($sql, $query);
	if (!$data){
		echo "ERROR IN QUERY";
	}else{
		session_destroy();
		header("location:viewAdvocacies.php");
	}
	move_uploaded_file($_FILES['advIcon']['tmp_name'], $target_dir.$name);
	
?>