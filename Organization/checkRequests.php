<?php
session_start();
require("../sql_connect.php");
$id = $_GET['id'];
$output = array();
$query="SELECT * FROM event_partnership WHERE status = 'Accepted' OR status = 'Rejected' AND partner_org_id = '$id'";
$data = mysqli_query($sql, $query);

while($row=mysqli_fetch_assoc($data)){
	$output[] = $row;
}

echo json_encode($output);
?>