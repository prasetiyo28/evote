<?php 
include_once 'dbconfig.php';
$id = $_GET['id'];
	
	if($crud->hapus($id))
	{
		header("Location: data_pemilih.php");
	}
	else
	{
		header("Location: data_pemilih.php");
	}
?>