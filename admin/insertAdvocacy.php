<?php
require ("../sql_connect.php");
$name = $_FILES['advIcon']['name'];

$target_dir = "advocaciesIcon/";
$target_file = $target_dir . basename($_FILES['advIcon']['name']);

// select file type
$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

//valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

//check
if (in_array($imagefileType, $extensions_arr)){
  //insert record
  $query = "INSERT INTO advocacies VALUES ('',
                            '".$_POST['advName']."',
                            '".$name."'
                            )";

  $data = mysqli_query($sql, $query);
  if (!$data){
    echo "ERROR IN QUERY";
  }else{
    echo "Organization successfully registered";
  }

  //upload file
  move_uploaded_file($_FILES['advIcon']['tmp_name'], $target_dir.$name);

}


?>
