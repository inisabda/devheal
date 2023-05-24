<?php 
$no_daftar = @$_GET['id'];
?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-light">
		<li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-history"></i> Data Riwayat Periksa Pasien</li>
	</ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4><font color="red"><i class="fas fa-history"></i> Data Riwayat Pemeriksaan Pasien</font></h4>
		</div>		
		<div class="col-6 text-right">
			<button class="btn btn-sm btn-info" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
			<a href="pages_cetak_surat/cetak_riwayatperiksa.php?no_daftar=<?php echo $no_daftar; ?>" target="_blank" ><button class="btn btn-sm btn-warning" id="tombol_cetak" name="tombol_cetak">Export PDF</button></a>
			<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-primary">Export excel</button>
		</div>
	</div>
	<div class="row" style="padding: 0 10px;">
        <div class="col-md-12 vertical-form table-responsive">
			<div class="table-container">
				<table id="example" class="table table-striped display tabel-data">
					<thead>
						<tr>
							<th>No.</th>
							<th>No. Registrasi</th>
							<th>No. RM</th>
							<th>Tgl Daftar</th>
							<th>Tanggal Periksa</th>
							<th>Nama Pasien</th>
							<th>Tempat & Tgl. lahir</th>
							<th>Alamat</th>        
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$id_pas = @$_GET['id'];
							//$jam_ini = date("H:i:s");
							$query_tampil = "SELECT * FROM tbl_daftarpasien WHERE id_pas='$id_pas' ORDER BY tgl_daftar DESC"  ;
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_assoc($sql_tampil)) {
						?>
						<tr>
							<td><?php echo $no++."."; ?></td>
							<td><?php echo $data['no_daftar']; ?></td>
							<td><?php echo $data['nomor_rm']; ?></td>
							<td><?php echo date('d-m-Y',strtotime($data['tgl_daftar'])); ?></td>
							<td><?php echo date('d-m-Y h:i:s', strtotime($data['tgl_periksa'])); ?> WIB</td>
							<td><?php echo $data['nama_pas']; ?></td>
							<td><?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?></td>
							<td><?php echo $data['alm_pas']; ?></td>	 			
							<td class="td-opsi">
								<button class="btn-transition btn btn-outline-info btn-sm" title="Rekam Medis" id="tombol_rekammedis" name="tombol_rekammedis" data-id="<?php echo $data['no_daftar']; ?>">
									<i class="fas fa-plus-circle"></i>Detail Periksa</button>
								</td>          
						</tr>
							<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-primary">
	<div class="modal-dialog">
		<div class="modal-content bg-primary text-white">
			<div class="modal-header">
				<h4 class="modal-title">Export Periode Tanggal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form  action="laporan/laporan_medis.php" target="_blank" method="post">
					<div class="col-md-10">
						<div class="form-group">
							<label>Tanggal Awal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Akhir</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									<input type="date" name="tgl1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>&nbsp;&nbsp;
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									</div>
									<input type="date" name="tgl2" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
								</div>
							</div>
					        <label for="asuransi_pas" class="">Cara Bayar / Insurance </label>
					        <div class="input-group input-group-sm">
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
							<br>
							<input type="submit" name="proses" value="Proses" class="btn btn-danger">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End modal -->
<script>
    function goBack() {
        window.history.back();
    }
</script>
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

	$("button[name='tombol_rekammedis']").click(function() {
		var id = $(this).data('id');
		window.location='?page=rekammedis&id='+id;
	});
</script>