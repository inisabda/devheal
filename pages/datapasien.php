<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-8" id="judul"><h4><i class="fas fa-users"></i> Data Pasien <?php echo $nama_klinik; ?></h4>
		</div>
		<div class="col-4 text-right">
			<button class="btn btn-sm btn-primary" id="tombol_import" name="tombol_import" data-toggle="modal" data-target="#import_pasien"><i class="fas fa-upload"></i> Import Data Pasien</button>
			<a href="?page=tambah_datapasien">
				<button class="btn btn-sm btn-warning"><i class="fas fa-plus-circle"></i> Tambah Data Pasien</button>
			</a>
		</div>
		<div class="col-12">		
			<?php
				if(isset($_GET['berhasil'])){
					echo "<div class='alert alert-warning small' role='alert' id='alert'>
					".$_GET['berhasil']. " Data Pasien Berhasil Di Import. </div>" ;
				}
			?>
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="tabel_datapasien" class="table table-hover display tabel-data" width="100%">
					<thead>
				    <tr>
							<th>No.</th>
							<th>No RM</th>
							<th>Nama Pasien</th>
							<th>No. KTP</th>
							<th>Agama</th>
							<th>J-Kel</th>
		        	<th>Alamat</th>
		        	<th>TTL</th>
		        	<th>Pekerjaan</th>
		        	<th>No HP</th>
		        	<th>Opsi</th>
				 		</tr>
				  </thead>
					<tbody>	
				 	</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Import data pasien -->
<div class="modal fade" id="import_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-l" role="document">
  	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Import Data Pasien</h5>
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
							<button type="button" name="download" class="btn btn-sm btn-warning" onclick="JavaScript:window.location.href='pages/import_data_pasien/download_form_import_pasien.php?file=form_import_pasien.xls';"><i class="fas fa-download"></i> Download Format</button>
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

<script>
	$(document).ready(function() {
		var table = $("#tabel_datapasien").DataTable({
				"ajax": {
				"url" : "ajax/load_datapasien.php",
				"dataSrc" : ""
			},
			"lengthMenu" : [[20, 30, 40, -2], [20, 30, 40, "All"]],
      "order": [[ 1, "desc" ]],
			"columns" : [
				{"data" : "no",
					render: function ( data, type, row ) {
                return row.no + '.';
              }
				},
				{"data" : "nomor_rm", "width": '50px',},
				{"data": "nama_pas",
					"width": '100px',},
				{"data": "nik"},
				{"data": "agama"},
				{"data" : "jk_pas",
					"width": '50px'},
				{"data" : "alm_pas"},
				{"data" : "tpt_lahir",
				render: function ( data, type, row ) {
                return row.tpt_lahir + ', ' + row.lhr_pas + '';
            }
				},
				{"data" : "pekerjaan"},
				{"data" : "no_hp"},
				{"data" : null,
				 "width": '10px',
					"render": function ( data, type, row ) { // Tampilkan kolom aksi
            		var btn = "<button style=\"margin-right:2px; font-size: 10px;padding: 2px 4px;font-weight: lighter;\" class=\"btn-transition btn btn-outline-success btn-sm btnRawat\" title=\"Proses rawat\" href=\"#\">Daftarkan</button> \<br>"
            		btn+="<button style=\"margin-right:2px; font-size: 10px;padding: 2px 4px;font-weight: lighter;\" class=\"btn-transition btn btn-outline-primary btn-sm btnEdit\" title=\"Edit\" href=\"#\"><i class=\"fas fa-edit\"></i></button>"
            		btn += "<button style=\"margin-right:2px; font-size: 10px;padding: 2px 4px;font-weight: lighter;\" class=\"btn-transition btn btn-outline-danger btn-sm btnHapus\" title=\"Hapus\" href=\"#\"><i class=\"fas fa-trash\"></i></button>"
                return btn;
          	}
				},
        ],
          
		});
	$('#tabel_datapasien tbody').on( 'click', '.btnHapus', function (){
			var data = table.row( $(this).parents('tr') ).data();
			Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Akan menghapus data pasien '+data['nama_pas']+', Semua record rekam medis akan terhapus juga.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((hapus) => {
        if (hapus.value) {
          var id = data['id_pas'];
          var rm = data['nomor_rm'];
          $.ajax({
            type: "POST",
            url: "ajax/hapus.php?page=pasien",
            data: {id:id, rm:rm},
            success: function(hasil) {
              Swal.fire({
	          title: 'Berhasil',
	          text: 'Data Berhasil Dihapus',
	          type: 'success',
	          confirmButtonColor: '#3085d6',
	          confirmButtonText: 'OK'
	        }).then((ok) => {
	          if (ok.value) {
	            window.location='?page=datapasien';
	          }
	        })
            }
          })  
        }
      })			    
 	});
 	$('#tabel_datapasien tbody').on('click', '.btnEdit', function() {
  	var data = table.row( $(this).parents('tr') ).data();
  	//var id = data['no_daftar'];
		window.location='?page=edit_datapasien&id='+data['id_pas'];
  });
  $('#tabel_datapasien tbody').on('click', '.btnRawat', function() {
  	var data = table.row( $(this).parents('tr') ).data();
  	//var id = data['no_daftar'];
		window.location='?page=daftar_pasien&id='+data['id_pas'];
  });
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
			    	title: 'Import data pasien !!',
              text: 'Apakah anda telah mengisi data dengan benar ?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
			    }).then((ok) => {
			    	if (ok.value) {
			    	$.ajax({
			    		url:"pages/import_data_pasien/proses.php",  
	            method:"POST",  
	            data:new FormData(this),  
	            contentType:false,  
	            processData:false,
	            beforeSend:function(){
	               $('#import_pasien').hide();
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
								window.location='?page=datapasien&berhasil='+berhasil;
							})
	           },  
			    	})
			    }
			    })
				}
			})
		});
</script>
