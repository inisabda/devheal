<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datatindakan"><i class="fas fa-briefcase-medical"></i> Data Tindakan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Tindakan</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Tindakan</h4></div>
		<div class="col-6 text-right">
			<a href="?page=data_tindakan">
				<button class="btn btn-sm btn-info">Daftar Data Tindakan</button>
			</a>
		</div>
	</div>
        <?php
        	$carikode = mysqli_query($conn, "SELECT MAX(kd_tindakan) as kodeTerbesar FROM data_tindakan ") ;
          $datakode = mysqli_fetch_array($carikode);
          $kd_tindakan = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_tindakan, 3, 3);
          $urutan =$urutan+1;
          $huruf = "TDK";
					$kd_tindakan = $huruf . sprintf("%03s", $urutan);


                 ?>

	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data Tindakan baru</h6>
				<form action="javascrip:void(0);"  autocomplete="off">

				  <div class="form-group row pt-3">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Kode </label>
				    <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  name="kd_tindakan" id="kd_tindakan" value="<?php echo $kd_tindakan; ?>" placeholder="masukkan kode tindakan" autofocus="">
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Nama Tindakan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_tindakan" placeholder="masukkan nama tindakan" autofocus="">
				    </div>
				  </div>
				  				  	  <div class="form-group row pt-3">
				    <label for="harga_tindakan" class="col-sm-3 col-form-label">Harga Tindakan</label>
				    <div class="col-sm-9">

				      <input type="number" class="form-control form-control-sm" id="harga_tindakan" value="" placeholder="masukkan Harga"  autofocus="">

<!--                             <input name="tgl_input" id="tgl_input" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"> -->

				    </div>
				  </div>


				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
				      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>





<script>
	function reset_form() {
		$("#nama_tindakan").val("");
		$("#harga_tindakan").val("");
	}

  


	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_tindakan").focus();
	});

	$("#btn_simpan").click(function() {
		var kode = $("#kd_tindakan").val();
		var nama_tindakan = $("#nama_tindakan").val();

		var harga_tindakan = $("#harga_tindakan").val();

		if(nama_tindakan=="") {
			document.getElementById("nama_tindakan").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama tindakan',
			  'warning'
			)
		} else if (harga_tindakan=="") {
			document.getElementById("harga_tindakan").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga',
			  'warning'
			)


		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_mastertindakan.php",
				data: "kode="+kode+"&nama_tindakan="+nama_tindakan+"&harga_tindakan="+harga_tindakan,
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
				            window.location='?page=data_tindakan' ;
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