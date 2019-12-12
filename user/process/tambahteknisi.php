<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$status=mysqli_real_escape_string($koneksi, $_POST['status']);
	$telpon=mysqli_real_escape_string($koneksi, $_POST['telpon']);
	$alamat=mysqli_real_escape_string($koneksi, $_POST['alamat']);

	$queryTambahTeknisi = mysqli_query($koneksi,"insert into teknisi values ('', '$nama', '$alamat', '$telpon', '$status')");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Teknisi[$nama]','Karyawan', now())");

	header("Location: ../$level/karyawan.php?msg=TambahKaryawanSukses");

?>