<?php 
	$id_asuransi = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Pasien Asuransi</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien Asuransi</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-edit"></i> Form Edit Data Pasien Asuransi</h4></div>
		<div class="col-6 text-right">
			<a href="?page=data_pasien_asuransi">
				<button class="btn btn-sm btn-warning"><i class="fas fa-list"></i> List Data Pasien Asuransi</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-7 offset-md-2 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data pasien yang tergabung dalam asuransi</h6>
				<form method="POST" id="edit_pasien" autocomplete="off">
				  <div class="form-group row">
				  	<?php 
				  	$query_tampil = "SELECT * FROM tbl_pasien_asuransi WHERE id_asuransi='$id_asuransi'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				    <label for="id_asuransi" class="col-sm-3 col-form-label"></label>
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="id_asuransi" value="<?php echo $data['id_asuransi']; ?>" disabled="">
				    </div>
				  </div>
				  
				  <div class="form-group row pt-1">
				    <label for="nm_pasien" class="col-sm-3 col-form-label">Nama Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nm_pasien" placeholder="Masukkan nama pasien yang terbagung dalam asuransi" autofocus="" value="<?php echo $data['nm_pasien']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="no_ktp" class="col-sm-3 col-form-label">No. KTP Pasien </label>
				    <div class="col-sm-9">
				    	<input type="number" class="form-control form-control-sm count-chars" id="no_ktp" value="<?php echo $data['no_ktp']; ?>" maxlength="16" data-max-chars="16" placeholder="Masukkan NIK 16 Digit">
						      <div style="font-size:12px; color:red; font-style:italic;" class="input-msg"></div>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tempat & Tgl Lahir</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control form-control-sm" id="tempat_lahir" placeholder="Masukkan tempat lahir pasien" autofocus="" value="<?php echo $data['tempat_lahir']; ?>">
				    </div>
				    <div class="col-sm-4">
				      <input type="date" class="form-control form-control-sm" id="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>">
				      <small class="form-text text-muted" style="text-align: right;">Tanggal/Bulan/Tahun Lahir</small>
				    </div>
				  </div>
				 	<div class="form-group row">
				    <label for="alamat_pas" class="col-sm-3 col-form-label">Alamat Pasien</label>
				    <div class="col-sm-9">
				      <textarea id="alamat_pas" rows="2" class="form-control" style="font-size: 14px;" ><?php echo $data['alamat_pas']; ?></textarea>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" <?php if($data['jk_pas'] == "Laki-laki") {echo "checked";} ?>> 
				      		Laki-laki
				      	</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              	<label class="form-check-label" style="font-weight: normal;">
              		<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan" <?php if($data['jk_pas'] == "Perempuan") {echo "checked";} ?>>
              		Perempuan
              	</label>
          	  </div>
				    </div>
				  </div>
				  <div class="form-group row pt-1">
				    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
				    <div class="col-sm-5">
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
					<div class="form-group row pt-1">
				    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
				    <div class="col-sm-5">
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
				    <label for="asuransi" class="col-sm-3 col-form-label">Pilih Asuransi</label>
				    <div class="col-sm-5">
				    	<select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm" >
                  <option value="">----- Pilih Jenis Asuransi ----</option>
					      	<?php
		                //query menampilkan cara bayar ke dalam combobox
		                $query    =mysqli_query($conn, "SELECT * FROM cara_bayar");
		                while ($dataku = mysqli_fetch_array($query)) {
		                ?>
	            			<option value="<?=$dataku['cara_bayar'];?>"><?php echo $dataku['cara_bayar'];?></option>
	          			<?php } ?>
					    </select>
						</div>
					</div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-save"></i> Simpan Perubahan</button>
				      <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="js/count.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var maxChars = $("#no_ktp");
		var max_length = maxChars.attr('maxlength');
		if (max_length > 0) {
		    maxChars.bind('keyup', function(e){
		        length = new Number(maxChars.val().length);
		        counter = max_length-length;
		        $("#sessionNum_counter").text(counter);
		    });
		}
	});
	
</script>
<script>
	$("#edit_pasien").on("submit", function(event) {
		event.preventDefault();
		var id_asuransi = $("#id_asuransi").val();
		var nm_pasien = $("#nm_pasien").val();
		var no_ktp = $("#no_ktp").val();
		var tempat_lahir = $("#tempat_lahir").val();
		var tanggal_lahir = $("#tanggal_lahir").val();
		var alamat_pas = $("#alamat_pas").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var pekerjaan = $("#pekerjaan").val();
		var agama = $("#agama").val();
		var jk_pas = document.querySelector('input[name="jk_pas"]:checked').value;

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (nm_pasien=="") {
			document.getElementById("nm_pasien").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'tolong dilengkapi nama pasien',
			  'warning'
			)
		} else if (no_ktp=="") {
			document.getElementById("no_ktp").focus();
			Swal.fire(
			 'Maaf Data Belum Lengkap',
			  'tolong dilengkapi no KTP pasien',
			  'warning'
			)
		} else if (tempat_lahir=="") {
			document.getElementById("tempat_lahir").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'tolong dilengkapi empat lahir pasien',
			  'warning'
			)
		} else if (alamat_pas=="") {
			document.getElementById("alamat_pas").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'tolong dilengkapi alamat pasien',
			  'warning'
			)
		} else if (asuransi_pas=="") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'tolong dilengkapi jenis asuransi',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Anda akan merubah data pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_pasien_asuransi.php",
	              data: "nm_pasien="+nm_pasien+"&no_ktp="+no_ktp+"&tempat_lahir="+tempat_lahir+"&tanggal_lahir="+tanggal_lahir+"&alamat_pas="+alamat_pas+"&id_asuransi="+id_asuransi+"&agama="+agama+"&pekerjaan="+pekerjaan+"&jk_pas="+jk_pas+"&asuransi_pas="+asuransi_pas,
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
				            window.location='?page=data_pasien_asuransi';
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