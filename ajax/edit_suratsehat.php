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
	$keperluan = @mysqli_real_escape_string($conn, $_POST['keperluan']);
	$kesimpulan = @mysqli_real_escape_string($conn, $_POST['kesimpulan']);
	$butawarna = @mysqli_real_escape_string($conn, $_POST['butawarna']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);
	$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
	$agama = @mysqli_real_escape_string($conn, $_POST['agama']);

	$query = "UPDATE tbl_suratsehat SET no_daftar='$no_daftar', nomor_rm='$nomor_rm', nama_pas='$nama_pas', pekerjaan='$pekerjaan', alm_pas='$alm_pas', tgl_periksa='$tgl_periksa', tpt_lahir='$tpt_lahir', lhr_pas='$lhr_pas', jk_pas='$jk_pas', nm_dokter='$nm_dokter', berat_badan='$berat_badan', tinggi_badan='$tinggi_badan', nadi='$nadi', tekanan_darah='$tekanan_darah', temp='$temp', keperluan='$keperluan', kesimpulan='$kesimpulan', butawarna='$butawarna', sip='$sip', nik='$nik', agama='$agama' WHERE no_surat='$no_surat' ";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
