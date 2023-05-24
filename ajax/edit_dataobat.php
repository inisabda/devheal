<?php 
	session_start();
	include "../koneksi.php";

	$kode = $_POST['ip_kdobat'];
	$nama = $_POST['ip_nmobat'];
	$nama = strtoupper($nama);
	$exp_obat = $_POST['ip_kadaluarsa'];
	$ktg = $_POST['ip_ktgobat'];
	$no_batch = $_POST['no_batch'];
	$nm_supplier = $_POST['nm_supplier'];

	$bentuk = $_POST['ip_bntobat'];
	$satuan = $_POST['ip_stobat'];
	$harga = $_POST['ip_hrgobat'];
	$harga_jual = $harga*1.20;
	$stok = 0;
	$min_stok = $_POST['ip_minstok'];

	$a_nmrstok = $_POST['ip_nmrstok'];
	$a_exp = $_POST['ip_kadaluarsa'];
	$a_stok = $_POST['ip_stok'];
	$jml_a = count($a_nmrstok);

	for($i=0; $i<$jml_a; $i++) {
		$nmr_stok = $a_nmrstok[$i];
		$exp_s = $a_exp[$i];
		$stok_s = $a_stok[$i];
		$stok = $stok + $stok_s;
		$query_stok = "UPDATE tbl_stokexpobat SET tgl_exp = '$exp_s', stok = '$stok_s' WHERE no_stok = '$nmr_stok'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
	}

	$query = "UPDATE tbl_dataobat SET nm_obat='$nama', exp_obat='$exp_s', ktg_obat='$ktg', sat_obat='$satuan', hrg_obat='$harga_jual', hrgbeli_obat='$harga', stk_obat='$stok', bnt_obat='$bentuk', minstk_obat='$min_stok', no_batch = '$no_batch', supplier = '$nm_supplier' WHERE kd_obat = '$kode'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	if($sql && $sql_stok) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>