<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$jenis=mysqli_real_escape_string($koneksi, $_POST['jenis']);
	$harga=mysqli_real_escape_string($koneksi, $_POST['harga']);
	$untung=mysqli_real_escape_string($koneksi, $_POST['untung']);

	// echo $nama;
	// echo $jenis;
	// echo $harga;
	// echo $untung;

	$queryTambahJasa = mysqli_query($koneksi,"insert into suku_cadang values ('', '$nama', '$jenis', $harga, $untung, 0)");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Suku Cadang [$nama]','Suku cadang', now()");

	header("Location: ../$level/sukucadang.php?msg=TambahSKSukses");

?>