<?php 
	session_start();
	include "../koneksi.php";

	$id_asuransi = @mysqli_real_escape_string($conn, $_POST['id_asuransi']);
	$no_ktp = @mysqli_real_escape_string($conn, $_POST['no_ktp']);
	$nm_pasien = @mysqli_real_escape_string($conn, $_POST['nm_pasien']);
	$tempat_lahir = @mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
	$tanggal_lahir = @mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
	$alamat_pas = @mysqli_real_escape_string($conn, $_POST['alamat_pas']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$agama = @mysqli_real_escape_string($conn, $_POST['agama']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	
	$query = "UPDATE tbl_pasien_asuransi SET no_ktp='$no_ktp', nm_pasien='$nm_pasien', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk_pas='$jk_pas', agama='$agama', alamat_pas='$alamat_pas', asuransi_pas='$asuransi_pas', pekerjaan='$pekerjaan' WHERE id_asuransi ='$id_asuransi'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>