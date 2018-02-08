<form action="gagu.php" method="POST">
<div class="form-group col-sm-12">
		<label>Age Requirement *</label>
		<label><small>(Provide volunteer characteristics for easier recruitment)</small></label>
	</div>
	<div class="form-group  col-sm-12">
		<div class="form-group col-sm-3">
			<label>Minimum</label>
			<input min="1" max="70" name="age_req[]" type="number" id="num_vol" class="form-control"  required">
		</div>
		<div class="form-group col-sm-3">
			<label>Maximum</label>
			<input min="1" max="70" name="age_req[]" type="number" id="num_vol" class="form-control" required">
		</div>
	</div>	
	<input type='submit' class='btn btn-finish btn-primary pull-right' name='submit' value='Submit' id='submit'/>
</form>
<script>
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
</script>