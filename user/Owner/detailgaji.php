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

  <title>Laporan</title>

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
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Laporan</li>
          </ol>
          <?php 
          include "../process/koneksi.php";
          $id=$_GET['tek'];
          $bulan=$_GET['b'];
          $tahun=$_GET['t'];
          switch ($bulan) {
            case '1':
            $bln='Januari';
            break;
            case '2':
            $bln='Februari';
            break;
            case '3':
            $bln='Maret';
            break;
            case '4':
            $bln='April';
            break;
            case '5':
            $bln='Mei';
            break;
            case '6':
            $bln='Juni';
            break;
            case '7':
            $bln='Juli';
            break;
            case '8':
            $bln='Agustus';
            break;
            case '9':
            $bln='September';
            break;
            case '10':
            $bln='Oktober';
            break;
            case '11':
            $bln='November';
            break;
            case '12':
            $bln='Desember';
            break;
          }
          $queryyy=mysqli_query($koneksi, "select nama from teknisi where id_teknisi=$id");
          $dataaa=mysqli_fetch_array($queryyy);
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card border-dark">
                <div class="card-header text-center">Laporan Transaksi Sukses</div>
                <div class="card-body">
                  <div class="container text-center">
                    <h3>Detail Gaji <?= $dataaa['nama']; ?> <?= $bln; ?> <?= $tahun; ?></h3><br>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Barang</th>
                          <th>Teknisi</th>
                          <th>Pelanggan</th>
                          <th>Kode</th>
                          <th>Masuk</th>
                          <th>Keluar</th>
                          <th>Upah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $query=mysqli_query($koneksi, "select nama, pelanggan, kode, tgl_masuk,tgl_keluar, total_upah from barang where status='Diambil' and id_teknisi=$id and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
                        if(mysqli_num_rows($query)>0){ ?>
                          <?php
                          $no = 1;
                          while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $data['nama']; ?></td>
                              <td><?= $dataaa['nama']; ?></td>
                              <td><?= $data['pelanggan']; ?></td>
                              <td><?= $data['kode']; ?></td>
                              <td><?= $data['tgl_masuk']; ?></td>
                              <td><?= $data['tgl_keluar']; ?></td>
                              <td>Rp. <?= number_format($data['total_upah'],0,",","."); ?></td>
                            </tr>
                            <?php $no++; } ?>
                          <?php } ?>
                          <tr>
                            <?php 
                            $queryy=mysqli_query($koneksi, "select sum(total_upah) as upah from barang where status='Diambil' and id_teknisi=$id and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
                            $dataa=mysqli_fetch_array($queryy);
                            ?>
                            <td colspan="6"></td>
                            <td>Total</td>
                            <td>Rp. <?= number_format($dataa['upah'],0,",","."); ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-md-2">
                        <a href="laporan.php"><button class="form-control btn btn-primary">Kembali</button></a>
                      </div>
                      <div class="col-md-2">
                        <a href="cetakgaji.php?tek=<?= $id; ?>&b=<?= $bulan; ?>&t=<?= $tahun; ?>" target="_BLANK"><button class="form-control btn btn-primary">Cetak</button></a>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer"></div>
                </div>
              </div>
            </div>
            <br>
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

      <!-- Bootstrap core JavaScript-->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    </html>
