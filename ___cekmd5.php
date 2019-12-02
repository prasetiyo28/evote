<?php 

include_once 'dbconfig.php';
extract($crud->cekpilih(15090080));
$token =  $enc_password;	
$nim = $nim;

$url_reset = "http://localhost/evote/reset_password.php?token=".$token."&k1m13b4l=".$nim;
echo $url_reset;

//$pass = md5("admin");


//echo $pass;
// $admin = 'admin';
// $nim = '15090079';
// $act = "'".$admin . " menambahkan data pemilih dengan nim " . $nim . "'";
//  echo $act;
 ?>