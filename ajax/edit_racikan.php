<?php 
	session_start();
	include "../koneksi.php";
	
	$kd_racik = $_POST['kd_racik'];
	$tgl_racik = $_POST['tanggal_racik'];
	$akai = $_POST['akai'];
	$nama_racikan = $_POST['nama_racikan'];
	$stk_obat = $_POST['stk_obat'];
	$status = $_POST['status'];
	
	$tunai = $_POST['tunai'];
	$kembali = $_POST['kembali'];
	$total_penjualan = $_POST['hidden_totalpenjualan'];
	
	$id_peg =  $_SESSION['id_peg'];
	$query_pjl = "UPDATE tbl_nama_racikan SET tgl_racik='$tgl_racik', nama_racikan='$nama_racikan', stk_obat='$stk_obat', akai='$akai', total_penjualan='$total_penjualan', tunai='$tunai', kembali='$kembali', id_peg='$id_peg', status='$status' WHERE kd_racik='$kd_racik'";
	mysqli_query($conn, $query_pjl) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_kdobat']); $i++) {
		$kd_obat = $_POST['hidden_kdobat'][$i];
		$hrg_jual = $_POST['hidden_hrgobat'][$i];
		$jml_obat = $_POST['hidden_jmlobat'][$i];
		$sat_jual = $_POST['hidden_satobat'][$i];
		$subtotal = $_POST['hidden_subtotal'][$i];
		$exp_obat = $_POST['hidden_expobat'][$i];
				$akai = $_POST['hidden_akai'][$i];

		$query_pjldtl = "INSERT INTO tbl_nama_racikandetail (kd_racik, kd_obat,  hrg_jual, jumlah, sat_jual, akai, subtotal) VALUES('$kd_racik', '$kd_obat',  '$hrg_jual', '$jml_obat', '$sat_jual', '$akai','$subtotal')";
		mysqli_query($conn, $query_pjldtl) or die ($conn->error);


/*		$query_stok = "SELECT stk_obat FROM tbl_obatracik WHERE kd_obat = '$kd_obat'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama - $jml_obat;
		$query_estok = "UPDATE tbl_obatracik SET stk_obat='$stok_baru' WHERE kd_obat='$kd_obat'";
		mysqli_query($conn, $query_estok) or die ($conn->error);*/


/*$query_stokracik = "UPDATE tbl_nama_racikandetail SET stokini = stokini + ($jml_obat*jumlah) WHERE kd_racik='$kd_obat'";
mysqli_query($conn, $query_stokracik) or die ($conn->error);
*/

/*		$query_estok = "UPDATE tbl_racik SET stk_obat='$stok_baru' WHERE kd_racik='$kd_racik'";
		mysqli_query($conn, $query_estok) or die ($conn->error);
*/

/*		$query_stokexp = "SELECT stok FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat' AND tgl_exp = '$exp_obat'";
		$sql_stokexp = mysqli_query($conn, $query_stokexp) or die ($conn->error);
		$data_stokexp = mysqli_fetch_array($sql_stokexp);
		$stok_lamaexp = $data_stokexp['stok'];
		$stok_baruexp = $stok_lamaexp - $jml_obat;
		$query_estokexp = "UPDATE tbl_stokexpobat SET stok='$stok_baruexp' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
		mysqli_query($conn, $query_estokexp) or die ($conn->error);*/
	}
 ?>