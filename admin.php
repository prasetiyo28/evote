<?php
session_start();
// check user login
if(empty($_SESSION['admin_id']))
{
    header("Location: home.php");
}


include_once 'dbconfig.php';
$pemilih=$crud->hitungpemilih();

$sudah=$crud->hitungsudah();
$belum=$crud->hitungbelum();

 include('element/header.php');
  ?> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include ('element/sidebar.php'); ?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<?php include ('element/profile.php'); ?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="row-one">
					<div class="col-md-4 widget">
						<div class="stats-left ">
							<h4>Total</h4>
							<h5>Pemilih</h5>
						</div>
						<div class="stats-right">
							<label> <?php echo $pemilih; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
							<h4>Total</h4>
							<h5>Sudah Memilih</h5>
						</div>
						<div class="stats-right">
							<label>  <?php echo $sudah; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<div class="stats-left">
							<h4>Total</h4>
							<h5>Belum Memilih</h5>
						</div>
						<div class="stats-right">
							<label> <?php echo $belum; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
				<div class="charts">
					<div class="col-md-12 charts-grids widget">
						<h4 class="title">Data Quick Count Sementara</h4>
						<canvas id="pie" height="300" width="400"> </canvas>
					</div>
					<div class="clearfix"> </div>
							 <script>
								var pieData = [
										{
											value: 323,
											color:"rgba(233, 78, 2, 1)",
											label: "Bayu"
										},
										{
											value : 350,
											color : "rgba(242, 179, 63, 1)",
											label: "Kukuh"
										}
										
									];
								
							new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
							
							</script>
							
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
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
	<!--scrolling js-->
	<?php include('element/footer.php'); ?>
</body>
</html>