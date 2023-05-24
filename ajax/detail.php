<?php 
	include '../koneksi.php';

	if(@$_GET['page']=='penjualan') {
		$no_pjl = @mysqli_real_escape_string($conn, $_GET['no_pjl']);
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_penjualandetail.hrg_jual, tbl_penjualandetail.jml_jual, tbl_penjualandetail.sat_jual, tbl_penjualandetail.subtotal FROM tbl_penjualandetail INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_penjualandetail.no_penjualan = '$no_pjl'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}

	else if(@$_GET['page']=='pembelian') {
		$no_faktur = @mysqli_real_escape_string($conn, $_GET['no_faktur']);
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_pembeliandetail.hrg_beli, tbl_pembeliandetail.jml_beli, tbl_pembeliandetail.sat_beli, tbl_pembeliandetail.subtotal FROM tbl_pembeliandetail INNER JOIN tbl_dataobat ON tbl_pembeliandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_pembeliandetail.no_faktur = '$no_faktur'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}

/*
		$query_lihat = "SELECT * FROM tbl_nama_racikandetail INNER JOIN  tbl_nama_racikandetail ON tbl_nama_racikan.kd_racik = tbl_nama_racikandetail.kd_racik INNER JOIN  tbl_dataobat ON tbl_nama_racikandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_nama_racikan.kd_racik = '$kd_racik' ";*/
/*
            $query_tampil = "SELECT * FROM tbl_nama_racikan INNER JOIN  tbl_nama_racikandetail ON tbl_nama_racikan.kd_racik = tbl_nama_racikandetail.kd_racik INNER JOIN  tbl_dataobat ON tbl_nama_racikandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_nama_racikan.status = 'aktif' ORDER BY tbl_nama_racikan.nama_racikan ASC";*/
	else if(@$_GET['page']=='racikan') {
		$kd_racik = @mysqli_real_escape_string($conn, $_GET['kd_racik']);
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_nama_racikandetail.hrg_jual, tbl_nama_racikandetail.jumlah, tbl_nama_racikandetail.sat_jual, tbl_nama_racikandetail.subtotal FROM tbl_nama_racikandetail INNER JOIN tbl_dataobat ON tbl_nama_racikandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_nama_racikandetail.kd_racik = '$kd_racik'";

		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}

	else if(@$_GET['page']=='pelunasan_pembelian') {
		$no_faktur = @mysqli_real_escape_string($conn, $_POST['no_faktur']);
		// $no_faktur = "tesss";
		$tgl_lunas = date('Y-m-d');
		$query_lunas = "UPDATE tbl_pembelian SET status_byr = 'Lunas', tgl_lunas = '$tgl_lunas' WHERE no_faktur = '$no_faktur'";
		mysqli_query($conn, $query_lunas) or die ($conn->error);
	}

	else if(@$_GET['page']=='rawat') {
		$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
		// $no_faktur = "tesss";
/*		$tgl_daftar = date('Y-m-d');*/
		$query_daftar = "UPDATE tbl_daftarpasien SET status_masuk = 'rawat' WHERE no_daftar = '$no_daftar'";
		mysqli_query($conn, $query_daftar) or die ($conn->error);
	}

	else if(@$_GET['page']=='rawatranap') {
		$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
		// $no_faktur = "tesss";
		$tgl_daftar = date('Y-m-d');
		$query_daftar = "UPDATE tbl_daftarpasien SET status = 'rawat', tgl_daftar = '$tgl_daftar' WHERE no_daftar = '$no_daftar'";
		mysqli_query($conn, $query_daftar) or die ($conn->error);
	}


	else if(@$_GET['page']=='racik') {
		$kd_racik = @mysqli_real_escape_string($conn, $_POST['kd_racik']);
		// $no_faktur = "tesss";
		$tgl_daftar = date('Y-m-d');
		$query_racik = "UPDATE tbl_nama_racikan SET status = 'nonaktif' WHERE kd_racik = '$kd_racik'";
		mysqli_query($conn, $query_racik) or die ($conn->error);
	}


	else if(@$_GET['page']=='expstok_obat') {
		$kd_obat = @mysqli_real_escape_string($conn, $_GET['kd_obat']);
		$query_expstok = "SELECT * FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat'";
		$sql_expstok = mysqli_query($conn, $query_expstok) or die ($conn->error);
		$data_expstok = array();

		while($data = mysqli_fetch_array($sql_expstok)) {
			$data_expstok[] = $data;
		}

		echo json_encode($data_expstok);
	}

	else if(@$_GET['page']=='ttv') {
		$no_daftar = @mysqli_real_escape_string($conn, $_GET['no_daftar']);
		$query_lihat = "SELECT * FROM tbl_suratsehat WHERE no_daftar = '$no_daftar'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}
	else if(@$_GET['page']=='suratsakit') {
		$no_daftar = @mysqli_real_escape_string($conn, $_GET['no_daftar']);
		$query_lihat = "SELECT * FROM tbl_suratsakit WHERE no_daftar = '$no_daftar'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}
	else if(@$_GET['page']=='rujukan') {
		$no_daftar = @mysqli_real_escape_string($conn, $_GET['no_daftar']);
		$query_lihat = "SELECT * FROM tbl_rujuk WHERE no_daftar = '$no_daftar'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}
	else if(@$_GET['page']=='swab') {
		$no_daftar = @mysqli_real_escape_string($conn, $_GET['no_daftar']);
		$query_lihat = "SELECT * FROM tbl_swab_antigen WHERE no_daftar = '$no_daftar'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}

 ?>