<?php
session_start();
require("../sql_connect.php");
$org_id = $_GET['id'];
$vol_id = $_SESSION['num'];

$query = "SELECT * FROM follow WHERE volunteer_id = $vol_id AND org_id = $org_id";
$data = mysqli_query($sql,$query);

if (mysqli_num_rows($data)!=0){
	$msg = "<h4>FOLLOWING</h4>";
	$ret = array($msg, $org_id);
}

echo json_encode($ret);

?>