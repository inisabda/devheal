<?php 
//$tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);
    // session_start();
    // include "../koneksi.php";
    // $nama_dokter = $_SESSION['nama_peg'];
    $koneksi = mysqli_connect('localhost', 'root', '', 'klinik_project');
    $query_tampil = mysqli_query($koneksi, "SELECT tbl_daftarpasien.*, tbl_daftarpasien.no_daftar, tbl_antrian.id, tbl_antrian.status, tbl_antrian.nama_pas FROM tbl_daftarpasien
    LEFT JOIN tbl_antrian ON tbl_daftarpasien.no_daftar=tbl_antrian.no_daftar
     WHERE tgl_daftar = CURDATE() AND status_masuk='rawat' AND nm_dokter = 'dr. Novi'")  ;
    $rows = array();
    if (!empty($query_tampil)) {
        //$no = $start + 1;
        while ($value = $query_tampil->fetch_array()) { 
            $nestedData['id'] = $value['id'];          
            $nestedData['no_antrian'] = $value['no_antrian'];
            $nestedData['no_daftar'] = $value['no_daftar'];
            $nestedData['tgl_daftar'] = date('d-m-Y', strtotime($value['tgl_daftar']));
            $nestedData['nama_pas'] = $value['nama_pas'];
            $nestedData['nomor_rm'] = $value['nomor_rm'];
            $nestedData['status'] = $value['status'];
            $nestedData['nm_dokter'] = $value['nm_dokter'];
            $nestedData['status_rawat'] = $value['status_rawat'];
        $rows[] = $nestedData;
        }
    }
    echo json_encode($rows);
?>