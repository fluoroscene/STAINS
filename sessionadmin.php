<?php 

session_start();
if(!isset($_SESSION["adm"])) header("Location: login.php");

?>