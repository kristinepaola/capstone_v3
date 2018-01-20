<?php
	session_start();
	require("../sql_connect.php");
	 $id = $_SESSION['num'];

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
																".$_POST['no_items'].",
																'".$name."',
																'$id',
																'1',
																NOW()

																)";
	echo $resources_query;
	$result = mysqli_query($sql, $resources_query);
	
	if($result){
		move_uploaded_file($_FILES['resources_photo']['tmp_name'], $target_dir.$name);
		
	}else{
		echo "ERROR IN QUERY";
	}

?>