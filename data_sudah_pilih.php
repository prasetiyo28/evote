<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}
include_once 'dbconfig.php';


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
				<div class="tables">
					<h3 class="title1">Data Pemilih</h3>
					<div class="table-responsive bs-example widget-shadow">
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>#</th> 
									<th>NIM</th> 
									<th>Nama</th> 
									<th>Kelas</th> 
									<th>Prodi</th> 
									<th>status</th> 
									
								</tr> 
							</thead> 
							<tbody> 
								<?php
								$query = "SELECT * FROM pemilih where status = '1' and terhapus = '0' ";       
								$records_per_page=5;
								$newquery = $crud->paging($query,$records_per_page);
								$crud->lihatdatasudah($newquery);
								?>
							</tbody> 
						</table>
						
						<div class="pagination-wrap">
										<?php $crud->paginglink($query,$records_per_page); ?>
									</div> 
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
			<p>&copy; 2017 E-Vote 2017</p>
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