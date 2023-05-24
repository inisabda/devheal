<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Aturan Pakai</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-8" id="judul"><h4><i class="fas fa-money-check-alt"></i> Cara Bayar dan Asuransi</h4></div>
			<div class="col-md-4 text-right">
						<button class="btn-transition btn btn-outline-success btn-xl" title="Tambah Cara Bayar" id="tambah_carabayar" name="tambah_carabayar" data-toggle="modal" data-target="#tambah_bayar"><i class="fas fa-plus-circle"></i> Tambah Data</i></button>
			</div>
		</div>
		<div class="table-container">			
		<div class="row" style="padding: 0 80px;">
			<div class="col-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data" width="100%">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>Cara Bayar Pasien</th>
				            <th>Nama Asuransi</th>
				            <th>Alamat</th>
				            <th>No Hp</th>
				            <th>Status</th>
				            <th class="text-center">Opsi</th>
				        </tr>
				    </thead>
				    <tbody>
								<?php 
									$no = 1;
									$query_tampil = "SELECT * FROM cara_bayar";
									$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
									while($data = mysqli_fetch_array($sql_tampil)) {
										$status_carabayar = $data['status'];
								 ?>
								 		<tr>
								 			<td width="1%"><?php echo $no++."."; ?></td>
								 			<td><?php echo $data['cara_bayar']; ?></td>
								 			<td><?php echo $data['asuransi']; ?></td>
								 			<td><?php echo $data['alamat']; ?></td>
								 			<td><?php echo $data['no_hp']; ?></td>
								 			<td><?php echo $data['status']; ?></td>
								 			<td class="td-opsi">
							             <!-- Button trigger modal -->
							             <a class="btn-transition btn btn-outline-primary btn-sm" id="tombolUbah" title="Edit Cara Bayar" data-toggle="modal" data-target="#editCarabayar" data-id="<?php echo $data['id_carabayar'];?>" data-nama="<?php echo $data['cara_bayar'];?>" data-asuransi="<?php echo $data['asuransi'];?>" data-alamat="<?php echo $data['alamat'];?>" data-no_hp="<?php echo $data['no_hp'];?>" data-status="<?php echo $data['status'];?>"><i class="fas fa-edit"></i>Ubah</a>
																									
						              <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_carabayar']; ?>" data-nama="<?php echo $data['cara_bayar']; ?>" data-asuransi="<?php echo $data['asuransi']; ?>">
						                  <i class="fas fa-trash"></i> Hapus
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


<!-- Modal Tambah Cara BAyar -->
<div class="modal fade" id="tambah_bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel">Input Data Cara Bayar</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
		 	<div class="form-container">
				<div class="row">
					<div class="col-md-10 offset-md-1 offset-form">
						<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data cara bayar</h6>
								<?php 		                   
				          $carikode = mysqli_query($conn, "SELECT MAX(id_carabayar) as kodeTerbesar FROM cara_bayar ") ;
				          $datakode = mysqli_fetch_array($carikode);
				 					$id_carabayar = $datakode['kodeTerbesar']+1;
				         ?>
						<form method="post" id="tambah_cara_bayar" autocomplete="off">
						  <div class="form-group row pt-3">
						    <label for="id_carabayar" class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-9">
						      <input type="hidden" class="form-control form-control-sm"  name="id_carabayar" id="id_carabayar" value="<?php echo $id_carabayar; ?>" disabled >
						    </div>
						  </div>
		  				<div class="form-group row pt-3">
						    <label for="cara_bayar" class="col-sm-3 col-form-label">Cara Bayar</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="cara_bayar" id="cara_bayar" placeholder="Cara Bayar"  autofocus="">
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="asuransi" class="col-sm-3 col-form-label">Nama Asuransi</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="asuransi" id="asuransi" placeholder="Asuransi">
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="alamat" id="alamat" placeholder="Alamat Asuransi">
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="no_hp" class="col-sm-3 col-form-label">No Hp</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="no_hp" id="no_hp" placeholder="No HP">
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						  	<label for="status" class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-9">
						      <input type="hidden" class="form-control form-control-sm"  name="status" id="status" value="Aktif">
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-12 text-center">
						    	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
						      <button type="button" class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
						      <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
						    </div>
						  </div>
						</form>
					</div>
				</div>
			</div>
	  </div>
	</div>
</div>
<!-- Modal Edit Cara Bayar-->
<div class="modal fade" id="editCarabayar" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahModalLabel">Edit Cara Bayar dan Asuransi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-10 offset-md-1 offset-form">
	      		<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk edit data Cara Bayar</h6>
	      		<form method="POST" id="simpan_edit">
	      			<!-- <input type="text" name="idCarabayar" id="idCarabayar"> -->
			        <div class="form-group row pt-3">
						    <label for="idCarabayar" class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-9">
						      <input type="hidden" class="form-control" name="idCarabayar" id="idCarabayar" disabled >
						    </div>
						  </div>
		  				<div class="form-group row pt-3">
						    <label for="cara_bayar" class="col-sm-3 col-form-label">Cara Bayar</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="edit_carapembayaran" id="edit_carapembayaran" >
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="asuransi" class="col-sm-3 col-form-label">Asuransi</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="edit_asuransi" id="edit_asuransi" >
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="cara_bayar" class="col-sm-3 col-form-label">Alamat</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="edit_alamat" id="edit_alamat" >
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="cara_bayar" class="col-sm-3 col-form-label">No HP</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="edit_nohp" id="edit_nohp" >
						    </div>
						  </div>
						  <div class="form-group row pt-3">
						    <label for="status" class="col-sm-3 col-form-label">Status</label>
						    <div class="col-sm-9">
						      <select name="status_carabayar" id="status_carabayar" class="form-control form-control-sm">
						      	<option value="Aktif">Aktif</option>
						      	<option value="Tidak Aktif">Tidak Aktif</option>
						      </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <div class="col-sm-12 text-center">
						    	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
						    	<button type="button" class="btn btn-danger btn-sm" id="btnreset">Reset</button>
						      <button type="submit" name="ubah" class="btn btn-primary btn-sm">Update</button>
						    </div>
						  </div>
						</form>
	      	</div>
	      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script>
	$(document).on("click", "#tombolUbah", function(){
		let id_carabayar = $(this).data('id');
		let cara_bayar = $(this).data('nama');
		let asuransi = $(this).data('asuransi');
		let no_hp = $(this).data('no_hp');
		let alamat = $(this).data('alamat');
		let status = $(this).data('status');

		$(".modal-body #idCarabayar").val(id_carabayar);
		$(".modal-body #edit_carapembayaran").val(cara_bayar);
		$(".modal-body #edit_asuransi").val(asuransi);
		$(".modal-body #edit_alamat").val(alamat);
		$(".modal-body #edit_nohp").val(no_hp);
		$(".modal-body #status_carabayar").val(status);
	});

	$("#simpan_edit").on("submit", function(event){  
  	event.preventDefault();
		var id_carabayar = $("#idCarabayar").val();
		var cara_bayar = $("#edit_carapembayaran").val();
		var asuransi = $("#edit_asuransi").val();
		var alamat = $("#edit_alamat").val();
		var no_hp = $("#edit_nohp").val();
		var status = $("#status_carabayar").val();
		$.ajax({
		 	type: "POST",
		 	url: "ajax/edit_carabayar.php",
		 	data: "id_carabayar="+id_carabayar+"&cara_bayar="+cara_bayar+"&asuransi="+asuransi+"&alamat="+alamat+"&no_hp="+no_hp+"&status="+status,
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
	            window.location='?page=cara_bayar' ;
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
	});
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var cara_bayar = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'Akan menghapus data Cara Bayar '+cara_bayar+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=cara_bayar",
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
		            window.location='?page=cara_bayar';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	function reset_form() {
		$("#cara_bayar").val("");
		$("#edit_carapembayaran").val("");
		$("#asuransi").val("");
		$("#edit_asuransi").val("");
		$("#alamat").val("");
		$("#edit_alamat").val("");
		$("#no_hp").val("");
		$("#edit_nohp").val("");
	}

	$(".form-container #btn_reset").click(function() {
		reset_form();
		document.getElementById("cara_bayar").focus();
	});
	$(".modal-body #btnreset").click(function() {
		reset_form();
		document.getElementById("edit_carapembayaran").focus();
	});

	$("#tambah_cara_bayar").on("submit", function(event){  
  event.preventDefault();
		var id_carabayar = $("#id_carabayar").val();
		var cara_bayar = $("#cara_bayar").val();
		var asuransi = $("#asuransi").val();
		var alamat = $("#alamat").val();
		var no_hp = $("#no_hp").val();
		var status = $("#status").val();

		if(cara_bayar=="") {
			document.getElementById("cara_bayar").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi cara bayar',
			  'warning'
			)

		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_carabayar.php",
				data: "id_carabayar="+id_carabayar+"&cara_bayar="+cara_bayar+"&asuransi="+asuransi+"&alamat="+alamat+"&no_hp="+no_hp+"&status="+status,
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
				           window.location='?page=cara_bayar' ;
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
