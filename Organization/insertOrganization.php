<?php
require ("../sql_connect.php");

$recipient = $_POST['email_address'];
$recipientName = $_POST['organization_name'];
//email initialization 
use PHPMailer\PHPMailer\PHPMailer;
require ("../phpmailer/vendor/autoload.php");
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "daphnecomendador@gmail.com";
$mail->Password = "/*^d@phy!997&";
$mail->setFrom('webportal@gmail.com', 'iHelp');
$mail->addReplyTo('daphnecomendador@gmail.com', 'Daphne');
$mail->addAddress($recipient, $recipientName);
$mail->Subject = 'Welcome to iHelp '.$recipientName.'';
$mail->msgHTML(file_get_contents('../org_confirmation.php'), __DIR__);
$mail->AltBody = 'This is a plain-text message body';

//prof pic
$name = $_FILES['user_prof_pic']['name'];
$target_dir = "../admin/userProfPic/";
$target_file = $target_dir . basename($_FILES['user_prof_pic']['name']);

// select file type
$imagefileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));

//valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

//implode advocacy
if (isset($_POST['advocacy'])){
  $checkedAdv = $_POST['advocacy'];
  $impAdv = array();
  foreach($checkedAdv as $advocacies){
    $impAdv[] = $advocacies;
  }
  $insertAdv = implode (", ", $impAdv);
}else{
  echo "select at least 1 advocacy";
}

//set user type
if (isset($_POST['registerOrg'])){
	$userType = 'organization';
}

//insert into user table
$query_user = "INSERT INTO user VALUES ('',
                          '".$_POST['email_address']."',
                          '".$_POST['user_password']."',
						  '$userType',
                          '".$_POST['organization_name']."',
						  '',
						  '',
						  '".$_POST['email_address']."',
						  '".$_POST['user_location']."',
						  '',
						  '',
						  '',
						  '$insertAdv',
						  '$name',
						  NOW()
                          )";

$data_user = mysqli_query($sql, $query_user);
if (!$data_user){
  echo "ERROR IN QUERY";
}else{
	
	$d_id = mysqli_insert_id($sql);
	//echo $d_id;
	$name_cert = $_FILES['organization_certificate']['name'];
	$target_dir_cert = "../admin/orgCert/";
	$target_file_cert = $target_dir_cert . basename($_FILES['organization_certificate']['name']);

	// select file type
	$imagefileType_cert = strtolower (pathinfo($target_file_cert, PATHINFO_EXTENSION));

	//valid file extensions
	$extensions_arr_cert = array("jpg", "jpeg", "png", "gif");


	//insert into user table

	$query_cert = "INSERT INTO organization_details VALUES 	('',
							  '".$_POST['organization_name']."',
							  '".$_POST['organization_mission']."',
							  '".$_POST['organization_vision']."',
							  '".$_POST['organization_date_establihed']."',
							  '$name_cert',
							  '$d_id',
							  NOW()
							  )";

	$data_cert = mysqli_query($sql, $query_cert);
	if (!$data_cert){
	  header("location: 404.php.php");
	}else{
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Email sent!";			
		}
	}
	  
}
 move_uploaded_file($_FILES['user_prof_pic']['tmp_name'], $target_dir.$name);

?>
