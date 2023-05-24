<?php 
	$id_pas = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Daftar Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-info">Daftar Data Pasien</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">

                <?php 
                    $tgl_daftar = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_daftar, 8, 2);
                    $bulan = substr($tgl_daftar, 5, 2);
                    $tahun = substr($tgl_daftar, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_daftar) FROM tbl_daftarpasien WHERE tgl_daftar = '$tgl_daftar'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_daftar = "REG/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
                    } else {
                        $no_daftar = "REG/".$tgl."/001";
                    }
                 ?>

                <div style="text-align: right;">
                    No Daftar : <b><?php echo $no_daftar; ?></b> <br>
                    Tanggal : <b><?php echo tgl_indo(gmdate('Y-m-d', time() + 60 * 60 * 7)); ?></b>
                </div>
                <form method="post" id="form_penjualan" autocomplete="off">
                    <div class="position-relative row form-group">
                    	<!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                        	<input name="no_daftar" id="no_daftar" placeholder="nomor daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tgl_daftar" id="tgl_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate('Y-m-d', time() + 60 * 60 * 7); ?>">
                        </div>
                    </div>

				  <div class="form-group row pt-3">
<!-- 				    <label for="id_pas" class="col-sm-3 col-form-label">No Pasien</label> -->
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="id_pas" placeholder="masukkan nama pasien" value="<?php echo $id_pas; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM tbl_pasien WHERE id_pas='$id_pas'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>

				  <div class="form-group row pt-3">
				    <label for="nomor_rm" class="col-sm-3 col-form-label">Nomor RM</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>">
				    </div>
				  </div>
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="diagnosa" placeholder="masukkan nama pasien" autofocus="" value="">
				    </div>


				  <div class="form-group row pt-3">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Nama Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="asuransi_pas" class="col-sm-3 col-form-label">Asuransi</label>
				    <div class="col-sm-9">
				      <select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm" <?php echo $data['asuransi_pas']; ?>>
				      	<option value="0">pilih Asuransi Pasien</option>
				      	<option value="BPJS Kesehatan" <?php if($data['asuransi_pas'] == "BPJS Kesehatan") {echo "selected";} ?>>BPJS Kesehatan</option>
				      	<option value="Pribadi" <?php if($data['asuransi_pas'] == "Pribadi") {echo "selected";} ?>>Pribadi</option>

				      </select>
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" <?php if($data['jk_pas'] == "Laki-laki") {echo "checked";} ?>> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan" <?php if($data['jk_pas'] == "Perempuan") {echo "checked";} ?>>
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="tlahir_pas" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="tlahir_pas" value="<?php echo $data['lhr_pas'] ?>">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>


				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_hp" placeholder="masukkan nomor hp pasien" autofocus="" value="<?php echo $data['no_hp']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">Keluhan Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="keluhan" placeholder="masukkan Keluhan pasien" autofocus="" value="">
				    </div>
					</div>

				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">Tinggi Badan</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="tinggi_badan" placeholder="masukkan TB pasien" autofocus="" value="<?php echo $data['tinggi_badan']; ?>">
				    </div>
					</div>

				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">Berat Badan</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="berat_badan" placeholder="masukkan BB pasien" autofocus="" value="<?php echo $data['berat_badan']; ?>">
				    </div>
					</div>
				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">Temp.</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="temp" placeholder="masukkan Temp pasien" autofocus="" value="<?php echo $data['temp']; ?>">
				    </div>
					</div>

				  <div class="form-group row">
				    <label for="alm_pas" class="col-sm-3 col-form-label">Alamat Pasien</label>
				    <div class="col-sm-9">
				      <textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="masukkan alamat pasien" style="font-size: 14px;"><?php echo $data['alm_pas']; ?></textarea>
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="status" class="col-sm-3 col-form-label">Proses Pendaftaran</label>
				    <div class="col-sm-9">
				      <select name="status" id="status" class="form-control form-control-sm" >
				      	<option value="daftar">daftar</option>
				      	<option value="rawat" >rawat</option>
				      	<option value="daftar" >daftar</option>

				      </select>
				    </div>
				  </div>



<?php

  require_once "nomor-antrian/koneksi.php";

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // sql statement untuk menampilkan data dari tabel "tbl_antrian" berdasarkan "tanggal"
   $query = mysqli_query($mysqli, "SELECT count(id) as jumlah FROM tbl_antrian 
                                  WHERE tanggal='$tanggal'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil data hasil query
  $data = mysqli_fetch_assoc($query);
  // buat variabel untuk menampilkan data
  // tampilkan data
 $jumlah_antrian = $data['jumlah']+1;


  // tampilkan data

?>

				  <div class="form-group row">
				    <label id="insert"   class="btn btn-success col-sm-3 form-label"> Nomor Antrian</label>
				    <div class="col-sm-9">
 <input  type="number" class="form-control form-control-sm" id="number_antrian" autofocus="" style="font-size:28px ; color: red   " value="<?php echo number_format($jumlah_antrian, 0, '', '.'); ?>" > 

			  <!--     <textarea  type="number" class="form-control form-control-sm" id="antrian"   autofocus=""  value="<?php echo number_format($jumlah_antrian, 0, '', '.'); ?>" ></textarea> -->

				    </div>
				  </div>




				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpandaftar">Daftar Pasien</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- 
    $("#form_daftar").on("submit", function(event){
        event.preventDefault();
        var no_daftar = $("#no_daftar").val();
        var tanggal_daftar = $("#tanggal_daftar").val();

        if(no_daftar=="") {
            document.getElementById("no_daftar").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_daftar==""){
            document.getElementById("tanggal_daftar").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
              'warning'
            )
}; -->
<script>

    $(document).ready(function() {
      // tampilkan jumlah antrian
      $('#antrian').load('nomor-antrian/get_antrian.php');

      // proses insert data
      $('#btn_simpandaftar').on('click', function() {
        $.ajax({
          type: 'POST',                     // mengirim data dengan method POST
          url: 'nomor-antrian/insert.php',                // url file proses insert data
          success: function(result) {       // ketika proses insert data selesai
            // jika berhasil
            if (result === 'Sukses') {
              // tampilkan jumlah antrian
              $('#antrian').load('nomor-antrian/get_antrian.php').fadeIn('slow');
            }
          },
        });
      });
    });

	$("#btn_simpandaftar").click(function() {
var id_daftar = $("#id_daftar").val();
var id_pas = $("#id_pas").val();
		var no_daftar = $("#no_daftar").val();
	var tgl_daftar = $("#tgl_daftar").val();
		var nama_pas = $("#nama_pas").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var nomor_rm = $("#nomor_rm").val();
				var diagnosa = $("#diagnosa").val();
		var status = $("#status").val();
		var nomor_antri = $("#number_antrian").val();
		var tinggi_badan = $("#tinggi_badan").val();
		var berat_badan = $("#berat_badan").val();
		var temp = $("#temp").val();
		var keluhan = $("#keluhan").val();
		var jk = document.querySelector('input[name="jk_pas"]:checked').value;



		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pasien',
			  'warning'
			)
		} else if (asuransi_pas=="") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama petugas pasien',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas Pasien',
			  'warning'
			)

		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor RM',
			  'warning'
			)
		} else if (alm_pas=="") {
			document.getElementById("alm_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat Pasien',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan Mendaftarkan data Pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/daftar_pasien.php",
	              data: "no_daftar="+no_daftar+"&tgl_daftar="+tgl_daftar+"&nama_pas="+nama_pas+"&jk="+jk+"&tgl_lahir="+tgl_lahir+"&asuransi_pas="+asuransi_pas+"&no_hp="+no_hp+"&alm_pas="+alm_pas+"&nomor_rm="+nomor_rm+"&keluhan="+keluhan+"&diagnosa="+diagnosa+"&tinggi_badan="+tinggi_badan+"&berat_badan="+berat_badan+"&temp="+temp+"&nomor_antri="+nomor_antri+"&status="+status+"&id_pas="+id_pas,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Didaftarkan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=datapendaftaran' ;
				          }
				        })
					}else if(hasil=="gagal") {
						Swal.fire(
						  'Gagal',
						  'Data Gagal Diubah',
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