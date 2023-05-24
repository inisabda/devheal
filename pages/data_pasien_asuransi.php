<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Pasien Asuransi</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-9" id="judul"><h4><i class="fas fa-users"></i> Data Pasien Asuransi (Insuranse)</h4>
		</div>
	</div>
	<div class="col-12">		
			<?php
				if(isset($_GET['berhasil'])){
					echo "<div class='alert alert-warning small' role='alert' id='alert'>
					".$_GET['berhasil']. " Data Pasien Asuransi Berhasil Di Import. </div>" ;
				}
			?>
	</div>
	<div class="col-9">			
		<form role="form" class="form-horizontal" method="GET" action="pages_cetak_surat/cetak_dataasuransi.php" target="_blank">
			<div class="row">
				<div class="position-relative form-group col-md-3">
					<label for="asuransi_pas" class="">Jenis Asuransi</label>
					<div class="input-group">
						<select name="asuransi" class="form-control form-control-sm">
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
				<div class="form-group">
					<label for="no_daftar" class="">Cetak</label>
					<div class="input-group">
						<button type="submit" class="btn btn-warning btn-submit btn-xl">
							<i class="fa fa-print"></i>
						</button>
					</div>
				</div>&nbsp;&nbsp;
				<div class="form-group">
					<label for="import" class="">Import Pasien</label>
					<div class="input-group">
						<button type="button" class="btn-transition btn btn-outline-primary btn-sm" title="Form Import Pasien Asuransi" id="tombol_import" name="tombol_import" data-toggle="modal" data-target="#importpasien_asuransi"><i class="fas fa-plus-circle"></i> Import Pasien</i></button>
					</div>
				</div>&nbsp;&nbsp;
				<div class="form-group">
					<label for="no_daftar" class="">Tambah Data Pasien</label>
					<div class="input-group input-group-md-2">
						<button type="button" class="btn-transition btn btn-outline-success btn-sm" title="Form Tambah Pasien Asuransi" id="tombol_tambah" name="tombol_tambah" data-toggle="modal" data-target="#tambahpasien_asuransi"><i class="fas fa-plus-circle"></i> Tambah Pasien</i></button>
					</div>
				</div>&nbsp;&nbsp;
				<div class="form-group">
					<label for="" class="">Tambah Jenis Asuransi</label>
					<div class="input-group input-group-md-2">
						<a href="?page=cara_bayar">
						<button type="button" class="btn btn-sm btn-danger" title="Tambah Jenis Asuransi"><i class="fas fa-plus-circle"></i> Tambah Jenis Asuransi</i></button></a>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
						<tr style="font-size: 11px;">
							<th>No.</th>
							<th>Nama Pasien</th>
							<th>No KTP</th>
							<th>TT Lahir</th>
							<th>Alamat</th>
							<th>Pekerjaan</th>
							<th>Jenis Asuransi</th>
							<th>Tgl Masuk</th>
							<th>Opsi</th>
		        		</tr>
				 	</thead>
				  	<tbody>
						<?php 
							$no = 1;
							$query_tampil = "SELECT * FROM tbl_pasien_asuransi";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td><?php echo $no++."."; ?></td>
				 			<td><b><?php echo $data['nm_pasien']; ?></b><br><?php echo $data['jk_pas']; ?></td>
				 			<td><?php echo $data['no_ktp']; ?></td>
				 			<td><?php echo $data['tempat_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['tanggal_lahir'])); ?></td>
				 			<td><?php echo $data['alamat_pas']; ?></td>
				 			<td><?php echo $data['pekerjaan']; ?></td>
				 			<td><?php echo $data['asuransi_pas']; ?></td>
				 			<td><?php echo date('d-m-Y',strtotime($data['tgl_masuk'])); ?></td>
				 			<td class="td-opsi">
								<button class="btn-transition btn btn-outline-success btn-sm" title="Daftarkan Pasien" id="tombol_daftar" name="tombol_daftar" data-id="<?php echo $data['id_asuransi']; ?>">
                      				<i class="fas fa-check-square"></i> Daftarkan
                  				</button><br>
								<button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['id_asuransi']; ?>">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_asuransi']; ?>" data-nama="<?php echo $data['nm_pasien']; ?>">
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
<!-- Modal Import data pasien asuransi -->
<div class="modal fade" id="importpasien_asuransi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-l" role="document">
	  	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Import Data Pasien Asuransi (Insurance)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		 	<div class="modal-body">
				<form action="" method="post" id="upload" enctype="multipart/form-data">
				  	<div class="position-relative row form-group">
						<label for="file" class="col-sm-2 col-form-label">File import</label>
						<div class="col-sm-10">
							<input name="file" id="file" type="file" class="form-control-file">
							<small class="form-text text-muted">Pilih file bertipe excel (.xls)</small>
						</div>
		       		</div>
				  	<div class="form-group row">
						<div class="col-sm-12 text-right">
							<button type="button" name="download" class="btn btn-sm btn-warning" onclick="JavaScript:window.location.href='pages/import_data_asuransi/download.php?file=form_pasien_asuransi.xls';"><i class="fas fa-download"></i> Download Format</button>
							<button type="submit" name="upload" class="btn btn-sm btn-info">Import</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			</div>
	  	</div>
	</div>
</div>
<!-- Modal Tambah Data Pasien Asuransi -->
<div class="modal fade" id="tambahpasien_asuransi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Tambah Data Pasien Tergabung Dalam Asuransi (Insurance)</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
		 	<div class="modal-body">
				<div class="row">
					<div class="col-md-10 offset-md-1 offset-form">
						<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data pasien ber-asuransi baru</h6>
						<?php 
		          $carikode = mysqli_query($conn, "SELECT MAX(id_asuransi) as kodeTerbesar FROM tbl_pasien_asuransi ") ;
		          $datakode = mysqli_fetch_array($carikode);
		 					$id_asuransi= $datakode['kodeTerbesar']+1;
		         ?>
						<form method="POST" id="simpan_pasien" autocomplete="off">
						  <div class="form-group row pt-1">
						    <label for="" class="col-sm-3 col-form-label"></label>
							    <div class="col-sm-9">
							      <input type="hidden" class="form-control form-control-sm"  name="id_asuransi" id="id_asuransi" value="<?php echo $id_asuransi; ?>">
							    </div>
						  </div>
						  <div class="col-sm-4">
		                <input name="tgl_masuk" id="tgl_masuk" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
		            </div>

						  <div class="form-group row pt-1">
						    <label for="nm_pasien" class="col-sm-3 col-form-label">Nama Pasien</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control form-control-sm" id="nm_pasien" placeholder="Masukkan nama pasien sesuai pada data asuransi" autofocus="">
						    </div>
						  </div>

						  <div class="form-group row pt-1">
						    <label for="no_ktp" class="col-sm-3 col-form-label">No KTP</label>
						    <div class="col-sm-9">
						      <input type="number" class="form-control form-control-sm count-chars" id="no_ktp" maxlength="16" data-max-chars="16" placeholder="Masukkan NIK 16 Digit">
						      <div style="font-size:12px; color:red; font-style:italic;" class="input-msg"></div>
						    </div>
						  </div>

						  <div class="form-group row pt-1">
						    <label for="tlahir_pasien" class="col-sm-3 col-form-label">Tempat & Tgl Lahir</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir">
						    </div>
						    <div class="col-sm-4">
						      <input type="date" class="form-control form-control-sm"  id="tlahir_pasien" placeholder="">
						      <small class="form-text text-muted" style="text-align: right;">Tanggal/Bulan/Tahun Lahir</small>
						    </div>
						  </div>
						  <div class="form-group row pt-1">
						    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
						    <div class="col-sm-5">
							    <div class="form-check">
							    	<label class="form-check-label" style="font-weight: normal;">
						      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" checked=""> 
						      		Laki-laki
						      	</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						      	<label class="form-check-label" style="font-weight: normal;">
                  		<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan">
                  		Perempuan
                  	</label>
							    </div>	                    
								</div>
							</div>

						  <div class="form-group row pt-1">
						    <label for="alamat" class="col-sm-3 col-form-label">Alamat Pasien</label>
						    <div class="col-sm-9">
						      <textarea id="alamat_pas" rows="2" class="form-control" placeholder="Masukkan alamat sesuai data pada Asuransi" style="font-size: 14px;" ></textarea>
						    </div>
						  </div>
						  <div class="form-group row pt-1">
								<label for="agama" class="col-sm-3 col-form-label">Agama</label>
						    <div class="col-sm-5">
						      <select name="agama" id="agama" class="form-control form-control-sm" required>
						      	<option value="">--------- Pilih Agama --------</option>
						      	<option value="Islam">Islam</option>
						      	<option value="Kristen">Kristen</option>
						      	<option value="Katolik">Katolik</option>
						      	<option value="Hindu">Hindu</option>
										<option value="Budha">Budha</option>
										<option value="Konghuchu">Konghuchu</option>
						      </select>
						    </div>
							</div>
							<div class="form-group row pt-1">
								<label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan Pasien</label>
						    <div class="col-sm-5">
						      <select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm">
						      	<option value="">------- Pilih Pekerjaan -------</option>
						      	<option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
						      	<option value="Mengurus Rumah Tangga" >Mengurus Rumah Tangga</option>
						      	<option value="Wiraswasta" >Wiraswasta</option>
						      	<option value="Karyawan BUMD" >Karyawan BUMD</option>
						      	<option value="Karyawan BUMN" >Karyawan BUMN</option>
										<option value="Karyawan Swasta" >Karyawan Swasta</option>
										<option value="Petani/Pekebun" >Petani/Pekebun</option>
										<option value="Nelayan" >Nelayan</option>
										<option value="PNS" >PNS</option>
										<option value="Pensiunan" >Pensiunan</option>
										<option value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
										<option value="TNI" >TNI</option>
										<option value="POLRI" >POLRI</option>
										<option value="Guru" >Guru</option>
										<option value="Perawat" >Perawat</option>
										<option value="Bidan" >Bidan</option>
										<option value="Dokter" >Dokter</option>
										<option value="Nakes Lain">Nakes Lain</option>
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
						      <button type="button" class="btn btn-danger btn-sm" id="btn_reset"><i class="fas fa-redo"></i> Reset</button>
						      <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
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

<script src="js/count.js"></script>
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
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'Akan menghapus data '+nama+', semua data yang berkaitan dengan pasien ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=data_pasien_asuransi",
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
		            window.location='?page=data_pasien_asuransi';
		          }
		        })
              }
            })  
          }
        })
	    
	});
	$("button[name='tombol_daftar']").click(function() {
		var id = $(this).data('id');
		window.location='?page=tambah_datapasien';
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_pasien_asuransi&id='+id;
	});

		function reset_form() {
		$("#nm_pasien").val("");
		$("#no_ktp").val("");
		$("#tempat_lahir").val("");
		$("#tlahir_pasien").val("");
		$("#alamat_pas").val("");

	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nm_pasien").focus();
	});

	$("#simpan_pasien").on("submit", function(event) {
		event.preventDefault();
		var kode = $("#id_asuransi").val();
		var tgl_masuk = $("#tgl_masuk").val();
		var nm_pasien = $("#nm_pasien").val();
		var no_ktp = $("#no_ktp").val();
		var tempat_lahir = $("#tempat_lahir").val();
		var tgl_lahir = $("#tlahir_pasien").val();
		var alamat_pas = $("#alamat_pas").val();
		var agama = $("#agama").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var pekerjaan = $("#pekerjaan").val();
		var jk_pas = document.querySelector('input[name="jk_pas"]:checked').value;

		
		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);
		if(nm_pasien=="") {
			document.getElementById("nm_pasien").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi nama pasien yang tergabung dalam asuransi',
			  'warning'
			)
		} else if (no_ktp=="") {
			document.getElementById("no_ktp").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi nomor KTP',
			  'warning'
			)
		} else if (tempat_lahir=="") {
			document.getElementById("tempat_lahir").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi tempat lahir',
			  'warning'
			)
		} else if (alamat_pas=="") {
			document.getElementById("alamat_pas").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi alamat lengkap',
			  'warning'
			)
		} else if (agama=="") {
			document.getElementById("agama").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi agama lengkap',
			  'warning'
			)
		} else if (asuransi_pas=="") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
			  'Maaf Data Belum Lengkap',
			  'Silahkan isi jenis asuransi yang dipilih',
			  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_pasien_asuransi.php",
				data: "kode="+kode+"&nm_pasien="+nm_pasien+"&no_ktp="+no_ktp+"&tempat_lahir="+tempat_lahir+"&tgl_lahir="+tgl_lahir+"&alamat_pas="+alamat_pas+"&tgl_masuk="+tgl_masuk+"&agama="+agama+"&pekerjaan="+pekerjaan+"&asuransi_pas="+asuransi_pas+"&jk_pas="+jk_pas,
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
				           window.location='?page=data_pasien_asuransi' ;
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
<script type="text/javascript">
    setTimeout(function () {
        // Closing the alert
        $('#alert').alert('close');
    }, 4000);
</script>
<script>
	$(document).ready(function(){
			$("#upload").on("submit", function(event){  
		  	event.preventDefault();
		    var file = $("#file").val();

		    if(file=="") {
		      document.getElementById("file").focus();
		      Swal.fire(
		        'Data Belum Lengkap',
		        'Maaf, tolong pilih file',
		        'warning'
		      )		    
		    } else {
			    Swal.fire({
			    	title: 'Import data pasien asuransi!!',
              text: 'Apakah anda telah mengisi data dengan benar ?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
			    }).then((ok) => {
			    	if (ok.value) {
			    	$.ajax({
			    		url:"pages/import_data_asuransi/proses.php",  
	            method:"POST",  
	            data:new FormData(this),  
	            contentType:false,  
	            processData:false,
	            beforeSend:function(){
	               $('#importpasien_asuransi').hide();
	            },
	            success:function(berhasil){
								Swal.fire({
						    	title: 'Proses simpan data !',
					        html: 'Mohon tunggu ...',
					        allowOutsideClick: false,
					        timer: 4000,
					        onOpen: () => {
				            Swal.showLoading()
				        },
					    }).then((ok) => {
								window.location='?page=data_pasien_asuransi&berhasil='+berhasil;
							})
	           },  
			    	})
			    }
			    })
				}
			})
		});
</script>