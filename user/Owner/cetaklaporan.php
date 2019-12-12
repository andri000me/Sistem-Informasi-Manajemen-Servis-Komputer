
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cetak Laporan</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <?php 
  include "../process/koneksi.php";
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
  $query = mysqli_query($koneksi,"select * from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun order by tgl_keluar desc");
  $query2 = mysqli_query($koneksi,"select sum(total_biaya) as biaya, sum(total_untung) as untung, sum(total_upah) as upah from barang where status='Diambil' and month(tgl_keluar)=$bulan and year(tgl_keluar)=$tahun");
  $datatotal=mysqli_fetch_array($query2);
  ?>

  <center>
    <h3>Detail Laporan Transaksi <?= $bln; ?> <?= $tahun; ?></h3>
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
            <td>Rp. <?= number_format($datatotal['biaya'],0,",","."); ?></td>
            <td>Rp. <?= number_format($datatotal['untung'],0,",","."); ?></td>
            <td>Rp. <?= number_format($datatotal['upah'],0,",","."); ?></td>
          </tr>
        </tbody>
      </table>
      <script>
        window.print();
      </script>
    </body>

    </html>
