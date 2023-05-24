<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Dokter</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4><i class="fas fa-stethoscope"></i> Data Dokter</h4>
		</div>
		<div class="col-6 text-right">
			<button class="btn-transition btn btn-outline-success btn-xl" title="detail obat" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_obat"><i class="fas fa-plus-circle"></i> Tambah Dokter</button>
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
		        <tr>
	            <th>No</th>
	            <th>Nama Dokter</th>
	            <th>Jenis Kelamin</th>
	            <th>Alamat</th>
	            <th>No Telepon</th>
	            <th>SIP / NIP</th>
	            <th>Spesialisasi</th>
	            <th>Opsi</th>
		        </tr>
			    </thead>
			    <tbody>
						<?php 
						/*$no = 1;*/
							$query_tampil = "SELECT * FROM dokter";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td><?php echo $data['kd_dokter']; ?></td>
				 			<td><?php echo $data['nm_dokter']; ?></td>
				 			<td><?php echo $data['jns_kelamin']; ?></td>
				 			<td><?php echo $data['alamat']; ?></td>
				 			<td><?php echo $data['no_telepon']; ?></td>
				 			<td><?php echo $data['sip']; ?></td>
				 			<td><?php echo $data['spesialisasi']; ?></td>
				 			<td class="td-opsi">
	                <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['kd_dokter']; ?>">
	                    <i class="fas fa-edit"></i>
	                </button>
	                <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['kd_dokter']; ?>" data-nama="<?php echo $data['nm_dokter']; ?>">
	                    <i class="fas fa-trash"></i>
	                </button>
	            </td>
				 		</tr>
						<?php } ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Tambah Data Dokter -->
<div class="modal fade" id="detail_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel">Input Data Dokter</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	 	<div class="form-container">
			<div class="row">
				<div class="col-md-10 offset-md-1 offset-form">
					<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data dokter baru</h6>
					<?php 
	                   
	          $carikode = mysqli_query($conn, "SELECT MAX(kd_dokter) as kodeTerbesar FROM dokter ") ;
	          $datakode = mysqli_fetch_array($carikode);
	 					$kd_dokter = $datakode['kodeTerbesar'];
	 					$urutan = (int) substr($kd_dokter, 3, 3);
	 					$urutan =$urutan+1;
	 					$huruf = "DOK";
						$kd_dokter = $huruf . sprintf("%03s", $urutan);
	         ?>
					<form method="POST" id="simpan_dokter" autocomplete="off">
					  <div class="form-group row pt-3">
					    <label for="kd_dokter" class="col-sm-3 col-form-label">Kode dokter</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="kd_dokter" id="kd_dokter" value="<?php echo $kd_dokter; ?>" placeholder="masukkan kode dokter" autofocus="" readonly>
						    </div>
					  </div>
	  					<div class="col-sm-4">
	                <input name="tgl_input" id="tgl_input" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
	            </div>

					  <div class="form-group row pt-3">
					    <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Dokter</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm"  id="nm_dokter" placeholder="masukkan nama dokter"  autofocus="">
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
					      <input type="number" class="form-control form-control-sm"  id="no_hp" placeholder="masukkan nomor hp dokter" autofocus="">
					    </div>
					  </div>

					  <div class="form-group row">
					    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="tempat_lahir" placeholder="masukkan Tempat Lahir" autofocus="">
					    </div>
					  </div>

					  <div class="form-group row pt-3">
					    <label for="tlahir_dokter" class="col-sm-3 col-form-label">Tanggal Lahir</label>
					    <div class="col-sm-9">
					      <input type="date" class="form-control form-control-sm"  id="tlahir_dokter" placeholder="masukkan tanggal lahir dokter">
					      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
					    </div>
					  </div>

					  <div class="form-group row">
					    <label for="alamat" class="col-sm-3 col-form-label">Alamat dokter</label>
					    <div class="col-sm-9">
					      <textarea id="alamat" rows="2" class="form-control" placeholder="masukkan alamat dokter" style="font-size: 14px;" ></textarea>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="spesialisasi" class="col-sm-3 col-form-label">Spesialis</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm" id="spesialisasi"  placeholder="masukkan spesialisasi" autofocus="">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="sip" class="col-sm-3 col-form-label">SIP / NIP</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm" id="sip"  placeholder="Masukkan SIP / NIP Dokter">
					    </div>
					  </div>

					  <div class="form-group row">
					    <div class="col-sm-12 text-right">
					      <button type="button" class="btn btn-danger btn-sm" id="btn_reset"><i class="fas fa-redo"></i> Reset</button>
					      <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
			</div>
	  </div>
	</div>
</div>

<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data '+nama+', semua data transaksi pembelian yang berkaitan dengan dokter ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=dokter",
              data: "id="+id,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=datadokter';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_datadokter&id='+id;
	});

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

	$("#simpan_dokter").on("submit", function(e) {
		e.preventDefault();
		var kode = $("#kd_dokter").val();
		var nm_dokter = $("#nm_dokter").val();
		var tgl_input = $("#tgl_input").val();
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
		} else if (sip=="") {
			document.getElementById("sip").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi SIP / NIP Dokter',
			  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_dokter.php",
				data: "nm_dokter="+nm_dokter+"&kode="+kode+"&jk="+jk+"&tempat_lahir="+tempat_lahir+"&tgl_lahir="+tgl_lahir+"&alamat="+alamat+"&no_hp="+no_hp+"&spesialisasi="+spesialisasi+"&sip="+sip+"&tgl_input="+tgl_input,
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
