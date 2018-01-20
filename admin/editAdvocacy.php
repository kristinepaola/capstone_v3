<?php
	require ("../sql_connect.php");
	session_start();
	$id = $_GET['id'];
	$_SESSION['id'] = $id;
	$query = "SELECT * FROM advocacies WHERE advocacy_id = ".$id."";
	$data = mysqli_query($sql, $query);
	if (!$data){
		echo "ERROR IN QUERY"; 
	}else{
	$row = mysqli_fetch_array($data);
	}
?>
<html>
<body>
  <form method="POST" action="updateAdvocacy.php" enctype="multipart/form-data">
    Advocacy Name: <input type="text" name="advName" value="<?php echo $row[1];?>" required><br>
    Icon <input type="file" name="advIcon" value="<?php echo $row[2]; ?>" required><br>
    <input type="submit" name="submit" value="SUBMIT">
  </form>
</body>
</html>
