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
    $nomor = $dat['nomor_rm'];
    $carabayar =$dat['asuransi_pas'];
    $no_surat =$dat['no_surat'];
    $dokter =$dat['nm_dokter'];
    $jk =$dat['jk_pas'];
    $lhr_pas =$dat['lhr_pas'];
    $keperluan =$dat['keperluan'];
    $pekerjaan =$dat['pekerjaan'];
    $berat_badan =$dat['berat_badan'];
    $tinggi_badan =$dat['tinggi_badan'];
    $tekanan_darah =$dat['tekanan_darah'];
    $temp =$dat['temp'];
    $alm_pas =$dat['alm_pas'];
    $tgl_periksa =$dat['tgl_periksa'];
        $tanggal_lahir = new DateTime($dat['lhr_pas']);
        $sekarang = new DateTime("today");
        if ($tanggal_lahir > $sekarang) { 
            $thn = "0";
            $bln = "0";
            $tgl = "0";
        }
        $thn = $sekarang->diff($tanggal_lahir)->y;
        $bln = $sekarang->diff($tanggal_lahir)->m;
        $tgl = $sekarang->diff($tanggal_lahir)->d;
} 

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    
</head>
<body>
    <table border="0">
        <tbody>
            <tr >
                <td style="border: 1px solid black; text-align:center; width:15;">
                    <img src="../images/logoklinik.png" width="50">
                </td>
                <td style="border: 1px solid black; padding-left:4px; font-size:12px;text-align:left;" width="520">
                    <b><?php echo $nama_klinik; ?></b>
                    <br>
                    <span style="padding-right:8px; font-size:10px;text-align:left; border-bottom:solid 2px #ccc;" width="100%">
                    <?php echo $alamat_klinik; ?> - <?php echo $kab; ?>
                    <br> 
                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?> </span>                  
                </td>
            </tr>

            <tr height="60px">
                <td style="text-align:center;font-size:16px;font-weight:bold;" colspan="3">LEMBAR CATATAN MEDIS</td>
            </tr>
            
            <tr>
                <td style="text-align:center;font-size:16px;" colspan="3">Nomor RM : <b><?php echo $nomor; ?></b>  
                </td>                        
            </tr>

            <tr>
                <td style="text-align:justify;" colspan="3" width="725">            
                    <table>
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="2%">:</td>
                                <td><b><?php echo $nama; ?></b></td><td><span><b><?php echo $jk; ?></b></span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><b><?php echo $alm_pas; ?></b></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td><b><?php echo date('d-M-Y',strtotime($lhr_pas)); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</b></td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>:</td>
                                <td><b><?php echo $pekerjaan; ?></b></td>
                            </tr>
                            <tr>
                                <td>Cara Bayar</td>
                                <td>:</td>
                                <td><b><?php echo $carabayar; ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>

    </table>
    <br>
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:70;">
                        <b>Tanggal/jam</b></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:300;">
                        <b>Assesment/ Pemeriksaan</b></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:90;">
                        <b>Diagnosa</b></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:140;">
                        <b>Obat dan Therapy</b></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:85;">
                        <b>Nama dan TTD</b></td>
                </tr>
            </tbody>
            <tr >
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:70; height:830;" ></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:300; height:830;"></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:90; height:830;"></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:140; height:830;"></td>
                    <td style="border: 1px solid black; font-size:12px; text-align:left; width:85; height:830;"></td>
                </tr>
            <tbody>
            </tbody>
        </table>


</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->



<?php
$filename="Form_RM_Pasien.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif " >'.($content).'</page>';
// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>