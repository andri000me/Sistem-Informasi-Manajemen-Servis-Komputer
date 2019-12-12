<?php 
session_start();
if($_SESSION['nama']=='' || $_SESSION['level']!=="Kasir" || $_SESSION['status'] !== "Aktif"){
  session_destroy();
  header("location:../../index.php?msg=wronglog");
}
include "../process/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard</title>

  <!-- Bootstrap core CSS-->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">EnnComputer</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="index.php">
      <i class="fas fa-laptop"></i>
    </button>



    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-smile"></i>
          <?= $_SESSION['nama']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" data-toggle="modal" data-target="#modalProfil">Profil</a>
          <a class="dropdown-item" data-toggle="modal" data-target="#modalUbahPassword">Ubah Password</a>
          <a class="dropdown-item" data-toggle="modal" data-target="#modalKeluar"">Keluar</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="transaksi.php">
          <i class="far fa-handshake"></i>
          <span>Transaksi</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-dark">
              <div class="card-header"></div>
              <div class="card-body">
                <?php 
                if (isset($_GET['msg'])) {                       
                  if ($_GET['msg'] == "UbahProfilSukses") { ?>
                    <div class="alert alert-info" role="alert">
                      Profil anda berhasil diubah.
                    </div>  
                  <?php    }
                }
                ?>

                <?php 
                if (isset($_GET['msg'])) {                       
                  if ($_GET['msg'] == "UbahFotoSukses") { ?>
                    <div class="alert alert-info" role="alert">
                      Foto Profil anda berhasil diubah.
                    </div>  
                  <?php    }
                }
                ?>

                <?php 
                if (isset($_GET['msg'])) {                       
                  if ($_GET['msg'] == "UbahPasswordSukses") { ?>
                    <div class="alert alert-info" role="alert">
                      Password anda berhasil diubah.
                    </div>  
                  <?php    }
                }
                ?>

                <?php 
                if (isset($_GET['msg'])) {                       
                  if ($_GET['msg'] == "UbahPasswordGagal") { ?>
                    <div class="alert alert-info" role="alert">
                      Password anda gagal diubah karena anda memasukkan password lama salah.
                    </div>  
                  <?php    }
                }
                ?>
                <div class="container text-center">
                  <img src="<?= $_SESSION['avatar']; ?>" width="300" class="rounded-circle">
                  <h1 class="display-4"><?= $_SESSION['nama']; ?> | <?= $_SESSION['level']; ?></h1>
                  <p class="lead">Selamat <?= $_SESSION['nama']; ?>, Selamat Bekerja!</p>
                </div>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>

      </div>
      <br>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © EnnComputer 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->


  <!-- Modal -->
  <?php 
  $username=$_SESSION['username'];
  $queryProfil = mysqli_query($koneksi,"select * from pengelola where username='$username'");
  $dataProfil = mysqli_fetch_assoc($queryProfil);
  ?>
  <!-- PROFIL -->
  <div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card border-dark">
                <div class="card-body">
                  <div class="container text-center">
                    <img src="<?= $_SESSION['avatar']; ?>" width="125" class="rounded-circle"><br><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUbahFoto">Ubah Foto</button>
                    <p class="lead"><?= $dataProfil['nama']; ?></p>
                    <p class="lead"><?= $dataProfil['level']; ?></p>
                    <p class="lead"><?= $dataProfil['email']; ?></p>
                    <p class="lead"><?= $dataProfil['notelp']; ?></p>
                    <p class="lead"><?= $dataProfil['alamat']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUbahProfil">Ubah Profil</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Keluar -->
  <div class="modal fade" id="modalKeluar" tabindex="-1" role="dialog" aria-labelledby="modalKeluarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin keluar?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <form method="post" action="../process/log_out.php">
            <button type="submit" class="btn btn-primary" name="logout" value="logout">Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL UBAH FOTO -->
  <div class="modal fade" id="modalUbahFoto" tabindex="-1" role="dialog" aria-labelledby="modalUbahFoto" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../process/ubahfoto.php" method="post" enctype="multipart/form-data">
            <div class="custom-file">
              <input type="file"  accept=".jpg,.jpeg,.png,.png" name="foto" required id="UbahFoto">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah Foto</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL UBAH PROFIL -->
  <div class="modal fade" id="modalUbahProfil" tabindex="-1" role="dialog" aria-labelledby="modalUbahProfil" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../process/ubahprofil.php" method="post">
            <div class="form-group">
              <label for="nama">Nama:</label>
              <input type="text" class="form-control" id="nama" name="nama" pattern="[A-Za-z ]+" value="<?= $dataProfil['nama']; ?>" maxlength="20" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= $dataProfil['email']; ?>" maxlength="25" required>
            </div>
            <div class="form-group">
              <label for="notelp">No Telp:</label>
              <input type="number" class="form-control" id="notelp" name="notelp" value="<?= $dataProfil['notelp']; ?>" max="9999999999999" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat:</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dataProfil['alamat']; ?>" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah Profil</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL UBAH PASSWORD -->
  <div class="modal fade" id="modalUbahPassword" tabindex="-1" role="dialog" aria-labelledby="modalUbahPassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../process/ubahpassword.php" method="post" onsubmit="return checkPassword(this);">
            <div class="form-group">
              <label for="password2">Password Lama:</label>
              <input type="password" class="form-control" pattern=".{6,15}" maxlength="15" id="password2" name="password2">
            </div>
            <div class="form-group">
              <label for="password3">Password Baru:</label>
              <input type="password" class="form-control" title="Password minimal 6 karakter dan maksimal 15 karakter" pattern=".{6,15}" maxlength="15" id="password3" name="password3">
            </div>
            <div class="form-group">
              <label for="password4">Konfirmasi Password Baru:</label>
              <input type="password" class="form-control" title="Password minimal 6 karakter dan maksimal 15 karakter" pattern=".{6,15}" maxlength="15" id="password4" name="password4">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL -->

  <!-- CUSTOM JAVASCRIPT -->
  <script type="text/javascript">
    var uploadField = document.getElementById("UbahFoto");

    uploadField.onchange = function() {
      if(this.files[0].size > 2200000){
       alert("Ukuran file terlalu besar! Ukuran makmimal 2 MB.");
       this.value = "";
     };
   };

   function checkPassword(theForm) {
    if (theForm.password3.value != theForm.password4.value)
    {
      alert('Ulangi password salah! Ulangi password dengan nilai yang sama.');
      return false;
    } else {
      return true;
    }
  }
</script>
<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
