<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama2=$_SESSION['nama'];
	$username=$_SESSION['username'];

	$id=mysqli_real_escape_string($koneksi, $_POST['id']);
	$level2=mysqli_real_escape_string($koneksi, $_POST['level']);
	$status=mysqli_real_escape_string($koneksi, $_POST['status']);
	echo $id;
	echo $level;
	echo $status;

	$queryUbahTeknisi = mysqli_query($koneksi,"update pengelola set level='$level2', status='$status' where username='$id'");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah Pengelola[$id],'Karyawan', now()");

	header("Location: ../$level/karyawan.php?msg=UbahKaryawanSukses");
?>