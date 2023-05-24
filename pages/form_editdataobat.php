<?php 
	$kd_obat = @$_GET['kode'];
?>
<style>
	.intro {
    height: 100%;
    }
    .gradient-custom {
    /* fallback for old browsers */
    background: #fa709a;
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to bottom right, rgba(250, 112, 154, 1), rgba(254, 225, 64, 1));
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to bottom right, rgba(250, 112, 154, 1), rgba(254, 225, 64, 1))
    }
    /* Change dissabled Button color  */
    #submit:disabled{
       background-color: red;
      opacity:1.0;   
	}    
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=dataobat"><i class="fas fa-capsules"></i> Data Obat</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Obat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=dataobat">
				<button class="btn btn-sm btn-info">Daftar Data Obat</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data obat baru</h6>
				<?php 
				  	$query_tampil = "SELECT * FROM tbl_dataobat WHERE kd_obat='$kd_obat'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				?>
				<form method="post" autocomplete="off" id="form_editobat">
				  <div class="form-group row pt-3">
				    <label for="ip_kdobat" class="col-sm-3 col-form-label">Kode Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="ip_kdobat" name="ip_kdobat" value="<?php echo $kd_obat;?>"
				      onInput="checkKode()"/>
				      <span id="check-kode"></span>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_nmobat" class="col-sm-3 col-form-label">Nama Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" name="ip_nmobat" id="ip_nmobat" autofocus="" value="<?php echo $data['nm_obat']; ?>" style="text-transform: uppercase;">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="no_batch" class="col-sm-3 col-form-label">No. Batch</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_batch" name="no_batch" value="<?php echo $data['no_batch']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_ktgobat" class="col-sm-3 col-form-label">Kategori Obat</label>
				    <div class="col-sm-9">
				      <select name="ip_ktgobat" id="ip_ktgobat" class="form-control form-control-sm">
				      	<option value="0">Pilih kategori obat</option>
				      	<option value="GENERIK" <?php if($data['ktg_obat']=="GENERIK") {echo "selected";} ?>>Obat Generik</option>
				      	<option value="PATEN" <?php if($data['ktg_obat']=="PATEN") {echo "selected";} ?>>Obat Merk Paten</option>
				      	<option value="OBAT BEBAS" <?php if($data['ktg_obat']=="OBAT BEBAS") {echo "selected";} ?>>Obat Bebas</option>
				      	<option value="OBAT BEBAS TERBATAS" <?php if($data['ktg_obat']=="OBAT BEBAS TERBATAS") {echo "selected";} ?>>Obat Bebas Terbatas</option>
				      	<option value="OBAT KERAS" <?php if($data['ktg_obat']=="OBAT KERAS") {echo "selected";} ?>>Obat Keras</option>
				      	<option value="OBAT NARKOTIKA" <?php if($data['ktg_obat']=="OBAT NARKOTIKA") {echo "selected";} ?>>Obat Gol NARKOTIKA</option>
				      	<option value="OBAT FITOFARMAKA" <?php if($data['ktg_obat']=="OBAT FITOFARMAKA") {echo "selected";} ?>>Obat Fitofarmaka</option>
				      	<option value="OBAT HERBAL" <?php if($data['ktg_obat']=="OBAT HERBAL") {echo "selected";} ?>>Obat Herbal</option>
				      	<option value="OBAT HERBAL TERSTANDART" <?php if($data['ktg_obat']=="OBAT HERBAL TERSTANDART") {echo "selected";} ?>>Obat Herbal Terstandart (OHT)</option>
				      	<option value="OBAT HERBAL JAMU" <?php if($data['ktg_obat']=="OBAT HERBAL JAMU") {echo "selected";} ?>>Obat Herbal Jamu</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_bntobat" class="col-sm-3 col-form-label">Bentuk Obat</label>
				    <div class="col-sm-9">
				      <select name="ip_bntobat" id="ip_bntobat" class="form-control form-control-sm">
				      	<option value="0">Pilih bentuk obat</option>
				      	<option value="TABLET" <?php if($data['bnt_obat']=="TABLET") {echo "selected";} ?> >Tablet</option>
				      	<option value="KAPLET" <?php if($data['bnt_obat']=="KAPLET") {echo "selected";} ?>>Kaplet</option>
				      	<option value="KAPSUL" <?php if($data['bnt_obat']=="KAPSUL") {echo "selected";} ?>>Kapsul</option>
				      	<option value="SIRUP" <?php if($data['bnt_obat']=="SIRUP") {echo "selected";} ?>>Sirup</option>
				      	<option value="CAIR" <?php if($data['bnt_obat']=="CAIR") {echo "selected";} ?>>Cair</option>
				      	<option value="CAIRAN INFUS" <?php if($data['bnt_obat']=="CAIRAN INFUS") {echo "selected";} ?>>Cairan Infus</option>
				      	<option value="SALEP" <?php if($data['bnt_obat']=="SALEP") {echo "selected";} ?>>Salep</option>
				      	<option value="GEL" <?php if($data['bnt_obat']=="GEL") {echo "selected";} ?>>Gel</option>
				      	<option value="INHALER" <?php if($data['bnt_obat']=="INHALER") {echo "selected";} ?>>Inhaler</option>
				      	<option value="BATANG" <?php if($data['bnt_obat']=="BATANG") {echo "selected";} ?>>Batang</option>
				      	<option value="ALKES" <?php if($data['bnt_obat']=="ALKES") {echo "selected";} ?>>Alkes</option>
				      	<option value="SALEP" <?php if($data['bnt_obat']=="SALEP") {echo "selected";} ?>>Salep</option>
				      	<option value="TETES" <?php if($data['bnt_obat']=="TETES") {echo "selected";} ?>>Tetes</option>
				      	<option value="AMPUL" <?php if($data['bnt_obat']=="AMPUL") {echo "selected";} ?>>Ampul</option>
				      	<option value="SUPOS" <?php if($data['bnt_obat']=="SUPOS") {echo "selected";} ?>>Supositoria</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_stobat" class="col-sm-3 col-form-label">Satuan</label>
				    <div class="col-sm-9">
				      <select name="ip_stobat" id="ip_stobat" class="form-control form-control-sm">
				      	<option value="0">pilih satuan penjualan obat</option>
				      	<option value="TABLET" <?php if($data['sat_obat']=="TABLET") {echo "selected";} ?> >Tablet</option>
				      	<option value="STRIP" <?php if($data['sat_obat']=="STRIP") {echo "selected";} ?> >Strip</option>
				      	<option value="SACHET" <?php if($data['sat_obat']=="SACHET") {echo "selected";} ?> >Sachet</option>
				      	<option value="PCS" <?php if($data['sat_obat']=="PCS") {echo "selected";} ?> >Pcs</option>
				      	<option value="PAK" <?php if($data['sat_obat']=="PAK") {echo "selected";} ?> >Pak</option>
				      	<option value="TUBE" <?php if($data['sat_obat']=="TUBE") {echo "selected";} ?> >Tube</option>
				      	<option value="BOTOL" <?php if($data['sat_obat']=="BOTOL") {echo "selected";} ?> >Botol</option>
				      	<option value="BATANG" <?php if($data['sat_obat']=="BATANG") {echo "selected";} ?> >Batang</option>
				      	<option value="ALKES" <?php if($data['sat_obat']=="ALKES") {echo "selected";} ?> >Alkes</option>
				      	<option value="SALEP" <?php if($data['sat_obat']=="SALEP") {echo "selected";} ?> >Salep</option>
				      	<option value="TETES" <?php if($data['sat_obat']=="TETES") {echo "selected";} ?> >Tetes</option>
				      	<option value="AMPUL" <?php if($data['sat_obat']=="AMPUL") {echo "selected";} ?> >Ampul</option>
				      	<option value="SUPOS" <?php if($data['sat_obat']=="SUPOS") {echo "selected";} ?> >Supositoria</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_hrgobat" class="col-sm-3 col-form-label">Harga per <span id="u_satuan"><?php echo $data['sat_obat']; ?></span></label>
				    <div class="col-sm-9">
				      <div class="input-group input-group-sm">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
							  </div>
							  <input type="number" class="form-control" id="ip_hrgobat" name="ip_hrgobat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $data['hrgbeli_obat']; ?>">
					  	</div>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_minstok" class="col-sm-3 col-form-label">Stok Minimal</label>
				    <div class="col-sm-9">
				    	<div class="input-group input-group-sm">
						    <input type="number" class="form-control form-control-sm" id="ip_minstok" name="ip_minstok" value="<?php echo $data['minstk_obat']; ?>">
						    <div class="input-group-append">
								    <span id="u_satuan" class="input-group-text u_satuan"><?php echo $data['sat_obat']; ?></span>
								</div>
							</div>
						</div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
				    <div class="col-sm-9">
					    <div class="input-group">
	                <input type="text" class="form-control form-control-sm" id="nm_supplier" name="nm_supplier" value="<?php echo $data['supplier']; ?>">
	                <input type="hidden" class="form-control form-control-sm" id="no_supplier" name="no_supplier">
	                <div class="input-group-append">
	                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datasupplier" id="lihat_data_supplier"><i class="fas fa-search"></i></button>
	                </div>
	            </div>
	          </div>
				  </div>
				  
				  <?php 
				  	$query_stok = "SELECT * FROM tbl_dataobat WHERE kd_obat = '$kd_obat'";
				  	$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
				  	$no=1;
				  	while($data_stok = mysqli_fetch_array($sql_stok)) {
				   ?>
				  <div class="form-group row pt-1">
				    <label for="ip_kadaluarsa<?php echo $no; ?>" class="col-sm-3 col-form-label">Kadaluarsa</label>
				    <div class="col-sm-4">
					    <input type="date" class="form-control form-control-sm" id="ip_kadaluarsa<?php echo $no; ?>" name="ip_kadaluarsa[]" value="<?php echo $data_stok['exp_obat'] ?>">
					    
						</div>
						<label for="ip_stok<?php echo $no; ?>" class="col-sm-1 col-form-label" style="text-align: right;">Stok</label>
				    <div class="col-sm-4">
					    <input type="number" class="form-control form-control-sm" id="ip_stok<?php echo $no; ?>" name="ip_stok[]" value="<?php echo $data_stok['stk_obat'] ?>">
						</div>
				  </div>
				  <?php $no++; } ?>
				  <?php 
				  	$query_stok = "SELECT * FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat'";
				  	$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
				  	$no=1;
				  	while($data_stok = mysqli_fetch_array($sql_stok)) {
				   ?>
				   <div class="form-group row">
				    <div class="col-sm-4">
					    <input type="hidden" id="ip_nmrstok<?php echo $no; ?>" name="ip_nmrstok[]" value="<?php echo $data_stok['no_stok'] ?>">
						</div>
					</div>
					<?php $no++; } ?>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button type="submit" class="btn btn-info btn-sm" id="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Supplier -->
<div class="modal fade" id="modal_datasupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped display">
          <thead>
            <tr>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $query_tampil_supp = "SELECT * FROM tbl_supplier ORDER BY nama_supp ASC";
                $sql_tampil_supp = mysqli_query($conn, $query_tampil_supp) or die ($conn->error);
                while($data_supp = mysqli_fetch_array($sql_tampil_supp)) {
             ?>
            <tr>
                <td><?php echo $data_supp['nama_supp']; ?></td>
                <td><?php echo $data_supp['alm_supp']; ?></td>
                <td class="td-opsi">
                    <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihsupp" name="tombol_pilihsupp" data-dismiss="modal"
                        data-no_supp="<?php echo $data_supp['no_supp']; ?>"
                        data-nama_supp="<?php echo $data_supp['nama_supp']; ?>"
                    >Pilih</button>
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

<script>
	$(document).ready(function() {
		$("#nm_supplier").click(function() {
        $("#lihat_data_supplier").click();
    });

    $("button[name='tombol_pilihsupp']").click(function() {
        var no_supp = $(this).data("no_supp");
        var nama_supp = $(this).data("nama_supp");
        $("#nm_supplier").val(nama_supp);
        $("#no_supplier").val(no_supp);
    });
	});
</script>

<script>
	function checkKode() {	    
	    jQuery.ajax({
	    url: "ajax/cek_kodeobat.php",
	    data:'ip_kdobat='+$("#ip_kdobat").val(),
	    type: "POST",
	    success:function(data){
	        $("#check-kode").html(data);
	    },
	    error:function (){}
	    });
	}
	$("#ip_stobat").change(function() {
		var satuan = $("#ip_stobat").val();
		if(satuan=="0")
		{
			satuan = "Satuan";
		}
		$("#u_satuan").text(satuan);
	});

	$("#form_editobat").on("submit", function(event){
    event.preventDefault();
		var kode = $("#ip_kdobat").val();
		var nmr_stok = $("#ip_nmrstok").val();
		var nama = $("#ip_nmobat").val();
		var exp = $("#ip_kadaluarsa").val();
		var ktg = $("#ip_ktgobat").val(); //document.querySelector('input[name="ip_ktgobat"]:checked').value;
		var bentuk = $("#ip_bntobat").val();
		var satuan = $("#ip_stobat").val();
		var harga = $("#ip_hrgobat").val();
		var stok = $("#ip_stokobat").val();
		var min_stok = $("#ip_minstok").val();
		var no_batch = $("#no_batch").val();
		var nm_supplier = $("#nm_supplier").val();

		if (nama=="") {
			document.getElementById("ip_nmobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama obat',
			  'warning'
			)
		} else if (exp=="") {
			document.getElementById("ip_kadaluarsa").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi tanggal kadaluarsa obat',
			  'warning'
			)
		} else if (ktg=="") {
			document.getElementById("ip_ktgobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih kategori obat',
			  'warning'
			)
		} else if (bentuk=="0") {
			document.getElementById("ip_bntobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih bentuk obat',
			  'warning'
			)
		} else if (satuan=="0") {
			document.getElementById("ip_stobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih satuan penjualan obat',
			  'warning'
			)
		} else if (harga=="" || harga<=0) {
			document.getElementById("ip_hrgobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga obat',
			  'warning'
			)
		} else if (stok=="" || stok<=0) {
			document.getElementById("ip_stokobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi jumlah stok obat',
			  'warning'
			)
		} else if (min_stok=="" || min_stok<=0) {
			document.getElementById("ip_minstok").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi jumlah minimal stok obat',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'akan merubah data obat',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	          	var data_form = $("#form_editobat").serialize();
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_dataobat.php",
	              data: data_form,
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
				            window.location='?page=dataobat' ;
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
	    		// console.log(data_form);
	          }
	        })
		}
	})
</script>