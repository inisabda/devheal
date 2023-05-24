<?php 
	session_start();
	include "../koneksi.php";
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);

	$query = "UPDATE tbl_daftarpasien SET nama_pas='$nama_pas', jk_pas='$jk', tpt_lahir='$tpt_lahir', lhr_pas='$tgl_lahir', asuransi_pas='$asuransi_pas', no_hp='$no_hp', nomor_rm='$nomor_rm' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
