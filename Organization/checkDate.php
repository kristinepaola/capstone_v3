<?php
require('../sql_connect.php');
$start_date = $_POST['date'];
$query = "SELECT event_start FROM event";
$data = mysqli_query($sql, $query);
$cnt = mysqli_num_rows($data);

while ($row = mysqli_fetch_array($data)){
	if ($start_date == $row['event_start']){
		$msg = "<small class='text-danger'>An event with this time and date already exists!</small>";
		$stat = "no";
		$ret = array ($msg, $stat);
	}else{
		$msg = "<small class='text-success'>No event conflict!</small>";
		$stat = "yes";
		$ret = array ($msg, $stat);
	}
}

]]

echo json_encode($ret);
?>