<?php 
	session_start();
	include "../koneksi.php";

	$status_obat = @mysqli_real_escape_string($conn, $_POST['status_obat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);	

	$query = "UPDATE tbl_daftarpasien SET status_obat='$status_obat' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>