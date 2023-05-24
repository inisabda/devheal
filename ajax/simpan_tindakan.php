<?php 
	include "../koneksi.php";
	session_start();

	$no_tindakan = $_POST['no_tindakan'];
	$tgl_tindakan = $_POST['tanggal_tindakan'];
	$no_daftar = $_POST['no_rawat'];
	$nm_dokter = $_POST['nm_dokter'];
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

	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_tdk = "INSERT INTO tbl_tindakan VALUES('$no_tindakan', '$tgl_tindakan','$nm_dokter', '$no_daftar', '$id_pegawai')";
	mysqli_query($conn, $query_tdk) or die ($conn->error);

		// $kd_obat = "tes";
		// $hrg_jual = 2000;
		// $jml_obat = 2;
		// $sat_jual = "Strip";
		// $subtotal = 4000;

		// $query_pjldtl = "INSERT INTO tbl_penjualandetail (no_penjualan, kd_obat, hrg_jual, jml_jual, sat_jual, subtotal) VALUES ('$no_penjualan', '$kd_obat', '$hrg_jual', '$jml_obat', '$sat_jual', '$subtotal')";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_kdtindakan']); $i++) {
		$kd_tindakan = $_POST['hidden_kdtindakan'][$i];
		$hrg_tindakan = $_POST['hidden_hrgtindakan'][$i];

		$query_pjldtl = "INSERT INTO tbl_tindakandetail (no_tindakan, kd_tindakan,  hrg_tindakan) VALUES('$no_tindakan', '$kd_tindakan',  '$hrg_tindakan')";
		mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	}
 ?>