<?php 
require __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

    $koneksi = mysqli_connect($_SERVER['DB_HOST'], $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_NAME']);
    $query_tampil = mysqli_query($koneksi, "SELECT * FROM tbl_daftarpasien where tgl_daftar = CURDATE() AND status_masuk='rawat' ORDER BY no_antrian DESC")  ;
    $rows = array();
    if (!empty($query_tampil)) {
        //$no = $start + 1;
        while ($value = $query_tampil->fetch_array()) {           
            $nestedData['no_antrian'] = $value['no_antrian'];
            $nestedData['no_daftar'] = $value['no_daftar'];
            $nestedData['tgl_daftar'] = $value['tgl_daftar'];
            $nestedData['nama_pas'] = $value['nama_pas'];
            $nestedData['nomor_rm'] = $value['nomor_rm'];
            $nestedData['status_obat'] = $value['status_obat'];
        $rows[] = $nestedData;
        }
    }
    echo json_encode($rows);
?>
