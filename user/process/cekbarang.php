<?php  

	include "../process/koneksi.php";
	$kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
    $queryAmbilBarang = mysqli_query($koneksi,"select * from barang where kode='$kode'");
    if (mysqli_num_rows($queryAmbilBarang)>0){
    	$data = mysqli_fetch_assoc($queryAmbilBarang);
    	$id = $data['kode'];
    	$nama = $data['nama'];
    	$tgl_masuk = $data['tgl_masuk'];
    	$status = $data['status'];
        $biaya = $data['total_biaya'];
    	header("Location: ../../cekbarang.php?id=$id&n=$nama&tm=$tgl_masuk&s=$status&tb=$biaya");
	}else{
		header("Location: ../../cekbarang.php?msg=notfound");
	}
?>