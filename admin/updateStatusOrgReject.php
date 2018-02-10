<?php
session_start();

include('../sql_connect.php');
$id = $_POST['id'];

$check = "SELECT * FROM organization_details WHERE user_id = '$id'";
$info = mysqli_query($sql, $check);
$row = mysqli_fetch_array($info);

echo $row['organization_status'];

if($row['organization_status'] == "Pending"){
	$query = "UPDATE organization_details SET organization_status ='Approved' WHERE user_id = '$id'";
}else{
	$query = "UPDATE user SET user_status ='Active' WHERE user_id = '$id'";
}

mysqli_query($sql,$query) or die(mysqli_error($sql));

?>

