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
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Obat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-pills"></i> Form Tambah Data Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=dataobat">
				<button class="btn btn-sm btn-warning"><i class="fas fa-list"></i> List Data Obat</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data obat baru</h6>
				<form method="POST" id="simpan_obat" autocomplete="on">
				  <div class="form-group row pt-3">
				    <label for="ip_kdobat" class="col-sm-3 col-form-label">Kode Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="ip_kdobat" placeholder="Masukkan kode obat" autofocus onInput="checkKode()"/>
				      <span id="check-kode"></span>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_nmobat" class="col-sm-3 col-form-label">Nama Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="ip_nmobat" placeholder="Masukkan nama obat">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="no_batch" class="col-sm-3 col-form-label">No. Batch</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_batch" placeholder="Masukkan No Batch">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_ktgobat" class="col-sm-3 col-form-label">Kategori Obat</label>
				    <div class="col-sm-9">
				      <select name="ip_ktgobat" id="ip_ktgobat" class="form-control form-control-sm">
				      	<option value="0">Pilih kategori obat</option>
				      	<option value="GENERIK">Obat Generik</option>
				      	<option value="PATEN">Obat Merk Paten</option>
				      	<option value="OBAT BEBAS">Obat Bebas</option>
				      	<option value="OBAT BEBAS TERBATAS">Obat Bebas Terbatas</option>
				      	<option value="OBAT KERAS">Obat Keras</option>
				      	<option value="OBAT NARKOTIKA">Obat Gol NARKOTIKA</option>
				      	<option value="OBAT FITOFARMAKA">Obat Fitofarmaka</option>
				      	<option value="OBAT HERBAL">Obat Herbal</option>
				      	<option value="OBAT HERBAL TERSTANDART">Obat Herbal Terstandart (OHT)</option>
				      	<option value="OBAT HERBAL JAMU">Obat Herbal Jamu</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_bntobat" class="col-sm-3 col-form-label">Bentuk Obat</label>
				    <div class="col-sm-9">
				      <select name="ip_bntobat" id="ip_bntobat" class="form-control form-control-sm">
				      	<option value="0">Pilih bentuk obat</option>
				      	<option value="TABLET">Tablet</option>
				      	<option value="KAPLET">Kaplet</option>
				      	<option value="KAPSUL">Kapsul</option>
				      	<option value="SIRUP">Sirup</option>
				      	<option value="CAIR">Cair</option>
				      	<option value="CAIRAN INFUS">Cairan Infus</option>
				      	<option value="SALEP">Salep</option>
				      	<option value="GEL">Gel</option>
				      	<option value="INHALER">Inhaler</option>
				      	<option value="BATANG">Batang</option>
				      	<option value="ALKES">Alkes</option>
				      	<option value="SALEP">Salep</option>
				      	<option value="TETES">Tetes</option>
				      	<option value="AMPUL">Ampul</option>
				      	<option value="SUPOS">Supositoria</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_stobat" class="col-sm-3 col-form-label">Satuan Jual</label>
				    <div class="col-sm-9">
				      <select name="ip_stobat" id="ip_stobat" class="form-control form-control-sm">
				      	<option value="0">Pilih satuan penjualan obat</option>
				      	<option value="TABLET">Tablet</option>
				      	<option value="STRIP">Strip</option>
				      	<option value="SACHET">Sachet</option>
				      	<option value="PCS">Pcs</option>
				      	<option value="PAK">Pak</option>
				      	<option value="TUBE">Tube</option>
				      	<option value="BOTOL">Botol</option>
				      	<option value="BATANG">Batang</option>
				      	<option value="ALKES">Alkes</option>
				      	<option value="SALEP">Salep</option>
				      	<option value="TETES">Tetes</option>
				      	<option value="AMPUL">Ampul</option>
				      	<option value="SUPOS">Supositoria</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_hrgobat" class="col-sm-3 col-form-label">Harga per <span class="u_satuan" id="u_satuan">Satuan</span></label>
				    <div class="col-sm-9">
				      <div class="input-group input-group-sm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
						  </div>
						  <input type="number" class="form-control" id="ip_hrgobat" name="ip_hrgobat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan harga obat/alkes">
					  </div>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_minstok" class="col-sm-3 col-form-label">Stok Minimal</label>
				    <div class="col-sm-9">
				    	<div class="input-group input-group-sm">
						    <input type="number" class="form-control form-control-sm" id="ip_minstok" name="ip_minstok" placeholder="masukkan jumlah minimal stok obat">
						    <div class="input-group-append">
							    <span class="input-group-text u_satuan" id="inputGroup-sizing-sm">Satuan</span>
							</div>
						</div>
					</div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_expobat" class="col-sm-3 col-form-label">Kadaluarsa</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="ip_expobat" placeholder="Masukkan tanggal kadaluarsa">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
				    <div class="col-sm-9">
					    <div class="input-group">
	                <input type="text" class="form-control form-control-sm" id="nm_supplier" name="nm_supplier" placeholder="Masukkan nama supplier">
	                <input type="hidden" class="form-control form-control-sm" id="no_supplier" name="no_supplier">
	                <div class="input-group-append">
	                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datasupplier" id="lihat_data_supplier"><i class="fas fa-search"></i></button>
	                </div>
	            </div>
	          </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="ip_stokobat" class="col-sm-3 col-form-label">Stok</label>
				    <div class="col-sm-9">
				    	<div class="input-group input-group-sm">
						    <input type="number" class="form-control form-control-sm" id="ip_stokobat" name="ip_stokobat" placeholder="Masukkan jumlah stok obat">
						    <div class="input-group-append">
							    <span class="input-group-text u_satuan" id="inputGroup-sizing-sm">Satuan</span>
							</div>
						</div>
					</div>
				  </div>
				  <div class="form-group row pt-1">
				    <div class="col-sm-12 text-right">
				      <button type="submit" class="btn btn-info btn-sm" id="submit"><i class="fas fa-save"></i> Simpan</button>
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
</script>
<script>
	$("#ip_stobat").change(function() {
		var satuan = $("#ip_stobat").val();
		if(satuan=="0")
		{
			satuan = "Satuan";
		}
		$(".u_satuan").text(satuan);
	});

	$("#simpan_obat").on("submit", function(event){  
  	event.preventDefault();
		var kode = $("#ip_kdobat").val();
		var nama = $("#ip_nmobat").val();
		var exp = $("#ip_expobat").val();
		var ktg = $("#ip_ktgobat").val(); //document.querySelector('input[name="ip_ktgobat"]:checked').value;
		var bentuk = $("#ip_bntobat").val();
		var satuan = $("#ip_stobat").val();
		var harga = $("#ip_hrgobat").val();
		var stok = $("#ip_stokobat").val();
		var min_stok = $("#ip_minstok").val();
		var no_batch = $("#no_batch").val();
		var nm_supplier = $("#nm_supplier").val();

		if(kode=="") {
			document.getElementById("ip_kdobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi kode obat',
			  'warning'
			)
		} else if (nama=="") {
			document.getElementById("ip_nmobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama obat',
			  'warning'
			)
		} else if (exp=="") {
			document.getElementById("ip_expobat").focus();
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
			$.ajax({
				type: "POST",
				url: "ajax/simpan_obat.php",
				data: "nama="+nama+"&kode="+kode+"&exp="+exp+"&ktg="+ktg+"&bentuk="+bentuk+"&satuan="+satuan+"&harga="+harga+"&stok="+stok+"&min_stok="+min_stok+"&no_batch="+no_batch+"&nm_supplier="+nm_supplier,
				success: function(hasil) {
					if(hasil=="tersimpan") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Disimpan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=dataobat';
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
		}
	})
</script>