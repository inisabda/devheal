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
        <div class="col-6">
            <h4><i class="fas fa-money-check-alt"></i> Pembayaran Tagihan Pasien</h4>
        </div>
        <!-- <div class="col-6 text-right">
            <a href="?page=dataobat">
                <button class="btn btn-sm btn-warning"><i class="fas fa-capsules"></i> Data Obat Apotek</button>
            </a>
        </div> -->
    </div>
    <div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
                <div class="row data-pasien">
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
        <div class="row" style="padding: 0 16px; ">
            <div class="col-md-12 vertical-form">
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-list-alt"></i> Tagihan Obat Pasien</h5>
                        <table class="table table-striped display tabel-data vertical-form">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Jmlh</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <?php 
                                $no_daftar = @$_GET['id'];
                                $totalBayar = 0; 
                                $tgl_sekarang = date('Y-m-d');
                                $nomor = 1;
                                $query_pjlobat = "SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
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
                                ?>
                                <tr>
                                    <td><?php echo $nomor++; ?>.</td>
                                    <td width="5%"><?php echo $data_pjlobat['nm_obat']; ?></td>
                                    <td width="21%"><?php echo $data_pjlobat['akai']; ?></td>
                                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                                    <td>Rp. <?php echo number_format($data_pjlobat['hrg_jual'],2,',','.'); ?></td>
                                    <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5" align="right" bgcolor="#F5F5F5">Total Obat Oral :</td>
                                    <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                                </tr>
                            </tbody>                              
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 align="center"> Data Pemberian Obat Racikan </h5>
                        <table id="" class="table table-striped display tabel-data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <?php 
                                require_once "koneksi.php";
                                $no_daftar = @$_GET['id'];
                                $tgl_sekarang = date('Y-m-d');
                                $totel_bayar = 0;
                                $nama_racikan = 0;
                                $keterangan = 0;
                                $jumlah_puyer = 0;
                                $pakai = 0;
                                $nomor = 1;
                                $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.total_penjualan, tbl_racikan.nama_racikan, tbl_racikan.akai, tbl_racikan.keterangan, tbl_racikan.jml_puyer, tbl_racikan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_racikandetail
                                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                                  LEFT JOIN tbl_dataobat ON tbl_racikandetail.kd_obat=tbl_dataobat.kd_obat

                                WHERE no_daftar ='$no_daftar' ";
                                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
                             ?>
                            <tbody>
                                <?php  
                                    while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
                                        $subtotal   = $data_pjlobat['subtotal'];
                                            $totel_bayar = $totel_bayar + $subtotal;
                                         $total_racik = $data_pjlobat['total_penjualan'];
                                         $nama_racikan = $data_pjlobat['nama_racikan'];
                                         $keterangan = $data_pjlobat['keterangan'];
                                         $jumlah_puyer = $data_pjlobat['jml_puyer'];
                                         $pakai = $data_pjlobat['akai'];
                                ?>
                                <tr>
                                    <td><?php echo $data_pjlobat['no']; ?></td> 
                                    <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                                    <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" align="right" bgcolor="#F5F5F5">Total Obat Racik:</td>
                                    <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totel_bayar,2,',','.'); ?></td>
                                </tr>
                            </tbody>
                        </table>        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-list-alt"></i> Tagihan Laborat Pasien</h5>                
                        <table class="table table-striped display tabel-data vertical-form">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dokter</th>
                                    <th>Nama Laborat</th>
                                    <th>Hasil Laborat</th>
                                    <th>Harga Laborat</th>
                                </tr>
                            </thead>
                            <?php 
                                $no_daftar = @$_GET['id'];
                                $totil = 0;
                                $tota_bayar = 0;
                                $tgl_sekarang = date('Y-m-d');
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
                                    $totil = $data_lab['hrg_lab'];
                                    // total bayar adalah penjumlahan dari keseluruhan total
                                    $tota_bayar += $totil;
                                ?>
                                <tr>
                                    <td><?php echo $nomor++; ?>.</td>
                                    <td><?php echo $data_lab['nm_dokter']; ?></td>
                                    <td><?php echo $data_lab['nm_lab']; ?></td>
                                    <td class="text-right"><?php echo $data_lab['hasil_lab']; ?> Mg/dL</td>
                                    <td>Rp. <?php echo number_format($data_lab['hrg_lab'],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tr>
                                <td colspan="4" align="right" bgcolor="#F5F5F5">Total Harga Pemeriksaan Laborat :</td>
                                <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($tota_bayar,2,',','.'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-list-alt"></i> Tagihan Tindakan & Pemeriksaan Pasien</h5>                
                        <table class="table table-striped display tabel-data vertical-form">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dokter</th>
                                    <th>Nama Tindakan</th>
                                    <th>Harga Tindakan</th>
                                </tr>
                            </thead>
                            <?php 
                                $no_daftar = @$_GET['id'];
                                $total = 0;
                                $tot_bayar = 0;
                                $tgl_sekarang = date('Y-m-d');
                                $nomor = 1;
                                $query_pjltindakan = "SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan,tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan FROM tbl_tindakandetail
                                  LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                                  LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                                WHERE no_daftar ='$no_daftar' ";
                                $sql_pjltindakan = mysqli_query($conn, $query_pjltindakan) or die ($conn->error);
                             ?>
                            <tbody>
                                <?php  
                                    while($data_pjltindakan = mysqli_fetch_array($sql_pjltindakan)) {          
                                    $total = $data_pjltindakan['hrg_tindakan'];
                                    // total bayar adalah penjumlahan dari keseluruhan total
                                    $tot_bayar += $total;
                                ?>
                                <tr>
                                    <td><?php echo $nomor++; ?>.</td>
                                    <td><?php echo $data_pjltindakan['nm_dokter']; ?></td>
                                    <td><?php echo $data_pjltindakan['nama_tindakan']; ?></td>
                                    <td>Rp. <?php echo number_format($data_pjltindakan['hrg_tindakan'],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tr>
                                <td colspan="3" align="right" bgcolor="#F5F5F5">Total Harga Tindakan :</td>
                                <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($tot_bayar,2,',','.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="padding:  0 16px; right: 0; font-size: 24px">
            <div class="col-md-12 vertical-form">               
                <span align="right"><strong>Total Tagihan = </strong></span>
                <span bgcolor="#F5F5F5"><font color="red"><strong>Rp. <?php echo number_format($tot_bayar+$totel_bayar+$totalBayar+$tota_bayar,2,',','.'); ?></strong></font></span>                
            </div>
            <form method="post" id="simpan_transaksi">     
                <input type="hidden" id="no_transaksi" placeholder="nomor transaksi" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
                <input type="hidden" class="form-control form-control-sm" name="no_daftar" id="no_daftar" value="<?php echo $data['no_daftar']; ?>">
                <input name="tgl_transaksi" id="tgl_transaksi" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                <div class="form-group row pt-1">
                    <input id="total_penjualan"  onkeyup="sum();" placeholder="" type="hidden" value="<?php echo ($tot_bayar+$totel_bayar+$totalBayar+$tota_bayar); ?>" class="form-control" placeholder="0">
                    <label for="administrasi" class="col-sm-4 col-form-label">Uang Administrasi</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                        </div>
                        <input  id="administrasi"  onkeyup="sum();" type="number" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row pt-1">
                    <label for="diskon" class="col-sm-4 col-form-label">Diskon</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                        </div>
                        <input id="diskon" onkeyup="sum();" type="number" class="form-control" value="0">
                    </div>
                </div>
                <div class="form-group row pt-1">                
                    <label for="total_bayar" class="col-sm-4 col-form-label"><font color="red">Total Pembayaran</font></label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span style="font-weight: bold; color: #FF0000;" class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                        </div>
                        <input style="font-weight: bold; color: #FF0000;" type="text" class="form-control" id="total_bayar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="0">
                    </div>
                </div>
                <div class="form-group row pt-1">                
                    <label for="jml_uang" class="col-sm-4 col-form-label">Uang Bayar</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                        </div>
                        <input id="jml_uang" onkeyup="sum();" type="number" class="form-control" placeholder="0">
                    </div>
                </div>
                <div class="form-group row pt-1">
                    <label for="jml_kembali" style="color: #4169E1;" class="col-sm-4 col-form-label">Kembalian</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span style="font-weight: bold; color: #4169E1;" class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                        </div>
                        <input style="font-weight: bold; color: #4169E1;" type="text" class="form-control" id="jml_kembali"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="0">
                    </div>
                </div>
                <div class="form-group row pt-1">
                    <input type="hidden" class="form-control form-control-sm" name="status_bayar" id="status_bayar" value="Sudah Bayar">
                </div>
                <div class="text-right tombol-kanan">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-danger btn-sm" id="btn_reset"><i class="fas fa-redo"></i> Reset</button>
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-save"></i> Simpan</button>
                    </div>                                          
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function sum() {
        var txtFirstNumberValue = document.getElementById('total_penjualan').value;
        var txtSecondNumberValue = document.getElementById('administrasi').value;
        var txtThreeNumberValue = document.getElementById('jml_uang').value;
        var txtFourthNumberValue = document.getElementById('diskon').value;
        var tambah= parseInt(txtFirstNumberValue)+parseInt(txtSecondNumberValue)-parseInt(txtFourthNumberValue);
        var result =  parseInt(txtThreeNumberValue)-tambah;

         document.getElementById('total_bayar').value = tambah;
      if (!isNaN(result)) {
         document.getElementById('jml_kembali').value = result;
      }
}

</script>

<script>
function reset_form() {
    $("#administrasi").val("");
    $("#total_bayar").val("");
    $("#jml_uang").val("");
    $("#jml_kembali").val("");
    $("#diskon").val("0");
  }
  $("#btn_reset").click(function() {
    reset_form();
    document.getElementById("administrasi").focus();
  });

  $("#simpan_transaksi").on("submit", function(event){
    event.preventDefault();
    var no_daftar = $("#no_daftar").val();
    var kode = $("#no_transaksi").val();
    var total_penjualan = $("#total_bayar").val();
    var jml_uang = $("#jml_uang").val();    
    var jml_kembali = $("#jml_kembali").val();
    var administrasi = $("#administrasi").val();
    var diskon = $("#diskon").val();
    var tgl_transaksi = $("#tgl_transaksi").val();
    var status_bayar = $("#status_bayar").val();

    // alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

    if(kode=="") {
      document.getElementById("no_transaksi").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'Maaf, tolong lengkapi data transaksi',
        'warning'
      )
    } else if (administrasi=="") {
      document.getElementById("administrasi").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'Maaf, tolong isi administrasi',
        'warning'
      )
    } else if (total_penjualan=="") {
      document.getElementById("total_bayar").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'Maaf, tolong lengkapi data transaksi',
        'warning'
      )
    } else if (jml_uang=="") {
      document.getElementById("jml_uang").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'Maaf, tolong lengkapi jumlah uang pembayaran',
        'warning'
      )
    
    } else {
      $.ajax({
        type: "POST",
        url: "ajax/simpan_transaksi.php",
        data: "total_penjualan="+total_penjualan+"&kode="+kode+"&no_daftar="+no_daftar+"&jml_uang="+jml_uang+"&jml_kembali="+jml_kembali+"&diskon="+diskon+"&administrasi="+administrasi+"&status_bayar="+status_bayar+"&tgl_transaksi="+tgl_transaksi,
        success: function(hasil) {
            Swal.fire({
                  title: 'Berhasil',
                  text: 'Data Berhasil Disimpan',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    window.location='?page=kasir' ;
                  }
                })     
        }
      });
    }
  });
</script>