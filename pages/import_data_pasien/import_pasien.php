<?php
  require('../../vendor/autoload.php');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$koneksi = mysqli_connect("localhost", "root", "Pass123", "klinik_project");

	if(isset($_FILES['file'])){
		$fileName = $_FILES['file']['name'];
		$file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

		$allowed_ext = ['xls', 'csv', 'xlsx'];

		if (in_array($file_ext, $allowed_ext)) {
			$inputFileNamePath = $_FILES['file']['tmp_name'];
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
			$worksheet = $spreadsheet->getActiveSheet()->toArray();
			
			$skipFirstRow = true;

			foreach ($worksheet as $row) {

				if ($skipFirstRow) {
					$skipFirstRow = false;
					continue; // Lewati iterasi untuk baris judul
				}

				$id_pas = $row['0'];
				$nama_pas = $row['1'];
				$jk_pas = $row['2'];
				$tpt_lahir = $row['3'];
				$lhr_pas = $row['4'];
				$pekerjaan = $row['5'];
				$alergi = $row['6'];
				$no_hp = $row['7'];
				$alm_pas = $row['8'];
				$nomor_rm = $row['9'];
				$nik = $row['10'];
				$agama = $row['11'];
				$desa = $row['12'];
				$kec = $row['13'];
				$kab_kota = $row['14'];
				$provinsi = $row['15'];
				$poscode = $row['16'];
				$msk_pas = $row['17'];
				$nomor_rma = $row['18'];

				if (empty($id_pas)) {
					continue;
				}

				$query = "INSERT INTO tbl_pasien (id_pas, nama_pas, jk_pas, tpt_lahir, lhr_pas, pekerjaan, alergi, no_hp, alm_pas, nomor_rm, nik, agama, desa, kec, kab_kota, provinsi, poscode, msk_pas, nomor_rma) VALUES ('$id_pas', '$nama_pas', '$jk_pas', '$tpt_lahir', '$lhr_pas', '$pekerjaan', '$alergi', '$no_hp', '$alm_pas', '$nomor_rm', '$nik', '$agama', '$desa', '$kec', '$kab_kota', '$provinsi', '$poscode', '$msk_pas', '$nomor_rma')";
				
				$result = mysqli_query($koneksi, $query);

				if (!$result) {
					$errorMessage = mysqli_error($koneksi);
					echo "Error: " . $errorMessage;
				} else {
					echo "Data inserted successfully.";
				}

			}
		}
	}
	