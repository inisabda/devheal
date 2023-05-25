<?php
// require 'vendor/autoload.php'; // Assuming GuzzleHTTP is installed via Composer
// use Bridging\Helpers\HelperFunc;


$id_pas = @$_GET['id'];
$poli_pcare = getRequestPcare("pcare/poli/1/100");
if ($poli_pcare != null) {
	$poli_pcare = json_decode($poli_pcare);
} 
$jsonString = '[{ "kdTkp": "10", "nmTkp": "RJTP" }, { "kdTkp": "20", "nmTkp": "RITP" }, { "kdTkp": "50", "nmTkp": "Promotif" }]';
$kdtkp = json_decode($jsonString);

// var_dump($poli_pcare->response->count); die();
?>
<link rel="stylesheet" href="agoi/select2.min.css">
<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-light">
		<li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
		<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien</li>
	</ol>
</nav>


<div class="page-content">
	<div class="row">
		<div class="col-6">
			<h4><i class="fas fa-file"></i> Halaman Pendaftaran Pasien</h4>
		</div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-progress btn-warning"><i class="fas fa-list"></i> List Data Pasien</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengisi data pendaftaran Pasien</h6>
				<?php
				$tgl_daftar = gmdate("Y-m-d", time() + 60 * 60 * 7);
				$hari = substr($tgl_daftar, 8, 2);
				$bulan = substr($tgl_daftar, 5, 2);
				$tahun = substr($tgl_daftar, 0, 4);
				$tgl = $tahun . $bulan . $hari;
				$carikode = mysqli_query($conn, "SELECT MAX(no_daftar) FROM tbl_daftarpasien WHERE tgl_daftar = '$tgl_daftar'") or die(mysql_error());
				$datakode = mysqli_fetch_array($carikode);
				if ($datakode) {
					$nilaikode = substr($datakode[0], 13);
					$kode = (int) $nilaikode;
					$kode = $kode + 1;
					$no_daftar = "REG/" . $tgl . "/" . str_pad($kode, 3, "0", STR_PAD_LEFT);
				} else {
					$no_daftar = "REG/" . $tgl . "/001";
				}
				?>

				<div style="text-align: right;">
					No Daftar : <b><?php echo $no_daftar; ?></b> <br>
					Tanggal : <b><?php echo tgl_indo(gmdate('Y-m-d', time() + 60 * 60 * 7)); ?></b>
				</div>
				<form method="post" id="form_pendaftaran" autocomplete="off">
					<div class="position-relative row form-group">
						<div class="col-sm-3">
							<input name="no_daftar" id="no_daftar" placeholder="nomor daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
							<input name="tgl_daftar" id="tgl_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d", time() + 60 * 60 * 7); ?>">
							<input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7); ?>">
							<input name="id_pas" type="hidden" class="form-control form-control-sm" id="id_pas" value="<?php echo $id_pas; ?>">
						</div>
					</div>
					<?php
					$query_tampil = "SELECT * FROM tbl_pasien WHERE id_pas='$id_pas'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
					?>

					<div class="form-group row">
						<label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
						<div class="col-sm-4">
							<input name="nama_pas" type="text" class="form-control form-control-sm" id="nama_pas" autofocus="" value="<?php echo $data['nama_pas']; ?>" readonly>
							<!--<input type="hidden" class="form-control form-control-sm" id="diagnosa" placeholder="" autofocus="" value="">-->
						</div>
						<label for="nomor_rm" class="col-sm-2 col-form-label">Nomor RM</label>
						<div class="col-sm-4">
							<input name="nomor_rm" type="text" class="form-control form-control-sm" id="nomor_rm" value="<?php echo $data['nomor_rm']; ?>" readonly>
						</div>
					</div>

					<div class="form-group row pt-1">
						<label for="tpt_lahir" class="col-sm-2 col-form-label">Tempat Tgl Lahir</label>
						<div class="col-sm-2">
							<input name="tpt_lahir" type="text" class="form-control form-control-sm" id="tpt_lahir" value="<?php echo $data['tpt_lahir']; ?>" readonly>
						</div>
						<div class="col-sm-2">
							<input name="tgl_lahir" type="text" class="form-control form-control-sm" id="tlahir_pas" value="<?php echo $data['lhr_pas']; ?>" readonly>
						</div>
						<label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
						<div class="col-sm-4">
							<input name="jk_pas" type="text" class="form-control form-control-sm" id="jk_pas" value="<?php echo $data['jk_pas']; ?>" readonly>
						</div>
					</div>

					<div class="form-group row pt-1">
						<label for="nik" class="col-sm-2 col-form-label">NIK</label>
						<div class="col-sm-4">
							<input name="nik" type="text" class="form-control form-control-sm" id="nik" value="<?php echo $data['nik']; ?>" readonly>
						</div>
						<label for="nomor_rm" class="col-sm-2 col-form-label">Nomor HP</label>
						<div class="col-sm-4">
							<input name="no_hp" type="text" class="form-control form-control-sm" id="no_hp" value="<?php echo $data['no_hp']; ?>" readonly>
						</div>
					</div>
					<div class="form-group row pt-1">
						<label for="agama" class="col-sm-2 col-form-label">Agama</label>
						<div class="col-sm-4">
							<select name="agama" id="agama" class="form-control form-control-sm" <?php echo $data['agama']; ?>>
								<option value="">--------- Pilih Agama Pasien --------</option>
								<option value="Islam" <?php if ($data['agama'] == "Islam") {
															echo "selected";
														} ?>>Islam</option>
								<option value="Kristen" <?php if ($data['agama'] == "Kristen") {
															echo "selected";
														} ?>>Kristen</option>
								<option value="Katolik" <?php if ($data['agama'] == "Katolik") {
															echo "selected";
														} ?>>Katolik</option>
								<option value="Hindu" <?php if ($data['agama'] == "Hindu") {
															echo "selected";
														} ?>>Hindu</option>
								<option value="Budha" <?php if ($data['agama'] == "Budha") {
															echo "selected";
														} ?>>Budha</option>
								<option value="Konghuchu" <?php if ($data['agama'] == "Konghuchu") {
																echo "selected";
															} ?>>Konghuchu</option>
							</select>
						</div>
						<label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
						<div class="col-sm-4">
							<select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" <?php echo $data['pekerjaan']; ?>>
								<option value="">----------- Pilih Pekerjaan -----------</option>
								<option value="Belum/Tidak Bekerja" <?php if ($data['pekerjaan'] == "Belum/Tidak Bekerja") {
																		echo "selected";
																	} ?>>Belum/Tidak Bekerja</option>
								<option value="Mengurus Rumah Tangga" <?php if ($data['pekerjaan'] == "Mengurus Rumah Tangga") {
																			echo "selected";
																		} ?>>Mengurus Rumah Tangga</option>
								<option value="Wiraswasta" <?php if ($data['pekerjaan'] == "Wiraswasta") {
																echo "selected";
															} ?>>Wiraswasta</option>
								<option value="Karyawan BUMD" <?php if ($data['pekerjaan'] == "Karyawan BUMD") {
																	echo "selected";
																} ?>>Karyawan BUMD</option>
								<option value="Karyawan BUMN" <?php if ($data['pekerjaan'] == "Karyawan BUMN") {
																	echo "selected";
																} ?>>Karyawan BUMN</option>
								<option value="Karyawan Swasta" <?php if ($data['pekerjaan'] == "Karyawan Swasta") {
																	echo "selected";
																} ?>>Karyawan Swasta</option>
								<option value="Petani/Pekebun" <?php if ($data['pekerjaan'] == "Petani/Pekebun") {
																	echo "selected";
																} ?>>Petani/Pekebun</option>
								<option value="Nelayan" <?php if ($data['pekerjaan'] == "Nelayan") {
															echo "selected";
														} ?>>Nelayan</option>
								<option value="PNS" <?php if ($data['pekerjaan'] == "PNS") {
														echo "selected";
													} ?>>PNS</option>
								<option value="Pensiunan" <?php if ($data['pekerjaan'] == "Pensiunan") {
																echo "selected";
															} ?>>Pensiunan</option>
								<option value="Pelajar/Mahasiswa" <?php if ($data['pekerjaan'] == "Pelajar/Mahasiswa") {
																		echo "selected";
																	} ?>>Pelajar/Mahasiswa</option>
								<option value="TNI" <?php if ($data['pekerjaan'] == "TNI") {
														echo "selected";
													} ?>>TNI</option>
								<option value="POLRI" <?php if ($data['pekerjaan'] == "POLRI") {
															echo "selected";
														} ?>>POLRI</option>
								<option value="Guru" <?php if ($data['pekerjaan'] == "Guru") {
															echo "selected";
														} ?>>Guru</option>
								<option value="Perawat" <?php if ($data['pekerjaan'] == "Perawat") {
															echo "selected";
														} ?>>Perawat</option>
								<option value="Bidan" <?php if ($data['pekerjaan'] == "Bidan") {
															echo "selected";
														} ?>>Bidan</option>
								<option value="Dokter" <?php if ($data['pekerjaan'] == "Dokter") {
															echo "selected";
														} ?>>Dokter</option>
								<option value="Nakes Lain" <?php if ($data['pekerjaan'] == "Nakes Lain") {
																echo "selected";
															} ?>>Nakes Lain</option>
							</select>
						</div>
					</div>

					<div class="form-group row pt-1">
						<label for="alm_pas" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="Masukkan alamat pasien" style="font-size: 14px;"><?php echo $data['alm_pas']; ?></textarea>
						</div>
					</div>
					<div class="form-group row pt-1">
						<label for="asuransi_pas" class="col-sm-2 col-form-label">Cara Bayar Pasien</label>
						<div class="col-sm-4">
							<select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm">
								<?php
								//query menampilkan cara bayar ke dalam combobox
								$query    = mysqli_query($conn, "SELECT * FROM cara_bayar");
								while ($dataku = mysqli_fetch_array($query)) {
								?>
									<option value="<?= $dataku['cara_bayar']; ?>"><?php echo $dataku['cara_bayar']; ?></option>
								<?php } ?>
							</select>
						</div>
						<label for="nm_dokter" class="col-sm-2 col-form-label">Dokter</label>
						<div class="col-sm-4">
							<select name="nm_dokter" id="nm_dokter" class="form-control form-control-sm bg-warning">
								<?php
								//query menampilkan nama unit kerja ke dalam combobox
								$query    = mysqli_query($conn, "SELECT * FROM dokter");
								while ($dataku = mysqli_fetch_array($query)) {
								?>
									<option value="<?= $dataku['nm_dokter']; ?>"><?php echo $dataku['nm_dokter']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group row pt-1">
						<label for="cara_masuk" class="col-sm-2 col-form-label">Cara Masuk</label>
						<div class="col-sm-4">
							<select name="cara_masuk" id="cara_masuk" class="form-control form-control-sm">
								<option value="Datang Sendiri">Datang Sendiri</option>
								<option value="Faskes Lain">Kiriman Faskes Lain</option>
							</select>
						</div>
						<label for="status_rawat" class="col-sm-2 col-form-label">Status Rawat</label>
						<div class="col-sm-4">
							<input name="status_rawat" type="text" id="status_rawat" class="form-control form-control-sm" value="Belum diperiksa" disabled>
						</div>
					</div>
					<div class="form-group row pt-1">
						<label for="status_masuk" class="col-sm-2 col-form-label">Aksi Admin</label>
						<div class="col-sm-4">
							<select name="status_masuk" id="status_masuk" class="form-control form-control-sm">
								<option value="daftar">Proses Pendaftaran</option>
								<option value="rawat">Proses Perawatan Pasien</option>
							</select>
						</div>
						<label for="status_bayar" class="col-sm-2 col-form-label">Status Pembayaran</label>
						<div class="col-sm-4">
							<input type="text" name="status_bayar" id="status_bayar" class="form-control form-control-sm" value="Belum Bayar" disabled>
						</div>
						<div class="col-sm-4">
							<input name="status_obat" type="hidden" id="status_obat" class="form-control form-control-sm" value="Belum dilayani" readonly>
						</div>
					</div>

					<div class="form-group row pt-1">
						<label for="alergi" class="col-sm-2 col-form-label">Alergi Obat</label>
						<div class="col-sm-4">
							<textarea style="font-size: 14px;" name="alergi" id="alergi" rows="2" class="form-control" placeholder="Masukkan alergi (Jika pasien terdapat alergi) kosongkan bila tidak ada"><?php echo $data['alergi']; ?></textarea>
						</div>
						<div class="col-sm-6 d-flex">
							<?php
							require_once "nomor-antrian/koneksi.php";
							// ambil tanggal sekarang
							$tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);
							// sql statement untuk menampilkan data dari tabel "tbl_antrian" berdasarkan "tanggal"
							$query = mysqli_query($mysqli, "SELECT max(no_antrian) as nomor_terakhir FROM tbl_antrian WHERE tanggal='$tanggal'")
								or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
							// ambil data hasil query
							$data = mysqli_fetch_assoc($query);
							// buat variabel untuk menampilkan data
							$no_antrian = $data['nomor_terakhir'] + 1;
							?>
							<div class="col-sm-3">
								<input name="nomor_antri" type="text" class="form-control form-control-sm" id="number_antrian" autofocus="" style="font-size:28px ; color: red; text-align: center" value="<?php echo number_format($no_antrian, 0, '', '.'); ?>">
							</div>
							<label id="btn_simpandaftar" class="btn btn-success col-sm-3 form-label"> Daftar</label>
						</div>
					</div>

					<!--<div class="form-group row">
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Kelurahan/Desa</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="desa" id="desa" value="<?php echo $data['desa'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="kec" id="kec" value="<?php echo $data['kec'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="kab_kota" id="kab_kota" value="<?php echo $data['kab_kota'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="provinsi" id="provinsi" value="<?php echo $data['provinsi'] ?>">
					</div> 
				  </div>-->

					<div class="form-group row pt-1">
						<label for="no_asuransi" class="col-sm-2 col-form-label">No. Peserta BPJS</label>
						<div class="col-sm-3">
							<input type="text" name="no_asuransi" id="no_asuransi" class="form-control">
						</div>
						<div class="col-sm-1">
							<button data-toggle="modal" data-target="#cariNokaByKtp" id="cari_noka_by_ktp" type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
						</div>
					</div>

					<div class="form-group row">
						<label for="kd_poli" class="col-sm-2 col-form-label">Poli</label>
						<div class="col-sm-4">
							<select name="kd_poli" id="kd_poli" class="form-control select2">
								<option value="">-- Pilih Poli --</option>
								<?php
								if ($poli_pcare->metaData->code == 200) {
									for ($i = 0; $i < $poli_pcare->response->count; $i++) {
										echo "<option value='" . $poli_pcare->response->list[$i]->kdPoli . "' >" . $poli_pcare->response->list[$i]->nmPoli . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
						<div class="col-sm-4">
							<input type="text" class="form-control form-control-sm" name="keluhan" id="keluhan" placeholder="Keluhan Pasien">
						</div>
					</div>
					<div class="form-group row">
						<label for="kd_provider_peserta" class="col-sm-2 col-form-label">Kode Provider</label>
						<div class="col-sm-4">
							<input type="text"  class="form-control form-control-sm" name="kd_provider_peserta" id="kd_provider_peserta" placeholder="Kd Provider">
						</div>
					</div>
					<div class="form-group row">
						<label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
						<div class="col-sm-4">
							<input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="Masukkan BB">
						</div>
					</div>
					<div class="form-group row">
						<label for="temp" class="col-sm-2 col-form-label">Temperatur</label>
						<div class="col-sm-4">
							<input type="text" class="form-control form-control-sm" name="temp" id="temp" placeholder="suhu tubuh">
						</div>
					</div>
					<div class="form-group row">
						<label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
						<div class="col-sm-4">
							<input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan TB">
						</div>
					</div>
					<div class="form-group row">
						<label for="tekanan_darah_sistole" class="col-sm-2 col-form-label">Tekanan Darah</label>
						<div class="col-sm-2">
							<input type="text" class="form-control form-control-sm" name="tekanan_darah_sistole" id="tekanan_darah_sistole" placeholder="Sistole">
						</div>
						<div class="col-sm-2">
							<input type="text" class="form-control form-control-sm" name="tekanan_darah_diastole" id="tekanan_darah_diastole" placeholder="Diastole">
						</div>
					</div>
					<div class="form-group row">
						<label for="frekwensi_nafas" class="col-sm-2 col-form-label">Frekwensi Nafas</label>
						<div class="col-sm-4">
							<input type="text" class="form-control form-control-sm" name="frekwensi_nafas" id="frekwensi_nafas" placeholder="Masukkan Frekwensi Nafas">
						</div>
					</div>
					<div class="form-group row">
						<label for="lingkar_perut" class="col-sm-2 col-form-label">Lingkar Perut</label>
						<div class="col-sm-4">
							<input type="text" class="form-control form-control-sm" name="lingkar_perut" id="lingkar_perut" placeholder="Masukkan Lingkar Perut">
						</div>
					</div>
					<div class="form-group row">
						<label for="heart_rate" class="col-sm-2 col-form-label">Heart Rate</label>
						<div class="col-sm-4">
							<input type="text" class="form-control form-control-sm" name="heart_rate" id="heart_rate" placeholder="Masukkan Heart Rate">
						</div>
					</div>

					<div class="form-group row">
						<label for="kd_tkp" class="col-sm-2 col-form-label">TKP</label>
						<div class="col-sm-4">
							<select name="kd_tkp" id="kd_tkp" class="form-control select2">
								<option value="">-- Pilih TKP --</option>
								<?php
								for ($i = 0; $i < count($kdtkp); $i++) {
									echo "<option value='" . $kdtkp[$i]->kdTkp . "' >" . $kdtkp[$i]->nmTkp . "</option>";
								}

								?>
							</select>
						</div>
					</div>
					<input type="hidden" name="rujuk_balik" value="0">
					<input type="hidden" name="kunj_sakit" value="true">
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="cariNokaByKtp" tabindex="-1" aria-labelledby="cariNokaByKtpLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cariNokaByKtpLabel">Cari Pasien By KTP</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row pt-1">
					<label for="cari_noka" class="col-sm-2 col-form-label">No. Peserta BPJS</label>
					<div class="col-sm-6">
						<input type="text" id="cari_noka" class="form-control">
					</div>
					<div class="col-sm-2">
						<button id="btn_cari_noka"  type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
			</div> -->
		</div>
	</div>
</div>

<script src="agoi/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	$(document).ready(function() {
		// tampilkan jumlah antrian
		$('#kd_poli').select2();
		$('#cari_noka').val($('#nik').val())

		$('#btn_cari_noka').on('click', function(){
			axios.get('ajax/bridging_peserta.php?nik='+$('#cari_noka').val()).then(res => {
				if(res.status == 200){
					console.log(res.data)
					$('#kd_provider_peserta').val(res.data.response.kdProviderPst.kdProvider)
					$('#no_asuransi').val(res.data.response.noKartu)
					$('#cariNokaByKtp').modal('hide')
				}
			}).catch(error => {
				console.log(error)
			})
		})

		// $('#cari_noka_by_ktp').click(function (){ 
		// })
		$('#antrian').load('nomor-antrian/get_antrian.php');
		// proses insert data
		// $('#btn_simpandaftar').on('click', function() {
		//   $.ajax({
		//     type: 'POST',                     // mengirim data dengan method POST
		//     url: 'nomor-antrian/insert.php',  // url file proses insert data
		//     success: function(result) {       // ketika proses insert data selesai
		//       // jika berhasil
		//       if (result === 'Sukses') {
		//         // tampilkan jumlah antrian
		//         $('#antrian').load('nomor-antrian/get_antrian.php').fadeIn('slow');
		//       }
		//     },
		//   });
		// });
	});

	$("#btn_simpandaftar").click(function() {
		var id_daftar = $("#id_daftar").val();
		var id_pas = $("#id_pas").val();
		var no_daftar = $("#no_daftar").val();
		var tgl_daftar = $("#tgl_daftar").val();
		var tgl_periksa = $("#tgl_periksa").val();
		var nama_pas = $("#nama_pas").val();
		var nik = $("#nik").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var tpt_lahir = $("#tpt_lahir").val();
		var alergi = $("#alergi").val();
		var agama = $("#agama").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var pekerjaan = $("#pekerjaan").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var desa = $("#desa").val();
		//var kec = $("#kec").val();
		//var kab_kota = $("#kab_kota").val();
		//var provinsi = $("#provinsi").val();

		var nomor_rm = $("#nomor_rm").val();
		var status_masuk = $("#status_masuk").val();
		var nomor_antri = $("#number_antrian").val();
		var nm_dokter = $("#nm_dokter").val();
		var tinggi_badan = $("#tinggi_badan").val();
		var berat_badan = $("#berat_badan").val();
		var temp = $("#temp").val();
		var keluhan = $("#keluhan").val();
		var cara_masuk = $("#cara_masuk").val();
		var jk = $("#jk_pas").val();
		var status_rawat = $("#status_rawat").val();
		var status_bayar = $("#status_bayar").val();
		var status_obat = $("#status_obat").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if (nama_pas == "") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
				'Data Belum Lengkap',
				'maaf, tolong isi nama pasien',
				'warning'
			)
		} else if (asuransi_pas == "") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
				'Data Belum Lengkap',
				'maaf, tolong isi jenis pembiayaan pasien',
				'warning'
			)
		} else if (pekerjaan == "") {
			document.getElementById("pekerjaan").focus();
			Swal.fire(
				'Data Belum Lengkap',
				'maaf, tolong isi pekerjaan pasien',
				'warning'
			)

		} else if (nomor_rm == "") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
				'Data Belum Lengkap',
				'maaf, tolong isi nomor RM',
				'warning'
			)
		} else if (alm_pas == "") {
			document.getElementById("alm_pas").focus();
			Swal.fire(
				'Data Belum Lengkap',
				'maaf, tolong isi alamat Pasien',
				'warning'
			)
		} else {
			Swal.fire({
				title: 'Apakah Anda Yakin?',
				text: 'Akan mendaftarkan pasien ini ?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((ya) => {
				if (ya.value) {
					// $.ajax({
					//   type: "POST",                     // mengirim data dengan method POST
					//   url: "nomor-antrian/insert.php",	// url file proses insert data
					//   data: "nama_pas="+nama_pas,  
					//   success: function(result) {       // ketika proses insert data selesai
					//     // jika berhasil
					//     if (result === 'Sukses') {
					//       // tampilkan jumlah antrian
					//       $('#antrian').load('nomor-antrian/get_antrian.php').fadeIn('slow');
					//     }
					//   },
					// });
					$.ajax({
						type: "POST",
						url: "ajax/daftar_pasien.php",
						data: $('#form_pendaftaran').serialize(),
						// data: "no_daftar=" + no_daftar + 
						// "&tgl_daftar=" + tgl_daftar + 
						// "&tgl_periksa=" + tgl_periksa +
						// "&nama_pas=" + nama_pas +
						// "&nik=" + nik + 
						// "&jk=" + jk +
						// "&tpt_lahir=" + tpt_lahir +
						// "&tgl_lahir=" + tgl_lahir +
						// "&asuransi_pas=" + asuransi_pas + 
						// "&pekerjaan=" + pekerjaan + 
						// "&alergi=" + alergi + 
						// "&no_hp=" + no_hp + 
						// "&alm_pas=" + alm_pas + 
						// "&nomor_rm=" + nomor_rm + 
						// "&nm_dokter=" + nm_dokter + 
						// "&nomor_antri=" + nomor_antri + 
						// "&status_masuk=" + status_masuk + 
						// "&cara_masuk=" + cara_masuk + 
						// "&status_rawat=" + status_rawat + 
						// "&status_bayar=" + status_bayar + 
						// "&status_obat=" + status_obat + 
						// "&agama=" + agama + 
						// "&id_pas=" + id_pas,
						success: function(hasil) {
							let hasil_parse = JSON.parse(hasil);
							console.log(hasil_parse);
							if (hasil_parse?.status == "berhasil") {
								Swal.fire({
									title: 'Berhasil',
									text: 'Pasien Berhasil Didaftarkan',
									type: 'success',
									confirmButtonColor: '#3085d6',
									//timer: 1500,
									confirmButtonText: 'OK'
								}).then((ok) => {
									if (ok.value) {
										//window.location='?page=datapendaftaran' ;
										window.open("pages_cetak_surat/cetak_antrian.php?no_daftar=" + no_daftar);
									}
									location.reload()
									window.location = '?page=pendaftaran';
								})
							} else if (hasil_parse?.status == "gagal") {
								Swal.fire(
									'Gagal Simpan!',
									hasil_parse?.res,
									'error'
								)
							}
						}
					})
				}
			})
		}
	});
</script>