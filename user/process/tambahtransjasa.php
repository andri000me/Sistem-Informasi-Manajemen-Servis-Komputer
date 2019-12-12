<?php

include "koneksi.php";
session_start();
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$nama=$_SESSION['nama'];

$idbarang=mysqli_real_escape_string($koneksi, $_POST['idbarang']);
$_SESSION['idbar']=$idbarang;
$idjasa=mysqli_real_escape_string($koneksi, $_POST['jasa']);
$query = mysqli_query($koneksi,"select * from jasa where id_jasa=$idjasa"); 
$data = mysqli_fetch_array($query);
$keterangan=$data['keterangan'];
$harga=$data['harga'];
$untung=$harga*0.8;
$upah=$harga*0.2;

// echo $idbarang;
// echo "<br>";
// echo $_SESSION['idbar'];
// echo "<br>";
// echo $idjasa;
// echo "<br>";
// echo $keterangan;
// echo "<br>";
// echo $harga;
// echo "<br>";
// echo $untung;
// echo "<br>";
// echo $upah;
// echo "<br>";



$queryTambahBarang = mysqli_query($koneksi,"update barang set total_biaya=total_biaya+$harga, total_untung=total_untung+$untung, total_upah=total_upah+$upah where id_barang=$idbarang");
$queryTambahJasa = mysqli_query($koneksi,"INSERT INTO trans_jasa (id_jasa, id_barang, subtotal_jasa, subtotal_untung, subtotal_upah, waktu) VALUES ($idjasa, $idbarang, $harga, $untung, $upah, now());");
// $queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Jasa Transaksi[$idbarang]['keterangan']','Transaksi', now())");

	header("Location: ../$level/tambahjasa.php?msg=TambahSukses");


?>