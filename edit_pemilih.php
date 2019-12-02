<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';

if(isset($_POST['btn-update']))
{
	$nim = $_GET['id'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$prodi = $_POST['prodi'];
	$email = $_POST['email'];
	
	if($crud->update($nim,$nama,$kelas,$prodi,$email))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Selamat</strong> Record telah berhasil diubah di <a href='data_pemilih.php'>Data Pemilih</a>!
				</div>";
	}

	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>ERROR!</strong> Update Record Gagal !
				</div>";
	}
}

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	extract($crud->getID($id));	
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
				if(isset($msg))
				{
					echo $msg;
				}
			?>
		
			</p>
 				<h3 class="title1">Edit Data Pemilih :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post">
								
								<div class="form-group">
									<label for="NIM" class="col-sm-2 control-label">NIM</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="NIM" value="<?php echo $id; ?>" name="nim" disabled="disabled" placeholder="Masukan NIM... "></>
									</div>
								</div>

								<div class="form-group">
									<label for="nama" class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="nama" name="nama" placeholder="Masukan nama" value="<?php echo $nama; ?>"></input>
									</div>
								</div>

								<div class="form-group">
									<label for="kelas" class="col-sm-2 control-label">Kelas</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="kelas" value="<?php echo $kelas; ?>" name="kelas" placeholder="Masukan Semester+Kelas... (contoh : 5C)">
									</div>
								</div>

								<div class="form-group">
									<label for="angkatan" class="col-sm-2 control-label">Prodi</label>
									<div class="col-sm-8">
										<select class="form-control1" name="prodi">
											<option><?php echo $prodi; ?></option>
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
										<input type="email" class="form-control1" id="email" name="email" value="<?php echo $email; ?>" placeholder="Masukan Alamat Email....">
									</div>
								</div>

								<h3><button type="submit" name="btn-update" class="label label-success">Simpan</button>  <a href="data_pemilih.php" class="label label-default">Cancel</a></h3>
								
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