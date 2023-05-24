<?php
	// Panggil Library Excel Reader
	include "../import_data_pasien/excel_reader2.php";
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
		$id_pas = $data->val($i, 1);
	    $nama_pas = $data->val($i, 2);
	    $jk_pas = $data->val($i, 3);
	    $tpt_lahir = $data->val($i, 4);
	    $lhr_pas = $data->val($i, 5);
	    $pekerjaan = $data->val($i, 6);
	    $alergi = $data->val($i, 7);
	    $no_hp = $data->val($i, 8);
	    $alm_pas = $data->val($i, 9);
	    $nomor_rm = $data->val($i, 10);
	    $nik = $data->val($i, 11);
	    $agama = $data->val($i, 12);
	    $desa = $data->val($i, 13);
	    $kec = $data->val($i, 14);
	    $kab_kota = $data->val($i, 15);
	    $provinsi = $data->val($i, 16);
	    $poscode = $data->val($i, 17);
	    $msk_pas = $data->val($i, 18);
	    $nomor_rma = $data->val($i, 19);

		//buat pengujian jika nama,alamat & telp tidak kosong
		if($nama_pas != "" && $tpt_lahir != "" && $lhr_pas != ""){

			//persiapkan insert data ke database
			mysqli_query($koneksi, "INSERT INTO tbl_pasien VALUES ('$id_pas', '$nama_pas', '$jk_pas', '$tpt_lahir', '$lhr_pas', '$pekerjaan', '$alergi', '$no_hp', '$alm_pas', '$nomor_rm', '$nik', '$agama', '$desa', '$kec', '$kab_kota', '$provinsi', '$poscode', '$msk_pas', '$nomor_rma') ");
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