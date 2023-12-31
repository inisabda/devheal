<?php 
	$no_supp = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Supplier</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Supplier</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Supplier</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datasupplier">
				<button class="btn btn-sm btn-info">Daftar Data Supplier</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data supplier</h6>
				<form method="POST" id="edit_suplier" autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="no_supp" class="col-sm-3 col-form-label">No Supplier</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_supp" placeholder="masukkan nama supplier" value="<?php echo $no_supp; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM tbl_supplier WHERE no_supp='$no_supp'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nama_supp" class="col-sm-3 col-form-label">Nama Supplier</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_supp" placeholder="masukkan nama supplier" autofocus="" value="<?php echo $data['nama_supp']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nama_pet" class="col-sm-3 col-form-label">Nama Petugas</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pet" placeholder="masukkan nama petugas" autofocus="" value="<?php echo $data['nama_pet']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_petugas" class="col-sm-3 col-form-label">No HP Petugas</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="no_petugas" placeholder="masukkan nomor hp petugas" autofocus="" value="<?php echo $data['nohp_pet']; ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="alm_supp" class="col-sm-3 col-form-label">Alamat Supplier</label>
				    <div class="col-sm-9">
				      <textarea name="alm_supp" id="alm_supp" rows="2" class="form-control" placeholder="masukkan alamat supplier" style="font-size: 14px;"><?php echo $data['alm_supp']; ?></textarea>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button type="submit" class="btn btn-info btn-sm">Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#edit_supplier").on("submit", function(event) {
		event.preventDefault();
		var no_supp = $("#no_supp").val();
		var nama_supp = $("#nama_supp").val();
		var nama_pet = $("#nama_pet").val();
		var no_petugas = $("#no_petugas").val();
		var alm_supp = $("#alm_supp").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if(nama_supp=="") {
			document.getElementById("nama_supp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama supplier',
			  'warning'
			)
		} else if (nama_pet=="") {
			document.getElementById("nama_pet").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama petugas supplier',
			  'warning'
			)
		} else if (no_petugas=="") {
			document.getElementById("no_petugas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas supplier',
			  'warning'
			)
		} else if (alm_supp=="") {
			document.getElementById("alm_supp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat supplier',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data supplier ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_supplier.php",
	              data: "nama_supp="+nama_supp+"&nama_pet="+nama_pet+"&no_petugas="+no_petugas+"&alm_supp="+alm_supp+"&no_supp="+no_supp,
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
				            window.location='?page=datasupplier' ;
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