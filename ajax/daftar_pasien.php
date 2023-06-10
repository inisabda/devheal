<?php
session_start();
include "../koneksi.php";
// var_dump($_POST); die;

$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
$alergi = @mysqli_real_escape_string($conn, $_POST['alergi']);
$agama = @mysqli_real_escape_string($conn, $_POST['agama']);

$desa = @mysqli_real_escape_string($conn, $_POST['desa']);
$kec = @mysqli_real_escape_string($conn, $_POST['kec']);
$kab_kota = @mysqli_real_escape_string($conn, $_POST['kab_kota']);
$provinsi = @mysqli_real_escape_string($conn, $_POST['provinsi']);
$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
$tgl_daftar = @mysqli_real_escape_string($conn, $_POST['tgl_daftar']);
$tgl_periksa = @mysqli_real_escape_string($conn, $_POST['tgl_periksa']);
$id_pas = @mysqli_real_escape_string($conn, $_POST['id_pas']);
$nomor_antri = @mysqli_real_escape_string($conn, $_POST['nomor_antri']);
$status_masuk = @mysqli_real_escape_string($conn, $_POST['status_masuk']);
$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
$cara_masuk = @mysqli_real_escape_string($conn, $_POST['cara_masuk']);
$status_rawat = @mysqli_real_escape_string($conn, $_POST['status_rawat']);
$status_bayar = @mysqli_real_escape_string($conn, $_POST['status_bayar']);
$status_obat = @mysqli_real_escape_string($conn, $_POST['status_obat']);
$tekanan_darah_sistole = @mysqli_real_escape_string($conn, $_POST['tekanan_darah_sistole']);
$tekanan_darah_diastole = @mysqli_real_escape_string($conn, $_POST['tekanan_darah_diastole']);
$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
$kd_poli = @mysqli_real_escape_string($conn, $_POST['kd_poli']);
$keluhan = @mysqli_real_escape_string($conn, $_POST['keluhan']);
// $temp = @mysqli_real_escape_string($conn, $_POST['temp']);
$frekwensi_nafas = @mysqli_real_escape_string($conn, $_POST['frekwensi_nafas']);
$lingkar_perut = @mysqli_real_escape_string($conn, $_POST['lingkar_perut']);
$heart_rate = @mysqli_real_escape_string($conn, $_POST['heart_rate']);
$kd_tkp = @mysqli_real_escape_string($conn, $_POST['kd_tkp']);
$no_asuransi =  @mysqli_real_escape_string($conn, $_POST['no_asuransi']);
$kd_provider_peserta = @mysqli_real_escape_string($conn, $_POST['kd_provider_peserta']);
$kunj_sakit = @mysqli_real_escape_string($conn, $_POST['kunj_sakit']);
$rujuk_balik = @mysqli_real_escape_string($conn, $_POST['rujuk_balik']);


// $kd_provider_peserta = "11011201";

// var_dump($tekanan_darah_diastole); die();
// $tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
//$subjektif = @mysqli_real_escape_string($conn, $_POST['subjektif']);
//$objektif = @mysqli_real_escape_string($conn, $_POST['objektif']);
//$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
//$plan = @mysqli_real_escape_string($conn, $_POST['plan']);

$id_pegawai =  $_SESSION['id_peg'];
try {

	$conn->begin_transaction();
	//code...
	$now = date('Y-m-d');
	$query = "INSERT INTO tbl_daftarpasien VALUES('$no_daftar', '$tgl_daftar', '$tgl_periksa', '$nama_pas', '$nik', '$agama', '$jk', '$tpt_lahir', '$tgl_lahir', '$asuransi_pas', '$pekerjaan', '$alergi', '$no_hp', '$alm_pas','$nomor_rm', '$nm_dokter', '$nomor_antri', '$status_masuk', '$cara_masuk', '$desa','$kec', '$kab_kota', '$provinsi', '$status_rawat', '$status_bayar', '$status_obat','$id_pas', '$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die($conn->error);

	$query_antrian = "INSERT INTO tbl_antrian (no_daftar,tanggal,no_antrian,nama_pas,nomor_rm) VALUES ('$no_daftar', '$tgl_daftar', '$nomor_antri','$nama_pas', '$nomor_rm')";
	$sql_antrian = mysqli_query($conn, $query_antrian) or die($conn->error);


	//bridiging 
	$data = [
		"kdProviderPeserta" => $kd_provider_peserta,
		"tglDaftar" => date("d-m-Y"),
		"noKartu" => $no_asuransi,
		"kdPoli" => $kd_poli,
		"keluhan" => $keluhan,
		"kunjSakit" => true,
		"sistole" => (int) $tekanan_darah_sistole,
		"diastole" => (int) $tekanan_darah_diastole,
		"beratBadan" => (int) $berat_badan,
		"tinggiBadan" => (int) $tinggi_badan,
		"respRate" => (int) $frekwensi_nafas,
		"lingkarPerut" => (int) $lingkar_perut,
		"heartRate" => (int) $heart_rate, 
		"rujukBalik" => 0,
		"kdTkp" => $kd_tkp,
	];
	// var_dump($data); die;
	if ($sql && $sql_antrian) {
		// if(true) {
		// var_dump(json_encode($data)); die(); 
		$result = postRequestPcare("pcare/addPendaftaran", $data);
		if (is_string($result)) {
			$result = json_decode($result);
		}
		if($result != null){
			$no_urut_bpjs = $result->response->message;
		}else{
			$no_urut_bpjs = '';
		}
		// else{
		// 	 (object) $result->response->message = "";
		// }
		
		$query_pcare = "INSERT INTO pendaftaran_pcare (tgl_daftar,no_daftar,sistole,diastole,berat_badan,tinggi_badan,heart_rate,resp_rate,kd_poli,keluhan,kunj_sakit,no_kartu,lingkar_perut,rujuk_balik,kd_tkp,no_urut,created_at) VALUES (
		'$tgl_daftar','$no_daftar','$tekanan_darah_sistole','$tekanan_darah_diastole','$berat_badan','$tinggi_badan','$heart_rate','$frekwensi_nafas','$kd_poli','$keluhan','$kunj_sakit','$no_asuransi','$lingkar_perut','$rujuk_balik','$kd_tkp','$no_urut_bpjs','$now')";
		$sql_antrian = mysqli_query($conn, $query_pcare) or die($conn->error);

		
		if($result!= null){
			if($result->metaData->code == 412 ||$result->metaData->code == 401){
				echo json_encode(["status" => "gagal", "res" => $result]);
				$conn->rollback();
				return;
			}
		}
		echo json_encode(["status" => "berhasil", "res" => $result]);
		// echo "berhasil";
	} else {
		if($result!= null){
			if($result->metaData->code == 412 || $result->metaData->code == 401){
				echo json_encode(["status" => "gagal", "res" => $result]);
				$conn->rollback();
			}
		}
	}
	$conn->commit();
} catch (\Throwable $th) {
	//throw $th;
	$conn->rollback();
}
