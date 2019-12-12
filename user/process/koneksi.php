<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'kp');
   $koneksi = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

 
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
?>