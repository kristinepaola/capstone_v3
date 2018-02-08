<?php
session_start();
require("../sql_connect.php");
$id = $_SESSION['num'];
$event_start = $_GET['event_start'];

//explode date-time 
$exp = explode(" - ", $event_start);
$start = date("Y-m-d H:i:s", strtotime($exp[0]));


$query = "SELECT event_start FROM event WHERE user_id = '$id'";
$data = mysqli_query($sql, $query);

while ($row=mysqli_fetch_array($data)){
	$date = $row['event_start'];
	if ($start == $date){
		$alert="Cannot create an event with the same date and time";
		$ret = 1;
		$resp = array($alert, $ret);
	}else{
		$alert = "Date and Time available!";
		$ret = 0;
		$resp = array($alert, $ret);
	}
}
echo json_encode($resp);
?>