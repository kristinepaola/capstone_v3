<?php
require ("../sql_connect.php");
session_start();

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
echo $insertAdv;

$id = $_SESSION['num'];
$first_name = $_POST['fname'];
$middle_name = $_POST['Mname'];
$last_name = $_POST['lname'];
$user_location = $_POST['user_location'];
$volunteer_birthday = $_POST['birthday'];
$volunteer_occupation = $_POST['occupation'];
$volunteer_schedule =$_POST['schedule'];
$volunteer_about_me = $_POST['aboutMe'];
$volunteer_hobbies = $_POST['hobbies'];

$query = "UPDATE `user` SET `first_name` = '$first_name',
						`middle_name` = '$middle_name',
						`last_name` = '$last_name',
						`user_location` = '$user_location',
						`advocacies` = '$insertAdv'
						WHERE `user_id` = $id";



$det_query = "UPDATE `volunteer_details` SET  `volunteer_birthday` = '$volunteer_birthday',
							`volunteer_occupation` = '$volunteer_occupation',
							`volunteer_schedule` = '$volunteer_schedule',
							`volunteer_about_me` = '$volunteer_about_me',
							`volunteer_hobbies` = '$volunteer_hobbies'
							WHERE `user_id` = $id";
		

$result = mysqli_query($sql, $query);

if ($result){
		$det_result = mysqli_query($sql, $det_query);
		if (!$det_result){
			echo "problem inserting to volunteer_details";
		}else{
			header("location:volunteerProfile_1.php");
		} 
	}
else{
echo "Problem with sql update!";
}

?>