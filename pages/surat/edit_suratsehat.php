<?php 
    $no_surat = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Edit Surat Keterangan Sehat</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Edit Surat Keterangan Sehat</h4></div>
        <div class="col-6 text-right">
            <a href="?page=suratsehat">
                <button class="btn-transition btn btn-outline-success btn-xl">Data dan Riwayat SUKET Sehat</button>
            </a>
        </div>
    </div>

<div class="form-container">
		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit surat keterangan sehat</h6>
				<div class="row" style="padding: 0 s0px;">
		            <div class="col-md-12 mt-2 vertical-form">
		            	<form method="post" id="edit_sehat" autocomplete="on">
							<?php								
								$no_surat = @$_GET['id'];
								$query_tampil = "SELECT * FROM tbl_suratsehat WHERE no_surat='$no_surat'";								
								$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
								$data = mysqli_fetch_array($sql_tampil);
								$nm_dokter = $data['nm_dokter'];
								$keperluan = $data['keperluan'];								
							 ?>
					        <div style="text-align: right;">
					        	No surat : <b><?php echo $data['no_surat']; ?></b>	Tanggal : <b><?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?></b>
					        </div>
							<div class="form-group row pt-3">							    
							    <div class="col-sm-4">
							      <input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo $data['tgl_periksa']; ?>">
							      <input name="no_surat" id="no_surat" type="hidden" class="form-control form-control-sm" value="<?php echo $data['no_surat']; ?>">
							      <input name="no_daftar" id="no_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $data['no_daftar']; ?>">
							    </div>
						  	</div>

						  	<div align="center">
						  		<h4><?php echo $nama_klinik; ?></h4>
			                    <?php echo $alamat_klinik; ?> - <?php echo $kab; ?>
			                    <br> 
			                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?> </span>						  		
						  	</div>
							<hr>
							<div align="center">
								<h5><u>SURAT KETERANGAN SEHAT</u></h5>
								<b><p><?php echo $data['no_surat']; ?></p></b>
							</div>
								
							<div align="left">
								Yang bertanda tangan di bawah ini selaku dokter yang memeriksa di <?php echo $nama_klinik; ?> menerangkan bahwa :
							</div>
								
							<div class="form-group row pt-1">
				                <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				                <div class="col-sm-4">
				                	<div class="input-group-append">
							    		<input type="text" class="form-control form-control-sm" name="nama_pas" id="nama_pas" placeholder="Cari Pasien" value="<?php echo $data['nama_pas']; ?>" autofocus="" >
							    		<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_pasien" id="lihat_data_pasien"><i class="fas fa-search"></i></button>
							    	</div>
								</div>
								<label for="nm_dokter" class="col-sm-1 col-form-label">Dokter</label>
				                <div class="col-sm-3">
							    	<div class="input-group-append">
										<input type="text" class="form-control form-control-sm bg-warning" name="nm_dokter" id="nm_dokter" placeholder="Pilih dokter" value="">
										<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datadokter" id="lihat_data_dokter"><i class="fas fa-search"></i></button>
									</div>
								</div>									
							</div>
				 			
				            <div class="form-group row pt-1">
				                <label for="alm_pas" class="col-sm-2 col-form-label">Alamat</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" name="alm_pas" id="alm_pas" placeholder="Alamat terisi otomatis" value="<?php echo $data['alm_pas']; ?>" >
								</div>
								<label for="nomor_rm" class="col-sm-1 col-form-label">Nomor RM</label>
				                <div class="col-sm-3">
							    	<input type="text" class="form-control form-control-sm" name="nomor_rm" id="nomor_rm" placeholder="Nomor otomatis" value="<?php echo $data['nomor_rm']; ?>" >
								</div>																
							</div>
							<div class="form-group row pt-1">
				                <label for="tpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				                <span class="col-sm-2">
							    	<input type="text" class="form-control form-control-sm" name="tpt_lahir" id="tpt_lahir" placeholder="" value="<?php echo $data['tpt_lahir']; ?>" >
							    </span>
							    <span class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" name="lhr_pas" id="lhr_pas" placeholder="" value="<?php echo $data['lhr_pas']; ?>" >
								</span>
								<label for="nik" class="col-sm-1 col-form-label">NIK</label>
				                <div class="col-sm-3">
							    	<input type="number" class="form-control form-control-sm" name="nik" id="nik" value="<?php echo $data['nik']; ?>" >
								</div>
							</div>

							<div class="form-group row pt-1">
				                <label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" name="jk_pas" id="jk_pas" placeholder="Jenis kelamin terisi otomatis" value="<?php echo $data['jk_pas']; ?>" >
								</div>
							    <label for="agama" class="col-sm-1 col-form-label">Agama</label>
							    <div class="col-sm-3">
							    	<select name="agama" id="agama" class="form-control form-control-sm" <?php echo $data['agama']; ?>>
										<option value="">------ Pilih Agama Pasien ------</option>
										<option value="Islam" <?php if($data['agama'] == "Islam") {echo "selected";} ?>>Islam</option>
										<option value="Kristen" <?php if($data['agama'] == "Kristen") {echo "selected";} ?>>Kristen</option>
										<option value="Katolik" <?php if($data['agama'] == "Katolik") {echo "selected";} ?>>Katolik</option>
										<option value="Hindu" <?php if($data['agama'] == "Hindu") {echo "selected";} ?>>Hindu</option>
										<option value="Budha" <?php if($data['agama'] == "Budha") {echo "selected";} ?>>Budha</option>
										<option value="Konghuchu" <?php if($data['agama'] == "Konghuchu") {echo "selected";} ?>>Konghuchu</option>
									</select>
							    </div>
							</div>
							<div class="form-group row pt-1">
				                <label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" name="jk_pas" id="jk_pas" placeholder="Jenis kelamin terisi otomatis" value="<?php echo $data['jk_pas']; ?>" >
								</div>
								
							</div>
							<div class="form-group row pt-1">
								<label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
					                <div class="col-sm-4">								    	
								    	<select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" <?php echo $data['pekerjaan']; ?>>
								      	<option value="">----------- Pilih Pekerjaan -----------</option>
								      	<option value="Belum/Tidak Bekerja" <?php if($data['pekerjaan'] == "Belum/Tidak Bekerja") {echo "selected";} ?>>Belum/Tidak Bekerja</option>
								      	<option value="Mengurus Rumah Tangga" <?php if($data['pekerjaan'] == "Mengurus Rumah Tangga") {echo "selected";} ?>>Mengurus Rumah Tangga</option>
								      	<option value="Wiraswasta" <?php if($data['pekerjaan'] == "Wiraswasta") {echo "selected";} ?>>Wiraswasta</option>
								      	<option value="Karyawan BUMD" <?php if($data['pekerjaan'] == "Karyawan BUMD") {echo "selected";} ?>>Karyawan BUMD</option>
								      	<option value="Karyawan BUMN" <?php if($data['pekerjaan'] == "Karyawan BUMN") {echo "selected";} ?>>Karyawan BUMN</option>
										<option value="Karyawan Swasta" <?php if($data['pekerjaan'] == "Karyawan Swasta") {echo "selected";} ?>>Karyawan Swasta</option>
										<option value="Petani/Pekebun" <?php if($data['pekerjaan'] == "Petani/Pekebun") {echo "selected";} ?>>Petani/Pekebun</option>
										<option value="Nelayan" <?php if($data['pekerjaan'] == "Nelayan") {echo "selected";} ?>>Nelayan</option>
										<option value="PNS" <?php if($data['pekerjaan'] == "PNS") {echo "selected";} ?>>PNS</option>
										<option value="Pensiunan" <?php if($data['pekerjaan'] == "Pensiunan") {echo "selected";} ?>>Pensiunan</option>
										<option value="Pelajar/Mahasiswa" <?php if($data['pekerjaan'] == "Pelajar/Mahasiswa") {echo "selected";} ?>>Pelajar/Mahasiswa</option>
										<option value="TNI" <?php if($data['pekerjaan'] == "TNI") {echo "selected";} ?>>TNI</option>
										<option value="POLRI" <?php if($data['pekerjaan'] == "POLRI") {echo "selected";} ?>>POLRI</option>
										<option value="Guru" <?php if($data['pekerjaan'] == "Guru") {echo "selected";} ?>>Guru</option>
										<option value="Perawat" <?php if($data['pekerjaan'] == "Perawat") {echo "selected";} ?>>Perawat</option>
										<option value="Bidan" <?php if($data['pekerjaan'] == "Bidan") {echo "selected";} ?>>Bidan</option>
										<option value="Dokter" <?php if($data['pekerjaan'] == "Dokter") {echo "selected";} ?>>Dokter</option>
										<option value="Nakes Lain" <?php if($data['pekerjaan'] == "Nakes Lain") {echo "selected";} ?>>Nakes Lain</option>
								      </select>
									</div>
							</div>
							<div class="form-group row pt-1">
								<label for="berat_badan">BB</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									    <input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan"  value="<?php echo $data['berat_badan']; ?>">
									    <i class="btn btn-secondary btn-sm" >Kg</i>
									</div>
								</div>
								<label for="tinggi_badan">TB</label>
									<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" value="<?php echo $data['tinggi_badan']; ?>">
									  <i class="btn btn-secondary btn-sm" >Cm</i>
									</div>
								</div>
								<label for="temp">Suhu</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="temp" id="temp" value="<?php echo $data['temp']; ?>">
									  <i class="btn btn-secondary btn-sm" >&#176;C</i>
									</div>
								</div>
								<label for="tekanan_darah">Tek. Darah</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="text" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" value="<?php echo $data['tekanan_darah']; ?>">
									  <i class="btn btn-secondary btn-sm" >MmHg</i>
									</div>              
								</div>
								<label for="tekanan_darah">Nadi</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="nadi" id="nadi" value="<?php echo $data['nadi']; ?>">
									  <i class="btn btn-secondary btn-sm" >/mnt</i>
									</div>              
								</div>
					        </div>
								Pada hari ini telah kami periksa dengan teliti kesehatannya dan berpendapat bahwa kesehatan saudara tersebut pada waktu periksa
				        	<div class="form-group row pt-1">
								<label for="kesimpulan" class="col-sm-1 col-form-label">dinyatakan :</label>
								<div class="col-sm-2">				    	
								    	<select name="kesimpulan" id="kesimpulan" class="form-control form-control-sm">
								      	<option value="Sehat">Sehat</option>
								      	<option value="Tidak Sehat">Tidak Sehat</option>
								      </select>
								  </div>
								<label for="keperluan" class="col-sm-2 col-form-label">dan dipergunakan untuk :</label>
								<div class="col-sm-4">
									<input type="text" name="keperluan" id="keperluan" class="form-control form-control-sm" value="<?php echo $data['keperluan']; ?>">
								</div>
								<label for="butawarna" class="col-sm-1 col-form-label">buta warna</label>
								<div class="col-sm-2">
									<input type="text" name="butawarna" id="butawarna" class="form-control form-control-sm" value="<?php echo $data['butawarna']; ?>">
								</div>
							</div>
				        	dan berlaku 1 bulan sejak surat keterangan ini di keluarkan.
				            <br>Demikian surat keterangan sehat ini dibuat agar dipergunakan sebagaimana semestinya. Terima kasih.
				            <div class="col-sm-12 text-right">
				                <?php echo $kab; ?>, <?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?>
				                <br>
				                Mengetahui,
				            </div>
				            <br>
				            <br>
				            <table>
				            	<tr>
				            		<td style='padding-right:8px; font-size: 10px;' width='700' align=''></td>
					                <td style='padding-right:1px; font-size: 10px;' width='350' align='right'>
					                    <p></p>
					                    <p></p>
					                    <u><strong><input type="text" class="btn btn-white btn-sm" name="nm_dokter2" id="nm_dokter2" placeholder="Nama dokter" readonly></strong></u><br>
					                   <input type="text" class="btn btn-white btn-sm col-10" name="sip" id="sip" placeholder="SIP / NIP" readonly>
					                </td>
					            </tr>
				            </table>
				            <hr>
			        		<div class="form-group row">
							    <div class="col-sm-12 text-right">
							      <input type="submit" class="btn btn-info btn-sm" id="btn_simpan" value="Simpan">
							    </div>
							</div>
  						</form>
					</div>
				</div>
			</div>
		</div>
		<br>
<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Data Pasien Periksa Untuk Surat Keterangan Sehat</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	    	</div>
	    	<div class="modal-body">
					<div class="row" style="padding: 0 16px;">
    				<div class="col-md-12 vertical-form">
            			<div class="row data-pengobatan">
                			<div class="position-relative form-group col-md-6">
                    			<label for="nama" class="">Cari Nama Pasien/Nomor Rm (tekan Enter) </label>
                    				<div class="input-group input-group-sm">
                        				<input type="text" class="form-control form-control-sm" id="search">
                    				</div>
                    		</div>
                		</div>
                		<div class="position-relative form-group col-md-12">
                    		<ul id="result"></ul>       
                		</div>
            		</div>
        			</form>
    			</div>
			</div>
			</div>
	</div>
</div>

<!-- Modal data dokter -->
<div class="modal fade" id="modal_datadokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Dokter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-hover display">
            <thead>
                <tr>
                    <th>ID Dokter</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>SIP / NIP</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                require_once "koneksi.php";
                $query_tampil = "SELECT * FROM dokter";
                $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    while($data = mysqli_fetch_array($sql_tampil)) {
                 ?>
                <tr>
                    <td><?php echo $data['kd_dokter']; ?></td>
                    <td><button class="btn btn-link" style="padding: 4px; font-size: 11px; text-align: left;"  title="Pilih Dokter" id="tombol_pilihdokter" name="tombol_pilihdokter" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_dokter']; ?>"
                            data-nama="<?php echo $data['nm_dokter']; ?>"
                            data-spesialisasi="<?php echo $data['spesialisasi']; ?>"
                            data-sip="<?php echo $data['sip']; ?>"
                        ><?php echo $data['nm_dokter']; ?></button></td>
                    <td><?php echo $data['spesialisasi']; ?></td>
                    <td><?php echo $data['sip']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="Pilih Dokter" id="tombol_pilihdokter" name="tombol_pilihdokter" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_dokter']; ?>"
                            data-nama="<?php echo $data['nm_dokter']; ?>"
                            data-spesialisasi="<?php echo $data['spesialisasi']; ?>"
                            data-sip="<?php echo $data['sip']; ?>"
                        > Pilih
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){    
         function search(){
               var nama_pas=$("#search").val();
               var nomor_rm=$("#search").val();
              
              if(nama_pas!=""){
                $("#result").html('<i class="fa fa-spin fa-spinner"></i>');
                 $.ajax({
                    type:"post",
                    url:"ajax/search_suratsehat.php",
                    data:"nama_pas="+nama_pas+"&nomor_rm="+nomor_rm,
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
    });

	$("button[name='tombol_pilihpasien']").click(function() {
        var nam = $(this).data('nam');
        var nom = $(this).data('nom');
        var tgl = $(this).data('tgl');
        var bb = $(this).data('bb');
        var tb = $(this).data('tb');
        var td = $(this).data('td');
        var suhu = $(this).data('suhu');       

        $("#nama_pas").val(nam);
        $("#nomor_rm").val(nom);
        $("#tgl_periksa").val(tgl);
        $("#berat_badan").val(bb);
        $("#tinggi_badan").val(tb);
        $("#tekanan_darah").val(td);
        $("#temp").val(suhu);

    });
	$("#nm_dokter").click(function() {
    	$("#lihat_data_dokter").click();
	});

	$("#nm_dokter").keypress(function (e) {
       var key = e.which;
        if(key == 13) {
            alert();
        }
    });

    $("#nm_dokter").keyup(function() { nm_dokter(); });
    $("#nm_dokter").change(function() { nm_dokter(); });
    $("#nm_dokter2").keyup(function() { nm_dokter2(); });
    $("#nm_dokter2").change(function() { nm_dokter2(); });
    $("#sip").keyup(function() { sip(); });
    $("#sip").change(function() { sip(); });

	$("button[name='tombol_pilihdokter']").click(function() {
    var nama = $(this).data('nama');
    var sip = $(this).data('sip');
        $("#nm_dokter").val(nama);
        $("#nm_dokter2").val(nama);
        $("#sip").val(sip);
	});
    

	$("#edit_sehat").on("submit", function(event){
    event.preventDefault();
		var no_surat = $("#no_surat").val();
		var no_daftar = $("#no_daftar").val();
		var nomor_rm = $("#nomor_rm").val();
		var nama_pas = $("#nama_pas").val();		
		var alm_pas = $("#alm_pas").val();
		var tgl_periksa = $("#tgl_periksa").val();
		var tpt_lahir = $("#tpt_lahir").val();
		var lhr_pas = $("#lhr_pas").val();
		var jk_pas = $("#jk_pas").val();
		var nm_dokter = $("#nm_dokter").val();
		var berat_badan = $("#berat_badan").val();
		var tinggi_badan = $("#tinggi_badan").val();
		var temp = $("#temp").val();
		var tekanan_darah = $("#tekanan_darah").val();
		var nadi = $("#nadi").val();
		var pekerjaan = $("#pekerjaan").val();
		var keperluan = $("#keperluan").val();
		var kesimpulan = $("#kesimpulan").val();
		var butawarna = $("#butawarna").val();
		var sip = $("#sip").val();
		var nik = $("#nik").val();
		var agama = $("#agama").val();
		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi nama pasien terlebih dahulu',
			  'warning'
			)
		
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Akan menyimpan surat keterangan sehat pasien ini ?',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_suratsehat.php",
	              data: "no_surat="+no_surat+"&no_daftar="+no_daftar+"&nomor_rm="+nomor_rm+"&nama_pas="+nama_pas+"&alm_pas="+alm_pas+"&tgl_periksa="+tgl_periksa+"&tpt_lahir="+tpt_lahir+"&lhr_pas="+lhr_pas+"&jk_pas="+jk_pas+"&nm_dokter="+nm_dokter+"&berat_badan="+berat_badan+"&tinggi_badan="+tinggi_badan+"&temp="+temp+"&tekanan_darah="+tekanan_darah+"&nadi="+nadi+"&pekerjaan="+pekerjaan+"&keperluan="+keperluan+"&kesimpulan="+kesimpulan+"&butawarna="+butawarna+"&sip="+sip+"&nik="+nik+"&agama="+agama,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Surat keterangan sehat berhasil disimpan ',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=suratsehat' ;
				            //window.location.reload(true);
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