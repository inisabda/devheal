<?php 
	session_start();
	include "../koneksi.php";
	$no_surat = @mysqli_real_escape_string($conn, $_POST['no_surat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
	$tgl_periksa = @mysqli_real_escape_string($conn, $_POST['tgl_periksa']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$lhr_pas = @mysqli_real_escape_string($conn, $_POST['lhr_pas']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
	$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
	$objektive = @mysqli_real_escape_string($conn, $_POST['objektive']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$nadi = @mysqli_real_escape_string($conn, $_POST['nadi']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);	
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);

	$query = "INSERT INTO tbl_suratsakit VALUES('', '$no_surat', '$no_daftar', '$nomor_rm', '$nama_pas', '$alm_pas', '$pekerjaan', '$tgl_periksa', '$tpt_lahir', '$lhr_pas', '$jk_pas', '$nm_dokter', '$assesment', '$objektive', '$tinggi_badan', '$tekanan_darah', '$berat_badan', '$temp', '$nadi', '$diagnosa', '$sip')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
