<?php 
	session_start();
	include "../koneksi.php";

	$kd_dokter = @mysqli_real_escape_string($conn, $_POST['kd_dokter']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$spesialisasi = @mysqli_real_escape_string($conn, $_POST['spesialisasi']);
	$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);
	$tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
	$tanggal_lahir = @mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);

	$query = "UPDATE dokter SET nm_dokter='$nm_dokter', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', no_telepon='$no_hp', spesialisasi='$spesialisasi', sip='$sip'  WHERE kd_dokter = '$kd_dokter'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>