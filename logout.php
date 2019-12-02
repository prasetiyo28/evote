<?php 
session_start();
include_once 'dbconfig.php';


if ($_SESSION['user_id'] > 0) {
	$crud->logout($_SESSION['user_id']);
	unset($_SESSION['user_id']);
	session_destroy();

}elseif ($_SESSION['admin_id'] != '0') {
	$crud->logout($_SESSION['admin_id']);
	unset($_SESSION['admin_id']);
	session_destroy();
}else{
	header("Location: home.php");	
}

header("Location: home.php");
 ?>