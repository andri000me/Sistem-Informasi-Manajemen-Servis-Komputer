
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cetak Nota</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <?php  
  $id=$_GET['brg'];
  include "../process/koneksi.php";
  $query = mysqli_query($koneksi,"select * from barang where id_barang = $id");
  $data=mysqli_fetch_array($query);
  $teknisi=$data['id_teknisi'];
  $query2 = mysqli_query($koneksi,"select nama from teknisi where id_teknisi=$teknisi");
  $data2=mysqli_fetch_array($query2);
  ?>
  <center>
    <table class="table table-bordered">
      <tr>
        <td colspan="3" class="text-center" style="font-size: 20px;">Bukti Transaksi - EnnComputer</td>
      </tr>
      <tr>
        <td>Kode Transaksi</td>
        
        <td><?= $data['kode']; ?></td>
      </tr>
      <tr>
        <td>Nama Pelanggan</td>
        
        <td><?= $data['pelanggan']; ?></td>
      </tr>
      <tr>
        <td>Telepon Pelanggan</td>
        
        <td><?= $data['notelp_pel']; ?></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        
        <td><?= $data['nama']; ?></td>
      </tr>
      <tr>
        <td>Keluhan</td>
        
        <td><?= $data['keluhan']; ?></td>
      </tr>
      <tr>
        <td>Tanggl Masuk</td>
        
        <td><?= $data['tgl_masuk']; ?></td>
      </tr>
      <tr>
        <td>Status</td>
        
        <td><?= $data['status']; ?></td>
      </tr>
    </table>
    <p>Note: Gunakan Kode Transaksi untuk mengecek barang anda di localhost/kpv2/cekbarang.php</p>
    <p>------------------------------------------------------------------------------------------------------------------------------</p>
      <table class="table table-bordered">
      <tr>
        <td colspan="3" class="text-center" style="font-size: 20px;">Bukti Transaksi - EnnComputer(Untuk ditempel di barang)</td>
      </tr>
      <tr>
        <td>Kode Transaksi</td>
        
        <td><?= $data['kode']; ?></td>
      </tr>
      <tr>
        <td>Nama Pelanggan</td>
        
        <td><?= $data['pelanggan']; ?></td>
      </tr>
      <tr>
        <td>Telepon Pelanggan</td>
        
        <td><?= $data['notelp_pel']; ?></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        
        <td><?= $data['nama']; ?></td>
      </tr>
      <tr>
        <td>Keluhan</td>
       
        <td><?= $data['keluhan']; ?></td>
      </tr>
      <tr>
        <td>Tanggl Masuk</td>
        
        <td><?= $data['tgl_masuk']; ?></td>
      </tr>
      <tr>
        <td>Status</td>
        
        <td><?= $data['status']; ?></td>
      </tr>
    </table>
    <p>------------------------------------------------------------------------------------------------------------------------------</p>
  </center>
  <script>
    window.print();
  </script>
</body>

</html>
