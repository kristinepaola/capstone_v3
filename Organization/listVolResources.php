<?php
require ("../sql_connect.php");
include ("Header_Organization.php");
$id = $_GET['cid'];

$query = "SELECT A.event_id, A.timestamp, A.resources_name, A.resources_description, A.resources_photo, A.noItems, B.first_name, B.last_name, B.user_id
		FROM volunteer_resources A, user B
		WHERE A.user_id = B.user_id
		AND A.event_id = '$id'
		";
$data = mysqli_query($sql, $query);
if (!$data){
	echo "ERROR IN QUERY!";
}
?>
<html>
<head>
	<style>
		.img{
		height: 50px;
		width: 50px
		}
	</style>
</head>
<body>
<div class="container">
	<div class='table-responsive'>
		<div class="col-sm-6 col-lg-6">
			<input type="text" class="form-control" placeholder="search for organizations" id="txtSearch" onKeyUp="txtSearch_submit()">
		</div>

	<table class='table'>
		<tr>
			<th><h4>Image</h4></th>
			<th><h4>Resource Name</h4></th>
			<th><h4>Item Description</h4></th>
			<th><h4>Quantity</h4></th>
			<th><h4>Volunteer Name</h4></th>
		</tr>
		<tr id="suggestion"></tr>
		<?php
			while ($row = mysqli_fetch_array($data)){
					$item_img = $row['resources_photo'];
					$img_src = "../admin/volunteerResourcesImages/".$item_img;
					echo "<tr id='lists'>";
					echo "<td><img src=".$img_src." class='img'></td>";
					echo "<td>".$row['resources_name']."</td>";
					echo "<td>".$row['resources_description']."</td>";
					echo "<td>".$row['noItems']."</td>";
					echo "<td><a href='../volunteer/publicvolunteerProfile_1.php?id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</td>";
					echo "</tr>";
								
			}
		?>
	</table>
	
	</div>
</div>
</body>
</html>
<script src="assets/js/typeahead.min.js"></script>
<script>
function txtSearch_submit()
	  {
	    var search = document.getElementById("txtSearch").value;
	    var xhr;
	    if(window.XMLHttpRequest){
	        xhr = new XMLHttpRequest();
	    }
	    else if(window.ActiveXObject)
	    {
	        xhr = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    var data = "key=" + search;
	    xhr.open("POST", "search_listVolResources.php", true);
	    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	    xhr.send(data);
	    xhr.onreadystatechange = display_data;

	    function display_data()
	    {
	        if(xhr.readyState ==4)
	        {
	            if(xhr.status == 200)
	            {
	                document.getElementById("suggestion").innerHTML = xhr.responseText;
	                document.getElementById("lists").style.display = 'none';
	            }
	            else
	            {
	                alert('There was a problem with the request.')
	            }
	        }
	    }
	  }    
</script>