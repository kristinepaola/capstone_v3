<?php 
	require ("../sql_connect.php");
	$query = "UPDATE event 
				SET status = 'DONE'
				WHERE event_id = ".$_GET['id']."";
	
	$data = mysqli_query ($sql, $query);
	if($data){
		header("location:organization_dashboard.php");
	}else{
		echo "ERROR IN QUERY";
	}
?>