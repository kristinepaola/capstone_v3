<?php
require ("../sql_connect.php");
session_start();
$id = $_SESSION['num'];





//implode advocacy
if (isset($_POST['advocacy'])){
  $checkedAdv = $_POST['advocacy'];
  $impAdv = array();
  foreach($checkedAdv as $advocacies){
    $impAdv[] = $advocacies;
	$adv_query = "INSERT INTO volunteer_advocacy VALUES ('',
														$advocacies,		
														'$id'
														)";
	$adv_data = mysqli_query ($sql, $adv_query);
	echo $adv_query;
  }
  $insertAdv = implode (", ", $impAdv);
}else{
  echo "select at least 1 advocacy";
}


$id = $_SESSION['num'];
$first_name = $_POST['fname'];
$middle_name = $_POST['Mname'];
$last_name = $_POST['lname'];
$user_location = $_POST['user_location'];
$volunteer_birthday = $_POST['birthday'];
$volunteer_occupation = $_POST['occupation'];
$volunteer_about_me = $_POST['aboutMe'];
$volunteer_hobbies = $_POST['hobbies'];


//age
$from = new DateTime($volunteer_birthday);
$to   = new DateTime('today');
echo $from->diff($to)->y;

$query = "UPDATE `user` SET `first_name` = '$first_name',
						`middle_name` = '$middle_name',
						`last_name` = '$last_name',
						`user_location` = '$user_location',
						`advocacies` = '$insertAdv'
						WHERE `user_id` = $id";



$det_query = "UPDATE `volunteer_details` SET  `volunteer_birthday` = '$volunteer_birthday',
							`volunteer_occupation` = '$volunteer_occupation',
							`volunteer_about_me` = '$volunteer_about_me',
							`volunteer_hobbies` = '$volunteer_hobbies'
							WHERE `user_id` = $id";
		

$result = mysqli_query($sql, $query);

if ($result){
		$det_result = mysqli_query($sql, $det_query);
		if (!$det_result){
			echo "problem inserting to volunteer_details";
		}else{
			header("location:volunteerProfile.php");
		} 
	}
else{
echo "Problem with sql update!";
}

?>