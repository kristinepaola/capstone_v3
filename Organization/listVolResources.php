<?php
require ("../sql_connect.php");
include ("Header_Organization.php");
$id = $_GET['cid'];

$query = "SELECT * FROM volunteer_resources 
		INNER JOIN user 
		ON user.user_id=volunteer_resources.user_id";
$data = mysqli_query($sql, $query);
if (!$data){
	echo "ERROR IN QUERY!";
}
?>
<html>
<head>
</head>
<body>
<div class="container">
	<div class='table-responsive'>
	<table class='table'>
		<tr>
			<th><h4>Image</h4></th>
			<th><h4>Resource Name</h4></th>
			<th><h4>Item Description</h4></th>
			<th><h4>Quantity</h4></th>
			<th><h4>Volunteer Name</h4></th>
		</tr>
		<?php
			while ($row = mysqli_fetch_array($data)){
				if ($row['event_id'] == $id){
					$i = 0;
					echo "<tr>";
					echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
					echo "<td>".date("F j Y h:i A", strtotime($row[3]))."</td>";
					echo "<td><button class='btn btn-success attended[$i++]' >Attended</button> <button class='btn btn-danger absent' data-target=".$row['user_id']." id=".$row['user_id'].">Absent</button></td>";
					echo "</tr>";
				}
			}
		
		
		?>
	</table>
</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
		allAbsent();
		$(".absent").on("click", function(){
			user_id = $(this).data("target");
			$(this).attr("disabled", "disabled");
			absent(user_id);
		});
	});
	function absent(user_id){
		$.ajax({
			url: "markAbsent.php",
			method: "GET",
			data: {
				cid:user_id
			},
			dataType: "json",
			success: function (retval){
				$(".absent").on("click", function(){
					
				});
			}
		});
	}
	
	function allAbsent(){
		var x = $.ajax({
		url: "AllAbsent.php",
		method: "GET",
		//data: {id:event_id},
		dataType: "json",
		success: function (retval){
				
				for(var i=0; i<retval.length; i++){
					 $("#"+retval[i].user_id+"").hide();
				}
		}
	});
	}
</script>