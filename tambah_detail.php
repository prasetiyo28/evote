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
	$ketua = $_POST['nama_ketua'];
	$prodi_ketua = $_POST['prodi_ketua'];
	$angkatan_ketua = $_POST['angkatan_ketua'];
	$wakil = $_POST['nama_wakil'];
	$prodi_wakil = $_POST['prodi_wakil'];
	$angkatan_wakil = $_POST['angkatan_wakil'];


	
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['file']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];	
	if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		if($ukuran < 1044070){			
			if($crud->buatcalon($ketua,$prodi_ketua,$angkatan_ketua,$wakil,$prodi_wakil,$angkatan_wakil,$file_tmp,$nama))
			{
				header("Location: tambah_calon.php?inserted");
			
				
			}
			else
			{
				header("Location: tambah_calon.php?failure");
			}
		}else{
			echo 'UKURAN FILE TERLALU BESAR';
		}
	}else{
		echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
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
								<strong>Selamat!</strong>1 Record Calon telah sukses tersimpan di <a href="data_calon.php">Data Identitas Calon</a>!
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
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="id_group" class="col-sm-2 control-label">id</label>
							<div class="col-sm-8">
								<select class="form-control1" name="id_group">
									<option>-Pilih Id Group-</option>
									<option>D4-Teknik Informatika</option>
									<option>D3-Akuntansi</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="angkatan_ketua" class="col-sm-2 control-label">Angkatan</label>
							<div class="col-sm-8">
								<select class="form-control1" name="angkatan_ketua">
									<option>-Pilih Tahun Angkatan Ketua-</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label for="nama_wakil" class="col-sm-2 control-label">Nama Wakil</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" id="nama_wakil" name="nama_wakil" placeholder="Masukan Nama Wakil...">
							</div>
						</div>

						<div class="form-group">
							<label for="prodi_wakil" class="col-sm-2 control-label">Prodi Wakil</label>
							<div class="col-sm-8">
								<select class="form-control1" name="prodi_wakil">
									<option>-Pilih Prodi Wakil-</option>
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
							<label for="angkatan_wakil" class="col-sm-2 control-label">Angkatan</label>
							<div class="col-sm-8">
								<select class="form-control1" name="angkatan_wakil">
									<option>-Pilih Tahun Angkatan Wakil-</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="file" class="col-sm-2 control-label">Foto</label>
							<div class="col-sm-8">
								<input type="file" class="form-control1" id="file" name="file" placeholder="pilih foto...">
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