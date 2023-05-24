<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Kasir <?php echo $nama_klinik; ?></h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapenjualan">
				<button class="btn btn-sm btn-info">Data Penjualan Obat</button></a>&nbsp;
			<!-- <a href="?page=laporbiling"><button class="btn btn-sm btn-warning">Laporan Pasien Bulanan</button></a> -->
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 5px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="tabel_datadaftar" class="table table-hover display tabel-data">
					<thead>
						<tr>
							<th>Antrian</th>
							<th>No. Reg/RM</th>
							<th>Nama</th>
							<th>Status Bayar</th>
							<th>Cara Bayar</th>
							<th>Alamat</th>
							<th>No HP</th>
							<th>Tgl Daftar</th>
							<th>Opsi</th>
			        	</tr>
				   	</thead>
				  <tbody>
						<?php 
							$query_tampil = "SELECT * FROM tbl_daftarpasien where tgl_daftar = CURDATE() AND status_masuk='rawat' ORDER BY no_antrian DESC"  ;
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td align="center"><font color="red"><h3>A-<?php echo $data['no_antrian']; ?></h3></font></td>
				 			<td><?php echo $data['no_daftar']; ?><br><b>No. RM : <?php echo $data['nomor_rm']; ?></b></td>
				 			<td><b><?php echo $data['nama_pas']; ?></b><br><?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?></td>
				 			<td><?php
									if($data['status_bayar'] == 'Sudah Bayar'){ ?>
										<span class="badge badge-pill badge-success" style="padding: 8px; font-size: 11px;"><?php echo $data['status_bayar']; ?></span>
									<?php }else if($data['status_bayar'] == 'Belum Bayar'){?>												
										<span class="badge badge-pill badge-warning" style="padding: 8px; font-size: 11px;"><?php echo $data['status_bayar']; ?></span>
									<?php }
									?></td>
				 			<td><?php echo $data['asuransi_pas']; ?></td>
				 			<td><?php echo $data['alm_pas']; ?></td>
				 			<td><?php echo $data['no_hp']; ?></td>
				 			<td><?php echo $data['tgl_periksa']; ?> WIB</td>
				 			<td width="15%" class="td-opsi">
				 				<a href="laporan/nota_billingkecil.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
		                <button class="btn-transition btn btn-outline-primary btn-sm" title="Cetak Nota Kecil" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i> Nota</button></a>
		            <a href="laporan/nota_pembayaran.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
		                <button class="btn-transition btn btn-outline-dark btn-sm" title="Cetak Kwitansi" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i> Kwitansi</button></a>
		                <br>
		                <button class="btn-transition btn btn-outline-danger btn-sm" title=" Proses Bayar" id="tombol_kasir" name="tombol_kasir" data-id="<?php echo $data['no_daftar']; ?>">
		                  <i class="fas fa-money-bill-wave"></i> Bayar</button>
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
			          if (ok.value) {
			            window.location='?page=datapendaftaran';
			          }
			        })
	              }
	            })  
	          }
	        })
	    }
	});

	$("button[name='tombol_kasir']").click(function() {
		var id = $(this).data('id');
		window.location='?page=pembayaran&id='+id;
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