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
    
    $query_daft = mysqli_query($mysqli,"SELECT * from tbl_rujuk WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {
    $sip = $dat['sip'];
    $nama = $dat['nama_pas'];
    $alm_pas =$dat['alm_pas'];
    $dr_tujuan =$dat['dr_tujuan'];
    $rs_tujuan =$dat['rs_tujuan'];
    $no_surat =$dat['no_surat'];
    $dokter =$dat['nm_dokter'];
    $jk =$dat['jk_pas'];
    $lhr_pas =$dat['lhr_pas'];
    $subjektive =$dat['subjektive'];
    $objektive =$dat['objektive'];
    $assesment =$dat['assesment'];
    $plan =$dat['plan'];
    $diagnosa =$dat['diagnosa'];
    $pekerjaan =$dat['pekerjaan'];
    $obat =$dat['obat'];
    $tindakan =$dat['tindakan'];
    $laborat =$dat['laborat'];
    $berat_badan =$dat['berat_badan'];
    $tinggi_badan =$dat['tinggi_badan'];
    $tekanan_darah =$dat['tekanan_darah'];
    $temp =$dat['temp'];
    $nadi =$dat['nadi'];
    $nafas =$dat['nafas'];
    $saturasi =$dat['saturasi'];
    $gcs =$dat['gcs'];
    $kesadaran =$dat['kesadaran'];
    $nik =$dat['nik'];
    $agama =$dat['agama'];
    $tanggal_periksa = date("d-m-Y", strtotime($dat['tgl_periksa']));
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
                <td style="text-align:center;font-size:12px;" colspan="3">Nomor : <?php echo $no_surat; ?>    
                </td>                        
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
                <td width="222" style="padding-left:10px; text-align:left;font-size:12px;"><?php echo $dr_tujuan; ?></td>
            </tr>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:1px; text-align:left;font-size:12px;">di</td>                        
            </tr>
            <tr>
                <td width="440"></td>
                <td width="222" style="padding-left:10px; text-align:left;font-size:12px;"><?php echo $rs_tujuan; ?></td>
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
                <td  width="610"><b><?php echo $nama; ?></b></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><b><?php echo $nik; ?></b></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><b><?php echo $alm_pas; ?></b></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><b><?php echo $agama; ?></b></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td><b><?php echo date('d-M-Y',strtotime($lhr_pas)); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</b> - <?php echo $jk; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><b><?php echo $pekerjaan; ?></b></td>
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
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $subjektive; ?></td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Objektive</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $objektive; ?>, Kesadaran = <?php echo $kesadaran;?>, GCS = <?php echo $gcs;?>, TD = <?php echo $tekanan_darah;?> MmHg, BB = <?php echo $berat_badan;?> Kg, Suhu = <?php echo $temp;?> &#176;C, Nadi = <?php echo $nadi;?> x/mnt, RR = <?php echo $nafas;?> x/mnt, SpO2 = <?php echo $saturasi;?> %</td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Assesment</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $assesment; ?></td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Plan</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $plan; ?></td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Diagnosa sementara</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $diagnosa; ?></td>
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
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $obat; ?></td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Tindakan</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $tindakan; ?></td>
            </tr>
            <tr>
                <td style="padding-left:15px; font-size: 12px; font-style: italic;" width="50">Laborat</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 12px; font-style: italic;" width="590"><?php echo $laborat; ?></td>
            </tr>
        </tbody>
    </table><br>
    <div style="margin-left:30px;">
        Demikian surat rujukan ini dibuat untuk dipergunakan sebagaimana mestinya. Terima kasih.
    </div> 
    <br>               
    <table style="padding-right:30px;" border="0" align="right" width="100%">
        <tbody>
            <tr>
                <td style='padding-right:30px; font-size: 12px;' align='center'><?php echo $kab; ?>, <?php echo tgl_eng_to_ind($tanggal_periksa); ?>.
                    <br>
                    Dokter yang memeriksa
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
                    SIP : <?php echo $sip; ?>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->



<?php
$filename="Surat Rujukan.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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