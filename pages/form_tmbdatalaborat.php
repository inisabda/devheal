<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datalaborat"><i class="fas fa-briefcase-medical"></i> Data laborat</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Laborat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Laborat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datalaborat">
				<button class="btn btn-sm btn-info">Daftar Data Laborat</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data LABORAT baru</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="id_laborat" class="col-sm-3 col-form-label">Kode laborat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"   id="id_laborat" placeholder="Masukkan kode laborat" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nama_laborat" class="col-sm-3 col-form-label">Nama Laborat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  id="nama_laborat" placeholder="Masukkan nama laborater"  autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="harga_laborat" class="col-sm-3 col-form-label">Biaya Laborat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  id="harga_laborat" placeholder="Masukkan harga Laborat" autofocus="">
				    </div>
				  </div>

				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
				      <button class="btn btn-primary btn-sm" id="btn_save">Simpan</button>
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
		$("#nama_laborat").val("");
		$("#harga_laborat").val("");
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_laborat").focus();
	});

	$("#btn_save").click(function() {
		var kode = $("#id_laborat").val();
		var nama_laborat = $("#nama_laborat").val();
		var harga_laborat = $("#harga_laborat").val();
		
		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);
		if(kode=="") {
			document.getElementById("id_laborat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isikan kode LABORAT',
			  'warning'
			)

		}else if(nama_laborat=="") {
			document.getElementById("nama_laborat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isikan nama LABORAT',
			  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_laborat.php",
				data: "nama_laborat="+nama_laborat+"&kode="+kode+"&harga_laborat="+harga_laborat,
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
				           window.location='?page=datalaborat' ;
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