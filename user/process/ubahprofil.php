<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];

    $queryProfil = mysqli_query($koneksi,"select * from pengelola where username='$username'");
    $dataProfil = mysqli_fetch_assoc($queryProfil);
    $namaLama=$dataProfil['nama'];
	$waktu = date("Y-m-d H:i:s");
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$email=mysqli_real_escape_string($koneksi, $_POST['email']);
	$notelp=mysqli_real_escape_string($koneksi, $_POST['notelp']);
	$alamat=mysqli_real_escape_string($koneksi, $_POST['alamat']);

	$queryUbahProfil = mysqli_query($koneksi,"update pengelola set nama='$nama', email='$email', alamat='$alamat', notelp='$notelp' where username='$username'");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $namaLama ] [ $level ] mengubah data profilnya menjadi [$nama] [$level]','Pengelola', now())");

	$_SESSION['nama']=$nama;
	header("Location: ../$level/index.php?msg=UbahProfilSukses");
?>