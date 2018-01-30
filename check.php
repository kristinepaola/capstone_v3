
<html>

<head><title>Checking...</title></head>

<?php
session_start();
include('sql_connect.php');

$id = $_POST['id'];

$result = mysqli_query($sql,"SELECT * FROM user WHERE user_name='".$id[0]."' AND user_password = md5('".$id[1]."')")
or die(mysqli_error($sql));
$result = mysqli_fetch_array($result);
if($result){
    $_SESSION['num'] = $result[0];
    $_SESSION['user'] = $result[1];
    $_SESSION['identifier'] = $result[3];
    $_SESSION['profPic'] = $result[13];
	
    if($_SESSION['identifier'] == 'volunteer'){
      header('location:volunteer/volunteerHome.php');
    }else if($_SESSION['identifier'] == 'organization'){
      header('location:Organization/organization_dashboard.php');
    }else{
      header('location:admin/admin_dashboard.php');
    }
}else{
    $_SESSION['notThere'] = 1;
    header('location:login.php');
}
?>
</html>
