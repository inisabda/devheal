<?php 
	session_start();
	include "../koneksi.php";

	$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$no_ktp = @mysqli_real_escape_string($conn, $_POST['no_ktp']);
	$nm_pasien = @mysqli_real_escape_string($conn, $_POST['nm_pasien']);
	$tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$alamat_pas = @mysqli_real_escape_string($conn, $_POST['alamat_pas']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$agama = @mysqli_real_escape_string($conn, $_POST['agama']);
	$tgl_masuk = date('Y-m-d');
	
	
$query = "INSERT INTO tbl_pasien_asuransi (id_asuransi, no_ktp, nm_pasien, tempat_lahir, tanggal_lahir, jk_pas, agama, alamat_pas, asuransi_pas, pekerjaan, tgl_masuk) VALUES('$kode','$no_ktp', '$nm_pasien', '$tempat_lahir', '$tgl_lahir', '$jk_pas', '$agama', '$alamat_pas', '$asuransi_pas', '$pekerjaan', '$tgl_masuk')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>