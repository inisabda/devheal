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
	$istirahat = @mysqli_real_escape_string($conn, $_POST['istirahat']);
	$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
	$mulai_tanggal = @mysqli_real_escape_string($conn, $_POST['mulai_tanggal']);
	$akhir_tanggal = @mysqli_real_escape_string($conn, $_POST['akhir_tanggal']);	
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$sip = @mysqli_real_escape_string($conn, $_POST['sip']);

	$query = "UPDATE tbl_suratijin SET no_daftar='$no_daftar', nomor_rm='$nomor_rm', nama_pas='$nama_pas', alm_pas='$alm_pas', tgl_periksa='$tgl_periksa', tpt_lahir='$tpt_lahir', lhr_pas='$lhr_pas', jk_pas='$jk_pas', nm_dokter='$nm_dokter', istirahat='$istirahat', pekerjaan='$pekerjaan', mulai_tanggal='$mulai_tanggal', akhir_tanggal='$akhir_tanggal', diagnosa='$diagnosa', sip='$sip' WHERE no_surat='$no_surat'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
