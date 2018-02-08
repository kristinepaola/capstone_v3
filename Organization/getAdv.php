<?php 
session_start();
require("../sql_connect.php");
$output = array();
$id = $_GET['cid'];
$useradv_query = "SELECT A.advocacy_name, A.advocacy_icon, B.event_id
FROM advocacies A, event B, event_advocacy C
WHERE A.advocacy_id = C.advocacy_id
AND B.event_id = C.event_id
AND B.event_id='$id'";

$useradv_data = mysqli_query ($sql, $useradv_query);

while ($row = mysqli_fetch_assoc($useradv_data)){
	$output[]=$row['advocacy_icon'];
}		


echo json_encode($output);
?>