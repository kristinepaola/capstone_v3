<?php
session_start();
 if(empty($_SESSION['num'])){
     header('location:../index.php');
 }


?>