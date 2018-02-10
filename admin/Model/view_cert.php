<?php
require("../sql_connect.php");
$id = $_GET['cid'];

$query = "SELECT * FROM organization_details WHERE user_id = "$id"";
$data = mysqli_query($sql, $query);

$output = array();

while ($row = mysqli_fetch_assoc($data)){
	$output[] = $row;
}

echo json_encode($output);

?>