<?php 
require("../sql_connect.php");
session_start();
$output = array();
$id = $_GET['cid'];
$query = "SELECT * FROM  follow where org_id = ".$id."";
$data = mysqli_query($sql, $query);
if ($data){
	while($row=mysqli_fetch_array($data)){
		$vol_id = $row['volunteer_id'];
		$vol_query = "SELECT * FROM user WHERE user_id = '$vol_id'";
		$vol_data = mysqli_query($sql, $vol_query);
		while ($vol_row = mysqli_fetch_array($vol_data)){
		$output[] = $vol_row;
		}
	}
	echo json_encode($output);
}
?>