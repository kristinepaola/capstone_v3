<?php
session_start();
require("../sql_connect.php");
$output=array();
$id=$_GET['cid'];
$query = "SELECT A.event_id, A.partner_org, B.organization_name 
FROM event_partnership A, organization_details B, event C
WHERE A.event_id=C.event_id,
AND A.partner_org_id=B.user_id,
AND A.event_id='$id'
";
$data=mysqli_query($sql, $query);
while($row=mysqli_fetch_array($data)){
	$output[]=$row;
}
json_encode($output);
?>