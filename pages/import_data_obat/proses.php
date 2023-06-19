<?php
	// Panggil Library Excel Reader
	include "../import_data_obat/excel_reader2.php";
	$koneksi = mysqli_connect($_SERVER["DB_HOST"],   $_SERVER["DB_USER"],$_SERVER["DB_PASSWORD"],$_SERVER["DB_NAME"]);

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
		$kd_obat = $data->val($i, 1);
	    $nm_obat = $data->val($i, 2);
	    $exp_obat = $data->val($i, 3);
	    $ktg_obat = $data->val($i, 4);
	    $bnt_obat = $data->val($i, 5);
	    $sat_obat = $data->val($i, 6);
	    $hrg_obat = $data->val($i, 7);
	    $hrgbeli_obat = $data->val($i, 8);
	    $stk_obat = $data->val($i, 9);
	    $minstk_obat = $data->val($i, 10);
	    $no_batch = $data->val($i, 11);
	    $supplier = $data->val($i, 12);

		//buat pengujian jika nama,alamat & telp tidak kosong
		if($nm_obat != "" && $exp_obat !="" && $ktg_obat != "" && $bnt_obat != "" && $hrg_obat!="" && $hrgbeli_obat!=""){

			//persiapkan insert data ke database
			mysqli_query($koneksi, "INSERT INTO tbl_dataobat VALUES ('$kd_obat', '$nm_obat', '$exp_obat', '$ktg_obat', '$bnt_obat', '$sat_obat', '$hrg_obat', '$hrgbeli_obat', '$stk_obat', '$minstk_obat', '$no_batch', '$supplier') ");
			mysqli_query($koneksi, "INSERT INTO tbl_stokexpobat VALUES ('','$kd_obat', '$exp_obat', '$stk_obat') ");
			$berhasil++;
		}
	}

	//hapus kembali file .xls yang di upload tadi
	unlink($_FILES['file']['name']);

	//alihkan halaman ke index.php
	echo "$berhasil";
	// echo "<script>window.alert('sukses import $berhasil data ...!')</script>";
	// echo "<script>window.location='".$_SERVER['HTTP_REFERER']."&berhasil=".$berhasil."'</script>";
?>