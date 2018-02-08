<?php 
require("../sql_connect.php");
session_start();
$output = array();
$id = $_GET['cid'];
$query = "SELECT A.volunteer_id, A.org_id, B.first_name, B.last_name, C.organization_name
FROM follow A, user B, organization_details C
WHERE A.volunteer_id=B.user_id
AND C.user_id=A.org_id
AND A.volunteer_id='$id'";
$data = mysqli_query($sql, $query);
if ($data){
	while($row=mysqli_fetch_array($data)){
		$org_id = $row['org_id'];
		$org_query = "SELECT * FROM user WHERE user_id = '$org_id'";
		$org_data = mysqli_query($sql, $org_query);
		while ($org_row = mysqli_fetch_array($org_data)){
		$output[] = $org_row;
		}
	}
	echo json_encode($output);
}
?>