<?php
session_start();
require("../sql_connect.php");
$id = $_SESSION['num'];
$event_start = $_POST['event_start'];

//explode date-time 
$exp = explode(" - ", $event_start);
$start = date("Y-m-d H:i:s", strtotime($exp[0]));


$query = "SELECT event_start FROM event WHERE user_id = '$id'";
$data = mysqli_query($sql, $query);

while ($row=mysqli_fetch_array($data)){
	$date = $row['event_start'];
	if ($start == $exp[0]){
		$alert="Cannot create an event with the same date and time";
		$resp = array($alert);
	}
}

echo json_encode($resp);
?>