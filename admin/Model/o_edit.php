<?php

include("../sql_connect.php");

$page = isset($_GET['p'])? $_GET['p'] : '' ;

if($page =='view'){
	$result = "SELECT A.user_id, A.user_status, B.organization_name, B.organization_certificate
                      FROM user A, organization_details B
                      WHERE A.user_id = B.user_id AND A.user_type = 'organization'";

                      $info = mysqli_query($sql, $result);

                     while($row = mysqli_fetch_array($info)){
                     	?>	
                     		<tr>
                     			<td><?php echo $row[0] ?></td>
                     			<td><?php echo $row[2] ?></td>
                          <td><?php echo $row[1] ?></td>
                          <td><?php echo $row[3] ?></td>
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