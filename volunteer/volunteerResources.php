<?php
include('../sql_connect.php');
include('nameTitle.php');
$id = $_SESSION['num'];
$_SESSION['event_id'] = $_GET['cid'];
$event_id = $_SESSION['event_id'];

?>
<html>
<body>
	<div class="container">
		
	<form action="insert_volunteerResources.php" method="post" enctype="multipart/form-data">
		<label >Add Photo</label>
		<input type="file" class="form-control" id="resources_photo" name="resources_photo" placeholder="Upload Image">
		<label >Resources Name</label>
		<input type="text" class="form-control" id="resources_name" name="resources_name">
		<label >Item Description</label>
		<textarea type="text" class="form-control" id="resources_description" name="resources_description"></textarea>
		<label >No. of Items</label>
		<input type="number" class="form-control" id="no_items" name="no_items"> 	
		<div class="modal-footer">
		
		<input type="submit" name="submit"  value="Submit">
	</form>		
		</div>
	</div>

</body>
</html>