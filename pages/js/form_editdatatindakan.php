<?php 
	$kd_tindakan = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=data_tindakan"><i class="fas fa-briefcase-medical"></i> Data Tindakan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Tindakan</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Tindakan</h4></div>
		<div class="col-6 text-right">
			<a href="?page=data_tindakan">
				<button class="btn btn-sm btn-info">Data Tindakan</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data Tindakan</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_tindakan" class="col-sm-3 col-form-label">Kode Tindakan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_tindakan" placeholder="masukkan nama pasien" value="<?php echo $kd_tindakan; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM data_tindakan WHERE kd_tindakan='$kd_tindakan'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>

				  <div class="form-group row pt-3">
				    <label for="nomor_rm" class="col-sm-3 col-form-label">Nama Tindakan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_tindakan" placeholder="masukkan nama Tindakan" autofocus="" value="<?php echo $data['nama_tindakan']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Harga Tindakan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="harga_tindakan" placeholder="masukkan harga_tindakan" autofocus="" value="<?php echo $data['harga_tindakan']; ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpanedit">Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#btn_simpanedit").click(function() {
		var kd_tindakan = $("#kd_tindakan").val();
		var nama_tindakan = $("#nama_tindakan").val();
		var harga_tindakan = $("#harga_tindakan").val();


		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

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
			  'maaf, tolong isi nama harga_tindakan',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data Pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_mastertindakan.php",
	              data: "nama_tindakan="+nama_tindakan+"&harga_tindakan="+harga_tindakan+"&kd_tindakan="+kd_tindakan,
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
				            window.location='?page=data_tindakan' ;
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