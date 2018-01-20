<?php
require ("../sql_connect.php");
$query = "SELECT * FROM advocacies";
$data = mysqli_query ($sql, $query);

if (!$data){
	"Erro in query";
	exit();
}
?>
<html>
	<head>
		<title>Advocacies</title>
		
		<link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		
		<style>
			.icondisp{
				height:50px;
				width: 50px
			}
		</style>
	</head>
	<body>
	<div class='container'>
		<table class = "table table-hover">	
			<tr>
				<th>ID</th>
				<th>Adovcacy Name</th>	
				<th>Adovcacy Icon</th>
				<th>Edit Advocacy</th>
			</tr>
			
			<?php
				
				while ($row = mysqli_fetch_array($data)){
					$advocacy_icon = $row[2];
					$img_src = "../admin/advocaciesIcon/".$advocacy_icon;
					echo "<tr>";
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td><img src = '".$img_src."' class='icondisp'></td>";
					echo "<td><a class='btn btn-danger' href='editAdvocacy.php?id=".$row[0]."'>EDIT</a></td>";
					echo "</tr>";
					
				}
			?>
		</table>
	</div>
	</body>
</html>