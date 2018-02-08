<?php
include("../sql_connect.php");
session_start();
$id = $_SESSION['num'];
$query = "SELECT organization_status FROM organization_details WHERE user_id = '$id' AND organization_status = 'Pending' OR organization_status = 'Rejected'";
$data = mysqli_query($sql, $query);



$row=mysqli_fetch_array($data);
$status[]=$row['organization_status'];


echo json_encode($status);
?>