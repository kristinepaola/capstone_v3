<?php
$conn = new mysqli("localhost","root","","webportal");

$countUser=0;
$countEvent=0;
$countVol =0;

$query="SELECT * FROM user WHERE notif_status = 'unseen' OR notif_status = '' AND user_type = 'organization'";
$result=mysqli_query($conn, $query);
$countUser=mysqli_num_rows($result);

$query2="SELECT * FROM event WHERE notif_status = 'unseen' OR notif_status = ''";
$result2=mysqli_query($conn, $query2);
$countEvent=mysqli_num_rows($result2);

$query3="SELECT * FROM user WHERE notif_status = 'unseen' OR notif_status = '' AND user_type = 'volunteer'";
$result3=mysqli_query($conn, $query3);
$countVol=mysqli_num_rows($result3);


    if($countEvent == 0 AND $countUser == 0 AND $countVol == 0){
      echo "There are no notifications!";
    }
          echo '<div id="notificationsBody" class="notifications">
            <li><a href="org.php">'. $countUser . ' New Organization/s</a></li>
            <li><a href="vol.php">'. $countVol . ' New Volunteer/s</a></li>
            <li><a href="eve.php">'. $countEvent . ' New Event/s</a></li>
           </div>
        ';

$sql="UPDATE user SET notif_status = 'seen' WHERE notif_status ='unseen'";	
$result=mysqli_query($conn, $sql);

$sql2="UPDATE event SET notif_status = 'seen' WHERE notif_status ='unseen'";  
$result2=mysqli_query($conn, $sql2);

?>
