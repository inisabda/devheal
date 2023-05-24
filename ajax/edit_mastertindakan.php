<?php 
	session_start();
	include "../koneksi.php";
	$kd_tindakan = @mysqli_real_escape_string($conn, $_POST['kd_tindakan']);
$nama_tindakan = @mysqli_real_escape_string($conn, $_POST['nama_tindakan']);
	$harga_tindakan = @mysqli_real_escape_string($conn, $_POST['harga_tindakan']);

	$query = "UPDATE data_tindakan SET nama_tindakan='$nama_tindakan', harga_tindakan='$harga_tindakan' WHERE kd_tindakan = '$kd_tindakan'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
