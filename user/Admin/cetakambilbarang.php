
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cetak Nota</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <?php  
  $kode=$_GET['k'];
  include "../process/koneksi.php";
  $query = mysqli_query($koneksi,"select * from barang where kode = $kode");
  $data=mysqli_fetch_array($query);
  $idbar=$data['id_barang'];
  $teknisi=$data['id_teknisi'];
  $query2 = mysqli_query($koneksi,"select nama from teknisi where id_teknisi=$teknisi");
  $data2=mysqli_fetch_array($query2);
  ?>
  <center>
    <table class="table table-bordered">
      <tr>
        <td colspan="3" style="font-size: 20px;">Bukti Transaksi - EnnComputer</td>
      </tr>
      <tr>
        <td>Kode Transaksi</td>
        
        <td colspan="2"><?= $data['kode']; ?></td>
      </tr>
      <tr>
        <td>Nama Pelanggan</td>
        
        <td colspan="2"><?= $data['pelanggan']; ?></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        
        <td colspan="2"><?= $data['nama']; ?></td>
      </tr>
      <tr>
        <td>Nama Teknisi</td>
        
        <td colspan="2"><?= $data2['nama']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Masuk</td>
        
        <td colspan="2"><?= $data['tgl_masuk']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Keluar</td>
        
        <td colspan="2"><?= $data['tgl_keluar']; ?> </td>
      </tr>
      <tr>
        <td>Tanggal Garansi</td>
       
        <td colspan="2"><?= $data['tgl_garansi']; ?></td>
      </tr>
      <tr>
        <td colspan="3" align="center">Transaksi</td>
      </tr>
      <?php
      $id=$data['id_barang'];
      $query1 = mysqli_query($koneksi,"SELECT trans_jasa.id_jasa as id_jasa, trans_jasa.subtotal_jasa as harga, jasa.keterangan as nama FROM trans_jasa INNER JOIN jasa ON trans_jasa.id_jasa=jasa.id_jasa where id_barang=$idbar");
      if(mysqli_num_rows($query1)>0){ ?>
        <?php
        $no1 = 1;
        while($data4 = mysqli_fetch_array($query1)){
          ?>
          <tr>
            <td colspan="2"><?= $data4['nama']; ?></td>
            <td>Rp. <?= number_format($data4['harga'],0,",","."); ?></td>
          </tr>
          <?php $no1++; } ?>
        <?php } ?>
        <?php
        $query3 = mysqli_query($koneksi,"SELECT trans_sukucadang.id_suku_cadang as id_sukucadang, trans_sukucadang.subtotal_sukucadang as harga, suku_cadang.nama as nama FROM trans_sukucadang INNER JOIN suku_cadang ON trans_sukucadang.id_suku_cadang=suku_cadang.id_suku_cadang where id_barang=$idbar");
        if(mysqli_num_rows($query3)>0){ ?>
          <?php
          $no1 = 1;
          while($data6 = mysqli_fetch_array($query3)){
            ?>
            <tr>
              <td colspan="2"><?= $data6['nama']; ?></td>
              <td>Rp. <?= number_format($data6['harga'],0,",","."); ?></td>
            </tr>
            <?php $no1++; } ?>
          <?php } ?>
          <tr>
            <td colspan="2" align="center">Total</td>
            <td>Rp. <?= number_format($data['total_biaya'],0,",","."); ?></td>
          </tr>
        </table>
        <br><br>
        <a href="transaksi.php?msg=AmbilSukses">Kembali Ke Transaksi</a>
      </center>
      <script>
        window.print();
      </script>
    </body>

    </html>
