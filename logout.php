<?php

// AYAW HILABTI ANG NAKA COMMENT
// require_once 'fbConfig.php';


// unset($_SESSION['facebook_access_token']);


unset($_SESSION['userData']);
	session_start();
	session_destroy();
	header("location: index.php");

?>