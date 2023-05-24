<?php 
	session_start();
	include "../koneksi.php";
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$total_penjualan = @mysqli_real_escape_string($conn, $_POST['total_penjualan']);
	$jml_uang = @mysqli_real_escape_string($conn, $_POST['jml_uang']);
	$jml_kembali = @mysqli_real_escape_string($conn, $_POST['jml_kembali']);
	$diskon = @mysqli_real_escape_string($conn, $_POST['diskon']);
	$administrasi = @mysqli_real_escape_string($conn, $_POST['administrasi']);
	$tgl_transaksi = @mysqli_real_escape_string($conn, $_POST['tgl_transaksi']);

	$query = "INSERT INTO tbl_transaksi (no_daftar, total_penjualan, jml_uang, jml_kembali, diskon, administrasi, tgl_transaksi)
	 VALUES('$kode', '$total_penjualan', '$jml_uang', '$jml_kembali', '$diskon', '$administrasi', '$tgl_transaksi')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	$status_bayar = @mysqli_real_escape_string($conn, $_POST['status_bayar']);
	$query3 = "UPDATE tbl_daftarpasien SET status_bayar='$status_bayar' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query3) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>