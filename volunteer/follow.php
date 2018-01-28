<?php
include("../sql_connect.php");
session_start();
$vol_id = $_SESSION['num'];
$org_id = $_GET['org'];

//query para volunteer
$query = "SELECT * FROM user WHERE user_id = $vol_id";
$data = mysqli_query($sql,$query);
$row = mysqli_fetch_array($data);
$first_name = $row['first_name'];
$last_name = $row['last_name'];


//query para org
$org_query = "SELECT * FROM user WHERE user_id = $org_id";
$org_data = mysqli_query($sql,$org_query);
$org_row = mysqli_fetch_array($org_data);
$org_name=$org_row['first_name'];

//follow org query
$user_query = "INSERT INTO follow VALUES ('',
												$vol_id,
												'$org_id',
												NOW())";

$user_data = mysqli_query($sql,$user_query);

$select_query = "SELECT * FROM follow WHERE volunteer_id = $vol_id AND org_id = $org_id";
$select_data = mysqli_query($sql, $select_query);													

$output = array();
while($select_row = mysqli_fetch_assoc($select_data)){
	$output[] = $select_row;
}

echo json_encode($output);



		
	





?>