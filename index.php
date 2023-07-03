<?php 

  require 'vendor/autoload.php'; 
  require_once "koneksi.php";
  include "config/setting.php";
  
  session_start();
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();


  if(!@$_SESSION['posisi_peg']) {
    echo "<script>window.location='login.php';</script>";
  } else {
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <link rel="icon" type="image/png" href="images/icon-1.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap_4/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/private_style/style_index.css">
    <link rel="stylesheet" href="asset/font_awesome/css/all.css">
    <link rel="stylesheet" href="asset/DataTables/datatables.min.css">
    <!-- <link rel="stylesheet" href="asset/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="asset/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="asset/bootstrap_datepicker1.9.0/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" href="asset/css/loader.css"> -->

    <!-- <script src="asset/js/jquery.tabledit.min.js"></script> -->
    <!-- <script src="agoi/jquery.js"></script> -->     
    <!-- <link rel="stylesheet" href="asset/css/style.css"> -->
    <title>
      ERM <?php echo $nama_klinik; ?> | 
      <?php 
      if(@$_GET['page']=='') {
        echo "Dashboard";
      } else if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat') {
        echo "Data Obat";
      } else if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {
        echo "Data Pegawai";
      } else if(@$_GET['page']=='data_tindakan' || @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan') {
        echo "Data Tindakan";
      } else if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='laporpenjualan' || @$_GET['page']=='datapenjualan_perobat') {
        echo "Data Penjualan";
      } else if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian' || @$_GET['page']=='laporpembelian') {
        echo "Data Pembelian";
      } else if(@$_GET['page']=='laporan') {
        echo "Laporan";
      } else if(@$_GET['page']=='datalaporan') {
        echo "Data Laporan";
      } else if(@$_GET['page']=='farmasi') {
        echo "Farmasi";
      }
      ?>
    </title>
  </head>
  <body class="bg-light">
    <div id="container">
      <div id="main">
        <div class="col-md-12 bg-primary p-1 title">
          <div class="row">
            <div class="col-md-6">
              <img src="images/logoklinik.png" style="border-radius: 10px 10px 10px 10px;" width="50" alt="">
              <span class="text-white font-weight-light">ERM-<?php echo $nama_klinik; ?> - <?php echo $kab; ?></span>
            </div>
            <div class="col-md-6 text-right mt-2">
              <a class="badge-pill badge-warning" style="padding: 4px"><i class="fas fa-user-circle"></i> No RM Terakhir :
                <?php 
                  $query_tampil = "SELECT * FROM tbl_pasien ORDER BY nomor_rm DESC LIMIT 1";
                  $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                  while($data = mysqli_fetch_array($sql_tampil)) {
                ?>
                <?php echo $data['nomor_rm']; ?>
                <?php } ?>
              </a>&nbsp;
              <span class="text-white tanggal-jam" id="tanggal"><?php echo gmdate("d-m-Y", time() + 60 * 60 * 7); ?> - Pukul</span><span class="text-white tanggal-jam" id="jam"></span><span class="text-white font-weight-light"></span>
              <div class="btn-group">
                <button type="button" class="btn btn-light btn-sm dropdown-toggle font-weight-light" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['posisi_peg']; ?></button>
                <div class="dropdown-menu dropdown-menu-right p-1">
                  <div class="col-12 text-center nama-posisi">
                    <h2><i class="fas fa-user-circle"></i></h2>
                    <span class="nama"><?php echo $_SESSION['nama_peg']; ?></span><br>
                    <span class="posisi">ID : <span id="id_session" class="posisi"><?php echo $_SESSION['id_peg']; ?></span>
                  </div>
                  <div class="row tombol">
                    <div class="col-3">
                      <button class="btn btn-sm btn-success" id="tombol_profil" data-toggle="modal" data-target="#profil_user">Profil</button>
                    </div>&nbsp;
                    <div class="col-3">
                      <button class="btn btn-sm btn-primary" id="tombol_password" data-toggle="modal" data-target="#password_user">UPass</button>
                    </div>&nbsp;&nbsp;
                    <div class="col-3">
                      <button class="btn btn-sm btn-danger" id="tombol_keluar">Logout</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 sidebar">
            <div class="accordion" id="menu">
              <ul class="list-group">
                <li href="#" class="list-group-item list-group-item-action menu-utama" data-toggle="collapse" data-target="#menu-collapse" aria-expanded="true" aria-controls="menu-collapse" style="border-radius: 5px 5px 0 0;"> Menu <i class="fas fa-list float-right mt-1"></i></li>
              </ul>
              <div id="menu-collapse" class="collapse show" aria-labelledby="" data-parent="#menu">
                <div class="accordion" id="daftar_menu">
                  <ul class="list-group">
                    <a href="./" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='') {echo "active";} ?>" style="border-radius: 0;"><i class="fas fa-home"></i> Home</a>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Apoteker' || $_SESSION['posisi_peg'] == 'Pendaftaran' ) { ?>
                      <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='tabelracikan' || @$_GET['page']=='datapegawai' || @$_GET['page']=='datapasien' || @$_GET['page']=='edit_datapasien' || @$_GET['page']=='data_tindakan' || @$_GET['page']=='transaksi' || @$_GET['page']=='bankdata' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='tambah_racikan' || @$_GET['page']=='racikanobat' || @$_GET['page']=='tambah_datatindakan'|| @$_GET['page']=='edit_datatindakan'|| @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='tambah_datapasien' || @$_GET['page']=='edit_datapasien' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='edit_racikan' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier' || @$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter' || @$_GET['page']=='info_kadaluarsa' || @$_GET['page']=='datalaborat' || @$_GET['page']=='tambah_datalaborat' || @$_GET['page']=='edit_datalaborat' || @$_GET['page']=='data_pasien_asuransi' || @$_GET['page']=='tambah_pasien_asuransi' || @$_GET['page']=='edit_pasien_asuransi' || @$_GET['page']=='aturan_pakai' || @$_GET['page']== 'cara_bayar' || @$_GET['page']== 'datafaskes' || @$_GET['page']== 'diagnosa') {echo "show";} ?>"
                        data-toggle="collapse" data-target="#menu-collapse-master" aria-expanded="true" aria-controls="menu-collapse-master">
                        <i class="fas fa-folder"></i> Data Master <i class="fas fa-angle-down float-right mt-1"></i></a>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Apoteker' || $_SESSION['posisi_peg'] == 'Pendaftaran' ) { ?>
                      <div id="menu-collapse-master" class="collapse <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='tabelracikan' || @$_GET['page']=='data_tindakan' || @$_GET['page']=='transaksi' || @$_GET['page']=='datapegawai' || @$_GET['page']=='datapasien' || @$_GET['page']=='tambah_datapasien' || @$_GET['page']=='edit_datapasien' || @$_GET['page']=='bankdata' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='racikanobat' || @$_GET['page']=='edit_racikan' || @$_GET['page']=='info_kadaluarsa' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier'|| @$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter'|| @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan' || @$_GET['page']=='datalaborat' || @$_GET['page']=='tambah_datalaborat' || @$_GET['page']=='edit_datalaborat' || @$_GET['page']=='data_pasien_asuransi' || @$_GET['page']=='tambah_pasien_asuransi' || @$_GET['page']=='edit_pasien_asuransi' || @$_GET['page']=='aturan_pakai' || @$_GET['page']=='edit_aturan_pakai' || @$_GET['page']== 'cara_bayar' || @$_GET['page']== 'datafaskes' || @$_GET['page']== 'diagnosa') {echo "show";} ?>"
                        aria-labelledby="" data-parent="#daftar_menu">
                        <ul class="list-group list-group-collapse">
                          <a href="?page=dataobat" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='info_kadaluarsa') {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Obat <i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <a href="?page=aturan_pakai" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='aturan_pakai' || @$_GET['page']=='edit_aturan_pakai' ) {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Aturan Pakai Obat <i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <a href="?page=diagnosa" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='tambah_diagnosa') {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Diagnosa ICD-10 <i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <a href="?page=data_tindakan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_tindakan' || @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan') {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Tindakan <i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <a href="?page=datalaborat" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datalaborat' || @$_GET['page']=='tambah_datalaborat' || @$_GET['page']=='edit_datalaborat' ) {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Laborat <i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <!-- <a href="?page=tabelracikan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='tabelracikan' || @$_GET['page']=='tambah_racikan' || @$_GET['page']=='edit_racikan' || @$_GET['page']=='racikanobat' || @$_GET['page']=='info_kadaluarsa') {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Obat Racikan <i class="fas fa-capsules float-right mt-1"></i>
                          </a> -->
                          <a href="?page=datapegawai" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Pegawai <i class="fas fa-users float-right mt-1"></i>
                          </a>
                          <a href="?page=datapasien" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapasien' || @$_GET['page']=='tambah_datapasien' || @$_GET['page']=='edit_datapasien') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Pasien <i class="fas fa-users float-right mt-1"></i>
                          </a>

                          <a href="?page=data_pasien_asuransi" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_pasien_asuransi' || @$_GET['page']=='tambah_pasien_asuransi' || @$_GET['page']=='edit_pasien_asuransi' ) {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Data Pasien Asuransi <i class="fas fa-users float-right mt-1"></i>
                          </a>
                          
                          <a href="?page=cara_bayar" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='cara_bayar') {echo "active";} ?>" style="border-radius: 0px;">
                            <i class="fas fa-angle-right"></i> Cara Bayar & Asuransi<i class="fas fa-dollar-sign float-right mt-1"></i>
                          </a>
                          
                          <a href="?page=transaksi" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='transaksi' || @$_GET['page']=='tambah_transaksi' || @$_GET['page']=='edit_transaksi') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Transaksi <i class="fas fa-users float-right mt-1"></i>
                          </a>
                          <a href="?page=bankdata" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='bankdata' || @$_GET['page']=='daftar_pasien') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Bank Data <i class="fas fa-users float-right mt-1"></i>
                          </a>
                          <a href="?page=datasupplier" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Supplier <i class="fas fa-briefcase-medical float-right mt-1"></i>
                          </a>
                          <a href="?page=datadokter" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter') {echo "active";} ?>">
                          <i class="fas fa-angle-right"></i> Data Dokter <i class="fas fa-briefcase-medical float-right mt-1"></i>
                          </a>

                          <a href="?page=datafaskes" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datafaskes') {echo "active";} ?>">
                          <i class="fas fa-angle-right"></i> Data Faskes Rujukan <i class="fas fa-briefcase-medical float-right mt-1"></i>
                          </a>
                        </ul>
                      </div>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Pendaftaran' ) { ?>
                      <ul class="list-group">                      
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='pendaftaran' || @$_GET['page']=='datapendaftaran' || @$_GET['page']=='edit_pendaftaran' || @$_GET['page']=='daftar_pasien'){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-pendaftaran" aria-expanded="true" aria-controls="menu-collapse-pendaftaran">
                          <i class="fas fa-users"></i> Pendaftaran <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>
                        <div id="menu-collapse-pendaftaran" class="collapse <?php if(@$_GET['page']=='pendaftaran' || @$_GET['page']=='daftar_pasien' || @$_GET['page']=='datapendaftaran' || @$_GET['page']=='edit_pendaftaran') {echo "show";} ?>" aria-labelledby=""
                          data-parent="#daftar_menu">
                          <a href="?page=pendaftaran" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='pendaftaran' || @$_GET['page']=='daftar_pasien') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Pendaftaran Pasien <i class="fas fa-plus-circle float-right mt-1"></i>
                          </a>
                          <a href="?page=datapendaftaran" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapendaftaran' || @$_GET['page']=='edit_pendaftaran') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Pendaftaran Pasien <i class="fas fa-users float-right mt-1"></i>
                          </a>
                        </div>
                      </ul>
                      
                      <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='antrian' || @$_GET['page']=='nomor-antrian' || @$_GET['page']=='panggilan-antrian' ){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-antrian" aria-expanded="true" aria-controls="menu-collapse-antrian">
                          <i class="fas fa-bullhorn"></i> Antrian <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>
                        <div id="menu-collapse-antrian" class="collapse <?php if(@$_GET['page']=='antrian' || @$_GET['page']=='panggilan-antrian' || @$_GET['page']=='nomor-antrian') {echo "show";} ?>" aria-labelledby=""
                          data-parent="#daftar_menu">
                          <a href="?page=antrian" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='antrian' || @$_GET['page']=='panggilan-antrian') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Panggil Antrian <i class="fas fa-bullhorn float-right mt-1"></i>
                          </a>
                          <!-- <a href="?page=nomor-antrian" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='nomor-antrian') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Ambil Antrian <i class="fas fa-bullhorn float-right mt-1"></i>
                          </a> -->
                        </div>
                      </ul>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2'  | $_SESSION['posisi_peg'] == 'Dokter3' ) { ?>
                      <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='ruang_rawat' || @$_GET['page']=='perawatan' || @$_GET['page']=='perawatan2' | @$_GET['page']=='perawatan3' ){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-ruangRawat" aria-expanded="true" aria-controls="menu-collapse-ruangRawat">
                          <i class="fas fa-book-medical"></i> Rawat Pasien <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>
                        <div id="menu-collapse-ruangRawat" class="collapse <?php if(@$_GET['page']=='perawatan' || @$_GET['page']=='perawatan2' | @$_GET['page']=='perawatan3') {echo "show";} ?>" aria-labelledby=""
                          data-parent="#daftar_menu">
                          <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter') { ?> 
                            <a href="?page=perawatan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='perawatan') {echo "active";} ?>"><i class="fas fa-angle-right"></i> Rawat <?php echo $dokter1; ?>
                            </a>
                          <?php } ?>
                          <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter2' ) { ?> 
                            <a href="?page=perawatan2" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='perawatan2') {echo "active";} ?>">
                              <i class="fas fa-angle-right"></i> Rawat <?php echo $dokter2; ?>
                            </a>
                          <?php } ?>
                          <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter3' ) { ?> 
                            <a href="?page=perawatan3" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='perawatan3') {echo "active";} ?>">
                              <i class="fas fa-angle-right"></i> Rawat <?php echo $dokter3; ?>
                            </a>
                          <?php } ?>
                        </div>
                      </ul>
                      <a href="?page=riwayatmedis" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='riwayatmedis'|| @$_GET['page']=='rekammedis') {echo "active";} ?>">
                        <i class="fas fa-bed"></i> Riwayat Medis Pasien
                      </a>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin'|| $_SESSION['posisi_peg'] == 'Apoteker' ) { ?>
                      <a href="?page=farmasi" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='farmasi' || @$_GET['page']=='farmasiorderobat' || @$_GET['page']=='farmasiobatracik') {echo "active";} ?>">
                        <i class="fas fa-capsules"></i> Farmasi Rawat Jalan
                      </a>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Kasir' ) { ?>
                      <a href="?page=kasir" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='kasir'|| @$_GET['page']=='pembayaran') {echo "active";} ?>">
                        <i class="fas fa-file-invoice-dollar"></i> Kasir Rawat Jalan
                      </a>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Pendaftaran') { ?>
                      <ul class="list-group">                    
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='suratijin' || @$_GET['page']=='tambah_ijin'  || @$_GET['page']=='suratsehat' || @$_GET['page']=='suratsakit' || @$_GET['page']=='swab_antigen' || @$_GET['page']=='form_kosong' || $_GET['page']=='rujukan'){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-surat" aria-expanded="true" aria-controls="menu-collapse-surat">
                          <i class="fas fa-envelope"></i> Surat & Form <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>

                        <div id="menu-collapse-surat" class="collapse <?php if(@$_GET['page']=='suratijin' || @$_GET['page']=='swab_antigen' || @$_GET['page']=='suratsehat' || @$_GET['page']=='suratsakit' || $_GET['page']=='rujukan' || $_GET['page']=='form_kosong') {echo "show";} ?>" aria-labelledby=""
                          data-parent="#daftar_menu">

                          <a href="?page=suratijin" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='suratijin' || @$_GET['page']=='tambah_ijin' || @$_GET['page']=='lihat_suratijin'|| @$_GET['page']=='tambah_ijin_mandiri' || @$_GET['page']=='edit_suratijin' ) {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Surat Ijin Sakit <i class="fas fa-envelope float-right mt-1"></i>
                          </a>

                          <a href="?page=suratsehat" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='suratsehat' || @$_GET['page']=='tambah_suratsehat') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Surat Ket. Sehat <i class="fas fa-envelope float-right mt-1"></i>
                          </a>

                          <a href="?page=suratsakit" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='suratsakit' || @$_GET['page']=='tambah_suratsakit') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Surat Ket. Sakit <i class="fas fa-envelope float-right mt-1"></i>
                          </a>

                          <a href="?page=rujukan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='rujukan') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Rujukan <i class="fas fa-envelope float-right mt-1"></i>
                          </a>
                          <a href="?page=swab_antigen" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='swab_antigen' || @$_GET['page']=='tambah_swabantigen') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Data Hasil Swab Antigen <i class="fas fa-envelope float-right mt-1"></i>
                          </a>

                          <a href="?page=form_kosong" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='form_kosong') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Cetak Form Kosong <i class="fas fa-print float-right mt-1"></i>
                          </a>
                        </div>
                      </ul>            
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                      <ul class="list-group">                      
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='datapembelian' || @$_GET['page']=='peramalan'){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-apotek" aria-expanded="true" aria-controls="menu-collapse-apotek">
                          <i class="fas fa-capsules"></i> Apotek <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>
                        <div id="menu-collapse-apotek" class="collapse <?php if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='datapenjualan_perobat' || @$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian' || @$_GET['page']=='peramalan' || @$_GET['page']=='hasil_peramalan' || @$_GET['page']=='riwayat_peramalan') {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                          <a href="?page=entry_datapenjualan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='datapenjualan_perobat') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Penjualan Obat<i class="fas fa-capsules float-right mt-1"></i>
                          </a>
                          <a href="?page=entry_datapembelian" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Pembelian Obat<i class="fas fa-capsules float-right mt-1"></i>
                          </a>

                          <a href="?page=peramalan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='peramalan' || @$_GET['page']=='hasil_peramalan' || @$_GET['page']=='riwayat_peramalan') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Peramalan Penjualan<i class="fas fa-chart-bar float-right mt-1"></i>
                          </a>
                        </div>
                      </ul>
                    <?php } ?>

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' ) { ?>
                      <a href="?page=datalaporan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datalaporan' || @$_GET['page']=='laporpasien' || @$_GET['page']=='laporpendapatan' || @$_GET['page']=='laporpenjualan_apotek' || @$_GET['page']=='laporpembelian_apotek'){echo "active";} ?>">
                        <i class="fas fa-bed"></i> Laporan Pasien
                      </a>
                    <?php } ?>

                    <!-- <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2') { ?>
                      <ul class="list-group">                      
                        <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='backup'){echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-backup" aria-expanded="true" aria-controls="menu-collapse-backup">
                          <i class="fas fa-download"></i> Back Up Database <i class="fas fa-angle-down float-right mt-1"></i>
                        </a>

                        <div id="menu-collapse-backup" class="collapse <?php if(@$_GET['page']=='backup') {echo "show";} ?>" aria-labelledby=""
                          data-parent="#daftar_menu">
                          <a href="?page=backup" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='backup') {echo "active";} ?>">
                            <i class="fas fa-angle-right"></i> Back up database <i class="fas fa-download float-right mt-1"></i>
                          </a>
                        </div>
                      </ul>
                    <?php } ?> -->

                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2') { ?>
                      <a href="?page=setting" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='setting') {echo "active";} ?>">
                        <i class="fas fa-wrench"></i> Setting Aplikasi
                      </a>
                    <?php } ?>
                    <!-- <a href="?page=laporan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='laporan') {echo "active";} ?>">
                      <i class="fas fa-file-alt"></i> Test Page
                    </a>  -->
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <script src="asset/Jquery/jquery-3.3.1.min.js"></script>
          <script src="asset/sweetalert/dist/sweetalert2.min.js"></script>
          <script src="asset/bootstrap_datepicker1.9.0/js/bootstrap-datepicker.min.js"></script>
          <script src="asset/bootstrap_datepicker1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
          <script src="asset/ChartJs/Chart.min.js"></script>

          <div class="col-md-10 content">
            <?php 
              if(@$_GET['page']=='') {
                include 'pages/home.php';
        			// echo "Halaman Dashboard";
              } else if(@$_GET['page']=='dataobat') {
                include 'pages/dataobat.php';
              } else if(@$_GET['page']=='aturan_pakai') {
                include 'pages/aturan_pakai/aturan_pakai.php';
              } else if(@$_GET['page']=='edit_aturan_pakai') {
                include 'pages/aturan_pakai/edit_aturan_pakai.php';
              } else if(@$_GET['page']=='info_kadaluarsa') {
                include 'pages/info_kadaluarsa.php';

              } else if(@$_GET['page']=='data_tindakan') {
                include 'pages/js/datatindakan.php';

              } else if(@$_GET['page']=='edit_datatindakan') {
                include 'pages/js/form_editdatatindakan.php';

              } else if(@$_GET['page']=='tambah_datatindakan') {
                include 'pages/js/form_tmbdatatindakan.php';

              } else if(@$_GET['page']=='datalaborat') {
                include 'pages/datalaborat.php';
              } else if(@$_GET['page']=='tambah_datalaborat') {
                include 'pages/form_tmbdatalaborat.php';
              } else if(@$_GET['page']=='edit_datalaborat') {
                include 'pages/form_editdatalaborat.php';

              } else if(@$_GET['page']=='data_pasien_asuransi') {
                include 'pages/data_pasien_asuransi.php';
              } else if(@$_GET['page']=='edit_pasien_asuransi') {
                include 'pages/form_editpasien_asuransi.php';

              } else if(@$_GET['page']=='transaksi') {
                include 'pages/js/datatransaksi.php';
              } else if(@$_GET['page']=='cara_bayar') {
                include 'pages/cara_bayar.php';


              } else if(@$_GET['page']=='datapasien') {
                include 'pages/datapasien.php';
              } else if(@$_GET['page']=='tambah_datapasien') {
                include 'pages/form_tmbdatapasien.php';
              } else if(@$_GET['page']=='tambah_datapasien') {
                include 'pages/form_tmbdatapasien.php';
              } else if(@$_GET['page']=='edit_datapasien') {
                include 'pages/form_editdatapasien.php';
              } else if(@$_GET['page']=='datapendaftaran') {
                include 'pages/datapendaftaran.php';

              } else if(@$_GET['page']=='bankdata') {
                include 'pages/bankdata.php';
              } else if(@$_GET['page']=='daftar_pasien') {
                include 'pages/form_daftarpasien.php';

              } else if(@$_GET['page']=='riwayatmedis') {
                include 'pages/riwayat/riwayatmedis.php';
              } else if(@$_GET['page']=='rekammedis') {
                include 'pages/riwayat/rekammedis.php';

              } else if(@$_GET['page']=='kasir') {
                include 'pages/kasir/kasir.php';
              } else if(@$_GET['page']=='pembayaran') {
                include 'pages/kasir/pembayaran.php';

              } else if(@$_GET['page']=='pendaftaran') {
                include 'pages/pendaftaran.php';
              } else if(@$_GET['page']=='edit_pendaftaran') {
                include 'pages/form_editpendaftaran.php';
              } else if(@$_GET['page']=='form_editdaftarpasien') {
                include 'pages/form_editdaftarpasien.php';
              } else if(@$_GET['page']=='form_editdatapasien') {
                include 'pages/form_editdatapasien.php';

              } else if(@$_GET['page']=='perawatan') {
                include 'pages/perawatan_pasien.php';
              } else if(@$_GET['page']=='perawatan2') {
                include 'pages/perawatan_pasien2.php';
              } else if(@$_GET['page']=='perawatan3') {
                include 'pages/perawatan_pasien3.php';
              } else if(@$_GET['page']=='form_assesment') {
                include 'pages/form_assesment.php'; 
              } else if(@$_GET['page']=='form_kunjungan') {
                include 'pages/form_kunjungan.php';
                // Panggil Antrian pada halaman Assesment
              } else if(@$_GET['page']=='panggil') {
                include 'pages/panggil.php';
              } else if(@$_GET['page']=='panggilpasien') {
                include 'pages/panggilpasien.php';
              } else if(@$_GET['page']=='diagnosa') {
              include 'pages/datadiagnosa/diagnosa.php';
              } else if(@$_GET['page']=='form_diagnosa') {
                include 'pages/form_diagnosa.php';
              } else if(@$_GET['page']=='entry_obatpasien') {
                include 'pages/entry_obatpasien.php';
              } else if(@$_GET['page']=='entry_tindakanpasien') {
                include 'pages/entry_tindakanpasien.php';
              } else if(@$_GET['page']=='entry_laboratpasien') {
                include 'pages/entry_laboratpasien.php';
              } else if(@$_GET['page']=='entry_obatracik') {
                include 'pages/entry_obatracik.php';
              } else if(@$_GET['page']=='edit_racikan') {
                include 'pages/edit_racikan.php';
              } else if(@$_GET['page']=='racikanobat') {
                include 'pages/racikan_obat.php';
              } else if(@$_GET['page']=='tabelracikan') {
                include 'pages/tabel_racikan.php';
              } else if(@$_GET['page']=='riwayatperiksa') {
                include 'pages/riwayat/riwayatperiksa.php';

              } else if(@$_GET['page']=='suratijin') {
                include 'pages/surat/suratijin.php';
              } else if(@$_GET['page']=='tambah_ijin') {
                include 'pages/surat/tambah_ijin.php';
              } else if(@$_GET['page']=='tambah_ijin_mandiri') {
                include 'pages/surat/tambah_ijin_mandiri.php';
              } else if(@$_GET['page']=='edit_suratijin') {
                include 'pages/surat/edit_suratijin.php';
              } else if(@$_GET['page']=='lihat_suratijin') {
                include 'pages/surat/lihat_suratijin.php';
              } else if(@$_GET['page']=='suratsehat') {
                include 'pages/surat/suratsehat.php';
              } else if(@$_GET['page']=='tambah_suratsehat') {
                include 'pages/surat/tambah_suratsehat.php';
              } else if(@$_GET['page']=='tambah_suratsehat_mandiri') {
                include 'pages/surat/tambah_suratsehat_mandiri.php';
              } else if(@$_GET['page']=='edit_suratsehat') {
                include 'pages/surat/edit_suratsehat.php';
              } else if(@$_GET['page']=='suratsakit') {
                include 'pages/surat/suratsakit.php';
              } else if(@$_GET['page']=='tambah_suratsakit') {
                include 'pages/surat/tambah_suratsakit.php';
              } else if(@$_GET['page']=='rujukan') {
                include 'pages/surat/rujukan.php';
              } else if(@$_GET['page']=='tambah_rujukan') {
                include 'pages/surat/tambah_rujukan.php';
              } else if(@$_GET['page']=='form_kosong') {
                include 'pages/surat/form_kosong.php';
              } else if(@$_GET['page']=='swab_antigen') {
                include 'pages/surat/swab_antigen.php';
              } else if(@$_GET['page']=='tambah_swabantigen') {
                include 'pages/surat/tambah_swabantigen.php';

              /*  } else if(@$_GET['page']=='transaksi') {
                include 'pages/kasir/transaksi.php';*/

              } else if(@$_GET['page']=='tambah_transaksi') {
                include 'pages/kasir/kasirPembayaran.php';

              } else if(@$_GET['page']=='antrian') {
                include 'panggilan-antrian/index.php';
                /*   include 'pages/panggilan-antrian/index.php';*/
              } else if(@$_GET['page']=='nomor-antrian') {
                include 'nomor-antrian/index.php';
              } else if(@$_GET['page']=='panggilan-antrian') {
                include 'panggilan-antrian/index.php';

              } else if(@$_GET['page']=='datadokter') {
                include 'pages/datadokter.php';
              } else if(@$_GET['page']=='tambah_datadokter') {
                include 'pages/form_tmbdatadokter.php';
              } else if(@$_GET['page']=='edit_datadokter') {
                include 'pages/form_editdatadokter.php';
              } else if(@$_GET['page']=='backup') {
                include 'pages/backup/backup.php';
              } else if(@$_GET['page']=='datafaskes') {
                include 'pages/datafaskes.php';

              } else if(@$_GET['page']=='datapegawai') {
                include 'pages/datapegawai.php';
              } else if(@$_GET['page']=='tambah_datapegawai') {
                include 'pages/form_tmbdatapegawai.php';
              } else if(@$_GET['page']=='tambah_datapegawai') {
                include 'pages/form_tmbdatapegawai.php';
              } else if(@$_GET['page']=='edit_datapegawai') {
                include 'pages/form_editdatapegawai.php';
              } else if(@$_GET['page']=='tambah_dataobat') {
                include 'pages/form_tmbdataobat.php';
              } else if(@$_GET['page']=='edit_dataobat') {
                include 'pages/form_editdataobat.php';
              } else if(@$_GET['page']=='datasupplier') {
                include 'pages/datasupplier.php';
              } else if(@$_GET['page']=='tambah_datasupplier') {
                include 'pages/form_tmbdatasupplier.php';
              } else if(@$_GET['page']=='edit_datasupplier') {
                include 'pages/form_editdatasupplier.php';
              } else if(@$_GET['page']=='datapenjualan') {
                include 'pages/datapenjualan.php';
              } else if(@$_GET['page']=='datapenjualan_perobat') {
                include 'pages/datapjl_perobat.php';
              } else if(@$_GET['page']=='datapembelian') {
                include 'pages/datapembelian.php';
              } else if(@$_GET['page']=='entry_datapenjualan') {
                include 'pages/form_entrypenjualan.php';
              } else if(@$_GET['page']=='entry_datapembelian') {
                include 'pages/form_entrypembelian.php';

              } else if(@$_GET['page']=='laporpenjualan_apotek') {
                include 'pages/laporpenjualan_apotek.php';

              } else if(@$_GET['page']=='ubahpassword') {
                include 'pages/user/ubahpassword.php';

              } else if(@$_GET['page']=='laporpembelian_apotek') {
                include 'pages/laporpembelian_apotek.php';

              } else if(@$_GET['page']=='laporpasien') {
                include 'pages/laporpasien.php';

              } else if(@$_GET['page']=='laporpendapatan') {
                include 'pages/laporpendapatan.php';
              } else if(@$_GET['page']=='form_laporanpenjualan') {
                include 'pages/form_laporanpenjualan.php';
              } else if(@$_GET['page']=='form_laporanpembelian') {
                include 'pages/form_laporanpembelian.php';
              } else if(@$_GET['page']=='peramalan') {
                if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') {
                  include 'pages/peramalan.php';
                } else {
                }
              } else if(@$_GET['page']=='hasil_peramalan') {
                include 'pages/hasilperamalan.php';
              } else if(@$_GET['page']=='riwayat_peramalan') {
                include 'pages/riwayat_peramalan.php';
              } else if(@$_GET['page']=='laporan') {
                include 'pages/laporan.php';
              } else if(@$_GET['page']=='datalaporan') {
                include 'pages/datalaporan.php';
              } else if(@$_GET['page']=='farmasi') {
                include 'pages/farmasi/farmasi.php';
              } else if(@$_GET['page']=='farmasiorderobat') {
                include 'pages/farmasi/farmasiorderobat.php';
              } else if(@$_GET['page']=='farmasiobatracik') {
                include 'pages/farmasi/farmasiobatracik.php';
              } else if(@$_GET['page']=='setting') {
                include 'pages/setting.php';
              } 
            ?>
          </div>

          <!-- Modal profil user-->
          <div class="modal fade" id="profil_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Profil Pegawai</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="tabel-profil">
                    <?php 
                    $query = "SELECT * FROM tbl_pegawai WHERE id_peg = '$_SESSION[id_peg]'";
                    $sql = mysqli_query($conn, $query) or die ($conn->error);
                    $data = mysqli_fetch_array($sql);
                    ?>
                    <tr>
                      <th>ID</th>
                      <td> <?php echo $data['id_peg']; ?></td>
                    </tr>
                    <tr>
                      <th>Nama</th>
                      <td> <?php echo $data['nama_peg']; ?></td>
                    </tr>
                    <tr>
                      <th>Posisi</th>
                      <td> <?php echo $data['pos_peg']; 
                      if ($data['pos_peg']=="Manager" || $data['pos_peg']=="Admin") {
                        ?> 
                        <i class="fas fa-check-circle text-info"></i>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Jenis Kelamin</th>
                    <td> <?php echo $data['jk_peg']; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Lahir</th>
                    <td> <?php echo $data['lhr_peg']; ?></td>
                  </tr>
                  <tr>
                    <th style="vertical-align: top;">Alamat</th>
                    <td> <?php echo $data['alamat_peg']; ?></td>
                  </tr>
                  <tr>
                    <th>No Handphone</th>
                    <td> <?php echo $data['hp_peg']; ?></td>
                  </tr>
                  <tr>
                    <th>Username</th>
                    <td> <?php echo $data['username']; ?></td>
                  </tr>
                  <tr>
                    <th>Password</th>
                    <td> xxxxxxxx</td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <a href="?page=edit_datapegawai&id=<?php echo $_SESSION['id_peg'] ?>" class="">
                  <button type="button" class="btn btn-primary btn-sm">Edit</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->

    <!-- Modal Update Password -->
    <div class="modal fade" id="password_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ganti Password Anda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php 
            $query = "SELECT * FROM tbl_pegawai WHERE id_peg = '$_SESSION[id_peg]'";
            $sql = mysqli_query($conn, $query) or die ($conn->error);
            $data = mysqli_fetch_array($sql);
            ?>
            <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
              <div class="form-group">
                <label for="password1">Password Lama</label>
                <input type="password" name="password1" class="form-control" value="<?php echo $data['password']; ?>" placeholder="Password Lama" title="Password Lama" required autofocus>
              </div>
              <div class="form-group">
                <label for="password2">Password Baru</label>
                <input type="password" name="password2" class="form-control" value="" placeholder="Password Baru" title="Password Baru" required>
              </div>
              <div class="form-group">
                <label for="password3">Konfirmasi Password</label>
                <input type="password" name="password3" class="form-control" value="" placeholder="Konfirmasi Password Baru" title="Konfirmasi Password Baru" required>
              </div>
              <button type="submit" name="btnup" class="btn btn-info" style="width:100%">Update</button>
            </form>
            <br><br>
          </div>
        </div>
      </div>
      <?php
        if (isset($_POST['btnup'])):
          $password1 = htmlentities(strip_tags($_POST['password1']));
          $password2 = htmlentities(strip_tags($_POST['password2']));
          $password3 = htmlentities(strip_tags($_POST['password3']));

          $query = "SELECT * FROM tbl_pegawai WHERE id_peg='$_SESSION[id_peg]' AND password='$password1'";
          $sql = mysqli_query($conn, $query) or die ($conn->error);

          /*$cek_data = mysqli_query($conn, "SELECT * FROM tbl_pegawai WHERE username='$_SESSION[username]' AND password='$password1'");*/
          if (mysqli_num_rows($sql)==0) {
            echo "<script>alert('Gagal! Password Lama tidak cocok'); window.location='?page=';</script>";
            exit;
          }else {
            if ($password2 <> $password3) {
              echo "<script>alert('Gagal! Konfirmasi Password Baru tidak cocok'); window.location='?page=';</script>";
              exit;
            }else {
              $update = mysqli_query($conn, "UPDATE tbl_pegawai SET password='$password2' WHERE id_peg='$_SESSION[id_peg]'");
              if ($update) {
                echo "<script>alert('Password berhasil diperbarui!'); window.location='?page=';</script>";
                exit;
              }else {
                echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='?page=';</script>";
                exit;
              }
            }
          }
        endif;
      ?>
    </div>
    <!-- </div>
    </div>
    </div>
    </div>
    </div> -->
    <footer>
      <i class="fas fa-copyright"></i> ERM <?php echo $nama_klinik; ?> (Versi 1.3) 2023
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- <script src="asset/ajax/popper.min.js"></script> -->
    <script src="asset/bootstrap_4/js/bootstrap.min.js"></script>
    <script src="asset/DataTables/datatables.min.js"></script>
    <script scr="asset/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>

    <script>
      var id_session = $("#id_session").text();
      $(document).ready(function() {
        $('#example').DataTable({
              //"responsive": true
        });
        $('#example2').DataTable({

        });
        $('#example3').DataTable({

        });

        $('#tbldata_penjualan').DataTable({
         lengthMenu : [[25, 50, -1], [25, 50, "All"]]
       });

        $('#tbl_riwayatperamalan').DataTable({
         lengthMenu : [[30, 50, -1], [30, 50, "All"]]
       });

        $('#tbl_pjlobat').DataTable({
         lengthMenu : [[30, 50, -1], [30, 50, "All"]]
       });

        $('#tabel_dataobat').DataTable({
              // ordering: false,
          lengthMenu : [[30, 50, 100, -1], [30, 50, 100, "All"]],
          order: [[1, "asc"]]
        });

        $('#tabel_dataobatracik').DataTable({
              // ordering: false,
          lengthMenu : [[30, 50, 100, -1], [30, 50, 100, "All"]],
          order: [[1, "asc"]]
        });

        $('#tabl_datareg').DataTable({
              // ordering: false,
          lengthMenu : [[40, 50, 100, -2], [40, 50, 100, "All"]],
          order: [[1, "asc"]]
        });
        $('#tabel_datadaftar').DataTable({
              // ordering: false,
          lengthMenu : [[20, 30, 40, -2], [20, 30, 40, "All"]],
          order: [[1, "DESC"]]
        });

      });
      $("#tombol_keluar").click(function(){
            // alert("Log Out");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan keluar dari aplikasi',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((tes) => {
          if (tes.value) {
            $.ajax({
              type: "POST",
              url: "ajax/logout.php",
              success: function(hasil) {
                window.location='login.php';
              }
            })  
          }
        })
      });
      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
            // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function() {
          startTime()
        }, 500);
      }
      startTime();
    </script>
  </body>
</html>
<?php } ?>