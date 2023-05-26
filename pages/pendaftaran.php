<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-light">
		<li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
	</ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4> Cari Data Pendaftaran Pasien</h4>
		</div>
	</div>
	<div class="form-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive">
				<div class="row data-pengobatan">
					<div class="position-relative form-group col-md-12">
						<label for="no_daftar" class="">Cari Nama, No. RM, NIK, No. HP (Tekan Enter) </label>
						<div class="input-group input-group-sm">
							<div class="col-sm-3">
								<input type="text" class="form-control form-control-sm" id="search" placeholder="Cari data pasien lama">
							</div>
							<a href="?page=tambah_datapasien">
								<button class="btn btn-sm btn-info">Pendaftaran Pasien Baru</button>
							</a>
							&nbsp;&nbsp;
							<a href="?page=datapasien">
								<button class="btn btn-sm btn-warning">Master Data Pasien</button>
							</a>
							&nbsp;&nbsp;
							<a href="?page=data_pasien_asuransi">
								<button class="btn btn-sm btn-success">Master Data Pasien Asuransi</button>
							</a>
						</div>
					</div>
				</div>
				<div class="position-relative form-group col-md-12">
					<ul id="result"></ul>    
				</div>
				<div class="table-container">
					<table id="tabel_datadaftar" class="table table-striped display tabel-data">
						<thead>
							<tr>
								<th>Antrian</th>
								<th>No Urut PCare</th>
								<th>No Reg</th>
								<th>Nama</th>
								<th>No.RM</th>
								<th>J. Kel</th>
								<th>Alamat</th>
								<th>Tgl Lahir</th>
								<th>Dokter</th>
								<th>Tgl Daftar</th>								
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$query_tampil = "SELECT tbl_daftarpasien.*,pendaftaran_pcare.no_urut, tbl_daftarpasien.no_daftar, tbl_antrian.id FROM tbl_daftarpasien
						    LEFT JOIN tbl_antrian ON tbl_daftarpasien.no_daftar=tbl_antrian.no_daftar
						    INNER JOIN pendaftaran_pcare ON tbl_daftarpasien.no_daftar=pendaftaran_pcare.no_daftar
						     WHERE tbl_daftarpasien.tgl_daftar = CURDATE() AND status_masuk='daftar' ORDER BY no_antrian DESC";					
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
								?>
							<tr>
								<td width="23"><a style ="font-size:18px; color:red; font-weight: bold;">A-<?php echo $data['no_antrian']; ?></a></td>
								<td width="23"><a style ="font-size:18px; color:red; font-weight: bold;"><?php echo $data['no_urut']; ?></a></td>
								<td><?php echo $data['no_daftar']; ?></td>
								<td width="20%"><?php echo $data['nama_pas']; ?></td>
								<td width="10%"><?php echo $data['nomor_rm']; ?></td>
								<td width="12%"><?php echo $data['jk_pas']; ?></td>
								<td width="20%"><?php echo $data['alm_pas']; ?></td>
								<td width="12%"><?php echo date('d-m-Y', strtotime($data['lhr_pas'])); ?></td>
								<td width="10%"><?php echo $data['nm_dokter']; ?></td>
								<td width="13%"><?php echo date('d-m-Y H:i:s', strtotime($data['tgl_periksa'])); ?> Wib</td>	
								<td width="10%" class="td-opsi">
									<button class="btn-transition btn btn-outline-success btn-sm" id="tombol_rawat" name="tombol_rawat" data-no_daftar="<?php echo $data['no_daftar']; ?>" data-nama_pas="<?php echo $data['nama_pas']; ?>" data-toggle="tooltip" data-placement="top" title="Lanjutkan ke proses pemeriksaan" ><i class="fas fa-check-square"></i></button>
									<a href="pages_cetak_surat/cetak_antrian.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank"><button class="btn-transition btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak nomor antrian" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i></button></a>
									<a href="pages_cetak_surat/cetak_lembarperiksa.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank"><button class="btn-transition btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cetak Lembar Rawat Jalan" id="tombol_cetak" name="tombol_cetak"><i class="fas fa-print"></i></button></a>
									<button class="btn-transition btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus data pendaftaran" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?> " data-nomor="<?php echo $data['id']; ?>"><i class="fas fa-trash"></i></button>
								</td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		var nomor = $(this).data('nomor');
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
		              url: "ajax/hapus.php?page=antrian",
		              data: "id="+nomor,
		            });
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
									window.location='?page=pendaftaran';
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
		window.location='?page=form_editdatapasien&id='+id;
	});

	$("button[name='tombol_rawat']").click(function() {
		var no_daftar = $(this).data("no_daftar");
		var nama_pas = $(this).data("nama_pas");
		
		Swal.fire({
			type: 'warning',
			title: 'Lanjut proses perawatan?',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonColor: '#28A745',
			cancelButtonText: 'Tidak',
			confirmButtonText: 'Lanjutkan'
		}).then((ok) => {
			if (ok.value) {
				$.ajax({
					type: "POST",
					url: "ajax/detail.php?page=rawat",
					data: "no_daftar="+no_daftar,
					success: function(hasil) {
						Swal.fire({
							title: 'Berhasil',
							text: 'Pasien telah dirawat',
							type: 'success',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK'
						}).then((ok) => {
							if (ok.value) {
								window.location='?page=pendaftaran';
							}
						})
					}
				})  
			}
		})
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){

		function search(){
			var nama_pas=$("#search").val();
			var nomor_rm=$("#search").val();
			var no_hp=$("#search").val();
			var nik=$("#search").val();

			if(nama_pas!=""){
				$("#result").html("<div align='center'><button class='btn btn-warning btn-sm' disabled><span class='spinner-border spinner-border-sm'></span> Loading...</button></div>");
				$.ajax({
					type:"post",
					url:"ajax/search.php",
					data:"nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&no_hp="+no_hp+"&nik="+nik,
					success:function(data){
					setTimeout(function(){ 
						$("#result").html(data);
					}, 1000);
						$("#search").val("");
					}
				});
			}
		}

		$("#button").click(function(){
			search();
		});

		$('#search').keyup(function(e) {
			if(e.keyCode == 13) {
				search();
			}
		});
	});
</script>
