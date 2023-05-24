<?php 
	session_start();
	include "../koneksi.php";

	$id_akai = @mysqli_real_escape_string($conn, $_POST['id_akai']);
	$aturan_pakai = @mysqli_real_escape_string($conn, $_POST['aturan_pakai']);
	
	$query = "INSERT INTO tbl_akai (id_akai, aturan_pakai) VALUES('$id_akai', '$aturan_pakai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>