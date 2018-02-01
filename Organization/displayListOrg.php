<?php 
require("../sql_connect.php");
session_start();
$output = array();
$query = "SELECT * FROM  follow WHERE user_status = 'Pending' AND user_type = 'organization'";
$data = mysqli_query($sql, $query);
if ($data){
	while($row=mysqli_fetch_array($data)){
		$output[] = $vol_row;
		}
	}
	echo json_encode($output);
?>