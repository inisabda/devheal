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

$hari_ini = date("d-m-Y");
$no_daftar = @$_GET['no_daftar'];
$query_daft = mysqli_query($mysqli,"SELECT * from tbl_daftarpasien WHERE no_daftar ='$no_daftar' ");
while ($dat = mysqli_fetch_assoc($query_daft)) {
    $nama = $dat['nama_pas'];
    $nm_dokter = $dat['nm_dokter'];
    $alamat = $dat['alm_pas'];
    $rm = $dat['nomor_rm'];
    $diagnosa = $dat['diagnosa'];
    }

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <!-- <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
        <link rel="stylesheet" type="text/css" href="./isi/style_css/tanda_pembayaran.css" > -->
    </head>
    <body>
        <div style="font-size: 10px;" align="center">
        <b>Copy Resep Obat RACIKAN</b>
        </div>
        <hr>
        <div>
            <table style="font-size: 10px; line-height:1;" border="0">
                <tr>
                    <td>Nota No</td>
                    <td>:</td>
                    <td><?php echo $no_daftar; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $nama; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td width="180"><?php echo $alamat; ?></td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>:</td>
                    <td><?php echo $nm_dokter; ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php echo $hari_ini; ?></td>
                </tr>
            </table>
        </div>
        #=============================#
        <table style="font-size: 10px;" border="0">
            <thead>
                <tr>
                    <th style='padding-left:1px; font-size: 10px;' align='left' width='180'>Detail</th>
                    <th style='padding-left:5px; font-size: 10px;' align='left'>Jml</th>
                </tr>
            </thead>
            <tbody>
                <!-- Cetak Resep Racikan -->
                <?php              
                    $query = mysqli_query($mysqli, "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.total_penjualan, tbl_racikan.nama_racikan, tbl_racikan.akai, tbl_racikan.keterangan, tbl_racikan.jml_puyer, tbl_racikan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_racikandetail
                      LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                      LEFT JOIN tbl_dataobat ON tbl_racikandetail.kd_obat=tbl_dataobat.kd_obat
                    WHERE no_daftar ='$no_daftar' ");
                       $coun  = mysqli_num_rows($query);
                    // jika data ada
                    $totalObat = 0; 
                    if($coun == 0) {
                    echo "  <tr>
                                <td style='padding-left:1px; font-size: 10px;' align='left'></td>
                                <td style='padding-right:8px; font-size: 10px;' align='right'></td>
                            </tr>";
                        }
                    // jika data tidak ada
                    else {
                    // tampilkan data
                        while ($data = mysqli_fetch_assoc($query)) {
                            $keterangan = $data['keterangan'];
                            $aturan = $data['akai'];
                            $jumlah_puyer = $data['jml_puyer'];
                                
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                                <td style='padding-left:1px; font-size: 9px;' align='left' width='180'>$data[nm_obat]</td>
                                <td style='padding-left:1px; font-size: 10px;' align='center'>$data[jml_jual]</td>
                            </tr>";
                        }
                    }
                ?>                
            </tbody>
        </table>
        #=============================#
        <table>
            <tr>
                <td style="padding-left:1px; font-size: 10px;" align="left">Aturan Pakai</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 10px;" align="left"><?php echo $aturan; ?></td>
            </tr>
            <tr>
                <td style="padding-left:1px; font-size: 10px;" align="left">Jumlah</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 10px;" align="left"><?php echo $jumlah_puyer; ?> Bungkus</td>
            </tr>
            <tr>
                <td style="padding-left:1px; font-size: 10px;" align="left">Notice</td>
                <td>:</td>
                <td style="padding-left:1px; font-size: 10px;" align="left"><?php echo $keterangan; ?></td>
            </tr>
        </table>
    </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
</page>

<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="Copy_resep_racikan.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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