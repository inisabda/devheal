<?php 
	session_start();
	include "../koneksi.php";

	$kode_lab = @mysqli_real_escape_string($conn, $_POST['kode_lab']);
	$nm_lab = @mysqli_real_escape_string($conn, $_POST['nm_lab']);
	$hrg_lab= @mysqli_real_escape_string($conn, $_POST['hrg_lab']);
	$nilai_normal= @mysqli_real_escape_string($conn, $_POST['nilai_normal']);
	
$query = "INSERT INTO laborat (kode_lab, nm_lab, hrg_lab, nilai_normal) VALUES('$kode_lab', '$nm_lab', '$hrg_lab', '$nilai_normal')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>