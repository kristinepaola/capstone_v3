<?php
require ("../sql_connect.php");
session_start();
$id = $_SESSION['num'];

//
$org_query = "SELECT first_name FROM user WHERE user_id = '$id'";
$org_data = mysqli_query ($sql, $org_query);
if ($org_data){
	$org_row = mysqli_fetch_array($org_data);
	$first_name = $org_row['first_name'];
	
}
//echo $org_query;


//add image
$file = $_FILES['eventImage']['name'];
$target_dir ="../admin/eventImages/";
$target_file = $target_dir . basename ($_FILES['eventImage']['name']);
// select file type
$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

//valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

//implode partnership
if (isset($_POST['partnership'])){
  $selPartnership = $_POST['partnership'];
  $impPartnership = array();
  foreach($selPartnership as $partnership){
    $impPartnership[] = $partnership;
  }
  $insertPartnership = implode (", ", $impPartnership);
}

//explode date-time 
$exp = explode(" - ", $_POST['daterange']);
$start = date("Y-m-d H:i:s", strtotime($exp[0]));
$end = date("Y-m-d H:i:s", strtotime($exp[1]));



$addevent_query ="INSERT INTO event VALUES ('',                                           
                                  '".$sql->real_escape_string($_POST['event_name'])."',
                                  '".$sql->real_escape_string($_POST['event_description'])."',
                                  '".$sql->real_escape_string($_POST['event_location'])."',
                                  '".$sql->real_escape_string($start)."',
                                  '".$sql->real_escape_string($end)."',
                                  '".$sql->real_escape_string($_POST['event_material_req'])."',
                                  '".$sql->real_escape_string($_POST['event_age_req'])."',
                                  '".$sql->real_escape_string($_POST['event_gender_req'])."',
                                  '$insertPartnership',
                                  '$file',
                                   '$id',
								   '".$sql->real_escape_string($first_name)."',
								   'Upcoming',
								   '40',	
								   NOW()
                                  )";


$addevent_data = mysqli_query ($sql, $addevent_query);
$d_id = mysqli_insert_id($sql);
   if ($addevent_data)
   {

	//insert to event_adv table
	foreach($_POST['advocacy'] as $advocacy){
		$adv_query = "INSERT INTO event_advocacy VALUES ('', ".$d_id.", ".$advocacy.")";
		$adv_data = mysqli_query($sql, $adv_query);
	}
	if ($adv_data){
		//daphne code
	   $occupationName = $_POST["occupation_name"];
	   $noVolunteers = $_POST["no_volunteer"];
	   $d_id = mysqli_insert_id($sql);
	   foreach ($occupationName AS $key => $value ){
		 $addocc_query = "INSERT INTO occupation_event VALUES ('',
											   '$d_id',
											   '$id',
											  '".$sql->real_escape_string($value)."',
											  '".$sql->real_escape_string($noVolunteers[$key])."')";

	   $addocc_data = mysqli_query($sql, $addocc_query);
		 if ($addocc_data){
			header("location: organization_dashboard.php");
			echo "<p>Stored to database</p>";
		 }
		 else{
		   
		 }

	   }
	}
    

    

  }
   else {
    echo $sql->error."<br>";
 }

 move_uploaded_file($_FILES['eventImage']['tmp_name'], $target_dir.$file);
?>
