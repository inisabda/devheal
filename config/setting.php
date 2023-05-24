<?php
    $conn = new mysqli("localhost", "root", "", "klinik_project");
    $query_tampil = "SELECT * FROM tbl_setting ";
    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
    while($data = mysqli_fetch_array($sql_tampil)){
    	$id_klinik = $data['id_klinik'];
        $nama_klinik = $data['nama_klinik'];
        $alamat_klinik = $data['alamat_klinik'];
        $kab = $data['kab'];
        $dokter1 = $data['dokter1'];
        $dokter2 = $data['dokter2'];
        $sip1 = $data['sip1'];
        $sip2 = $data['sip2'];
        $no_hp = $data['no_hp'];
        $email = $data['email'];
?>
<?php } ?>