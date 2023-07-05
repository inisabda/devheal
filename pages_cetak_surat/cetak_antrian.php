<?php
error_reporting(0);// taruh disini ya  bagian atas sekali
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../config/fungsi_rupiah.php";
include "../config/setting.php";


    $hari_ini = date("d-m-Y");
    $no_daftar = @$_GET['no_daftar'];

    $query_daft = mysqli_query($mysqli,"SELECT * from tbl_daftarpasien WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {

    $nama = $dat['nama_pas'];
    $antrian =$dat['no_antrian'];
    $nomor_rm =$dat['nomor_rm'];
    $alm_pas =$dat['alm_pas'];
    $carabayar =$dat['asuransi_pas'];
    $tgl_periksa =date('d-m-Y / H:i', strtotime($dat['tgl_periksa']));
} 

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <div style="font-size: 12px; font-weight: bold;" align="center">
        <?php echo $nama_klinik; ?>
        </div>
        <div id="namadokter">
        <?php echo $dokter1; ?> : SIP <?php echo $sip1; ?>
        <br>
        <?php echo $dokter2; ?> : SIP <?php echo $sip2; ?>
        <br>
        <br>
        <?php echo $dokter3; ?> : SIP <?php echo $sip3; ?>
        <br>
        <br>
        <?php echo $dokter4; ?> : SIP <?php echo $sip4; ?>
        <br>
        <?php echo $alamat_klinik; ?> - <?php echo $no_hp; ?>
        </div>
        <hr>
        <div id="antrian" style="text-align: left; font-size: 10px;">
            <table class="data_pasien" border="0" cellpadding="0">
                <tr>
                    <td><b>Nomor Reg</b></td>
                    <td>=</td>
                    <td><?php echo $no_daftar; ?></td>
                </tr>
                <tr>
                    <td><b>Nama Pasien</b></td>
                    <td>=</td>
                    <td><?php echo $nama; ?></td>
                </tr>
                <tr>
                    <td><b>Nomor RM</b></td>
                    <td>=</td>
                    <td><?php echo $nomor_rm; ?></td>
                </tr>
                <tr>
                    <td><b>Alamat</b></td>
                    <td>=</td>
                    <td width="150"><?php echo $alm_pas; ?></td>
                </tr>
                <tr>
                    <td><b>Tgl Daftar</b></td>
                    <td>=</td>
                    <td><?php echo tgl_eng_to_ind($tgl_periksa); ?> Wib</td>
                </tr>
                <tr>
                    <td><b>Cara Bayar</b></td>
                    <td>=</td>
                    <td><?php echo $carabayar; ?></td>
                </tr>
            </table>
            <hr>
        </div>
        
        <div id="title">
        NOMOR ANTRIAN ANDA
        </div>
        <div id="nomorantrian">
        A - <?php echo $antrian; ?>
        </div>


        <div class="terimakasih">
            Budayakan Antri Untuk Kenyamanan Bersama

            <br>
            TERIMA KASIH, SEMOGA LEKAS SEMBUH
        </div>
    </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
$filename="antrian.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif " >'.($content).'</page>';
// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A7','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>