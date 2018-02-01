<?php

include("../sql_connect.php");

$page = isset($_GET['p'])? $_GET['p'] : '' ;

if($page =='view'){
	$result = "SELECT A.event_id, A.event_name, A.event_status, A.event_no_of_people, B.first_name
                      FROM event A, user B
                      WHERE A.user_id = B.user_id";

                      $info = mysqli_query($sql, $result);

                     while($row = mysqli_fetch_array($info)){
                     	?>	
                     		<tr>
                     			<td><?php echo $row[0] ?></td><!--ID-->
                     			<td><?php echo $row[1] ?></td><!--Event Name-->
                     			<td><?php echo $row[4] ?></td><!--Organizer-->
                          <td><?php echo $row[2] ?></td><!--Status-->
                          
                          <?php
                            $count =0;
                            $res = "SELECT *
                                      FROM event_preregistration
                                      WHERE event_id = '$row[0]'";

                                      $in = mysqli_query($sql, $res);
                                      while(mysqli_fetch_array($in)){
                                          $count++;
                                      }
                          ?>
                          <td><?php echo $count ?></td><!--Pre-Registered-->
                          <td><?php echo $row[3] ?></td><!--People Needed-->
                     		</tr>
                     	<?php
                     }

}else{
	header('Content-Type: application/json');

	$input = filter_input_array(INPUT_POST);
  
  
 if ($input['action'] == 'edit') {
        $row = "UPDATE event SET
          event_status = '".$input["stat"]."'
          WHERE event_id = '".$input["id"]."'";

        mysqli_query($sql,$row) or die(mysqli_error($sql));
  } 
  	
}
?>