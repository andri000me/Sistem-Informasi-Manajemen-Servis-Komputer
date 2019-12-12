
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cetak Gaji</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

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
  $namatek=$dataaa['nama'];
  ?>
<?php
  // header("Content-type: application/vnd-ms-excel");
  // header("Content-Disposition: attachment; filename=Laporan Gaji $namatek.xls");
?>

  <center>
    <h3>Detail Gaji <?= $dataaa['nama']; ?> <?= $bln; ?> <?= $tahun; ?></h3>
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
        </table>
      </center>
      <script>
        window.print();
      </script>
    </body>

    </html>
