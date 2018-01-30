<?php
	session_start();
	require ("sql_connect.php");
	include ("Header.php");

	$result_per_page = 5;
	$query = "SELECT * FROM event ";
	$data = mysqli_query($sql,$query);
 	$number_Result = mysqli_num_rows($data);
	if (!$data){
		echo "ERROR IN QUERY";
	}

        // $numberPage = ceil($number_Result/$result_per_page);
        // echo $numberPage;

     if(!isset($_GET['page'])) {
        $page = 1;
     }else{
        $page = $_GET['page'];
     }
    	
    $page_first_result = ($page-1)*$result_per_page;

     $page_query = "SELECT * FROM event LIMIT ".$page_first_result.", ".$result_per_page."";
     $page_data = mysqli_query($sql, $page_query);
     $page_data;

   

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
                            </div>

                        </div>

                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
	                                if($number_Result > $result_per_page){
	                                	echo '<div class="pagination pull-right">
                                        <a href="events.php?page='.($page-1).'">&laquo;</a>
                                        <a href for ($page=1; $page<=$numberPage; $page++) 
                                    	echo <a href="events.php?page='. $page .'">'.$page.'</a>
                                       <a href="events.php?page='.($page+1).'">&raquo;</a>
                                    	</div>';
	                                }else{
	                                	echo '';
	                                }
                                
	                                echo'
                                    <div class="col-sm-6 col-lg-6">
                                        <input type="text" class="form-control" placeholder="search for organizations" id="txtSearch" onKeyUp="txtSearch_submit()">
                                      </div>
                                      <div id="suggestion"></div>';
                                      echo '<div id="lists">'; 
									while($row = mysqli_fetch_array($page_data)){
										$event_image = $row['event_img'];
										$img_src = "admin/eventImages/".$event_image;
										echo '	<div class="col-md-4 p0">
													<div class="box-two proerty-item">
														<div class="item-thumb">
															<a href="" ><img src="'.$img_src.'"></a>
														</div>
														<div class="item-entry overflow">
															<h3><a href="">'.$row['org_name'].'</a></h3>
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
							<h6>DESCRIPTION</h6>
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
</body>
</html>
<script src='fullcalendar/lib/moment.min.js'></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/typeahead.min.js"></script>

<script>
	function txtSearch_submit()
  {
    var search = document.getElementById("txtSearch").value;
    var xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var data = "key=" + search;
    xhr.open("POST", "search_events.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = display_data;

    function display_data()
    {
        if(xhr.readyState ==4)
        {
            if(xhr.status == 200)
            {
                document.getElementById("suggestion").innerHTML = xhr.responseText;
                document.getElementById("lists").style.display = 'none';
            }
            else
            {
                alert('There was a problem with the request.')
            }
        }
    }
  }
	$(document).ready(function(){
		$(".view").click(function(){
			var event_id = $(this).data("target");
			fetchData(event_id);
		});
		
	
	

});

function fetchData (event_id){
	
	$.ajax({
			url:"Organization/getEvent.php",
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
				
				event_img = "admin/eventImages/"+retval[0].event_img;
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
	

</script>