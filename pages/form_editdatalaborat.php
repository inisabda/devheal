<?php 
	$kode_lab = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Laborat</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Laborat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Laborat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datalaborat">
				<button class="btn btn-sm btn-info">Daftar Data Laborat</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-8 offset-md-2 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data laborat</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kode_lab" class="col-sm-3 col-form-label">Kode Laborat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kode_lab" placeholder="Masukkan nama kode laborat" value="<?php echo $kode_lab; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM laborat WHERE kode_lab='$kode_lab'";
						$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
						$data = mysqli_fetch_array($sql_tampil);
				  ?>
				  
  				<div class="form-group row pt-3">
				    <label for="nm_lab" class="col-sm-3 col-form-label">Nama Laborat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  id="nm_lab" placeholder="Masukkan nama Laborat"  value="<?php echo $data['nm_lab']; ?>" autofocus="">
				    </div>
				  </div>
  				<div class="form-group row pt-3">
				    <label for="hrg_lab" class="col-sm-3 col-form-label">Harga Laborat</label>
				    <div class="input-group-sm mb-3 col-sm-9">
				    	<div class="input-group-prepend">
    						<span class="input-group-text" id="inputGroup-sizing-sm">Rp.</span>
				      <input type="text" class="form-control form-control-sm"  id="hrg_lab" placeholder="Masukkan harga Laborat" value="<?php echo $data['hrg_lab']; ?>" autofocus="">
				    	</div>
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nilai_normal" class="col-sm-3 col-form-label">Nilai Normal Laborat</label>
				    <div class="input-group-sm mb-3 col-sm-9">
				    	<div class="input-group-prepend">
				      	<input type="text" class="form-control form-control-sm"  id="nilai_normal" placeholder="Masukkan nilai normal Laborat" value="<?php echo $data['nilai_normal']; ?>" autofocus=""><span class="input-group-text" id="inputGroup-sizing-sm">Mg/dL</span>
				    	</div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#btn_simpan").click(function() {
		var kode_lab = $("#kode_lab").val();
		var nm_lab = $("#nm_lab").val();
		var hrg_lab = $("#hrg_lab").val();
		var nilai_normal = $("#nilai_normal").val();
		
		// alert(nama_laborat+"/"+harga_laborat);

		if(nm_lab=="") {
			document.getElementById("nm_lab").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi nama laborat',
			  'warning'
			)
		} else if (hrg_lab=="") {
			document.getElementById("hrg_lab").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi Harga Laborat',
			  'warning'
			)
		} else if (nilai_normal=="") {
			document.getElementById("nilai_normal").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi Harga Laborat',
			  'warning'
			)

		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Akan merubah data Laborat ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	          }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_laborat.php",
	              data: "kode_lab="+kode_lab+"&nm_lab="+nm_lab+"&hrg_lab="+hrg_lab+"&nilai_normal="+nilai_normal,
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
				            window.location='?page=datalaborat' ;
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