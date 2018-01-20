<?php
	require ("../sql_connect.php");
	session_start();
	$id = $_GET['id'];
	$query = "SELECT * FROM advocacies WHERE advocacy_id = ".$id."";
	$data = mysqli_query($sql, $query);
	if (!$data){
		echo "ERROR IN QUERY"; 
	}else{
		$_SESSION['id'] = $id;
	$row = mysqli_query($data);
?>
<html>
<body>
  <form method="POST" action="updateAdvocacy.php" enctype="multipart/form-data">
    Organization Name: <input type="text" name="advName" required><br>
    Icon <input type="file" name="advIcon" required><br>
    <input type="submit" name="submit" value="SUBMIT">
  </form>
</body>
</html>
