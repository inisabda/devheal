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
      <div class="row data-assesment">
          <?php 
          
          $query_tampil = "SELECT * FROM tbl_daftarpasien LEFT JOIN pendaftaran_pcare on tbl_daftarpasien.no_daftar = pendaftaran_pcare.no_daftar WHERE tbl_daftarpasien.no_daftar='$no_daftar' ";
          $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
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
                          if($datapas['alergi']){ ?>
                            <span class="badge badge-pill badge-warning" style="padding: 8px; font-size: 11px;"><?php echo $datapas['alergi']; ?></span>
                          <?php }else if($datapas['alergi'] == ''){?>                       
                            <span class="badge badge-pill badge-success" style="padding: 8px; font-size: 11px;"><?php echo $tidak_alergi;?></span>
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
                      <td><?php echo $datapas['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($datapas['lhr_pas'])); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</td>
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
                        <button class="btn btn-warning btn-sm" title="Form Assesment Pasien" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-stethoscope"> Assesment Awal</i></button>
                        <button class="btn-transition btn  btn-outline-info  btn-sm" title="Kunjungan Pasien" id="tombol_kunjungan" name="tombol_kunjungan" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-user"> Kunjungan</i></button>
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
        <form method="post" id="simpan_assesment" autocomplete="off">
          <?php 
                $tgl_daftar = gmdate("Y-m-d", time() + 60 * 60 * 7);
                $hari= substr($tgl_daftar, 8, 2);
                $bulan = substr($tgl_daftar, 5, 2);
                $tahun = substr($tgl_daftar, 0, 4);
                $tgl = $tahun.$bulan.$hari;
                $carikode = mysqli_query($conn, "SELECT MAX(no_diagnosa) FROM tbl_periksa WHERE tgl_daftar = '$tgl_daftar'") or die (mysql_error());
                $datakode = mysqli_fetch_array($carikode);
                if($datakode) {
                    $nilaikode = substr($datakode[0], 13);
                    $kode = (int) $nilaikode;
                    $kode = $kode + 1;
                    $no_diagnosa = "DIA/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                } else {
                    $no_diagnosa = "DIA/".$tgl."/001";
                }
             ?>

          <div style="text-align: right;">
            No ID Assesment : <b><?php echo $no_diagnosa; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
          </div>
          <div class="form-group row pt-1">
              <div class="col-sm-3">
                <input name="tgl_daftar" id="tgl_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                <input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7); ?>">
              </div>
              <div class="col-sm-3">
                <input name="no_diagnosa" id="no_diagnosa" type="hidden" class="form-control form-control-sm" value="<?php echo $no_diagnosa; ?>">
                <input type="hidden" class="form-control form-control-sm" name="no_daftar" id="no_daftar" value="<?php echo $datapas['no_daftar']; ?>" disabled>
              </div>
              <div class="col-sm-3">
                <input type="hidden" class="form-control form-control-sm" name="nomor_rm" id="nomor_rm" value="<?php echo $datapas['nomor_rm']; ?>" disabled>
                <input type="hidden" class="form-control form-control-sm" name="nama_pas" id="nama_pas" value="<?php echo $datapas['nama_pas']; ?>" disabled>
              </div>              
              <div class="col-sm-3">
                <input type="hidden" class="form-control form-control-sm" name="alm_pas" id="alm_pas" value="<?php echo $datapas['alm_pas']; ?>" disabled>
                <input type="hidden" class="form-control form-control-sm" name="alergi" id="alergi" value="<?php echo $alergi; ?>" disabled>
              </div>
          </div>                         
          <div class="form-group row pt-1">
            <label for="code" class="col-sm-2 col-form-label">Kode ICD-10</label>
              <div class="col-sm-4">
                  <div class="input-group-append">                      
                    <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Cari Kode ICD-10" autofocus="">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_diagnosa" id="lihat_data_diagnosa"><i class="fas fa-search"></i></button>
                  </div>
              </div>
            <label for="diagnosa" class="col-sm-2 col-form-label" style="text-align: left;">Diagnosa ICD-10</label>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" name="diagnosa" id="diagnosa" placeholder="Diagnosa terisi otomatis" value="" disabled>
              </div>
          </div>                         
          <div class="form-group row pt-1">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi" placeholder="Deskripsi terisi otomatis" value="" disabled>
              </div>

            <label for="dokter" class="col-sm-2 col-form-label" style="text-align: left;">DPJP</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $datapas['nm_dokter']; ?>" name="nm_dokter" disabled>
              </div>
          </div>
          <div class="col-md-12">
            <table class="table table-hover display tabel-data">
              <thead>
                <tr>
                  <th width="130"></th>
                  <th width="120">Tekanan Darah</th>
                  <th width="120">Tinggi Badan</th>
                  <th width="120">Berat Badan</th>
                  <th width="120">Pernafasan</th>
                  <th width="120">Suhu</th>
                  <th width="120">Nadi</th>
                  <th width="120">SpO2</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <input type="button" class="btn btn-danger btn-sm my-2" onclick="loadttvnormal()" value="Load hasil ttv normal">
                  <input type="button" class="btn btn-danger btn-sm" onclick="loadttvpendaftaran()" value="Load hasil ttv pendaftaran">
                  </td>
                  <td><input type="text" style="width:100px; background-color: yellow;" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" placeholder="........... MmHg"></td>
                  <td><input type="number" style="width:90px; background-color: yellow;" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="............Cm"></td>
                  <td><input type="number" style="width:90px; background-color: yellow;" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="............Kg"></td>
                  <td><input type="number" style="width:90px; background-color: yellow;" class="form-control form-control-sm" name="rr" id="rr" placeholder="....... /mnt"></td>
                  <td><input type="decimal" style="width:70px; background-color: yellow;" class="form-control form-control-sm" name="temp" id="temp" placeholder="............&#176;C"></td>
                  <td><input type="number" style="width:90px; background-color: yellow;" class="form-control form-control-sm" name="nadi" id="nadi" placeholder="......../mnt"></td>
                  <td><input type="number" style="width:80px; background-color: yellow;" class="form-control form-control-sm" name="saturasi" id="saturasi" placeholder="............%"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group row pt-1">
            <label for="subjektive" class="col-sm-2 col-form-label"><i>Subject (S)</i></label>
              <div class="col-sm-4">
                <textarea name="subjektive" id="subjektive" rows="2" class="form-control" placeholder="Masukkan Data Subjective Pasien" style="font-size: 14px;"></textarea>
              </div>
            <label for="objektive" class="col-sm-2 col-form-label" style="text-align: left;"><i>Object (O)</i></label>
              <div class="col-sm-4">
                <textarea name="objektive" id="objektive" rows="2" class="form-control" placeholder="Masukkan Data Objective Pasien" style="font-size: 14px;"></textarea>
              </div>
          </div>
          <div class="form-group row pt-1">
            <label for="assesment" class="col-sm-2 col-form-label"><i>Assesment (A)</i></label>
            <div class="col-sm-4">
                <textarea name="assesment" id="assesment" rows="2" class="form-control" placeholder="Masukkan Assesment Pasien" style="font-size: 14px;"></textarea>
            </div>
                  <label for="plan" class="col-sm-2 col-form-label" style="text-align: left;"><i>Plan(P)</i></label>
            <div class="col-sm-4">
                <textarea name="plan" id="plan" rows="2" class="form-control" placeholder="Masukkan Rencana Pengobatan" style="font-size: 14px;"></textarea>
              </div>
          </div>
          <div class="form-group row pt-1">
            <label for="butawarna" class="col-sm-2 col-form-label" style="text-align: left;"> Buta Warna </label>
            <div class="col-sm-4">
              <div class="form-check">
                <label class="form-check-label" style="font-weight: normal;">
                  <input name="butawarna" id="butawarna1" type="radio" class="form-check-input" value="Ya"> 
                    Ya</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="form-check-label" style="font-weight: normal; text-align: right;">
                  <input name="butawarna" id="butawarna2" type="radio" class="form-check-input" value="Tidak" checked>Tidak </label>
                  <input type="hidden" name="status_rawat" id="status_rawat" class="form-control form-control-sm" value="Sudah diperiksa">
              </div>
            </div>                       
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Assesment</button>
              <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <br>
    <div class="row" style="padding: 0 20px;">
      <div class="col-md-12 vertical-form table-responsive">
        <h5 align="center"> Hasil assesment pasien</h5>
        <table id="editable_table" class="table table-bordered table-striped display tabel-data">
            <thead>
                <tr class="bg-info">
                  <th>No Diagnosa</th>
                    <th>Diagnosa</th>
                    <th>Subjektif</th>
                    <th>Objektif</th>
                    <th>Assesment</th>
                    <th>Plan</th>
                    <th>Hasil Vital Sign</th>
                    <th>Alergi</th>
                    <th>Butawarna</th>
                    <th></th>
                </tr>
            </thead>
            <?php 
              require_once "koneksi.php";
              $no_daftar = @$_GET['id'];
              
                $tgl_sekarang = date('Y-m-d');
                $query_diagnosa = "SELECT * FROM tbl_periksa WHERE no_daftar='$no_daftar'";
                $sql_diagnosa = mysqli_query($conn, $query_diagnosa) or die ($conn->error);
                //$data = mysqli_fetch_array($sql_tampil);
              ?>
            <tbody>
              <?php  
                  while($data = mysqli_fetch_array($sql_diagnosa)) {
              ?>
                <tr>
                    <td><?php echo $data['no_diagnosa']; ?></td>
                    <td><?php echo $data['diagnosa']; ?></td>
                    <td><?php echo $data['subjektive']; ?></td>
                    <td><?php echo $data['objektive']; ?></td>
                    <td><?php echo $data['assesment']; ?></td>
                    <td><?php echo $data['plan']; ?></td>
                    <td><a style="font-size:12px; color: red;">TD</a> : <?php echo $data['tekanan_darah']; ?> Mmhg,<a style="font-size:12px; color: red;"> TB </a>: <?php echo $data['tinggi_badan']; ?> Cm, <a style="font-size:12px; color: red;">BB </a>: <?php echo $data['berat_badan']; ?> Kg, <a style="font-size:12px; color: red;">RR </a>: <?php echo $data['rr']; ?> /mnt, <a style="font-size:12px; color: red;">S </a>: <?php echo $data['temp']; ?> &#176;, <a style="font-size:12px; color: red;">HR </a>: <?php echo $data['nadi']; ?>/mnt, <a style="font-size:12px; color: red;">SpO2 </a>: <?php echo $data['saturasi']; ?>%</td>
                    <td><?php echo $data['alergi']; ?></td>
                    <td><?php echo $data['butawarna']; ?></td>
                    <td class="td-opsi">
                        <!-- Button trigger modal -->
                        <a class="btn-transition btn btn-outline-primary btn-sm" id="tombolUbah" title="Edit Hasil Assesment" data-toggle="modal" data-target="#editHasilPeriksa" 
                        data-no="<?php echo $data['no_diagnosa'];?>"
                        data-no_daf="<?php echo $data['no_daftar'];?>"
                        data-subj="<?php echo $data['subjektive'];?>"
                        data-obj="<?php echo $data['objektive'];?>"
                        data-ass="<?php echo $data['assesment'];?>"
                        data-plan="<?php echo $data['plan'];?>"
                        data-tb="<?php echo $data['tinggi_badan'];?>"
                        data-bb="<?php echo $data['berat_badan'];?>"
                        data-rr="<?php echo $data['rr'];?>"
                        data-temp="<?php echo $data['temp'];?>"
                        data-td="<?php echo $data['tekanan_darah'];?>"
                        data-nadi="<?php echo $data['nadi'];?>"
                        data-saturasi="<?php echo $data['saturasi'];?>"
                        data-alergi="<?php echo $data['alergi'];?>"
                        data-buta="<?php echo $data['butawarna'];?>"><i class="fas fa-edit"></i></a>
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-dismiss="modal"
                            data-id="<?php echo $data['no_diagnosa']; ?>"
                            data-nama="<?php echo $data['diagnosa']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                 <?php } ?>
            </tbody>
        </table>
      </div>
    </div>
    <br>
    <div class="row" style="padding: 0 20px;">
      <div class="col-md-12 vertical-form table-responsive">
        <h5 align="center"> Riwayat Periksa 5 Kali Terakhir</h5>
        <table id="editable_table" class="table table-bordered table-hover display tabel-data">
            <thead>
                <tr style="font-size:10px; color: white; " class="bg-info">
                    <th>No Diagnosa</th>
                    <th>Tgl Periksa</th>                    
                    <th>Nama Pasien</th>
                    <th>Diagnosa</th>
                    <th>Subjektif</th>
                    <th>Objektif</th>
                    <th>Assesment</th>
                    <th>Plan</th>
                    <th>Hasil Vital Sign</th>
                    <th>Alergi</th>
                    <th></th>
                </tr>
            </thead>
              <?php
                require_once "koneksi.php";
                $query_diagnosa = "SELECT * FROM tbl_periksa WHERE nomor_rm='$nomor_rm' order by tgl_daftar DESC Limit 5";
                $sql_diagnosa = mysqli_query($conn, $query_diagnosa) or die ($conn->error);
                //$data = mysqli_fetch_array($sql_tampil);
              ?>
            <tbody>
              <?php  
                  while($data = mysqli_fetch_array($sql_diagnosa)) {
              ?>
                <tr>
                    <td><?php echo $data['no_diagnosa']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($data['tgl_periksa'])); ?> WIB</td>
                    <td><?php echo $data['nama_pas']; ?></td>
                    <td><?php echo $data['diagnosa']; ?></td>
                    <td><?php echo $data['subjektive']; ?></td>
                    <td><?php echo $data['objektive']; ?></td>
                    <td><?php echo $data['assesment']; ?></td>
                    <td><?php echo $data['plan']; ?></td>
                    <td><a style="font-size:12px; color: red;">TD</a> : <?php echo $data['tekanan_darah']; ?> Mmhg,<a style="font-size:12px; color: red;"> TB </a>: <?php echo $data['tinggi_badan']; ?> Cm, <a style="font-size:12px; color: red;">BB </a>: <?php echo $data['berat_badan']; ?> Kg, <a style="font-size:12px; color: red;">RR </a>: <?php echo $data['rr']; ?> /mnt, <a style="font-size:12px; color: red;">S </a>: <?php echo $data['temp']; ?> &#176;, <a style="font-size:12px; color: red;">HR </a>: <?php echo $data['nadi']; ?>/mnt, <a style="font-size:12px; color: red;">SpO2 </a>: <?php echo $data['saturasi']; ?>%</td>
                    <td><?php
                        $tidak_alergi = "Tidak Ada Alergi";
                          if($data['alergi']){ ?>
                            <span class="badge badge-pill badge-warning" style="padding: 6px; font-size: 10px;"><?php echo $data['alergi']; ?></span>
                          <?php }else if($data['alergi'] == ''){?>                       
                            <span class="badge badge-pill badge-success" style="padding: 6px; font-size: 10px;"><?php echo $tidak_alergi;?></span>
                          <?php }
                        ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-dismiss="modal"
                            data-id="<?php echo $data['no_diagnosa']; ?>"
                            data-nama="<?php echo $data['diagnosa']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                 <?php } ?>
            </tbody>
        </table>
      </div>
    </div>

    <!-- Modal cari diagnosa -->
    <div class="modal fade" id="modal_diagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data ICD 10</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row" style="padding: 0 16px;">
              <div class="col-md-12 vertical-form">
                <div class="row data-pengobatan">
                  <div class="position-relative form-group col-md-5">
                    <label for="code" class="">Cari Code, Diagnosa (tekan Enter) </label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm" id="search">
                    </div>
                  </div>
                </div>
                <div class="position-relative form-group col-md-12">
                  <ul id="result"></ul>       
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Cari Diagnosa -->

    <!-- Modal Edit Hasil Periksa-->
    <div class="modal fade" id="editHasilPeriksa" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ubahModalLabel">Halaman edit hasil periksa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 offset-form">
                <h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit hasil periksa</h6>
                <form method="POST" id="simpan_edit">
                  <input type="hidden" name="no_diag" id="no_diag">
                  <input type="hidden" name="no_daf" id="no_daf">
                  <div class="form-group row pt-1">
                    <label for="subjek" class="col-sm-2 col-form-label">Data (S)</label>
                    <div class="col-sm-10">
                      <textarea name="subjek" id="subjek" rows="2" class="form-control form-control-sm" style="font-size: 14px;"></textarea>
                    </div>
                  </div>
                  <div class="form-group row pt-1">
                    <label for="obj" class="col-sm-2 col-form-label">Data (O)</label>
                    <div class="col-sm-10">
                      <textarea name="objek" id="objek" rows="2" class="form-control form-control-sm" style="font-size: 14px;"></textarea>
                    </div>
                  </div>
                  <div class="form-group row pt-1">
                    <label for="asses" class="col-sm-2 col-form-label">Data (A)</label>
                    <div class="col-sm-10">
                      <textarea name="asses" id="asses" rows="2" class="form-control form-control-sm" style="font-size: 14px;"></textarea>
                    </div>
                  </div>
                  <div class="form-group row pt-1">
                    <label for="plan" class="col-sm-2 col-form-label">Data (P)</label>
                    <div class="col-sm-10">
                      <textarea name="rtl" id="rtl" rows="2" class="form-control form-control-sm" style="font-size: 14px;"></textarea>
                    </div>
                  </div>
                  <div class="form-group row pt-1">
                    <table width="100%">
                      <thead>
                        <tr>
                          <th>Tekanan Darah</th>
                          <th>Berat Badan</th>
                          <th>Tinggi Badan</th>
                          <th>Suhu</th>
                          <th>Nadi</th>
                          <th>Pernapasan</th>
                          <th>SpO2</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control form-control-sm" name="tek_darah" id="tek_darah"></td>
                          <td><input type="number" class="form-control form-control-sm" name="berbad" id="berbad"></td>
                          <td><input type="number" class="form-control form-control-sm" name="tingbad" id="tingbad"></td>
                          <td><input type="decimal" class="form-control form-control-sm" name="suhu" id="suhu"></td>
                          <td><input type="number" class="form-control form-control-sm" name="nad_i" id="nad_i"></td>
                          <td><input type="number" class="form-control form-control-sm" name="resp" id="resp"></td>
                          <td><input type="number" class="form-control form-control-sm" name="satur" id="satur"></td>
                        </tr>
                    </table>
                    <table width="100%">
                      <thead>
                        <tr>
                          <th>Alergi</th>
                          <th>Butawarna</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td><input type="text" class="form-control form-control-sm bg-warning text-white" name="aler_gi" id="aler_gi"></td>
                            <td><input type="text" class="form-control form-control-sm" name="buta_warna" id="buta_warna"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-danger btn-sm" id="btnreset">Reset</button>
                      <button type="submit" name="ubah" class="btn btn-primary btn-sm">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>
    <!-- End modal edit hasil periksa -->        
  </div>
</div>

<!-- Script Assesment -->

<script>
  // Load data edit hasil periksa
  $(document).on("click", "#tombolUbah", function(){
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

  function loadttvnormal() {
    document.getElementById("tekanan_darah").value ="120/70";
    document.getElementById("temp").value ="36.5";
    document.getElementById("saturasi").value ="100";
    document.getElementById("nadi").value ="90";
  }

  
  function loadttvpendaftaran() {
    // < var_dump($datapas); die(); ?>
    document.getElementById("tekanan_darah").value = "<?= $datapas['sistole']."/".$datapas["diastole"] ?>";
    // document.getElementById("temp").value  ="36.5";
    // document.getElementById("saturasi").value = 
    document.getElementById('tinggi_badan').value = "<?= $datapas['tinggi_badan'] ?>";
    document.getElementById('berat_badan').value = "<?= $datapas['berat_badan'] ?>";
    document.getElementById('rr').value = "<?= $datapas['resp_rate'] ?>";
    document.getElementById("nadi").value = "<?= $datapas['heart_rate'] ?>";
  }

  $("#simpan_edit").on("submit", function(event){
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
        data: "no_daftar="+no_daftar+"&no_diagnosa="+no_diagnosa+"&subjektive="+subjektive+"&objektive="+objektive+"&assesment="+assesment+"&plan="+plan+"&berat_badan="+berat_badan+"&tinggi_badan="+tinggi_badan+"&temp="+temp+"&tekanan_darah="+tekanan_darah+"&nadi="+nadi+"&saturasi="+saturasi+"&rr="+rr+"&butawarna="+butawarna+"&alergi="+alergi,
        success: function(hasil) {
        if(hasil=="berhasil") {
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
        }else if(hasil=="gagal") {
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
          text: 'Akan menghapus '+nama+', anda tidak dapat mengembalikan data yang telah dihapus.',
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
              data: "id="+id,
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

  $(document).ready(function(){    
         function search(){
               var code=$("#search").val();
               var diagnosa=$("#search").val();
               var deskripsi=$("#search").val();

            if(code!=""){
              $("#result").html('<i class="fa fa-spin fa-spinner"></i>');
               $.ajax({
                  type:"post",
                  url:"ajax/search_icd10.php",
                  data:"code="+code+"&diagnosa="+diagnosa,
                  success:function(data){
                      $("#result").html(data);
                      $("#search").val("");
                   }
                });
            }                            
          }
          $("#code").click(function() {
              $("#lihat_data_diagnosa").click();
          });

          $("#button").click(function(){
             search();
          });

          $('#search').keyup(function(e) {
             if(e.keyCode == 13) {
                search();
              }
          });
    });
    $("button[name='tombol_pilihdiagnosa']").click(function() {
        var cod = $(this).data('cod');
        var nam = $(this).data('nam');
        var desk = $(this).data('desk');
       

        $("#code").val(cod);
        $("#diagnosa").val(nam);
        $("#deskripsi").val(desk);
    });

  $("#simpan_assesment").on("submit", function(event){
    event.preventDefault();
    var no_diagnosa = $("#no_diagnosa").val();
    var no_daftar = $("#no_daftar").val();
    var tgl_daftar = $("#tgl_daftar").val();
    var tgl_periksa = $("#tgl_periksa").val();
    var nama_pas = $("#nama_pas").val();
    var nomor_rm = $("#nomor_rm").val();
    var code = $("#code").val();
    var diagnosa = $("#diagnosa").val();
    var subjektive = $("#subjektive").val();
    var objektive = $("#objektive").val();
    var assesment = $("#assesment").val();
    var plan = $("#plan").val();
    var berat_badan = $("#berat_badan").val();
    var tinggi_badan = $("#tinggi_badan").val();
    var temp = $("#temp").val();
    var tekanan_darah = $("#tekanan_darah").val();
    var nadi = $("#nadi").val();
    var rr = $("#rr").val();
    var saturasi = $("#saturasi").val();
    var status_rawat = $("#status_rawat").val();
    var alergi = $("#alergi").val();
    var butawarna = document.querySelector('input[name="butawarna"]:checked').value;

    // alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

  if(code=="") {
      document.getElementById("code").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'Maaf, tolong isi kode ICD-10 terlebih dahulu',
        'warning'
      )
    
    } else {
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
      $.ajax({
        type: "POST",
        url: "ajax/simpan_periksa.php",
        data: "no_diagnosa="+no_diagnosa+"&no_daftar="+no_daftar+"&tgl_daftar="+tgl_daftar+"&tgl_periksa="+tgl_periksa+"&nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&code="+code+"&diagnosa="+diagnosa+"&subjektive="+subjektive+"&objektive="+objektive+"&assesment="+assesment+"&plan="+plan+"&berat_badan="+berat_badan+"&tinggi_badan="+tinggi_badan+"&temp="+temp+"&tekanan_darah="+tekanan_darah+"&nadi="+nadi+"&rr="+rr+"&saturasi="+saturasi+"&butawarna="+butawarna+"&status_rawat="+status_rawat+"&alergi="+alergi,
        success: function(hasil) {
          if(hasil=="berhasil") {
    Swal.fire({
          title: 'Berhasil',
          text: 'Assesment berhasil disimpan ',
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
      }else if(hasil=="gagal") {
        Swal.fire(
          'Gagal',
          'Data Gagal Diubah',
          'error'
        )
      }
            }
          })  
        // }
      })
    }
  });
</script>

<script>
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
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>