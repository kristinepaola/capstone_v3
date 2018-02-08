<?php
	require("../sql_connect.php");
	require("Header_Organization.php");
	$id = $_GET['cid'];

	$query = "SELECT A.event_id, B.event_name, C.first_name, C.last_name, A.timestamp, A.user_id 
			FROM event_preregistration A, event B, user C 
			WHERE  A.event_id = '$id'
			AND A.event_id = B.event_id 
			AND A.user_id = C.user_id";

	$data = mysqli_query($sql, $query);
	if(!$data){
		echo "ERROR IN QUERY";
	}

?>
<html>
	<head>
		 <title>Volunteered Resources </title>  
           <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body>
		<div class="container">
            <div class="pull-right">
            </a> 
        </div>
           <br/>
                <h3>iHelp | Pre-Registered Volunteers</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="list_Preregistered" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td width="20%"><center><strong>Name</strong></center></td>
                                    <td width="20%"><center><strong>Date Pre Registered</strong></center></td>
                                    <td width="20%"><center><strong>Attendance</strong></center></td> 
                                    <td width="15%"><center><strong>Status</strong></center></td>  
                               </tr>  
                          </thead>  
                          <?php
							while ($row = mysqli_fetch_array($data)){
								if ($row['event_id'] == $id){
									$i = 0;
									echo "<tr>";
										echo "<td><center><a href='../volunteer/publicvolunteerProfile_1.php?id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</center></td>";
										echo "<td><center>".date("M d, Y h:i A", strtotime($row['timestamp']))."</center></td>";
										echo "<td>
												<center><button class='btn btn-success attended att".$row['user_id']."' data-target=".$row['user_id']." id='user".$row['user_id']."'>Attended</button> 
													<button class='btn btn-danger absent ab".$row['user_id']."' data-target=".$row['user_id']." id='user".$row['user_id']."'>Absent</button></center>
												
											</td>";
										
										echo "<td><strong><center class='target".$row['user_id']."'></center></strong></td>";
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
		$('#list_Preregistered').DataTable();

		allAbsent();
		allPresent();
		$(".absent").on("click", function(){
			user_id = $(this).data("target");
			$(this).remove();
			$('.att'+user_id).remove();
			$('.target'+user_id).append("Absent");
			absent(user_id);
		});
		$(".attended").on("click", function(){
			user_id = $(this).data("target");
			$(this).remove();
			$('.ab'+user_id).remove();
			$('.target'+user_id).append("Present");
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
					 $(".ab"+retval[i].volunteer_id+"").remove();
					 $(".att"+retval[i].volunteer_id+"").remove();
					 $('.target'+retval[i].volunteer_id+"").append("Absent");
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
					 $(".att"+retval[i].volunteer_id+"").remove();
					  $(".ab"+retval[i].volunteer_id+"").remove();
					 $('.target'+retval[i].volunteer_id+"").append("Present");
				}
		}
	});
	}
</script>
					