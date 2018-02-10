<?php
include("../sql_connect.php");
session_start();
$user_id = $_SESSION['num'];
$event_id = $_GET['id'];
//$output = array();
//query user occ
$user_query = "SELECT volunteer_occupation FROM volunteer_details WHERE user_id = '$user_id'";
$user_data = mysqli_query ($sql, $user_query);
$user_row = mysqli_fetch_array ($user_data);

$user_occupation = $user_row['volunteer_occupation'];
//compare occ
$req_query = "SELECT A.occupationName, A.noVolunteers, B.event_no_of_people, B.pre_registered_count, B.event_name
FROM occupation_event A, event B
WHERE B.event_id = '$event_id'
AND B.event_id = A.event_id";
$req_data = mysqli_query($sql, $req_query);
while($req_row = mysqli_fetch_array($req_data)){
	$count = $req_row['event_no_of_people'];
	$event_name = $req_row['event_name'];
	$noVolunteers = $req_row['noVolunteers'];
	if ($req_row['occupationName'] == $user_occupation){
		if ($req_row['pre_registered_count'] == $noVolunteers){
			$head = "Sorry! Pre Registratin is already full";
			$text = "Better luck next time";
			$output = array($head, $text);
		}else{
			if ($count > $req_row['pre_registered_count']){
			//pre register volunteer query
			$user_query = "INSERT INTO event_preregistration VALUES ('',
												$event_id,
												$user_id,
												NOW(),
												'unseen')";
			$user_data = mysqli_query($sql,$user_query);
			$update_query = "UPDATE event
				SET pre_registered_count = pre_registered_count + 1
				WHERE event_id = '$event_id'";
			$update_data = mysqli_query($sql, $update_query);
			if ($update_data && $user_data){
			$head = "Congratulations!";
			$text = "You are now Pre-Registered to ".$event_name." See you there!";
			$output = array($head, $text);
			}
			}else{
			$head = "Sorry! Pre Registratin is already full";
			$text = "Better luck next time if!";
			$output = array($head, $text);			
			}
		}

	}elseif ($req_row['occupationName'] == 'No Occupation Required'){
		if ($count > $req_row['pre_registered_count']){
		//pre register volunteer query
		$user_query = "INSERT INTO event_preregistration VALUES ('',
														$event_id,
														$user_id,
														NOW())";
		$user_data = mysqli_query($sql,$user_query);
		$update_query = "UPDATE event
						SET pre_registered_count = pre_registered_count + 1
						WHERE event_id = '$event_id'";
		$update_data = mysqli_query($sql, $update_query);
			if ($update_data && $user_data){
				$head = "Congratulations!";
				$text = "You are now Pre-Registered to ".$event_name." See you there!";
				$output = array($head, $text);
			}
			}else{
				$head = "Sorry! Pre Registratin is already full";
				$text = "Better luck next time!";
				$output = array($head, $text);
					
				}
	}
	else{
		$head = "You cannot pre register to this event";
		$text = "Better luck next time!";
		$output = array($head, $text);
	}
}

echo json_encode($output);








		





?>