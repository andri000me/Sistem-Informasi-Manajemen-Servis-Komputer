<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$queryAmbilPassword = mysqli_query($koneksi,"select * from pengelola where username='$username'");
    $dataPassword = mysqli_fetch_assoc($queryAmbilPassword);
    $passwordLama =$dataPassword['password'];
    $passwordLamaInput=$_POST['password2'];
    $passwordLamaInputHash =md5($passwordLamaInput);

    if ($passwordLama !== $passwordLamaInputHash) {
    	header("Location: ../$level/index.php?msg=UbahPasswordGagal");
    }else{
		$passwordbaru=mysqli_real_escape_string($koneksi, $_POST['password3']);
		$newpassword=md5($passwordbaru);

		$queryUbahPassword = mysqli_query($koneksi,"update pengelola set password='$newpassword' where username='$username'");
	
		$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah passwordnya','Pengelola', now())");

		header("Location: ../$level/index.php?msg=UbahPasswordSukses");
	}
?>