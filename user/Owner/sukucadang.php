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

  <title>Suku Cadang</title>

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
          <li class="breadcrumb-item active">Suku Cadang</li>
        </ol>


        <div class="row">
          <div class="col-md-12">
            <div class="card border-dark">
              <div class="card-header text-center">Kelola Suku Cadang</div>
              <div class="card-body">
                <div class="container text-center">
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "TambahSKSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Suku Cadang Berhasil Ditambahkan.
                      </div>  
                    <?php    }
                  }
                  ?>

                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "HapusSKSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Suku Cadang Berhasil Dihapus.
                      </div>  
                    <?php    }
                  }
                  ?>

                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "UbahSKSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Suku Cadang Berhasil Diubah.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-3"> <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#tambahSC">Tambah Suku Cadang</button>
                      <br><br>
                    </div>
                    <div class="col-md-9"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-3"> 
                      <input type="text" class="form-control" name="cari" id="cari" placeholder="Cari suku cadang....">
                      <br>
                    </div>
                    <div class="col-md-9"></div>
                  </div>
                  <div class="table-wrapper-scroll-y">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Untung</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="tabelSC">
                      <?php 
                      include "../process/koneksi.php";
                      $query = mysqli_query($koneksi,"select * from suku_cadang where hapus=0 order by jenis");
                      if(mysqli_num_rows($query)>0){ ?>
                        <?php
                        $no = 1;
                        while($data = mysqli_fetch_array($query)){
                          ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['jenis']; ?></td>
                            <td>Rp. <?= number_format($data['harga'],0,",","."); ?></td>
                            <td>Rp. <?= number_format($data['untung'],0,",","."); ?></td>
                            <th>
                              <a id="ubah_SC" data-toggle="modal" data-target="#ubahSC" data-id="<?= $data['id_suku_cadang']; ?>" data-nama="<?= $data['nama']; ?>" data-jenis="<?= $data['jenis']; ?>" data-harga="<?= $data['harga']; ?>" data-untung="<?= $data['untung']; ?>" style="float: left;">
                                <button><i class="fas fa-edit"></i>
                                </button>
                              </a>
                              <a id="hapus_SC" data-toggle="modal" data-target="#hapusSC" data-id="<?= $data['id_suku_cadang']; ?>" data-nama="<?= $data['nama']; ?>"  style="float: left;">
                                <button><i class="fas fa-trash-alt"></i>
                                </button>
                              </a>
                            </th>
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
    <div class="modal fade" id="tambahSC" tabindex="-1" role="dialog" aria-labelledby="modaltambahjasaLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Suku Cadang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../process/tambahSK.php" method="post" id="FormTambah" onsubmit="return checkTambah();">
              <div class="form-group">
                <label for="nama">Nama Suku Cadang:</label>
                <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
              </div>
              <div class="form-group">
                <label for="jenis">Jenis:</label> <br>
                <select name="jenis" class="custom-select w-25" id="jenis">
                  <option value="Monitor">Monitor</option>
                  <option value="Keyboard">Keyboard</option>
                  <option value="Speaker">Speaker</option>
                  <option value="RAM">RAM</option>
                  <option value="VGA">VGA</option>
                  <option value="Baterai">Baterai</option>
                  <option value="Harddisk">Harddisk</option>
                  <option value="Port">Port</option>
                  <option value="Power Supply">Power Supply</option>
                  <option value="Motherboard">Motherboard</option>
                  <option value="Printer">Printer</option>
                  <option value="Proyektor">Proyektor</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" title="Hanya menerima input berupa angka" id="harga" name="harga" min="1" max="99999999999" required>
              </div>
              <div>
                <label for="untung">Untung:</label>
                <input type="number" class="form-control" title="Hanya menerima input berupa angka" id="untung" name="untung" min="1" max="99999999999" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah Suku Cadang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- EDIT -->
    <div class="modal fade" id="ubahSC" tabindex="-1" role="dialog" aria-labelledby="modalubahjasaLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Suku Cadang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-ubah">
            <form action="../process/ubahSK.php" method="post" id="FormEdit" onsubmit="return checkEdit();">
              <div class="form-group">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="nama2" id="nama2">
                <label for="nama">Nama Suku Cadang:</label>
                <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
              </div>
              <div class="form-group">
                <label for="jenis">Jenis:</label> <br>
                <select name="jenis" class="custom-select w-25" id="jenis">
                  <option value="Monitor">Monitor</option>
                  <option value="Keyboard">Keyboard</option>
                  <option value="Speaker">Speaker</option>
                  <option value="RAM">RAM</option>
                  <option value="VGA">VGA</option>
                  <option value="Baterai">Baterai</option>
                  <option value="Harddisk">Harddisk</option>
                  <option value="Port">Port</option>
                  <option value="Power Supply">Power Supply</option>
                  <option value="Motherboard">Motherboard</option>
                  <option value="Printer">Printer</option>
                  <option value="Proyektor">Proyektor</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" title="Hanya menerima input berupa angka" id="harga" name="harga" min="1" max="99999999999" required>
              </div>
              <div class="form-group">
                <label for="untung">Untung:</label>
                <input type="number" class="form-control" title="Hanya menerima input berupa angka" id="untung" name="untung" min="1" max="99999999999" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Ubah Suku Cadang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- HAPUS -->
    <div class="modal fade" id="hapusSC" tabindex="-1" role="dialog" aria-labelledby="modalhapusjasaLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Jasa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-hapus">
            Apakah anda yakin ingin menghapus <span id="nama"></span>?
            <form method="post" action="../process/hapusSK.php">
              <input type="hidden" name="id"  id="id">
              <input type="hidden" name="nama2"  id="nama2">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Hapus Suku Cadang</button>
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
      $(document).on("click","#ubah_SC",function(){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var jenis = $(this).data('jenis');
        var harga = $(this).data('harga');
        var untung = $(this).data('untung');
        $("#modal-ubah #id").val(id);
        $("#modal-ubah #nama").val(nama);
        $("#modal-ubah #nama2").val(nama);
        $("#modal-ubah #jenis").val(jenis);
        $("#modal-ubah #harga").val(harga);
        $("#modal-ubah #untung").val(untung);
      })
    </script>
    <script type="text/javascript">
      $(document).on("click","#hapus_SC",function(){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $("#modal-hapus #id").val(id);
        $("#modal-hapus #nama2").val(nama);
        $("#modal-hapus #nama").text(nama);
      })
    </script>
    <script>
      $(document).ready(function(){
        $("#cari").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tabelSC tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>

    <script>
      function checkEdit() {
        var a = document.forms["FormEdit"]["untung"].value;
        a=parseFloat(a);
        var b = document.forms["FormEdit"]["harga"].value;
        b=parseFloat(b);
        if (a > b) {
          alert("Untung tidak bisa lebih besar dari harga");
          return false;
        }
      }
    </script>

    <script>
      function checkTambah() {
        var x = document.forms["FormTambah"]["untung"].value;
        x=parseFloat(x);
        var y = document.forms["FormTambah"]["harga"].value;
        y=parseFloat(y);
        if (x > y) {
          alert("Untung tidak bisa lebih besar dari harga");
          return false;
        }
      }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

  </html>
