<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../koneksi.php";

if(isset($_POST['dataidobat'])) {
	$kode_obat = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel obat
$query = "SELECT kode_obat,nama_obat,satuan,stok FROM is_obat WHERE kode_obat='$kode_obat'";
      $sql_tampil = mysqli_query($conn, $query) or die ($conn->error);
      while($data = mysqli_fetch_assoc($sql_tampil)) {

  $stok   = $data['stok'];
  $satuan = $data['satuan'];

			
}
}
?> 
