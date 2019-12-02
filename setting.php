<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';
extract($crud->ambiltanggal());



if(isset($_POST['btn-save']))
{
  $mulai = $_POST['mulai'];
  $selesai = $_POST['selesai'];

  if($crud->update_tanggal($mulai,$selesai)){
  	header("location: setting.php");	
  }else{
  	header("location: admin.php");
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
 				<h3 class="title1">Setting Jadwal :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post">
								
								<div class="form-group">
									<label for="mulai" class="col-sm-2 control-label">Mulai</label>
									<div class="col-sm-8">
										<input type="date" class="form-control1" id="mulai" name="mulai" placeholder="dd/mm/yyyy" value='<?php echo $mulai; ?>'>
									</div>
								</div>

								<div class="form-group">
									<label for="selesai" class="col-sm-2 control-label">Selesai</label>
									<div class="col-sm-8">
										<input type="date" class="form-control1" id="selesai" name="selesai" placeholder="dd/mm/yyyy" value='<?php echo $selesai; ?>'>
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