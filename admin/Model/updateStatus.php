<?php
session_start();

include('../sql_connect.php');
$id = $_POST['id'];

$check = "SELECT * FROM user WHERE user_id = '$id'";
$info = mysqli_query($sql, $check);
$row = mysqli_fetch_array($info);

echo $row['user_status'];

if($row['user_status'] == "Active"){
	$query = "UPDATE user SET user_status ='Blocked' WHERE user_id = '$id'";
}else{
	$query = "UPDATE user SET user_status ='Active' WHERE user_id = '$id'";
}

mysqli_query($sql,$query) or die(mysqli_error($sql));

?>

