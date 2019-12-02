<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$prodi = $_POST['prodi'];
	$email = $_POST['email'];
	
	if($crud->buat($nim,$nama,$kelas,$prodi,$email,$_SESSION['admin_id']))
	{
		header("Location: tambah_pemilih.php?inserted");
	}
	else
	{
		header("Location: tambah_pemilih.php?failure");
	}
}


?>

 <?php include('element/header.php') ?>
 <body class="cbp-spmenu-push">
 	<div class="main-content">
 		<!--left-fixed -navigation-->
 		<?php include('element/sidebar.php') ?>
 		<!--left-fixed -navigation-->
 		<!-- header-starts -->
 		<?php include('element/profile.php') ?>
 		<!-- //header-ends -->
 		<!-- main content start-->
 		<div id="page-wrapper">
 			<div class="main-page">
 			<p>
				<?php
					if(isset($_GET['inserted']))
					{
						?>
					    <div class="container">
						<div class="alert alert-info">
					    <strong>Selamat!</strong>1 Record Pemilih telah sukses tersimpan di <a href="data_pemilih.php">Data Pemilih</a>!
						</div>
						</div>
					    <?php
					}
					else if(isset($_GET['failure']))
					{
						?>
					    <div class="container">
						<div class="alert alert-warning">
					    <strong>ERROR!</strong> Record Gagal disimpan !
						</div>
						</div>
					    <?php
					}
				?>
			</p>
 				<h3 class="title1">Tambah Data Pemilih :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post">
								
								<div class="form-group">
									<label for="NIM" class="col-sm-2 control-label">NIM</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="NIM" name="nim" placeholder="Masukan NIM...">
									</div>
								</div>

								<div class="form-group">
									<label for="nama" class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="nama" name="nama" placeholder="Masukan Nama...">
									</div>
								</div>

								<div class="form-group">
									<label for="kelas" class="col-sm-2 control-label">Kelas</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="kelas" name="kelas" placeholder="Masukan Semester+Kelas... (contoh : 5C)">
									</div>
								</div>

								<div class="form-group">
									<label for="angkatan" class="col-sm-2 control-label">Prodi</label>
									<div class="col-sm-8">
										<select class="form-control1" name="prodi">
											<option>-Pilih Prodi-</option>
											<option>D4-Teknik Informatika</option>
											<option>D3-Akuntansi</option>
											<option>D3-Farmasi</option>
											<option>D3-Kebidanan</option>
											<option>D3-Teknik Elektro</option>
											<option>D3-Teknik Komputer</option>
											<option>D3-Teknik Mesin</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">E-Mail</label>
									<div class="col-sm-8">
										<input type="email" class="form-control1" id="email" name="email" placeholder="Masukan Alamat Email....">
									</div>
								</div>

								<h3><button type="submit" name="btn-save" class="label label-success">Simpan</button>  <a href="data_pemilih.php" class="label label-default">Cancel</a></h3>
								
							</form>
 			</div>
 		</div>
 		<!--footer-->
 		<div class="footer">
 			<p>&copy; 2017 - E-Vote BEM 2017</p>
 		</div>
 		<!--//footer-->
 	</div>
 	<!-- Classie -->
 	<script src="js/classie.js"></script>
 	<script>
 		var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
 		showLeftPush = document.getElementById( 'showLeftPush' ),
 		body = document.body;

 		showLeftPush.onclick = function() {
 			classie.toggle( this, 'active' );
 			classie.toggle( body, 'cbp-spmenu-push-toright' );
 			classie.toggle( menuLeft, 'cbp-spmenu-open' );
 			disableOther( 'showLeftPush' );
 		};

 		function disableOther( button ) {
 			if( button !== 'showLeftPush' ) {
 				classie.toggle( showLeftPush, 'disabled' );
 			}
 		}
 	</script>
 	<?php include('element/footer.php') ?>
 </body>
 </html>