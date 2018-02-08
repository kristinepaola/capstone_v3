<?php 
require("../sql_connect.php");
session_start();
$output = array();
$query = "SELECT occupation_name FROM occupations";
$data = mysqli_query($sql, $query);
if ($data){
	while($row=mysqli_fetch_array($data)){
		$output[] = $row;
		}
	}
	echo json_encode($output);
?>