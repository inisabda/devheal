<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datadokter"><i class="fas fa-briefcase-medical"></i> Data dokter</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data dokter</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data dokter</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datadokter">
				<button class="btn btn-sm btn-info">Daftar Data dokter</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data dokter baru</h6>
				<form method="POST" id="simpan_dokter" autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_dokter" class="col-sm-3 col-form-label">Kode dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_dokter" placeholder="masukkan kode dokter" readonly="" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  id="nm_dokter" placeholder="masukkan nama dokter">
				    </div>
				  </div>
  				  <div class="form-group row pt-3">
				    <label for="jk_dok" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_dok" id="jk_dok1" type="radio" class="form-check-input" value="Laki-laki" checked=""> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_dok" id="jk_dok2" type="radio" class="form-check-input" value="Perempuan">
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>


				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP Dokter</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm"  id="no_hp" placeholder="Masukkan nomor hp dokter">
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" >
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="tlahir_dokter" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm"  id="tlahir_dokter" placeholder="Masukkan tanggal lahir dokter">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="alamat" class="col-sm-3 col-form-label">Alamat dokter</label>
				    <div class="col-sm-9">
				      <textarea id="alamat" rows="2" class="form-control" placeholder="Masukkan alamat dokter" style="font-size: 14px;" ></textarea>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="spesialisasi" class="col-sm-3 col-form-label">Spesialis</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="spesialisasi"  placeholder="Masukkan spesialisasi">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="sip" class="col-sm-3 col-form-label">SIP / NIP</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="sip"  placeholder="Masukkan SIP / NIP">
				    </div>
				  </div>

				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button type="button" class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
				      <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
		</div>
				</div>
						</div>

<script>
	function reset_form() {
		$("#nm_dokter").val("");
		$("#tempat_lahir").val("");
		$("#tlahir_dokter").val("");
		$("#no_hp").val("");
		$("#alamat").val("");
		$("#sip").val("");
		$("#spesialisasi").val("");
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nm_dokter").focus();
	});

	$("#simpan_dokter").on("submit", function(event){  
  	event.preventDefault();
		var kode = $("#kd_dokter").val();
		var nm_dokter = $("#nm_dokter").val();
		var no_hp = $("#no_hp").val();
		var alamat = $("#alamat").val();
		var spesialisasi = $("#spesialisasi").val();
		var tempat_lahir = $("#tempat_lahir").val();
		var tgl_lahir = $("#tlahir_dokter").val();
		var sip = $("#sip").val();
		var jk = document.querySelector('input[name="jk_dok"]:checked').value;


		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);
		if(kode=="") {
			document.getElementById("kd_dokter").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi kode obat',
			  'warning'
			)

		}else if(nm_dokter=="") {
			document.getElementById("nm_dokter").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama dokter',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp dokter',
			  'warning'
			)
		} else if (spesialisasi=="") {
			document.getElementById("spesialisasi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi Spesialis',
			  'warning'
			)


		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_dokter.php",
				data: "nm_dokter="+nm_dokter+"&kode="+kode+"&jk="+jk+"&sip="+sip+"&tempat_lahir="+tempat_lahir+"&tgl_lahir="+tgl_lahir+"&alamat="+alamat+"&no_hp="+no_hp+"&spesialisasi="+spesialisasi,
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
				           window.location='?page=datadokter' ;
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
	});
</script>