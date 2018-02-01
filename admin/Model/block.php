<html>

<head><title>Updating...</title></head>

<?php
session_start();
include('../sql_connect.php');
$id = $_POST['id'];

$sql = "UPDATE user SET status='Blocked' WHERE user_id = '$id'";

?>
</html>
