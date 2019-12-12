<?php  

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$username=$_SESSION['username'];
	$waktu = date("Y-m-d H:i:s");

	$id=mysqli_real_escape_string($koneksi, $_POST['id']);
	$status=mysqli_real_escape_string($koneksi, $_POST['status']);

	$queryUbahStatus = mysqli_query($koneksi,"update barang set status='$status' where id_barang=$id");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] mengubah Transaksi[$id] -> [$status]','Transaksi', now())");

	header("Location: ../$level/updatetrans.php?msg=PerbaruiSukses");

?>