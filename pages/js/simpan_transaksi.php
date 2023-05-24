<?php 
	session_start();
	include "../../koneksi.php";

$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$total_penjualan = @mysqli_real_escape_string($conn, $_POST['total_penjualan']);
	$jml_uang = @mysqli_real_escape_string($conn, $_POST['jml_uang']);
		$jml_kembali = @mysqli_real_escape_string($conn, $_POST['jml_kembali']);

$query = "INSERT INTO tbl_transaksi (no_daftar, total_penjualan, jml_uang,  jml_kembali) VALUES('$kode', '$total_penjualan', '$jml_uang', '$jml_kembali')";

	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>