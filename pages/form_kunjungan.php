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
    <div class="col-6"><h4><i class="fas fa-file-signature"></i> Form Kunjungan</h4></div>
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
                        <button class="btn-transition btn btn-outline-info btn-sm" title="Form Assesment Pasien" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-stethoscope"> Assesment</i></button>
                        <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Non Racikan" id="tombol_obatoral" name="tombol_obatoral" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-pills"> Obat Non racikan</i></button>
                        <button class="btn-transition btn btn-outline-info btn-sm" title="Form Pemberian Obat Racikan" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-mortar-pestle"> Obat Racikan</i></button>
                        <button class="btn-transition btn btn-outline-info btn-sm" title="Form Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-syringe"> Tindakan</i></button>
                        <button class="btn-transition btn btn-outline-info btn-sm" title="Form Laborat Pasien" id="tombol_laborat" name="tombol_laborat" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-flask"> Laborat</i></button> 
                        <button class="btn btn-warning btn-sm" title="Kunjungan Pasien" id="tombol_kunjungan" name="tombol_kunjungan" data-id="<?php echo $datapas['no_daftar']; ?>"><i class="fas fa-user"> Kunjungan</i></button>
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

            <div class="col-sm-6">


              <div class="form-group row">

                <label class="col-sm-2 col-form-label">Tgl Daftar</label>
                <div class="col-sm-10">
                  <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control form-control-sm" value="">
                </div>
              </div>

              <div class="form-group row">



                <label class="col-sm-2 col-form-label">Poli</label>
                <div class="col-sm-10">
                  <select name="kd_poli"  class="form-control form-control-sm" id="kd_poli"></select>  
                </div>
              </div>
              <div class="form-group row">
                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="keluhan" id="keluhan" placeholder="Keluhan Pasien">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Sadar</label>
                <div class="col-sm-10">
                  <select name="kd_sadar"  class="form-control form-control-sm" id="kd_sadar"></select> 
                </div>
              </div>

              <div class="form-group row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="Masukkan BB">
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
                  <input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan TB">
                </div>
              </div>
              <div class="form-group row">
                <label for="tekanan_darah_sistole" class="col-sm-2 col-form-label">Tekanan Darah</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control form-control-sm" name="tekanan_darah_sistole" id="tekanan_darah_sistole" placeholder="Sistole">
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control form-control-sm" name="tekanan_darah_diastole" id="tekanan_darah_diastole" placeholder="Diastole">
                </div>
              </div>
              <div class="form-group row">
                <label for="frekwensi_nafas" class="col-sm-2 col-form-label">Frekwensi Nafas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="frekwensi_nafas" id="frekwensi_nafas" placeholder="Masukkan Frekwensi Nafas">
                </div>
              </div>
              <div class="form-group row">
                <label for="lingkar_perut" class="col-sm-2 col-form-label">Lingkar Perut</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="lingkar_perut" id="lingkar_perut" placeholder="Masukkan Lingkar Perut">
                </div>
              </div>
              <div class="form-group row">
                <label for="heart_rate" class="col-sm-2 col-form-label">Heart Rate</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="heart_rate" id="heart_rate" placeholder="Masukkan Heart Rate">
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
                  
                <select name="kd_status_pulang"  class="form-control form-control-sm" id="kd_status_pulang"></select>  
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dokter</label>
                <div class="col-sm-10">
                  
                <select name="kd_dokter"  class="form-control form-control-sm" id="kd_dokter"></select>   
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 1</label>
                <div class="col-sm-10">
                  
                <select name="kd_diagnosa_1"  class="form-control form-control-sm" id="kd_diagnosa_1"></select>    
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 2</label>
                <div class="col-sm-10">
                <select name="kd_diagnosa_2"  class="form-control form-control-sm" id="kd_diagnosa_2"></select>    
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diagnosa 3</label>
                <div class="col-sm-10">
                  
                <select name="kd_diagnosa_3"  class="form-control form-control-sm" id="kd_diagnosa_3"></select>    
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Poli Rujuk Internal</label>
                <div class="col-sm-10">
                <select name="kd_poli_rujuk_internal"  class="form-control form-control-sm" id="kd_poli_rujuk_internal"></select>    
                </div>
              </div>

              <div class="form-group row">
                 <label for="col-sm-2 col-form-label font-weight-bold"> Rujuk Lanjut </label>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sarana</label>
                <div class="col-sm-10">
                <select name="kd_sarana"  class="form-control form-control-sm" id="kd_sarana"></select>   
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Spesialis</label>
                <div class="col-sm-10">
                <select name="spesialis"  class="form-control form-control-sm" id="spesialis"></select>    
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">SubSpesialis</label>
                <div class="col-sm-10">
                <select name="kd_sub_spesialis_1"  class="form-control form-control-sm" id="kd_sub_spesialis_1"></select>    
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
                <select name="kdppk"  class="form-control form-control-sm" id="kdppk"></select>    
                </div>
              </div>

              <input type="hidden" name="khusus" value="">
              <input type="hidden" name="no_kartu" id="no_kartu" value="">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tacc</label>
                <div class="col-sm-10">
                <select name="kd_tacc"  class="form-control form-control-sm" id="kd_tacc"></select>    
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alasan Tacc</label>
                <div class="col-sm-10">
                <select name="alasan_tacc"  class="form-control form-control-sm" id="alasan_tacc"></select>     
                </div>
              </div>
            </div>
            </div>
        </form>
      </div>
    </div>   
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

  $("#simpan_kunjungan").on("submit", function(event){
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