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
            <?php if($_SESSION['posisi_peg'] == 'Dokter3') { ?>
                <a href="?page=perawatan3">
                <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
            </a>
            <?php } ?>
            <?php if($_SESSION['posisi_peg'] == 'Dokter4') { ?>
                <a href="?page=perawatan4">
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
                          <button class="btn-transition btn  btn-outline-info  btn-sm" title="Kunjungan Pasien" id="tombol_kunjungan" name="tombol_kunjungan" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-user"> Kunjungan</i></button>
                          <button class="btn-transition btn btn-outline-info btn-sm" title="Form Assesment Pasien" id="tombol_obatoral" name="tombol_obatoral" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-pills"> Obat Non racikan</i></button>
                          <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Racikan" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-mortar-pestle"> Obat Racikan</i></button>
                          <button class="btn-transition btn btn-outline-info btn-sm" title="Form Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-syringe"> Tindakan</i></button>
                          <button class="btn btn-warning btn-sm" title="Form Laborat Pasien" id="tombol_laborat" name="tombol_laborat" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-flask"> Laborat</i></button>
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
    <!-- Halaman Isi Laborat -->
    <form method="post" id="form_laborat" autocomplete="off">
        <div class="row" style="padding: 0 20px;">
            <div class="col-md-12 vertical-form">
                <?php 
                    $tgl_lab = gmdate('Y-m-d', time() + 60 * 60 * 7);
                    $hari= substr($tgl_lab, 8, 2);
                    $bulan = substr($tgl_lab, 5, 2);
                    $tahun = substr($tgl_lab, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_lab) FROM tbl_lab WHERE tgl_lab = '$tgl_lab'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_lab = "LAB/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                    } else {
                        $no_lab = "LAB/".$tgl."/001";
                    }
                 ?>

                <div style="text-align: right;">
                    No ID Laborat : <b><?php echo $no_lab; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>              
                <div class="position-relative row form-group">
                    <div class="col-sm-4">
                        <input name="no_lab" id="no_lab" placeholder="nomor Laborat" type="hidden" class="form-control form-control-sm" value="<?php echo $no_lab; ?>">
                        <input name="tgl_lab" id="tgl_lab" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" class="form-control form-control-sm" id="nomor_rm" name="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" readonly>
                        <input type="hidden" class="form-control form-control-sm" id="nama_pas" name="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" readonly>
                        <input type="hidden" class="form-control form-control-sm" id="no_daftar" name="no_daftar" value="<?php echo $data['no_daftar']; ?>" readonly>
                    </div>
                </div>
                <div class="row kotak-form-tabel-laborat">
                    <div class="col-md-3 kotak-form-laborat-terjual" style="display: ;">
                        <div class="position-relative form-group pt-1">
                            <label for="dokter" class="">Dokter </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="nm_dokter" name="nm_dokter" value="<?php echo $data['nm_dokter']; ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dokter" id="lihat_data_dokter"><i class="fas fa-stethoscope"></i></i></button>
                                </div>
                            </div>
                       
                            <label for="kode_lab" class="">Kode Laborat</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="kode_lab">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datalaborat" id="lihat_data_laborat"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        
                            <label for="nm_lab" class="">Nama Laborat</label>
                            <input name="nm_lab" id="nm_lab" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                        
                            <label for="hrg_lab" class="">Harga</label>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                              </div>
                              <input type="number" class="form-control" id="hrg_lab" name="hrg_lab" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        
                            <label for="hasil_lab" class="">Hasil Laborat</label>
                            <div class="input-group input-group-sm">                              
                                <input type="text" class="form-control" id="hasil_lab" name="hasil_lab">
                            </div>
                        </div>
                        
                        <div class="position-relative form-group text-right pt-1 mb-2">
                            <button type="button" class="btn btn-danger btn-sm" id="reset_laborat"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="button" class="btn btn-info btn-sm" id="tambah_laborat"><i class="fas fa-plus"></i> Tambah</button>
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
                    <div class="col-md-9 kotak-tabel-laborat-terjual">
                        <table class="table display tabel-data">
                            <thead>
                                <tr>
                                    <th class="text-left">Kode</th>
                                    <th class="text-left">Jenis Pemeriksaan Laborat </th>
                                    <th class="text-left">Harga Pemeriksaan Laborat</th>
                                    <th class="text-left">Hasil Laborat</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang_laborat">
                                
                            </tbody>
                            <tfoot>
                                <tr id="baris_kosong">
                                    <td colspan="5" class="text-center">Belum ada data pemeriksaan laborat</td>
                                </tr>
                                <tr class="baris_total" style="display: none;">
                                    <td colspan="3" class="text-right" style="font-weight: bold;">Total : <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                    <td class="td-opsi">
                                        <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua laborat" id="hapus_semua_laborat">Hapus</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="baris_total text-right" style="display: none;">
                            <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">Lanjut pembayaran</button>
                            <button type="button" name="lanjut_pembayaran" id="tambah_laborat_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">Tambah laborat lagi</button>
                        </div>
                    </div>
                </div>
                <div class="text-center tombol-kanan">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Laborat</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12 vertical-form">
            <h5 align="center"> Hasil Pemeriksaan Laborat Pasien</h5>                
            <table  id="" class="table table-striped display tabel-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Reg Laborat</th>
                        <th>Dokter</th>
                        <th>Nama Laborat</th>
                        <th>Hasil Laborat</th>
                        <th>Harga Laborat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php 

                $no_daftar = @$_GET['id'];

                    //$tgl_sekarang = date('Y-m-d');
                    $totalBayar = 0;
                    $nomor = 1;
                    $query_lab = "SELECT tbl_labdetail.*, tbl_labdetail.kode_lab,tbl_labdetail.kode_lab, tbl_lab.no_daftar,tbl_lab.nm_dokter, laborat.kode_lab, laborat.nm_lab FROM tbl_labdetail
                      LEFT JOIN tbl_lab ON tbl_labdetail.no_lab=tbl_lab.no_lab
                      LEFT JOIN laborat ON tbl_labdetail.kode_lab=laborat.kode_lab

                    WHERE no_daftar ='$no_daftar' ";
                    $sql_lab = mysqli_query($conn, $query_lab) or die ($conn->error);
                 ?>
                <tbody>
                <?php  
                    while($data_lab = mysqli_fetch_array($sql_lab)) {
                        $subtotal   = $data_lab['hrg_lab'];
                        $totalBayar = $totalBayar + $subtotal;
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $data_lab['no_lab']; ?></td>
                        <td><?php echo $data_lab['nm_dokter']; ?></td>
                        <td><?php echo $data_lab['nm_lab']; ?></td>
                        <td class="text-center"><?php echo $data_lab['hasil_lab']; ?></td>
                        <td>Rp. <?php echo number_format($data_lab['hrg_lab'],2,',','.'); ?></td>
                        <td class="td-opsi">
                            <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data_lab['no']; ?>" data-nama="<?php echo $data_lab['nm_lab']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="5" align="right" bgcolor="#F5F5F5">Total Laborat :</td>
                        <td colspan="2" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Akhir Isi Halaman Laborat -->

<!-- Modal Cari data Laborat-->
<div class="modal fade" id="modal_datalaborat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Laborat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Laborat</th>
                            <th>Harga Laborat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            require_once "koneksi.php";
                            $query_tampil = "SELECT * FROM laborat ";
                                /* $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/
                            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                            while($data = mysqli_fetch_array($sql_tampil)) {
                         ?>
                        <tr>
                            <td><?php echo $data['kode_lab']; ?></td>
                            <td><?php echo $data['nm_lab']; ?></td>
                            <td><?php echo $data['hrg_lab']; ?></td>
                            <td class="td-opsi">
                                <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihlaborat" name="tombol_pilihlaborat" data-dismiss="modal"
                                    data-kode="<?php echo $data['kode_lab']; ?>"
                                    data-nama="<?php echo $data['nm_lab']; ?>"
                                    data-harga="<?php echo $data['hrg_lab']; ?>"
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
<!-- Moda Cari Data Dokter -->
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



<script>
    $("button[name='tombol_hapus']").click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        // alert(id);
        if(id==id_session) {
            Swal.fire({
              title: 'Error !',
              text: 'Anda tidak bisa menghapus data anda sendiri, mintalah admin atau manajer untuk menghapusnya',
              type: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((baik) => {
              if (baik.value) {

              }
            })
        } else {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: 'Menghapus pemeriksaan lab '+nama+'',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((hapus) => {
              if (hapus.value) {
                $.ajax({
                  type: "POST",
                  url: "ajax/hapus.php?page=entry_laborat",
                  data: "id="+id+"&nama="+nama,
                  success: function(hasil) {
                    Swal.fire({
                      title: 'Berhasil',
                      text: 'Data Berhasil Dihapus',
                      type: 'success',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                    }).then((ok) => {
                      if (ok.value) {
                        //window.location='?page=perawatan';
                        window.location.reload(true);
                      }
                    })
                  }
                })  
              }
            })
        }
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
        $("#kode_lab").val("");
        $("#nm_lab").val("");
        $("#hrg_lab").val("");
        $("#hasil_lab").val("");
    }

    $("button[name='tombol_pilihdokter']").click(function() {
        var kd = $(this).data('kd');
        var nm = $(this).data('nm');
       

        $("#kd_dokter").val(kd);
        $("#nm_dokter").val(nm);
    });
 

    $("button[name='tombol_pilihlaborat']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
       

        $("#kode_lab").val(kode);
        $("#nm_lab").val(nama);
        $("#hrg_lab").val(harga);
    });

    $("#nm_dokter").click(function() {
        $("#lihat_data_dokter").click();
    });

    $("#kode_lab").click(function() {
        $("#lihat_data_laborat").click();
    });

    $("#kode_lab").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#hrg_lab").keyup(function() { hrg_lab(); });

    $("#reset_laborat").click(function() {
        reset();
    });

    $("#tambah_laborat").click(function() {
        var kode = $("#kode_lab").val();
        var nama = $("#nm_lab").val();
        var harga = $("#hrg_lab").val();
        var hasil = $("#hasil_lab").val();

        if(kode=="") {
            document.getElementById("lihat_data_laborat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("hrg_lab").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi harga laborat dengan benar',
              'warning'
            )
        } else {
            // alert(kode+" / "+nama+" / "+harga+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kode_lab[]" id="td_kode_lab'+count+'" class="td_kode_lab" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nm_lab[]" id="td_nm_lab'+count+'" class="td_nm_lab" value="'+nama+'"></td>';
            output += '<td>Rp. '+harga+' <input type="hidden" name="hidden_hrg_lab[]" id="td_hrg_lab'+count+'" class="td_hrg_lab" value="'+harga+'"></td>';
            output += '<td class="text-center">'+hasil+' <input type="hidden" name="hidden_hasil_lab[]" id="td_hasil_lab'+count+'" class="td_hasil_lab" value="'+hasil+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_laborat btn-transition btn btn-outline-danger btn-sm" name="hapus_laborat" id="'+count+'" title="hapus laborat ini">Hapus</button></td>';
            output += '</tr>';
            $("#keranjang_laborat").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

    $(document).on("click", ".hapus_laborat", function() {
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
            $("#tambah_laborat_lagi").click();
        }
    });

    $("#hapus_semua_laborat").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar laborat',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_laborat > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_laborat_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-laborat-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_laborat_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_laborat_lagi").click(function() {
        // alert();
        $(".kotak-form-laborat-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_laboratlagi").hide();
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

    $("#form_laborat").on("submit", function(event){
        event.preventDefault();
        var no_lab = $("#no_lab").val();
        var tgl_lab = $("#tgl_lab").val();
        var no_daftar = $("#no_daftar").val();
       

        var nama_pas = $("#nama_pas").val();
        var nomor_rm = $("#nomor_rm").val();
        var nm_dokter = $("#nm_dokter").val();
     


        if(no_lab=="") {
            document.getElementById("no_lab").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor laborat',
              'warning'
            )
        } else 
        if(hasil_lab==""){
            document.getElementById("hasil_lab").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'Maaf, tolong isi hasil pemeriksaan laborat',
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
                $(".td_kode_lab").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_ceklaborat.php",
                        method: "POST",
                        data: form_data,
                        success:function(data) {
                            Swal.fire({
                              title: 'Berhasil',
                              text: 'Data Berhasil Disimpan',
                              type: 'success',
                              confirmButtonColor: '#3085d6',
                              confirmButtonText: 'OK'
                            }).then((ok) => {
                              if (ok.value) {
                                // window.location='?page=entry_datapenjualan';
                                //window.location='?page=perawatan';
                                window.location.reload(true);
                                
                              }
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
    
    $("button[name='tombol_tindakan']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_tindakanpasien&id='+id;
      });
    $("button[name='tombol_riwayat']").click(function() {
        var id = $(this).data('id');
        window.location='?page=riwayatperiksa&id='+id;
    });
    
    $("button[name='tombol_kunjungan']").click(function() {
        var id = $(this).data('id');
        window.location='?page=form_kunjungan&id='+id;
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