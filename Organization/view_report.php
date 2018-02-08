
<?php 
  include("../sql_connect.php");
  require("Header_Organization.php");
  $id = $_SESSION['num'];



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Organization | Reports</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../admin/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../admin/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../admin/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../admin/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
<body class="hold-transition skin-white layout-top-nav" onload="viewData()">
    <div class="wrapper">
      <header class="main-header">
          <div class="container">
              <div class="navbar-header">
            </div>
          </div>
  </header> 
      <!-- EVENTS -->
  <div class="content-header">
    <section class="content">
      <div class="row">
        <div class="row"> 
          <h1><strong>ORGANIZATION REPORTS</strong></h1>
            <div class="col-md-4" >
            <div class="box box-widget widget-user ">
              <!-- ANOTHER PAGE FOR LIST OF EVENTS -->
            <a href="report_event.php">
            <div class="widget-user-header  bg-gray-active text-black">
              <h3 class="widget-user-username ">
	                   	<?php
                            $count = 0;
                            $query = "SELECT * FROM event WHERE user_id = ".$id."";
                            $data = mysqli_query($sql, $query);

                             while($row = mysqli_fetch_array($data)){
                              $count++;
                             }
                        ?>
                        <strong><?php echo $count?></strong><?php if($count<=1){ echo 'Event';}else{ echo 'Events';}?>
	            </h3>  
            </div>
            <!-- FEEDBACKS -->
            <div class="widget-user-image">
              <img class="img-circle" src="../assets/img/list_event.png">
            </div>
            <div class="box-footer">
                <div class="col-sm-12">
                  <div class="description-block">
                  </div>
                </div>
            </div>
            </a>
          </div>
        </div>
        <!-- FEEDBACK -->
        <div class="col-md-4">                                    
          <div class="box box-widget widget-user">
            <a href="report_feedback.php">
            <div class="widget-user-header  widget-user bg-gray-active text-black">
              <h3 class="widget-user-username">
	                   	<?php
	                   		$count = 0;
	                   		$query = "SELECT * FROM event_feedback WHERE org_id = ".$id."";
                        $data = mysqli_query($sql, $query);

    					         while($row = mysqli_fetch_array($data)){
    					         	$count++;
    					         }
					          ?>
					          <strong><?php echo $count?></strong> <?php if($count<=1){ echo 'Feedback';}else{ echo 'Feedbacks';}?>
	            </h3>
            </div>


            <div class="widget-user-image">
              <img class="img-circle" src="../assets/img/feedback_list.png" alt="User Avatar">
            </div>
          </div>
        </div>
         <div class="col-md-4">                                    
          <div class="box box-widget widget-user">
            <a href="report_follower.php">
            <div class="widget-user-header  widget-user bg-gray-active text-black">
              <h3 class="widget-user-username">
                      <?php
                        $count = 0;
                        $query = "SELECT * FROM follow WHERE org_id = ".$id."";
                        $data = mysqli_query($sql, $query);
 
                       while($row = mysqli_fetch_array($data)){
                        $count++;
                       }
                       ?> 
                    <strong><?php echo $count?></strong> <?php if($count<=1){ echo 'Follower';}else{ echo 'Followers';}?>
              </h3>
            </div>


            <div class="widget-user-image">
              <img class="img-circle" src="../assets/img/feedback_list.png" alt="User Avatar">
            </div>
          </div>
        </div>
        
          
      </div>
    </section>
  </div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
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
<script src="dist/js/demo.js"></script>
<script src="plugins/dataTables/jquery.dataTables.min.js"></script>
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
   alert("Please Like any Framework");
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