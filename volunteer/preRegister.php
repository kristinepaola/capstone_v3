<?php
include("../sql_connect.php");
session_start();
$user_id = $_SESSION['num'];
$event_id = $_GET['id'];



$query = "SELECT * FROM user WHERE user_id = $user_id";
$data = mysqli_query($sql,$query);
$row = mysqli_fetch_array($data);
$first_name=$row['first_name'];
$last_name=$row['last_name'];


//check if na pre registered na ba
$check_query = "SELECT * FROM event_preregistration";
$check_data = mysqli_query($sql,$check_query);
$cnt = mysqli_num_rows($check_data);
$check_row = mysqli_fetch_array($check_data);
//echo $cnt;
//loop through event_preregistration table

//pre register volunteer query
$user_query = "INSERT INTO event_preregistration VALUES ('',
												$event_id,
												$user_id,
												'$first_name',
												'$last_name',
												NOW())";

$user_data = mysqli_query($sql,$user_query);
$select_query = "SELECT * FROM event_preregistration WHERE user_id = $user_id AND event_id = $event_id";
$select_data = mysqli_query($sql, $select_query);													

$output = array();
while($select_row = mysqli_fetch_assoc($select_data)){
	$output[] = $select_row;
}

echo json_encode($output);
		
	





?>