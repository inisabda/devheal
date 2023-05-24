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
        <table border="0">
            <tbody>
                <tr style="border-bottom:solid 3px #ccc;">
                    <td style="border-bottom:solid 2px #ccc; text-align:center;" width="10%">
                        <img src="../images/logoklinik.png" width="60">
                    </td>
                    <td style="padding-right:8px; font-size:14px;text-align:left; border-bottom:solid 2px #ccc;" width="100%">
                        <b><?php echo $nama_klinik; ?></b>
                        <br>
                        <span style="padding-right:8px; font-size:12px;text-align:left; border-bottom:solid 2px #ccc;" width="100%">
                        <?php echo $alamat_klinik; ?>
                        <br> 
                        Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?></span>                  
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size:12px;font-weight:bold;text-decoration:underline;" colspan="3">SURAT KETERANGAN DOKTER</td>
                </tr>            
                <tr>
                    <td style="padding-left:280px; text-align:left;font-size:12px;" colspan="3">Nomor : <?php echo $no_surat; ?>    
                    </td>                        
                </tr>
                <tr>
                    <td style="text-align:justify;" colspan="3" width="720">
                        <p>Yang bertanda tangan dibawah ini Dokter Pemeriksa <?php echo $dokter1; ?>, menerangkan bahwa :  </p>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="20%">Nama</td>
                                    <td width="2%">:</td>
                                    <td>...................................</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>...................................</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td>...................................</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>...................................</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>:</td>
                                    <td>...................................</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>Yang bersangkutan benar - benar <b>Sakit</b>, sehingga memerlukan istirahat selama ............(.......) hari, terhitung mulai tanggal
                        <br>.............................. s/d tanggal ..............................
                        <br>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya. Terima kasih.
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="0" align="right" width="100%">
            <tbody>
                <tr>
                    <td style='padding-right:30px; font-size: 12px;' align='left'><?php echo $kab; ?>, ........................</td>
                </tr>
                <tr>
                    <td style='padding-right:30px; font-size: 12px;' align='center'>Dokter yang memeriksa</td>
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
$filename="Form_Surat_Ijin_kosong.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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