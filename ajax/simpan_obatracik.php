<?php 
	include "../koneksi.php";
	session_start();

	$kd_racik = $_POST['kd_racik'];
	$tgl_racik = $_POST['tanggal_racik'];
	$akai = $_POST['akai'];
	$nama_racikan = $_POST['nama_racikan'];
	$stk_obat = $_POST['stk_obat'];
	$status = $_POST['status'];
	// $hari= substr($tgl_penjualan, 8, 2);
	// $bulan = substr($tgl_penjualan, 5, 2);
	// $tahun = substr($tgl_penjualan, 0, 4);
	// $tgl = $tahun.$bulan.$hari;
	// $carikode = mysqli_query($conn, "SELECT MAX(no_penjualan) FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_penjualan'") or die (mysql_error());
	// $datakode = mysqli_fetch_array($carikode);
	// if($datakode) {
 //        $nilaikode = substr($datakode[0], 13);
 //        $kode = (int) $nilaikode;
 //        $kode = $kode + 1;
 //        $no_penjualan = "PJL/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
 //    } else {
 //        $no_penjualan = "PJL/".$tgl."/01";
 //    }

	$tunai = $_POST['jml_uang'];
	$kembali = $_POST['jml_kembali'];
	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_pjl = "INSERT INTO tbl_nama_racikan VALUES('$kd_racik', '$tgl_racik','$nama_racikan','$stk_obat','$akai', '$total_penjualan', '$tunai', '$kembali', '$id_pegawai', '$status')";
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