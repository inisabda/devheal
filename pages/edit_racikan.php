<?php 
    $kd_racik = @$_GET['id'];
 ?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Edit obat Racik</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Edit Obat Racik</h4></div>
        <div class="col-6 text-right">
            <a href="?page=tabelracikan">
                <button class="btn btn-sm btn-info">Data Obat Racikan</button>
            </a>
        </div>
    </div>

<div class="form-container">
    <form method="post" id="form_racikan" autocomplete="off">
        <div class="row" style="padding: 0 20px;">
            <div class="col-md-12 vertical-form">
                <div style="text-align: right;">
                    No Racik : <b><?php echo $kd_racik; ?></b>                     
                    Tanggal : <b><?php echo date('Y-m-d'); ?></b>
                </div>
                
                <div class="row data-racikan">
                    <?php 
                        $query_tampil = "SELECT * FROM tbl_nama_racikan  WHERE kd_racik='$kd_racik'";
                        $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                        $data = mysqli_fetch_array($sql_tampil)
                    ?>
                    <div class="position-relative form-group col-md-4">
                        <label for="kd_racik" class="">Kode Racikan</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="kd_racik" name="kd_racik" placeholder="" autofocus="" value="<?php echo $data['kd_racik']; ?>" >
                        </div>
                    </div>
                    
                    <div class="position-relative form-group col-md-4">
                        <label for="nama_racikan" class="">Nama Racikan</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="nama_racikan" name="nama_racikan" placeholder="Masukkan nama obat racikan" autofocus="" value="<?php echo $data['nama_racikan']; ?>" >
                        </div>
                    </div>
                    <div class="position-relative form-group col-md-4">
                        <label for="nama_racikan" class="">Stok</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm" id="stk_obat" name="stk_obat" placeholder="Masukkan stok racikan" autofocus="" value="<?php echo $data['stk_obat']; ?>" >
                        </div>
                    </div>
                    

                    <div class="input-group">
                        <input type="hidden" class="form-control form-control-sm" id="status" name="status" placeholder="masukkan stok racikan" autofocus="" value="aktif" >
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                    <div class="col-sm-4">
                        <input name="tanggal_racik" id="tanggal_racik" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                    <!-- <h6><i class="fas fa-list-alt"></i> Masukkan daftar obat terjual</h6> -->
                    <div class="row kotak-form-tabel-racikan">
                        <div class="col-md-3 kotak-form-obat-terjual" style="display: ;">
                            <!-- <div class="judul-form">Form data obat terjual</div> -->
                            <!-- <form action="javascript:void(0);">  -->
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
                                        <span class="input-group-text" id="span_satuan">satuan</span>
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
                            <div class="position-relative form-group">
                                <label for="total_racik" class="">Total Racikan Awal</label>
                                <input name="total_racik" id="total_racik" placeholder="" type="number" class="form-control form-control-sm" value="<?php echo $data['total_penjualan']; ?>">
                                
                            </div>
                            <div class="position-relative form-group text-right mt-2 mb-2">
                                <button type="button" class="btn btn-danger btn-sm" id="reset_obat">Reset</button>
                                <button type="button" class="btn btn-info btn-sm" id="tambah_obat">Tambah</button>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="col-md-3 kotak-form-pembayaran" style="display:none;">
                            <!-- <div class="judul-form">Form data obat terjual</div> -->
                            <!-- <form action="javascript:void(0);">  -->
                            <div class="position-relative form-group">
                                <label class="">Total</label>
                                <!-- <input type="number" class="form-control form-control-sm" id="kode_obat"> -->
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
                            <!-- </form> -->
                        </div>
                        <div class="col-md-9 kotak-tabel-obat-terjual vertical-form">
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
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <?php 
                                    $kd_racik = @$_GET['id'];
                                    $totalBayar = 0;
                                    $query_tampil = "SELECT tbl_nama_racikandetail.*, tbl_nama_racikandetail.kd_racik, tbl_dataobat.nm_obat, tbl_dataobat.exp_obat FROM tbl_nama_racikandetail
                                    LEFT JOIN tbl_dataobat ON tbl_nama_racikandetail.kd_obat=tbl_dataobat.kd_obat
                                    WHERE kd_racik = '$kd_racik'";
                                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                                ?>  
                                                                    
                                <tbody id="keranjang_obat">
                                    <?php 
                                        //$total_penjualan = 1;  
                                        while($data_tampil = mysqli_fetch_array($sql_tampil)) {
                                        $subtotal   = $data_tampil['subtotal'];
                                        $totalBayar = $totalBayar + $subtotal;
                                    ?>
                                    <tr>
                                        <td><?php echo $data_tampil['kd_obat']; ?></td>
                                        <td><?php echo $data_tampil['nm_obat']; ?></td>
                                        <td><?php echo $data_tampil['exp_obat']; ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($data_tampil['hrg_jual'],2,',','.'); ?></td>
                                        <td class="text-center"><?php echo $data_tampil['jumlah']; ?></td>
                                        <td class="text-center"><?php echo $data_tampil['sat_jual']; ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($data_tampil['subtotal']); ?>
                                        </td>
                                        <td class="td-opsi">
                                            <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus"
                                                    data-id="<?php echo $data_tampil['no']; ?>" 
                                                    data-nama="<?php echo $data_tampil['nm_obat']; ?>"
                                                    data-stok="<?php echo $data_tampil['jumlah']; ?>"
                                                    data-subtot="<?php echo $data_tampil['subtotal']; ?>"
                                                    data-exp_obat="<?php echo $data_tampil['exp_obat']; ?>"
                                                    >Hapus</button>
                                        </td>                                                
                                    </tr>                                    
                                    <?php } ?>
                                    <tr>
                                        <?php 
                                            $query_tampil = "SELECT * FROM tbl_nama_racikan  WHERE kd_racik='$kd_racik'";
                                            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                                            $data = mysqli_fetch_array($sql_tampil)
                                        ?>
                                        <td colspan="6" align="right" bgcolor="#F5F5F5">Total Obat Racik :</td>
                                        <td align="right" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="baris_kosong">
                                        <td colspan="7" class="text-center">Belum ada data tambahan/edit racikan</td>
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

                        </div>
                    </div>
                    <div class="text-right tombol-kanan">
                        <input type="submit" name="simpan_obatracik" id="simpan_obatracik" class="btn btn-info" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 vertical-form">
    <h5 align="center"> Data Racikan Obat</h5>
    <table id="" class="table table-striped display tabel-data">
        <thead>
            <tr>
                <th class="text-left">Kode</th>
                <th class="text-left">Nama</th>
                <th class="text-left">Expired</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Satuan</th>                                      
                <th class="text-center">Total</th>
                <th class="text-center"></th>
            </tr>
        </thead>
            <?php 
                $kd_racik = @$_GET['id'];
                $totalBayar = 0;
                $query_tampil = "SELECT tbl_nama_racikandetail.*, tbl_nama_racikandetail.kd_racik, tbl_dataobat.nm_obat, tbl_dataobat.exp_obat FROM tbl_nama_racikandetail
                LEFT JOIN tbl_dataobat ON tbl_nama_racikandetail.kd_obat=tbl_dataobat.kd_obat

                WHERE kd_racik = '$kd_racik'";
                $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            ?>                                    
        <tbody>
            <?php  
                while($data_tampil = mysqli_fetch_array($sql_tampil)) {
                    $subtotal   = $data_tampil['subtotal'];
                    $totalBayar = $totalBayar + $subtotal;
            ?>
            <tr>
                <td><?php echo $data_tampil['kd_obat']; ?></td>
                <td><?php echo $data_tampil['nm_obat']; ?></td>
                <td><?php echo $data_tampil['exp_obat']; ?></td>
                <td class="text-right">Rp. <?php echo number_format($data_tampil['hrg_jual'],2,',','.'); ?></td>
                <td class="text-center"><?php echo $data_tampil['jumlah']; ?></td>
                <td class="text-center"><?php echo $data_tampil['sat_jual']; ?></td>
                <td class="text-right">Rp. <?php echo number_format($data_tampil['subtotal']); ?>
                </td>
                <td class="td-opsi">
                    <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus"
                            data-id="<?php echo $data_tampil['no']; ?>" 
                            data-nama="<?php echo $data_tampil['nm_obat']; ?>"
                            data-stok="<?php echo $data_tampil['jumlah']; ?>"
                            data-subtot="<?php echo $data_tampil['subtotal']; ?>"
                            data-exp_obat="<?php echo $data_tampil['exp_obat']; ?>"
                            >Hapus</button>
                </td>
                        
            </tr>
            <?php } ?>
            <tr>
                <td colspan="6" align="right" bgcolor="#F5F5F5">Total Obat Racik :</td>
                <td align="right" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
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

    </div>
 

<script>
    $("button[name='tombol_hapus']").click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var exp = $(this).data('exp');
        var stok = $(this).data('stok');
        var subtot = $(this).data('subtotal');

        total_penjualan = total_penjualan-subtot;
        $("#total_penjualan").text(total_penjualan);
        $("#hidden_totalpenjualan").val(total_penjualan);
        $("#total_pembayaran").text(total_penjualan);
        $("#row_"+id).remove();
        if(total_penjualan==0)
        {
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_obat_lagi").click();
        }
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
                  url: "ajax/hapus.php?page=editracikan",
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
        $("#span_satuan").text("satuan");
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

    // $("#kode_obat").click(functon() {
    //     $("#lihat_data_obat").click();
    // });

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
        //var akai = $("#akai").val();
        var harga = $("#hrg_obat").val();
        var jumlah = Number($("#jml_obat").val());
        var satuan = $("#span_satuan").text();
        var subtotal = Number($("#toth_obat").val());
        var total_racik = Number($("#total_racik").val());

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
              'Stok tidak cukup',
              'maaf, jumlah '+jumlah+' stok tidak mencukupi. stok yang tersedia sebanyak '+stok+' '+satuan,
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
            /*output += '<td class="text-center">'+akai+' <input type="hidden" name="hidden_akai[]" id="td_akai'+count+'" class="td_akai" value="'+akai+'"></td>';*/
            output += '<td class="text-right">Rp. '+subtotal+' <input type="hidden" name="hidden_subtotal[]" id="td_subtotal'+count+'" class="td_subtotal" value="'+subtotal+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_obat btn-transition btn btn-outline-danger btn-sm" name="hapus_obat" id="'+count+'" title="hapus obat ini">Hapus</button></td>';
            output += '</tr>';
            $("#keranjang_obat").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal+total_racik;
            $("#total_racik").text(total_penjualan);
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
          text: 'apakah anda yakin menghapus semua daftar obat racikan ini?',
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

    $("#form_racikan").on("submit", function(event){
        event.preventDefault();
        var kd_racik = $("#kd_racik").val();
        var tanggal_racik = $("#tanggal_racik").val();
        var nama_racikan = $("#nama_racikan").val();
        var stk_obat = $("#stk_obat").val();
        var akai = $("#akai").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nama_pasien = $("#nama_pasien").val();
        var status = $("#status").val();
        var total_penjualan = $("total_penjualan").val();

        if(kd_racik=="") {
            document.getElementById("kd_racik").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_racik==""){
            document.getElementById("tanggal_racik").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
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
              title: 'Simpan ?',
              text: 'apakah anda telah mengisi data obat racikan dengan benar ',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((simpan) => {
              if (simpan.value) {
                var count_data = 0;
                $(".td_kd_obat").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/edit_racikan.php",
                        method: "POST",
                        data: form_data,
                        success:function(data) {
                            Swal.fire({
                              title: 'Berhasil',
                              text: 'Data Obat Racikan Berhasil Disimpan',
                              type: 'success',
                              confirmButtonColor: '#3085d6',
                              confirmButtonText: 'OK'
                            }).then((ok) => {
                              if (ok.value) {
                                // window.location='?page=entry_datapenjualan';
                                //window.location='?page=tabelracikan';
                                window.location.reload(true);
                                
                              }
                            })
                        }
                    })
                } else {
                    alert();
                }
              }
            })
        }
    });
});
</script>

