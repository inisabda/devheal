<?php
    error_reporting(0);
    session_start();
    ob_start();

    // Panggil koneksi database.php untuk koneksi database
    require_once "../config/database.php";
    // panggil fungsi untuk format tanggal
    include "../config/fungsi_tanggal.php";
    include "../config/setting.php";

    $hari_ini = date("d-m-Y");
    // ambil data hasil submit dari form
    $asuransi      = $_GET['asuransi'];    
        $no    = 1;
        $query = mysqli_query($mysqli, "SELECT * FROM tbl_pasien_asuransi
        WHERE asuransi_pas ='$asuransi' ") 
        or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
        $count  = mysqli_num_rows($query);
        
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>DATA PASIEN ASURANSI</title>
        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <table border="0">
            <tbody> 
                <tr >
                    <td style="text-align:center; width:15;">
                        <img src="../images/logoklinik.png" width="50">
                    </td>
                    <td style="padding-left:4px; font-size:14px;text-align:left;" width="520">
                        <b><?php echo $nama_klinik; ?></b>
                        <br>
                        <span style="padding-left:4px; font-size:10px;text-align:left;"><?php echo $dokter1; ?> SIP : <?php echo $sip1; ?>
                        <br>
                        <?php echo $dokter2; ?> SIP : <?php echo $sip2; ?>
                        <br>
                        <br>
                        <?php echo $dokter3; ?> SIP : <?php echo $sip3; ?>
                        <br>
                        <br>
                        <?php echo $dokter4; ?> SIP : <?php echo $sip4; ?>
                        <br>
                        Email : <?php echo $email; ?> - <?php echo $no_hp; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div style="font-size:12px; font-weight: bold; text-align:center;">
            Data Pasien Asuransi <?php echo $asuransi; ?> <?php echo $nama_klinik; ?>
        </div><br>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">NAMA PASIEN</th>
                        <th height="20" align="center" valign="middle">ALAMAT</th>
                        <th height="20" align="center" valign="middle">JENIS KELAMIN</th>
                        <th height="20" align="center" valign="middle">NIK</th>
                        <th height="20" align="center" valign="middle">TEMPAT & TGL LAHIR</th>
                        <th height="20" align="center" valign="middle">PEKERJAAN</th>
                        <th height="20" align="center" valign="middle">JENIS ASURANSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // jika data ada
                        if($count == 0) {
                        echo "  <tr>
                                    <td style='padding-left:5px;' width='10' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='60' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='70' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='90' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'></td>
                                    <td style='padding-left:5px;' width='90' height='13' valign='middle'></td>
                            </tr>";
                        }
                        // jika data tidak ada
                        else {
                        // tampilkan data
                        while ($data    = mysqli_fetch_assoc($query)) {
                        $tanggal        = date('d-m-Y',strtotime($data['tanggal_lahir']));
                        // menampilkan isi tabel dari database ke tabel di aplikasi
                        echo "  <tr>
                                    <td style='padding-left:5px;' width='10' height='13' valign='middle'>$no</td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'>$data[nm_pasien]</td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'>$data[alamat_pas]</td>
                                    <td style='padding-left:5px;' width='60' height='13' valign='middle'>$data[jk_pas]</td>
                                    <td style='padding-left:5px;' width='70' height='13' valign='middle'>$data[no_ktp]</td>
                                    <td style='padding-left:5px;' width='90' height='13' valign='middle'>$data[tempat_lahir], $tanggal</td>
                                    <td style='padding-left:5px;' width='100' height='13' valign='middle'>$data[pekerjaan]</td>
                                    <td style='padding-left:5px;' width='90' height='13' valign='middle'>$data[asuransi_pas]</td>
                                </tr>";
                            $no++;
                                }
                            }
                    ?>	
                </tbody>
            </table>
            <div align='center' id="footer-tanggal">
                <?php echo $kab; ?>, <?php echo tgl_eng_to_ind("$hari_ini"); ?><br>
                Mengetahui
            </div>
            <div id="footer-jabatan">  
            </div>      
            <div align='center' id="footer-nama">
                <?php echo $_SESSION['nama_peg']; ?>
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="DATA PASIEN ASURANSI.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>