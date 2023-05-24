<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4><i class="fas fa-file"></i> Data Rekam Medis Pasien</h4>
		</div>
		<!-- <div class="col-6 text-right">
			<a href="?page=pendaftaran">
				<button class="btn btn-sm btn-warning"><i class="fas fa-plus-circle"></i> Pendaftaran Pasien</button></a>
			<a href="?page=laporpasien">
        <button class="btn btn-sm btn-danger"><i class="fas fa-upload"></i> Export PDF</button></a>
       	<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-primary"> Export excel</button>
		</div> -->
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="example" class="table table-hover display tabel-data">
					<thead>
		        <tr>
							<th>No</th>
		          <th>No Reg</th>
		          <th>Nama</th>
		          <th>No RM</th>
		          <th>J-Kelamin</th>
		          <th>Alamat</th>
		          <th>TTL</th>
		          <th>No HP</th>
		          <th>Tgl Periksa</th>
		          <th>Opsi</th>
				 		</tr>
				  </thead>
				  <tbody>
						<?php
						$no = 1; 
						$query_tampil = "SELECT * FROM tbl_daftarpasien  ORDER BY tgl_daftar DESC"  ;
						$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
						while($data = mysqli_fetch_array($sql_tampil)) {
					 	?>
				 		<tr>
						 	<td><?php echo $no++."."; ?></td>
				 			<td><?php echo $data['no_daftar']; ?></td>
				 			<td width="10%"><?php echo $data['nama_pas']; ?></td>
				 			<td><?php echo $data['nomor_rm']; ?></td>
				 			<td><?php echo $data['jk_pas']; ?></td>
				 			<td width="10%"><?php echo $data['alm_pas']; ?></td>
				 			<td><?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?></td>
				 			<td><?php echo $data['no_hp']; ?></td>
				 			<td width="12%"><?php echo date('d-m-Y H:i:s',strtotime($data['tgl_periksa'])); ?> WIB</td>
				 			<td width="12%" class="td-opsi">
		              <button class="btn-transition btn btn-outline-primary btn-sm" title="Rekam Medis" id="tombol_rekammedis" name="tombol_rekammedis" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-plus-circle"></i> Riwayat</button>
		              <button class="btn-transition btn btn-outline-danger btn-sm" title="Rekam Medis" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>"><i class="fas fa-trash"></i> Hapus</button>
		            </td>
		          <?php } ?>
				 		</tr>				 
				   </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-primary">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h4 class="modal-title">Export Periode Tanggal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">              
				<form  action="laporan/laporan_medis.php" target="_blank"  method="post">
 					<div class="col-md-8">
            <div class="form-group">
              <label>Tanggal Awal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal Akhir</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    <input type="date" name="tgl1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  	<div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  	</div>
                    	<input type="date" name="tgl2" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>                  
               		</div>
              </div>
            	<label for="asuransi_pas" class=""> Cara Bayar</label>
              <div class="input-group">
                <div class="input-group input-group-sm">
									<select name="asuransi" class="form-control form-control-sm">
	          				<option value="0">Pilih Cara Bayar</option>
	          				<option value="BPJS Kesehatan">BPJS Kesehatan</option>
	          				<option value="Pribadi">Pribadi</option>
										<option value="Laziznu">Lazisnu</option>
	       					</select>
                </div>
      				</div>
      				<br>
        			<input type="submit" name="proses" value="proses" class="btn btn-danger">
            </div>
          	<!-- /.modal-content -->
        	</div>
        	<!-- /.modal-dialog -->
				</form>
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

	$("button[name='tombol_rekammedis']").click(function() {
		var id = $(this).data('id');
		window.location='?page=rekammedis&id='+id;
	});

	$("button[name='tombol_obatracik']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatracik&id='+id;
	});

		$("button[name='tombol_tindakan']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_tindakanpasien&id='+id;
	});
</script>