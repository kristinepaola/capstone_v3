<?php 
//index.php
include("../sql_connect.php");

$sub_query = "
   SELECT user_type, count(*) as no_of_like FROM user 
   GROUP BY user_type 
   ORDER BY user_id ASC";
$result = mysqli_query($sql, $sub_query);
$data = array();
while($row = mysqli_fetch_array($result))
{
 $data[] = array(
  'label'  => $row["user_type"],
  'value'  => $row["no_of_like"]
 );
}
$data = json_encode($data);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Volunteers | iHelp</title>
	<link rel="stylesheet" type="text/css" href="plugins/datatable/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="plugins/datatable/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="plugins/datatable/examples/resources/demo.css">
	  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
	  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
	  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
	  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="plugins/datatable/media/js/jquery.dataTables.js">
	</script>
	<script type="text/javascript" language="javascript" src="plugins/datatable/resources/syntax/shCore.js">
	</script>
	<script type="text/javascript" language="javascript" src="plugins/datatable/resources/demo.js">
	</script>
	<script type="text/javascript" language="javascript" class="init">
	

$(document).ready(function() {
	$('#example').DataTable( {
		initComplete: function () {
			this.api().columns().every( function () {
				var column = this;
				var select = $('<select><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
					} );

				column.data().unique().sort().each( function ( d, j ) {
					select.append( '<option value="'+d+'">'+d+'</option>' )
				} );
			} );
		}
	} );
} );
	</script>
</head>
<body class="hold-transition skin-white layout-top-nav" onload="viewData()">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="admin_dashboard.php"><h3>Home</h3></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><h3>Manage Accounts <span class="caret"></span></h3></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="list_volunteers.php"><h3><i class="glyphicon glyphicon-user"></i> Volunteer</h3></a></li>
                    <li class="divider"></li>
                    <li><a href="list_organizations.php"><h3><i class="glyphicon glyphicon-user"></i> Organizations</h3></a></li>
                  </ul>
                </li>
                <li><a href="list_events.php"><h3>Manage Events</h3></a></li>
                <li><a href="reports.php" ><h3>Reports</h3></a></li>
              </ul>
            </div>
            <div class="navbar-custom-menu pull-right" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <h3><img src="assets/image1.jpg" class="user-image" alt="User Image">
                    Welcome Admin!</h3>
                  </a>
                   <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="assets/image1.jpg" class="img-circle" alt="User Image">

                        <p>
                          Admin
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-footer">
                          <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
  </header>
<section class="dt-example">
	<div class="container">
		<section>
			<h1>iHelp |<span> Volunteers</span></h1>
			<div class="demo-html"></div>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Status</th>
						<th>Date Registered</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Status</th>
						<th>Date Registered</th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<th>Kenneth</th>
						<th>Torillo</th>
						<th>Active</th>
						<th>2018-01-18 09</th>
					</tr>
					<tr>
						<th>Mary Eunice</th>
						<th>Valenzuela</th>
						<th>Active</th>
						<th>2018-01-18 09</th>
					</tr>
					<tr>
						<th>Vol 3</th>
						<th>Talamban</th>
						<th>Active</th>
						<th>2018-01-18 09</th>
					</tr>
					<tr>
						<th>Ofelia</th>
						<th>Gabisay</th>
						<th>Active</th>
						<th>2018-01-18 15</th>
					</tr>
					<tr>
						<th>Ofelia Jane</th>
						<th>Gabisay</th>
						<th>Active</th>
						<th>2018-01-18 15</th>
					</tr>
					<tr>
						<th>Joelina</th>
						<th>Mabini</th>
						<th>Active</th>
						<th>2018-01-21 02</th>
					</tr>
					<tr>
						<th>Mariane</th>
						<th>Agas</th>
						<th>Active</th>
						<th>2018-01-21 02</th>
					</tr>
					<tr>
						<th>Kristine Paola</th>
						<th>Nacasabog</th>
						<th>Active</th>
						<th>2018-01-22 02</th>
					</tr>
				</tbody>
			</table>
			<div class="tabs">
				<div class="js">
					<p>The Javascript shown below is used to initialise the table shown in this example:</p><code class="multiline language-js">$(document).ready(function() {
	$('#example').DataTable( {
		initComplete: function () {
			this.api().columns().every( function () {
				var column = this;
				var select = $('&lt;select&gt;&lt;option value=&quot;&quot;&gt;&lt;/option&gt;&lt;/select&gt;')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
					} );

				column.data().unique().sort().each( function ( d, j ) {
					select.append( '&lt;option value=&quot;'+d+'&quot;&gt;'+d+'&lt;/option&gt;' )
				} );
			} );
		}
	} );
} );</code>
				</div>
			</div>
		</section>
	</div>
</section>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
<script>
  $(document).ready(function(){
 
 var donut_chart = Morris.Donut({
     element: 'chart',
     data: <?php echo $data; ?>
    });
  
 $('#like_form').on('submit', function(event){
  event.preventDefault();
  var checked = $('input[name=user_type]:checked', '#like_form').val();
  if(checked == undefined)
  {
   alert("");
   return false;
  }
  else
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"action.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data)
    {
     $('#like_form')[0].reset();
     donut_chart.setData(data);
    }
   });
  }
 });
});
</script>