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
    </ul>
    <div id="content-wrapper">

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-dark">
              <div class="card-header"></div>
              <div class="card-body border-dark">
                <?php  
                include "../process/koneksi.php";
                $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
                $queryAmbilBarang = mysqli_query($koneksi,"select * from barang where kode='$kode'");
                if (mysqli_num_rows($queryAmbilBarang)>0){
                  $data = mysqli_fetch_assoc($queryAmbilBarang);
                  if ($data['status']=='Diambil') {
                    header("Location:transaksi.php?msg=diambil");
                  }
                  $idtek=$data['id_teknisi'];
                  $level=$_SESSION['level'];
                  $queryAmbilTeknisi = mysqli_query($koneksi,"select * from teknisi where id_teknisi=$idtek");
                  $data3 = mysqli_fetch_assoc($queryAmbilTeknisi);
                }else{
                  header("Location:transaksi.php?msg=notfound");
                }
                ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card border-dark">
                      <div class="card-header text-center">Info Transaksi</div>
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="kode" class="col-sm-4 col-form-label">Kode Transaksi:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $data['kode']; ?>"" disabled="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $data['tgl_masuk']; ?>"" disabled="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="namapel" class="col-sm-4 col-form-label">Nama Pelanggan:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namapel" name="namapel" value="<?= $data['pelanggan']; ?>"" disabled="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="namabar" class="col-sm-4 col-form-label">Nama Barang:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namabar" name="namabar" value="<?= $data['nama']; ?>"" disabled="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="namatek" class="col-sm-4 col-form-label">Nama Teknisi:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namatek" name="namatek" value="<?= $data3['nama']; ?>"" disabled="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="card border-dark">
                      <div class="card-body">
                        <table class="table table-bordered" id="tabeltransaksi">
                          <tbody>
                            <tr>
                              <th>No</th>
                              <th colspan="3" class="text-center">Jasa yang Digunakan</th>
                            </tr>
                            <?php
                            $id=$data['id_barang'];
                            $query1 = mysqli_query($koneksi,"SELECT trans_jasa.id_jasa as id_jasa, trans_jasa.subtotal_jasa as harga, jasa.keterangan as nama FROM trans_jasa INNER JOIN jasa ON trans_jasa.id_jasa=jasa.id_jasa where id_barang=$id");
                            if(mysqli_num_rows($query1)>0){ ?>
                              <?php
                              $no1 = 1;
                              while($data4 = mysqli_fetch_array($query1)){
                                ?>
                                <tr>
                                  <td><?= $no1; ?></td>
                                  <td colspan="2"><?= $data4['nama']; ?></td>
                                  <td>Rp. <?= number_format($data4['harga'],0,",","."); ?></td>
                                </tr>
                                <?php $no1++; } ?>
                              <?php } ?>
                              <?php  
                              $query2 = mysqli_query($koneksi,"SELECT SUM(trans_jasa.subtotal_jasa) AS harga FROM trans_jasa WHERE trans_jasa.id_barang=$id;");
                              $data5 = mysqli_fetch_array($query2);
                              ?>
                              <tr>
                                <td></td>
                                <td colspan="2">Total</td>
                                <td>Rp. <?= number_format($data5['harga'],0,",","."); ?></td>
                              </tr>
                            </tbody>
                          </table>
                          <br>
                          <table class="table table-bordered" id="tabeltransaksi">
                            <tbody>
                              <tr>
                                <th>No</th>
                                <th colspan="3" class="text-center">Suku Cadang yang Digunakan</th>
                              </tr>
                              <?php
                              $query3 = mysqli_query($koneksi,"SELECT trans_sukucadang.id_suku_cadang as id_sukucadang, trans_sukucadang.subtotal_sukucadang as harga, suku_cadang.nama as nama FROM trans_sukucadang INNER JOIN suku_cadang ON trans_sukucadang.id_suku_cadang=suku_cadang.id_suku_cadang where id_barang=$id");
                              if(mysqli_num_rows($query3)>0){ ?>
                                <?php
                                $no1 = 1;
                                while($data6 = mysqli_fetch_array($query3)){
                                  ?>
                                  <tr>
                                    <td><?= $no1; ?></td>
                                    <td colspan="2"><?= $data6['nama']; ?></td>
                                    <td>Rp. <?= number_format($data6['harga'],0,",","."); ?></td>
                                  </tr>
                                  <?php $no1++; } ?>
                                <?php } ?>
                                <?php  
                                $query4 = mysqli_query($koneksi,"SELECT SUM(trans_sukucadang.subtotal_sukucadang) AS harga FROM trans_sukucadang WHERE trans_sukucadang.id_barang=$id;");
                                $data5 = mysqli_fetch_array($query4);
                                ?>
                                <tr>
                                  <td></td>
                                  <td colspan="2">Total</td>
                                  <td>Rp. <?= number_format($data5['harga'],0,",","."); ?></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="form-group row">
                              <label for="total" class="col-sm-4 col-form-label">Total biaya:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="total" name="total" value="Rp. <?= number_format($data['total_biaya'],0,",","."); ?>" disabled="">
                              </div>
                              <br><br><br>
                              <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-3">
                              <a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahtransaksi">Ambil Barang</button></a>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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


    <!-- TAMBAH -->
    <div class="modal fade" id="tambahtransaksi" tabindex="-1" role="dialog" aria-labelledby="modaltambahjasaLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../process/ambiltrans.php" method="post">
              <div class="form-group">
                <label for="garansi">Masukkan tanggal garansi:</label>
                <input type="date" class="form-control" name="garansi" id="garansi" >
                <input type="hidden" name="kode" value="<?= $kode; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ambil Barang</button>
              </form>
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


      <!-- CUSTOM JAVASCRIPT -->
      <!-- Bootstrap core JavaScript-->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    </html>
