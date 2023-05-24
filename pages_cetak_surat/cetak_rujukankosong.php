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
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
</head>
<body>
    <div style="margin-right:30px; font-style: italic; font-size: 8px;" align="right">
        (Document ini tercetak otomatis oleh ERM <?php echo $nama_klinik; ?>)
    </div>
    <table style="margin-left:30px; border-collapse: collapse; width: 100%;">
        <tbody>
            <tr>
                <td style="text-align:center;">
                    <img src="../images/logoklinik.png" width="60">
                </td>
                <td style="padding-left:8px; font-size:16px;text-align:left; width: 610;">
                    <b><?php echo $nama_klinik; ?></b>
                    <br>
                    <span style="padding-left:8px; font-size:12px;text-align:left;">
                    <?php echo $alamat_klinik; ?> - <?php echo $kab; ?>
                    <br> 
                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?> </span>                  
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid;" colspan="3"></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:12px;font-weight:bold;text-decoration:underline;" colspan="3">SURAT RUJUKAN PASIEN</td>
            </tr>            
            <tr>
                <td style="padding-left:250px; text-align:left;font-size:12px;" colspan="3">Nomor :</td>                        
            </tr>
        </tbody>
    </table>
    <table style="margin-left:30px;" border="0">
        <tbody>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:1px; text-align:left;font-size:12px;">Kepada Yth :</td>                        
            </tr>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:10px; text-align:left;font-size:12px;">...............................</td>
            </tr>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:1px; text-align:left;font-size:12px;">di</td>                        
            </tr>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:10px; text-align:left;font-size:12px;">...............................</td>
            </tr>
        </tbody>
    </table>
    <div style="margin-left:30px;">
        Dengan hormat, <br>
        Bersama ini kami mohon pemeriksaan lebih lanjut kepada klien ; 
    </div>
    <table style="margin-left:30px;" border="0">
        <tbody>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td  width="610">..............................................................</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>..............................................................</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td>..............................................................</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>..............................................................</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div style="margin-left:30px;">
        Pada saat pemeriksaan kami mendapatkan data:
    </div>
    <table style="margin-left:30px;" border="0">
        <tbody>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Subjektive</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Objektive</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Assesment</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Plan</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Diagnosa sementara</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
        </tbody>
    </table><br>
    <div style="margin-left:30px;">
    Therapy dan tindakan sementara yang telah diberikan :
    </div>
    <table style="margin-left:30px;" border="0">
        <tbody>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Therapy</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Tindakan</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Laborat</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590">..............................................................</td>
            </tr>
        </tbody>
    </table><br>
    <div style="margin-left:30px;">
        Demikian surat rujukan ini dibuat untuk dipergunakan sebagaimana mestinya. Terima kasih.
    </div>                
    <table border="0" align="right">
        <tbody>
            <tr>
                <td style='padding-right:30px; font-size: 12px;' align='center'><?php echo $kab; ?>, ................................................
                    <br>
                    Dokter yang memeriksa
                </td>
            </tr>
            
            <tr>
                <td style='padding-right:30px; font-size: 12px;' align='center'>
                    <p></p>
                    <p></p>
                    <u><strong><?php echo $dokter1; ?></strong></u><br>
                        SIP : <?php echo $sip1; ?>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="Rujukan Kosong.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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