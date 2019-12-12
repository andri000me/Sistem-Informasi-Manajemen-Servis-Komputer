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
                    if ($_GET['msg'] == "TambahSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Jasa Sukses Ditambahkan.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "TambahSKSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Suku Cadang Sukses Ditambahkan.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "HapusSKSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Suku Cadang Sukses Dihapus.
                      </div>  
                    <?php    }
                  }
                  ?>
                  <?php 
                  if (isset($_GET['msg'])) {                       
                    if ($_GET['msg'] == "HapusSukses") { ?>
                      <div class="alert alert-info" role="alert">
                        Jasa Sukses Dihapus.
                      </div>  
                    <?php    }
                  }
                  ?>                
                  <?php 
                  if (isset($_POST['idbarang'])) {
                    $id=$_POST['idbarang'];
                  }
                  elseif (isset($_SESSION['idbar'])) {
                    $id=$_SESSION['idbar'];
                  }                
                  include "../process/koneksi.php";
                  $query = mysqli_query($koneksi,"SELECT barang.id_teknisi as teknisi ,barang.id_barang, barang.pelanggan namapel, barang.nama AS namabrg, barang.status as status, barang.tgl_masuk as tgl_masuk, barang.tgl_keluar as tgl_keluar, barang.keluhan as keluhan, barang.total_biaya as total_biaya FROM barang where id_barang=$id order by barang.id_barang desc");
                  $data = mysqli_fetch_array($query);
                  $idteknisi=$data['teknisi'];
                  $queryy = mysqli_query($koneksi,"SELECT nama from teknisi where id_teknisi=$idteknisi");
                  $dataa = mysqli_fetch_array($queryy);
                  ?>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-bordered" id="tabeltransaksi">
                        <tbody>
                          <tr>
                            <th>Nama</th>
                            <td colspan="3"><?= $data['namapel']; ?></td>
                          </tr>
                          <tr>
                            <th>Barang</th>
                            <td colspan="3"><?= $data['namabrg']; ?></td>
                          </tr>
                          <tr>
                            <th>Teknisi</th>
                            <td colspan="3"><?= $dataa['nama']; ?></td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td colspan="3"><?= $data['status']; ?></td>
                          </tr>
                          <tr>
                            <th>Keluhan</th>
                            <td colspan="3"><?= $data['keluhan']; ?></td>
                          </tr>
                          <tr>
                            <th>Masuk</th>
                            <td colspan="3"><?= $data['tgl_masuk']; ?></td>
                          </tr>
                          <tr>
                            <th>Pilih Jasa</th>
                            <td colspan="3">
                              <form method="post" action="../process/tambahtransjasa.php">
                                <input type="hidden" name="idbarang" value="<?= $id; ?>">
                                <select name="jasa" class="form-control"> 
                                  <?php $query = mysqli_query($koneksi,"select * from jasa where hapus=0 order by jenis desc"); ?> 
                                  <?php if(mysqli_num_rows($query)>0){ ?>
                                    <?php
                                    $no = 1;
                                    while($data1 = mysqli_fetch_array($query)){
                                      ?>
                                      <option value="<?= $data1['id_jasa']; ?>"><?= $data1['keterangan']; ?></option>
                                      <?php $no++; } ?>
                                    <?php } ?>
                                  </select>
                                  <button type="submit" class="form-control btn-primary">Tambahkan</button>
                                </form>
                              </td>
                            </tr>
                            <tr>
                              <th>No</th>
                              <th colspan="3">Jasa yang Digunakan</th>
                            </tr>
                            <?php
                            $query1 = mysqli_query($koneksi,"SELECT trans_jasa.id_jasa as id_jasa, trans_jasa.subtotal_jasa as harga, jasa.keterangan as nama, trans_jasa.waktu as waktu FROM trans_jasa INNER JOIN jasa ON trans_jasa.id_jasa=jasa.id_jasa where id_barang=$id");
                            if(mysqli_num_rows($query1)>0){ ?>
                              <?php
                              $no1 = 1;
                              while($data1 = mysqli_fetch_array($query1)){
                                ?>
                                <tr>
                                  <td><?= $no1; ?></td>
                                  <td><?= $data1['nama']; ?></td>
                                  <td>Rp. <?= number_format($data1['harga'],0,",","."); ?></td>
                                  <td>
                                    <a id="hapus_jasa" data-toggle="modal" data-target="#hapus" data-id="<?= $data1['id_jasa']; ?>" data-keterangan="<?= $data1['nama']; ?>" data-waktu="<?= $data1['waktu']; ?>"  >
                                      <button><i class="fas fa-trash-alt"></i>
                                      </button>
                                    </a>
                                  </td>
                                </tr>
                                <?php $no1++; } ?>
                              <?php } ?>
                              <?php  
                              $query2 = mysqli_query($koneksi,"SELECT SUM(trans_jasa.subtotal_jasa) AS harga FROM trans_jasa WHERE trans_jasa.id_barang=$id;");
                              $data2 = mysqli_fetch_array($query2);
                              ?>
                              <tr>
                                <td></td>
                                <td>Total Jasa</td>
                                <td>Rp. <?= number_format($data2['harga'],0,",","."); ?></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="col-md-6">
                          <?php
                          $query4 = mysqli_query($koneksi,"SELECT barang.id_teknisi as teknisi ,barang.id_barang, barang.pelanggan as namapel, barang.nama AS namabrg, barang.status as status, barang.tgl_masuk as tgl_masuk, barang.tgl_keluar as tgl_keluar, barang.keluhan as keluhan, barang.total_biaya as total_biaya FROM barang where id_barang=$id order by barang.id_barang desc");
                          $data4 = mysqli_fetch_array($query4);
                          $idteknisi=$data4['teknisi'];
                          $queryy4 = mysqli_query($koneksi,"SELECT nama from teknisi where id_teknisi=$idteknisi");
                          $dataa4 = mysqli_fetch_array($queryy4);
                          ?>
                          <table class="table table-bordered" id="tabeltransaksi">
                            <tbody>
                              <tr>
                                <th>Nama</th>
                                <td colspan="3"><?= $data4['namapel']; ?></td>
                              </tr>
                              <tr>
                                <th>Barang</th>
                                <td colspan="3"><?= $data4['namabrg']; ?></td>
                              </tr>
                              <tr>
                                <th>Teknisi</th>
                                <td colspan="3"><?= $dataa4['nama']; ?></td>
                              </tr>
                              <tr>
                                <th>Status</th>
                                <td colspan="3"><?= $data4['status']; ?></td>
                              </tr>
                              <tr>
                                <th>Keluhan</th>
                                <td colspan="3"><?= $data4['keluhan']; ?></td>
                              </tr>
                              <tr>
                                <th>Masuk</th>
                                <td colspan="3"><?= $data4['tgl_masuk']; ?></td>
                              </tr>
                              <tr>
                                <th>Pilih Suku Cadang</th>
                                <td colspan="3">
                                  <form method="post" action="../process/tambahtranssukucadang.php">
                                    <input type="hidden" name="idbarang" value="<?= $id; ?>">
                                    <select name="sukucadang" class="form-control"> 
                                      <?php $query5 = mysqli_query($koneksi,"select * from suku_cadang where hapus=0 order by jenis desc"); ?> 
                                      <?php if(mysqli_num_rows($query5)>0){ ?>
                                        <?php
                                        $no5 = 1;
                                        while($data5 = mysqli_fetch_array($query5)){
                                          ?>
                                          <option value="<?= $data5['id_suku_cadang']; ?>"><?= $data5['nama']; ?> (<?= $data5['jenis']; ?>)</option>
                                          <?php $no5++; } ?>
                                        <?php } ?>
                                      </select>
                                      <button type="submit" class="form-control btn-primary">Tambahkan</button>
                                    </form>
                                  </td>
                                </tr>
                                <tr>
                                  <th>No</th>
                                  <th colspan="3">Suku Cadang yang Digunakan</th>
                                </tr>
                                <?php
                                $query6 = mysqli_query($koneksi,"SELECT trans_sukucadang.id_suku_cadang as id_sukucadang, trans_sukucadang.subtotal_sukucadang as harga, suku_cadang.nama as nama, trans_sukucadang.waktu as waktu FROM trans_sukucadang INNER JOIN suku_cadang ON trans_sukucadang.id_suku_cadang=suku_cadang.id_suku_cadang where id_barang=$id");
                                if(mysqli_num_rows($query6)>0){ ?>
                                  <?php
                                  $no6 = 1;
                                  while($data6 = mysqli_fetch_array($query6)){
                                    ?>
                                    <tr>
                                      <td><?= $no6; ?></td>
                                      <td><?= $data6['nama']; ?></td>
                                      <td>Rp. <?= number_format($data6['harga'],0,",","."); ?></td>
                                      <td>
                                        <a id="hapus_SK" data-toggle="modal" data-target="#hapusSK" data-id="<?= $data6['id_sukucadang']; ?>" data-keterangan="<?= $data6['nama']; ?>" data-waktu="<?= $data6['waktu']; ?>" >
                                          <button><i class="fas fa-trash-alt"></i>
                                          </button>
                                        </a>
                                      </td>
                                    </tr>
                                    <?php $no6++; } ?>
                                  <?php } ?>
                                  <?php  
                                  $query7 = mysqli_query($koneksi,"SELECT SUM(trans_sukucadang.subtotal_sukucadang) AS harga FROM trans_sukucadang WHERE trans_sukucadang.id_barang=$id;");
                                  $data7 = mysqli_fetch_array($query7);
                                  ?>
                                  <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>Rp. <?= number_format($data7['harga'],0,",","."); ?></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-3">
                              <button type="button" class="btn btn-primary form-control" onclick="window.location.href='updatetrans.php'">Kembali
                              </button>
                            </div>
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

          <!-- HAPUS -->
          <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="modalhapusjasaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus Jasa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="modal-hapus">
                  Apakah anda yakin ingin menghapus <span id="keterangan2"></span>?
                  <form method="post" action="../process/hapustransjasa.php">
                    <input type="hidden" name="idbar" value="<?= $id; ?>">
                    <input type="hidden" name="id"  id="id">
                    <input type="hidden" name="waktu"  id="waktu">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus Jasa</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- HAPUS SUKU CADANG -->
          <div class="modal fade" id="hapusSK" tabindex="-1" role="dialog" aria-labelledby="modalhapusjasaLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Suku Cadang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal-hapusSK">
                Apakah anda yakin ingin menghapus <span id="keterangan2"></span>?
                <form method="post" action="../process/hapustranssukucadang.php">
                  <input type="hidden" name="idbar" value="<?= $id; ?>">
                  <input type="hidden" name="id"  id="id">
                  <input type="hidden" name="waktu"  id="waktu">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Hapus Jasa</button>
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
            $(document).on("click","#hapus_jasa",function(){
              var idj = $(this).data('id');
              var waktu = $(this).data('waktu');
              var keteranganj = $(this).data('keterangan');
              $("#modal-hapus #id").val(idj);
              $("#modal-hapus #waktu").val(waktu);
              $("#modal-hapus #keterangan").text(keteranganj);
              $("#modal-hapus #keterangan2").text(keteranganj);
            })
          </script>
           <script type="text/javascript">
          $(document).on("click","#hapus_SK",function(){
            var idj2 = $(this).data('id');
            var waktu2 = $(this).data('waktu');
            var keteranganj22 = $(this).data('keterangan');
            $("#modal-hapusSK #id").val(idj2);
            $("#modal-hapusSK #waktu").val(waktu2);
            $("#modal-hapusSK #keterangan").text(keteranganj22);
            $("#modal-hapusSK #keterangan2").text(keteranganj22);
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
