<?php 
session_start();
if (!isset($_SESSION['nama']) || !isset($_SESSION['level'])){
  session_destroy();
}elseif($_SESSION['nama'] !=='' && $_SESSION['level'] =="Owner"){
  header("location:user/owner");
}elseif ($_SESSION['nama'] !=='' && $_SESSION['level'] =="Admin"){
  header("location:user/admin");
}elseif ($_SESSION['nama'] !=='' && $_SESSION['level'] =="Kasir"){
  header("location:user/kasir");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Bootstrap core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-dark">
    <br><br><br><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card border-info">
            <div class="card-header text-center">LOGIN</div>
            <div class="card-body">
              <div class="card border-info">
                  <div class="card-body">
                    <form id="form_login" method="post" action="user/process/log_in.php">
                        <div class="row">
                        	<div class="col-md-12">
                        <img src="img/encomp.png" class="rounded mx-auto d-block form-control"  alt="Logo">
                        </div>
                        </div>
                        <br>
                        <?php 
                        if (isset($_GET['msg'])) {                       
                            if ($_GET['msg'] == "wronguname") { ?>
                              <div class="alert alert-danger" role="alert">
                            Username atau Password Salah!!
                            </div>  
                        <?php    }
                        }
                        ?>
                        <?php 
                        if (isset($_GET['msg'])) {                       
                            if ($_GET['msg'] == "wronglog") { ?>
                              <div class="alert alert-danger" role="alert">
                            Anda tidak mempunyai hak akses terhadap halaman tersebut.
                            </div>  
                        <?php    }
                        }
                        ?>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required="">
                        <br>
                        <input type="password" class="form-control" name="password" id="Password" placeholder="Masukkan Password" required="">
                        <br>

                        <?php
                        $nilai1=rand(1, 9);
                        $nilai2=rand(1, 9);
                        $nilai3=$nilai1+$nilai2; 
                        ?>

                        <?php 
                        if (isset($_GET['msg'])) {                       
                            if ($_GET['msg'] == "wrongans") { ?>
                              <div class="alert alert-danger" role="alert">
                                Jawaban Anda Salah!!
                            </div>  
                        <?php    }
                        }
                        ?>

                        <p>Berapa hasil dari <?= $nilai1; ?> + <?= $nilai2; ?> ?</p>
                        <input type="hidden" id="jawab" name="jawab" value="<?= $nilai3; ?>">
                        <input type="text" class="form-control" name="hitung" id="hitung" placeholder="Jawaban anda" required="">
                        <br>
                        <button type="submit" class="btn btn-info">Masuk</button>
                        <br><br>
                    </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        <div class="com-md-4"></div>
        </div>
    </div>



<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
