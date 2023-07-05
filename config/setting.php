<?php
require __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
    $conn = new mysqli($_SERVER["DB_HOST"], $_SERVER["DB_USER"], $_SERVER["DB_PASSWORD"], $_SERVER["DB_NAME"]);
    $query_tampil = "SELECT * FROM tbl_setting ";
    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
    while($data = mysqli_fetch_array($sql_tampil)){
    	$id_klinik = $data['id_klinik'];
        $nama_klinik = $data['nama_klinik'];
        $alamat_klinik = $data['alamat_klinik'];
        $kab = $data['kab'];
        $dokter1 = $data['dokter1'];
        $dokter2 = $data['dokter2'];
        $dokter3 = $data['dokter3'];
        $dokter4 = $data['dokter4'];
        $sip1 = $data['sip1'];
        $sip2 = $data['sip2'];
        $sip3 = $data['sip3'];
        $sip4 = $data['sip4'];
        $no_hp = $data['no_hp'];
        $email = $data['email'];
?>
<?php } ?>