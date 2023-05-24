<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Surat Ijin Sakit</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Surat Ijin Sakit</h4></div>
			<div class="col-6 text-right">
				<a href="?page=tambah_ijin_mandiri">
						<button class="btn btn-sm btn-success" title="Tambah Surat Ijin Sakit">Tambah Surat Ijin</button></a>&nbsp;
				<a href="pages_cetak_surat/cetak_skdkosong.php" target="_blank">
						<button class="btn btn-sm btn-warning" title="Cetak Formulir Surat Ijin Kosong">Cetak SKD Kosong</button></a>
			</div>
		</div>
		<div class="table-container">
      <div class="row" style="padding: 0 16px;">
				<div class="col-md-12 vertical-form table-responsive">
					<br>
					<table id="example" class="table table-striped display tabel-data">
						<thead>
					        <tr>
					            <th>#</th>
					            <th>No Surat</th>
					            <th>Nama_Pasien</th>
					            <th>RM</th> 
					            <th>Alamat</th>					            
					            <th>Tanggal_Ijin</th>
					            <th>Lama_ijin</th>
					            <th>Mulai Ijin</th>
					            <th>Dokter</th>
					            <th>Opsi</th>
					        </tr>
					    </thead>
					    <tbody>
								<?php 
								//$no = 1;
								$query_tampil = "SELECT * FROM tbl_suratijin";
								$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
								while($data = mysqli_fetch_array($sql_tampil)) {
							 	?>
						 		<tr>
						 			<td width="1%"><?php echo $data['no']; ?>.</td>
						 			<td><button type="button" class="btn btn-link btn-sm" style='padding: 4px; font-size: 11px; text-align: left;' title='Lihat data surat ijin' id="data_surat" name="data_surat" data-id="<?php echo $data['no_surat']; ?>"><?php echo $data['no_surat']; ?></i></button>
						 			</td>
						 			<td><?php echo $data['nama_pas']; ?></td>
						 			<td><?php echo $data['nomor_rm']; ?></td>
						 			<td><?php echo $data['alm_pas']; ?></td>									 			
						 			<td><?php echo date('d-m-Y',strtotime($data['tgl_periksa'])); ?></td>
						 			<td><?php echo $data['istirahat']; ?></td>
						 			<td><?php echo date('d-m-Y',strtotime($data['mulai_tanggal'])); ?> s/d <?php echo date('d-m-Y',strtotime($data['akhir_tanggal'])); ?></td>
						 			<td><?php echo $data['nm_dokter']; ?></td>
						 			<td class="td-opsi">
						 				<a href="pages_cetak_surat/cetak_skd.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
						 				<button class="btn-transition btn btn-outline-dark btn-sm" title="Cetak" id="tombol_print" name="tombol_print">
				                  <i class="fas fa-print"></i>
				              </button>
				            </a>
				              <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_surat']; ?>">
				                  <i class="fas fa-edit"></i>
				              </button>
				              <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
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


<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'akan menghapus SKD atas nama '+nama+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=suratijin",
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
		            window.location.reload(true);
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='data_surat']").click(function() {
			var id = $(this).data('id');
			window.location='?page=lihat_suratijin&id='+id;
		});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_suratijin&id='+id;
	});

		
</script>
