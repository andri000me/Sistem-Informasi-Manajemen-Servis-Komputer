<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$keterangan=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$jenis=mysqli_real_escape_string($koneksi, $_POST['jenis']);
	$harga=mysqli_real_escape_string($koneksi, $_POST['harga']);

	$queryTambahJasa = mysqli_query($koneksi,"insert into jasa values ('', '$keterangan', '$jenis', $harga, 0)");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Jasa[$keterangan]','Jasa', now())");

	header("Location: ../$level/jasa.php?msg=TambahJasaSukses");

?>