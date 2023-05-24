<style>
 #blink {
        font-size: 16px;
        font-weight: bold;
        color: #FF0000;
        transition: 0.5s;
    }
</style>
<?php 
    $no_daftar = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Order Obat Pasien</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4><i class="fas fa-pills"></i> Order Obat Non Racikan</h4></div>
        <div class="col-6 text-right">
            <a href="?page=dataobat">
                <button class="btn btn-sm btn-warning"><i class="fas fa-capsules"></i> Data Obat Apotek</button>
            </a>
        </div>
    </div>
    <div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
                <div class="row data-pengobatan">
                    <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
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
                    <div class="col-md-9" style="text-align: left; font-size: 14px;">
                        <br>
                        <table class="data_pasien" border="0" cellpadding="0">
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
                                <td width="100"><b>Nama Dokter</b></td>
                                <td width="10">:</td>
                                <td><?php echo $data['nm_dokter']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
                <?php
                    require_once "koneksi.php";
                    $no_daftar = @$_GET['id'];
                    $query_tampil = "SELECT * FROM tbl_pengobatan WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil); 
                    if (isset($data['no_pengobatan']) AND ($tgl_berobat = date("d-M-Y", strtotime($data['tgl_pengobatan']))))
                        {
                           echo "
                            <div>
                                No Pengobatan : <b>$data[no_pengobatan]</b>  Tanggal : <b>$tgl_berobat</b>
                            </div>";
                        }
                        else
                        {
                           echo "
                           <div id='blink'>
                                <b>Pemberitahuan : Resep Obat Belum Diinput oleh Dokter</font></b>
                            </div>";
                        }
                ?>
                <h5 align="center"> Order Obat Non Racikan</h5>
                <table  class="table table-hover display tabel-data">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Resep</th>
                            <th>Nama Obat</th>
                            <th>Aturan Pakai</th>
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
                        $nomor = 1;
                        $keterangan = "Belum ada data";
                        $query_pjlobat = "SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.total_penjualan, tbl_pengobatan.no_daftar, tbl_pengobatan.keterangan, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
                          LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
                          LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat

                        WHERE no_daftar ='$no_daftar' ";
                        $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
                     ?>
                    <tbody>
                        <?php  
                        while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
                            $subtotal   = $data_pjlobat['subtotal'];
                            $totalBayar = $totalBayar + $subtotal;
                            $keterangan = $data_pjlobat['keterangan'];                    
                            //$total_racik = $data_pjlobat['total_penjualan'];
                        ?>
                        <tr>
                            <td><?php echo $data_pjlobat['no']; ?></td>
                            <td><?php echo $data_pjlobat['no_pengobatan']; ?></td> 
                            <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                            <td><?php echo $data_pjlobat['akai']; ?></td>
                            <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                            <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
                            <td class="td-opsi">
                              
                                <!-- </a> -->
                                <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus"
                                    data-id="<?php echo $data_pjlobat['no']; ?>"
                                    data-nama="<?php echo $data_pjlobat['nm_obat']; ?>"
                                    data-stok="<?php echo $data_pjlobat['jml_jual']; ?>"
                                    data-subtot="<?php echo $data_pjlobat['subtotal']; ?>"
                                    data-exp="<?php echo $data_pjlobat['expired']; ?>"
                                    >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5" align="right" bgcolor="#F5F5F5">Total Obat Non Racik:</td>
                            <td colspan="2" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td width="130"><b>Keterangan</b></td>
                        <td width="10"><b> :</b></td>
                        <td style="font-weight: bold; color: #FF0000;"> <?php echo $keterangan; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-4">
                  <input type="hidden" class="form-control form-control-sm" id="no_daftar" value="<?php echo $no_daftar ?>" readonly>
                </div>
        <div class="col-md-7 data-pembelian row">
            <div class="position-relative form-group col-md-4">
                    <select name="status_obat" id="status_obat" class="form-control form-control-sm bg-warning" >
                    <option value="Belum dilayani">Belum dilayani</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="position-relative form-group col-md-5">
                 <button class="btn btn-primary btn-sm" id="btn_save" >Update status</button>
                 <a href="pages_cetak_surat/cetak_resepnonracik.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="Cetak Resep Non Racik" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i> Cetak Resep</button></a>
            </div>
        </div>
    </div>
   

<script type="text/javascript">
    $("#btn_save").click(function() {
        var no_daftar = $("#no_daftar").val();
        var status_obat = $("#status_obat").val();
        $.ajax({
            type: "POST",
            url: "ajax/update_layananobat.php",
            data: "no_daftar="+no_daftar+"&status_obat="+status_obat,
            success: function(hasil) {
                if(hasil=="berhasil") {
                    Swal.fire({
                      title: 'Berhasil',
                      text: 'Data Berhasil Disimpan',
                      type: 'success',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                    }).then((ok) => {
                      if (ok.value) {
                       window.location='?page=farmasi' ;
                      }
                    })
                } else if(hasil=="gagal") {
                    Swal.fire(
                      'Gagal',
                      'Data Gagal Disimpan',
                      'error'
                    )
                }
            }
        });
    });

    $("button[name='tombol_hapus']").click(function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var exp = $(this).data('exp');
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
          text: 'akan menghapus '+nama+' dan jumlah '+stok+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=pengobatanan",
              data: "id="+id+"&exp="+exp+"&stok="+stok+"&subtot="+subtot,
              success: function(hasil) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Data Berhasil Dihapus',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    window.location='?page=farmasi';
                  }
                })
              }
            })  
          }
        })
        }
    });
</script>
<script type="text/javascript">
    var blink = document.getElementById('blink');
    setInterval(function() {
        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 1000);
</script>

