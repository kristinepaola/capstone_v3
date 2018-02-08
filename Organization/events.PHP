<?php
	require ("../sql_connect.php");
	include ("Header_Organization.php");


	$query = "SELECT * FROM event WHERE event_status = 'Upcoming' ORDER BY event_start ASC ";
	$data = mysqli_query($sql,$query);
 	$number_Result = mysqli_num_rows($data);
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
         .adv{
		  width: 40px;
		  height: 40px;
		  margin: 1px;
		}
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
                                echo '
                                    <div class="col-sm-6 col-lg-6">
                                        <input type="text" class="form-control" placeholder="search for organizations" id="txtSearch" onKeyUp="txtSearch_submit()">

                                      </div>
                                      <div id="suggestion"></div>';
                                      echo '<div id="lists">'; 
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
					<div class="col-xs-12">
						<div class="col-xs-12" id="adv_target"></div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="col-xs-12 padding-bottom-15">
								<label>How To Get There? (Choose your starting point)</label>
							</div>
							<div class="col-xs-12 padding-bottom-15" id="floating-panel">
								<h3><span class='glyphicon glyphicon-map-marker text-success'></span></h3> 
								<input type = "text" id = "start" class="form-control">
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div id="map"></div>
							</div>
							
							
						</div>
						<div class="col-xs-6">
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3><span class='glyphicon glyphicon-calendar'></span></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_description"><span>
								</div>
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-map-marker text-danger'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_location"></span>
								</div>
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-time'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_start"></span>
								</div>																
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-check'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<span id="event_material_req"></span>
								</div>															
							</div>
							<div class="col-xs-12 padding-bottom-15">
								<div class="col-xs-2 padding-bottom-15">
									<h3 class='glyphicon glyphicon-user'></h3>
								</div>
								<div class="col-xs-10 padding-bottom-15">
									<table class='table'>
										<thead>
											<th>Qty</th>
											<th>Occupation</th>
										</thead>
										<tbody id="occ_target"></tbody>
									</table>
								</div>															
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
				$("#event_location").append(event_location);
				$("#event_description").append(event_description);
				$("#event_start").append(event_start);
				$("#event_material_req").append(event_material_req);
				$("#readmore").modal("show");
				occupation(event_id);
				getAdv(event_id);
				prereg(event_id);
				initMap(event_location);
			}
				
		});
}
function getAdv(event_id){
	$.ajax({
		url:"getAdv.php",
		method: "GET",
		data:{
			cid:event_id
		},
		dataType: "json",
		success:function(retval){
			console.log(retval);
			for(var i=0; i<retval.length; i++){
				var adv_icon = "<img src='../admin/advocaciesIcon/"+retval[i]+"' class='adv'>";
				$("#adv_target").append(adv_icon);
			}
		}
	});
}
function occupation(event_id){
	var x = $.ajax({
			url:"getOcc.php",
			method: "GET",
			data:{
				cid:event_id
			},
			dataType: "json",
			success:function(retval){
					$("#occ_target").html("");
				for(var i=0; i<retval.length; i++){
					rowstr = "<tr><td>"+retval[i].noVolunteers+"</td>";
					 rowstr += "<td>"+retval[i].occupationName+"</td>";
					 $("#occ_target").append(rowstr);
				}
				
			}
				
		});	
		console.log(x);
}
function fetchDataReg(event_id){
	$.ajax({
			url:"../volunteer/preRegister.php",
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
function initMap(event_location) {
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 10.3157, lng: 123.8854},
		  zoom: 15,
          mapTypeId: 'roadmap'
        });
        directionsDisplay.setMap(map);
		var input = document.getElementById('start');
		var autocomplete = new google.maps.places.Autocomplete(input);
		
        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('event_location').addEventListener('change', onChangeHandler);
      }
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		  
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('event_location').innerHTML,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}	

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initMap"
        async defer></script>