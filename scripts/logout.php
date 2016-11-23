<?php
	session_start();
	unset($_SESSION['user']);
	$_POST = array();
	ob_start();
    header('Location: ../index.php');
    ob_end_flush();
    die();
?>