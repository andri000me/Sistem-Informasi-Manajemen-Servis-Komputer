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

  <title>Transaksi</title>

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

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Transaksi</li>
        </ol>


        <div class="row">
          <div class="col-md-12">
            <div class="card border-dark">
              <div class="card-header text-center">Kelola Transaksi</div>
              <div class="card-body">
                <div class="container text-center">
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "TambahServisSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Transaksi Servis Berhasil Ditambahkan.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "ClaimGagal") { ?>
                      <div class="alert alert-info" role="alert">
                        Garansi Barang tidak bisa diclaim.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "HapusJasaSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Jasa Berhasil Dihapus.
                      </div>  
                    <?php    }
                  }
                  ?>

                   <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "notfound") { ?>
                      <div class="alert alert-info" role="alert">
                        Transaksi dengan kode tersebut tidak ditemukan.
                      </div>  
                    <?php    }
                  }
                  ?>

                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "AmbilSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Barang Telah Diambil.
                      </div>  
                    <?php    }
                  }
                  ?>

                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "diambil") { ?>
                      <div class="alert alert-info" role="alert">
                        Barang Sudah Pernah Diambil.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-3"> 
                      <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#tambahtransaksi">Servis Baru
                      </button>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-primary form-control" onclick="window.location.href='updatetrans.php'">Update Servis
                      </button>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#ambilservis">Ambil Servis
                      </button>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#modalgaransi">Claim Garansi
                      </button>
                      <br><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3"> 
                      <input type="text" class="form-control" name="cari" id="cari" placeholder="Cari transaksi....">
                      <br>
                    </div>
                    <div class="col-md-9"></div>
                  </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Masuk</th>
                        <th>Kode</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="tabeltransaksi">
                      <?php 
                      include "../process/koneksi.php";
                      $query = mysqli_query($koneksi,"SELECT barang.id_barang, barang.nama AS namabrg, barang.status as status, barang.tgl_masuk as tgl_masuk, barang.total_biaya as total_biaya, barang.pelanggan as pelanggan, barang.kode as kode FROM barang where barang.status='Pemeriksaan' or barang.status='Antrian' or barang.status='Pengerjaan' or barang.status='Selesai' order by barang.id_barang desc");
                      if(mysqli_num_rows($query)>0){ ?>
                        <?php
                        $no = 1;
                        while($data = mysqli_fetch_array($query)){
                          ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $data['pelanggan']; ?></td>
                            <td><?= $data['namabrg']; ?></td>
                            <td><?= $data['status']; ?></td>
                            <td><?= $data['tgl_masuk']; ?></td>
                            <td><?= $data['kode']; ?></td>
                            <td>Rp. <?= number_format($data['total_biaya'],0,",","."); ?></td>
                            <td>
                                  <a href="cetaknota.php?brg=<?= $data['id_barang']; ?>" target='_BLANK'><button>Cetak</button></a>
                            </td>
                          </tr>
                          <?php $no++; } ?>
                        <?php } ?>
                      </tbody>
                    </table>
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
    <!-- KELUAR -->
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
            <form action="../process/tambahtrans.php" method="post">
              <div class="form-group">
                <label for="namapel">Nama Pelanggan:</label>
                <input type="text" class="form-control" title="Hanya menerima input berupa huruf" id="namapel" name="namapel" pattern="[A-Za-z ]+" maxlength="30" required>
              </div>
              <div class="form-group">
                <label for="telpon">Telepon Pelanggan:</label>
                <input type="number" class="form-control" title="Hanya menerima input berupa angka sebanyak 13 digit" id="telpon" name="telpon" min="1" max="9999999999999" required>
              </div>
              <div class="form-group">
                <label for="teknisi">Teknisi:</label>
                <select name="teknisi" class="form-control"> 
                  <?php $query = mysqli_query($koneksi,"select * from teknisi where status='Aktif'"); ?> 
                  <?php if(mysqli_num_rows($query)>0){ ?>
                    <?php
                    $no = 1;
                    while($data1 = mysqli_fetch_array($query)){
                      ?>
                      <option value="<?= $data1['id_teknisi']; ?>"><?= $data1['nama']; ?></option>
                      <?php $no++; } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="namabrg">Nama Barang:</label>
                  <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka" id="namabrg" name="namabrg" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                </div>
                <div class="form-group">
                  <label for="keluhan">Keluhan:</label>
                  <textarea class="form-control" rows="4" maxlength="250" name="keluhan" id="keluhan"></textarea>
                </div>
                <div class="form-group">
                  <label for="status">Status:</label> <br>
                  <select name="status" class="custom-select " id="status">
                    <option value="Antrian">Antrian</option>
                    <option value="Pemeriksaan">Pemeriksaan</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Servis</button>
              </form>
            </div>
          </div>
        </div>
      </div>



      <!-- AMBILBARANG -->
      <div class="modal fade" id="ambilservis" tabindex="-1" role="dialog" aria-labelledby="modaltambahjasaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ambil Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="ambilbarang.php" method="post">
                <div class="form-group">
                  <label for="kode">Masukkan Kode Barang Pelanggan:</label>
                  <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka tanpa spasi" id="kode" name="kode" pattern="[A-Za-z0-9]+" maxlength="15" placeholder="ex: 130139847" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ambil Barang</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Garansi -->
      <div class="modal fade" id="modalgaransi" tabindex="-1" role="dialog" aria-labelledby="modaltambahjasaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Claim Garansi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="claimgaransi.php" method="post">
                <div class="form-group">
                  <label for="kode">Masukkan Kode Barang Pelanggan:</label>
                  <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka tanpa spasi" id="kode" name="kode" pattern="[A-Za-z0-9]+" maxlength="15" placeholder="ex: 130139847" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ambil Barang</button>
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
      <script type="text/javascript">
        $(document).on("click","#ubah_jasa",function(){
          var idj = $(this).data('id');
          var keteranganj = $(this).data('keterangan');
          var jenisj = $(this).data('jenis');
          var hargaj = $(this).data('harga');
          $("#modal-ubah #id").val(idj);
          $("#modal-ubah #keterangan").val(keteranganj);
          $("#modal-ubah #keterangan2").val(keteranganj);
          $("#modal-ubah #jenis").val(jenisj);
          $("#modal-ubah #harga").val(hargaj);
        })
      </script>
      <script type="text/javascript">
        $(document).on("click","#hapus_jasa",function(){
          var idj = $(this).data('id');
          var keteranganj = $(this).data('keterangan');
          $("#modal-hapus #id").val(idj);
          $("#modal-hapus #keterangan2").val(keteranganj);
          $("#modal-hapus #keterangan").text(keteranganj);
        })
      </script>
      <script>
        $(document).ready(function(){
          $("#cari").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tabeltransaksi tr").filter(function() {
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
