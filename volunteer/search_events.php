<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();

    $query= "select * from event where event_name LIKE '%{$key}%'";

    $data = mysqli_query($sql,$query);

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
																<button class="btn btn-warning" data-target='.$row['event_id'].'>View </button> 
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
				$(".volresources").attr("href", "volunteerResources.php?cid="+event_id);
				initMap(event_location);
				prereg(event_id);

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

</script>