<?php 
	session_start();
	include "../koneksi.php";

	$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
	$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
	$spesialisasi = @mysqli_real_escape_string($conn, $_POST['spesialisasi']);
	$tgl_input = @mysqli_real_escape_string($conn, $_POST['tgl_input']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);

	$query = "INSERT INTO dokter (kd_dokter, nm_dokter, jns_kelamin, tempat_lahir, tanggal_lahir, alamat, no_telepon, spesialisasi, sip, tgl_input) VALUES('$kode', '$nm_dokter', '$jk', '$tempat_lahir', '$tgl_lahir', '$alamat','$no_hp', '$spesialisasi', '$sip', '$tgl_input')";

	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>