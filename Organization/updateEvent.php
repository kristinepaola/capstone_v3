<?php
	session_start();	
	require ("../sql_connect.php");
	$id = $_SESSION['num'];
	$event_id = $_SESSION['event_id'];


//Upload Organization Profiles
	$name = $_FILES['event_img']['name'];
	$target_dir = "../admin/eventImages/";
	$target_file = $target_dir . basename($_FILES['event_img']['name']);

	// select file type 
	$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

	//valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	//update user profile query
	$query_event = "UPDATE event SET  event_img = '".$name."' 
                          	WHERE event_id=".$event_id."";
     
     $update_event = mysqli_query ($sql, $query_event);
     	if(!$update_event){
     		echo "ERROR IN QUERY 1";
     	}
     	//explode date-time 
		$exp = explode(" - ", $_POST['daterange']);
		$start = date("Y-m-d H:i:s", strtotime($exp[0]));
		$end = date("Y-m-d H:i:s", strtotime($exp[1]));
		//for each to get sum of no. vol needed
		$total=0;
		foreach($_POST['num_vol'] as $numvol){
			$total=$total+$numvol;
		}

		//valid file extensions
		$extensions_arr_cert = array("jpg", "jpeg", "png", "gif");

		$update_query = "UPDATE event  SET event_name ='".$_POST['event_name']."',
														  event_description = '".$_POST['event_description']."',
														  event_location =  '".$_POST['event_location']."',
													      event_start = '$start',
														  event_end = '$end',
														  event_material_req = '".$_POST['event_material_req']."'
														 


														  WHERE event_id =".$event_id."";
		echo $update_query;											  	
		$update = mysqli_query($sql,$update_query);
		var_dump($update);
	 		if($update){
	 		header("location:organization_dashboard.php");
	 		
			}else{ "ERROR IN QUERY";	
		}

		move_uploaded_file($_FILES['event_img']['tmp_name'], $target_dir.$name);



?>
 <!-- min_age = ".$_POST['min_age'][0].",
max_age = ".$_POST['max_age'][1].",
event_partner_org = '".$_POST['partnership']."',
event_no_of_people = ".$_POST['event_no_of_people']."  -->