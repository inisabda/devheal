<?php 
	session_start();
	include "../koneksi.php";
	$no_diagnosa = @mysqli_real_escape_string($conn, $_POST['no_diagnosa']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_daftar = @mysqli_real_escape_string($conn, $_POST['tgl_daftar']);
	$tgl_periksa = @mysqli_real_escape_string($conn, $_POST['tgl_periksa']);
	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$code = @mysqli_real_escape_string($conn, $_POST['code']);
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$subjektive = @mysqli_real_escape_string($conn, $_POST['subjektive']);
	$objektive = @mysqli_real_escape_string($conn, $_POST['objektive']);
	$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
	$plan = @mysqli_real_escape_string($conn, $_POST['plan']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$nadi = @mysqli_real_escape_string($conn, $_POST['nadi']);
	$saturasi = @mysqli_real_escape_string($conn, $_POST['saturasi']);
	$rr = @mysqli_real_escape_string($conn, $_POST['rr']);
	$butawarna = @mysqli_real_escape_string($conn, $_POST['butawarna']);
	$alergi = @mysqli_real_escape_string($conn, $_POST['alergi']);

	$id_pegawai =  $_SESSION['id_peg'];

	$query = "INSERT INTO tbl_periksa VALUES('$no_diagnosa', '$no_daftar', '$tgl_daftar', '$tgl_periksa', '$nama_pas', '$nomor_rm', '$code', '$diagnosa', '$subjektive', '$objektive', '$assesment', '$plan', '$berat_badan', '$tinggi_badan', '$temp', '$tekanan_darah', '$nadi', '$saturasi', '$rr', '$butawarna', '$alergi', '$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	
	$status_rawat = @mysqli_real_escape_string($conn, $_POST['status_rawat']);
	$query2 = "UPDATE tbl_daftarpasien SET status_rawat='$status_rawat' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query2) or die ($conn->error);

	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
