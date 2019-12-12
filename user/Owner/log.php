<?php 
session_start();
if($_SESSION['nama']=='' || $_SESSION['level']!=="Owner" || $_SESSION['status'] !== "Aktif"){
  session_destroy();
  header("location:../../index.php?msg=wronglog");
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

  <title>Log Aktivitas</title>

  <!-- Bootstrap core CSS-->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/stylex.css" rel="stylesheet">

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
          <a class="dropdown-item" data-toggle="modal" data-target="#modalKeluar"">Keluar</a>
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
        <li class="nav-item active">
          <a class="nav-link" href="karyawan.php">
            <i class="far fa-smile"></i>
            <span>Karyawan</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="sukucadang.php">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Suku Cadang</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="jasa.php">
            <i class="fas fa-hands"></i>
            <span>Jasa</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="tanggallaporan.php">
            <i class="fab fa-btc"></i>
            <span>Laporan</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="log.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Log</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Log</li>
          </ol>


          <div class="row">
            <div class="col-md-12">
              <div class="card border-dark">
                <div class="card-header text-center">Log Aktivitas</div>
                <div class="card-body">
                  <div class="container text-center">
                    <div class="row">
                    <div class="col-md-2"> <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#modalLog">Filter sesuai tanggal</button>
                      <br><br>
                    </div>
                    <div class="col-md-10"></div>
                  </div>
                    <div class="row">
                      <div class="col-md-6">
                        <form method="post" action="log.php">
                          <div class="input-group">
                            <select name="jenis" class="custom-select w-25" id="inputGroupSelect04">
                              <option selected value="">Pilih Aktivitas</option>
                              <option value="Login">Log in & Log out</option>
                              <option value="Pengelola">Pengelola</option>
                              <option value="Transaksi">Transaksi</option>
                              <option value="Karyawan">Karyawan</option>
                              <option value="Suku Cadang">Suku Cadang</option>
                              <option value="Jasa">Jasa</option>
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="submit">Seleksi</button>
                            </div>
                          </div>
                          <br>
                        </form>
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="cari" id="cari" placeholder="Cari aktivitas....">
                      </div>
                    </div>
                    <div class="table-wrapper-scroll-y">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aktivitas</th>
                          <th>Jenis</th>
                          <th>Waktu</th>
                        </tr>
                      </thead>
                      <tbody id="tabellog">
                        <?php 
                        include "../process/koneksi.php";
                        if (isset($_POST['jenis']) && $_POST['jenis']=='') {
                          $query = mysqli_query($koneksi,"select * from log_aktivitas order by waktu desc limit 30");
                        }elseif(isset($_POST['jenis'])){
                          $jenis=$_POST['jenis'];
                          if ($jenis == 'Login') {
                            $query = mysqli_query($koneksi,"select * from log_aktivitas where jenis='Login' or jenis='Logout' order by waktu desc limit 30");  
                          }else{
                            $query = mysqli_query($koneksi,"select * from log_aktivitas where jenis='$jenis' order by waktu desc limit 30");
                          }
                        }elseif(isset($_POST['awal']) && $_POST['akhir']){
                          $awal=$_POST['awal'];
                          $akhir=$_POST['akhir'];
                          $query = mysqli_query($koneksi,"select * from log_aktivitas where (waktu BETWEEN '$awal' AND '$akhir') order by waktu desc");
                        }else{
                         $query = mysqli_query($koneksi,"select * from log_aktivitas order by waktu desc limit 30");
                       }

                       if(mysqli_num_rows($query)>0){ ?>
                        <?php
                        $no = 1;
                        while($data = mysqli_fetch_array($query)){
                          ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $data['aktivitas']; ?></td>
                            <td><?= $data['jenis']; ?></td>
                            <td><?= $data['waktu']; ?></td>
                          </tr>
                          <?php $no++; } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>

        </div><br>
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


    <div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="modalLogLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Log Aktivitas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="log.php" method="post">
              <div class="form-group">
                <label for="garansi">Masukkan tanggal awal:</label>
                <input type="date" class="form-control" name="awal" id="awal" >
              </div>
              <div class="form-group">
                <label for="garansi">Masukkan tanggal akhir:</label>
                <input type="date" class="form-control" name="akhir" id="akhir" >
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" name="logout" value="logout">Filter</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- CUSTOM JAVASCRIPT -->
    <script
    src="https://code.jquery.com/jquery-1.10.2.js"
    integrity="sha256-it5nQKHTz+34HijZJQkpNBIHsjpV8b6QzMJs9tmOBSo="
    crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $("#cari").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tabellog tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

  </html>
