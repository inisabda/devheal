<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pegawai</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4><i class="fas fa-users"></i> Data Pegawai</h4>
		</div>
		<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Pendaftaran') { ?>
		<div class="col-6 text-right">
			<a href="?page=tambah_datapegawai">
				<button class="btn btn-sm btn-warning"><i class="fas fa-plus-circle"></i> Tambah Data Pegawai</button>
			</a>
		</div>
		<?php } ?>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
						<tr>
							<th>No</th>
				            <th>ID</th>
				            <th>Nama</th>
				            <th>Posisi</th>
				            <th>Alamat</th>
				            <th>Jenis Kelamin</th>
				            <th>Tanggal Lahir</th>
				            <th>No HP</th>
				            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Pendaftaran') { ?>
				            <th>Opsi</th>
				        	<?php } ?>
				        </tr>
				    </thead>
				    <tbody>
						<?php 
							$no = 1;
							$query_tampil = "SELECT * FROM tbl_pegawai";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						?>
				 		<tr>
						 	<td><?php echo $no++; ?></td>
				 			<td><?php echo $data['id_peg']; ?></td>
				 			<td><?php echo $data['nama_peg']; ?></td>
				 			<td><?php echo $data['pos_peg']; ?></td>
				 			<td><?php echo $data['alamat_peg']; ?></td>
				 			<td width="13%"><?php echo $data['jk_peg']; ?></td>
				 			<td><?php echo $data['lhr_peg']; ?></td>
				 			<td><?php echo $data['hp_peg']; ?></td>
				 			<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Pendaftaran' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2') { ?>
				 			<td class="td-opsi">
				 				<button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['id_peg']; ?>"><i class="fas fa-user-edit"></i></button>
				 				<button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_peg']; ?>" data-nama="<?php echo $data['nama_peg']; ?>"><i class="fas fa-trash"></i></button>
		          			</td>
			            	<?php } ?>
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
		// alert(id);
		if(id==id_session) {
			Swal.fire({
	          title: 'Error !',
	          text: 'Anda tidak bisa menghapus data anda sendiri, mintalah admin atau manajer untuk menghapusnya',
	          type: 'error',
	          confirmButtonColor: '#3085d6',
	          confirmButtonText: 'OK'
	        }).then((baik) => {
	          if (baik.value) {

	          }
	        })
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan pegawai ini akan ikut terhapus',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((hapus) => {
	          if (hapus.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/hapus.php?page=pegawai",
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
			            window.location='?page=datapegawai';
			          }
			        })
	              }
	            })  
	          }
	        })
	    }
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_datapegawai&id='+id;
	});
</script>