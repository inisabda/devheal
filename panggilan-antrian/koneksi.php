<?php
// deklarasi parameter koneksi database
$host     = $_SERVER["DB_HOST"];              // server database, default “localhost” atau “127.0.0.1”
$username = $_SERVER["DB_USER"];                   // username database, default “root”
$password = "";                       // password database, default kosong
$database = $_SERVER["DB_NAME"];             // memilih database yang akan digunakan

// buat koneksi database
$mysqli = mysqli_connect($host, $username, $password, $database);

// cek koneksi
// jika koneksi gagal 
if (!$mysqli) {
  // tampilkan pesan gagal koneksi
  die('Koneksi Database Gagal : ' . mysqli_connect_error());
}
