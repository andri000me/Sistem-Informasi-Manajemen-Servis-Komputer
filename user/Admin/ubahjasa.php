<?php 
session_start();
if($_SESSION['nama']=='' || $_SESSION['level']!=="Admin" || $_SESSION['status'] !== "Aktif"){
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

  <title>Ubah Jasa</title>

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
          John Doe
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
            <span>Sparepart</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="jasa.php">
            <i class="fas fa-hands"></i>
            <span>Jasa</span>
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
            <li class="breadcrumb-item active">Ubah Jasa</li>
          </ol>

          <?php 
          $keterangan=$_POST['keterangan'];
          $id=$_POST['id'];
          $jenis=$_POST['jenis'];
          $harga=$_POST['harga'];
          ?>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card border-dark">
                <div class="card-header text-center">Ubah Jasa</div>
                <div class="card-body">
                  <div class="container">
                    <div class="modal-body">
                      <form action="../process/ubahjasa.php" method="post">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="hidden" name="keterangan2" value="<?= $keterangan; ?>">
                        <div class="form-group">
                          <label for="keterangan">Nama Jasa:</label>
                          <input type="text" class="form-control" id="keterangan" name="keterangan" pattern="[A-Za-z0-9 ]+" maxlength="30" value="<?= $keterangan; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="jenis">Jenis:</label> <br>
                          <select name="jenis" class="custom-select w-25" id="inputGroupSelect04">
                            <option <?php if ($jenis == 'Servis') { echo "selected";} ?> value="Servis">Servis</option>
                            <option <?php if ($jenis == 'Install') { echo "selected";} ?> value="Install">Install</option>
                            <option <?php if ($jenis == 'Lainnya') { echo "selected";} ?> value="Lainnya">Install</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="harga">Harga:</label>
                          <input type="number" class="form-control" value="<?= $harga; ?>" id="harga" name="harga" min="1" max="99999999999" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah Jasa</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3"></div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © EnnComputer 2019</span>
            </div>
          </div>
        </footer>

      </div><br>
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

    <!-- CUSTOM JAVASCRIPT -->

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

  </html>
