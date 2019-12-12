<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$username=$_SESSION['username'];
	$waktu = date("Y-m-d H:i:s");

	$keterangan=mysqli_real_escape_string($koneksi, $_POST['keterangan']);
	$keterangan2=mysqli_real_escape_string($koneksi, $_POST['keterangan2']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);
	$jenis=mysqli_real_escape_string($koneksi, $_POST['jenis']);
	$harga=mysqli_real_escape_string($koneksi, $_POST['harga']);

	$queryUbahJasa = mysqli_query($koneksi,"update jasa set keterangan='$keterangan', jenis='$jenis', harga=$harga where id_jasa=$id");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah Jasa[$keterangan2] -> [$keterangan]','Jasa', now())");

	header("Location: ../$level/jasa.php?msg=UbahJasaSukses");
?>