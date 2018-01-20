<?php
require('../sql_connect.php');
$query = "SELECT user_name FROM user WHERE user_name = '".$_POST['check_mail']."'";
$data = mysqli_query($sql, $query);
$cnt = mysqli_num_rows($data);



if ($cnt!=0){
	$msg = "<small class='text-danger'>This email address already exists</small>";
	$stat = "no";
	$ret = array ($msg, $stat);
}else{
	$msg = "<small class='text-success'>This email address is available</small>";
	$stat = "yes";
	$ret = array ($msg, $stat);
}

echo json_encode($ret);
?>