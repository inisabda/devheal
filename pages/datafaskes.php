<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Faskes Rujukan</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>
			<i class="fas fa-receipt"></i> Nama Faskes Rujukan</h4>
		</div>
		<div class="col-6 text-right">
			<button class="btn-transition btn btn-outline-success btn-xl" title="Tambah Data Faskes Rujukan" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_faskes"><i class="fas fa-plus-circle"></i> Tambah Data</i></button>
		</div>
	</div>
	<div class="table-container">			
		<div class="row" style="padding: 0 80px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>Nama Faskes Rujukan</th>
				            <th>Alamat Faskes Rujukan</th>
				            <th class="text-center">Opsi</th>
				        </tr>
				    </thead>
			    	<tbody>
						<?php 
							$no = 1;
							$query_tampil = "SELECT * FROM tbl_faskes";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td width="1%"><?php echo $no++."."; ?></td>
				 			<td><?php echo $data['nama_faskes']; ?></td>
				 			<td><?php echo $data['alamat_faskes']; ?></td>
				 			<td class="td-opsi">
					             <!-- Button trigger modal -->
					             <a class="btn-transition btn btn-outline-primary btn-sm" id="tombolUbah" title="Edit Faskes Rujukan" data-toggle="modal" data-target="#editfaskes" data-id_faskes="<?php echo $data['id_faskes'];?>" data-nama="<?php echo $data['nama_faskes'];?>"
					             			data-alamat="<?php echo $data['alamat_faskes'];?>"><i class="fas fa-edit"></i>Ubah</a>
					             <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_faskes']; ?>" data-nama="<?php echo $data['nama_faskes']; ?>">
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

<!-- Modal entri faskes -->
<div class="modal fade" id="detail_faskes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  	<div class="modal-content">
	    	<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Input Data Faskes Rujukan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
	    	</div>
		 	<div class="form-container">
				<div class="row">
					<div class="col-md-10 offset-md-1 offset-form">
						<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data faskes rujukan</h6>
						<?php 		                   
				          $carikode = mysqli_query($conn, "SELECT MAX(id_faskes) as kodeTerbesar FROM tbl_faskes ") ;
				          $datakode = mysqli_fetch_array($carikode);
				 			$id_faskes = $datakode['kodeTerbesar']+1;
				         ?>
						<form method="post" id="tambah_faskes" autocomplete="off">
						  	<div class="form-group row pt-3">
							    <label for="id_akai" class="col-sm-3 col-form-label"></label>
							    <div class="col-sm-9">
							      <input type="hidden" class="form-control form-control-sm" name="id_faskes" id="id_faskes" value="<?php echo $id_faskes; ?>" placeholder="" disabled >
							    </div>
						  	</div>
		  					<div class="form-group row pt-3">
								<label for="nama faskes" class="col-sm-3 col-form-label">Nama Faskes Rujukan</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control form-control-sm"  id="nama_faskes" placeholder="Masukkan Nama Fasilitas Kesehatan Rujukan"  autofocus="">
								</div>
							</div>
							<div class="form-group row pt-3">
								<label for="alamat faskes" class="col-sm-3 col-form-label">Alamat Faskes Rujukan</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control form-control-sm"  id="alamat_faskes" placeholder="Masukkan Alamat Fasilitas Kesehatan Rujukan">
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

<!-- Modal Edit faskes -->
<div class="modal fade" id="editfaskes" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-xl" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="ubahModalLabel">Edit Data Faskes Rujukan</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
      		</div>
      		<div class="modal-body">
      			<div class="row">
	      			<div class="col-md-10 offset-md-1 offset-form">
	      				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk edit data faskes rujukan</h6>
	      				<form method="POST" id="simpan_faskes">
			        		<div class="form-group row pt-3">
						    	<label for="id_pakai" class="col-sm-3 col-form-label"></label>
						    	<div class="col-sm-9">
						      		<input type="hidden" class="form-control" name="idfaskes" id="idfaskes" placeholder="" disabled >
						    	</div>
						  	</div>
		  					<div class="form-group row pt-3">
							    <label for="aturan_pakai" class="col-sm-3 col-form-label">Nama Faskes</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" name="namafaskes" id="namafaskes" >
							    </div>
						  	</div>
						  	<div class="form-group row pt-3">
							    <label for="aturan_pakai" class="col-sm-3 col-form-label">Alamat Faskes</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" name="alamatfaskes" id="alamatfaskes" >
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
			<div class="modal-footer">
			</div>
		</div>
  	</div>
</div>

<script>
	$(document).on("click", "#tombolUbah", function(){
		let id_faskes = $(this).data('id_faskes');
		let nama_faskes = $(this).data('nama');
		let alamat_faskes = $(this).data('alamat');

		$(".modal-body #idfaskes").val(id_faskes);
		$(".modal-body #namafaskes").val(nama_faskes);
		$(".modal-body #alamatfaskes").val(alamat_faskes);
	});

	$("#simpan_faskes").on("submit", function(event){  
  	event.preventDefault();
		var id_faskes = $("#idfaskes").val();
		var nama_faskes = $("#namafaskes").val();
		var alamat_faskes = $("#alamatfaskes").val();
		$.ajax({
		 	type: "POST",
		 	url: "ajax/edit_faskes.php",
		 	data: "id_faskes="+id_faskes+"&nama_faskes="+nama_faskes+"&alamat_faskes="+alamat_faskes,
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
	            window.location='?page=datafaskes' ;
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
              url: "ajax/hapus.php?page=faskes",
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
		            window.location='?page=datafaskes';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	function reset_form() {
		$("#nama_faskes").val("");
		$("#alamat_faskes").val("");
		$("#namafaskes").val("");
		$("#alamatfaskes").val("");
	}

	$(".form-container #btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_faskes").focus();
	});
	$(".modal-body #btnreset").click(function() {
		reset_form();
		document.getElementById("namafaskes").focus();
	});

	$("#tambah_faskes").on("submit", function(event){  
 	 event.preventDefault();
		var id_faskes = $("#id_faskes").val();
		var nama_faskes = $("#nama_faskes").val();
		var alamat_faskes = $("#alamat_faskes").val();

		if(nama_faskes=="") {
			document.getElementById("nama_faskes").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Silahkan lengkapi data nama faskes rujukan',
			  'warning'
			)
		} else if (alamat_faskes=="") {
		document.getElementById("alamat_faskes").focus();
		Swal.fire(
		  'Maaf Data Belum Lengkap',
		  'Silahkan lengkapi data alamat faskes rujukan',
		  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_faskes.php",
				data: "id_faskes="+id_faskes+"&nama_faskes="+nama_faskes+"&alamat_faskes="+alamat_faskes,
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
				           window.location='?page=datafaskes' ;
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