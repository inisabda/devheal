<?php 
	session_start();
	include "../koneksi.php";

	$id_carabayar = @mysqli_real_escape_string($conn, $_POST['id_carabayar']);
	$cara_bayar = @mysqli_real_escape_string($conn, $_POST['cara_bayar']);
	$asuransi = @mysqli_real_escape_string($conn, $_POST['asuransi']);
	$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$status = @mysqli_real_escape_string($conn, $_POST['status']);
	
	$query = "INSERT INTO cara_bayar (id_carabayar, cara_bayar, asuransi, alamat, no_hp, status) VALUES('$id_carabayar', '$cara_bayar', '$asuransi', '$alamat', '$no_hp', '$status')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>