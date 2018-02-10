<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();

    //echo $key;
    $query= "select * from user where user_type = 'organization' and first_name LIKE '%{$key}%'";
	// $query2 = "SELECT * FROM user A, organization_details B
			// WHERE user_type = 'Organization' AND 
			// A.user_location LIKE '%{$key}%' 
			// OR A.advocacies LIKE '%{$key}%' OR A.first_name LIKE '%{$key}%' OR B.organization_mission LIKE '%{$key}%' OR B.organization_vision LIKE '%{$key}%' A.user_location";
    $data = mysqli_query($sql,$query);

    while($row = mysqli_fetch_array($data)){
                                        
                                    }
    
?>