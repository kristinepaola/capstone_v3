<?php
require("../sql_connect.php");

$query = "UPDATE event_partnership SET status = '".$_POST['status']."' WHERE event_id = ".$_POST['id']."";
$data = mysqli_query($sql, $query);

if ($_POST['status'] == 'Accepted'){
	$msg = 1;
}else{
	$msg = 0;
}
echo json_encode($msg);
?>