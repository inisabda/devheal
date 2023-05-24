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
        <div class="col-6"><h4>Form Pemberian Obat</h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>




<div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


  <form method="post" id="form_pengobatan" autocomplete="off">
                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-4">
                            <label for="no_daftar" class="">Nomor Registrasi <small>(nomor  pendaftaran)</small></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" >
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-file-signature"></i></span>
                                </div>
                            </div>
   
                        </div>

                  <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>


                        <div class="position-relative form-group col-md-4">
                            <label for="nama_pas" class="">Nama Pasien</label>
                            <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" >
                                </div>
                           
                        </div>
                        <div class="position-relative form-group col-md-4">
                            <label for="nomor_rm" class="">Nomor RM</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" >
                            </div>
                        </div>
                    </div>



        <div class="row" style="padding: 0 20px;">
            <div class="col-md-12 vertical-form">
                <?php 
                    $tgl_pengobatan = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_pengobatan, 8, 2);
                    $bulan = substr($tgl_pengobatan, 5, 2);
                    $tahun = substr($tgl_pengobatan, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_pengobatan) FROM tbl_pengobatan WHERE tgl_pengobatan = '$tgl_pengobatan'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_pengobatan = "OBT/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                    } else {
                        $no_pengobatan = "OBT/".$tgl."/001";
                    }
                 ?>

                <div style="text-align: right;">
                    No Pengobatan : <b><?php echo $no_pengobatan; ?></b>                     Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>
              
                    <div class="position-relative row form-group">
                        <!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="no_pengobatan" id="no_pengobatan" placeholder="nomor pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo $no_pengobatan; ?>">
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tanggal_pengobatan" id="tanggal_pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <!-- <h6><i class="fas fa-list-alt"></i> Masukkan daftar obat terjual</h6> -->
                    <div class="row kotak-form-tabel-pengobatan">
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
                                <div class="position-relative form-group ">
                                    <label for="nm_obat" class="">Nama Obat</label>
                                    <input name="nm_obat" id="nm_obat" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                                    <input type="hidden" id="stok_obat">
                                    <input type="hidden" id="exp_obat">
                                </div>
                                <div class="position-relative form-group ">
                                    <label for="akai" class="">Aturan Pakai</label>

                                    <div class="input-group ">
                                    <select name="akai" id="akai" placeholder="" type="text" class="theSelect" class="form-control form-control-sm" >
                         <option value=""></option>';
<?php

$query = $conn -> query ("SELECT * FROM tbl_akai");
while ($row = mysqli_fetch_array($query))
{
echo '<option value="'.$row['aturan_pakai'].'">'.$row['aturan_pakai'].'</option>';
}
?>
                                    </select>
                      </select>
                    </div>
                  </div>

<!--   <div class="input-group input-lg">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input type="hidden" value="" name="id_akai" id="id_akai_hidden" />
                        <input type="text" value="" name="search" class="search form-control input-lg" id="searchid" autocomplete="off" placeholder="Masukan ID / Nama Pasien" required autofocus /> 

                        <div id="result"></div>

                    </div> -->

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
                                <div class="position-relative form-group text-right mt-2 mb-2">
                                    <button type="button" class="btn btn-danger btn-sm" id="reset_obat">reset</button>
                                    <button type="button" class="btn btn-info btn-sm" id="tambah_obat">tambah</button>
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
                        <div class="col-md-9 kotak-tabel-obat-terjual">
                            <table class="table display tabel-data">
                                <thead>
                                    <tr>
                                        <th class="text-left">Kode</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Expired</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                            <th class="text-center">Aturan Pakai</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="keranjang_obat">
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="baris_kosong">
                                        <td colspan="8" class="text-center">Belum ada data</td>
                                    </tr>
                                    <tr class="baris_total" style="display: none;">
                                        <td colspan="8" class="text-right" style="font-weight: bold;">Total : <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                        <td class="td-opsi">
                                            <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua obat" id="hapus_semua_obat">hapus</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="baris_total text-right" style="display: none;">
                                <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">lanjut pembayaran</button>
                                <button type="button" name="lanjut_pembayaran" id="tambah_obat_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">tambah obat lagi</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-right tombol-kanan">
                        <input type="submit" name="simpan_pengobatan" id="simpan_pengobatan" class="btn btn-info" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    <th>Exp Date</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        require_once "koneksi.php";
            $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";
/*            $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/

            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['kd_obat']; ?></td>
                    <td><?php echo $data['nm_obat']; ?></td>
                    <td><?php echo $data['tgl_exp']; ?></td>
                    <td><?php echo $data['hrg_obat']; ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td><?php echo $data['sat_obat']; ?></td>
                    <td><?php echo $data['ktg_obat']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_obat']; ?>"
                            data-nama="<?php echo $data['nm_obat']; ?>"
                            data-harga="<?php echo $data['hrg_obat']; ?>"
                            data-satuan="<?php echo $data['sat_obat']; ?>"
                            data-stok="<?php echo $data['stok']; ?>"
                            data-exp="<?php echo $data['tgl_exp']; ?>"
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

    </div>
        <div class="row" style="padding: 0 16px;">
                <div class="col-md-12 vertical-form">

 <h5 align="center"> Riwayat Obat Pasien</h5>
        <table  class="table table-striped display tabel-data">
            <thead>
                <tr>
     <!--                <th>No</th> -->
                     <th>No Resep</th>
                    <th>Nama Obat</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
<!--                   <th>Harga</th> -->
                  <  th>Subtotal</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

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
            ?>
                <tr>
<!--                     <td><?php echo $nomor++; ?></td> -->
                     <td><?php echo $data_pjlobat['no_pengobatan']; ?></td> 
                    <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                    <td><?php echo $data_pjlobat['akai']; ?></td>
                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
<!--                     <td><?php echo $data_pjlobat['hrg_jual']; ?></td> -->
                    <td><?php echo $data_pjlobat['subtotal']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

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
            output += '<td class="text-right">'+harga+' <input type="hidden" name="hidden_hrgobat[]" id="td_hrgobat'+count+'" class="td_hrgobat" value="'+harga+'"></td>';
            output += '<td class="text-center">'+jumlah+' <input type="hidden" name="hidden_jmlobat[]" id="td_jmlobat'+count+'" class="td_jmlobat" value="'+jumlah+'"></td>';
            output += '<td class="text-center">'+satuan+' <input type="hidden" name="hidden_satobat[]" id="td_satobat'+count+'" class="td_satobat" value="'+satuan+'"></td>';
            output += '<td class="text-center">'+akai+' <input type="hidden" name="hidden_akai[]" id="td_akai'+count+'" class="td_akai" value="'+akai+'"></td>';
            output += '<td class="text-right">'+subtotal+' <input type="hidden" name="hidden_subtotal[]" id="td_subtotal'+count+'" class="td_subtotal" value="'+subtotal+'"></td>';
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

    $("#form_pengobatan").on("submit", function(event){
        event.preventDefault();
        var no_pengobatan = $("#no_pengobatan").val();
        var tanggal_pengobatan = $("#tanggal_pengobatan").val();
        var no_rawat = $("#no_rawat").val();
                var akai = $("#akai").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nama_pasien = $("#nama_pasien").val();
                var norem = $("#norem").val();

        if(no_pengobatan=="") {
            document.getElementById("no_pengobatan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_pengobatan==""){
            document.getElementById("tanggal_pengobatan").focus();
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
              text: 'apakah anda telah mengisi data penjualan dengan benar ',
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
                        url: "ajax/simpan_pengobatan.php",
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
                                window.location='?page=perawatan';
                                
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


<!------------------------- cari Aturan Pakai -------------------->


<script type="text/javascript">
    $(function () {
        $(".search").keyup(function ()
        {
            var searchid = $(this).val();
            var dataString = 'search=' + searchid;
            if (searchid != '')
            {
                $.ajax({
                    type: "POST",
                    url: "ajax/cari_akai.php",
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#result").html(html).show();
                    }
                });
            }
            return false;
        });

        jQuery("#result").live("click", function (e) {
            var $clicked = $(e.target);
            var $id = $clicked.find('.id').html();
            var $nama = $clicked.find('.nama').html();
            var dec_id = $("<div/>").html($id).text();
            var dec_nama = $("<div/>").html($nama).text();
            $('#id_akai_hidden').val(dec_id);
            $('#searchid').val(dec_nama);
        });
        jQuery(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search")) {
                jQuery("#result").fadeOut();
            }
        });
        $('#searchid').click(function () {
            jQuery("#result").fadeIn();
        });
    });
</script>

    <script>
        $(".theSelect").select2();
    </script>