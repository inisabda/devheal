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

    $query_daft = mysqli_query($mysqli,"SELECT * from tbl_swab_antigen WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {
    $sip = $dat['sip'];
    $nama = $dat['nama_pas'];
    $keterangan =$dat['keterangan'];
    $no_surat =$dat['no_surat'];
    $dokter =$dat['nm_dokter'];
    $tgl_periksa =$dat['tgl_periksa'];
    $jk =$dat['jk_pas'];
    $lhr_pas =$dat['lhr_pas'];
    $nm_lab =$dat['nm_lab'];
    $pekerjaan =$dat['pekerjaan'];
    $berat_badan =$dat['berat_badan'];
    $tinggi_badan =$dat['tinggi_badan'];
    $tekanan_darah =$dat['tekanan_darah'];
    $temp =$dat['temp'];
    $nadi = $dat['nadi'];
    $hasil_lab = $dat['hasil_lab'];
    $alm_pas = $dat['alm_pas'];
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
                        Email : <?php echo $alamat_klinik; ?>  Telp : <?php echo $no_hp; ?></span>                  
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid;" colspan="3"></td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size:14px;font-weight:bold;text-decoration:underline;" colspan="3">SURAT KETERANGAN LABORATORIUM HASIL SWAB</td>
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
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="20%"><b>Nama Pasien</b></td>
                                    <td width="2%">:</td>
                                    <td><?php echo $nama; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Name Patient</td>
                                </tr>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td>:</td>
                                    <td><?php echo $alm_pas; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Address</td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Lahir</b></td>
                                    <td>:</td>
                                    <td><?php echo date('d-M-Y',strtotime($lhr_pas)); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Date of birth</td>
                                </tr>
                                <tr>
                                    <td><b>Jenis Kelamin</b></td>
                                    <td>:</td>
                                    <td><?php echo $jk; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Gender</td>
                                </tr>
                                <tr>
                                    <td><b>Pekerjaan</b></td>
                                    <td>:</td>
                                    <td><?php echo $pekerjaan; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Occupation</td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Sampling</b></td>
                                    <td>:</td>
                                    <td><?php echo date('d-M-Y', strtotime($tgl_periksa)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 10px; font-size:10px; font-style: italic; ">Collection date</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>    
        <table style="margin-left:30px; border-collapse: collapse; ">
            <tr>
                <th style="border: 1px solid black; text-align: center; background-color: Cyan;" width="163">Jenis Pemeriksaan</th>
                <th style="border: 1px solid black; text-align: center; background-color: Cyan;" width="163">Hasil Pemeriksaan</th>
                <th style="border: 1px solid black; text-align: center; background-color: Cyan;" width="163">Nilai Normal</th>
                <th style="border: 1px solid black; text-align: center; background-color: Cyan;" width="163">Keterangan</th>
            </tr>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding-left: 3px; font-style:italic;" width="163"><?php echo $nm_lab; ?></td>
                    <td style="border: 1px solid black; font-style:italic; text-align: center;" width="163"><?php echo $hasil_lab; ?></td>
                    <td style="border: 1px solid black; text-align: center;" width="163">Negative</td>
                    <td style="border: 1px solid black; padding-left: 3px; font-style:italic;" width="163"><?php echo $keterangan; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div style="margin-left:30px;" width="690">
            Kami ingin menginformasikan pasien tersebut diatas telah dilakukan swab <?php echo $nm_lab;?>.
            <br>Hasil pemeriksaan swab <?php echo $nm_lab;?> seperti desebutkan dalam tabel diatas (Merujuk kolom dengan nama Hasil Pemeriksaan).
            <br>Keterangan :
            <br>Hasil tersebut diatas hanya menggambarkan kondisi saat pengambilan spesimen, bila timbul gejala Klinis atau kontak dengan pasien terinfeksi setelah pemeriksaan silahkan hubungi Dokter atau Fasilitas kesehatan terdekat. Pemeriksaan ulang dapat diakukan berdasarkan rekomendasi Dokter.
            <br>Jika hasil pemeriksaan Positif, harap segera memeriksakan diri ke Dokter atau fasilitas layanan kesehatan terdekat.
            <hr>
        </div>
        <br>
        <div style="margin-left:30px;" width="690">
            We would like to inform you that the patient above has been swabbed <?php echo $nm_lab;?>.
            <br>Swab examination results from <?php echo $nm_lab;?> as mentioned in the table above from the result.
            <p>Note :
            <br>The above results only describe the conditions when taking the specimen, if clinical symptoms arise or contact with an infected patient after examination, please contact the doctor or nearest health facility. Re-examination can be carried out based on the doctor's recommendation.</p>
            <br>If the test results are positive, please immediately go to the doctor or the nearest health care facility.
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
                            if($dokter ==$dokter1){ ?>
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
$filename="Cetak_Surat_Swab.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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