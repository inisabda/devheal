<?php 
    $koneksi = mysqli_connect('localhost', 'root', '', 'penjualan_obat');
    $query_tampil = mysqli_query($koneksi, "SELECT * FROM tbl_icd10 ORDER BY id_icd ASC")  ;
    $rows = array();
    if (!empty($query_tampil)) {
       $no = + 1;
        while ($value = $query_tampil->fetch_array()) { 
            $nestedData['no'] = $no++;
            $nestedData['id_icd'] = $value['id_icd'];
            $nestedData['code'] = $value['code'];    
            $nestedData['diagnosa'] = $value['diagnosa'];
            $nestedData['deskripsi'] = $value['deskripsi'];
        $rows[] = $nestedData;
        }
        $no++;
    }
    echo json_encode($rows);
?>