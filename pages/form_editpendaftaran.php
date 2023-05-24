<?php 
    $no_daftar = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pendaftaran Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Pendaftaran Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Pendaftaran Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-info">Daftar Data Pasien</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data pendaftaran Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="no_daftar" class="col-sm-3 col-form-label">No Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_daftar" placeholder="masukkan nama pasien" value="<?php echo $no_daftar; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
            $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            $data = mysqli_fetch_array($sql_tampil);
           ?>
				  <div class="form-group row pt-1">
				    <label for="nomor_rm" class="col-sm-3 col-form-label">Nomor RM</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Nama Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="asuransi_pas" class="col-sm-3 col-form-label">Cara Bayar</label>
				    <div class="col-sm-9">
				      <select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm" <?php echo $data['asuransi_pas']; ?>>
				      	<option value="0">pilih Asuransi Pasien</option>
				      	<option value="BPJS Kesehatan" <?php if($data['asuransi_pas'] == "BPJS Kesehatan") {echo "selected";} ?>>BPJS Kesehatan</option>
				      	<option value="Pribadi" <?php if($data['asuransi_pas'] == "Pribadi") {echo "selected";} ?>>Pribadi</option>
				      	<option value="Laziznu" <?php if($data['asuransi_pas'] == "Laziznu") {echo "selected";} ?>>Laziznu</option>

				      </select>
				    </div>
				  </div>

				  <div class="form-group row pt-1">
				    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" <?php if($data['jk_pas'] == "Laki-laki") {echo "checked";} ?>> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan" <?php if($data['jk_pas'] == "Perempuan") {echo "checked";} ?>>
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="tlahir_pas" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="tpt_lahir" value="<?php echo $data['tpt_lahir'] ?>">
				    </div>
				    <div class="col-sm-5">
				      <input type="date" class="form-control form-control-sm" id="tlahir_pas" value="<?php echo $data['lhr_pas'] ?>">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>

				  <div class="form-group row pt-1">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_hp" value="<?php echo $data['no_hp']; ?>">
				    </div>
				  </div>				  
				  <div class="form-group row pt-1">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpanedit">Simpan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#btn_simpanedit").click(function() {
		var no_daftar = $("#no_daftar").val();
		var nama_pas = $("#nama_pas").val();
		var tpt_lahir = $("#tpt_lahir").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var no_hp = $("#no_hp").val();
		var nomor_rm = $("#nomor_rm").val();
		var jk = document.querySelector('input[name="jk_pas"]:checked').value;


		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pasien',
			  'warning'
			)
		} else if (asuransi_pas=="") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama petugas pasien',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp Pasien',
			  'warning'
			)

		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor RM',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Edit Pendaftaran Pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_pendaftaranpasien.php",
	              data: "nama_pas="+nama_pas+"&jk="+jk+"&tpt_lahir="+tpt_lahir+"&tgl_lahir="+tgl_lahir+"&asuransi_pas="+asuransi_pas+"&no_hp="+no_hp+"&nomor_rm="+nomor_rm+"&no_daftar="+no_daftar,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Diagnosa Berhasil diinput ',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=pendaftaranpasien' ;
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