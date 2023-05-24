<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4><i class="fas fa-list"></i> Data Masuk Pendaftaran Pasien</h4>
		</div>
		<div class="col-6 text-right">
			<a href="?page=tambah_datapasien">
				<button class="btn btn-sm btn-warning"><i class="fas fa-plus-circle"></i> Pendaftaran Pasien Baru</button>
			</a>&nbsp;
			<a href="?page=laporpasien">
				<button class="btn btn-sm btn-danger"><i class="fas fa-clipboard-check"></i> Rekap Insurance</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="tabel_datadaftar" class="table table-hover display tabel-data">
					<thead>
		        <tr style="font-size: 11px;">
	        	 	<th>Tgl Daftar</th>
	            <th>No Reg</th>
	            <th>Nama</th>
	            <th>No RM</th>
	            <th>Cara Bayar</th>
	            <th>Jenis Kelamin</th>
	            <th>Alamat</th>
	            <th>Tanggal Lahir</th>
	            <th>No HP</th>		           
	            <th>Antrian</th>
	            <th>Opsi</th>
	 		      </tr>
	 		    </thead>
	 		    <tbody>
						<?php 
							$query_tampil = "SELECT * FROM tbl_daftarpasien ORDER BY tgl_daftar DESC";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						?>
				 		<tr>
				 			<td><?php echo date('d-m-Y',strtotime($data['tgl_daftar'])); ?></td>
				 			<td><?php echo $data['no_daftar']; ?></td>
				 			<td><?php echo $data['nama_pas']; ?></td>
				 			<td><?php echo $data['nomor_rm']; ?></td>
				 			<td><?php echo $data['asuransi_pas']; ?></td>
				 			<td><?php echo $data['jk_pas']; ?></td>
				 			<td><?php echo $data['alm_pas']; ?></td>
				 			<td><?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?></td>
				 			<td><?php echo $data['no_hp']; ?></td>
				 			<td style="font-size:26px;" align="center" ><font color="red"><?php echo $data['no_antrian']; ?></font></td>
				 			<td class="td-opsi">
		              <button class="btn-transition btn btn-outline-success btn-sm" title="Perawatan" id="tombol_rawat" name="tombol_rawat" data-no_daftar="<?php echo $data['no_daftar']; ?>" data-nama_pas="<?php echo $data['nama_pas']; ?>">
		                  <i class="fas fa-check-square"></i>
		              </button>
		              <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_daftar']; ?>">
		                  <i class="fas fa-user-edit"></i>
		              </button>
		              <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
		                  <i class="fas fa-trash"></i>
		              </button>
		          </td>
		          <?php } ?>
				 		</tr>				 
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
	          text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((hapus) => {
	          if (hapus.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/hapus.php?page=datapendaftaran",
	              data: "id="+id,
	              success: function(hasil) {
	                Swal.fire({
			          title: 'Berhasil',
			          text: 'Data Berhasil Dihapus',
			          type: 'success',
			          confirmButtonColor: '#3085d6',
			          confirmButtonText: 'OK'
			        }).then((ok) => {
			           //if (ok.value) {
                  window.location.reload(true);                                
                //}
			        })
	              }
	            })  
	          }
	        })
	    }
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_pendaftaran&id='+id;
	});

 $("button[name='tombol_rawat']").click(function() {
        var no_daftar = $(this).data("no_daftar");
        var nama_pas = $(this).data("nama_pas");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda telah Merawat '+no_daftar+' dengan nama '+nama_pas+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Daftar'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=rawat",
              data: "no_daftar="+no_daftar,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Pasien telah dirawat',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                    }).then((ok) => {
			          if (ok.value) {
			            window.location='?page=perawatan';
			          }
			        })
              }
            })  
          }
        })
    });

</script>