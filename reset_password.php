<?php 

if(isset($_GET['token']).isset($_GET['k1m13b4l']))
{
	$password = $_GET['token']; 
	$nim = $_GET['k1m13b4l']; 

	//echo $password. "\n";
	//echo $nim . "\n";
	//echo "Berhasil";	

}

else{
	header("Location: home.php");
}


include_once 'dbconfig.php';
extract($crud->cekpilih($nim));

if(isset($_POST['btn-save']))
{
  $enc_baru = md5($_POST['baru']);

    if ($_POST['baru'] == $_POST['konfirm_baru']) {
      if ($enc_baru == $enc_password) {
      $fail = " Masukan Password yang belum pernah digunakan";
      header("Location: reset_password.php?token=".$token."&k1m13b4l=".$nim."&failure= " . $fail);
      }else {
        $crud->update_password($enc_baru,$nim);
        header("Location: home.php?success");  
      }
    }else{
      $fail = " Password tidak cocok";
      header("Location: reset_password.php?token=".$token."&k1m13b4l=".$nim."&failure= " . $fail);
    }

}

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
                <a href="home.php"><span class="glyphicon glyphicon-home"> </span> Home</a>
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





    <div class="container" >


      <div class="row" style="padding-top: 120px;margin-bottom: 140px;">




        <div class="container">
          <center>
            <?php 
            if(isset($_GET['failure']))
            {
              ?>
              <div class="container col-lg-12">
                <div class="alert alert-warning">
                  <strong>Gagal Mengganti Password !</strong><?php echo $_GET['failure']; $fail = "";  ?>  
                </div>
              </div>
              <?php
            }

            ?>
            <div class="panel panel-body panel-info" style="width: 50%">
              <h1 align="center">Reset Password</h1> 
              <form method="post">
               <div class="form-group" align="left">
                 <label class="control-label" >Password Baru</label>
                 <input class="form-control"  name="baru" type="password" placeholder="Masukan password baru anda...">
               </div>
               <div class="form-group" align="left">
                 <label class="control-label" >Konfirmasi Password Baru</label>
                 <input class="form-control"  name="konfirm_baru" type="password" placeholder="Masukan kembali password baru anda...">
               </div>
               <button type="submit" class="btn btn-primary" name="btn-save">Ganti Password</button>
               <button type="button" class="btn btn-default">Cancel</button>
             </form>
           </div>
         </div>
       </center>
     </div>
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
       <button type="button"  class="btn btn-primary">Login</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
   </form>
 </div>

</div>
</div>

<div class="footer">
  <img src="img/lg-pol.png" style="width: 5%">  Perolehan sementara Pemilihan Ketua Bem 2017 | Bayu : 45% , Kukuh : 55%
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
