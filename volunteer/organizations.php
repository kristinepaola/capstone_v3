<?php
	require ("../sql_connect.php");
	include ("nameTitle.php");

	$result_per_page = 5;
	$query = "SELECT * FROM user WHERE user_type = 'organization'";
	$data = mysqli_query($sql,$query);
	$number_Result = mysqli_num_rows($data);
	if (!$data){
		echo "ERROR IN QUERY";
	}

	$numberPage = ceil($number_Result/$result_per_page);

     if(!isset($_GET['page'])) {
        $page = 1;
     }else{
        $page = $_GET['page'];
     }
    
    $page_first_result = ($page-1)*$result_per_page;

     $page_query = "SELECT * FROM user WHERE user_type = 'organization'LIMIT ".$page_first_result.", ".$result_per_page."";
     $page_query;
    $page_data = mysqli_query($sql,$page_query);
   $page_query;
	
	
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
		<style>
			.glyphicon glyphicon-heart{
				font-size: 50px;
				color:#ff0000;
			}
			.pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 2px 18px;
            text-decoration: roboto;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {background-color: #ffde4c;}

			
		</style>
	</head>
 <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Browse Organizations</h1>               
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
                                    <!-- <label for="items_per_page"><b>Property per page :</b></label>
                                    <div class="sel">
                                        <select id="items_per_page" name="per_page">
                                            <option value="3" selected="selected">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
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
                                 echo '<div class="pagination">
                                        <a href="organizations.php?page='.($page-1).'">&laquo;</a>
                                        <a href for ($page=1; $page<=$numberPage; $page++) {  
                                    echo <a href="organizations.php?page='. $page .'">'.$page.'</a>
                                      
                                       <a href="organizations.php?page='.($page+1).'">&raquo;</a>
                                    </div>';
									while($row = mysqli_fetch_array($page_data)){
										$org_id = $row['user_id'];
										$org_img = $row['user_prof_pic'];
										$img_src = "../admin/userProfPic/".$org_img;
										echo '	<div class="col-md-4 p0">
													<div class="box-two proerty-item">
														<div class="item-thumb">
															<a href="" ><img src="'.$img_src.'"></a>
														</div>
														<div class="item-entry overflow">
															<h1><a href="organization_profile_public.php?id='.$row['user_id'].'">'.$row['first_name'].'</a></h1>
															 <h5>Location:<a href="">'.$row['user_location'].'</h5>
                                                            <h6>Advocacies:<a href="">'.$row['advocacies'].'</h6>
															<button type="button" class="btn-lg btn-success follow" data-target='.$row['user_id'].' id='.$row['user_id'].'>
															  <center><span class="glyphicon glyphicon-heart" aria-hidden="true" ></span></center>
															</button>
															
															<div class="following-alert red" id="alert'.$row['user_id'].'">
																<h5 class="text-danger">Following</h5>
															</div>
														</div>
													</div>
												</div> ';
									}
									
								
								
								?>
                          
                            </div>
                        </div>
                        <input type="hidden" id="numRows" value=<?php echo $num_rows ?> />

                        <div class="section-pagination"> 
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
		<!-- END OF ALERT MODAL -->
			<div id="alert" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">FOLLOWED</h4>
					</div>
					<div class="modal-body">
						<center><strong class="text-success">You have followed this Organization</strong></center>
						<p class="text-center">See you there!</p>
					</div> 
				  </div>
				</div>
			  </div>
			<!-- END OF ALERT MODAL -->
</body>
</html>
<script>
	$(document).ready(function(){
		$(".red").hide();
		disableButton();
		$(".follow").on("click", function(){
			var org_id = $(this).data("target");
			console.log(org_id);
			heart(org_id);
		})

		var test = $("#numRows").val();
		//alert(test);
		if(test <= 3)
		{
			$(".section-pagination").hide();
		}
		
	});
	function heart(org_id){
			
			var x = $.ajax({
				url: "follow.php",
				method: "GET",
				data: {org:org_id},
				dataType: "json",
				success: function (retval){
					$("#alert").modal("show");
					check(org_id);
			
		}
	});
	}
	function check(org_id){
	var x = $.ajax({
		url: "checkFollow.php",
		method: "GET",
		data: {id:org_id},
		dataType: "json",
		success: function (retval){
			var id = retval[1];
			$("#"+id+"").hide();
			$("#alert"+id+"").show();
		}
	});
}
function disableButton(){
	var x = $.ajax({
		url: "checkAllFollow.php",
		method: "GET",
		//data: {id:event_id},
		dataType: "json",
		success: function (retval){
				
				for(var i=0; i<retval.length; i++){
					 $("#"+retval[i].org_id+"").hide();
					 $("#alert"+retval[i].org_id+"").show();
					 
				}
		}
	});
	console.log(x);
}
	

</script>