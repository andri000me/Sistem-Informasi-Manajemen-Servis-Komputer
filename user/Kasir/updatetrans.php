<?php 
session_start();
if($_SESSION['nama']=='' || $_SESSION['level']!=="Kasir" || $_SESSION['status'] !== "Aktif"){
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
                    if ($_GET['msg'] == "PerbaruiSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Status Berhasil Diperbarui.
                      </div>  
                    <?php    }
                  }
                  ?>
                  
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
                        <th>Biaya</th>
                        <th>Transaksi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="tabeltransaksi">
                      <?php 
                      include "../process/koneksi.php";
                      $query = mysqli_query($koneksi,"SELECT barang.id_barang as id, barang.pelanggan AS namapel, barang.nama AS namabrg, barang.status as status, barang.tgl_masuk as tgl_masuk, barang.tgl_keluar as tgl_keluar, barang.total_biaya as total_biaya FROM barang where status='Antrian' or status='Pemeriksaan' or status='Pengerjaan' or status='Selesai'  order by barang.id_barang desc");
                      if(mysqli_num_rows($query)>0){ ?>
                        <?php
                        $no = 1;
                        while($data = mysqli_fetch_array($query)){
                          ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $data['namapel']; ?></td>
                            <td><?= $data['namabrg']; ?></td>
                            <td><?= $data['status']; ?></td>
                            <td>Rp. <?= number_format($data['total_biaya'],0,",","."); ?></td>
                            <td>
                              <form action="tambahjasa.php" method="post">
                                <input type="hidden" name="idbarang" value="<?= $data['id']; ?>">
                                <button type="submit" class="btn-primary">Jasa & S. Cadang</button>
                              </form> 
                            </td>
                            <td>
                              <a id="ubah_trans" data-toggle="modal" data-target="#perbarui" data-id="<?= $data['id']; ?>" data-status="<?= $data['status']; ?>" >
                                <button class="btn-primary">Perbarui Status
                                </button>
                              </a>
                            </td>
                          </tr>
                          <?php $no++; } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-primary form-control" onclick="window.location.href='transaksi.php'">Kembali
                      </button>
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

    <!-- EDIT -->
    <div class="modal fade" id="perbarui" tabindex="-1" role="dialog" aria-labelledby="perbaruiLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perbarui Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-ubah">
            <form action="../process/transperbaruistatus.php" method="post">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="status">Status:</label> <br>
                <select name="status" class="custom-select" id="status">
                  <option value="Antrian">Antrian</option>
                  <option value="Pemeriksaan">Pemeriksaan</option>
                  <option value="Pengerjaan">Pengerjaan</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Batal">Batal</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
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
        $(document).on("click","#ubah_trans",function(){
          var id = $(this).data('id');
          var status = $(this).data('status');
          $("#modal-ubah #id").val(id);
          $("#modal-ubah #status").val(status);
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
