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

  <title>Karyawan</title>

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
            <li class="breadcrumb-item active">Karyawan</li>
          </ol>


          <div class="row">
            <div class="col-md-12">
              <div class="card border-dark">
                <div class="card-header text-center">Kelola Karyawan</div>
                <div class="card-body">
                  <div class="container text-center">
                    <?php 
                    if (isset($_GET['msg'])) {                       
                      if ($_GET['msg'] == "TambahKaryawanSukses") { ?>
                        <div class="alert alert-info" role="alert">
                          Karyawan Berhasil Ditambahkan.
                        </div>  
                      <?php    }
                    }
                    ?>
                    <?php 
                    if (isset($_GET['msg'])) {                       
                      if ($_GET['msg'] == "unameSalah") { ?>
                        <div class="alert alert-danger" role="alert">
                          Tambah Pengelola Gagal, Username Telah Digunakan.
                        </div>  
                      <?php    }
                    }
                    ?>
                    <?php 
                    if (isset($_GET['msg'])) {                       
                      if ($_GET['msg'] == "HapusKaryawanSukses") { ?>
                        <div class="alert alert-info" role="alert">
                          Karyawan Berhasil Dihapus.
                        </div>  
                      <?php    }
                    }
                    ?>

                    <?php 
                    if (isset($_GET['msg'])) {                       
                      if ($_GET['msg'] == "UbahKaryawanSukses") { ?>
                        <div class="alert alert-info" role="alert">
                          Karyawan Berhasil Diubah.
                        </div>  
                      <?php    }
                    }
                    ?>
                    <div class="row">
                      <div class="col-md-2"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPengelola">Tambah Pengelola</button>
                        <br><br></div>
                        <div class="col-md-10"></div>
                      </div>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          include "../process/koneksi.php";
                          $query = mysqli_query($koneksi,"select * from pengelola order by status");
                          if(mysqli_num_rows($query)>0){ ?>
                            <?php
                            $no = 1;
                            while($data = mysqli_fetch_array($query)){
                              ?>
                              <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['level']; ?></td>
                                <td><?= $data['status']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['notelp']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <?php if ($_SESSION['username']==$data['username']) { ?>
                                  <th></th>
                                <?php  }else{ ?>
                                  <th>
                                  <a id="ubah_pengelola" data-toggle="modal" data-target="#ubah" data-id="<?= $data['username']; ?>" data-nama="<?= $data['nama']; ?>"
                                    data-status="<?= $data['status']; ?>" data-level="<?= $data['level']; ?>">
                                    <button><i class="fas fa-edit"></i>
                                    </button>
                                  </a>
                                </th>
                                <?php } ?>
                              </tr>
                              <?php $no++; } ?>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="container text-center">
                        <div class="row">
                          <div class="col-md-2"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahTeknisi">Tambah Teknisi</button>
                            <br><br></div>
                            <div class="col-md-10"></div>
                          </div>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $query1 = mysqli_query($koneksi,"select * from teknisi order by status");
                              if(mysqli_num_rows($query)>0){ ?>
                                <?php
                                $no = 1;
                                while($data1 = mysqli_fetch_array($query1)){
                                  ?>
                                  <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $data1['nama']; ?></td>
                                    <td><?= $data1['notelp']; ?></td>
                                    <td><?= $data1['status']; ?></td>
                                    <td><?= $data1['alamat']; ?></td>
                                    <th>
                                    <a id="ubah_teknisi" data-toggle="modal" data-target="#modalUbahTeknisi" data-id="<?= $data1['id_teknisi']; ?>" data-nama="<?= $data1['nama']; ?>" data-status="<?= $data1['status']; ?>" data-alamat="<?= $data1['alamat']; ?>" data-notelp="<?= $data1['notelp']; ?>">
                                    <button><i class="fas fa-edit"></i>
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

        <!-- MODAL TAMBAH JASA -->
        <div class="modal fade" id="modalTambahPengelola" tabindex="-1" role="dialog" aria-labelledby="modalTambahTeknisi" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengelola</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../process/tambahpengelola.php" method="post">
                  <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control" id="uname" name="uname" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Pengelola:</label>
                    <input type="text" class="form-control" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="telpon">No. Telpon:</label>
                    <input type="number" class="form-control" id="telpon" name="telpon" min="1" max="99999999999" required>
                  </div>
                  <div class="form-group">
                    <label for="telpon">Level:</label>
                    <select name="level" class="form-control" required="">
                      <option value="Owner">Owner</option>
                      <option value="Admin">Admin</option>
                      <option value="Kasir">Kasir</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Pengelola</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- EDIT -->
        <div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="modalubahjasaLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Pengelola</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal-ubah-pengelola">
                <form action="../process/ubahpengelola.php" method="post">
                  <div class="form-group">
                    <input type="hidden" name="id" id="id">
                    <label for="nama">Nama Pengelola:</label>
                    <input type="text" class="form-control" title="Hanya menerima input berupa huruf dan angka" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" disabled required>
                  </div>
                  <div class="form-group">
                    <label for="level">Level:</label> <br>
                    <select name="level" class="custom-select " id="level">
                      <option value="Owner">Owner</option>
                      <option value="Admin">Admin</option>
                      <option value="Kasir">Kasir</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status:</label> <br>
                    <select name="status" class="custom-select " id="status">
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Ubah Pengelola</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL TAMBAH JASA -->
        <div class="modal fade" id="modalTambahTeknisi" tabindex="-1" role="dialog" aria-labelledby="modalTambahTeknisi" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Teknisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../process/tambahteknisi.php" method="post">
                  <div class="form-group">
                    <label for="nama">Nama Teknisi:</label>
                    <input type="text" class="form-control" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="status">Status:</label> <br>
                    <select name="status" class="custom-select w-25" id="inputGroupSelect04">
                      <option selected value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="telpon">No. Telpon:</label>
                    <input type="number" class="form-control" id="telpon" name="telpon" min="1" max="99999999999" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Teknisi</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL TAMBAH JASA -->
        <div class="modal fade" id="modalUbahTeknisi" tabindex="-1" role="dialog" aria-labelledby="modalTambahTeknisi" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Teknisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal-ubah-teknisi">
                <form action="../process/ubahteknisi.php" method="post">
                  <input type="hidden" name="id" id="id">
                  <input type="hidden" name="nama2" id="nama2">
                  <div class="form-group">
                    <label for="nama">Nama Teknisi:</label>
                    <input type="text" class="form-control" id="nama" name="nama" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="status">Status:</label> <br>
                    <select name="status" class="custom-select w-25" id="status">
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" pattern="[A-Za-z0-9 ]+" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="notelp">No. Telpon:</label>
                    <input type="text" class="form-control" id="notelp" name="notelp" maxlength="13" pattern="[0-9 ]+" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah Teknisi</button>
                </form>
              </div>
            </div>
          </div>
        </div>




        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- CUSTOM JAVASCRIPT -->
        <script type="text/javascript">
          $(document).on("click","#ubah_pengelola",function(){
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var level = $(this).data('level');
            var status = $(this).data('status');
            $("#modal-ubah-pengelola #id").val(id);
            $("#modal-ubah-pengelola #nama").val(nama);
            $("#modal-ubah-pengelola #level").val(level);
            $("#modal-ubah-pengelola #status").val(status);
          })

          $(document).on("click","#ubah_teknisi",function(){
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var status = $(this).data('status');
            var notelp = $(this).data('notelp');
            var alamat = $(this).data('alamat');
            $("#modal-ubah-teknisi #id").val(id);
            $("#modal-ubah-teknisi #nama").val(nama);
            $("#modal-ubah-teknisi #nama2").val(nama);
            $("#modal-ubah-teknisi #notelp").val(notelp);
            $("#modal-ubah-teknisi #status").val(status);
            $("#modal-ubah-teknisi #alamat").val(alamat);
          })
        </script>
      </body>

      </html>
