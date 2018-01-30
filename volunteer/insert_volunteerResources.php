<?php
	session_start();
	require("../sql_connect.php");
	 $id = $_SESSION['num'];
	 $event_id = $_SESSION['event_id'];

	$name = $_FILES['resources_photo']['name'];
	$target_dir = "../admin/volunteerResourcesImages/";
	$target_file = $target_dir . basename($_FILES['resources_photo']['name']);

	// select file type
	$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

	//valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	$resources_query = "INSERT INTO volunteer_resources VALUES ('',
																'".$_POST['resources_name']."',
																'".$_POST['resources_description']."',
																'".$name."',
																".$_POST['no_items'].",
																'$event_id',
																'$id',
																NOW()

																)";
	echo $resources_query;
	$result = mysqli_query($sql, $resources_query);
	
	if($result){
		move_uploaded_file($_FILES['resources_photo']['tmp_name'], $target_dir.$name);
		header("location:volunteerHome.php");
	}else{
		echo "ERROR IN QUERY";
	}

?>