<?php 
require("../sql_connect.php");
session_start();
$output = array();
$query = "SELECT organization_name FROM organization_details WHERE organization_status = 'Approved'";
$data = mysqli_query($sql, $query);
if ($data){
	while($row=mysqli_fetch_array($data)){
		$output[] = $row;
		}
	}
	echo json_encode($output);
?>