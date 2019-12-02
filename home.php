<?php 
session_start();
include_once('dbconfig.php');
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
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap/html5shiv.js"></script>
      <script src="bootstrap/respond.min.js"></script>
      <![endif]-->
    </head>
    <body style="padding-top: 0px">



      <div class="col-lg-12 col-md-12 col-xs-12 hidden-xs" style="background-color: #ffa31a; padding-top: 43px;">

        <div class="col-lg-2 col-md-2 hidden-xs">
          <center>
            <img src="img/lg-pol.png" class="animated infinite pulse" style="width: 70%;" />
          </center>
        </div>

        <div class="col-lg-8 col-xs-12 col-md-12">
          <h3 align="center">Aplikasi Pemilu Raya 2017</h3>
          <h1 align="center">Badan Eksekutif Mahasiswa</h1>
          <p class="lead" align="center">Politeknik Harapan Bersama</p>
        </div>

        <div class="col-lg-2 col-md-2 hidden-xs">
          <center>
            <img src="img/lg-pol.png" class="animated infinite pulse" style="width: 70%" />
          </center>
        </div>

        
      </div>

      
      <div class="navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a href="home.php" class="navbar-brand">E-vote BEM KMPHB</a>
            <button class="navbar-toggle animated infinite tada" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">

            <ul class="nav navbar-nav">

              <li>
                <a href="home.php"><span class="glyphicon glyphicon-home"> </span> Home</a>
              </li>
              <li>
                <a href="aboutus.php"><span class="glyphicon glyphicon-info-sign"> </span> Tentang Kami</a>
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





      <div class="container" style="margin-top: 40px">





        <div class="row">
          <div class="col-lg-1 col-xs-1">

          </div>
          
          <div class="col-lg-4 col-xs-12" style="padding-top: 9px;">
            <?php 
              if(isset($_GET['failure']))
          {
            ?>
            <div class="container col-lg-12">
              <div class="alert alert-warning">
                <strong>Gagal Login !!</strong> Username/Password yang anda masukan salah  
              </div>
            </div>
            <?php
          }

             ?>

             <?php 
              if(isset($_GET['success']))
          {
            ?>
            <div class="container col-lg-12">
              <div class="alert alert-success">
                <strong>Password berhasil diubah</strong> silahan login dengan username dan password baru  
              </div>
            </div>
            <?php
          }

             ?>

            <div class="panel panel-body panel-info">
              <h1 align="center">Login</h1> 
              <form action="login.php" method="post" >
                <div class="form-group">
                 <label class="control-label" >Username</label>
                 <input class="form-control" name="username"  type="text" placeholder="Masukan Username Anda.....">
               </div>

               <div class="form-group">
                 <label class="control-label" >Password</label>
                 <input class="form-control"  name="password" type="password" placeholder="Masukan kata sandi anda...">
               </div>
               <button type="submit" class="btn btn-primary" name="login">Login</button>
               Lupa Password ? <a href="email_reset.php">klik disini</a>
             </form>
           </div>
         </div>

         <div class="col-lg-6 col-xs-12">
          <h1>Aplikasi E-Vote</h1>
          <p>Cara memilih : <br>
            1. Login dengan user dan password yang sudah digunakan <br>
            2. Pilih Calon Ketua Bem dengan asas pemilu yaitu langsung , umum , bebas , rahasua , jujur dan adil <br>
            <br>
            Cara melihat quick count sementara : <br> 
            1. Login dengan user dan password yangs sudah digunakan <br>
            2. klik Menu Quick Count <br>
            3. Pemilih akan disajikan grafik perhitungan suara sementara <br>  
          </p>
        </div>
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/usebootstrap.js"></script>



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
