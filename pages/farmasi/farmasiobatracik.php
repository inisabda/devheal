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
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Order Obat Racikan Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-pills"></i> Order Obat Racikan</h4></div>
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
		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
                <?php                
                require_once "koneksi.php";
                $no_daftar = @$_GET['id'];
                $query_tampil = "SELECT * FROM tbl_racikan WHERE no_daftar='$no_daftar'";
                $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                $data = mysqli_fetch_array($sql_tampil); 
                if (isset($data['no_pengobatan']) AND ($tgl_berobat = date("d-M-Y", strtotime($data['tgl_pengobatan']))))
                    {
                       echo "
                       <div style='text-align: right;'>
                            No Pengobatan : <b>$data[no_pengobatan]</b>  Tanggal : <b>$tgl_berobat</b>
                        </div>";
                    }
                    else
                    {
                       echo "
                       <div id='blink' style='text-align: center;'>
                            <b><font color='#d33'>Pemberitahuan : Resep Obat Belum Diinput oleh Dokter</font></b>
                        </div>";
                    }
                ?>
                <h5 align="center"> Data Pemberian Obat Racikan </h5>
                <table id="" class="table table-hover display tabel-data">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Racikan</th>
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
                            $totalBayar = $totalBayar + $subtotal;
                             $total_racik = $data_pjlobat['total_penjualan'];
                             $nama_racikan = $data_pjlobat['nama_racikan'];
                             $keterangan = $data_pjlobat['keterangan'];
                             $jumlah_puyer = $data_pjlobat['jml_puyer'];
                             $pakai = $data_pjlobat['akai'];
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
                            <td colspan="4" align="right" bgcolor="#F5F5F5">Total Obat Racik:</td>
                            <td colspan="2" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td width="130"><b>Nama Racikan</b></td>
                        <td width="10"><b> :</b></td>
                        <td> <?php echo $nama_racikan; ?></td>
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
             <a href="pages_cetak_surat/cetak_resepracikan.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="Cetak Resep Racikan" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i> Cetak Resep</button></a>
        </div>
    </div>
</div>
<div class="modal fade" id="detail_racikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Obat Racikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="tabel-profil">
                <tr>
                    <th>Kode Racik</th>
                    <td id="kd_racikdetail">PJL00001</td>
                    <th>Tanggal</th>
                    <td id="tgl_racikdetail">20/11/19</td>
                </tr>
                <tr>
                    <th>Nama Racikan</th>
                    <td id="nama_racikandetail">Nama Racikan</td>
                    <th>Stok</th>
                    <td id="stk_obatdetail">Stok</td>
                </tr>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="data_detailracikan">
                    <!-- diisi dengan ajax jquery -->
                </tbody>
                        <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total :</th>
                        <th class="text-right">
                            Rp. <span id="total_pembeliandetail"></span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script>
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
                        url: "ajax/simpan_racikan.php",
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
<script type="text/javascript">
    var blink = document.getElementById('blink');
    setInterval(function() {
        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 1000);
</script>


