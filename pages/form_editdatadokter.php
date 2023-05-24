<?php 
	$kd_dokter = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Dokter</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Dokter</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-user-edit"></i> Form Edit Data Dokter</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datadokter">
				<button class="btn btn-sm btn-warning"><i class="fas fa-list"></i> List Data Dokter</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data dokter</h6>
				<form method="POST" id="edit_dokter" autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_dokter" class="col-sm-3 col-form-label">Kode Dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_dokter" value="<?php echo $kd_dokter; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM dokter WHERE kd_dokter='$kd_dokter'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $data['nm_dokter']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Tanggal Lahir</label>
				    <div class="col-sm-5">
				    	<span><input type="text" class="form-control form-control-sm " id="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>"></span>
				    </div>
				    <div class="col-sm-4"> 
				      <input type="date" class="form-control form-control-sm " id="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>">
				      <small class="form-text text-muted" style="text-align: right;">tanggal/bulan/tahun</small>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="alamat" value="<?php echo $data['alamat']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_hp" value="<?php echo $data['no_telepon']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_petugas" class="col-sm-3 col-form-label">Spesialisasi</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="spesialisasi" value="<?php echo $data['spesialisasi']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="sip" class="col-sm-3 col-form-label">SIP / NIP</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="sip" value="<?php echo $data['sip']; ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#edit_dokter").on("submit", function(event) {
		event.preventDefault();
		var kd_dokter = $("#kd_dokter").val();
		var nm_dokter = $("#nm_dokter").val();
		var no_hp = $("#no_hp").val();
		var spesialisasi = $("#spesialisasi").val();
		var alamat = $("#alamat").val();
		var sip = $("#sip").val();
		var tanggal_lahir = $("#tanggal_lahir").val();
		var tempat_lahir = $("#tempat_lahir").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (nm_dokter=="") {
			document.getElementById("nm_dokter").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, data kurang lengkap tolong isi nama dokter',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, data kurang lengkap tolong isi nomor hp dokter',
			  'warning'
			)
		} else if (spesialisasi=="") {
			document.getElementById("spesialisasi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, data kurang lengkap, isi spesialisasi dokter',
			  'warning'
			)
		} else if (sip=="") {
			document.getElementById("sip").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, data kurang lengkap, isi SIP / NIP dokter',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Anda akan merubah data dokter ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_dokter.php",
	              data: "nm_dokter="+nm_dokter+"&no_hp="+no_hp+"&spesialisasi="+spesialisasi+"&kd_dokter="+kd_dokter+"&alamat="+alamat+"&sip="+sip+"&tempat_lahir="+tempat_lahir+"&tanggal_lahir="+tanggal_lahir,
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
				            window.location='?page=datadokter' ;
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
	          }
	        })
		}
	});
</script>