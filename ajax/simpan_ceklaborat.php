<?php 
	include "../koneksi.php";
	session_start();

	$no_lab = $_POST['no_lab'];
	$tgl_lab = $_POST['tgl_lab'];
	$nm_dokter = $_POST['nm_dokter'];
	$no_daftar = $_POST['no_daftar'];
	$nama_pas = $_POST['nama_pas'];
	$nomor_rm = $_POST['nomor_rm'];


	$id_pegawai =  $_SESSION['id_peg'];
	$query_lab = "INSERT INTO tbl_lab VALUES('$no_lab', '$tgl_lab','$nm_dokter', '$no_daftar', '$nama_pas', '$nomor_rm', '$id_pegawai')";
	mysqli_query($conn, $query_lab) or die ($conn->error);

		
	for($i = 0; $i < count($_POST['hidden_kode_lab']); $i++) {
		$kode_lab = $_POST['hidden_kode_lab'][$i];
		$nm_lab = $_POST['hidden_nm_lab'][$i];
		$hrg_lab = $_POST['hidden_hrg_lab'][$i];
		$hasil_lab = $_POST['hidden_hasil_lab'][$i];

		$query_labdtl = "INSERT INTO tbl_labdetail (no_lab, kode_lab, nm_lab, hrg_lab, hasil_lab) VALUES('$no_lab', '$kode_lab', '$nm_lab', '$hrg_lab', '$hasil_lab')";
		mysqli_query($conn, $query_labdtl) or die ($conn->error);

	}
 ?>