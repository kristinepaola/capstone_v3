<?php
	require ("../sql_connect.php");
	include ("nameTitle.php");

 

	$query = "SELECT * FROM user WHERE user_type = 'organization' ";
	$data = mysqli_query($sql,$query);
    $number_Result = mysqli_num_rows($data);

	
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
            text-align: right;
           
        }

        .pagination a {
            color: black;
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

                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
                                echo '

                                    <div class="col-sm-6 col-lg-6">
                                        <input type="text" class="form-control" placeholder="search for organizations" id="txtSearch" onKeyUp="txtSearch_submit()">

                                      </div>
                                      <div id="suggestion"></div>'
                                      ;

                                    echo '<div id="lists">';
									while($row = mysqli_fetch_array($data)){
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
						<h4 class="modal-title" id="head">Success</h4>
					</div>
					<div class="modal-body">
						<center><strong class="text-success" id="text">You have followed an organization!</strong></center>
						
					</div> 
				  </div>
				</div>
			  </div>
			</div>
			<!-- END OF ALERT MODAL -->
</body>
</html>
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
    xhr.open("POST", "search_vol_organizations.php", true);
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
		$.ajax({
			url:"checkStatus.php",
			method: "GET",
			data:{id:<?php echo$id?>},
			dataType: "json",
			success: function (retval){
				
			}
		});
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
	console.log(x);
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
}
</script>