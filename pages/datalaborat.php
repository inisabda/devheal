<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Laborat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4>Data Laborat</h4>
		</div>
		<div class="col-6 text-right">
			<button class="btn-transition btn btn-outline-danger btn-xl" title="detail laborat" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_laborat"><i class="fas fa-plus-circle"></i> Tambah Data</i></button>
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
    	<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>Kode Lab</th>
				            <th>Nama Laborat</th>
				            <th>Harga Laborat</th>
				            <th>Nilai Normal</th>
				            <th>Opsi</th>
				        </tr>
				    </thead>
				    <tbody>
								<?php 
									$no = 1;
									$query_tampil = "SELECT * FROM laborat";
									$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
									while($data = mysqli_fetch_array($sql_tampil)) {
								 ?>
								 		<tr>
								 			<td width="1%"><?php echo $no++."."; ?></td>
								 			<td><?php echo $data['kode_lab']; ?></td>
								 			<td><?php echo $data['nm_lab']; ?></td>
								 			<td>Rp. <?php echo $data['hrg_lab']; ?></td>
								 			<td><?php echo $data['nilai_normal']; ?> Mg/dL</td>
								 			<td class="td-opsi">
						              <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['kode_lab']; ?>">
						                  <i class="fas fa-edit"></i>
						              </button>
						              <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['kode_lab']; ?>" data-nama="<?php echo $data['nm_lab']; ?>">
						                  <i class="fas fa-trash"></i>
						              </button>
						          </td>
								 		</tr>
								 <?php 
									} 
								 ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Tambah Data Laborat -->
<div class="modal fade" id="detail_laborat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel">Input Data Pemeriksaan Laborat</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	 	<div class="form-container">
			<div class="row">
				<div class="col-md-10 offset-md-1 offset-form">
					<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data laborat baru</h6>
							<?php 
			                   
			          $carikode = mysqli_query($conn, "SELECT MAX(kode_lab) as kodeTerbesar FROM laborat ") ;
			          $datakode = mysqli_fetch_array($carikode);
			 					$id_laborat = $datakode['kodeTerbesar'];
			 					$urutan = (int) substr($id_laborat, 3, 3);
			 					$urutan =$urutan+1;
			 					$huruf = "LAB";
								$kode_lab = $huruf . sprintf("%03s", $urutan);
			         ?>

					<form action="javascrip:void(0);"  autocomplete="off">
					  <div class="form-group row pt-3">
					    <label for="kode_lab" class="col-sm-3 col-form-label">Kode Laborat</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm"  name="kode_lab" id="kode_lab" value="<?php echo $kode_lab; ?>" placeholder="" disabled >
					    </div>
					  </div>
	  				<div class="form-group row pt-3">
					    <label for="nm_lab" class="col-sm-3 col-form-label">Nama Laborat</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm"  id="nm_lab" placeholder="Masukkan nama Laborat"  autofocus="">
					    </div>
					  </div>
	  				<div class="form-group row pt-3">
					    <label for="hrg_lab" class="col-sm-3 col-form-label">Harga Laborat</label>
					    <div class="input-group-sm mb-3 col-sm-9">
					    	<div class="input-group-prepend">
	    						<span class="input-group-text" id="inputGroup-sizing-sm">Rp.</span>
					      <input type="text" class="form-control form-control-sm"  id="hrg_lab" placeholder="Masukkan harga Laborat" autofocus="">
					    	</div>
					    </div>
					  </div>
					  <div class="form-group row pt-3">
					    <label for="nilai_normal" class="col-sm-3 col-form-label">Nilai Normal Laborat</label>
					    <div class="input-group-sm mb-3 col-sm-9">
					    	<div class="input-group-prepend">
					      	<input type="text" class="form-control form-control-sm"  id="nilai_normal" placeholder="Masukkan nilai normal Laborat" autofocus=""><span class="input-group-text" id="inputGroup-sizing-sm">Mg/dL</span>
					    	</div>
					    </div>
					  </div>

					  <div class="form-group row">
					    <div class="col-sm-12 text-right">
					      <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
					      <button class="btn btn-primary btn-sm" id="btn_save">Save</button>
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
          text: 'Anda akan menghapus data laborat '+nama+', semua data laborat ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=datalaborat",
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
		            window.location='?page=datalaborat';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_datalaborat&id='+id;
	});

		function reset_form() {
		$("#nm_lab").val("");
		$("#hrg_lab").val("");
		$("#nilai_normal").val("");
	
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nm_lab").focus();
	});

	$("#btn_save").click(function() {
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
			  'Maaf kurang lengkap, tolong isi harga laborat',
			  'warning'
			)
		} else if (nilai_normal=="") {
			document.getElementById("nilai_normal").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf kurang lengkap, tolong isi nilai normal laborat',
			  'warning'
			)


		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_masterlaborat.php",
				data: "kode_lab="+kode_lab+"&nm_lab="+nm_lab+"&hrg_lab="+hrg_lab+"&nilai_normal="+nilai_normal,
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
