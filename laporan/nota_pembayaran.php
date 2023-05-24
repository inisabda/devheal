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
    $nm_dokter = $dat['nm_dokter'];
    $alamat = $dat['alm_pas'];
    $rm = $dat['nomor_rm'];
    $diagnosa = $dat['diagnosa'];
    }        
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
        <link rel="stylesheet" type="text/css" href="./isi/style_css/tanda_pembayaran.css" >
    </head>
    <body>
        <div class="page-content">
            <div class="page_header">
                (Lampiran Kwitansi Pembayaran <?php echo $nama_klinik; ?>)
            </div>
            <div class="data-apotek">
                <span class="nama_apotek" style="font-weight: bold;"><?php echo $nama_klinik; ?></span><br>
            </div>
            <div class="nama_dokter">
                <span style="padding-right:8px; font-size:10px;text-align:left; border-bottom:solid 2px #ccc;">
                <?php echo $alamat_klinik; ?> - <?php echo $kab; ?>
                <br> 
                Email : <?php echo $email; ?> Telp : <?php echo $no_hp; ?> </span>
            </div>                    
            <div style="border-bottom: 1px solid; margin: 5px 0;"></div>
            <div class="judul-surat">
                <span class="judul"><u>KWITANSI BUKTI PEMBAYARAN</u></span>
            </div>
            <div class="nomor-kwitansi">Nomor : <?php echo $no_daftar; ?></div>
            <div class="data-transaksi" style="line-height: 1.6; margin-bottom: 5px;">
                <?php 
                   $no_daftar = @$_GET['no_daftar'];
                    $query_daft = mysqli_query($mysqli,"SELECT * from tbl_periksa WHERE no_daftar ='$no_daftar' ");
                    while ($dat = mysqli_fetch_assoc($query_daft)) {
                    
                    $diagnosa = $dat['diagnosa'];
                    }
                ?>
                <table class="tr-titletelahditerima">
                    <tr>
                        <td>Telah diterima dari</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $alamat; ?></td>
                    </tr>
                    <tr>
                        <td>No. Rekam Medis</td>
                        <td>:</td>
                        <td><?php echo $rm; ?></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>:</td>
                        <td><?php echo $nm_dokter; ?></td>
                    </tr>
                    <tr>
                        <td>Diagnosa ICD-10</td>
                        <td>:</td>
                        <td><?php echo $diagnosa; ?></td>
                    </tr>
                </table>
            </div>
            <table class="data-item data-item-pembelian" align="center" border="0">
                <thead>
                    <tr>
                        <th class="col_detail" align="left">Jenis pembayaran</th>
                        <th class="col_nmobat" align="left">Nama Item</th>
                        <th class="col_jml" width="15">Qty</th>
                        <th colspan='2' class="col_hrg" width="50">Harga</th>
                        <th colspan='2' class="col_subt" width="50">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Transaksi Obat Non Racik -->
                <?php
                    $query = mysqli_query($mysqli,"SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_pengobatan.nama_pas, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
                    LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
                    LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat
                    WHERE no_daftar ='$no_daftar' ");
                    $count  = mysqli_num_rows($query);
                    // jika data ada
                    $totalBayar = 0; 
                    if($count == 0) {
                        echo "";
                    }
                    // jika data tidak ada
                    else {
                    // tampilkan data
                    while ($data = mysqli_fetch_assoc($query)) {
                            $nama       = $data['nama_pas'];
                            $subtotal = $data['subtotal'];
                            $totalBayar = $totalBayar + $subtotal;
                            $subtot_nonracik = number_format($data['subtotal'],0,',','.');
                            $hrg_jual = number_format($data['hrg_jual'],0,',','.');
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "
                        <tr>
                            <td align='left'>Obat non puyer</td>
                            <td align='left'>$data[nm_obat]</td>
                            <td width='10'>$data[jml_jual]</td>
                            <td width='10' align='right'>Rp.</td>
                            <td width='40' align='right'>$hrg_jual</td>
                            <td width='10' align='right'>Rp.</td>
                            <td width='40' align='right'>$subtot_nonracik</td>
                        </tr>";
                        }
                    }
                ?>
                  <!-- Transaksi Obat Racik -->
                <?php
                    require_once "../config/database.php";
                    $no_daftar = @$_GET['no_daftar'];
                    $no    = 1;
                    $query = mysqli_query($mysqli, "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.total_penjualan, tbl_racikan.nama_racikan, tbl_racikan.akai, tbl_racikan.keterangan, tbl_racikan.jml_puyer, tbl_racikan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_racikandetail
                              LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                              LEFT JOIN tbl_dataobat ON tbl_racikandetail.kd_obat=tbl_dataobat.kd_obat
                    WHERE no_daftar ='$no_daftar' ");
                    //$count  = mysqli_num_rows($query);
                    while($data  = mysqli_fetch_array($query)){
                        $jml_puyer = $data['jml_puyer'];
                        $subtot_racik = $data['subtotal'];                        
                        $totalRacik = $totalRacik + $subtot_racik;
                        $subtot_racik = number_format($totalRacik,0,',','.');
                        }
                    if (isset($totalRacik)){
                       echo "
                       <tr>
                            <td align='left'>Obat Puyer</td>
                            <td align='left'>Total Obat (Racikan Puyer)</td>
                            <td width='10'>$jml_puyer</td>
                            <td width='10' align='right'>Rp.</td>
                            <td width='40' align='right'>-</td>
                            <td width='10' align='right'>Rp.</td>
                            <td width='40' align='right'>$subtot_racik</td>
                        </tr>";
                    }else{
                        echo"";
                    }
                ?>
                 <!-- Transaksi Tindakan dan lain - lain -->
                <?php
                    require_once "../config/database.php";
                    $no_daftar = @$_GET['no_daftar'];
                    $no    = 1;
                    $query_dpj = mysqli_query($mysqli,"SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan, data_tindakan.harga_tindakan FROM tbl_tindakandetail
                      LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                      LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan
                    WHERE no_daftar ='$no_daftar' ");
                    $coun  = mysqli_num_rows($query_dpj);
                    // jika data ada
                        $totalTindakan = 0; 
                        if($coun == 0) {
                            echo "";
                        }
                        // jika data tidak ada
                        else {
                        // tampilkan data
                            while ($data = mysqli_fetch_assoc($query_dpj)) {
                                $dokter     = $data['nm_dokter'];
                                $sub_tind   = $data['hrg_tindakan'];
                                $totalTindakan = $totalTindakan + $sub_tind;
                                $subtotal_tind = number_format($data['hrg_tindakan'],0,',','.');
                        // menampilkan isi tabel dari database ke tabel di aplikasi
                        echo "  <tr>
                                    <td align='left'>Tindakan & Adm lain</td>
                                    <td align='left'>$data[nama_tindakan]</td>
                                    <td width='10'></td>
                                    <td width='10' align='right'>Rp.</td>
                                    <td width='40' align='right'>-</td>
                                    <td width='10' align='right'>Rp.</td>
                                    <td width='40' align='right'>$subtotal_tind</td>
                                </tr>";
                            }
                        }
                ?>
                <!-- Transaksi Laborat -->
                <?php
                    require_once "../config/database.php";
                    $no_daftar = @$_GET['no_daftar'];
                    $no    = 1;
                    $query_lab = mysqli_query($mysqli,"SELECT tbl_labdetail.*, tbl_labdetail.kode_lab,tbl_labdetail.kode_lab, tbl_lab.no_daftar,tbl_lab.nm_dokter, laborat.kode_lab, laborat.nm_lab FROM tbl_labdetail
                    LEFT JOIN tbl_lab ON tbl_labdetail.no_lab=tbl_lab.no_lab
                    LEFT JOIN laborat ON tbl_labdetail.kode_lab=laborat.kode_lab
                    WHERE no_daftar ='$no_daftar'");
                    $coun  = mysqli_num_rows($query_lab);
                    // jika data ada
                    $totalLaborat = 0; 
                    if($coun == 0) {
                        echo "";
                    }
                    // jika data tidak ada
                    else {
                    // tampilkan data
                        while ($data = mysqli_fetch_assoc($query_lab)) {
                                $sub_lab   = $data['hrg_lab'];
                                $totalLaborat = $totalLaborat + $sub_lab;
                                $subtotal_lab = number_format($data['hrg_lab'],0,',','.');
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo " 
                            <tr>
                                <td align='left'>Pemeriksaan Lab</td>
                                <td align='left'>$data[nm_lab]</td>
                                <td width='10'></td>
                                <td width='10' align='right'>Rp.</td>
                                <td width='40' align='right'>-</td>
                                <td width='10' align='right'>Rp.</td>
                                <td width='40' align='right'>$subtotal_lab</td>
                            </tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
            <!-- <br> -->
            <hr>
            <?php
                require_once "../config/database.php";
                $no_daftar = @$_GET['no_daftar'];
                $no    = 1;
                $query_trans = mysqli_query($mysqli,"SELECT * from tbl_transaksi WHERE no_daftar ='$no_daftar' ");
                $coun  = mysqli_num_rows($query_trans);
                        while ($data = mysqli_fetch_assoc($query_trans)) {
                $jml_kembali  = $data['jml_kembali'];
                $admin = $data['administrasi'];
                $diskon = $data['diskon'];
                $jml_bayar = $data['jml_uang'];
                $angka = $totalBayar+$totalRacik+$totalTindakan+$totalLaborat+$admin-$diskon;
                        //echo number_format($angka,2,',','.');
                        //echo" = ";                        
                }
            ?>
            <table border="0">
                <tr>
                    <td style='font-size: 12px; font-style: italic;' align='right'><strong>Terbilang = " <?php echo terbilang($angka)." Rupiah"; ?> "</strong></td>
                </tr>
            </table>
            <table border="0">
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='right'><?php echo $kab; ?>, <?php echo $hari_ini; ?></td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'>Total Keseluruhan </td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><?php echo number_format($totalBayar+$totalRacik+$totalTindakan+$totalLaborat,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='center'>Kasir</td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'>Biaya Administrasi</td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><?php echo number_format($admin,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='right'></td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'>Diskon</td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><?php echo number_format($diskon,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='right'></td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'>Uang Tunai</td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><?php echo number_format($jml_bayar,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='right'></td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'>Kembali</td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><?php echo number_format($jml_kembali,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td style='padding-right:8px; font-size: 10px;' align='center'><u><strong><?php echo $_SESSION['nama_peg']; ?></strong></u></td>
                    <td style='padding-left:440px; font-size: 10px;' align='left'><strong>Total Bayar</strong></td>
                    <td style='padding-left:1px; font-size: 10px;' align='right'>Rp.</td>
                    <td style='padding-right:1px; font-size: 10px;' align='right' width='46'><strong><?php echo number_format($totalBayar+$totalRacik+$totalTindakan+$totalLaborat+$admin-$diskon,0,',','.'); ?></strong></td>
                </tr>
            </table>
            <hr>
            <div class="terimakasih">
                    TERIMA KASIH, SEMOGA LEKAS SEMBUH
            </div>
        </div>
    </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->

<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="Kwitansi Transaksi Pasien.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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