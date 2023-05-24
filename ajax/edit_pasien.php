<?php 
	session_start();
	include "../koneksi.php";
	$id_pas = @mysqli_real_escape_string($conn, $_POST['id_pas']);
	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
	// $asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
	$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$alergi = @mysqli_real_escape_string($conn, $_POST['alergi']);
	$agama = @mysqli_real_escape_string($conn, $_POST['agama']);

	$query = "UPDATE tbl_pasien SET nama_pas='$nama_pas', nik='$nik', agama='$agama', jk_pas='$jk', tpt_lahir='$tpt_lahir', lhr_pas='$tgl_lahir', pekerjaan='$pekerjaan', no_hp='$no_hp', alm_pas='$alm_pas', nomor_rm='$nomor_rm', alergi='$alergi' WHERE id_pas = '$id_pas'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
