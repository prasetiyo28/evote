<?php
include_once 'dbconfig.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Latihan OOP PHP CRUD | Asep Kohar</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" > 
<link href="bootstrap/css/main.css" rel="stylesheet" > 
</head>

<body>
<br/>
<div class="container">
    <div class="jumbotron">
        <div class="container">
            <h1>Latihan PDO</h1>
            <p>Contoh crud sederhana</p>
            <p>
                <a href="tambah_record.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-plus"></i> 
                &nbsp; Tambah Record</a>
            </p>
        </div>
    </div>
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Nama</th>
     <th>Email</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT * FROM pemilih";       
		$records_per_page=3;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->lihatdata($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
</table>
   
       
</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>