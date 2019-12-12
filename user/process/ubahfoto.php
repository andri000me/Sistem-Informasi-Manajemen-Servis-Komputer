<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$username=$_SESSION['username'];

	$file=$_FILES['foto']['name'];
	$temp=$_FILES['foto']['tmp_name'];
	$waktu = date('dmYHis');
	$newfile=$waktu . $file;
	$path = "../../img/$newfile";
	
	move_uploaded_file($temp, $path);
	
	$queryUbahFoto = mysqli_query($koneksi,"update pengelola set avatar='$path' where username='$username'");
	header("Location: ../owner/karyawan.php");

	$waktu2 = date("Y-m-d H:i:s");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah Foto profilnya','Pengelola', now())");

	$_SESSION['avatar']=$path;
	header("Location: ../$level/index.php?msg=UbahFotoSukses");
?>