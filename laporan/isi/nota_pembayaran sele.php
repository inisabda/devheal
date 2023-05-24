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

   $query_daft = mysqli_query($mysqli,"SELECT * from tbl_daftarpasien   WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {

    $nama = $dat['nama_pas'];
}
   $no    = 1;
   /* $query_tampil = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg ORDER BY tbl_penjualan.tgl_penjualan DESC, tbl_penjualan.no_penjualan DESC";*/
    // fungsi query untuk menampilkan data dari tabel obat masuk

       $query = mysqli_query($mysqli,"SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_pengobatan.nama_pas, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
                  LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
                  LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat

                WHERE no_daftar ='$no_daftar' ");


 $count  = mysqli_num_rows($query);


?>
<link type="text/css" href="./isi/style_css/nota_penjualan.css" rel="stylesheet" >
<tr>
<tr>
                    <td align="left" >
                        <?php echo $count['nm_obat']; ?>
                    </td>
                </tr>
                    <td class="isi nama-pegawai">
                        kasir : <?php echo $data['username']; ?>
                    </td>
                </tr>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <div id="title">
        TAGIHAN BEROBAT PASIEN
        </div>
        <div>
                    No Registrasi : <?php echo $no_daftar; ?> 
</div>
              Nama Pasien: <?php echo $nama; ?>

        <hr>

        <br>
        <div id="isi">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
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
$totalBayar = 0; 

    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>

                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
$nama       = $data['nama_pas'];
                        $subtotal   = $data['subtotal'];
    $totalBayar = $totalBayar + $subtotal;
            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[no_pengobatan]</td>
                        <td style='padding-left:5px;' width='155' height='13' valign='middle'>$data[nm_obat]</td>

                        <td width='50' height='13' align='center' valign='middle'>$data[jml_jual]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[sat_jual]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[hrg_jual]</td>
                            <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[subtotal]</td>
                    </tr>"

                    ;
            $no++;
        }


    }


?>  
  <tr>
    <td colspan='6' align='right'><strong>Total Obat (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;' align='right'><?php echo $totalBayar; ?></td>
  </tr>

                </tbody>


            </table>

<br>
<?php

require_once "../config/database.php";
    $no_daftar = @$_GET['no_daftar'];
   $no    = 1;

       $query = mysqli_query($mysqli,"SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.no_daftar, tbl_racikan.nama_pas, tbl_nama_racikan.kd_racik, tbl_nama_racikan.nama_racikan, tbl_nama_racikan.total_penjualan FROM tbl_racikandetail
                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                  LEFT JOIN tbl_nama_racikan ON tbl_racikandetail.kd_obat=tbl_nama_racikan.kd_racik

                WHERE no_daftar ='$no_daftar' ");


 $count  = mysqli_num_rows($query);

?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
                        <th height="20" align="center" valign="middle">NAMA OBAT RACIK</th>
                        <th height="20" align="center" valign="middle">JUMLAH</th>
                        <th height="20" align="center" valign="middle">SATUAN</th>
                        <th height="20" align="center" valign="middle">Harga</th>
                        <th height="20" align="center" valign="middle">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
$totalRacik = 0; 

    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
$nama       = $data['nama_pas'];
                        $subtotal   = $data['subtotal'];
    $totalRacik = $totalRacik + $subtotal;
            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[no_pengobatan]</td>
                        <td style='padding-left:5px;' width='155' height='13' valign='middle'>$data[nama_racikan]</td>

                        <td width='50' height='13' align='center' valign='middle'>$data[jml_jual]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[sat_jual]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[hrg_jual]</td>
                            <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[subtotal]</td>

                    </tr>"

                    ;
            $no++;
        }


    }


?>  
  <tr>
    <td colspan='6' align='right'><strong>Total Obat Racik (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;' align='right'><?php echo $totalRacik; ?></td>
  </tr>

                </tbody>

            </table>
<br>
<?php

require_once "../config/database.php";
    $no_daftar = @$_GET['no_daftar'];
   $no    = 1;

       $query_dpj = mysqli_query($mysqli,"SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan, data_tindakan.harga_tindakan FROM tbl_tindakandetail
                  LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                  LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                WHERE no_daftar ='$no_daftar' ");
$coun  = mysqli_num_rows($query_dpj);
?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE TINDAKAN</th>
                        <th height="20" align="center" valign="middle">NAMA TINDAKAN</th>
                        <th height="20" align="center" valign="middle">HARGA</th>

                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
$totalTindakan = 0; 

    if($coun == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='13' valign='middle'></td>

                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query_dpj)) {
$dokter       = $data['nm_dokter'];

                        $subtotal   = $data['harga_tindakan'];
    $totalTindakan = $totalTindakan + $subtotal;
            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[no_tindakan]</td>
                        <td style='padding-left:5px;' width='305' height='13' valign='middle'>$data[nama_tindakan]</td>
                            <td style='padding-right:10px;' width='130' height='13' align='right' valign='middle'>$data[harga_tindakan]</td>

                    </tr>"

                    ;
            $no++;
        }


    }


?>  
  <tr>
    <td colspan='3' align='right'><strong>Total Tindakan (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;' align='right'><?php echo $totalTindakan; ?></td>
  </tr>
                </tbody>

  <tr>
    <td colspan='3' align='right'><strong>Total Keseluruhan (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;'  align='right'><b><?php echo ($totalBayar+$totalRacik+$totalTindakan); ?></b></td>
  </tr>

            </table>




          <div id="footer-tanggal">
                Medan, <?php echo $hari_ini; ?>
            </div>

            <div id="footer-jabatan">
                Nama Dokter

            </div>
            <div id="footer-nama">
                                <?php echo $dokter; ?>

            </div>
        </div>


    </body>













</html><!-- Akhir halaman HTML yang akan di konvert -->






<?php
$filename="LAPORAN DATA OBAT MASUK.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif " >'.($content).'</page>';
// panggil library html2pdf
require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(20, 10, 13, 15));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>