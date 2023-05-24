<?php 
    $koneksi = mysqli_connect('localhost', 'root', '', 'klinik_project');
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
