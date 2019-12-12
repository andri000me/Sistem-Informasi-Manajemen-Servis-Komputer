<?php 
if ($_POST['logout']=='logout') {
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] melakukan logout','Logout', now())");
	session_destroy();
	header("location:../../index.php");
}

?>