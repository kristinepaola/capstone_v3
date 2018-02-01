<?php
require ("../sql_connect.php");
include ("Header_Organization.php");
$id = $_GET['cid'];

$query = "SELECT A.event_id, B.event_name, C.first_name, C.last_name, A.timestamp, A.user_id 
			FROM event_preregistration A, event B, user C 
			WHERE  A.event_id = '$id'
			AND A.event_id = B.event_id 
			AND A.user_id = C.user_id";
$data = mysqli_query($sql, $query);
if (!$data){
	echo "ERROR IN QUERY!";
}
?>
<html>
<head>
<link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.16/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.16/css/jquery.dataTables.css">
</head>
<body>
<div class='table-responsive'>
	<table id="data" class='table'>
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
					echo "<td>".date("M d, Y h:i A", strtotime($row['timestamp']))."</td>";
					echo "<td><button class='btn btn-success attended att".$row['user_id']."' data-target=".$row['user_id']." id='user".$row['user_id']."'>Attended</button> 
					<button class='btn btn-danger absent ab".$row['user_id']."' data-target=".$row['user_id']." id='user".$row['user_id']."'>Absent</button></td>";
					echo "</tr>";
				}
			}
		
		
		?>
	</table>
</div>
		<!-- END OF ALERT MODAL -->
			<div id="alert" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">SUCCESS</h4>
					</div>
					<div class="modal-body">
						<center><strong class="text-success">Attendance Checked</strong></center>
					</div> 
				  </div>
				</div>
			  </div
			<!-- END OF ALERT MODAL -->
</body>
</html>
<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/DataTables/datatables.min.js"></script>
<script src="../assets/DataTables/datatables.js"></script>

<script>
	$(document).ready(function(){
		$('#data').DataTable();
		
		allAbsent();
		allPresent();
		$(".absent").on("click", function(){
			user_id = $(this).data("target");
			$(this).hide();
			absent(user_id);
		});
		$(".attended").on("click", function(){
			user_id = $(this).data("target");
			$(this).hide();
			attended(user_id);
		});
	});
	function absent(user_id){
		var x = $.ajax({
			url: "attendance.php",
			method: "POST",
			data: {
				cid:user_id,
				status:"Absent",
				event_id: "<?php echo $id?>"
			},
			dataType: "json",
			success: function (retval){
				$("#alert").modal("show");
			}
		});
		console.log(x);
	}
		function attended(user_id){
		var x = $.ajax({
			url: "attendance.php",
			method: "POST",
			data: {
				cid:user_id,
				status:"Present",
				event_id: "<?php echo $id?>"
			},
			dataType: "json",
			success: function (retval){
				$("#alert").modal("show");
			}
		});
		console.log(x);
	}
	function allAbsent(){
		var x = $.ajax({
		url: "AllAbsent.php",
		method: "GET",
		data: {id:"<?php echo $id?>"},
		dataType: "json",
		success: function (retval){				
				for(var i=0; i<retval.length; i++){
					 $(".ab"+retval[i].volunteer_id+"").hide();
				}
		}
	});
	}
	function allPresent(){
		var x = $.ajax({
		url: "AllPresent.php",
		method: "GET",
		data: {id:"<?php echo $id?>"},
		dataType: "json",
		success: function (retval){	
				for(var i=0; i<retval.length; i++){
					 $(".att"+retval[i].volunteer_id+"").hide();
				}
		}
	});
	}
</script>