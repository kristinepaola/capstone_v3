<?php

include("../sql_connect.php");

$page = isset($_GET['p'])? $_GET['p'] : '' ;

if($page =='view'){
	$result = "SELECT A.user_id, A.user_status, A.timestamp, B.organization_name, B.organization_mission, B.organization_vision
                      FROM user A, organization_details B
                      WHERE A.user_id = B.user_id AND A.user_type = 'organization'";

                      $info = mysqli_query($sql, $result);

                     while($row = mysqli_fetch_array($info)){
                     	?>	
                     		<tr>
                     			<td><?php echo $row[0] ?></td><!--ID-->
                     			<td><?php echo $row[3] ?></td><!--Org Name-->
                          <td><?php echo $row[4] ?></td><!--Mission-->
                          <td><?php echo $row[5] ?></td><!--Vision-->
                          <td><?php echo $row[1] ?></td><!--Status-->
                     			<td><?php echo $row[2] ?></td><!--Date Registered-->
                     		</tr>
                     	<?php
                     }

}else{
	header('Content-Type: application/json');

	$input = filter_input_array(INPUT_POST);

	if ($input['action'] == 'edit') {
		$row = "UPDATE user SET
			status = '".$input["stat"]."'
			WHERE user_id = '".$input["id"]."'";

		mysqli_query($sql,$row) or die(mysqli_error($sql));
	} 
}
?>