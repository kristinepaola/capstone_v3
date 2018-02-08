$(document).ready(function(){
	//check num of volunteers 
	$("#num_vol_1").focusout(function(){
		var num_vol_1 = parseInt($("#num_vol_1").val());
		console.log(num_vol_1);
		addMoreVol(num_vol_1);
		addOcc(num_vol_1);
	});	
	//check date
		var x = $("#daterange").blur(function(){
			var date = $(this).val();
			console.log(date);
			var x = $.ajax({
				url: "checkDate.php",
				method: "GET",
				data: {event_start:date},
				dataType: "json",
				success: function(resp){
					if(resp[1] == 1){
						alert("ERROR: Cannot at event with the same date and time.");
						$("#submit").remove();
					}else{
						alert("Date and Time is available");
						$("#submit").show();
					}
				}
			});
			console.log(x);
		});
	var disp_date = moment().add(1, 'days');
	
	//date range picker
	$('#daterange').daterangepicker({
			"timePicker": true,
			"minDate": disp_date,
			 "endDate": disp_date,
			 "locale": {
				format: 'MM/DD/YYYY h:mm A'
			}
	});

   var display = '<div id="container"><div class="form-group col-sm-12"><div class="form-group col-sm-3"><label>Qty</label><input required name="no_volunteer[]" type="number" id="no_volunteer" class="form-control"></div><div class="form-group col-sm-6"><label>Occupation Name </label><input required name="occupation_name[]" type="text" id="occupation_name" class="form-control"></div><div class="form-group col-sm-3"><label>Delete</label><a class="btn btn-danger" id="delete_occ"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';
	//add an occupation field
	  $("#add").click(function(e){
		  e.preventDefault();
		$("#container").append(display);
	  });
	//remove an occupation field
	  $("#container").on("click", "#delete_occ", function(e){
		e.preventDefault();
		$(this).parentsUntil("#container").remove();
	  });
	//add partnership field
	  $("#addPartnership").click(function(e){
		e.preventDefault();
		fetch();
	  });
	//remove occupation field
	  $("#partnership").on("click", "#delete_partner", function(e){
		e.preventDefault();
		$(this).parentsUntil("#partnership").remove();
		y--;
	  });
});
//add occ
function addOcc(num_vol_1){
	$("#no_volunteer_1").val(num_vol_1);
}

//add more vol qty
function addMoreVol(num_vol_1){
	var max = 3;
	var i = 1;
	//add volunteer gender req field
	$("#add_vol").click(function(e){
		e.preventDefault();
		if (i < max){
			i++;
		var addvol_display = '<div id="volunteers"><div class="form-group col-sm-12"><div class="form-group col-sm-3"><label>Qty</label><input required min="1" name="num_vol[]" type="number" id="num_vol_'+i+'" class="form-control"></div><div class="form-group col-sm-6"><label>Gender Requirement</label><select name="event_gender_req" class="form-control" required><option value="Both(Female/Male)">Both(Female/Male)</option><option value="Female">Female</option><option value="Male">Male</option></select></div><div class="form-group col-sm-3"><label>Remove</label><a class="btn btn-danger" id="delete_vol"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';
		$("#volunteers").append(addvol_display);
			$("#num_vol_"+i+"").focusout(function(){
				var cur_num_vol = parseInt($("#num_vol_"+i+"").val());
				num_vol_1 = num_vol_1 + cur_num_vol;
				console.log(num_vol_1);
				addMoreVol(num_vol_1);
			});
		}
	});	
	  //remove volunteer gender req field
	$("#volunteers").on("click", "#delete_vol", function(e){
		e.preventDefault();
		$(this).parentsUntil("#volunteers").remove();
		var cur_num_vol = parseInt($("#num_vol_"+i+"").val());
		var num_vol_1 = parseInt(num_vol_1 - cur_num_vol);
		console.log(num_vol_1);
		i--;
	});	
}


//get organization list for partnership
function fetch(){

	var orgList = '<div id="partnership"><div class="form-group col-sm-12"><div class="form-group col-sm-6"><label>Organization Name</label><select name="partnership[]" class="form-control"><option></option>';
		var x = $.ajax({
			url: "displayListOrg.php",
			method: "POST",
			dataType: "json",
			success: function(retval){
				var count = retval.length;
				for (var i = 0; i<count; i++){
					 orgList +="<option>"+retval[i].organization_name+"</option>";			
				}
					orgList += '</select></div><div class="form-group col-sm-3"><label>Delete</label><a class="btn btn-danger" id="delete_partner"><span class="glyphicon glyphicon-minus"></span></a></div></div></div>';    
					$("#partnership").append(orgList);					
			}
		});
		console.log(x);
	}
//google search API
function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.3157, lng: 123.8854},
          zoom: 15,
          mapTypeId: 'roadmap'
        });
		
		var input = document.getElementById('event_location');
        var searchBox = new google.maps.places.SearchBox(input);
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		
		map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
		
		var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
			 var marker = new google.maps.Marker({
				  position: place.geometry.location,
				  map: map
				});
  
            markers.push(new google.maps.Marker({
              map: map,
              icon: marker,
              title: place.name,
              position: place.geometry.location
            }));
            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgEyPsYueUh9jVTH4aXp0H3sDUGQz0rRM&libraries=places&callback=initAutocomplete" async defer></script>
	</script>
