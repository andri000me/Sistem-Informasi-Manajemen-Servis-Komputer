<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama2=$_SESSION['nama'];
	$username=$_SESSION['username'];
	$namaLama=mysqli_real_escape_string($koneksi, $_POST['nama2']);

	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);
	$alamat=mysqli_real_escape_string($koneksi, $_POST['alamat']);
	$status=mysqli_real_escape_string($koneksi, $_POST['status']);
	$telpon=mysqli_real_escape_string($koneksi, $_POST['notelp']);

	$queryUbahTeknisi = mysqli_query($koneksi,"update teknisi set nama='$nama', alamat='$alamat', status='$status', notelp='$telpon' where id_teknisi=$id");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama2 ] [ $level ] mengubah teknisi[$namaLama] -> [$nama]','Karyawan', now()");

	header("Location: ../$level/karyawan.php?msg=UbahKaryawanSukses");
?>