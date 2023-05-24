<?php 
	session_start();
	include "../koneksi.php";
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$no_diagnosa = @mysqli_real_escape_string($conn, $_POST['no_diagnosa']);
	$subjektive = @mysqli_real_escape_string($conn, $_POST['subjektive']);
	$objektive = @mysqli_real_escape_string($conn, $_POST['objektive']);
	$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
	$plan = @mysqli_real_escape_string($conn, $_POST['plan']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$nadi = @mysqli_real_escape_string($conn, $_POST['nadi']);
	$rr = @mysqli_real_escape_string($conn, $_POST['rr']);
	$saturasi = @mysqli_real_escape_string($conn, $_POST['saturasi']);
	$butawarna = @mysqli_real_escape_string($conn, $_POST['butawarna']);
	$alergi = @mysqli_real_escape_string($conn, $_POST['alergi']);
	$alergi2 = @mysqli_real_escape_string($conn, $_POST['alergi']);

	$query = "UPDATE tbl_periksa SET subjektive='$subjektive', objektive='$objektive', assesment='$assesment', plan='$plan', berat_badan='$berat_badan', tinggi_badan='$tinggi_badan', temp='$temp', tekanan_darah='$tekanan_darah', nadi='$nadi', saturasi='$saturasi', rr='$rr', butawarna='$butawarna', alergi='$alergi2' WHERE no_diagnosa='$no_diagnosa'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	$query_alergi = "UPDATE tbl_daftarpasien SET alergi='$alergi' WHERE no_daftar='$no_daftar'";
	$sql_alergi = mysqli_query($conn, $query_alergi) or die ($conn->error);

	if($sql && $sql_alergi) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>