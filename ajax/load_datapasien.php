<?php 
    $koneksi = mysqli_connect('localhost', 'root', '', 'klinik_project');
    $query_tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pasien")  ;
    $rows = array();
    if (!empty($query_tampil)) {
       $no = + 1;
        while ($value = $query_tampil->fetch_array()) { 
            $nestedData['no'] = $no++;
            $nestedData['id_pas'] = $value['id_pas'];     
            $nestedData['nomor_rm'] = $value['nomor_rm'];
            $nestedData['nama_pas'] = $value['nama_pas'];
            $nestedData['nik'] = $value['nik'];
            $nestedData['agama'] = $value['agama'];
            $nestedData['jk_pas'] = $value['jk_pas'];
            $nestedData['alm_pas'] = $value['alm_pas'];
            $nestedData['tpt_lahir'] = $value['tpt_lahir'];
            $nestedData['lhr_pas'] = date('d-m-Y', strtotime($value['lhr_pas']));
            $nestedData['pekerjaan'] = $value['pekerjaan'];
            $nestedData['no_hp'] = $value['no_hp'];
        $rows[] = $nestedData;
        }
        $no++;
    }
    echo json_encode($rows);
?>