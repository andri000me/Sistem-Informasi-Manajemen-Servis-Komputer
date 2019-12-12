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
          <a class="dropdown-item" href="#">Profil</a>
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
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Laporan</li>
          </ol>
          
          <div class="row">
            <?php 
            if (empty($_POST['bulan'] || $_POST['tahun'])) {
              header('Location: tanggallaporan.php?msg=tanggalSalah');
            }
            $bulan=$_POST['bulan'];
            $tahun=$_POST['tahun'];
            include "../process/koneksi.php";
            $query = mysqli_query($koneksi,"select * from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun order by tgl_keluar desc");
            ?>
            <div class="col-md-3">
              <div class="card text-white bg-info mb-3">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-check-square"></i>
                  </div>
                  <span><h1 class="card-title text-center"><?= mysqli_num_rows($query); ?></h1></span>
                </div>
                <div class="card-footer">Transaksi sukses.</div>
              </div>
            </div>
            <?php 
            $query3 = mysqli_query($koneksi,"select sum(total_biaya) as biaya from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
            $data3 = mysqli_fetch_array($query3);
            ?>
            <div class="col-md-3">
              <div class="card text-white bg-info mb-3">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="  fas fa-check-double"></i>
                  </div>
                  <span><h1 class="card-title text-center">Rp. <?= number_format($data3['biaya'],0,",","."); ?></h1></span>
                </div>
                <div class="card-footer">Total Uang Masuk.</div>
              </div>
            </div>
            <?php 
            $query1 = mysqli_query($koneksi,"select sum(total_untung) as untung from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
            $data1 = mysqli_fetch_array($query1);
            ?>
            <div class="col-md-3">
              <div class="card text-white bg-info mb-3">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="  fas fa-check-double"></i>
                  </div>
                  <span><h1 class="card-title text-center">Rp. <?= number_format($data1['untung'],0,",","."); ?></h1></span>
                </div>
                <div class="card-footer">Total Keuntungan.</div>
              </div>
            </div>
            <?php 
            $query2 = mysqli_query($koneksi,"select sum(total_upah) as upah from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
            $data2 = mysqli_fetch_array($query2);
            ?>
            <div class="col-md-3">
              <div class="card text-white bg-info mb-3" >
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-check-square"></i>
                  </div>
                  <span><h1 class="card-title text-center">Rp. <?= number_format($data2['upah'],0,",","."); ?></h1></span>
                </div>
                <div class="card-footer">Total Biaya Gaji Teknisi.</div>
              </div>
            </div>       
          </div>
          <!-- END CARD -->
          
          <div class="row">
            <div class="col-md-12">
              <div class="card border-dark">
                <div class="card-header text-center">Laporan Transaksi Sukses</div>
                <div class="card-body">
                  <div class="container text-center">
                    <div class="table-wrapper-scroll-y">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Barang</th>
                          <th>Teknisi</th>
                          <th>Masuk</th>
                          <th>Keluar</th>
                          <th>Harga</th>
                          <th>Untung</th>
                          <th>Upah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        
                        if(mysqli_num_rows($query)>0){ ?>
                          <?php
                          $no = 1;
                          while($data = mysqli_fetch_array($query)){
                            $idtek=$data['id_teknisi'];
                            $queryTeknisi=mysqli_query($koneksi, "select nama from teknisi where id_teknisi=$idtek");
                            $datateknisi=mysqli_fetch_array($queryTeknisi);
                            ?>

                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $data['nama']; ?></td>
                              <td><?= $datateknisi['nama']; ?></td>
                              <td><?= $data['tgl_masuk']; ?></td>
                              <td><?= $data['tgl_keluar']; ?></td>
                              <td>Rp. <?= number_format($data['total_biaya'],0,",","."); ?></td>
                              <td>Rp. <?= number_format($data['total_untung'],0,",","."); ?></td>
                              <td>Rp. <?= number_format($data['total_upah'],0,",","."); ?></td>
                            </tr>
                            <?php $no++; } ?>
                          <?php } ?>
                          <tr>
                            <td colspan="4"></td>
                            <td>Total</td>
                            <td>Rp. <?= number_format($data3['biaya'],0,",","."); ?></td>
                            <td>Rp. <?= number_format($data1['untung'],0,",","."); ?></td>
                            <td>Rp. <?= number_format($data2['upah'],0,",","."); ?></td>
                          </tr>
                        </tbody>

                      </table>
                    </div>

                      <div class="row">
                        <div class="col-md-2">
                          <a href="cetaklaporan.php?b=<?= $bulan; ?>&t=<?= $tahun; ?>" target="_BLANK"><button class="form-control btn btn-primary">Cetak</button></a>                        
                        </div>
                      </div>

                    </div>

                  </div>
                  <div class="card-footer"></div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="card border-dark text-center">
                  <div class="card-header">Info Gaji Teknisi</div>
                  <div class="card-body">
                    <div class="container text-center">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nama Teknisi</th>
                            <th>Upah</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $queryteknisi=mysqli_query($koneksi, "select teknisi.id_teknisi as id, teknisi.nama as nama from teknisi");
                          if(mysqli_num_rows($queryteknisi)>0){ ?>
                            <?php
                            $noo = 1;
                            while($dataa = mysqli_fetch_array($queryteknisi)){
                              $idteknisii=$dataa['id'];
                              $querytotalgaji=mysqli_query($koneksi, "select sum(total_upah) as upah  from barang where id_teknisi=$idteknisii and status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
                              $dataupah=mysqli_fetch_array($querytotalgaji);
                              ?>
                              <tr>
                                <th scope="row"><?= $noo; ?></th>
                                <td><?= $dataa['nama']; ?></td>
                                <td>Rp. <?= number_format($dataupah['upah'],0,",","."); ?></td>
                                <td><a href="detailgaji.php?tek=<?= $idteknisii; ?>&b=<?= $bulan; ?>&t=<?= $tahun; ?>"><button>Detail</button></a></td>
                              </tr>
                              <?php $noo++; } ?>
                            <?php } ?>
                            <?php 
                            $querytotalgaji1=mysqli_query($koneksi, "select sum(total_upah) as upah  from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
                            $dataupah1=mysqli_fetch_array($querytotalgaji1);
                            ?>
                            <tr>
                              <td></td>
                              <td>Total</td>
                              <td>Rp. <?= number_format($dataupah1['upah'],0,",","."); ?></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>

                      </div>

                    </div>
                  </div>
                  <div class="footer"></div>                  
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
              <button type="button" class="btn btn-primary">Keluar</button>
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
