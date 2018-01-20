<?php
session_start();
require ("../sql_connect.php");


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



if (isset($_POST['registerVolunteer'])){
	$userType = 'volunteer';
}
$recipient = $_POST['email'];
$recipientName = $_POST['firstName'];
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
$mail->msgHTML(file_get_contents('../vol_confirmation.php'), __DIR__);
$mail->AltBody = 'This is a plain-text message body';





$query = "INSERT INTO user VALUES ('',
					'".$_POST['email']."',
					'".$_POST['pass']."',
					'$userType',
					'".$_POST['firstName']."',
					'".$_POST['middleName']."',
          			'".$_POST['lastName']."',
          			'".$_POST['email']."',
          			'".$_POST['address']."',
					'',
					'',
					'',
					'',
					'',
					NOW())";
$res = mysqli_query ($sql, $query);
//$row = mysqli_fetch_array($res);

if($res){
	$id = mysqli_insert_id($sql);
	$query_voldetails = "INSERT INTO volunteer_details (user_id) VALUES ('$id')";
	$res_voldetails = mysqli_query($sql, $query_voldetails);
	if ($res_voldetails){
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Email sent!";			
		}
		//header("location:../login.php");
	}else{
		echo "Error inserting to volunteer_details";
	}
	

}else{
	echo "Problem with sql insert";
}

?>
