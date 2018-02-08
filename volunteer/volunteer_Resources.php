<?php
include('../sql_connect.php');
include('nameTitle.php');
$id = $_SESSION['num'];
$_SESSION['event_id'] = $_GET['cid'];
$event_id = $_SESSION['event_id'];

?>

<html class="no-js"> 
	<head>
		<link rel="stylesheet" href="../assets/css/icheck.min_all.css">
		
	</head>
    <body>
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
					<div class="col-sm-10 col-sm-offset-1 profiel-container">
						<form action="insert_volunteerResources.php" method="POST" enctype="multipart/form-data">
									<hr>
									<div class="profiel-header">
										<h3>
											<b>VOLUNTEERED</b> Resources<br>
											<small>Fill in the required (*) fields below. You can now share your Resources.</small>
										</h3>
										<hr>
									</div>

									<div class="clear">
										<div class="col-sm-6">
											<div class="form-group col-sm-12">
												<i class="fa fa-picture-o"></i> <label>Image *</label>  
												<input name="resources_photo" type="file" id="resources_photo">
											</div>
											<div class="form-group col-sm-12" >
												<i class="fa fa-wrench"></i> <label>Resources Name *</small></label>
												<input required name="resources_name" type="text" id="resources_name" class="form-control">
											</div> 
										</div>
										<div class="col-sm-6">
											<div class="form-group col-sm-12">
												<i class="fa fa-align-left"></i><label>Item Description *</label>
												<label><small>(You can specify the uses and instructions of your volunteered resources.)</small></label>
												<textarea required name="resources_description" id="resources_description" rows ="3" class="form-control"></textarea>
											</div> 
											<div class="form-group col-sm-8">
												<i class="fa fa-plus-square"></i> <label>No. of Items *</label>
												<input required name="no_items" type="text" id="no_items" class="form-control">
											</div> 
										</div>
									</div>
									<hr>
									<div class="form-group col-sm-12">
										<div class="col-sm-10 col-sm-offset-1">
											<input type='submit' class='btn btn-finish btn-primary pull-right' name='submit' value='Submit' id='submit'/>
										</div>	
									</div>
					</div>
						</form>					
					</div>             	
                </div>
            </div>
        </div>
    </body>
</html>