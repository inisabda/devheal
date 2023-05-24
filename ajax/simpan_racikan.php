<?php 
	include "../koneksi.php";
	session_start();

	$no_pengobatan = $_POST['no_pengobatan'];
	$tgl_pengobatan = $_POST['tanggal_pengobatan'];
	$no_daftar = $_POST['no_daftar'];
	$akai = $_POST['akai'];
	$nama_pas = $_POST['nama_pas'];
	$nomor_rm = $_POST['nomor_rm'];
	$nama_racikan = $_POST['nama_racikan'];
	$jml_puyer = $_POST['jml_puyer'];
	$keterangan = $_POST['keterangan'];
	$tunai = $_POST['jml_uang'];
	$kembali = $_POST['jml_kembali'];
	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_pjl = "INSERT INTO tbl_racikan VALUES('$no_pengobatan', '$tgl_pengobatan','$no_daftar','$nama_pas','$nomor_rm', '$nama_racikan', '$akai', '$jml_puyer', '$keterangan', '$total_penjualan', '$id_pegawai')";
	mysqli_query($conn, $query_pjl) or die ($conn->error);

		// $kd_obat = "tes";
		// $hrg_jual = 2000;
		// $jml_obat = 2;
		// $sat_jual = "Strip";
		// $subtotal = 4000;

		// $query_pjldtl = "INSERT INTO tbl_penjualandetail (no_penjualan, kd_obat, hrg_jual, jml_jual, sat_jual, subtotal) VALUES ('$no_penjualan', '$kd_obat', '$hrg_jual', '$jml_obat', '$sat_jual', '$subtotal')";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_kdobat']); $i++) {
		$kd_obat = $_POST['hidden_kdobat'][$i];
		$hrg_jual = $_POST['hidden_hrgobat'][$i];
		$jml_obat = $_POST['hidden_jmlobat'][$i];
		$sat_jual = $_POST['hidden_satobat'][$i];
		$subtotal = $_POST['hidden_subtotal'][$i];
		$exp_obat = $_POST['hidden_expobat'][$i];
		$akai = $_POST['hidden_akai'][$i];

		$query_rckdtl = "INSERT INTO tbl_racikandetail (no_pengobatan, kd_obat,  hrg_jual, jml_jual, sat_jual, subtotal, akai) VALUES('$no_pengobatan', '$kd_obat', '$hrg_jual', '$jml_obat', '$sat_jual', '$subtotal', '$akai')";
		mysqli_query($conn, $query_rckdtl) or die ($conn->error);

		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$kd_obat'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama - $jml_obat;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$kd_obat'";
		mysqli_query($conn, $query_estok) or die ($conn->error);

		$query_stokexp = "SELECT stok FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat' AND tgl_exp = '$exp_obat'";
		$sql_stokexp = mysqli_query($conn, $query_stokexp) or die ($conn->error);
		$data_stokexp = mysqli_fetch_array($sql_stokexp);
		$stok_lamaexp = $data_stokexp['stok'];
		$stok_baruexp = $stok_lamaexp - $jml_obat;
		$query_estokexp = "UPDATE tbl_stokexpobat SET stok='$stok_baruexp' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
		mysqli_query($conn, $query_estokexp) or die ($conn->error);
	}
 ?>