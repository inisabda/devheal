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

// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];

if (isset($_GET['tgl_awal'])) {
    $no    = 1;
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg INNER JOIN tbl_penjualandetail ON tbl_penjualan.no_penjualan = tbl_penjualandetail.no_penjualan INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_penjualan.tgl_penjualan BETWEEN '$tgl_awal' AND '$tgl_akhir' ")
    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA PENJUALAN OBAT</title>
        <link rel="stylesheet" type="text/css" href="../../assets/laporan.css" />
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
                    <span style="padding-right:8px; font-size:10px;text-align:left; border-bottom:solid 2px #ccc;" width="100%">
                    <?php echo $alamat_klinik; ?>
                    <br> 
                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?> </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <?php  
        if ($tgl_awal==$tgl_akhir) { ?>
            <div id="title-tanggal">
                Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
            </div>
        <?php
        } else { ?>
            <div id="title-tanggal" align="center">
                    <strong>Laporan Penjualan Obat / Alkes Apotek <?php echo $nama_klinik; ?></strong>
                <br>Periode tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
            </div>
        <?php
        }
        ?>
        <br>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
                        <th height="20" align="center" valign="middle">TANGGAL</th>
                        <th height="20" align="center" valign="middle">NAMA OBAT</th>
                        <th height="20" align="center" valign="middle">JUMLAH</th>
                        <th height="20" align="center" valign="middle">SATUAN</th>
                        <th height="20" align="center" valign="middle">Harga</th>
                        <th height="20" align="center" valign="middle">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // jika data ada
                    if($count == 0) {
                        echo "  <tr>
                                    <td width='40' height='13' align='center' valign='middle'></td>
                                    <td width='120' height='13' align='center' valign='middle'></td>
                                    <td width='80' height='13' align='center' valign='middle'></td>
                                    <td width='155' height='13' align='center' valign='middle'></td>
                                    <td style='padding-left:5px;' width='40' height='13' valign='middle'></td>
                                    <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'></td>
                                    <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'></td>
                                    <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'></td>
                                </tr>";
                    }
                    // jika data tidak ada
                    else {
                        // tampilkan data
                        while ($data = mysqli_fetch_assoc($query)) {
                            $tanggal        = $data['tgl_penjualan'];
                            $nama           = $data['nama_peg'];
                            $exp            = explode('-',$tanggal);
                            $tanggal_masuk  = $exp[2]."-".$exp[1]."-".$exp[0];
                            $harga_jual     = number_format($data['hrg_jual']);
                            $sub_tot        = number_format($data['subtotal']);
                            $subtotal       = $data['subtotal'];
                            $totalBayar     = $totalBayar + $subtotal;

                            // menampilkan isi tabel dari database ke tabel di aplikasi
                            echo "  <tr>
                                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                                        <td width='120' height='13' align='center' valign='middle'>$data[no_penjualan]</td>
                                        <td width='80' height='13' align='center' valign='middle'>$tanggal_masuk</td>
                                        <td style='padding-left:5px;' width='155' height='13' valign='middle'>$data[nm_obat]</td>
                                        <td width='40' height='13' align='center' valign='middle'>$data[jml_jual]</td>
                                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[sat_jual]</td>
                                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$harga_jual</td>
                                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$sub_tot</td>
                                    </tr>";
                            $no++;
                            }
                        }
                    ?>	
                    <tr>
                        <td colspan='7' align='right'><strong>Total Penjualan (Rp) : </strong></td>
                        <td colspan='1' style='padding-right:10px;' width='60' height='13' valign='middle' align='right'><strong><?php echo number_format($totalBayar); ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div id="footer-tanggal">
                <?php echo $kab; ?>, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
            </div>
            <div id="footer-jabatan">                 
            </div>
            <br>
            <br>        
            <div id="footer-nama">
                <?php echo $nama; ?>
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN DATA PENJUALAN OBAT.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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