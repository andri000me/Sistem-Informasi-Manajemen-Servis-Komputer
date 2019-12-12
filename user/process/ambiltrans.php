<?php  
	
	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$nama=$_SESSION['nama'];
	$username=$_SESSION['username'];


	$garansi=mysqli_real_escape_string($koneksi, $_POST['garansi']);
	$kode=mysqli_real_escape_string($koneksi, $_POST['kode']);
	// echo $kode;
	// echo $garansi;
	$queryAmbilBarang = mysqli_query($koneksi,"update barang set tgl_keluar=now(), tgl_garansi='$garansi', status_garansi='1', status='Diambil' where kode='$kode'");
	
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] Ambil Transaksi [$kode]','Transaksi', now())");

	header("Location: ../$level/cetakambilbarang.php?k=$kode");

?>