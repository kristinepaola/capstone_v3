<?php
require("../sql_connect.php");

$query = "INSERT INTO occupations  VALUES ('','".$_POST['occ']."')";
$data = mysqli_query ($sql, $query);

if ($data){
	header("location: addOcc.php");
}
?>