<?php 
	session_start();
	include "../koneksi.php";

	$id_faskes = @mysqli_real_escape_string($conn, $_POST['id_faskes']);
	$nama_faskes = @mysqli_real_escape_string($conn, $_POST['nama_faskes']);
	$alamat_faskes = @mysqli_real_escape_string($conn, $_POST['alamat_faskes']);
	
	$query = "UPDATE tbl_faskes SET nama_faskes ='$nama_faskes', alamat_faskes ='$alamat_faskes' WHERE id_faskes = '$id_faskes'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>