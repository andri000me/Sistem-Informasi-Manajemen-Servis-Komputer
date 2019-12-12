<?php 

	include "koneksi.php";
	session_start();
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$nama=$_SESSION['nama'];

	$kodelama=mysqli_real_escape_string($koneksi, $_POST['kodebrg']);
	$pelanggan=mysqli_real_escape_string($koneksi, $_POST['namapel']);
	$telepon=mysqli_real_escape_string($koneksi, $_POST['telpon']);
	$barang=mysqli_real_escape_string($koneksi, $_POST['namabrg']);
	$keluhan=mysqli_real_escape_string($koneksi, $_POST['keluhan']);
	$status=mysqli_real_escape_string($koneksi, $_POST['status']);
	$idteknisi=mysqli_real_escape_string($koneksi, $_POST['teknisi']);

	$kode=rand(1, 99999);
	$hari=date('d');
	$bulan=date('m');
	$kodebaru=$hari.$bulan.$kode;

	$queryUpdateBarangLama=mysqli_query($koneksi, "update barang set status_garansi=0 where kode='$kodelama'");
	$queryTambahServis = mysqli_query($koneksi,"INSERT INTO barang (id_barang, nama, keluhan, pelanggan, notelp_pel, tgl_masuk, status, kode, username, id_teknisi) VALUES ('', '$barang (Garansi)', '$keluhan', '$pelanggan', '$telepon', now(), '$status', '$kodebaru', '$username', $idteknisi)");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Transaksi[$pelanggan][$barang]','Transaksi', now())");

	header("Location: ../$level/transaksi.php?msg=TambahServisSukses");

?>