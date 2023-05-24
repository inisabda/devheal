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
                    <td style="text-align:center;font-size:14px;font-weight:bold;" colspan="3">DATA RIWAYAT PEMERIKSAAN PASIEN</td>
                </tr>              
            </tbody>
        </table>
        <table style="margin-left:30px; font-size: 12px;" border="0" cellpadding="0">
            <tbody>
                <?php
                    $hari_ini = date("d-m-Y");
                    $no = 1;
                    $nomor_rm = @$_GET['no_daftar'];
                    
                    $query_riwayat = mysqli_query($mysqli,"SELECT * from tbl_daftarpasien WHERE nomor_rm ='$nomor_rm' ");
                    while ($data = mysqli_fetch_assoc($query_riwayat)) {
                        $no_daftar = $data['no_daftar'];
                        $nama = $data['nama_pas'];
                        $nomor_rm = $data['nomor_rm'];
                        $alm_pas = $data['alm_pas'];
                        $dokter = $data['nm_dokter'];
                        $tempat = $data['tpt_lahir'];
                        $tgl_lahir = date('d-m-Y',strtotime($data['lhr_pas']));
                        $tgl_periksa =date('d-m-Y / H:i:s', strtotime($data['tgl_periksa']));
                    }
                ?>
                <tr>
                    <td><b>Nomor RM</b></td>
                    <td>=</td>
                    <td><?php echo $nomor_rm; ?></td>
                </tr>
                <tr>
                    <td><b>Nama Pasien</b></td>
                    <td>=</td>
                    <td><?php echo $nama; ?></td>
                </tr>
                <tr>
                    <td><b>Alamat</b></td>
                    <td>=</td>
                    <td><?php echo $alm_pas; ?></td>
                </tr>
                <tr>
                    <td><b>TTL</b></td>
                    <td>=</td>
                    <td><?php echo $tempat; ?>, <?php echo $tgl_lahir; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="margin-left:30px;" width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead>
                <tr style="font-size: 14px; font-weight: bold; color: #000; background-color: #CCC;">
                    <th height="20" width="30" align="center" valign="middle">No</th>
                    <th height="20" width="140" align="center" valign="middle">No Registrasi</th>
                    <th height="20" width="180" align="center" valign="middle">Tgl Periksa</th>
                    <th height="20" width="350" align="center" valign="middle">Diagnosa</th>
                </tr>
            </thead>
            <?php
                $no = 1;
                $nomor_rm = @$_GET['no_daftar'];
                
                $query_riwayat = mysqli_query($mysqli,"SELECT * from tbl_periksa WHERE nomor_rm ='$nomor_rm' ");
                
            ?>
            <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($query_riwayat)) {
                    $no_daftar = $data['no_daftar'];
                    $tgl_periksa = date('d-m-Y / H:i:s', strtotime($data['tgl_periksa']));
                    $diagnosa = $data['diagnosa'];
                ?>
                <tr style="font-size: 12px;">
                    <td style="padding-left: 4px;"><?php echo $no++."."; ?></td>
                    <td style="padding-left: 4px;"><?php echo $no_daftar; ?></td>
                    <td style="padding-left: 4px;"><?php echo $tgl_periksa; ?> WIB</td>
                    <!-- <td style="padding-left: 4px;"><?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?></td> -->
                    <td style="padding-left: 4px;"><?php echo $diagnosa; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table><br>
        <table style="padding-right:30px;" border="0" align="right" width="100%">
            <tbody>
                <tr>
                    <td style='padding-right:30px; font-size: 12px;' align='center'><?php echo $kab; ?>, <?php echo tgl_eng_to_ind($hari_ini); ?>.
                        <br>
                        Mengetahui Dokter Klinik
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:1px;" align="left">
                        <?php
                            if($dokter == $dokter1){ ?>
                                <img src="../qrcode/qr_misbah.jpg" width="73">
                              <?php }else if($dokter == $dokter2){?>                       
                                <img src="../qrcode/qr_ovie.jpg" width="70">
                              <?php }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style='padding-right:1px; font-size: 12px;' align='center'>
                        <u><strong><?php echo $dokter; ?></strong></u><br>
                        <!-- SIP : <?php echo $sip; ?> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
$filename="cetak_riwayat_pasien.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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