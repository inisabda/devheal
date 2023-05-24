<?php 
	session_start();
	include "../koneksi.php";
	$no_surat = @mysqli_real_escape_string($conn, $_POST['no_surat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
	$tgl_periksa = @mysqli_real_escape_string($conn, $_POST['tgl_periksa']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$lhr_pas = @mysqli_real_escape_string($conn, $_POST['lhr_pas']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);	
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$nadi = @mysqli_real_escape_string($conn, $_POST['nadi']);	
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$keterangan = @mysqli_real_escape_string($conn, $_POST['keterangan']);
	$hasil_lab = @mysqli_real_escape_string($conn, $_POST['hasil_lab']);
	$nm_lab = @mysqli_real_escape_string($conn, $_POST['nm_lab']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);

	$query = "INSERT INTO tbl_swab_antigen VALUES('', '$no_surat', '$no_daftar', '$nomor_rm', '$nama_pas', '$pekerjaan', '$alm_pas', '$tgl_periksa', '$tpt_lahir', '$lhr_pas', '$jk_pas', '$nm_dokter', '$berat_badan', '$tinggi_badan', '$tekanan_darah', '$nadi', '$temp', '$keterangan', '$hasil_lab', '$nm_lab', '$sip')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
