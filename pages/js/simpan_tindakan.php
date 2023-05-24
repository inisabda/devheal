<?php 
	session_start();
	include "../../koneksi.php";

$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$nama_tindakan = @mysqli_real_escape_string($conn, $_POST['nama_tindakan']);
	$harga_tindakan = @mysqli_real_escape_string($conn, $_POST['harga_tindakan']);
		$tgl_input = @mysqli_real_escape_string($conn, $_POST['tgl_input']);

$query = "INSERT INTO data_tindakan (kd_tindakan, nama_tindakan, harga_tindakan,  tgl_input) VALUES('$kode', '$nama_tindakan', '$harga_tindakan', '$tgl_input')";

	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>