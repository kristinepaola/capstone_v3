<?php
require ("../sql_connect.php");
include ("Header_Organization.php");
$id = $_GET['cid'];

$query = "SELECT A.event_id, B.event_name, C.first_name, C.last_name, A.timestamp FROM event_preregistration A, event B, user C WHERE  A.event_id = B.event_id AND A.user_id = C.user_id";
echo $query;
$data = mysqli_query($sql, $query);
if (!$data){
	echo "ERROR IN QUERY!";
}
?>
<html>
<head>
</head>
<body>
<div class='table-responsive'>
	<table class='table'>
		<tr>
			<th><h4>Name</h4></th>
			<th><h4>Date Pre Registered</h4></th>
			<th><h4>Attendance</h4></th>
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