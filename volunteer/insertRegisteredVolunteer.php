<?php
session_start();
require ("../sql_connect.php");

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
//$mail->SMTPDebug = 1;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "ihelpmail018@gmail.com";
$mail->Password = "capstone";
$mail->setFrom('ihelpmail018@gmail.com', 'iHelp');
$mail->addReplyTo('ihelpmail018@gmail.com', 'iHelp');
$mail->addAddress($recipient, $recipientName);
$mail->Subject = 'Welcome to iHelp '.$recipientName.'';
$mail->msgHTML(file_get_contents('../vol_confirmation.php'), __DIR__);
$mail->AltBody = 'This is a plain-text message body';


$query = "INSERT INTO user (user_id, user_name, user_password, user_type, first_name, middle_name, last_name, email_address, user_location, user_status, timestamp)
					VALUES ('',
					'".$_POST['email']."',
					md5('".$_POST['pass']."'),
					'$userType',
					'".$_POST['firstName']."',
					'".$_POST['middleName']."',
          			'".$_POST['lastName']."',
          			'".$_POST['email']."',
          			'".$_POST['address']."',
					'Active',
					NOW())";
$res = mysqli_query ($sql, $query);


if($res){
	$id = mysqli_insert_id($sql);
	$query_voldetails = "INSERT INTO volunteer_details (user_id) VALUES ('$id')";
	$res_voldetails = mysqli_query($sql, $query_voldetails);
	if ($res_voldetails){
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			header("location:../login.php");		
		}
		
	}else{
		echo "Error inserting to volunteer_details";
	}
	

}else{
	echo "Problem with sql insert";
}

?>
