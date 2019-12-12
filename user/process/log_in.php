<?php
// menghubungkan php dengan koneksi database
include 'koneksi.php';
// menangkap data yang dikirim dari form login 
if (isset($_POST['username'], $_POST['password'], $_POST['hitung'], $_POST['jawab'])) {
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = mysqli_real_escape_string($koneksi, $_POST['password']);
	$pw=md5($password);
} else {
	header('Location: ../../index.php');
}
 //cek captcha
if ($_POST['hitung'] !== $_POST['jawab']) {
// alihkan ke halaman login bila captcha salah
	header("Location: ../../index.php?msg=wrongans");
}else{
// mengaktifkan session pada php
session_start();




// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from pengelola where username='$username' and password='$pw'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	// cek jika user login sebagai owner
	if($data['level']=="Owner"){
		// buat session login dan username
		$_SESSION['level'] = "Owner";
		$_SESSION['status'] = $data['status'];
		$_SESSION['avatar'] = $data['avatar'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['username'] = $data['username'];

		//insert aktivitas ke log_aktivitas
		$nama=$_SESSION['nama'];
		$level="Owner";
		$waktu = date("Y-m-d H:i:s");
		$query="insert into log_aktivitas values ('[ $nama ] [ $level ] melakukan login','Login', now())";
		mysqli_query($koneksi, $query);
		// alihkan ke halaman dashboard owner
		header("Location: ../owner/index.php");
	// cek jika user login sebagai admin
	}else if($data['level']=="Admin"){
		// buat session login dan username
		$_SESSION['level'] = "Admin";
		$_SESSION['status'] = $data['status'];
		$_SESSION['avatar'] = $data['avatar'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['username'] = $data['username'];

		//insert aktivitas ke log_aktivitas
		$nama=$_SESSION['nama'];
		$level="Admin";
		$waktu = date("Y-m-d H:i:s");
		$query="insert into log_aktivitas values ('[ $nama ] [ $level ] melakukan login', 'Login', now())";
		mysqli_query($koneksi, $query);
		// alihkan ke halaman dashboard admin
		header("Location: ../admin/index.php");

	// cek jika user login sebagai kasir
	}else if($data['level']=="Kasir"){
		// buat session login dan username
		$_SESSION['level'] = "Kasir";
		$_SESSION['status'] = $data['status'];
		$_SESSION['avatar'] = $data['avatar'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['username'] = $data['username'];
		
		//insert aktivitas ke log_aktivitas
		$nama=$_SESSION['nama'];
		$level="Kasir";
		$waktu = date("Y-m-d H:i:s");
		$query="insert into log_aktivitas values ('[ $nama ] [ $level ] melakukan login', 'Login', now())";
		mysqli_query($koneksi, $query);
		// alihkan ke halaman dashboard kasir
		header("Location: ../kasir/index.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:../../index.php?msg=upf");
	}	
}else{
	header("location:../../index.php?msg=wronguname");
}

}

?>