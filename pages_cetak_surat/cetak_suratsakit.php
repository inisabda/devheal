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
    
    $query_daft = mysqli_query($mysqli,"SELECT * from tbl_suratsakit WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {
    $sip = $dat['sip'];
    $nama = $dat['nama_pas'];
    $assesment =$dat['assesment'];
    $objektive =$dat['objektive'];
    $no_surat =$dat['no_surat'];
    $dokter =$dat['nm_dokter'];
    $jk =$dat['jk_pas'];
    $lhr_pas =$dat['lhr_pas'];
    $diagnosa =$dat['diagnosa'];
    $pekerjaan =$dat['pekerjaan'];
    $tekanan_darah =$dat['tekanan_darah'];
    $tinggi_badan =$dat['tinggi_badan'];
    $berat_badan =$dat['berat_badan'];
    $temp =$dat['temp'];
    $nadi =$dat['nadi'];
    $alm_pas =$dat['alm_pas'];
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
        <table style="margin-left:30px;">
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
                        Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?></span>                  
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;" colspan="3"></td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size:12px;font-weight:bold;text-decoration:underline;" colspan="3">SURAT KETERANGAN SAKIT</td>
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
                    <td style="text-align:justify;" width="690">
                        <p>Yang bertanda tangan dibawah ini Dokter Pemeriksa <?php echo $dokter; ?>, menerangkan bahwa :  </p>            
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="20%">Nama</td>
                                    <td width="2%">:</td>
                                    <td><b><?php echo $nama; ?></b></td>
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
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><b><?php echo $jk; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>:</td>
                                    <td><b><?php echo $pekerjaan; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>Yang bersangkutan benar - benar <b>Sakit</b> dengan diagnosa sementara <b><?php echo $diagnosa;?></b>, menurut hasil pemeriksaan pada tanggal <?php echo tgl_eng_to_ind($tanggal_periksa);?> dengan hasil <?php echo $assesment;?>, dan <?php echo $objektive;?>.                    
                        <br>Demikian surat keterangan sakit ini dibuat untuk dipergunakan sebagaimana mestinya. Terima kasih.
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="margin-left:30px;" border="0">
            <tbody>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='left'></td>
                    <td style='padding-right:8px; font-size: 10px;' align=''></td>
                    <td style='padding-right:8px; font-size: 10px;' width='25' align='left'></td>
                    <td style='padding-right:8px; font-size: 10px;' align='left'></td>
                    <td style='padding-right:8px; font-size: 10px;' width='270' align='center'></td>
                    <td style='font-size: 12px;' align='center'  width="240"><?php echo $kab; ?>, <?php echo tgl_eng_to_ind($tanggal_periksa); ?>.
                        <br>
                        Dokter yang memeriksa
                    </td>
                </tr>            
                <tr>
                    <td style='padding-right:8px; font-size: 12px;' align='left'>
                        BB
                        <br>TB
                        <br>TD
                        <br>Suhu
                        <br>Nadi
                    </td>
                        <td style='padding-right:8px; font-size: 12px;' align='center'>
                        =
                        <br>=
                        <br>=
                        <br>=
                        <br>=
                    </td>
                    <td style='padding-right:8px; font-size: 12px;' width='25' align='left'>
                        <?php echo $berat_badan; ?>
                        <br><?php echo $tinggi_badan; ?>
                        <br><?php echo $tekanan_darah; ?>
                        <br><?php echo $temp; ?>
                        <br><?php echo $nadi; ?>
                        <br><?php echo $butawarna; ?>
                    </td>
                    <td style='padding-right:8px; font-size: 12px;' align='left'>
                        Kg
                        <br>Cm
                        <br>MmHg
                        <br>&#176; C
                        <br>x/mnt
                    </td>
                    <td style='padding-right:8px; font-size: 10px;' width='270' align='center'></td>
                    <td style='padding-left:10px;' align='left'>                    
                        <?php
                            if($dokter ==$dokter1){ ?>
                                <img src='../qrcode/qr_misbah.jpg' width='73'>
                            <?php }else if($dokter == $dokter2){?>                       
                                <img src='../qrcode/qr_ovie.jpg' width='70'>
                            <?php }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='font-size: 12px;' width="242" align='center'>
                        <u><strong><?php echo $dokter; ?></strong></u><br>
                        SIP : <?php echo $sip; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
$filename="Surat Surat Keterangan Sakit.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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