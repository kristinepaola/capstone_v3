<?php
//action.php
include('../sql_connect.php');
if(isset($_POST["user_type"]))
{
 $query = "
  INSERT INTO user(user_type) VALUES('".$_POST["user_type"]."')
 ";
 mysqli_query($connect, $query);
 $sub_query = "
   SELECT user_type, count(*) as no_of_like FROM user 
   GROUP BY user_type
   ORDER BY user_id ASC";
 $result = mysqli_query($connect, $sub_query);
 $data = array();
 while($row = mysqli_fetch_array($result))
 {
  $data[] = array(
   'label'  => $row["user_type"],
   'value'  => $row["no_of_like"]
  );
 }
 $data = json_encode($data);
 echo $data;
}
?>
