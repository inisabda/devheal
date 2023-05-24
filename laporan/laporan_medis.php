<?php

$koneksi=new mysqli("localhost", "root","","klinik_project");

$filename="lap_data_pasien-(".date('d-m-y').").xls";

header ("content-disposition: attachment;filename=$filename");
header("content-type: application/vdn.ms-exel")

?>

<?php
error_reporting(0);// taruh disini ya  bagian atas sekali

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../config/fungsi_rupiah.php";
include "../config/setting.php";

$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
            $dt1 = $_POST["tgl1"];
            $dt2 = $_POST["tgl2"];
            $asuransi = $_POST['asuransi'];
       

    $no = 1;
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_daftarpasien 
        INNER JOIN tbl_pegawai ON tbl_daftarpasien.id_peg = tbl_pegawai.id_peg
        INNER JOIN tbl_periksa ON tbl_daftarpasien.no_daftar = tbl_periksa.no_daftar
        WHERE tbl_daftarpasien.tgl_daftar BETWEEN '$dt1' AND '$dt2' AND asuransi_pas ='$asuransi'  ") 
    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA PASIEN BEROBAT</title>

    </head>
    <body>
        <div id="title">
            LAPORAN DATA PASIEN BEROBAT <?php echo $nama_klinik; ?>
        </div>
    <?php  
    if ($dt1==$dt2) { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($dt1); ?>
        </div>
    <?php
    } else { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($dt1); ?> s.d. <?php echo tgl_eng_to_ind($dt2); ?>
        </div>
    <?php
    }
    ?>
        
        <hr><br>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="30" align="center" valign="middle">NO.</th>
                        <th height="30" align="center" valign="middle">NO REG</th>
                        <th height="30" align="center" valign="middle">TGL DAFTAR</th>
                        <th height="30" align="center" valign="middle">NAMA PASIEN</th>
                        <th height="30" align="center" valign="middle">NIK</th>
                        <th height="30" align="center" valign="middle">NO RM</th>
                        <th height="30" align="center" valign="middle">NO HP / TELP</th>
                        <th height="30" align="center" valign="middle">ASURANSI</th>
                        <th height="30" align="center" valign="middle">DIAGNOSA</th>
                        <th height="30" align="center" valign="middle">Pegawai</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='30' align='center' valign='middle'></td>
                    <td width='220' height='30' align='center' valign='middle'></td>
                    <td width='180' height='30' align='center' valign='middle'></td>
                    <td width='180' height='30' align='center' valign='middle'></td>
                    <td width='180' height='30' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='80' height='30' valign='middle'></td>
                    <td style='padding-left:5px;' width='180' height='30' align='left' valign='middle'></td>
                    <td style='padding-left:5px;' width='260' height='30' align='left' valign='middle'></td>
                    <td style='padding-left:5px;' width='260' height='30' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='160' height='30' align='left' valign='middle'></td>


                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            $tanggal       = $data['tgl_daftar'];
            $nama          = $data['nama_peg'];
            $exp           = explode('-',$tanggal);
            $tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='30' align='center' valign='middle'>$no</td>
                        <td width='220' height='30' align='center' valign='middle'>$data[no_daftar]</td>
                        <td width='180' height='30' align='center' valign='middle'>$tanggal_masuk</td>
                        <td style='padding-left:5px;' width='180' height='30' valign='middle'>$data[nama_pas]</td>
                        <td style='padding-left:5px;' width='180' height='30' valign='middle'>$data[nik]</td>
                        <td width='160' height='30' align='center' valign='middle'>$data[nomor_rm]</td>
                        <td style='padding-left:5px;' width='160' height='30' align='left' valign='middle'>$data[no_hp]</td>
                        <td style='padding-left:5px;' width='160' height='30' align='center' valign='middle'>$data[asuransi_pas]</td>
                        <td style='padding-left:5px;' width='250' height='30' align='left' valign='middle'>$data[diagnosa]</td>
                        <td style='padding-left:5px;' width='160' height='30' align='left' valign='middle'>$data[nama_peg]</td>
                    </tr>";
            $no++;
        }
    }
?>  
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
 