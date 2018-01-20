<?php
	require ("../sql_connect.php");
	include ("nameTitle.php");
	$query = "SELECT * FROM event WHERE status = ''";
	$data = mysqli_query($sql,$query);
	if (!$data){
		echo "ERROR IN QUERY";
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<body>
	<head>
		<title>iHelp | Events</title>
	</head>
 <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Browse Events From Different Organizations</h1>               
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
                            <div class="page-subheader sorting pl0 pr-10">


                                <ul class="sort-by-list pull-left">
                                    <li class="active">
                                        <a href="javascript:void(0);" class="order_by_date" data-orderby="property_date" data-order="ASC">
                                            Sort by Date <i class="fa fa-sort-amount-asc"></i>					
                                        </a>
                                    </li>
                                </ul><!--/ .sort-by-list-->

                                <div class="items-per-page pull-right">
                                    <label for="items_per_page"><b>Property per page :</b></label>
                                    <div class="sel">
                                        <select id="items_per_page" name="per_page">
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option selected="selected" value="12">12</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                            <option value="60">60</option>
                                        </select>
                                    </div><!--/ .sel-->
                                </div><!--/ .items-per-page-->
                            </div>

                        </div>

                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
									while($row = mysqli_fetch_array($data)){
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
															<div>
																<button class="btn btn-warning view" data-target='.$row['event_id'].'>VIEW </button> 
																<button id = '.$row['event_id'].' class="btn btn-success prereg" data-target='.$row['event_id'].'>Pre Register </button> 
																
															</div>
															<div id="alert'.$row['event_id'].'" class="alert alert-danger red">
																<span>You are already pre-registered in this event</span>.
															</div>
														</div>
													</div>
												</div> ';
									}
									
								
								
								?>
                          
                            </div>
                        </div>

                        <div class="section"> 
                            <div class="pull-right">
                                <div class="pagination">
                                    <ul>
                                        <li><a href="#">Prev</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>                
                        </div>

                    </div>       

                    
                </div>
            </div>
        </div>
		
		
		<!-- READ MORE MODAL! -->
			<div id="readmore" class="modal fade" role="dialog">
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
							<img id="event_img">
							<h6>HOW TO GET THERE</h6>
						</div>
						<div class="col-xs-6">
							<p id="event_description"></p>
							<h6>WHEN</h6>
							<p id="event_start"></p>
							<h6>WHO</h6>
							<p id="occupation"></p>
							<h6>WHAT TO BRING</h6>
							<p id="event_material_req"></p>
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
			
			
			<!-- END OF ALERT MODAL -->
			<div id="alert" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Congratulations!</h4>
					</div>
					<div class="modal-body">
						<center><strong class="text-success">You are successuly pre-registered to this event.</strong></center>
						
					</div> 
				  </div>
				</div>
			  </div>
			</div>
			<!-- END OF ALERT MODAL -->
</body>
</html>
<script src='../fullcalendar/lib/moment.min.js'></script>
<script>
$(document).ready(function(){
	$(".red").hide();
	disableButton();
	$(".view").click(function(){
		var event_id = $(this).data("target");
		viewEvent(event_id);
	});
	$(".prereg").click(function(){
		var event_id = $(this).data("target");
		
		preRegister(event_id);
	});
});

function viewEvent(event_id){
		$.ajax({
			url:"../Organization/getEvent.php",
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
				
				//prereg(event_id);
			}
				
		});
}
function preRegister(event_id){
	var x = $.ajax({
		url: "preRegister.php",
		method: "GET",
		data: {id:event_id},
		dataType: "json",
		success: function(retval){	
			$("#alert").modal("show");
			check(event_id);
		}
	});
	console.log(x);
}
function check(event_id){
	var x = $.ajax({
		url: "checkPreReg.php",
		method: "GET",
		data: {id:event_id},
		dataType: "json",
		success: function (retval){
			var id = retval[1];
			$("#"+id+"").hide();
			$("#alert"+id+"").show();
			$("#notif").show();
		}
	});
}
function disableButton(){
	var x = $.ajax({
		url: "checkAllPreReg.php",
		method: "GET",
		//data: {id:event_id},
		dataType: "json",
		success: function (retval){
				
				for(var i=0; i<retval.length; i++){
					 $("#"+retval[i].event_id+"").hide();
					 $("#alert"+retval[i].event_id+"").show();
					 
				}
		}
	});
	console.log(x);
}


</script>