<?php 
	$id_pas = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-user-edit"></i> Form Edit Data Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-warning"><i class="fas fa-list"></i> List Data Pasien</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data Pasien</h6>
				<form method="POST" id="edit_pasien"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="id_pas" placeholder="masukkan nama pasien" value="<?php echo $id_pas; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM tbl_pasien WHERE id_pas='$id_pas'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>

				  <div class="form-group row pt-1">
				    <label for="nomor_rm" class="col-sm-3 col-form-label">Nomor RM</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nomor_rm" placeholder="masukkan nama pasien" value="<?php echo $data['nomor_rm']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Nama Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="nik" class="col-sm-3 col-form-label">No. KTP/NIK</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nik" placeholder="Edit Nomor KTP" autofocus="" value="<?php echo $data['nik']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="agama" class="col-sm-3 col-form-label">Agama Pasien</label>
				    <div class="col-sm-9">
				      <select name="agama" id="agama" class="form-control form-control-sm" <?php echo $data['agama']; ?>>
							<option value="">--------- Pilih Agama Pasien --------</option>
							<option value="Islam" <?php if($data['agama'] == "Islam") {echo "selected";} ?>>Islam</option>
							<option value="Kristen" <?php if($data['agama'] == "Kristen") {echo "selected";} ?>>Kristen</option>
							<option value="Katolik" <?php if($data['agama'] == "Katolik") {echo "selected";} ?>>Katolik</option>
							<option value="Hindu" <?php if($data['agama'] == "Hindu") {echo "selected";} ?>>Hindu</option>
							<option value="Budha" <?php if($data['agama'] == "Budha") {echo "selected";} ?>>Budha</option>
							<option value="Konghuchu" <?php if($data['agama'] == "Konghuchu") {echo "selected";} ?>>Konghuchu</option>
						</select>
				    </div>
				  </div>
				  <!-- <div class="form-group row pt-1">
				    <label for="asuransi_pas" class="col-sm-3 col-form-label">Cara Bayar</label>
				    <div class="col-sm-9">
				      <select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm" <?php echo $data['asuransi_pas']; ?>>
				      	<option value="0">-- Pilih Cara Bayar Pasien --</option>
				      	<option value="Pribadi" <?php if($data['asuransi_pas'] == "Pribadi") {echo "selected";} ?>>Pribadi</option>
								<option value="Laziznu" <?php if($data['asuransi_pas'] == "Laziznu") {echo "selected";} ?>>Laziznu</option>
				      </select>
				    </div>
				  </div> -->

				  <div class="form-group row pt-1">
				    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
				    <div class="col-sm-9">
				      <select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" <?php echo $data['pekerjaan']; ?>>
				      	<option value="">----------- Pilih Pekerjaan -----------</option>
				      	<option value="Belum/Tidak Bekerja" <?php if($data['pekerjaan'] == "Belum/Tidak Bekerja") {echo "selected";} ?>>Belum/Tidak Bekerja</option>
				      	<option value="Mengurus Rumah Tangga" <?php if($data['pekerjaan'] == "Mengurus Rumah Tangga") {echo "selected";} ?>>Mengurus Rumah Tangga</option>
				      	<option value="Wiraswasta" <?php if($data['pekerjaan'] == "Wiraswasta") {echo "selected";} ?>>Wiraswasta</option>
				      	<option value="Karyawan BUMD" <?php if($data['pekerjaan'] == "Karyawan BUMD") {echo "selected";} ?>>Karyawan BUMD</option>
				      	<option value="Karyawan BUMN" <?php if($data['pekerjaan'] == "Karyawan BUMN") {echo "selected";} ?>>Karyawan BUMN</option>
								<option value="Karyawan Swasta" <?php if($data['pekerjaan'] == "Karyawan Swasta") {echo "selected";} ?>>Karyawan Swasta</option>
								<option value="Petani/Pekebun" <?php if($data['pekerjaan'] == "Petani/Pekebun") {echo "selected";} ?>>Petani/Pekebun</option>
								<option value="Nelayan" <?php if($data['pekerjaan'] == "Nelayan") {echo "selected";} ?>>Nelayan</option>
								<option value="PNS" <?php if($data['pekerjaan'] == "PNS") {echo "selected";} ?>>PNS</option>
								<option value="Pensiunan" <?php if($data['pekerjaan'] == "Pensiunan") {echo "selected";} ?>>Pensiunan</option>
								<option value="Pelajar/Mahasiswa" <?php if($data['pekerjaan'] == "Pelajar/Mahasiswa") {echo "selected";} ?>>Pelajar/Mahasiswa</option>
								<option value="TNI" <?php if($data['pekerjaan'] == "TNI") {echo "selected";} ?>>TNI</option>
								<option value="POLRI" <?php if($data['pekerjaan'] == "POLRI") {echo "selected";} ?>>POLRI</option>
								<option value="Guru" <?php if($data['pekerjaan'] == "Guru") {echo "selected";} ?>>Guru</option>
								<option value="Perawat" <?php if($data['pekerjaan'] == "Perawat") {echo "selected";} ?>>Perawat</option>
								<option value="Bidan" <?php if($data['pekerjaan'] == "Bidan") {echo "selected";} ?>>Bidan</option>
								<option value="Dokter" <?php if($data['pekerjaan'] == "Dokter") {echo "selected";} ?>>Dokter</option>
								<option value="Nakes Lain" <?php if($data['pekerjaan'] == "Nakes Lain") {echo "selected";} ?>>Nakes Lain</option>
				      </select>
						</div>
					</div>

				  <div class="form-group row pt-1">
				    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">				    
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" <?php if($data['jk_pas'] == "Laki-laki") {echo "checked";} ?>> 
				      		Laki-Laki
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

				  <div class="form-group row pt-1">
				    <label for="tlahir_pas" class="col-sm-3 col-form-label">Tempat & Tgl Lahir</label>
				    <div class="col-sm-5">
				    	<span><input type="text" class="form-control form-control-sm " id="tpt_lahir" value="<?php echo $data['tpt_lahir']; ?>"></span>
				    </div>
				    <div class="col-sm-4"> 
				      <input type="date" class="form-control form-control-sm " id="tlahir_pas" value="<?php echo $data['lhr_pas']; ?>">
				      <small class="form-text text-muted" style="text-align: right;">tanggal/bulan/tahun</small>
				    </div>
				  </div>

				  <div class="form-group row pt-1">
				    <label for="no_hp" class="col-sm-3 col-form-label">No. HP Pasien</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="no_hp" placeholder="masukkan nomor hp pasien" autofocus="" value="<?php echo $data['no_hp']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="alm_pas" class="col-sm-3 col-form-label">Alamat Pasien</label>
				    <div class="col-sm-9">
				      <textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="masukkan alamat pasien" style="font-size: 14px;"><?php echo $data['alm_pas']; ?></textarea>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="alergi" class="col-sm-3 col-form-label">Alergi</label>
				    <div class="col-sm-9">
					      <textarea name="alergi" id="alergi" rows="2" class="form-control bg-warning" placeholder="Masukkan alergi (Jika pasien terdapat alergi) kosongkan bila tidak ada" style="font-size: 14px;"><?php echo $data['alergi']; ?></textarea>
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
	$("#edit_pasien").on("submit", function(event){
    event.preventDefault();
		var id_pas = $("#id_pas").val();
		var nama_pas = $("#nama_pas").val();
		var nik = $("#nik").val();
		var tpt_lahir = $("#tpt_lahir").val();
		var tgl_lahir = $("#tlahir_pas").val();
		// var asuransi_pas = $("#asuransi_pas").val();
		var pekerjaan = $("#pekerjaan").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var nomor_rm = $("#nomor_rm").val();
		var jk = document.querySelector('input[name="jk_pas"]:checked').value;
		var alergi = $("#alergi").val();
		var agama = $("#agama").val();


		// alert(nama+"/"+nik+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pasien',
			  'warning'
			)
		} else if (nik=="") {
			document.getElementById("nik").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor KTP',
			  'warning'
			)
		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor RM',
			  'warning'
			)
		} else if (alm_pas=="") {
			document.getElementById("alm_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat Pasien',
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
	              url: "ajax/edit_pasien.php",
	              data: "nama_pas="+nama_pas+"&nik="+nik+"&jk="+jk+"&tpt_lahir="+tpt_lahir+"&tgl_lahir="+tgl_lahir+"&pekerjaan="+pekerjaan+"&no_hp="+no_hp+"&alm_pas="+alm_pas+"&nomor_rm="+nomor_rm+"&id_pas="+id_pas+"&alergi="+alergi+"&agama="+agama,
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
				            window.location='?page=datapasien' ;
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