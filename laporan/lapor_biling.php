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
    $asuransi      = $_GET['asuransi'];

    if (isset($_GET['tgl_awal'])) {
        $no    = 1;

       /* $query_tampil = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg ORDER BY tbl_penjualan.tgl_penjualan DESC, tbl_penjualan.no_penjualan DESC";*/

        // fungsi query untuk menampilkan data dari tbl_daftarpasien, tbl_transaksi, tbl_periksa
        $total = 0;
        $query = mysqli_query($mysqli, "SELECT * FROM tbl_daftarpasien AS u
            INNER JOIN tbl_transaksi AS i ON u.no_daftar = i.no_daftar
            INNER JOIN tbl_pegawai AS a ON u.id_peg = a.id_peg
            INNER JOIN tbl_periksa AS b ON u.no_daftar = b.no_daftar /* menampilkan tabel laporan terdapat diagnosa*/
        WHERE u.tgl_daftar BETWEEN '$tgl_awal' AND '$tgl_akhir' AND asuransi_pas ='$asuransi'")
        or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
            $count  = mysqli_num_rows($query);
        }
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN BILLING PASIEN BEROBAT</title>
        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <table border="0">
            <tbody> 
                <tr >
                    <td style="text-align:center; width:15;">
                        <img src="../images/logoklinik.png" width="50">
                    </td>
                    <td style="padding-left:4px; font-size:16px;text-align:left;" width="520">
                    <b><?php echo $nama_klinik; ?></b>
                    <br>
                    <span style="padding-right:8px; font-size:10px;text-align:left; border-bottom:solid 2px #ccc;" width="100%">
                    <?php echo $alamat_klinik; ?> - <?php echo $kab; ?>
                    <br> 
                    Email : <?php echo $email; ?> Telp : <?php echo $no_hp; ?> </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div style="font-size:12px; font-weight: bold; text-align:center;">
            Laporan Pendapatan <?php echo $nama_klinik; ?>
        </div>
        <?php  
        if ($tgl_awal==$tgl_akhir) { ?>
            <div id="title-tanggal">
                Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
            </div>
        <?php
        } else { ?>
            <div id="title-tanggal">
                Periode tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. tanggal <?php echo tgl_eng_to_ind($tgl2); ?>
            </div>
        <?php
        }
        ?>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">NO REG</th>
                        <th height="20" align="center" valign="middle">TGL BEROBAT</th>
                        <th height="20" align="center" valign="middle">NAMA PASIEN</th>
                        <th height="20" align="center" valign="middle">NO RM</th>
                        <th height="20" align="center" valign="middle">NIK</th>
                        <th height="20" align="center" valign="middle">ALAMAT</th>
                        <th height="20" align="center" valign="middle">CARA BAYAR</th>
                        <th height="20" align="center" valign="middle">DIAGNOSA</th>
                        <th height="20" align="center" valign="middle">BIAYA</th>
                        <th height="20" align="center" valign="middle">Dokter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // jika data ada
                        if($count == 0) {
                            echo
                            "<tr>
                                <td width='20' height='13' align='center' valign='middle'></td>
                                <td width='70' height='13' align='center' valign='middle'></td>
                                <td width='50' height='13' align='center' valign='middle'></td>
                                <td width='80' height='13' align='center' valign='middle'></td>
                                <td style='padding-left:5px;' width='40' height='13' valign='middle'></td>
                                <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'></td>
                                <td width='60' height='13' align='center' valign='middle'></td>
                                <td style='padding-right:10px;' width='30' height='13' align='right' valign='middle'></td>
                                <td width='90' height='13' align='left' valign='middle'></td>
                                <td style='padding-right:5px;' width='50' height='13' align='center' valign='middle'></td>
                                <td width='70' height='13' align='left' valign='middle'></td>
                            </tr>";
                    }
                    // jika data tidak ada
                    else {
                    // tampilkan data
                    while ($data = mysqli_fetch_assoc($query)) {
                        $tanggal       = $data['tgl_daftar'];
                        $nama       = $data['nm_dokter'];
                        $diagnosa       = $data['diagnosa'];
                        $admin  = $data['administrasi'];
                        $diskon  = $data['diskon'];
                        $total = $total+$data['total_penjualan'];
                        $penjualan = number_format($data['total_penjualan']);
                        $exp           = explode('-',$tanggal);
                        $tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];

                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo
                        "<tr>
                            <td width='20' height='13' align='center' valign='middle'>$no</td>
                            <td width='70' height='13' align='center' valign='middle'>$data[no_daftar]</td>
                            <td width='50' height='13' align='center' valign='middle'>$tanggal_masuk</td>
                            <td style='padding-left:5px;' width='80' height='13' valign='middle'>$data[nama_pas]</td>
                            <td width='40' height='13' align='center' valign='middle'>$data[nomor_rm]</td>
                            <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[nik]</td>
                            <td width='60' height='13' align='center' valign='middle'>$data[alm_pas]</td>
                            <td style='padding-right:10px;' width='30' height='13' align='center' valign='middle'>$data[asuransi_pas]</td>
                            <td width='90' height='13' align='left' valign='middle'>$diagnosa</td>
                            <td style='padding-right:5px;' width='50' height='13' align='right' valign='middle'>Rp. $penjualan</td>
                            <td width='70' height='13' align='left' valign='middle'>$data[nm_dokter]</td>
                        </tr>";
                        $no++;
                            }
                        }
                    ?>
                        <tr>
                            <th colspan="9" class="col_tot" style='padding-right:5px;' height='13' width='40' align='right' valign='middle'>Total</th>
                            <th class="col_tot" style='padding-right:5px;' height='13' width='50' align='right' valign='middle'>Rp. <?php echo number_format($total); ?></th>
                        </tr>
                </tbody>
            </table>
            <div align='center' id="footer-tanggal">
                <?php echo $kab; ?>, <?php echo tgl_eng_to_ind("$hari_ini"); ?><br>
                Dokter Penanggung Jawab
            </div>
            <div id="footer-jabatan">

            </div>
            <br>
            <br>        
            <div align='center' id="footer-nama">
                <?php echo $nama; ?>
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN DATA PASIEN PER BULAN.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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