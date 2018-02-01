<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();

    //echo $key;
    $query= "select * from user where user_type = 'organization' AND first_name LIKE '%{$key}%'";
    $data = mysqli_query($sql,$query);

    while($row = mysqli_fetch_array($data)){
                                        $org_id = $row['user_id'];
                                        
                                        $org_img = $row['user_prof_pic'];
                                        $img_src = "../admin/userProfPic/".$org_img;
                                        echo '  <div class="col-md-4 p0">
                                                    <div class="box-two proerty-item">
                                                        <div class="item-thumb">
                                                            <a href="" ><img src="'.$img_src.'"></a>
                                                        </div>
                                                        <div class="item-entry overflow">
                                                            <h1><a href="">'.$row['first_name'].'</a></h1>
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