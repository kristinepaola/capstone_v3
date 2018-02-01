<?php
require("../sql_connect.php");


//RECOMMENDED
$recommended_query = "SELECT DISTINCT A.advocacy_name, B.advocacy_id, B.event_id, C.event_name, C.user_id, D.user_id, D.first_name, D.advocacies, E.organization_name
FROM advocacies A, event_advocacy B, event C, user D, organization_details E
WHERE A.advocacy_id = B.advocacy_id 
AND B.event_id = C.event_id 
AND D.user_id = 13
AND C.user_id = E.user_id
Group by c.event_name";
$recommended_data = mysqli_query($sql, $recommended_query);

echo $recommended_query."<br>";
?>
<html>
	<table border='1px'>
		<thead>
		<th>advocacy name</th>
		<th>advocacy id</th>
		<th>event id</th>
		<th>event name</th>
		<th>org id</th>
		<th>vol id</th>
		<th>first name</th>
		<th>advocacies</th>
		<th>org_name</th>
	</thead>
	<?php
	while($row = mysqli_fetch_array($recommended_data)){
		$exp = explode (', ', $row['advocacies']);
		$size = count($exp);
		
		for ($i=0; $i<$size; $i++){
			if ($exp[$i] == $row['advocacy_name']){
				
				echo $row['event_name']."<br>";
			}
		}
		
		$org_id = $row[4];
		$event_adv = $row['advocacy_name']."<br>";	
		echo "<tr>";
			echo "<td>".$row['advocacy_name']."</td>";
			echo "<td>".$row['advocacy_id']."</td>";
			echo "<td>".$row['event_id']."</td>";
			echo "<td>".$row['event_name']."</td>";
			echo "<td>".$org_id."</td>";
			echo "<td>".$row['user_id']."</td>";
			echo "<td>".$row['first_name']."</td>";
			echo "<td>".$row['advocacies']."</td>";
			echo "<td>".$row['organization_name']."</td>";
		echo "</tr>";
	}
	?>
	</table>
</html>