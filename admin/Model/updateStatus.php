<html>

<head><title>Updating...</title></head>

<?php
session_start();
include('../sql_connect.php');
$id = $_POST['id'];

$sql = "UPDATE user SET status='Active' WHERE user_id = '$id' AND status = 'Blocked'";

?>
</html>
