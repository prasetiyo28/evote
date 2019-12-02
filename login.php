<?php 
session_start();
include_once 'dbconfig.php';


$username = $_POST['username'];
$password = $_POST['password'];

$user_id = $crud->login($username,$password);
//echo $username;
//echo $password;
if ($user_id > 0 ) {
	$_SESSION['user_id'] = $user_id;
	header("Location: pemilihan.php");
}
else{
	$admin_id = $crud->login_admin($username,$password);
	if ($admin_id != '0') {
		$_SESSION['admin_id'] = $admin_id;
		header("Location: admin.php");		
	}else{
		header("Location: home.php?failure");
	}
}


?>