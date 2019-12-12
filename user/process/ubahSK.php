<?php 
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$username=$_SESSION['username'];
	$waktu = date("Y-m-d H:i:s");
	$namaLama=mysqli_real_escape_string($koneksi, $_POST['nama2']);

	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);
	$jenis=mysqli_real_escape_string($koneksi, $_POST['jenis']);
	$harga=mysqli_real_escape_string($koneksi, $_POST['harga']);
	$untung=mysqli_real_escape_string($koneksi, $_POST['untung']);

	$queryUbahSK = mysqli_query($koneksi,"update suku_cadang set nama='$nama', jenis='$jenis', harga=$harga, untung=$untung where id_suku_cadang=$id");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah Suku Cadang[$namaLama] -> [$nama]','Suku Cadang', now())");

	header("Location: ../$level/sukucadang.php?msg=UbahSKSukses");
?>