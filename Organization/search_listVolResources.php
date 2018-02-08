<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();
	//$id = $_GET['cid'];
    //echo $key;
    //$query= "select * from event A, event_advocacy B 
				// where A.event_name LIKE '%{$key}%' OR A.event_description LIKE '%{$key}%' 
				// OR A.event_location LIKE '%{$key}%' 
				// OR B.event_advocacy_id LIKE '%{$key}%'
				// AND B.event_id = A.event_id";
	 $query2 = "SELECT A.event_id, A.timestamp, A.resources_name, A.resources_description, A.resources_photo, A.noItems, B.first_name, B.last_name, B.user_id
		// FROM volunteer_resources A, user B
		// WHERE B.first_name LIKE '%{$key}%';
		// ";
		$query3 = "SELECT * FROM volunteer_resources WHERE resources_name LIKE '%barb%'";
		
		$query4 = "SELECT A.resources_name, A.resources_description, A.resources_photo, A.noItems, B.first_name, B.last_name, A.user_id
					FROM volunteer_resources A, user B
					WHERE A.user_id = B.user_id
					AND B.first_name LIKE '%{$key}%'
					OR A.resources_name LIKE '%{$key}%'
					OR B.last_name LIKE '%{$key}%'";
		$data = mysqli_query($sql,$query4);


		while($row = mysqli_fetch_array($data)){
					$item_img = $row['resources_photo'];
					$img_src = "../admin/volunteerResourcesImages/".$item_img;
					echo "<td><img src=".$img_src." class='img'></td>";
					echo "<td>".$row['resources_name']."</td>";
					echo "<td>".$row['resources_description']."</td>";
					echo "<td>".$row['noItems']."</td>";
					echo "<td><a href='../volunteer/publicvolunteerProfile_1.php?id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</td>";
	
		}

?>