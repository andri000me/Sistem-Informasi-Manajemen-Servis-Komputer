<?php 

include "koneksi.php";
session_start();
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$nama=$_SESSION['nama'];
$waktu = date("Y-m-d H:i:s");

$uname=mysqli_real_escape_string($koneksi, $_POST['uname']);
$pass=md5($uname);
$nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
$email=mysqli_real_escape_string($koneksi, $_POST['email']);
$telpon=mysqli_real_escape_string($koneksi, $_POST['telpon']);
$alamat=mysqli_real_escape_string($koneksi, $_POST['alamat']);
$level2=mysqli_real_escape_string($koneksi, $_POST['level']);

	// echo $uname;
	// echo "<br>";
	// echo $nama;
	// echo "<br>";
	// echo $email;
	// echo "<br>";
	// echo $telpon;
	// echo "<br>";
	// echo $alamat;
	// echo "<br>";
	// echo $level;
	// echo "<br>";
$cekpengelola = mysqli_query($koneksi,"select * from pengelola where username='$uname'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($cekpengelola);
// cek apakah username dan password di temukan pada database
if($cek > 0){
	header("Location: ../$level/karyawan.php?msg=unameSalah");
}else{
	$queryTambahTeknisi = mysqli_query($koneksi,"insert into pengelola values ('$uname', '$pass', '$nama', '$email', '$alamat', '$telpon', '$level2', 'Aktif', '../../img/default.png')");
	$queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Pengelola[$nama]','Karyawan', now())");

	header("Location: ../$level/karyawan.php?msg=TambahKaryawanSukses");
}
?>