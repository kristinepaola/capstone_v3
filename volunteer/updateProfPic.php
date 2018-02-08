<?php
require ("../sql_connect.php");
session_start();
$id = $_SESSION['num'];
$name = $_FILES['fileToUpload']['name'];
$target_dir = "../admin/userProfPic/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);

// select file type
$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

//valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

$query = "UPDATE `user` SET user_prof_pic = '$name' WHERE `user_id` = $id";
$data = mysqli_query($sql, $query);
if($data){
	move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir.$name);
	header("location:volunteerProfile_1.php");
}else{
	echo "ERROR IN QUERY";
}


?>