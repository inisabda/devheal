<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4><i class="fas fa-plus-circle"></i> Form Tambah Data Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-warning"><i class="fas fa-list"></i> List Data Pasien</button>
			</a>
		</div>
	</div>
	<?php
		$carikode = mysqli_query($conn, "SELECT MAX(nomor_rm) as kodeTerbesar FROM tbl_pasien ") ;
		$datakode = mysqli_fetch_array($carikode);
		$nomor_rm = $datakode['kodeTerbesar'];
		$urutan = (int) substr($nomor_rm, 0, 6);
		$urutan =$urutan+1;
		$huruf = "";
		$nomor_rm = $huruf . sprintf("%06s", $urutan);
	?>
	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i>Lengkapi form ini untuk menambah data pasien baru</h6>
				<form method="POST" id="simpan_pasien" autocomplete="on">
					<div class="form-group row pt-3">
						<label for="nama_pas" class="col-sm-3 col-form-label">Nama Pasien</label>
						<div class="col-sm-6">
							<input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="Masukkan Nama Pasien (Tanpa tanda baca *'@$%)" autofocus="">
				    	</div>
				    	<div class="col-sm-3">				    		
							<button type="button" data-toggle="modal" data-target="#modal_pasien_asuransi" id="cari_pasien_asuransi" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari Pasien Asuransi</button>
				    	</div>
					</div>
					<div class="form-group row pt-1">
						<label for="nik" class="col-sm-3 col-form-label">NIK (Nomor KTP)</label>
					    <div class="col-sm-4">
					      <input type="number" class="form-control form-control-sm count-chars" name="nik" id="nik" maxlength="16" data-max-chars="16" placeholder="Masukkan NIK 16 Digit">
					      <div style="font-size:12px; color:red; font-style:italic;" class="input-msg"></div>
					    </div>
					    <label for="nomor_rm" class="col-sm-2 col-form-label">Nomor RM</label>
					    <div class="col-sm-3">
					      <input type="text" class="form-control form-control-sm" id="nomor_rm" value="<?php echo $nomor_rm; ?>" placeholder="Masukkan Nomor RM" >
					    </div>
					</div>
					<div class="form-group row pt-1">
					    <label for="tlahir_pas" class="col-sm-3 col-form-label">Tempat Lahir Pasien</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control form-control-sm" id="tpt_lahir" placeholder="Masukkan Tempat Lahir">
					    </div>
					    <label for="tlahir_pas" class="col-sm-2 col-form-label">Tanggal Lahir Pasien</label>
					    <div class="col-sm-3">
					      <input type="date" class="form-control form-control-sm" id="tlahir_pas" placeholder="masukkan tanggal lahir pasien">
					      <small class="form-text text-muted" style="text-align: right;">Tanggal/Bulan/Tahun Lahir</small>
					    </div>
					</div>				
					<div class="form-group row pt-1">
					    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan Pasien</label>
					    <div class="col-sm-4">
					      <select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm">
					      	<option value="">----------- Pilih Pekerjaan -----------</option>
					      	<option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
					      	<option value="Mengurus Rumah Tangga" >Mengurus Rumah Tangga</option>
					      	<option value="Wiraswasta" >Wiraswasta</option>
					      	<option value="Karyawan BUMD" >Karyawan BUMD</option>
					      	<option value="Karyawan BUMN" >Karyawan BUMN</option>
									<option value="Karyawan Swasta" >Karyawan Swasta</option>
									<option value="Petani/Pekebun" >Petani/Pekebun</option>
									<option value="Nelayan" >Nelayan</option>
									<option value="PNS" >PNS</option>
									<option value="Pensiunan" >Pensiunan</option>
									<option value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
									<option value="TNI" >TNI</option>
									<option value="POLRI" >POLRI</option>
									<option value="Guru" >Guru</option>
									<option value="Perawat" >Perawat</option>
									<option value="Bidan" >Bidan</option>
									<option value="Dokter" >Dokter</option>
									<option value="Nakes Lain">Nakes Lain</option>
					      </select>
							</div>						
					    <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
					    <div class="col-sm-3">
					      <input type="number" class="form-control form-control-sm" value ="" id="no_hp" placeholder="Nomor HP Pasien" autofocus="">
					    </div>						
					</div>
					<div class="form-group row pt-1">
						<label for="agama" class="col-sm-3 col-form-label">Agama</label>
					    <div class="col-sm-4">
					      <select name="agama" id="agama" class="form-control form-control-sm">
					      	<option value="">--------- Pilih Agama Pasien --------</option>
					      	<option value="Islam">Islam</option>
					      	<option value="Kristen">Kristen</option>
					      	<option value="Katolik">Katolik</option>
					      	<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
							<option value="Konghuchu">Konghuchu</option>
					      </select>
					    </div>
					</div>
					<div class="form-group row pt-1">
					    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
					    <div class="col-sm-4">
						    <div class="form-check">
						    	<label class="form-check-label" style="font-weight: normal;">
						      	<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" checked="">
						      		Laki-laki
						      	</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						      	<label class="form-check-label" style="font-weight: normal;">
		                    	<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan">
		                    		Perempuan
		                    	</label>
						    </div>	                    
						</div>
					</div>
					
					<div class="form-group row pt-1">
						<label for="alm_pas" class="col-sm-3 col-form-label">Alamat Pasien</label>
					    <div class="col-sm-9">
					      <textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="Masukkan Alamat Pasien" style="font-size: 14px;"></textarea>
					    </div>
					</div>
					<div class="form-group row pt-1">
						<label for="alergi" class="col-sm-3 col-form-label">Alergi Obat</label>
					    <div class="col-sm-9">
					      <textarea name="alergi" id="alergi" rows="2" class="form-control" placeholder="Masukkan alergi (Jika pasien terdapat alergi) kosongkan bila tidak ada" style="font-size: 14px;"></textarea>
					    </div>
					</div>
					<!-- <div class="form-group row">
				    <label for="desa" class="col-sm-3 col-form-label">Desa / Kelurahan</label>
				    <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" id="desa" name="desa">
                <input type="hidden" class="form-control form-control-sm" id="kode_id" name="kode_id">
            		<div class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datawilayah" id="lihat_data_pasien"><i class="fas fa-search"></i></button>
                </div>
              </div>
          	</div>
          </div>
					<div class="form-group row">
				    <label for="kec" class="col-sm-3 col-form-label">Kecamatan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kec" placeholder="Kecamatan" disabled>
				    </div>
					</div>
					<div class="form-group row">
				    <label for="kab_kota" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kab_kota" placeholder="Kabupaten" disabled>
				    </div>
					</div>
					<div class="form-group row">
				    <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
				    <div class="col-sm-4">
			      		<input type="text" class="form-control form-control-sm" id="provinsi" placeholder="Provinsi" disabled>
			      </div>
		      	<label for="provinsi" class="col-sm-2 col-form-label">Kode Pos</label>
				    <div class="col-sm-3">
          		<input type="text" class="form-control form-control-sm" id="poscode" name="poscode" disabled>
				  	</div>
					</div> -->
					
					<div class="form-group row">
						<div class="col-sm-12 text-right">
							<button type="button" class="btn btn-danger btn-sm" id="tombol_reset"><i class="fas fa-redo"></i> Reset</button>
							<button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal cari data pasien Asuransi -->
<div class="modal fade" id="modal_pasien_asuransi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
  	<div class="modal-content">
  		<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-users"></i> Data Pasien Asuransi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  		</div>
  		<div class="modal-body">
    		<table id="tabel_dataobat" class="table table-striped display">
          <thead>
            <tr>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>NIK</th>
              <th>TTL</th>
              <th>JK</th>
              <th>Agama</th>
              <th>Pekerjaan</th>
              <th>Jenis Asuransi</th>
              <th>Opsi</th>
            </tr>
          </thead>
      		<tbody>
            <?php 
            require_once "koneksi.php";
            $query_tampil = "SELECT * FROM tbl_pasien_asuransi ORDER BY nm_pasien ASC";
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                while($data = mysqli_fetch_array($sql_tampil)) {
             ?>
            <tr>
              <td><button class="btn btn-link" style="padding: 4px; font-size: 11px; text-align: left;"  title="Pilih Pasien" id="tombol_pilihpasien" name="tombol_pilihpasien" data-dismiss="modal"
                data-nama="<?php echo $data['nm_pasien']; ?>"
                data-alamat="<?php echo $data['alamat_pas']; ?>"
                data-no_ktp="<?php echo $data['no_ktp']; ?>"
                data-tpt_lahir="<?php echo $data['tempat_lahir']; ?>"
                data-tgl_lahir="<?php echo $data['tanggal_lahir']; ?>"
                data-jk="<?php echo $data['jk_pas']; ?>"
                data-alamat="<?php echo $data['alamat_pas']; ?>"
                data-agama="<?php echo $data['agama']; ?>"
                data-pekerjaan="<?php echo $data['pekerjaan']; ?>"                      
                  ><?php echo $data['nm_pasien']; ?></button></td>
              <td><?php echo $data['alamat_pas']; ?></td>
              <td><?php echo $data['no_ktp']; ?></td>
              <td><?php echo $data['tempat_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['tanggal_lahir'])); ?></td>
              <td><?php echo $data['jk_pas']; ?></td>
              <td><?php echo $data['agama']; ?></td>
              <td><?php echo $data['pekerjaan']; ?></td>
              <td><?php echo $data['asuransi_pas']; ?></td>
              <td class="td-opsi">
                <button class="btn-transition btn btn-outline-dark btn-sm" title="Pilih Obat" id="tombol_pilihpasien" name="tombol_pilihpasien" data-dismiss="modal"
                    data-nama="<?php echo $data['nm_pasien']; ?>"
                    data-alamat="<?php echo $data['alamat_pas']; ?>"
                    data-no_ktp="<?php echo $data['no_ktp']; ?>"
                    data-tpt_lahir="<?php echo $data['tempat_lahir']; ?>"
                    data-tgl_lahir="<?php echo $data['tanggal_lahir']; ?>"
                    data-jk="<?php echo $data['jk_pas']; ?>"
                    data-alamat="<?php echo $data['alamat_pas']; ?>"
                    data-agama="<?php echo $data['agama']; ?>"
                    data-pekerjaan="<?php echo $data['pekerjaan']; ?>"
                > Pilih
                </button>
              </td>
            </tr>
        		<?php } ?>
     			</tbody>
    		</table>
  		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			</div>
  	</div>
	</div>
</div>
<!-- Modal cari wilayah -->
<!-- <div class="modal fade" id="modal_datawilayah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel">Data Wilayah</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
    	</div>
    	<div class="modal-body">
  			<div class="row" style="padding: 0 16px;">
          <div class="col-md-12 vertical-form">
            <div class="row data-pengobatan">
              <div class="position-relative form-group col-md-6">
                <label for="kode_id" class="">Cari Nama Desa, Kecamatan (tekan Enter) </label>
                <div class="input-group input-group-sm">
                	<input type="text" class="form-control form-control-sm" id="search"   >
                </div>
              </div>
            </div>
            <div class="position-relative form-group col-md-12">
              <ul id="result"></ul>
            </div>
          </div>
    		</div>
    	</div>
		</div>
	</div>
</div> -->

<script src="js/count.js"></script>

<script type="text/javascript">
    $(document).ready(function(){         
         function search(){
	         var desa=$("#search").val();
	         var kec=$("#search").val();
	         var kab_kota=$("#search").val();
	         var provinsi=$("#search").val();
	         var poscode=$("#search").val();

          if(desa!=""){
            $("#result").html("<img src='img/ajax-loader.gif'/>");
             $.ajax({
                type:"post",
                url:"ajax/searchwilayah.php",
                data:"desa="+desa+"&kec="+kec+"&kab_kota="+kab_kota+"&provinsi="+provinsi+"&poscode="+poscode,
                success:function(data){
                    $("#result").html(data);
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

	$("button[name='tombol_pilihpasien']").click(function() {
		var nama = $(this).data('nama');
		var nik = $(this).data('no_ktp');
		var alamat_pas = $(this).data('alamat');
		var tpt_lahir = $(this).data('tpt_lahir');
		var tgl_lahir = $(this).data('tgl_lahir');
		var pekerjaan = $(this).data('pekerjaan');
		var agama = $(this).data('agama');
		var jk_pas = $(this).data('jk');
		var alamat_pas = $(this).data('alamat');
		$("#nama_pas").val(nama);
		$("#nik").val(nik);
		$("#alm_pas").val(alamat_pas);
		$("#agama").val(agama);
		$("#pekerjaan").val(pekerjaan);
		$("#tpt_lahir").val(tpt_lahir);
		$("#tlahir_pas").val(tgl_lahir);
		$("#jk_pas").val(jk_pas);
	});
});
</script>
<script>
	function reset_form() {
		$("#nama_pas").val("");
		$("#nik").val("");
		// $("#asuransi_pas").val("");
		$("#no_hp").val("");
		$("#pekerjaan").val("");
		$("#alm_pas").val("");
		$("#tpt_lahir").val("");
		$("#tlahir_pas").val("");
		$("#agama").val("");
	}

	$("#tombol_reset").click(function() {
		reset_form();
		document.getElementById("nama_pas").focus();
	});

	
	$("#simpan_pasien").on("submit", function(event){
    event.preventDefault();
		var nama_pas = $("#nama_pas").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var tpt_lahir = $("#tpt_lahir").val();
		// var asuransi_pas = $("#asuransi_pas").val();
		var pekerjaan = $("#pekerjaan").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var nomor_rm = $("#nomor_rm").val();
		var nik = $("#nik").val();
		var alergi = $("#alergi").val();
		var agama = $("#agama").val();
		//var desa= $("#desa").val();
		//var kec = $("#kec").val();
		//var kab_kota = $("#kab_kota").val();
		//var provinsi = $("#provinsi").val();
		//var poscode = $("#poscode").val();
		var jk = document.querySelector('input[name="jk_pas"]:checked').value;

		// alert(nama_pas+"/"+tpt_lahir+"/"+jk+"/"+tgl_lahir+"/"+alm_pas+"/"+username+"/"+password);

		if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong lengkapi nama pasien',
			  'warning'
			)
		} else if (tgl_lahir=="") {
			document.getElementById("tlahir_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi tanggal lahir Pasien',
			  'warning'
			)
		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong lengkapi nomor RM',
			  'warning'
			)
		} else if (alm_pas=="") {
			document.getElementById("alm_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong lengkapi alamat pasien',
			  'warning'
			)

		} else {			
			Swal.fire({
				// type: 'warning',
                title: 'Proses simpan data !',
                html: 'Mohon tunggu ...',
                allowOutsideClick: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: () => {
                    Swal.showLoading()
                },
            }).then((ok) => {
	          // if (ya.value) {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_pasien.php",
				data: "nama_pas="+nama_pas+"&jk="+jk+"&tpt_lahir="+tpt_lahir+"&tgl_lahir="+tgl_lahir+"&pekerjaan="+pekerjaan+"&alm_pas="+alm_pas+"&nomor_rm="+nomor_rm+"&nik="+nik+"&no_hp="+no_hp+"&alergi="+alergi+"&agama="+agama,
				//+"&no_bpjs="+no_bpjs+"&no_hp="+no_hp+"&desa="+desa+"&kec="+kec+"&kab_kota="+kab_kota+"&provinsi="+provinsi+"&poscode="+poscode,
				success: function(hasil) {
					if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Disimpan',
				          type: 'success',
				          //confirmButtonColor: '#3085d6',
                          //confirmButtonText: 'OK'
                          showConfirmButton: false,
                          timer: 2000
                        }).then((ok) => {                          
                            window.location="?page=daftar_pasien&id="+nomor_rm;                          
                        })
					} else if(hasil=="gagal") {
						Swal.fire(
						  'Gagal',
						  'Data Gagal Disimpan',
						  'error'
						)
					}
	              }
	            })  
	          // }
	        })	        
		}
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var maxChars = $("#nik");
		var max_length = maxChars.attr('maxlength');
		if (max_length > 0) {
		    maxChars.bind('keyup', function(e){
		        length = new Number(maxChars.val().length);
		        counter = max_length-length;
		        $("#sessionNum_counter").text(counter);
		    });
		}
	});
	
</script>
