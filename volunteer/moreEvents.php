<?php
	require ("../sql_connect.php");
	include ("nameTitle.php");
	$org_id = $_GET['id'];
	$id = $_SESSION['num'];
	$query = "SELECT A.event_id, A.user_id, B.event_name, B.event_description, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
	FROM event_preregistration A, event B, user C
	WHERE C.user_id = '$id'
	AND A.event_id = B.event_id
	AND A.user_id = C.user_id
	AND B.event_status = 'Upcoming'";
	$data = mysqli_query($sql,$query);

	
	$number_Result = mysqli_num_rows($data);
	if (!$data){
		echo "ERROR IN QUERY";
	}
	$result_per_page = 5;
    $numberPage = ceil($number_Result/$result_per_page);

	 if(!isset($_GET['page'])) {
		$page = 1;
	 }else{
		$page = $_GET['page'];
	 }

	$page_first_result = ($page-1)*$result_per_page;

	 $page_query = "SELECT A.event_id, A.user_id, B.event_name, B.event_description, C.first_name, C.last_name, B.event_img, B.event_start, B.event_location
	FROM event_preregistration A, event B, user C
	WHERE C.user_id = '$id'
	AND A.event_id = B.event_id
	AND A.user_id = C.user_id
	AND B.event_status = 'Upcoming' LIMIT ".$page_first_result.", ".$result_per_page."";
	 $page_data = mysqli_query($sql, $page_query);	
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<body>
	<head>
		<title>More Events</title>
	</head>
 <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">More Events</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FFF;">
            <div class="container">   
                <div class="row">

                    <div class="col-md-9 pr-30 padding-top-40 properties-page user-properties">
                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
									while($row = mysqli_fetch_array($page_data)){
										$event_image = $row['event_img'];
										$img_src = "../admin/eventImages/".$event_image;
										echo '	<div class="col-md-4 p0">
													<div class="box-two proerty-item">
														<div class="item-thumb">
															<a href="" ><img src="'.$img_src.'"></a>
														</div>
														<div class="item-entry overflow">
															<h5><a href="">'.$row['event_name'].'</a></h5>
															<div class="dot-hr"></div>
															<span class="pull-left"><b>Location :</b> '.$row['event_location'].' </span>
															<span class="proerty-price pull-right">'.date("M d Y h:i A", strtotime($row['event_start'])).'</span>
															<p style="display: none;">'.$row['event_description'].'.</p>
															<div class="property-icon">
																<button class="btn btn-warning view" data-target='.$row['event_id'].'>VIEW </button>
															</div>
														</div>
													</div>
												</div> ';
									}
									
								
								
								?>
                          
                            </div>
                        </div>
						<div class="section"> 
							 <div class="section-pagination"> 
								<div class="pull-right">
									<div class="pagination">
										<ul>
										<?php if ($number_Result == $result_per_page){
											echo "";
										}else{
											for ($page=1; $page<=$numberPage; $page++) {
											echo'<li><a href="events.php?page='.($page-1).'">Prev</a></li>
											<li><a href="events.php?page='. $page .'">'.$page.'</a></li>
											<li><a href="events.php?page='.($page+1).'">Next</a></li>';	}
										}									
										?>

										</ul>
									</div>
								</div>                
							</div>
						</div>

                    </div>       

                    
                </div>
            </div>
        </div>
		
		
				<!-- READ MORE MODAL! -->
			<div id="readmore" class="modal fade bd-example-modal-lg" role="dialog">
			  <div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="event_title"></h4>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-xs-6">
							<div class="col-xs-12">
								<img id="event_img">
								<h6>HOW TO GET THERE</h6>
								<div id="floating-panel">
								<b>Start: </b>
								<input type = "text" id = "start" class="form-control">
								</div>
								<div id="map"></div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-12">
								<p id="event_description"></p>
								<h6>WHERE</h6>
								<p id="event_location"></p>
								<h6>WHEN</h6>
								<p id="event_start"></p>
								<h6>WHO</h6>
								<p id="occupation"></p>
								<h6>WHAT TO BRING</h6>
								<p id="event_material_req"></p>
								<a class="prereg">View Pre-Registered Volunteers</a><br>
								<a class="volresources">View Volunteered Resources</a>
							</div>
						</div>
					</div> 
				  </div>
				  <div class="modal-footer">
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>
			<!-- END OF READ MORE MODAL -->
</body>
</html>
<script src='fullcalendar/lib/moment.min.js'></script>
<script>
	$(document).ready(function(){

		
		
		$(".view").click(function(){
			var event_id = $(this).data("target");
			console.log(event_id);
			fetchData(event_id);
		});
		
		$(".prereg").click(function(){
			var event_id = $(this).data("target");
			fetchDataReg(event_id);
		});

        var page = $("#numRows").val();
        
        if(page <= 3)
        {
            $(".section-pagination").hide();
        }
	
	

});

function fetchData (event_id){
	
	$.ajax({
			url:"getEvent.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",

			success:function(retval){
				$("#event_img").html("");
				$("#event_title").html("");
				$("#event_description").html("");
				$("#event_start").html("");
				$("#event_material_req").html("");
				$("#event_occupation").html("");
				
				event_img = "../admin/eventImages/"+retval[0].event_img;
				event_id = retval[0].event_id;
				event_name = retval[0].event_name;
				event_description = retval[0].event_description;
				event_location = retval[0].event_location;
				event_start = moment().format('MMMM Do YYYY, h:mm a', retval[0].event_start);
				event_material_req = retval[0].event_material_req;
				
				
				$("#event_img").attr("src", event_img);
				$("#event_title").append(event_name);
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				$("#readmore").modal("show");
				
				prereg(event_id);

			}
				
		});
}

function fetchDataReg(event_id){
	$.ajax({
			url:"volunteer/preRegister.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",

			success:function(retval){
				$(".prereg").attr("disabled", true);

			}
	});
}
	
function prereg(event_id){
	$("#prereg").on("click", function(){
			$.ajax({
			url:"volunteer/preRegister.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",

			success:function(retval){
				$(".prereg").attr("disabled", true);

			}
				
		});
	})

}
	

</script>