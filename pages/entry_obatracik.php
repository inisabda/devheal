<link rel="stylesheet" href="agoi/select2.min.css">
    <script src="agoi/select2.min.js"></script>
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
            <?php if($_SESSION['posisi_peg'] == 'Dokter5') { ?>
                <a href="?page=perawatan5">
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
                      $tidak_alergi = "Tidak Ada Alergi";
                      $alergi = $data['alergi'];
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
                            <button class="btn btn-warning btn-sm" title="Form Pemberian Obat Racikan" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-mortar-pestle"> Obat Racikan</i></button>
                            <button class="btn-transition btn btn-outline-info btn-sm" title="Form Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-syringe"> Tindakan</i></button>
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
<!-- Awal Isi Halaman Obat Racikan -->
<div class="form-container">
    <div class="row" style="padding: 0 20px;">             
        <div class="col-md-12 vertical-form">
            <form method="post" id="form_pengobatan_racik" autocomplete="off">
                <?php 
                    $tgl_pengobatan = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_pengobatan, 8, 2);
                    $bulan = substr($tgl_pengobatan, 5, 2);
                    $tahun = substr($tgl_pengobatan, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_pengobatan) FROM tbl_racikan WHERE tgl_pengobatan = '$tgl_pengobatan'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_pengobatan = "RO/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                    } else {
                        $no_pengobatan = "RO/".$tgl."/001";
                    }
                 ?>

                <div style="text-align: right;">
                    No ID Resep Racik : <b><?php echo $no_pengobatan; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>
              
                <div class="position-relative row form-group">                                
                    <div class="col-sm-4">
                    	<input name="no_pengobatan" id="no_pengobatan" placeholder="nomor pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo $no_pengobatan; ?>">
                        <input name="tanggal_pengobatan" id="tanggal_pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo $tgl_pengobatan; ?>">
                        <input name="no_daftar" id="no_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $data['no_daftar']; ?>">
                        <input name="nama_pas" id="nama_pas" type="hidden" class="form-control form-control-sm" value="<?php echo $data['nama_pas']; ?>">
                        <input name="nomor_rm" id="nomor_rm" type="hidden" class="form-control form-control-sm" value="<?php echo $data['nomor_rm']; ?>">
                    </div>
                </div>
                <div class="row data-racikan">
                    <div class="position-relative form-group col-md-4">
                        <?php
                            require_once "koneksi.php";
                            $no_daftar = @$_GET['id'];
                            //$nama_racikan = "belum ada data"; 
                            $query_tampil = "SELECT * FROM tbl_periksa WHERE no_daftar='$no_daftar'";
                            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                            $data = mysqli_fetch_array($sql_tampil); 
                            if (isset($data['diagnosa']))
                                {
                                   echo "
                                   <label for='nama_racikan' class=''>Nama Racikan Diagnosa <small>(Penyakit)</small></label>
                                    <div class='input-group'>
                                        <input class='form-control form-control-sm' value='$data[diagnosa]' disabled>
                                    </div>";
                                }
                                else
                                {
                                   echo "
                                   <label for='nama_racikan' class=''>Nama Racikan Diagnosa <small>(Penyakit)</small></label>
                                    <div class='input-group'>
                                        <input class='form-control form-control-sm' value='Nama Diagnosa Belum Dimasukkan' disabled>
                                    </div>";
                                }
                        ?>
                    <div class="input-group">
                        <input type="hidden" class="form-control form-control-sm" id="nama_racikan" name="nama_racikan" value="<?php echo $data['diagnosa']; ?>" >
                    </div>
                    </div>
                    <div class="position-relative form-group col-md-4">
                        <label for="akai" class="">Aturan Minum</label>
                        <div class="input-group">
                            <select type="text" class="theSelect2" id="akai" name="akai">
                            <option value=""></option>';
                                <?php
                                    $query = $conn -> query ("SELECT * FROM tbl_akai");
                                    while ($row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['aturan_pakai'].'">'.$row['aturan_pakai'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="position-relative form-group col-md-4">
                        <label for="jml_puyer" class="">Jumlah Permintaan Puyer</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm" id="jml_puyer" name="jml_puyer" placeholder="Masukkan Jumlah Permintaan Puyer" autofocus="" value="" >
                        </div>
                    </div>
                </div>
                <div class="row kotak-form-tabel-racikan">
                    <div class="col-md-3 kotak-form-obat-terjual" style="display: ;">
                        <div class="position-relative form-group">
                            <label for="kode_obat" class="">Kode Obat</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="kode_obat">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dataobat" id="lihat_data_obat"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="nm_obat" class="">Nama Obat</label>
                            <input name="nm_obat" id="nm_obat" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                            <input type="hidden" id="stok_obat">
                            <input type="hidden" id="exp_obat">
                        </div>
                        <div class="position-relative form-group">
                            <label for="hrg_obat" class="">Harga</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="hrg_obat" name="hrg_obat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="jml_obat" class="">Jumlah</label>
                            <div class="input-group input-group-sm">
                              <input type="number" class="form-control" id="jml_obat" name="jml_obat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="span_satuan">Satuan</span>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="toth_obat" class="">Total Harga</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                </div>
                                <input name="toth_obat" id="toth_obat" placeholder="" type="number" class="form-control form-control-sm" disabled="">
                            </div>
                        </div>
                        <div class="position-relative form-group text-right mt-2 mb-2">
                            <button type="button" class="btn btn-danger btn-sm" id="reset_obat"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="button" class="btn btn-info btn-sm" id="tambah_obat"><i class="fas fa-plus"></i> Tambah</button>
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
                    <div class="col-md-9 kotak-tabel-obat-terjual">
                        <center><h5>--- Komposisi Obat Racikan ---</h5></center>
                        <table class="table display tabel-data">
                            <thead>
                                <tr>
                                    <th class="text-left">Kode</th>
                                    <th class="text-left">Nama</th>
                                    <th class="text-left">Expired</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Satuan</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang_obat">                                
                            </tbody>
                            <tfoot>
                                <tr id="baris_kosong">
                                    <td colspan="7" class="text-center">Belum ada data obat racikan</td>
                                </tr>
                                <tr class="baris_total" style="display: none;">
                                    <td colspan="7" class="text-right" style="font-weight: bold;">Total : Rp. <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                    <td class="td-opsi">
                                        <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua obat" id="hapus_semua_obat">Hapus</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div class="baris_total text-right" style="display: none;">
                            <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">Lanjut pembayaran</button>
                            <button type="button" name="lanjut_pembayaran" id="tambah_obat_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">Tambah obat lagi</button>
                        </div>
                        <div class="form-group row pt-1">
                            <label for="keterangan" class="col-sm-2 col-form-label">Ket. Tambahan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan data bila terdapat permintaan obat (1/2, 3/4) dll." ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center tombol-kanan">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Resep Racikan</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
                </div>
            </form>
        </div>
	</div>
</div>

<!-- Modal Obat Racikan -->
<div class="modal fade" id="modal_dataobat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tabel_dataobat" class="table table-striped display">
            <thead>
                <tr>
                   <th>Kode</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Exp</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query_tampil = "SELECT * FROM tbl_dataobat ORDER BY nm_obat ASC";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    while($data = mysqli_fetch_array($sql_tampil)) {
                 ?>
                    <tr>
                        <td><?php echo $data['kd_obat']; ?></td>
                        <td><button class="btn btn-link" style="padding: 4px; font-size: 11px; text-align: left;" title="Pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal"
                                data-kode="<?php echo $data['kd_obat']; ?>"
                                data-nama="<?php echo $data['nm_obat']; ?>"
                                data-harga="<?php echo $data['hrg_obat']; ?>"
                                data-satuan="<?php echo $data['sat_obat']; ?>"
                                data-stok="<?php echo $data['stk_obat']; ?>"
                                data-exp="<?php echo $data['exp_obat']; ?>">
                            <?php echo $data['nm_obat']; ?></button></td>
                        <td><?php echo $data['hrg_obat']; ?></td>
                        <td><?php echo $data['stk_obat']; ?></td>
                        <td><?php echo $data['sat_obat']; ?></td>
                        <td><?php echo $data['ktg_obat']; ?></td>
                        <td><?php echo $data['exp_obat']; ?></td>
                        <td class="td-opsi">
                            <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal"
                                data-kode="<?php echo $data['kd_obat']; ?>"
                                data-nama="<?php echo $data['nm_obat']; ?>"
                                data-harga="<?php echo $data['hrg_obat']; ?>"
                                data-satuan="<?php echo $data['sat_obat']; ?>"
                                data-stok="<?php echo $data['stk_obat']; ?>"
                                data-exp="<?php echo $data['exp_obat']; ?>"
                            > Pilih
                            </button>
                        </td>
                    </tr>
                 <?php } ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Data Obat Racikan yang sudah diberikan -->
<div class="row" style="padding: 0 16px">
    <div class="col-md-12 vertical-form">
        <h5 align="center"> Data Resep Pemberian Obat Racikan </h5>
        <table id="" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No ID Resep</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php 
                require_once "koneksi.php";
                $no_daftar = @$_GET['id'];
                $tgl_sekarang = date('Y-m-d');
                $totalBayar = 0;
                $nama_racikan = "Belum ada data";
                $keterangan = "Belum ada data";
                $jumlah_puyer = 0;
                $pakai = "Belum ada data";
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.nomor_rm, tbl_racikan.total_penjualan, tbl_racikan.nama_racikan, tbl_racikan.akai, tbl_racikan.keterangan, tbl_racikan.jml_puyer, tbl_racikan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_racikandetail
                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                  LEFT JOIN tbl_dataobat ON tbl_racikandetail.kd_obat=tbl_dataobat.kd_obat

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
                    $subtotal   = $data_pjlobat['subtotal'];
                    $totalBayar = $totalBayar + $subtotal;
                    $total_racik = $data_pjlobat['total_penjualan'];
                    $nama_racikan = $data_pjlobat['nama_racikan'];
                    $keterangan = $data_pjlobat['keterangan'];
                    $jumlah_puyer = $data_pjlobat['jml_puyer'];
                    $pakai = $data_pjlobat['akai'];
                    $nomor_rm = $data_pjlobat['nomor_rm'];
            ?>
                <tr>
                    <td><?php echo $data_pjlobat['no']; ?></td> 
                    <td><?php echo $data_pjlobat['no_pengobatan']; ?></td> 
                    <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                    <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
                    <td class="td-opsi">
                        <!-- </a> -->
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data_pjlobat['no']; ?>" data-nama="<?php echo $data_pjlobat['nm_obat']; ?>"
                            data-stok="<?php echo $data_pjlobat['jml_jual']; ?>"
                            data-subtot="<?php echo $data_pjlobat['subtotal']; ?>"
                            data-exp="<?php echo $data_pjlobat['expired']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right" bgcolor="#F5F5F5">Total Obat Racik:</td>
                <td colspan="3" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
            </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td width="130"><b>Nama Racikan</b></td>
                <td width="10"><b> :</b></td>
                <td> <?php echo $nama_racikan; ?> <small>(Nama dari diagnosa)</small></td>
            </tr>
            <tr>
                <td width="130"><b>Jumlah Puyer</b></td>
                <td width="10"><b> :</b></td>
                <td> <?php echo $jumlah_puyer; ?> Bungkus</td>
            </tr>
            <tr>
                <td width="130"><b>Aturan Minum</b></td>
                <td width="10"><b> :</b></td>
                <td> <?php echo $pakai; ?></td>
            </tr>
            <tr>
                <td width="130"><b>Keterangan</b></td>
                <td width="10"><b> :</b></td>
                <td><font color='#d33'> <?php echo $keterangan; ?></font></td>
            </tr>
        </table>
    </div>
</div>
<!-- Data riwayat obat racikan -->
<br>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12 vertical-form table-responsive">          
        <h5><center><font style = "font-size:18px; color:red;"><i class="fas fa-pills"></i> Riwayat Pemberian Obat Terakhir</font></center></h5>
            <div class="table-container">
                <div class="row">
                    <div class="col-md-12">
                        <table id="" class="table table-striped display tabel-data">
                        <thead>
                            <tr class="bg-info">
                                <th>No.</th>
                                <th>No. Registrasi</th>
                                <th>No. Resep Racikan</th>
                                <th>Diagnosa</th>
                                <th>Tgl Berobat</th>
                                <th>Nama Pasien</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $nomor_rm = $nomor_rm;
                                $query_tampil = "SELECT * FROM tbl_racikan WHERE nomor_rm='$nomor_rm' order by tgl_pengobatan DESC LIMIT 2"  ;
                                $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                                while($data = mysqli_fetch_assoc($sql_tampil)) {
                            ?>
                            <tr>
                                <td><?php echo $no++."."; ?></td>
                                <td><?php echo $data['no_daftar']; ?></td>
                                <td><?php echo $data['no_pengobatan']; ?></td>
                                <td><?php echo $data['nama_racikan']; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($data['tgl_pengobatan'])); ?></td>
                                <td><?php echo ($data['nama_pas']); ?></td>
                                <td class="td-opsi">
                                    <button class="btn-transition btn btn-outline-danger btn-sm" title="Riwayat Obat" id="cari_riwayat" name="cari_riwayat" data-id="<?php echo $data['no_daftar']; ?>">Detail Riwayat Obat</button>
                                    </td>          
                            </tr>
                                <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <ul id="hasil">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Script Obat Racikan -->
<script>
    $("button[name='tombol_detailracikan']").click(function() {
        var kd_racik = $(this).data("kd_racik");
        var tgl_racik = $(this).data("tgl_racik");
        var nama_racikan = $(this).data("nama_racikan");
        var stk_obat = $(this).data("stk_obat");
    $("#kd_racikdetail").html(kd_racik);
    $("#tgl_racikdetail").html(tgl_racik);
    $("#nama_racikandetail").html(nama_racikan);
    $("#stk_obatdetail").html(stk_obat);
    $("#data_detailracikan").html("");
    $.ajax({
        type: "GET",
        url: "ajax/detail.php?page=racikan",
        data: "kd_racik="+kd_racik,
        success : function(data) {
            // console.log(data);
        var total_pembelian = 0;
            var objData = JSON.parse(data);
            $.each(objData, function(key,val){
                // $("#data_detailpjl").append(val.nm_obat+"/"+val.hrg_jual+"/"+val.jml_jual+"/"+val.sat_jual+"/"+val.subtotal+"<br>");
                var baris_baru = '';
                baris_baru += '<tr>';
                baris_baru += '<td>'+val.nm_obat+'</td>';
                baris_baru += '<td class="text-right" width="80">Rp. '+val.hrg_jual+'</td>';
                baris_baru += '<td class="text-center">'+val.jumlah+'</td>';
                baris_baru += '<td>'+val.sat_jual+'</td>';
                baris_baru += '<td class="text-right" width="90">Rp. '+val.subtotal+'</td>';
                baris_baru += '</tr>';
                total_pembelian = total_pembelian + Number(val.subtotal);
                $("#data_detailracikan").append(baris_baru);
                $("#total_pembeliandetail").html(total_pembelian);

            })
        }
    });
});
</script>

<script type="text/javascript">

        $("button[name='tombol_hapus']").click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        //var exp = $(this).data('exp');
        var stok = $(this).data('stok');
        var subtot = $(this).data('subtot');
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
              text: 'Menghapus obat '+nama+', jumlah obat '+stok+' dan subtotal Rp. '+subtot+'? Semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((hapus) => {
              if (hapus.value) {
                $.ajax({
                  type: "POST",
                  url: "ajax/hapus.php?page=entry_obatracik",
                  data: "id="+id+"&stok="+stok+"&subtot="+subtot,
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
</script>

<script>
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
        $("#kode_obat").val("");
        $("#nm_obat").val("");
        $("#hrg_obat").val("");
        $("#jml_obat").val("");
        $("#span_satuan").text("Satuan");
        $("#toth_obat").val("");
        $("#stok_obat").val("");
        $("#exp_obat").val("");
    }

    function jml_obat() {
        var jml = Number($("#jml_obat").val());
        var harga = Number ($("#hrg_obat").val());
        if (jml>=0) {
            var sub_total = jml*harga;
            $("#toth_obat").val(sub_total);
        } else {
            $("#toth_obat").val("");
        }
    }
    function hrg_obat() {
        var jml = Number($("#jml_obat").val());
        var harga = Number ($("#hrg_obat").val());
        if (harga>=0) {
            var sub_total = jml*harga;
            $("#toth_obat").val(sub_total);
        } else {
            $("#toth_obat").val("");
        }
    }

    $("button[name='tombol_pilihobat']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var satuan = $(this).data('satuan');
        var stok = $(this).data('stok');
        var exp = $(this).data('exp');

        $("#kode_obat").val(kode);
        $("#nm_obat").val(nama);
        $("#stok_obat").val(stok);
        $("#exp_obat").val(exp);
        $("#hrg_obat").val(harga);
        $("#span_satuan").text(satuan);
        $("#jml_obat").val(1);
        $("#toth_obat").val(harga);
    });

    $("#kode_obat").click(function() {
        $("#lihat_data_obat").click();
    });

    $("#kode_obat").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#hrg_obat").keyup(function() { hrg_obat(); });
    $("#hrg_obat").change(function() { hrg_obat(); });
    $("#jml_obat").keyup(function() { jml_obat(); });
    $("#jml_obat").change(function() { jml_obat(); });

    $("#reset_obat").click(function() {
        reset();
    });

    $("#tambah_obat").click(function() {
        var kode = $("#kode_obat").val();
        var nama = $("#nm_obat").val();
        var stok = Number($("#stok_obat").val());
        var exp = $("#exp_obat").val();
        var akai = $("#akai").val();
        var harga = $("#hrg_obat").val();
        var jumlah = Number($("#jml_obat").val());
        var satuan = $("#span_satuan").text();
        var subtotal = Number($("#toth_obat").val());

        if(kode=="") {
            document.getElementById("lihat_data_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("hrg_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi harga obat dengan benar',
              'warning'
            )
        } else if(jumlah=="" || jumlah<=0) {
            document.getElementById("jml_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi jumlah obat dengan benar',
              'warning'
            )
        } else if(subtotal=="" || subtotal<=0 || subtotal<harga) {
            document.getElementById("toth_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi total harga dengan benar',
              'warning'
            )
        } else if(jumlah>stok) {
            document.getElementById("toth_obat").focus();
            Swal.fire(
              'Stok tidak cukup !',
              'Maaf, jumlah '+jumlah+' stok tidak mencukupi. stok yang tersedia sebanyak '+stok+' '+satuan,
              'warning'
            )
        } else {
            // alert(kode+" / "+nama+" / "+harga+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdobat[]" id="td_kd_obat'+count+'" class="td_kd_obat" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmobat[]" id="td_nmobat'+count+'" class="td_nmobat" value="'+nama+'"></td>';
            output += '<td>'+exp+' <input type="hidden" name="hidden_expobat[]" id="td_expobat'+count+'" class="td_expobat" value="'+exp+'"></td>';
            output += '<td class="text-right">Rp. '+harga+' <input type="hidden" name="hidden_hrgobat[]" id="td_hrgobat'+count+'" class="td_hrgobat" value="'+harga+'"></td>';
            output += '<td class="text-center">'+jumlah+' <input type="hidden" name="hidden_jmlobat[]" id="td_jmlobat'+count+'" class="td_jmlobat" value="'+jumlah+'"></td>';
            output += '<td class="text-center">'+satuan+' <input type="hidden" name="hidden_satobat[]" id="td_satobat'+count+'" class="td_satobat" value="'+satuan+'"></td>';
            output += '<td class="text-right">Rp. '+subtotal+' <input type="hidden" name="hidden_subtotal[]" id="td_subtotal'+count+'" class="td_subtotal" value="'+subtotal+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_obat btn-transition btn btn-outline-danger btn-sm" name="hapus_obat" id="'+count+'" title="hapus obat ini">hapus</button></td>';
            output += '</tr>';
            $("#keranjang_obat").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

    $(document).on("click", ".hapus_obat", function() {
        var row_id = $(this).attr("id");
        var subtotal = Number($("#td_subtotal"+row_id).val());

        total_penjualan = total_penjualan-subtotal;
        $("#total_penjualan").text(total_penjualan);
        $("#hidden_totalpenjualan").val(total_penjualan);
        $("#total_pembayaran").text(total_penjualan);
        $("#row_"+row_id).remove();
        if(total_penjualan==0)
        {
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_obat_lagi").click();
        }
    });

    $("#hapus_semua_obat").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar obat',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_obat > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_obat_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-obat-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_obat_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_obat_lagi").click(function() {
        // alert();
        $(".kotak-form-obat-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_obat_lagi").hide();
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

    $("#form_pengobatan_racik").on("submit", function(event){
        event.preventDefault();
        var no_pengobatan = $("#no_pengobatan").val();
        var tanggal_pengobatan = $("#tanggal_pengobatan").val();
        var akai = $("#akai").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nama_pas = $("#nama_pas").val();
        var nomor_rm = $("#nomor_rm").val();
        var jml_puyer = $("#jml_puyer").val();
        var no_daftar = $("#no_daftar").val();
        var nama_racikan = $("#nama_racikan").val();
        var keterangan = $("#keterangan").val();
        
        if(akai=="") {
            document.getElementById("akai").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'Maaf, tolong isi Aturan Minum Obat',
              'warning'
            )
        } else if(jml_puyer==""){
            document.getElementById("jml_puyer").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'Maaf, tolong isi jumlah puyer',
              'warning'
            )

        } else if(total_penjualan==0){
            document.getElementById("lihat_data_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi daftar obat',
              'warning'
            )
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
                $(".td_kd_obat").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_racikan.php",
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
                    alert('Data gagal disimpan, mohon diulangi');
                }
              // }
            })
        }
    });
});
</script>
<script>
    $(".theSelect2").select2({
        placeholder: "Aturan Minum Puyer", 
        width: '100%',
        allowClear: true
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
    
    $("button[name='tombol_tindakan']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_tindakanpasien&id='+id;
      });
    $("button[name='tombol_laborat']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_laboratpasien&id='+id;
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
    $("button[name='cari_riwayat']").click(function() {
        var id = $(this).data('id');
          if(id!=""){
                $("#hasil").html("<div align='center'><button class='btn btn-warning btn-sm' disabled><span class='spinner-border spinner-border-sm'></span> Loading...</button></div>");
                $.ajax({
                    type:"GET",
                    url:"ajax/cariRiwayat_racik.php",
                    data:"id="+id,
                    success:function(data){
                        setTimeout(function(){ 
                           $("#hasil").html(data);
                        }, 1000);
                        $("#cari_riwayat").val("");
                    }
                });
            }
      });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>