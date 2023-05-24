<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$total_penjualan = mysqli_real_escape_string($db1, $input["total_penjualan"]);
$jml_uang = mysqli_real_escape_string($db1, $input["jml_uang"]);
$jml_kembali = mysqli_real_escape_string($db1, $input["jml_kembali"]);
$no_daftar = mysqli_real_escape_string($db1, $input["no_daftar"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_transaksi SET total_penjualan=?, jml_uang=? WHERE no_daftar=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('iis', $total_penjualan,  $jml_uang,  $no_daftar);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_transaksi WHERE no_daftar=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('s', $no_daftar);
	$dewan1->execute();
}

echo json_encode($input);
?>