<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Aturan Pakai</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4><i class="fas fa-receipt"></i> Data Dosis/Aturan Pakai</h4></div>
			<div class="col-6 text-right">
						<button class="btn-transition btn btn-outline-success btn-xl" title="Tambah Aturan Pakai" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_aturanpakai"><i class="fas fa-plus-circle"></i> Tambah Data</i></button>
			</div>
		</div>
		<div class="table-container">			
		<div class="row" style="padding: 0 80px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>Dosis Aturan Pakai</th>
				            <th class="text-center">Opsi</th>
				        </tr>
				    </thead>
				    <tbody>
								<?php 
									$no = 1;
									$query_tampil = "SELECT * FROM tbl_akai";
									$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
									while($data = mysqli_fetch_array($sql_tampil)) {
								 ?>
								 		<tr>
								 			<td width="1%"><?php echo $no++."."; ?></td>
								 			<td><?php echo $data['aturan_pakai']; ?></td>
								 			<td class="td-opsi">
							             <!-- Button trigger modal -->
							             <a class="btn-transition btn btn-outline-primary btn-sm" id="tombolUbah" title="Edit Aturan Pakai" data-toggle="modal" data-target="#editAturan" data-id_pakai="<?php echo $data['id_akai'];?>" data-nama="<?php echo $data['aturan_pakai'];?>"><i class="fas fa-edit"></i>Ubah</a>
																									
						              <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_akai']; ?>" data-nama="<?php echo $data['aturan_pakai']; ?>">
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

<!-- Modal Tambah Aturan Pakai -->
<div class="modal fade" id="detail_aturanpakai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel">Input Data Aturan Pakai</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
		 	<div class="form-container">
				<div class="row">
					<div class="col-md-10 offset-md-1 offset-form">
						<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data aturan pakai</h6>
								<?php 		                   
				          $carikode = mysqli_query($conn, "SELECT MAX(id_akai) as kodeTerbesar FROM tbl_akai ") ;
				          $datakode = mysqli_fetch_array($carikode);
				 					$id_akai = $datakode['kodeTerbesar']+1;
				         ?>
						<form method="post" id="tambah_aturan" autocomplete="off">
						  <div class="form-group row pt-3">
						    <label for="id_akai" class="col-sm-3 col-form-label">Kode Aturan Pakai</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  name="id_akai" id="id_akai" value="<?php echo $id_akai; ?>" placeholder="" disabled >
						    </div>
						  </div>
		  				<div class="form-group row pt-3">
						    <label for="aturan_pakai" class="col-sm-3 col-form-label">Aturan Pakai</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm"  id="aturan_pakai" placeholder="Masukkan Aturan Pakai"  autofocus="">
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
<!-- Modal Edit Aturan Pakai-->
<div class="modal fade" id="editAturan" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahModalLabel">Edit Aturan Pakai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-10 offset-md-1 offset-form">
	      		<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk edit data aturan pakai</h6>
	      		<form method="POST" id="simpan_edit">
	      			<!-- <input type="text" name="id_pakai" id="id_pakai"> -->
			        <div class="form-group row pt-3">
						    <label for="id_pakai" class="col-sm-3 col-form-label">Id Aturan</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="id_pakai" id="id_pakai" placeholder="" disabled >
						    </div>
						  </div>
		  				<div class="form-group row pt-3">
						    <label for="aturan_pakai" class="col-sm-3 col-form-label">Aturan Pakai</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="aturanPakai" id="aturanPakai" >
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
		let id_akai = $(this).data('id_pakai');
		let aturan_pakai = $(this).data('nama');

		$(".modal-body #id_pakai").val(id_akai);
		$(".modal-body #aturanPakai").val(aturan_pakai);
	});

	$("#simpan_edit").on("submit", function(event){  
  	event.preventDefault();
		var id_akai = $("#id_pakai").val();
		var aturan_pakai = $("#aturanPakai").val();
		$.ajax({
		 	type: "POST",
		 	url: "ajax/edit_aturanpakai.php",
		 	data: "id_akai="+id_akai+"&aturan_pakai="+aturan_pakai,
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
	            window.location='?page=aturan_pakai' ;
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
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'Akan menghapus data aturan pakai '+nama+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=aturan_pakai",
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
		            window.location='?page=aturan_pakai';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_aturan_pakai&id='+id;
	});

		function reset_form() {
		$("#aturan_pakai").val("");
		$("#aturanPakai").val("");
	}

	$(".form-container #btn_reset").click(function() {
		reset_form();
		document.getElementById("aturan_pakai").focus();
	});
	$(".modal-body #btnreset").click(function() {
		reset_form();
		document.getElementById("aturanPakai").focus();
	});

	$("#tambah_aturan").on("submit", function(event){  
  event.preventDefault();
		var id_akai = $("#id_akai").val();
		var aturan_pakai = $("#aturan_pakai").val();

		if(aturan_pakai=="") {
			document.getElementById("aturan_pakai").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi aturan pakai',
			  'warning'
			)

		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_aturanpakai.php",
				data: "id_akai="+id_akai+"&aturan_pakai="+aturan_pakai,
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
				           window.location='?page=aturan_pakai' ;
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
