<!Doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Comptatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Table Test</title>
	<link rel="stylesheet" href="test/css/bootstrap.css">
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css">
</head>
<body onload="viewData()">
	<div class="container" style="margin-top:35px">
		<h4>Edit Table Test</h4>
		<table id="tabledit" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>No. of Missed Activities</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</body>
</html>
<script src="test/js/bootstrap.js"></script>
<script src="test/jquery.js"></script>
<script src="plugins/jquery.tabledit.js"></script>

<script>
		function viewData(){
			$.ajax({
				url: "Model/a_edit.php?p=view",
				method: "GET"
			}).done(function(data){
				$("tbody").html(data)
				tableData()
			})
		}
		function tableData(){
			$("#tabledit").Tabledit({
				url: "Model/a_edit.php",
    			editButton: true,
    			deleteButton: false,
    			hideIdentifier: true,
    			buttons: {
			        edit: {
			            class: "btn btn-sm btn-success",
			            html: "<span class='glyphicon glyphicon-pencil'></span>EDIT",
			            action: "edit"
			        },
			        save: {
			            class: "btn btn-sm btn-warning",
			            html: "Save"
			        }
			    },
				columns: {
					identifier: [0, "id"],
					editable:[[1, "firstname"], [2, "lastname"], [4, 'status', '{"1": "Active", "2": "Blocked"}']]
				},
			    onSuccess: function(data, textStatus, jqXHR) {
			        viewData()
			    },
			     onFail: function(jqXHR, textStatus, errorThrown) {
			        console.log('onFail(jqXHR, textStatus, errorThrown)');
			        console.log(jqXHR);
			        console.log(textStatus);
			        console.log(errorThrown);
			    },
			    onAjax: function(action, serialize) {
			        console.log('onAjax(action, serialize)');
			        console.log(action);
			        console.log(serialize);
			    }
		    });
		}
	</script>