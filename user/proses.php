<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "koneksi.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if ($_GET['act']=='off') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$no_daftar = $_GET['id'];
			$status  = "blokir";

			// perintah query untuk mengubah data pada tabel users
            $query = mysqli_query($mysqli, "UPDATE tbl_daftarpasien SET status  = '$status'
                                                          WHERE no_daftar = '$no_daftar'")
                                            or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location:../?page=datapendaftaran");
            }
		}
	}		
	
?>