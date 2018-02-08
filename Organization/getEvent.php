<?php
require("../sql_connect.php");
$id = $_GET['cid'];
$query = "SELECT * FROM event WHERE event_id = '$id'";
$data = mysqli_query($sql, $query);

$output = array ();
$occupation = array();

while ($row = mysqli_fetch_assoc($data)){
	$output[] = $row;
}


echo json_encode($output);



?>