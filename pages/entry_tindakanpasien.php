<?php 
    $no_daftar = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4><i class="fas fa-file-signature"></i> Form Pemeriksaan Pasien</h4></div>
        <div class="col-6 text-right">
            <?php if($_SESSION['posisi_peg'] == 'Dokter2') { ?>
            <a href="?page=perawatan2">
                <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
            </a>
            <?php } ?>
            <?php if($_SESSION['posisi_peg'] == 'Dokter') { ?>
                <a href="?page=perawatan">
                <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12 vertical-form">
            <div class="row data-pasien">
                  <?php  
                  $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                  $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                  $data = mysqli_fetch_array($sql_tampil);
                      $nomor_rm = $data['nomor_rm'];
                      $nama_pasien = $data['nama_pas'];
                 //Fungsi Menghitung Umur Pasien
                      $tanggal_lahir = new DateTime($data['lhr_pas']);
                      $sekarang = new DateTime("today");
                      if ($tanggal_lahir > $sekarang) { 
                          $thn = "0";
                          $bln = "0";
                          $tgl = "0";
                      }
                      $thn = $sekarang->diff($tanggal_lahir)->y;
                      $bln = $sekarang->diff($tanggal_lahir)->m;
                      $tgl = $sekarang->diff($tanggal_lahir)->d;
                      //echo "Umur anda adalah :<br>";
                      //echo $thn." tahun ".$bln." bulan ".$tgl." hari";
                     ?>
                <div class="col-md-12" style="text-align: left; font-size: 14px;">
                  <br>
                    <table border="0" cellpadding="0">
                        <tr>
                            <td width="100"><b>No. Registrasi</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['no_daftar']; ?></td>
                            <td>Alergi :
                                <?php
                                $tidak_alergi = "Tidak Ada Alergi";
                                  if($data['alergi']){ ?>
                                    <span class="badge badge-pill badge-warning" style="padding: 8px; font-size: 11px;"><?php echo $data['alergi']; ?></span>
                                  <?php }else if($data['alergi'] == ''){?>                       
                                    <span class="badge badge-pill badge-success" style="padding: 8px; font-size: 11px;"><?php echo $tidak_alergi;?></span>
                                  <?php }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="100"><b>Nomor RM</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['nomor_rm']; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><b>Nama Pasien</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['nama_pas']; ?></td>
                            <td><?php echo $data['jk_pas']; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><b>TTL Pasien</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</td>
                        </tr>
                        <tr>
                          <td width="100"><b>Agama</b></td>
                          <td width="10">:</td>
                          <td><?php echo $data['agama']; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><b>Alamat</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['alm_pas']; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><b>Cara Bayar</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['asuransi_pas']; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><b>Dokter</b></td>
                            <td width="10">:</td>
                            <td><?php echo $data['nm_dokter']; ?></td>
                        </tr>                      
                    </table>
                    <table class="data_pasien mt-3" border="0" cellpadding="0">
                        <tr>
                        <td>
                            <button class="btn-transition btn btn-outline-info btn-sm" title="Form Assesment Pasien" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-stethoscope"> Assesment</i></button>
                            <button class="btn-transition btn btn-outline-info btn-sm" title="Form Assesment Pasien" id="tombol_obatoral" name="tombol_obatoral" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-pills"> Obat Non racikan</i></button>
                            <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Racikan" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-mortar-pestle"> Obat Racikan</i></button>
                            <button class="btn btn-warning btn-sm" title="Form Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-syringe"> Tindakan</i></button>
                            <button class="btn-transition btn btn-outline-info btn-sm" title="Form Laborat Pasien" id="tombol_laborat" name="tombol_laborat" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-flask"> Laborat</i></button>
                            <button class="btn-transition btn btn-outline-danger btn-sm" title="Riwayat Berobat Pasien" id="tombol_riwayat" name="tombol_riwayat" data-id="<?php echo $data['nomor_rm']; ?>"><i class="fas fa-receipt"> Riwayat Berobat</i></button>
                            <div class="btn-group dropright">
                                <button class="btn-transition btn btn-outline-danger btn-sm dropdown" type="button" title="Cetak Surat" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="fas fa-envelope"> Cetak Surat</i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" id="tombol_suratijin" name="tombol_suratijin" data-id="<?php echo $data['no_daftar']; ?>">Surat Ijin Sakit</button>
                                    <button class="dropdown-item" id="tombol_suratsehat" name="tombol_suratsehat" data-id="<?php echo $data['no_daftar']; ?>">Surat Keterangan Sehat</button>
                                    <button class="dropdown-item" id="tombol_suratsakit" name="tombol_suratsakit" data-id="<?php echo $data['no_daftar']; ?>">Surat Keterangan Sakit</button>
                                    <button class="dropdown-item" id="tombol_rujuk" name="tombol_rujuk" data-id="<?php echo $data['no_daftar']; ?>">Rujuk Pasien</button>
                                    <button class="dropdown-item" id="tombol_swab" name="tombol_swab" data-id="<?php echo $data['no_daftar']; ?>">Surat Keterangan SWAB</button>
                                    <button class="dropdown-item" id="tombol_narkoba" name="tombol_narkoba" data-id="<?php echo $data['no_daftar']; ?>">Surat Ket. Narkoba</button>
                                </div>
                            </div>
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Awal Halaman Tindakan -->
    <form method="post" id="form_tindakan" autocomplete="off">
		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
                <?php 
                    $tgl_tindakan = gmdate('Y-m-d', time() + 60 * 60 * 7);
                    $hari= substr($tgl_tindakan, 8, 2);
                    $bulan = substr($tgl_tindakan, 5, 2);
                    $tahun = substr($tgl_tindakan, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_tindakan) FROM tbl_tindakan WHERE tgl_tindakan = '$tgl_tindakan'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_tindakan = "TNK/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                    } else {
                        $no_tindakan = "TNK/".$tgl."/001";
                    }
                 ?>

                <div style="text-align: right;">
                    No ID Tindakan : <b><?php echo $no_tindakan; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>
              
                <div class="position-relative row form-group">
                    <div class="col-sm-4">
                        <input type="hidden" class="form-control form-control-sm" id="nama_pas" name="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $nama_pasien; ?>" disabled="">
                    	<input name="no_tindakan" id="no_tindakan" placeholder="nomor tindakan" type="hidden" class="form-control form-control-sm" value="<?php echo $no_tindakan; ?>">
                        <input name="tanggal_tindakan" id="tanggal_tindakan" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" class="form-control form-control-sm" id="nomor_rm" name="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $nomor_rm; ?>" disabled="">
                        <input type="hidden" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" >
                    </div>
                </div>
                <div class="row kotak-form-tabel-tindakan">
                	<div class="col-md-3 kotak-form-tindakan-terjual" style="display: ;">
                        <div class="position-relative form-group pt-1">
                            <label for="dokter" class="">Dokter </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="nm_dokter" name="nm_dokter" value="<?php echo $data['nm_dokter']; ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dokter" id="lihat_data_dokter"><i class="fas fa-file-signature"></i></button>
                                </div>
                            </div>
                        </div>
            			<div class="position-relative form-group pt-1">
            				<label for="kode_tindakan" class="">Kode Tindakan</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="kode_tindakan">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datatindakan" id="lihat_data_tindakan"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
            			</div>
                        <div class="position-relative form-group pt-1">
                            <label for="nama_tindakan" class="">Nama Tindakan</label>
                            <input name="nama_tindakan" id="nama_tindakan" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                        </div>
            			<div class="position-relative form-group pt-1">
            				<label for="harga_tindakan" class="">Harga</label>
            				<div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                </div>
                                    <input type="number" class="form-control" id="harga_tindakan" name="harga_tindakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="position-relative form-group text-right pt-1 mb-2">
                            <button type="button" class="btn btn-danger btn-sm" id="reset_tindakan"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="button" class="btn btn-info btn-sm" id="tambah_tindakan"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <div class="col-md-3 kotak-form-pembayaran" style="display:none;">
                        <div class="position-relative form-group">
                            <label class="">Total</label>
                            <div class="text-right">
                                Rp<span id="total_pembayaran">127500</span>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="jml_uang" class="">Jumlah Uang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                </div>
                                  <input name="jml_uang" id="jml_uang" placeholder="" type="number" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="jml_kembali" class="">Kembalian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="jml_kembali" name="jml_kembali" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly="">
                            </div>
                        </div>
                    </div>
                	<div class="col-md-9 kotak-tabel-tindakan-terjual">
                        <table class="table display tabel-data">
                            <thead>
                                <tr>
                                    <th class="text-left">Kode</th>
                                    <th class="text-left">Tindakan </th>
                                    <th class="text-center">Harga</th>                                                                    
                                </tr>
                            </thead>
                            <tbody id="keranjang_tindakan">
                                
                            </tbody>
                            <tfoot>
                                <tr id="baris_kosong">
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                                <tr class="baris_total" style="display: none;">
                                    <td colspan="3" class="text-right" style="font-weight: bold;">Total : <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                    <td class="td-opsi">
                                        <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua tindakan" id="hapus_semua_tindakan">hapus</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="baris_total text-right" style="display: none;">
                            <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">lanjut pembayaran</button>
                            <button type="button" name="lanjut_pembayaran" id="tambah_tindakan_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">tambah tindakan lagi</button>
                        </div>
                	</div>
                </div>
                <div class="text-center tombol-kanan">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Tindakan</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12 vertical-form">
            <h5 align="center"> Hasil Data Tindakan Pasien</h5>                
            <table  id="" class="table table-striped display tabel-data">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode ID</th>
                        <th>Dokter</th>
                        <th>Nama Tindakan</th>
                        <th>Harga Tindakan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <?php 

                $no_daftar = @$_GET['id'];

                    $tgl_sekarang = date('Y-m-d');
                    $nomor = 1;
                    $totalBayar = 0;
                    $query_pjltindakan = "SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan,tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan FROM tbl_tindakandetail
                      LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                      LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                    WHERE no_daftar ='$no_daftar' ";
                    $sql_pjltindakan = mysqli_query($conn, $query_pjltindakan) or die ($conn->error);
                 ?>
                <tbody>
                    <?php  
                    while($data_pjltindakan = mysqli_fetch_array($sql_pjltindakan)) {
                        $subtotal   = $data_pjltindakan['hrg_tindakan'];
                        $totalBayar = $totalBayar + $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $nomor++; ?> .</td>
                        <td><?php echo $data_pjltindakan['kd_tindakan'] ?></td>
                        <!--<td><?php echo $data_pjltindakan['no_daftar']; ?></td> -->
                        <td><?php echo $data_pjltindakan['nm_dokter']; ?></td>
                        <td><?php echo $data_pjltindakan['nama_tindakan']; ?></td>
                        <td>Rp. <?php echo number_format($data_pjltindakan['hrg_tindakan'],2,',','.'); ?></td>
                        <td class="td-opsi">
                            <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-dismiss="modal"
                                data-id="<?php echo $data_pjltindakan['no']; ?>"
                                data-no_tindakan="<?php echo $data_pjltindakan['no_tindakan']; ?>"
                                data-nama_tindakan="<?php echo $data_pjltindakan['nama_tindakan']; ?>"
                                data-harga_tindakan="<?php echo $data_pjltindakan['hrg_tindakan']; ?>">
                                <i class="fas fa-trash"></i>
                            </button></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" align="right" bgcolor="#F5F5F5">Total Tindakan :</td>
                        <td colspan="2" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Akhir Halaman Tindakan -->

<!-- Modal Cari Tindakan -->
<div class="modal fade" id="modal_datatindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Tindakan</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            require_once "koneksi.php";
                            $query_tampil = "SELECT * FROM data_tindakan ";
                            /* $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/

                            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                            while($data = mysqli_fetch_array($sql_tampil)) {
                        ?>
                        <tr>
                            <td><?php echo $data['kd_tindakan']; ?></td>
                            <td><?php echo $data['nama_tindakan']; ?></td>
                            <td><?php echo $data['harga_tindakan']; ?></td>
                            <td class="td-opsi">
                                <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihtindakan" name="tombol_pilihtindakan" data-dismiss="modal"
                                    data-kode="<?php echo $data['kd_tindakan']; ?>"
                                    data-nama="<?php echo $data['nama_tindakan']; ?>"
                                    data-harga="<?php echo $data['harga_tindakan']; ?>"
                                > Pilih
                                </button>
                            </td>
                        </tr>
                         <?php 
                            } 
                         ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Cari Data Dokter -->
<div class="modal fade" id="modal_dokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            require_once "koneksi.php";
                            $query_tampil = "SELECT * FROM dokter ";
                            /* $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/
                            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                            while($data = mysqli_fetch_array($sql_tampil)) {
                         ?>
                        <tr>
                            <td><?php echo $data['kd_dokter']; ?></td>
                            <td><?php echo $data['nm_dokter']; ?></td>
                            <td><?php echo $data['spesialisasi']; ?></td>
                            <td class="td-opsi">
                                <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihdokter" name="tombol_pilihdokter" data-dismiss="modal"
                                    data-kd="<?php echo $data['kd_dokter']; ?>"
                                    data-nm="<?php echo $data['nm_dokter']; ?>"
                                > pilih
                                </button>
                            </td>
                        </tr>
                         <?php 
                            } 
                         ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$("button[name='tombol_hapus']").click(function() {
        var no_tindakan = $(this).data("no_tindakan");
        var nama = $(this).data('nama_tindakan');
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'akan menghapus data tindakan '+nama+', anda tidak dapat mengembalikan data yang telah dihapus.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Hapus'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=entry_tindakanpasien",
              data: "id="+no_tindakan,
              success: function(hasil) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Data Berhasil Dihapus',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    window.location.reload(true);
                  }
                })
              }
            })  
          }
        })
    });

$(document).ready(function() {
    // $(".kotak-form-obat-terjual").slideTo('slow');
    var count = 0;
    var total_penjualan = 0;

    $('.datepicker').datepicker({
        format : "yyyy-mm-dd",
        orientation: "bottom left",
        todayBtn: "linked",
        autoclose: true,
        language: "id",
        todayHighlight: true
    });

    function reset() {
        $("#kode_tindakan").val("");
        $("#nama_tindakan").val("");
        $("#harga_tindakan").val("");
    }

    $("button[name='tombol_pilihdokter']").click(function() {
        var kd = $(this).data('kd');
        var nm = $(this).data('nm');
       

        $("#kd_dokter").val(kd);
        $("#nm_dokter").val(nm);
    });
 

    $("button[name='tombol_pilihtindakan']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
       

        $("#kode_tindakan").val(kode);
        $("#nama_tindakan").val(nama);
        $("#harga_tindakan").val(harga);
    });

    $("#nm_dokter").click(function() {
        $("#lihat_data_dokter").click();
    });

    $("#kode_tindakan").click(function() {
        $("#lihat_data_tindakan").click();
    });

    $("#kode_tindakan").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#harga_tindakan").keyup(function() { hrg_obat(); });

    $("#reset_tindakan").click(function() {
        reset();
    });

    $("#tambah_tindakan").click(function() {
        var kode = $("#kode_tindakan").val();
        var nama = $("#nama_tindakan").val();
        var harga = $("#harga_tindakan").val();

        if(kode=="") {
            document.getElementById("lihat_data_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("harga_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi harga tindakan dengan benar',
              'warning'
            )
        } else {
            // alert(kode+" / "+nama+" / "+harga+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdtindakan[]" id="td_kd_tindakan'+count+'" class="td_kd_tindakan" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmtindakan[]" id="td_nmtindakan'+count+'" class="td_nmtindakan" value="'+nama+'"></td>';
            output += '<td class="text-right">Rp. '+harga+' <input type="hidden" name="hidden_hrgtindakan[]" id="td_hrgtindakan'+count+'" class="td_hrgtindakan" value="'+harga+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_tindakan btn-transition btn btn-outline-danger btn-sm" name="hapus_tindakan" id="'+count+'" title="hapus tindakan ini">hapus</button></td>';
            output += '</tr>';
            $("#keranjang_tindakan").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

    $(document).on("click", ".hapus_tindakan", function() {
        var row_id = $(this).attr("id");
        var harga = Number($("#td_harga"+row_id).val());

        total_penjualan = total_penjualan-harga;
        $("#total_penjualan").text(total_penjualan);
        $("#hidden_totalpenjualan").val(total_penjualan);
        $("#total_pembayaran").text(total_penjualan);
        $("#row_"+row_id).remove();
        if(total_penjualan==0)
        {
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_tindakan_lagi").click();
        }
    });

    $("#hapus_semua_tindakan").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar tindakan',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_tindakan > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_tindakan_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-tindakan-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_tindakan_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_tindakan_lagi").click(function() {
        // alert();
        $(".kotak-form-tindakan-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_tindakan_lagi").hide();
        $("#lanjut_pembayaran").show();
    });

   /* $("#jml_uang").keyup(function() {
        var nominal = $(this).val();
        var kembali;
        if(nominal>=total_penjualan){
            kembali = nominal - total_penjualan;
            $("#jml_kembali").val(kembali);
        } else {
            $("#jml_kembali").val("uang tidak cukup");
        }
    });*/

    $("#form_tindakan").on("submit", function(event){
        event.preventDefault();
        var no_tindakan = $("#no_tindakan").val();
        var tanggal_tindakan = $("#tanggal_tindakan").val();
        var no_rawat = $("#no_rawat").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nm_dokter = $("#nm_dokter").val();

        if(no_tindakan=="") {
            document.getElementById("no_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_tindakan==""){
            document.getElementById("tanggal_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
              'warning'
            )
       /* } else if(total_penjualan==0){
            document.getElementById("lihat_data_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi daftar tindakan',
              'warning'
            )*/
        } 
       /* else if(nominal<=0 || nominal==""){
            $("#lanjut_pembayaran").click();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi jumlah uang pembayaran',
              'warning'
            )
        } */
        else {
            Swal.fire({
                title: 'Proses simpan data !',
                html: 'Mohon tunggu ...',
                allowOutsideClick: false,
                timer: 2000,
                onOpen: () => {
                    Swal.showLoading()
                },
            }).then((ok) => {
            // if (ya.value) {
                var count_data = 0;
                $(".td_kd_tindakan").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_tindakan.php",
                        method: "POST",
                        data: form_data,
                        success:function(data) {
                            Swal.fire({
                              title: 'Berhasil',
                              text: 'Data Berhasil Disimpan',
                              type: 'success',
                              //confirmButtonColor: '#3085d6',
                              //confirmButtonText: 'OK'
                              showConfirmButton: false,
                              timer: 2000
                            }).then((ok) => {
                              //if (ok.value) {
                                window.location.reload(true);                                
                              //}
                            })
                        }
                    })
                } else {
                    alert('Data gagal disimpan, mohon diulangi atau klik tombol Tambah');
                }
              // }
            })
        }
    });
});
</script>
<script type="text/javascript">
    $("button[name='tombol_diagnosa']").click(function() {
        var id = $(this).data('id');
        window.location='?page=form_assesment&id='+id;
      });
    $("button[name='tombol_obatoral']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_obatpasien&id='+id;
      });
    $("button[name='tombol_obatracik']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_obatracik&id='+id;
      });
    
    $("button[name='tombol_laborat']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_laboratpasien&id='+id;
      });
    $("button[name='tombol_riwayat']").click(function() {
        var id = $(this).data('id');
        window.location='?page=riwayatperiksa&id='+id;
    });
    $("button[name='tombol_suratijin']").click(function() {
        var id = $(this).data('id');
        window.location='?page=tambah_ijin&id='+id;
    });

    $("button[name='tombol_suratsehat']").click(function() {
        var id = $(this).data('id');
        window.location='?page=tambah_suratsehat&id='+id;
    });

    $("button[name='tombol_suratsakit']").click(function() {
        var id = $(this).data('id');
        window.location='?page=tambah_suratsakit&id='+id;
    });
    
    $("button[name='tombol_rujuk']").click(function() {
        var id = $(this).data('id');
        window.location='?page=tambah_rujukan&id='+id;
    });

    $("button[name='tombol_swab']").click(function() {
        var id = $(this).data('id');
        window.location='?page=tambah_swabantigen&id='+id;
      });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>