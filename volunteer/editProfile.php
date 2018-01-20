<?php
require ("../sql_connect.php");
include ('nameTitle.php');

$query = "SELECT * FROM user where user_id = '$id'";
$result = mysqli_query ($sql, $query);
if (!$result){
	echo "Error ";
	exit();
}
$row = mysqli_fetch_array ($result);

//query volunteer_details
$det_query = "SELECT * FROM volunteer_details where user_id = '$id'";
$det_result = mysqli_query ($sql, $det_query);
if (!$det_result){
  echo "Error ";
  exit();
}
$det_row = mysqli_fetch_array ($det_result);

$dispAdv_query = "SELECT * FROM advocacies";
$dispAdv_data = mysqli_query ($sql, $dispAdv_query);
if (!$dispAdv_data){
"Error in query";
}
?>

<!DOCTYPE html>
<html class="no-js">
<head>
<title>Edit Profile</title>
		<style>
		 .advicon{
		width: 50px;
		height: 50px;
		margin-right: 10px;
	  }
		</style>
</head>
    <body>
        <!-- Body content -->

        <!-- End of nav bar -->

        <div class="page-head">
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Edit Profile</h1>

                    </div>
                </div>
            </div>
        </div>
        <div class="content-area submit-property" style="background-color: #FCFCFC;">&nbsp;
			<div class="container">
			<div class="clearfix" >
			<div class="wizard-container">
				<div class="wizard-card ct-wizard-orange" id="wizardProperty">
					<div class="tab-content">
						<div class="row p-b-15">
							<div class="col-sm-4 col-sm-offset-1">
								<div class="picture-container">
									<div class="picture">
									<form method="POST" action="updateProfPic.php" enctype="multipart/form-data">
										<label>Upload Picture</label>
										<?php
										$name = $row['user_prof_pic'];
										$img_src = "../admin/userProfPic/" .$name;
										
										if ($name == ""){
											echo '<img src="../admin/default.gif"></a>';
										}else{
											echo '<img src="'.$img_src.'"></a>';
										}
										?>
										<input type="file" name="fileToUpload" id="fileToUpload">
										<button type="submit" name="submit"class="btn btn-default">Update Profile Picture</button>
									</form>
									</div>
								</div>
							</div>
<form method = "POST" action = "update.php" enctype="multipart/form-data">
								<div class="col-sm-6">
									<div class="form-group">
									<label>First Name</label>
									<input type = "text" name = "fname" value="<?php echo $row['first_name'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Middle Name</label>
									<input type = "text" name = "Mname" value="<?php echo $row['middle_name'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Last Name</label>
									<input type = "text" name = "lname" value="<?php echo $row['last_name'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Location</label>
									<input type = "text" name = "user_location" value="<?php echo $row['user_location'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Birthday</label>
									<input type = "date" name = "birthday" value="<?php echo $det_row['volunteer_birthday'];?>" class="form-control">
									</div>
									<div class="form-group">
									 <label>Occupation </label>
									 <input type = "text" name = "occupation" value="<?php echo $det_row['volunteer_occupation'];?>" class="form-control">
									 </div>
									 <div class="form-group">
									<label>Schedule </label>
									<input type = "text" name = "schedule" value="<?php echo $det_row['volunteer_schedule'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>About Me: </label>
									<input type = "text" name = "aboutMe" value="<?php echo $det_row['volunteer_about_me'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Hobbies: </label>
									<input type = "text" name = "hobbies" value="<?php echo $det_row['volunteer_hobbies'];?>" class="form-control">
									</div>
									<div class="form-group">
									<label>Select Advocacies:</label><br>
									<?php
									while ($row = mysqli_fetch_array($dispAdv_data)){
											$advicon = $row['advocacy_icon'];
											$img_src = "../admin/advocaciesIcon/".$advicon;
										
												echo "<img src='".$img_src."' class='advicon'>";
												
												echo "<input class='form-control' type='checkbox' name = 'advocacy[]' value='".$row['advocacy_name']."' id='check'> ".$row['advocacy_name']."<br>";
		
									}
									?>
									
									</div>
									<div class="form-group">
										<button type="submit" name="submit"class="btn btn-default">Save</button>
									</div>
								 </div>
						 </div>
					</div>
				</div>
			</div>
	</div>
	<div class="content-area submit-property" style="background-color: #FCFCFC;">&nbsp;	
			
	</div>
</form>
</div>
</div>
    </body>
</html>
