<link rel="stylesheet" href="agoi/select2.min.css">
<script src="agoi/select2.min.js"></script>
<?php
$no_daftar = @$_GET['id'];

// $poli_pcare = null;
$poli_pcare = getRequestPcare("pcare/poli/1/100");
if ($poli_pcare != null) {
  $poli_pcare = json_decode($poli_pcare);
}

// $kdsadar_pcare = null;
$kdsadar_pcare = getRequestPcare("pcare/kesadaran");
if ($kdsadar_pcare != null) {
  $kdsadar_pcare = json_decode($kdsadar_pcare);
}

// $statuspulang_pcare = null;
$statuspulang_pcare = getRequestPcare("pcare/status-pulang/false");
if ($statuspulang_pcare != null) {
  $statuspulang_pcare = json_decode($statuspulang_pcare);
}

// $dokter_pcare = null;
$dokter_pcare = getRequestPcare("pcare/dokter/1/15");
if ($dokter_pcare != null) {
  $dokter_pcare = json_decode($dokter_pcare);
}

// $sarana_pcare = null;
$sarana_pcare = getRequestPcare("pcare/sarana");
if ($sarana_pcare != null) {
  $sarana_pcare = json_decode($sarana_pcare);
}

$spesialis_pcare = null;
$spesialis_pcare = getRequestPcare("pcare/spesialis");
if ($spesialis_pcare != null) {
  $spesialis_pcare = json_decode($spesialis_pcare);
}

$kdtacc =  [
  [
    'kdTacc' => '-1',
    'nmTacc' => 'Tanpa TACC',
    'alasanTacc' =>  []
  ],
  [
    'kdTacc' => '1',
    'nmTacc' => 'Time',
    'alasanTacc' =>
    [
      '< 3 Hari',  '>= 3 - 7 Hari',  '>= 7 Hari',
    ],
  ],
  [
    'kdTacc' => '2',
    'nmTacc' => 'Age',
    'alasanTacc' => [
      '< 1 Bulan', '>= 1 Bulan s/d < 12 Bulan', '>= 1 Tahun s/d < 5 Tahun', '>= 5 Tahun s/d < 12 Tahun', '>= 12 Tahun s/d < 55 Tahun', '>= 55 Tahun',
    ],
  ],
  [
    'kdTacc' => '3',
    'nmTacc' => 'Complication',
    'alasanTacc' =>  [],
  ],
  [
    'kdTacc' => '4',
    'nmTacc' => 'Comorbidity',
    'alasanTacc' =>
    ['< 3 Hari', '>= 3 - 7 Hari',  '>= 7 Hari',],
  ],
];

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6">
      <h4><i class="fas fa-file-signature"></i> Form Kunjungan</h4>
    </div>
    <div class="col-6 text-right">
      <?php if ($_SESSION['posisi_peg'] == 'Dokter2') { ?>
        <a href="?page=perawatan2">
          <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
        </a>
      <?php } ?>
      <?php if ($_SESSION['posisi_peg'] == 'Dokter') { ?>
        <a href="?page=perawatan">
          <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
        </a>
      <?php } ?>
      <?php if ($_SESSION['posisi_peg'] == 'Dokter3') { ?>
        <a href="?page=perawatan3">
          <button class="btn btn-sm btn-danger"><i class="fas fa-list"></i> List Pasien <?php echo $_SESSION['nama_peg']; ?></button>
        </a>
      <?php } ?>
    </div>
  </div>
  <div class="row" style="padding: 0 20px;">
    <div class="col-md-12 vertical-form">
      <div class="row data-assesment">
        <?php

        $query_tampil = "SELECT * FROM tbl_daftarpasien LEFT JOIN pendaftaran_pcare on tbl_daftarpasien.no_daftar = pendaftaran_pcare.no_daftar WHERE tbl_daftarpasien.no_daftar='$no_daftar' ";
        $sql_tampil = mysqli_query($conn, $query_tampil) or die($conn->error);
        $datapas = mysqli_fetch_array($sql_tampil);
        $nomor_rm = $datapas['nomor_rm'];
        $nama_pasien = $datapas['nama_pas'];
        $alergi = $datapas['alergi'];
        $tidak_alergi = "tidak ada";
        //Fungsi Menghitung Umur Pasien
        $tanggal_lahir = new DateTime($datapas['lhr_pas']);
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
              <td><?php echo $datapas['no_daftar']; ?></td>
              <td>Alergi :
                <?php
                $tidak_alergi = "Tidak Ada Alergi";
                if ($datapas['alergi']) { ?>
                  <span class="badge badge-pill badge-warning" style="padding: 8px; font-size: 11px;"><?php echo $datapas['alergi']; ?></span>
                <?php } else if ($datapas['alergi'] == '') { ?>
                  <span class="badge badge-pill badge-success" style="padding: 8px; font-size: 11px;"><?php echo $tidak_alergi; ?></span>
                <?php }
                ?>
              </td>
            </tr>
            <tr>
              <td width="100"><b>Nomor RM</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['nomor_rm']; ?></td>
            </tr>
            <tr>
              <td width="100"><b>Nama Pasien</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['nama_pas']; ?></td>
              <td><?php echo $datapas['jk_pas']; ?></td>
            </tr>
            <tr>
              <td width="100"><b>TTL Pasien</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['tpt_lahir']; ?>, <?php echo date('d-m-Y', strtotime($datapas['lhr_pas'])); ?> (<?php echo $thn . " tahun " . $bln . " bulan "; ?>)</td>
            </tr>
            <tr>
              <td width="100"><b>Agama</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['agama']; ?></td>
            </tr>
            <tr>
              <td width="100"><b>Alamat</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['alm_pas']; ?></td>
            </tr>
            <tr>
              <td width="100"><b>Cara Bayar</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['asuransi_pas']; ?></td>
            </tr>
            <tr>
              <td width="100"><b>Dokter</b></td>
              <td width="10">:</td>
              <td><?php echo $datapas['nm_dokter']; ?></td>
            </tr>

          </table>
          <table class="data_pasien mt-3" border="0" cellpadding="0">
            <tr>
              <td>
                <button class="btn-transition btn btn-outline-info btn-sm" title="Form Assesment Pasien" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-stethoscope"> Assesment</i></button>
                <button class="btn btn-warning btn-sm" title="Kunjungan Pasien" id="tombol_kunjungan" name="tombol_kunjungan" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-user"> Kunjungan</i></button>
                <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Non Racikan" id="tombol_obatoral" name="tombol_obatoral" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-pills"> Obat Non racikan</i></button>
                <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Racikan" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-mortar-pestle"> Obat Racikan</i></button>
                <button class="btn-transition btn btn-outline-info btn-sm" title="Form Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-syringe"> Tindakan</i></button>
                <button class="btn-transition btn btn-outline-info btn-sm" title="Form Laborat Pasien" id="tombol_laborat" name="tombol_laborat" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-flask"> Laborat</i></button>
                <button class="btn-transition btn btn-outline-danger btn-sm" title="Riwayat Berobat Pasien" id="tombol_riwayat" name="tombol_riwayat" data-id="<?php echo $datapas['nomor_rm']; ?>"><i class="fas fa-receipt"> Riwayat Berobat</i></button>
                <div class="btn-group dropright">
                  <button class="btn-transition btn btn-outline-danger btn-sm dropdown" type="button" title="Cetak Surat" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope"> Cetak Surat</i></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item" id="tombol_suratijin" name="tombol_suratijin" data-id="<?php echo $datapas['no_daftar']; ?>">Surat Ijin Sakit</button>
                    <button class="dropdown-item" id="tombol_suratsehat" name="tombol_suratsehat" data-id="<?php echo $datapas['no_daftar']; ?>">Surat Keterangan Sehat</button>
                    <button class="dropdown-item" id="tombol_suratsakit" name="tombol_suratsakit" data-id="<?php echo $datapas['no_daftar']; ?>">Surat Keterangan Sakit</button>
                    <button class="dropdown-item" id="tombol_rujuk" name="tombol_rujuk" data-id="<?php echo $datapas['no_daftar']; ?>">Rujuk Pasien</button>
                    <button class="dropdown-item" id="tombol_swab" name="tombol_swab" data-id="<?php echo $datapas['no_daftar']; ?>">Surat Keterangan SWAB</button>
                    <button class="dropdown-item" id="tombol_narkoba" name="tombol_narkoba" data-id="<?php echo $datapas['no_daftar']; ?>">Surat Ket. Narkoba</button>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="form-container">
    <div class="row" style="padding: 0 20px;">
      <div class="col-md-12 vertical-form">
        <form method="post" id="simpan_kunjungan" autocomplete="off">
          <div class="row">
             <div class="col-sm-12">
              <a class="btn btn-sm btn-primary my-2 mx-2" href="<?= urlBridging()."pcare/cetakKunjungan/".$datapas['no_rujukan'] ?>">Cetak Kunjungan/Rujukan</a>
             </div>
            <div class="col-sm-6">


              <div class="form-group row">

                <label class="col-sm-2 col-form-label">Tgl Daftar</label>
                <div class="col-sm-10">
                  <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control form-control-sm" value="<?= $datapas['tgl_daftar'] ?>">
                </div>
              </div>

              <div class="form-group row">



                <label class="col-sm-2 col-form-label">Poli</label>
                <div class="col-sm-10">
                  <select name="kd_poli" class="form-control form-control-sm" id="kd_poli">

                    <option value="">-- Pilih Poli --</option>
                    <?php
                    if ($poli_pcare != null) {
                      if ($poli_pcare->metaData->code == 200) {
                        for ($i = 0; $i < $poli_pcare->response->count; $i++) {
                          echo "<option value='" . $poli_pcare->response->list[$i]->kdPoli . "' >" . $poli_pcare->response->list[$i]->nmPoli . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" value="<?= $datapas['keluhan'] ?>" name="keluhan" id="keluhan" placeholder="Keluhan Pasien">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kesadaran</label>
                <div class="col-sm-10">
                  <select name="kd_sadar" class="form-control form-control-sm" id="kd_sadar">
                    <option value="">-- Pilih Kesadaran --</option>
                    <?php
                    if ($kdsadar_pcare != null) {
                      if ($kdsadar_pcare->metaData->code == 200) {
                        for ($i = 0; $i < $kdsadar_pcare->response->count; $i++) {
                          echo "<option value='" . $kdsadar_pcare->response->list[$i]->kdSadar . "' >" . $kdsadar_pcare->response->list[$i]->nmSadar . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-10">
                  <input type="number" value="<?= $datapas['berat_badan'] == null ? '' : $datapas['berat_badan'] ?>" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="Masukkan BB">
                </div>
              </div>
              <!-- <div class="form-group row">
                <label for="temp" class="col-sm-2 col-form-label">Temperatur</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="temp" id="temp" placeholder="suhu tubuh">
                </div>
              </div> -->
              <div class="form-group row">
                <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                <div class="col-sm-10">
                  <input type="number" value="<?= $datapas['tinggi_badan'] ?>" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan TB">
                </div>
              </div>
              <div class="form-group row">
                <label for="tekanan_darah_sistole" class="col-sm-2 col-form-label">Tekanan Darah</label>
                <div class="col-sm-2">
                  <input type="text" value="<?= $datapas['sistole'] ?>" class="form-control form-control-sm" name="tekanan_darah_sistole" id="tekanan_darah_sistole" placeholder="Sistole">
                </div>
                <div class="col-sm-2">
                  <input type="text" value="<?= $datapas['diastole'] ?>" class="form-control form-control-sm" name="tekanan_darah_diastole" id="tekanan_darah_diastole" placeholder="Diastole">
                </div>
              </div>
              <div class="form-group row">
                <label for="frekwensi_nafas" class="col-sm-2 col-form-label">Frekwensi Nafas</label>
                <div class="col-sm-10">
                  <input type="text" value="<?= $datapas['resp_rate'] ?>" class="form-control form-control-sm" name="frekwensi_nafas" id="frekwensi_nafas" placeholder="Masukkan Frekwensi Nafas">
                </div>
              </div>
              <div class="form-group row">
                <label for="lingkar_perut" class="col-sm-2 col-form-label">Lingkar Perut</label>
                <div class="col-sm-10">
                  <input type="text" value="<?= $datapas['lingkar_perut'] ?>" class="form-control form-control-sm" name="lingkar_perut" id="lingkar_perut" placeholder="Masukkan Lingkar Perut">
                </div>
              </div>
              <div class="form-group row">
                <label for="heart_rate" class="col-sm-2 col-form-label">Heart Rate</label>
                <div class="col-sm-10">
                  <input type="text" value="<?= $datapas['heart_rate'] ?>" class="form-control form-control-sm" name="heart_rate" id="heart_rate" placeholder="Masukkan Heart Rate">
                </div>
              </div>
            </div>
            <div class="col-sm-6">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Pulang</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control form-control-sm" name="tgl_pulang" id="tgl_pulang">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Pulang</label>
                <div class="col-sm-10">

                  <select name="kd_status_pulang" class="form-control form-control-sm" id="kd_status_pulang">

                    <option value="">-- Pilih Status Pulang --</option>
                    <?php
                    if ($statuspulang_pcare != null) {
                      if ($statuspulang_pcare->metaData->code == 200) {
                        for ($i = 0; $i < $statuspulang_pcare->response->count; $i++) {
                          echo "<option value='" . $statuspulang_pcare->response->list[$i]->kdStatusPulang . "' >" . $statuspulang_pcare->response->list[$i]->nmStatusPulang . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dokter</label>
                <div class="col-sm-10">

                  <select name="kd_dokter" class="form-control form-control-sm" id="kd_dokter">

                    <option value="">-- Pilih Dokter --</option>
                    <?php
                    if ($dokter_pcare != null) {
                      if ($dokter_pcare->metaData->code == 200) {
                        for ($i = 0; $i < $dokter_pcare->response->count; $i++) {
                          echo "<option value='" . $dokter_pcare->response->list[$i]->kdDokter . "' >" . $dokter_pcare->response->list[$i]->nmDokter . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 1</label>
                <div class="col-sm-10">

                  <select name="kd_diagnosa_1" class="form-control form-control-sm" id="kd_diagnosa_1"></select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 2</label>
                <div class="col-sm-10">
                  <select name="kd_diagnosa_2" class="form-control form-control-sm" id="kd_diagnosa_2"></select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 3</label>
                <div class="col-sm-10">

                  <select name="kd_diagnosa_3" class="form-control form-control-sm" id="kd_diagnosa_3"></select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Poli Rujuk Internal</label>
                <div class="col-sm-10">
                  <select name="kd_poli_rujuk_internal" class="form-control form-control-sm" id="kd_poli_rujuk_internal"></select>
                </div>
              </div>

              <div class="form-group row">
                <label for="col-sm-2 col-form-label font-weight-bold"> Rujuk Lanjut
                  <input type="checkbox" name="is_rujuk_lanjut" id="is_rujuk_lanjut" class="form-control form-control-sm">
                </label>
              </div>

              <div id="rujuk_lanjut_field" class="row" style="display: none;">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sarana</label>
                  <div class="col-sm-10">
                    <select name="kd_sarana" style="width: 100%;" class="form-control form-control-sm" id="kd_sarana">

                      <option value="">-- Pilih Sarana --</option>
                      <?php
                      if ($sarana_pcare != null) {
                        if ($sarana_pcare->metaData->code == 200) {
                          for ($i = 0; $i < $sarana_pcare->response->count; $i++) {
                            echo "<option value='" . $sarana_pcare->response->list[$i]->kdSarana . "' >" . $sarana_pcare->response->list[$i]->nmSarana . "</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Spesialis</label>
                  <div class="col-sm-10">
                    <select name="spesialis" style="width: 100%;" class="form-control form-control-sm" id="spesialis">
                      <option value="">-- Pilih Spesialis --</option>
                      <?php
                      if ($spesialis_pcare != null) {
                        if ($spesialis_pcare->metaData->code == 200) {
                          for ($i = 0; $i < $spesialis_pcare->response->count; $i++) {
                            echo "<option value='" . $spesialis_pcare->response->list[$i]->kdSpesialis . "' >" . $spesialis_pcare->response->list[$i]->nmSpesialis . "</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">SubSpesialis</label>
                  <div class="col-sm-10">
                    <select name="kd_sub_spesialis_1" style="width: 100%;" class="form-control form-control-sm" id="kd_sub_spesialis_1"></select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal Est. Rujuk</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control form-control-sm" name="tgl_est_rujuk" id="tgl_est_rujuk">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">PPK</label>
                  <div class="col-sm-10">
                    <select name="kdppk" style="width: 100%;" class="form-control form-control-sm" id="kdppk"></select>
                  </div>
                </div>

                <input type="hidden" name="khusus" value="">
                <input type="hidden" name="no_kartu" id="no_kartu" value="<?= $datapas['no_kartu'] ?>">

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tacc</label>
                  <div class="col-sm-10">
                    <select name="kd_tacc" style="width: 100%;" class="form-control form-control-sm" id="kd_tacc">
                      <option value="">-- Pilih Tacc --</option>
                      <?php
                      for ($i = 0; $i < count($kdtacc); $i++) {
                        echo "<option data-alasan='" . json_encode($kdtacc[$i]['alasanTacc']) . "' value='" . $kdtacc[$i]['kdTacc'] . "' >" . $kdtacc[$i]['nmTacc'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alasan Tacc</label>
                  <div class="col-sm-10">
                    <select name="alasan_tacc" style="width: 100%;" class="form-control form-control-sm" id="alasan_tacc">
                      <option value="">-- Pilih Alasan --</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <button class="btn btn-outline-primary btn-sm" type="submit">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script Kunjungan -->

<script src="agoi/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  // function onChangeRujukLanjut(event){
  //   console.log(event)
  // }
  $('#is_rujuk_lanjut').on('change', function(event) {
    console.log(event.target.checked)
    if (!event.target.checked) {
      document.getElementById('rujuk_lanjut_field').style.display = "none";
    } else {
      document.getElementById('rujuk_lanjut_field').style.display = "block";
    }
  })

  $('#kd_tacc').on('change', function() {
    if ($(this).val() != 3) {
      console.log($(this).find(":selected").data('alasan'));
      if ($(this).find(":selected").data('alasan').length > 0) {
        console.log("lebih dari 1");

        $('#alasan_tacc').html("")
        $.each($(this).find(":selected").data('alasan'), function(key, value) {
          $('#alasan_tacc').append('<option value="' + value + '">' + value + '</option>');
        });
      } else {
        // $('#alasan_tacc').html("")
        $('#alasan_tacc').val(null)
      }
    } else {
      if ($('#kd_diagnosa_1').val() == "" || $('#kd_diagnosa_1').val() == null) {
        Swal.fire("Perhatian", "Diagnosa Harus diisi dahulu", "warning")
        $('#kd_tacc').val(null).trigger('change')
        return false;
      } else {
        $('#alasan_tacc').html("")
        $('#alasan_tacc').append('<option value="' + $('#kd_diagnosa_1').select2('data')[0].text + '">' + $('#kd_diagnosa_1').select2('data')[0].text + '</option>');
      }
    }
  });


  $('#spesialis').select2({}).on('change', function() {
    // 				// $(this).valid();
    // 				// $(this).
    // $('#kd_sub_spesialis_1').select2().destroy();
    $('#kd_sub_spesialis_1').select2({
      ajax: {
        url: '<?= urlBridging() ?>pcare/subspesialis/' + $('#spesialis').val(),
        header: {
          'Content-Type': 'application/json'
        },
        // data: function(params) {
        // 	var query = {
        // 		search: params.term,
        // 		spesialis: $('#spesialis').val()
        // 	}

        // 	// Query parameters will be ?search=[term]&type=public
        // 	return query;
        // },
        processResults: function(data) {
          // Transforms the top-level key of the response object from 'items' to 'results'
          console.log()
          var data = JSON.parse(data)
          console.log(data)
          console.log(data.response.list)
          return {
            results: $.map(data.response.list, function(item) {
              return {
                id: item.kdSubSpesialis, // Modify 'yourIdField' to the actual field name for the ID
                text: item.nmSubSpesialis // Modify 'yourTextField' to the actual field name for the text
              };
            })
          }
        }
      }
    })

  });

  $('#kd_poli').select2({});
  $('#kd_diagnosa_1').select2({});
  $('#kd_diagnosa_2').select2({});
  $('#kd_diagnosa_3').select2({});
  $('#kd_sarana').select2({});
  $('#kd_status_pulang').select2({});
  $('#kd_dokter').select2({});
  $('#kd_sadar').select2({});
  $('#kdppk').select2({});
  getDiagnosa("#kd_diagnosa_1")
  getDiagnosa("#kd_diagnosa_2")
  getDiagnosa("#kd_diagnosa_3")

  function getDiagnosa(id) {
    $(id).select2({
        ajax: {
          url: '<?= urlBridging() ?>pcare/diagnosa_select',
          header: {},
          data: function(params) {
            var query = {
              search: params.term,
              limit: 100,
              show: 1,
            }

            // Query parameters will be ?search=[term]&type=public
            return query;
          },
          processResults: function(data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            console.log()
            var data = JSON.parse(data)
            console.log(data)
            console.log(data.response.list)
            return {
              results: $.map(data.response.list, function(item) {
                return {
                  id: item.kdDiag, // Modify 'yourIdField' to the actual field name for the ID
                  text: item.kdDiag + " - " + item.nmDiag // Modify 'yourTextField' to the actual field name for the text
                };
              })
            }
          }
        }
      })
      .on('change', function() {
        // $(this).valid();
        // $(this).
      });

    // $.ajax({
    // 	method: 'get',
    // 	url: "/pcare/diagnosa_select",
    // 	dataType: "JSON",
    // 	data: function(params) {
    // 		var query = {
    // 			search: params.term,
    // 			show: '10',
    // 			limit: '15'
    // 		}
    // 		// Query parameters will be ?search=[term]&type=public
    // 		return query;
    // 	},
    // 	success: function(res) {
    // 		$(id).empty();
    // 		$(id).append('<option value="0">Pilih Diagnosa..</option>')
    // 		$.each(res.response.list, function(key, value) {
    // 			$(id).append('<option value="' + value.kdDokter + '">' + value.nmDokter + '</option>');
    // 		});
    // 		// if (selected) {
    // 		//     $('#village_id').val(selected);
    // 		// }
    // 		$(id).select2({
    // 			'placeholder': 'Pilih Dokter..'
    // 		})
    // 	}
    // })
  }
  // Load data edit hasil periksa
  $(document).on("click", "#tombolUbah", function() {
    let no_daftar = $(this).data('no_daf');
    let no_diagnosa = $(this).data('no');
    let subjektive = $(this).data('subj');
    let objektive = $(this).data('obj');
    let assesment = $(this).data('ass');
    let plan = $(this).data('plan');
    let tinggi_badan = $(this).data('tb');
    let berat_badan = $(this).data('bb');
    let tekanan_darah = $(this).data('td');
    let suhu = $(this).data('temp');
    let nadi = $(this).data('nadi');
    let rr = $(this).data('rr');
    let saturasi = $(this).data('saturasi');
    let butawarna = $(this).data('buta');
    let alergi = $(this).data('alergi');

    $(".modal-body #no_daf").val(no_daftar);
    $(".modal-body #no_diag").val(no_diagnosa);
    $(".modal-body #subjek").val(subjektive);
    $(".modal-body #objek").val(objektive);
    $(".modal-body #asses").val(assesment);
    $(".modal-body #rtl").val(plan);
    $(".modal-body #tingbad").val(tinggi_badan);
    $(".modal-body #berbad").val(berat_badan);
    $(".modal-body #tek_darah").val(tekanan_darah);
    $(".modal-body #suhu").val(suhu);
    $(".modal-body #nad_i").val(nadi);
    $(".modal-body #resp").val(rr);
    $(".modal-body #satur").val(saturasi);
    $(".modal-body #aler_gi").val(alergi);
    $(".modal-body #buta_warna").val(butawarna);
  });
  // End Load
  // Reset edit
  function reset() {
    $("#asses").val("");
    $("#objek").val("");
    $("#subjek").val("");
    $("#rtl").val("");
    $("#berbad").val("");
    $("#tingbad").val("");
    $("#tek_darah").val("");
    $("#suhu").val("");
    $("#nad_i").val("");
    $("#resp").val("");
    $("#satur").val("");
  }

  $(".modal-body #btnreset").click(function() {
    reset();
    document.getElementById("subjek").focus();
  });



  function mergeArrayToString(array) {
    let mergedString = '';
    array.forEach(item => {
      const field = item.field;
      const message = item.message;
      mergedString += `${field}: ${message}\n`;
    });
    return mergedString;
  }

  function formatDate(dateString) {
    const parts = dateString.split('-');
    const year = parts[0];
    const month = parts[1];
    const day = parts[2];

    return `${day}-${month}-${year}`;
  }

  $("#simpan_edit").on("submit", function(event) {
    event.preventDefault();
    var no_daftar = $("#no_daf").val();
    var no_diagnosa = $("#no_diag").val();
    var subjektive = $("#subjek").val();
    var objektive = $("#objek").val();
    var assesment = $("#asses").val();
    var plan = $("#rtl").val();
    var berat_badan = $("#berbad").val();
    var tinggi_badan = $("#tingbad").val();
    var temp = $("#suhu").val();
    var tekanan_darah = $("#tek_darah").val();
    var nadi = $("#nad_i").val();
    var rr = $("#resp").val();
    var saturasi = $("#satur").val();
    var butawarna = $("#buta_warna").val();
    var alergi = $("#aler_gi").val();

    $.ajax({
      url: "ajax/edit_periksa.php",
      method: "POST",
      data: "no_daftar=" + no_daftar + "&no_diagnosa=" + no_diagnosa + "&subjektive=" + subjektive + "&objektive=" + objektive + "&assesment=" + assesment + "&plan=" + plan + "&berat_badan=" + berat_badan + "&tinggi_badan=" + tinggi_badan + "&temp=" + temp + "&tekanan_darah=" + tekanan_darah + "&nadi=" + nadi + "&saturasi=" + saturasi + "&rr=" + rr + "&butawarna=" + butawarna + "&alergi=" + alergi,
      success: function(hasil) {
        if (hasil == "berhasil") {
          Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Diubah',
            type: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          }).then((ok) => {
            if (ok.value) {
              window.location.reload(true);
            }
          })
        } else if (hasil == "gagal") {
          Swal.fire(
            'Gagal',
            'Data Gagal Diubah',
            'error'
          )
        }
      }
    })
  });

  $("button[name='tombol_hapus']").click(function() {
    var id = $(this).data("id");
    var nama = $(this).data('nama');
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: 'Akan menghapus ' + nama + ', anda tidak dapat mengembalikan data yang telah dihapus.',
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
          url: "ajax/hapus.php?page=form_assesment",
          data: "id=" + id,
          success: function(hasil) {
            Swal.fire({
              title: 'Berhasil',
              text: 'Diagnosa Berhasil Dihapus',
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


    $("#simpan_kunjungan").on("submit", function(event) {
      event.preventDefault();
      let data = {
        "noKunjungan": null,
        "noKartu": $('#no_kartu').val(),
        "tglDaftar": $("#tgl_daftar").val() == null ? "" : formatDate($("#tgl_daftar").val()),
        "kdPoli": $('#kd_poli').val(),
        "keluhan": $('#keluhan').val(),
        "kdSadar": $('#kd_sadar').val(),
        "sistole": parseInt($('#tekanan_darah_sistole').val()),
        "diastole": parseInt($('#tekanan_darah_diastole').val()),
        "beratBadan": parseInt($('#berat_badan').val()),
        "tinggiBadan": parseInt($('#tinggi_badan').val()),
        "respRate": parseInt($('#frekwensi_nafas').val()),
        "lingkarPerut": parseInt($('#lingkar_perut').val()),
        "heartRate": parseInt($('#heart_rate').val()),

        "kdStatusPulang": $('#kd_status_pulang').val(),
        "tglPulang": $('#tgl_pulang').val() != null ? formatDate($('#tgl_pulang').val()) : "",
        "kdDokter": $('#kd_dokter').val(),
        "kdDiag1": $('#kd_diagnosa_1').val() == null ? null : $('#kd_diagnosa_1').val(),
        "kdDiag2": $('#kd_diagnosa_2').val() == null ? null : $('#kd_diagnosa_2').val(),
        "kdDiag3": $('#kd_diagnosa_3').val() == null ? null : $('#kd_diagnosa_3').val(),
        "kdPoliRujukInternal": null,
        "rujukLanjut": {
          "kdppk": $('#kdppk').val(),
          "tglEstRujuk": $('#tgl_est_rujuk').val() != "" ? formatDate($('#tgl_est_rujuk').val()) : null,
          "subSpesialis": {
            "kdSubSpesialis1": parseInt($('#kd_sub_spesialis1').val()),
            "kdSarana": parseInt($('#kd_sarana').val())
          },
          "khusus": null
        },
        "kdTacc": -1,
        "alasanTacc": null
      };
      if ($('#is_rujuk_lanjut').is(":checked")) {} else {
        data.rujukLanjut = null;
      }
      console.log(data);
      $.ajax({
        method: 'POST',
        url: "<?= urlBridging() ?>pcare/addKunjungan",
        headers: {
          "Content-Type": "application/json"
        },
        dataType: "json",
        data: JSON.stringify(data),
        success: function(result) {
          console.log(result);
          console.log(result.metaData);
          // let result = JSON.parse(res)
          // alert(result?.metaData?.message ?? "gagal insert");
          if (result.metaData?.code == 412) {

            if (result?.response != null) {
              if (Array.isArray(result?.response)) {
                console.log('The JSON value is an array.');
                const mergedString = mergeArrayToString(result?.response);
                Swal.fire({
                  title: 'Perhatian!',
                  text: `Terjadi Kesalahan input:\n${mergedString}`,
                  icon: 'info',
                });
              } else if (typeof result?.response === 'object' && result?.response !== null) {
                console.log('The JSON value is an object.');
                const {
                  field,
                  message
                } = result?.response;
                Swal.fire({
                  title: 'Perhatian!',
                  text: `Terjadi Kesalahan input:\n${field} ${message}`,
                  icon: 'info',
                });
              } else {
                Swal.fire({
                  title: 'Perhatian!',
                  text: `Terjadi Kesalahan`,
                  icon: 'error',
                });
              }
            }
          } else if (result?.metaData?.code == 401) {
            const message = result?.metaData?.message;
            Swal.fire({
              title: 'Perhatian!',
              text: `Duplikasi Input :\n${message}`,
              icon: 'info',
            });
          }else if (result?.metaData?.code == 201) {
            const message = result?.metaData?.message;
            Swal.fire({
              title: 'Sukes!',
              text: `\n${message}`,
              icon: 'success',
            });
          } else {
            Swal.fire(
              'Gagal Simpan!',
              "gagal",
              'error'
            )
          }
        }
      })
    });

    $('#kdppk').select2({
    ajax: {
      type: "POST",
      url: '<?= urlBridging() ?>pcare/ppkSpesialis',
      data: function(params) { 
        console.log($('#subspesialis').select2('data').id)
      	var query = { 
      		subspesialis: $('#subspesialis').select2('data').id,
      		tgl: $('#tgl_est_rujuk').val(),
      		sarana: $('#sarana').select2('data').id
      	}

      	// Query parameters will be ?search=[term]&type=public
      	return query;
      },
      processResults: function(data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        console.log()
        var data = JSON.parse(data)
        console.log(data)
        console.log(data.response.list)
        return {
          results: $.map(data.response.list, function(item) {
            return {
              id: item.kdPpk, // Modify 'yourIdField' to the actual field name for the ID
              text: item.nmPpk // Modify 'yourTextField' to the actual field name for the text
            };
          })
        }
      }
    }
  })
		$('#tgl_est_rujuk').on('change', function() {

// <!-- /spesialis/rujuk/subspesialis/{Parameter 1}/sarana/{Parameter 2}/tglEstRujuk/{Parameter 3} -->
if ($('#spesialis').val() == null || $('#subspesialis').val() == null || $('#sarana').val() == null) {
  // alert("SPESIALIS, SUBSPESIALIS, SARANA HARUS DIISI")
} else {
  $('#kdppk').select2({
    ajax: {
      url: '<?= urlBridging() ?>pcare/ppkSpesialis',
      data: function(params) {
      	var query = {
      		search: params.term,
      		subspesialis: $('#subspesialis').val(),
      		tgl: $('#tgl_est_rujuk').val(),
      		sarana: $('#sarana').val(),
      	}

      	// Query parameters will be ?search=[term]&type=public
      	return query;
      },
      processResults: function(data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        console.log()
        var data = JSON.parse(data)
        console.log(data)
        console.log(data.response.list)
        return {
          results: $.map(data.response.list, function(item) {
            return {
              id: item.kdPpk, // Modify 'yourIdField' to the actual field name for the ID
              text: item.nmPpk // Modify 'yourTextField' to the actual field name for the text
            };
          })
        }
      }
    }
  })

}
})

  });
</script>

<script>
  $("button[name='tombol_obatoral']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=entry_obatpasien&id=' + id;
  });
  $("button[name='tombol_obatracik']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=entry_obatracik&id=' + id;
  });
  $("button[name='tombol_tindakan']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=entry_tindakanpasien&id=' + id;
  });
  $("button[name='tombol_laborat']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=entry_laboratpasien&id=' + id;
  });
  $("button[name='tombol_riwayat']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=riwayatperiksa&id=' + id;
  });

  $("button[name='tombol_diagnosa']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=form_assesment&id=' + id;
  });

  $("button[name='tombol_kunjungan']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=form_kunjungan&id=' + id;
  });
  $("button[name='tombol_suratijin']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=tambah_ijin&id=' + id;
  });

  $("button[name='tombol_suratsehat']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=tambah_suratsehat&id=' + id;
  });

  $("button[name='tombol_suratsakit']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=tambah_suratsakit&id=' + id;
  });

  $("button[name='tombol_rujuk']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=tambah_rujukan&id=' + id;
  });
  $("button[name='tombol_swab']").click(function() {
    var id = $(this).data('id');
    window.location = '?page=tambah_swabantigen&id=' + id;
  });
</script>
<script>
  function goBack() {
    window.history.back();
  }
</script>