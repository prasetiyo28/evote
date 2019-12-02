<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	extract($crud->getIDCalon($id));	
}

if(isset($_POST['btn-update']))
{

	$ketua = $_POST['nama_ketua'];
	$prodi_ketua = $_POST['prodi_ketua'];
	$angkatan_ketua = $_POST['angkatan_ketua'];
	$wakil = $_POST['nama_wakil'];
	$prodi_wakil = $_POST['prodi_wakil'];
	$angkatan_wakil = $_POST['angkatan_wakil'];
	$visi = $_POST['visi'];
	$misi = $_POST['misi'];
	$slogan = $_POST['slogan'];



	$imgFile = $_FILES['file']['name'];
	$tmp_dir = $_FILES['file']['tmp_name'];
	$imgSize = $_FILES['file']['size'];

	if($imgFile)
	{
			$upload_dir = 'img/calon/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$foto2 = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$foto);
					move_uploaded_file($tmp_dir,$upload_dir.$foto2);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$foto2 = $foto; // old image from database
		}	

		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			if($crud->updateCalon($id,$ketua,$prodi_ketua,$angkatan_ketua,$wakil,$prodi_wakil,$angkatan_wakil,$visi,$misi,$slogan,$foto2))
			{
				header("Location: data_calon.php?inserted");
			}
			else
			{
				header("Location: data_calon.php?failure");
			}

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
						if(isset($errMSG)){
							?>
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
							</div>
							<?php
						}
						?>
					</p>
					<h3 class="title1">Edit Data Calon :</h3>
					<div class="form-three widget-shadow">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="nama" class="col-sm-2 control-label">Masukan Nama calon ketua...</label>
								<div class="col-sm-8">
									<input type="text" class="form-control1" id="nama" name="nama_ketua" value="<?php echo $nama_ketua; ?>" >
								</div>
							</div>

							<div class="form-group">
								<label for="prodi_ketua" class="col-sm-2 control-label">Prodi Ketua</label>
								<div class="col-sm-8">
									<select class="form-control1" name="prodi_ketua">
										<option><?php echo $prodi_ketua; ?></option>
										<option>-Pilih Prodi Ketua-</option>
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
								<label for="angkatan_ketua" class="col-sm-2 control-label">Angkatan</label>
								<div class="col-sm-8">
									<select class="form-control1" name="angkatan_ketua">
										<option><?php echo $angkatan_ketua; ?></option>
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
									<input type="text" class="form-control1" id="nama_wakil" name="nama_wakil" value="<?php echo $nama_wakil; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="prodi_wakil" class="col-sm-2 control-label">Prodi Wakil</label>
								<div class="col-sm-8">
									<select class="form-control1" name="prodi_wakil">
										<option><?php echo $prodi_wakil; ?></option>
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
										<option><?php echo $angkatan_wakil; ?></option>
										<option>-Pilih Tahun Angkatan Wakil-</option>
										<option>2015</option>
										<option>2016</option>
										<option>2017</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="visi" class="col-sm-2 control-label">Visi</label>
								<div class="col-sm-8">
								<textarea name="visi" height="20px" id="visi" class="form-control"><?php echo $visi; ?></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="misi" class="col-sm-2 control-label">Misi</label>
								<div class="col-sm-8">
									<textarea name="misi" height="20px" id="misi" class="form-control"><?php echo $misi; ?></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="slogan" class="col-sm-2 control-label">Slogan</label>
								<div class="col-sm-8">
									<input type="text" class="form-control1" id="slogan" name="slogan" value="<?php echo $visi; ?>">
								</div>
							</div>


							<div class="form-group">
								<label for="file" class="col-sm-2 control-label">Foto</label>
								<div class="col-sm-8">
									<img width="50%" src="img/calon/<?php echo $foto; ?>">
									<input type="file" class="form-control1" id="file" name="file" placeholder="pilih foto...">
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