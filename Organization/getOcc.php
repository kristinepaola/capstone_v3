
<?php
require("../sql_connect.php");
$id = $_GET['cid'];
$occ_query = "SELECT A.occupationName, A.noVolunteers FROM occupation_event A, event B
WHERE A.event_id=B.event_id AND A.event_id='$id'";
$occ_data = mysqli_query($sql, $occ_query);
while ($occ_row = mysqli_fetch_assoc($occ_data)){
	$occupation[]=$occ_row;
}
echo json_encode($occupation);
?>