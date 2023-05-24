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
        <div id="title-tanggal">
                    No Reg. : <?php echo $no_daftar; ?> , <?php echo $hari_ini; ?>
<br>
              Pasien: <?php echo $nama; ?> 
</div>

        <div id="isi">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="3" align="center" valign="middle">Transaksi</th>
                        <th height="3" align="center" valign="middle">Qty</th>
                        <th height="3" align="center" valign="middle">Harga</th>
                        <th height="3" align="center" valign="middle">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
$totalBayar = 0; 

    if($count == 0) {
        echo "  <tr>

                    <td width='10' height='3' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='3' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='3' align='right' valign='middle'></td>
                <td style='padding-right:10px;' width='100' height='3' align='right' valign='middle'></td>

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
                          <td style='padding-left:5px;' width='55' height='3' valign='middle'>$data[nm_obat]</td>

                        <td width='10' height='3' align='center' valign='middle'>$data[jml_jual]</td>
                        <td style='padding-right:10px;' width='10' height='3' align='right' valign='middle'>$data[hrg_jual]</td>
                            <td style='padding-right:10px;' width='25' height='3' align='right' valign='middle'>$data[subtotal]</td>
                    </tr>"

                    ;
            $no++;
        }


    }


?>  
<!--   <tr>
    <td colspan='3' align='right'><strong>Total Obat (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;' align='right'><?php echo $totalBayar; ?></td>
  </tr> -->

                </tbody>


            </table>

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
<!--                         <th height="20" align="center" valign="middle">NAMA RACIKAN</th>
                        <th height="20" align="center" valign="middle">Qty</th>
                        <th height="20" align="center" valign="middle">Harga</th>
                        <th height="20" align="center" valign="middle">Subtotal</th> -->
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
$totalRacik = 0; 

    if($count == 0) {
        echo "  <tr>
                      <td width='20' height='3' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='10' height='3' valign='middle'></td>
                    <td style='padding-right:10px;' width='10' height='3' align='right' valign='middle'></td>
                    <td style='padding-right:10px;' width='20' height='3' align='right' valign='middle'></td>
                <td style='padding-right:10px;' width='20' height='3' align='right' valign='middle'></td>
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
                        <td style='padding-left:5px;' width='55' height='3' valign='middle'>$data[nama_racikan]</td>

                        <td width='10' height='3' align='center' valign='middle'>$data[jml_jual]</td>
                        <td style='padding-right:10px;' width='10' height='3' align='right' valign='middle'>$data[hrg_jual]</td>
                            <td style='padding-right:10px;' width='25' height='3' align='right' valign='middle'>$data[subtotal]</td>

                    </tr>"

                    ;
            $no++;
        }


    }


?>  
<!--   <tr>
    <td colspan='3' align='right'><strong>Total Obat Racik (Rp) : </strong></td>
    <td colspan='1' style='padding-right:10px;' align='right'><?php echo $totalRacik; ?></td>
  </tr> -->

                </tbody>

            </table>
<!-- <br> -->
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
            <table width="50%" border="0" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
<!--                         <th height="20" align="center" valign="middle">NAMA TINDAKAN</th>
                        <th height="20" align="center" valign="middle">HARGA</th> -->

                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
$totalTindakan = 0; 

    if($coun == 0) {
        echo "  <tr>
                    <td width='80' height='3' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='3' valign='middle'></td>

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

                        <td style='padding-left:5px;' width='76' height='3' valign='middle'>$data[nama_tindakan]</td>
                            <td style='padding-right:10px;' width='50' height='3' align='right' valign='middle'>$data[harga_tindakan]</td>

                    </tr>
<tr>
                        <td style='padding-left:5px;' width='76' height='3' valign='middle'><hr></td>
                            <td style='padding-right:10px;' width='50' height='3' align='right' valign='middle'><hr></td></tr>
                    "

                    ;
            $no++;
        }


    }


?>  

  <?php

require_once "../config/database.php";
    $no_daftar = @$_GET['no_daftar'];
   $no    = 1;

       $query_trans = mysqli_query($mysqli,"SELECT * from tbl_transaksi
                WHERE no_daftar ='$no_daftar' ");

$coun  = mysqli_num_rows($query_trans);
        while ($data = mysqli_fetch_assoc($query_trans)) {
$jml_kembali       = $data['jml_kembali'];
$admin = $data['administrasi'];
$jml_bayar = $data['jml_uang'];
}
?>

                </tbody>

  <tr >
    <td colspan='1' style='padding-left:5px;' width='76' height='3' align='right'>Total Keseluruhan </td>
    <td colspan='2' style='padding-right:10px;' width='50' height='3' align='right' ><?php echo ($totalBayar+$totalRacik+$totalTindakan); ?></td>
</tr>
  <tr>
    <td colspan='1' style='padding-left:5px;' width='76' height='3' align='right'>Biaya Administrasi  </td>
    <td colspan='2' style='padding-right:10px;' width='50' height='3' align='right' ><?php echo $admin; ?></td>
</tr>
  <tr>
    <td colspan='1' style='padding-left:5px;' width='76' height='3' align='right'>Total Bayar  </td>
    <td colspan='2' style='padding-right:10px;' width='50' height='3' align='right' ><?php echo($totalBayar+$totalRacik+$totalTindakan+$admin); ?></td>
</tr>
<tr>
        <td colspan='1' style='padding-left:5px;' width='76' height='3' align='right'>Uang Tunai  </td>
    <td colspan='2' style='padding-right:10px;' width='50' height='3' align='right' ><?php echo $jml_bayar; ?></td>
</tr>
<tr>
        <td colspan='1' style='padding-left:5px;' width='76' height='3' align='right'>Kembali  </td>
    <td colspan='2' style='padding-right:10px;' width='50' height='3' align='right' ><?php echo $jml_kembali; ?></td>
  </tr>

            </table>
<hr>
<div class="terimakasih">
            TERIMA KASIH, SEMOGA CEPAT SEMBUH
        </div>
<!--           <div id="footer-tanggal">
                Medan, <?php echo $hari_ini; ?>
            </div>

            <div id="footer-jabatan">
                Nama Dokter

            </div>
            <div id="footer-nama">
                                <?php echo $dokter; ?>

            </div>
 -->        </div>


    </body>













</html><!-- Akhir halaman HTML yang akan di konvert -->





<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="LAPORAN DATA OBAT MASUK.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif " >'.($content).'</page>';
// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>