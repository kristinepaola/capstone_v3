<?php

include("../sql_connect.php");

$page = isset($_GET['p'])? $_GET['p'] : '' ;

if($page =='view'){
	$result = "SELECT *
             FROM user 
             WHERE user_type = 'volunteer'";

                      $info = mysqli_query($sql, $result);

                     while($row = mysqli_fetch_array($info)){
                     	?>	
                     		<tr>
                     			<td><?php echo $row[0] ?></td>
                     			<td><?php echo $row[4] ?></td><!--First Name-->
                     			<td><?php echo $row[6] ?></td><!--Last Name-->
                     			<td><?php echo $row[9] ?></td><!--Missed Activities-->
                     			<td><?php echo $row[12] ?></td><!--User Status-->
                     		</tr>
                     	<?php
                     }

}else{
	header('Content-Type: application/json');

	$input = filter_input_array(INPUT_POST);

	if ($input['action'] == 'edit') {
    if($input["firstname"] != '' && $input["lastname"]){
      $row = "UPDATE user SET
      first_name = '".$input["firstname"]."',
      last_name = '".$input["lastname"]."',
      status = '".$input["stat"]."'
      WHERE user_id = '".$input["id"]."'";

      mysqli_query($sql,$row) or die(mysqli_error($sql));
    }else{
      alert("Invalid Input!");
    }
	} 
}
?>