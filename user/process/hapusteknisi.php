
<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];
	$waktu = date("Y-m-d H:i:s");

	$nama1=mysqli_real_escape_string($koneksi, $_POST['nama']);
	$id=mysqli_real_escape_string($koneksi, $_POST['id']);

	$queryHapusTeknisi = mysqli_query($koneksi,"delete from teknisi where id_teknisi=$id");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menghapus Teknisi[$nama1]','Karyawan', now())");

	header("Location: ../$level/karyawan.php?msg=HapusKaryawanSukses");

?>