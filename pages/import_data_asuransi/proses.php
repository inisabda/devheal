<?php

	// Panggil Library Excel Reader
	include "../import_data_asuransi/excel_reader2.php";
	$koneksi = mysqli_connect("localhost", "root","","klinik_project");

	//upload file xls
	$target = basename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], $target);

	//beri permision agar file xls dapat dibaca
	chmod($_FILES['file']['name'], 0777);

	//mengambil isi file xls
	$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'], false);
	//menghitung jumlah baris data yang ada
	$jumlah_baris = $data->rowcount($sheet_index = 0);

	//Jumlah default data yang berhasil di import
	$berhasil = 0;
	for($i = 2; $i <= $jumlah_baris; $i++)
	{
		//menangkap data dan memasukkan ke variabel sesuai dengan kolomnya masing2
		$id_asuransi = $data->val($i, 1);
	    $no_ktp = $data->val($i, 2);
	    $nm_pasien = $data->val($i, 3);
	    $tempat_lahir = $data->val($i, 4);
	    $tanggal_lahir = $data->val($i, 5);
	    $jk_pas = $data->val($i, 6);
	    $agama = $data->val($i, 7);
	    $alamat_pas = $data->val($i, 8);
	    $asuransi_pas = $data->val($i, 9);
	    $pekerjaan = $data->val($i, 10);
	    $tgl_masuk = $data->val($i, 11);

		//buat pengujian jika nama,alamat & telp tidak kosong
		if($nm_pasien != "" && $alamat_pas != "" && $asuransi_pas != ""){
			//persiapkan insert data ke database
			mysqli_query($koneksi, "INSERT INTO tbl_pasien_asuransi VALUES ('', '$no_ktp', '$nm_pasien', '$tempat_lahir', '$tanggal_lahir', '$jk_pas', '$agama', '$alamat_pas', '$asuransi_pas', '$pekerjaan', '$tgl_masuk') ");
			$berhasil++;
		}
	}

	//hapus kembali file .xls yang di upload tadi
	unlink($_FILES['file']['name']);


	//alihkan halaman ke index.php
	echo "$berhasil";
	// echo "<script>window.alert('sukses import $berhasil data!')</script>";
	// echo "<script>window.location='".$_SERVER['HTTP_REFERER']."&berhasil=".$berhasil."'</script>";
?>