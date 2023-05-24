<?php 
	include "../koneksi.php";
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	if(@$_GET['page']=='pegawai')
	{
		$query = "DELETE FROM tbl_pegawai WHERE id_peg = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='pasien')
	{
		$query = "DELETE FROM tbl_pasien WHERE id_pas = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);

		$query_periksa = "DELETE FROM tbl_periksa WHERE nomor_rm = '$id'";
		mysqli_query($conn, $query_periksa) or die ($conn->error);

		$query_antrian = "DELETE FROM tbl_antrian WHERE nomor_rm = '$id'";
		mysqli_query($conn, $query_antrian) or die ($conn->error);

		$query_lab = "DELETE FROM tbl_lab WHERE nomor_rm = '$id'";
		mysqli_query($conn, $query_lab) or die ($conn->error);		
	}
	
	if(@$_GET['page']=='data_tindakan')
	{
		$query = "DELETE FROM data_tindakan WHERE kd_tindakan = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='entry_tindakanpasien')
	{
		$query = "DELETE FROM tbl_tindakandetail WHERE no_tindakan = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='form_assesment')
	{
		$query = "DELETE FROM tbl_periksa WHERE no_diagnosa = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}
	if(@$_GET['page']=='antrian')
	{
		$query = "DELETE FROM tbl_antrian WHERE id = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='datapendaftaran')
	{
		$query = "DELETE FROM tbl_daftarpasien WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);

		$query_antrian = "DELETE FROM tbl_antrian WHERE no_daftar = '$id'";
		mysqli_query($conn, $query_antrian) or die ($conn->error);
	}

	if(@$_GET['page']=='datapendaftaranranap')
	{
		$query = "DELETE FROM tbl_daftarpasienranap WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='dataobat')
	{
		$query = "DELETE FROM tbl_dataobat WHERE kd_obat = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);

		$query_expstok = "DELETE FROM tbl_stokexpobat WHERE kd_obat = '$id'";
		mysqli_query($conn, $query_expstok) or die ($conn->error);
	}
	
	if(@$_GET['page']=='aturan_pakai')
	{
		$query = "DELETE FROM tbl_akai WHERE id_akai = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='supplier')
	{
		$query = "DELETE FROM tbl_supplier WHERE no_supp = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='dokter')
	{
		$query = "DELETE FROM dokter WHERE kd_dokter = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='datalaborat')
	{
		$query = "DELETE FROM laborat WHERE kode_lab = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

		if(@$_GET['page']=='entry_laborat')
	{
		$query = "DELETE FROM tbl_labdetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	/*if(@$_GET['page']=='pengobatan')
	{
		$query = "DELETE FROM tbl_pengobatandetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}*/

	if(@$_GET['page']=='pengobatanan')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$subtot = mysqli_real_escape_string($conn, $_POST['subtot']);

		$query_ksgstok = "UPDATE tbl_pengobatandetail SET jml_jual = '0', subtotal = '0' WHERE no = '$id' ";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);
		
		$query = "DELETE FROM tbl_pengobatandetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);

/*		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$id'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama + $stok;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$id'";
		mysqli_query($conn, $query_estok) or die ($conn->error);*/

		$query_estoki = "UPDATE tbl_stokexpobat SET stok='$stok_baru' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
		mysqli_query($conn, $query_estoki) or die ($conn->error);

	}
	
	if(@$_GET['page']=='editracikan')
	{
		$query = "DELETE FROM tbl_nama_racikandetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='entry_obatracik')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$subtot = mysqli_real_escape_string($conn, $_POST['subtot']);

		$query_ksgstok = "UPDATE tbl_racikandetail SET jml_jual = '0', subtotal = '0' WHERE no = '$id' ";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);
		
		$query = "DELETE FROM tbl_racikandetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);

		/*$query_stok = "SELECT stk_obat FROM tbl_nama_racikan WHERE kd_racik = '$kd_obat'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama + $jml_obat;
		$query_estok = "UPDATE tbl_nama_racikan SET stk_obat='$stok_baru' WHERE kd_racik='$kd_obat'";
		mysqli_query($conn, $query_estok) or die ($conn->error);


		$query_stokracik = "UPDATE tbl_nama_racikandetail SET stokini = stokini + ($jml_obat*jumlah) WHERE kd_racik='$kd_obat'";
		mysqli_query($conn, $query_stokracik) or die ($conn->error);*/

	}


	if(@$_GET['page']=='kosongkan_stok')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$query_ksgstok = "UPDATE tbl_stokexpobat SET stok = '0' WHERE kd_obat = '$id' AND tgl_exp = '$exp'";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);

		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$id'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama - $stok;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$id'";
		mysqli_query($conn, $query_estok) or die ($conn->error);
	}

	if(@$_GET['page']=='datapenjualan')
	{
		// $stok = mysqli_real_escape_string($conn, $_POST['stok']);

		$query_ksgstok = "UPDATE tbl_penjualandetail SET jml_jual = '0' WHERE no_penjualan = '$id' ";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);

		$query_pjl = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$id'";
		mysqli_query($conn, $query_pjl) or die ($conn->error);
		$query_pjlan = "DELETE FROM tbl_penjualandetail WHERE no_penjualan = '$id'";
		mysqli_query($conn, $query_pjlan) or die ($conn->error);
		
		$query_estoki = "UPDATE tbl_stokexpobat SET stok='$stok_baru' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
		mysqli_query($conn, $query_estoki) or die ($conn->error);
	}
	if(@$_GET['page']=='datapembelian')
	{
		// $query_pbldtl = "DELETE FROM tbl_pembeliandetail WHERE no_faktur = '$id'";
		// mysqli_query($conn, $query_pbldtl) or die ($conn->error);
		$query_pbl = "DELETE FROM tbl_pembelian WHERE no_faktur = '$id'";
		mysqli_query($conn, $query_pbl) or die ($conn->error);
	}
	if(@$_GET['page']=='riwayat_peramalan')
	{
		$query_peramalan = "DELETE FROM tbl_peramalan WHERE no_rml = '$id'";
		mysqli_query($conn, $query_peramalan) or die ($conn->error);
	}
	if(@$_GET['page']=='entry_laboratpasien')
	{
		// $query_pjldtl = "DELETE FROM tbl_penjualandetail WHERE no_penjualan = '$id'";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);
		$query_lab = "DELETE FROM tbl_labdetail WHERE no_lab = '$id'";
		mysqli_query($conn, $query_lab) or die ($conn->error);
	}

	if(@$_GET['page']=='data_pasien_asuransi')
	{
		// $query_pjldtl = "DELETE FROM tbl_penjualandetail WHERE no_penjualan = '$id'";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);
		$query_pasasur = "DELETE FROM tbl_pasien_asuransi WHERE id_asuransi = '$id'";
		mysqli_query($conn, $query_pasasur) or die ($conn->error);
	}

	if(@$_GET['page']=='suratijin')
	{
		$query_suratijin = "DELETE FROM tbl_suratijin WHERE no = '$id'";
		mysqli_query($conn, $query_suratijin) or die ($conn->error);
	}
	if(@$_GET['page']=='suratsehat')
	{
		$query_suratsehat = "DELETE FROM tbl_suratsehat WHERE no = '$id'";
		mysqli_query($conn, $query_suratsehat) or die ($conn->error);
	}
	if(@$_GET['page']=='suratsakit')
	{
		$query_suratsakit = "DELETE FROM tbl_suratsakit WHERE no = '$id'";
		mysqli_query($conn, $query_suratsakit) or die ($conn->error);
	}
	if(@$_GET['page']=='rujukan')
	{
		$query_rujuk = "DELETE FROM tbl_rujuk WHERE no = '$id'";
		mysqli_query($conn, $query_rujuk) or die ($conn->error);
	}
	if(@$_GET['page']=='swab')
	{
		$query_swab = "DELETE FROM tbl_swab_antigen WHERE no = '$id'";
		mysqli_query($conn, $query_swab) or die ($conn->error);
	}
	if(@$_GET['page']=='cara_bayar')
	{
		$query_caraBayar = "DELETE FROM cara_bayar WHERE id_carabayar = '$id'";
		mysqli_query($conn, $query_caraBayar) or die ($conn->error);
	}
	if(@$_GET['page']=='faskes')
	{
		$query_faskes = "DELETE FROM tbl_faskes WHERE id_faskes = '$id'";
		mysqli_query($conn, $query_faskes) or die ($conn->error);
	}
 ?>