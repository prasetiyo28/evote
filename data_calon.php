<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';

if(isset($_GET['delete_id']))
{

	$id = $_GET['delete_id'];
	
	if($crud->hapuscalon($id))
	{
		header("Location: data_calon.php");
	}
	else
	{
		header("Location: data_calon.php");
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
				<div class="tables">
					<h3 class="title1">Data Calon</h3>
					<div class="table-responsive bs-example widget-shadow">
						<a href="tambah_calon.php" class="label label-success"><span class="glyphicon glyphicon-plus"></span></a>	
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>#</th> 
									<th>No Urut</th> 
									<th>Nama Ketua</th> 
									<th>Prodi Ketua</th> 
									<th>Angkatan Ketua</th> 
									<th>Nama Wakil</th> 
									<th>Prodi Wakil</th> 
									<th>Angkatan Wakil</th> 
									<th>Slogan</th>
									<th>Visi</th>
									<th>Misi</th>
									<th>Foto</th>
									<th>Action</th>
								</tr> 
							</thead> 
							<tbody> 
								<?php
								$query = "SELECT * FROM calon";       
								$records_per_page=10;
								$newquery = $crud->paging($query,$records_per_page);
								$crud->lihatdatacalon($newquery);
								?>
							</tbody> 
						</table> 
					</div>
				</div>
			</div>
		</div>

		<?php 

		if (isset($_GET['delete_pemilih'])) {
			$id = $_GET['delete_pemilih'];
			try {
				if ($crud->hapus($id)) {
					echo "success";
				}
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}


		?>
		<!--footer-->
		<div class="footer">
			<p>&copy; 2017 E-Vote 2017 </p>
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