<?php
session_start();
require("../sql_connect.php");
$event_id = $_GET['id'];
$user_id = $_SESSION['num'];

$query = "SELECT * FROM event_preregistration WHERE user_id = $user_id AND event_id = $event_id";
$data = mysqli_query($sql,$query);

if (mysqli_num_rows($data)!=0){
	$msg = "<h4>You are already pre-registered to this event</h4>";
	$ret = array($msg, $event_id);
}

echo json_encode($ret);

?>