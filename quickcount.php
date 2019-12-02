
<?php 
include_once 'dbconfig.php';



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>E-Vote</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="theme/bootstrap.css" media="screen">
  <link rel="stylesheet" href="theme/usebootstrap.css">
  <link rel="stylesheet" href="theme/animate.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap/html5shiv.js"></script>
      <script src="bootstrap/respond.min.js"></script>
      <![endif]-->
<script src="js/Chart.js"></script>
<script src="js/canvasjs.min.js"></script>

    </head>
    <body>

      <div class="navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a href="home.html" class="navbar-brand">E-vote BEM KMPHB</a>
            <button class="navbar-toggle animated infinite tada" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">

            <ul class="nav navbar-nav">

              <li>
                <a href="#"><span class="glyphicon glyphicon-home"> </span> Home</a>
              </li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-stats"> </span> Quick Count</a>
              </li>
              
              <li>
                <a href="#"><span class="glyphicon glyphicon-info-sign"> </span> Tentang Kami</a>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">14090067 - Kukuh Yulian Santoso <b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>
              </ul>
            </li>

          </ul>


        </div>
      </div>
    </div>

    <div class="hidden-lg hidden-md col-xs-12" style="background-color: #ffa31a; padding-top: 50px;">

      <div class="col-xs-12">
        <center>
          <img src="img/lg-pol.png" class="animated infinite pulse" style="width: 50%;" />
        </center>
      </div>

      <div class="col-lg-8 col-xs-12 col-md-12">
        <p align="center" class="lead">Aplikasi E-Vote</p>
        <h3 align="center">Badan Eksekutif Mahasiswa</h3>
        <p class="lead" align="center">Politeknik Harapan Bersama</p>
      </div>


    </div>





    <div class="container" style="margin-top: 10px" >




      <h1 align="center">Hasil Quick Count Sementara</h1>

      <div class="row" style="padding-top: 120px;margin-bottom: 190px;">

            <!--<div class="charts">
          <div class="col-md-6 col-lg-6 charts-grids widget">
            <h4 class="title">Data Quick Count Sementara</h4>
            <canvas id="pie" height="300" width="400"> </canvas>
          </div>-->
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  exportEnabled: true,
  animationEnabled: true,
  title:{
    text: "Hasil Quick Count Sementara \n Pemilihan Ketua dan Wakil Ketua BEM 2017"
  },
  legend:{
    cursor: "pointer",
    itemclick: explodePie
  },
  data: [{
    type: "pie",
    showInLegend: true,
    toolTipContent: "{name}: <strong>{y} Suara</strong>",
    indexLabel: "{name} - {y} Suara",
    dataPoints: [
    <?php $crud->lihatsementara();  ?>
      
    ]
  }]
});
chart.render();
}

function explodePie (e) {
  if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  } else {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  }
  e.chart.render();

}
</script>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<br>
<h2 align="center">Total Suara : <?php echo $crud->total(); ?></h2>             
                  

          </div>
        </div>



        <script src="bootstrap/jquery-1.11.1.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <script src="bootstrap/usebootstrap.js"></script>




        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Login</h4>
              </div>
              <div class="modal-body">


               <form>
                <div class="form-group">
                 <label class="control-label" >Username</label>
                 <input class="form-control"  type="text" placeholder="Masukan Username Anda.....">
               </div>

               <div class="form-group">
                 <label class="control-label" >Password</label>
                 <input class="form-control"  type="password" placeholder="Masukan kata sandi anda...">
               </div>



             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-primary">Login</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
           </form>
         </div>

       </div>
     </div>
     <div class="footer">
      <img src="img/lg-pol.png" style="width: 5%">  <strong>Total Suara : <?php echo $crud->total(); ?> | </strong> <?php echo $crud->lihatsementarafooter(); ?>
    </div>
    <style>

      .footer {
        /*position : fixed; */
        bottom : 0px;
        width: 100%;
        background-color: #ffa31a;
        color: #fff;
        padding: 5px;

      }
    </style>
  </body>



  </html>
