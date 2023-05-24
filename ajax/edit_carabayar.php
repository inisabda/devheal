<?php 
	session_start();
	include "../koneksi.php";

	$id_carabayar = @mysqli_real_escape_string($conn, $_POST['id_carabayar']);
	$cara_bayar = @mysqli_real_escape_string($conn, $_POST['cara_bayar']);
	$status = @mysqli_real_escape_string($conn, $_POST['status']);
	$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$asuransi = @mysqli_real_escape_string($conn, $_POST['asuransi']);

	$query = "UPDATE cara_bayar SET cara_bayar='$cara_bayar', asuransi='$asuransi', alamat='$alamat', no_hp='$no_hp', status='$status' WHERE id_carabayar='$id_carabayar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>