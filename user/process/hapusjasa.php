
<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];

	$keterangan=mysqli_real_escape_string($koneksi, $_POST['keterangan2']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);

	$queryHapusJasa = mysqli_query($koneksi,"update jasa set hapus=1 where id_jasa=$id");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menghapus Jasa[$keterangan]','Jasa', now())");

	header("Location: ../$level/jasa.php?msg=HapusJasaSukses");

?>