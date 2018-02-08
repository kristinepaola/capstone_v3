<?php
session_start();
require ("../sql_connect.php");
require ("../phpmailer/vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
$id = $_SESSION['num'];

//get image
$file = $_FILES['eventImage']['name'];
$target_dir ="../admin/eventImages/";
$target_file = $target_dir . basename ($_FILES['eventImage']['name']);
// select file type
$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));
//valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

//explode date-time 
$exp = explode(" - ", $_POST['daterange']);
$start = date("Y-m-d H:i:s", strtotime($exp[0]));
$end = date("Y-m-d H:i:s", strtotime($exp[1]));
//for each to get sum of no. vol needed
$total=0;
foreach($_POST['no_volunteer'] as $numvol){
	$total=$total+$numvol;
}
//escape string other even details
$event_name = $sql->real_escape_string($_POST['event_name']);
$event_description = $sql->real_escape_string($_POST['event_description']);
$event_location = $sql->real_escape_string($_POST['event_location']);
$event_material_req = $sql->real_escape_string($_POST['event_material_req']);
$min_age = $_POST['age_req'][0];
$max_age = $_POST['age_req'][1];


$org = "SELECT * FROM organization_details WHERE user_id = '$id'";
$org_data = mysqli_query($sql, $data);
$org_row = mysqli_fetch_array($org_data);
$org_name = $org_row['organization_name'];

$addevent_query ="INSERT INTO event VALUES ('',                                           
                                  '$event_name',
                                  '$event_description',
                                  '$event_location',
                                  '$start',
                                  '$end',
                                  '$event_material_req',
									'$min_age',
									'$max_age',
                                  '$file',
                                   '$id',
								   'Upcoming',
								   '$total',
									0,
								   NOW()
                                  )";
$addevent_data = mysqli_query ($sql, $addevent_query);
if (!$addevent_data){
	echo "ERROR IN QUERY 1";
}
	$d_id = mysqli_insert_id($sql);
	//insert to event_adv table
	foreach($_POST['advocacy'] as $advocacy){
		$adv_query = "INSERT INTO event_advocacy VALUES ('', ".$d_id.", ".$advocacy.")";
		$adv_data = mysqli_query($sql, $adv_query);
		echo $adv_query."<br>";
		if(!$adv_data){
			"ERROR IN QUERY 2";
		}
	}
echo $addevent_query."<br>";
//implode partnership
if (isset($_POST['partnership'])){
  $selPartnership = $_POST['partnership'];
  $impPartnership = array();
  foreach($selPartnership as $partnership){
    $impPartnership[] = $partnership;
	$partner_query = "INSERT INTO event_partnership VALUES ('',
															'$partnership',
															'$d_id',
															'Pending')";
	$partner_data = mysqli_query($sql, $partner_query);			
	echo $partner_query;
  }
  $partnership = $sql->real_escape_string(implode (", ", $impPartnership)); 
}
//daphne code insert occ
$occupationName = $_POST["occupation_name"];
$noVolunteers = $_POST["no_volunteer"];
foreach ($occupationName AS $key => $value){
$addocc_query = "INSERT INTO occupation_event VALUES ('',
									   '$d_id',
									   '$id',
									  '".$sql->real_escape_string($value)."',
									  '".$sql->real_escape_string($noVolunteers[$key])."')";
echo $addocc_query."<br>";

$addocc_data = mysqli_query($sql, $addocc_query);
if (!$addocc_data){
	echo "ERROR IN QUERY 3"; 
	}
}


//occupation notif
$get_occ = "SELECT occupationName FROM occupation_event WHERE event_id = $d_id";
$get_data = mysqli_query($sql, $get_occ);
$occ = mysqli_fetch_array($get_data);
$occupation_need = $occ['occupationName'];
$vol_query = "SELECT A.email_address, A.first_name, B.volunteer_occupation FROM user A, volunteer_details B 
WHERE B.volunteer_occupation = '$occupation_need' AND B.user_id = A.user_id";
$vol_data = mysqli_query($sql, $vol_query);
while($vol_row=mysqli_fetch_array($vol_data)){
		//email config
	$mail = new PHPMailer;
	$mail->isSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "ihelpmail018@gmail.com";
	$mail->Password = "capstone";
	$mail->setFrom('webportal@gmail.com', 'iHelp');
	$mail->addReplyTo('ihelpmail018@gmail', 'iHelp');

	$mail->Subject = ''.$org_name.' are currently looking for Volunteers!';
	//$mail->msgHTML(file_get_contents('../org_confirmation.php'), __DIR__);
	$mail->isHTML(true);
	$mail->Body = 'You are invited to join <b><a href="http://localhost/capstone/capstone_v3/volunteer/invitation.php?id='.$d_id.'">'.$event_name.'</a></b>
					
					<br>Click the link to know more about the event.';

	$mail->addAddress($vol_row['email_address'], $vol_row['first_name']);
	//email config
	
	
	if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			header("location: organization_dashboard.php");		
		}
}





move_uploaded_file($_FILES['eventImage']['tmp_name'], $target_dir.$file);
?>
