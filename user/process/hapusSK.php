
<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama1=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$nama=mysqli_real_escape_string($koneksi, $_POST['nama2']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);

	$queryHapusSK = mysqli_query($koneksi,"update suku_cadang set hapus=1 where id_suku_cadang=$id");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama1 ] [ $level ] menghapus Suku Cadang [$nama]','Suku Cadang', now())");

	header("Location: ../$level/sukucadang.php?msg=HapusSKSukses");

?>