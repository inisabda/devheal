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
	$dr_tujuan = @mysqli_real_escape_string($conn, $_POST['dr_tujuan']);
	$rs_tujuan = @mysqli_real_escape_string($conn, $_POST['rs_tujuan']);
	$subjektive = @mysqli_real_escape_string($conn, $_POST['subjektive']);
	$objektive = @mysqli_real_escape_string($conn, $_POST['objektive']);
	$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
	$plan = @mysqli_real_escape_string($conn, $_POST['plan']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$nadi = @mysqli_real_escape_string($conn, $_POST['nadi']);
	$nafas = @mysqli_real_escape_string($conn, $_POST['nafas']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$kesadaran = @mysqli_real_escape_string($conn, $_POST['kesadaran']);
	$gcs = @mysqli_real_escape_string($conn, $_POST['gcs']);
	$saturasi = @mysqli_real_escape_string($conn, $_POST['saturasi']);
	$obat = @mysqli_real_escape_string($conn, $_POST['obat']);
	$tindakan = @mysqli_real_escape_string($conn, $_POST['tindakan']);
	$laborat = @mysqli_real_escape_string($conn, $_POST['laborat']);
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);
	$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
	$agama = @mysqli_real_escape_string($conn, $_POST['agama']);

	$query = "INSERT INTO tbl_rujuk VALUES('', '$no_surat', '$no_daftar', '$nomor_rm', '$nama_pas', '$pekerjaan', '$alm_pas', '$tgl_periksa', '$tpt_lahir', '$lhr_pas', '$jk_pas', '$nm_dokter', '$dr_tujuan', '$rs_tujuan', '$subjektive', '$objektive', '$assesment', '$plan', '$tinggi_badan', '$tekanan_darah', '$berat_badan', '$temp', '$nadi', '$nafas', '$kesadaran', '$gcs', '$saturasi', '$obat', '$tindakan', '$laborat', '$diagnosa', '$sip', '$nik', '$agama')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
