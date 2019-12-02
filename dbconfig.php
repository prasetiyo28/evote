<?php

try
{
	$con = new PDO('mysql:host=localhost;dbname=db_voting', 'root', '', array(PDO::ATTR_PERSISTENT => true));
	//echo "success";
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

include_once 'crudclass.php';
$crud = new crud($con);

?>