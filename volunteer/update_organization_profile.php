<?php
	session_start();
	include ("../sql_connect.php");
	 $id = $_SESSION['num'];

	//Upload Organization Profiles
	$name = $_FILES['user_prof_pic']['name'];
	$target_dir = "../admin/userProfPic/";
	$target_file = $target_dir . basename($_FILES['user_prof_pic']['name']);

	// select file type 
	$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

	//valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	//update user profile query
	$query_user = "UPDATE user SET  user_prof_pic = '".$name."' 
                          	WHERE user_id=".$id."";
     
     $update_user = mysqli_query ($sql, $query_user);
     	if(!$update_user){
     		echo "ERROR IN QUERY 1";
     	}else{
     		//Upload organization certificate
	   
	 	$name_cert = $_FILES['organization_certificate']['name'];
		$target_dir_cert = "../admin/orgCert/";
		$target_file_cert = $target_dir_cert . basename($_FILES['organization_certificate']['name']);

		// select file type
		$imagefileType_cert = strtolower (pathinfo($target_file_cert, PATHINFO_EXTENSION));

		//valid file extensions
		$extensions_arr_cert = array("jpg", "jpeg", "png", "gif");

		$update_query = "UPDATE organization_details  SET organization_name ='".$_POST['organization_name']."',
														  organization_mission = '".$_POST['organization_mission']."',
														  organization_vision =  '".$_POST['organization_vision']."',
													      organization_date_established = '".$_POST['organization_date_established']."'
														
														  WHERE user_id =".$id."";

		$update_profile = mysqli_query($sql,$update_query);
	 		if($update_profile){
	 		header("location:organization_profile.php");
	 		
			}else{ "ERROR IN QUERY";	
		}
}
		move_uploaded_file($_FILES['user_prof_pic']['tmp_name'], $target_dir.$name);

?>
