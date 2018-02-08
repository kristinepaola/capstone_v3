<?php
require("../sql_connect.php");

$query = "SELECT A.event_id, A.user_id, B.first_name, C.event_name, C.event_start 
		FROM event_preregistration A, user B, event C
		WHERE A.event_id = C.event_id
		AND A.user_id = B.user_id
		AND A.event_id = 88";
$data = mysqli_query($sql, $query);
$row = mysqli_fetch_array($data);
echo $query."<br>";
echo $row['event_start'];
?>