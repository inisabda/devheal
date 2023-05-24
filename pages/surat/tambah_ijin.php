<?php 
    $no_daftar = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Entry Surat Ijin</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6">
        	<h4><i class="fas fa-envelope"></i> Form Surat Ijin Pasien</h4>
        </div>
        <div class="col-6 text-right">
            <a href="?page=suratijin">
                <button class="btn-transition btn btn-outline-success btn-xl"><i class="fas fa-envelope"></i> Data dan Riwayat Surat Ijin</button>
            </a>
        </div>
    </div>
	<div class="form-container">
		<div class="row" style="padding: 0 40px;">
			<div class="col-md-12 vertical-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk memasukkan surat ijin</h6>
				<div class="row" style="padding: 0 20px;">
		            <div class="col-md-12 mt-2 vertical-form">
		            	<form method="post" id="tambah_ijin" autocomplete="on">
							<?php 
					          $tgl_periksa = gmdate("Y-m-d", time() + 60 * 60 * 7);
					          $hari= substr($tgl_periksa, 8, 2);
					          $bulan = substr($tgl_periksa, 5, 2);
					          $tahun = substr($tgl_periksa, 0, 4);
					          $tgl = $tahun;
					          $carikode = mysqli_query($conn, "SELECT MAX(no_surat) FROM tbl_suratijin WHERE tgl_periksa = '$tgl_periksa'") or die (mysql_error());
					          $datakode = mysqli_fetch_array($carikode);
					          if($datakode) {
					              $nilaikode = substr($datakode[0], 5);
					              $kode = (int) $nilaikode;
					              $kode = $kode + 1;
					               $no_surat = "SKD/".str_pad($kode, 3, "0", STR_PAD_LEFT)."/".$hari."/".$bulan."/".$tgl;
			                    } else {
			                        $no_surat = "SKD/"."/001".$hari."/".$bulan."/".$tgl;
			                    }
							?>					      
					        <div style="text-align: right;">
					        	No surat : <b><?php echo $no_surat; ?></b>	Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
					        </div>
							<div class="form-group row pt-3">
							    <!--<label for="no_daftar" class="col-sm-3 col-form-label">No Pasien</label>-->
							    <div class="col-sm-4">
							      <input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo $tgl_periksa; ?>">
							      <input name="no_surat" id="no_surat" type="hidden" class="form-control form-control-sm" value="<?php echo $no_surat; ?>">
							      <input name="no_daftar" id="no_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
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
								<h5><u>SURAT KETERANGAN IJIN SAKIT</u></h5>
								<b><p>Nomor : <?php echo $no_surat; ?></p></b>
							</div>
							<div align="left">
								Yang bertanda tangan di bawah ini, bahwa :
							</div>
								<?php
									//$no = 1;
									$no_daftar = @$_GET['id'];
									$hari_ini = date("d-m-Y");
									$query_tampil = "SELECT * FROM tbl_daftarpasien

									WHERE no_daftar='$no_daftar'";
				                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
				                    $data = mysqli_fetch_array($sql_tampil);
				                    $nm_dokter = $data['nm_dokter']										
								 ?>
							<div class="form-group row pt-1">
				                <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				                <div class="col-sm-4">
				                	<div class="input-group-append">
							    		<input type="text" class="form-control form-control-sm" name="nama_pas" id="nama_pas" placeholder="Cari Pasien" value="<?php echo $data['nama_pas']; ?>" autofocus="" >
							    		<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_pasien" id="lihat_data_pasien"><i class="fas fa-search"></i></button>
							    	</div>
								</div>
								<label for="nm_dokter" class="col-sm-2 col-form-label" style="text-align: left;">Dokter</label>
							    <div class="col-sm-4">
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
								<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: left;">Nomor RM</label>
								<div class="col-sm-4">
								    <div class="input-group-append">
				            	       <input type="text" class="form-control form-control-sm" name="nomor_rm" id="nomor_rm" placeholder="Nomor RM terisi otomatis" value="<?php echo $data['nomor_rm']; ?>" >
									</div>
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
				                <label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" name="jk_pas" id="jk_pas" placeholder="Jenis kelamin terisi otomatis" value="<?php echo $data['jk_pas']; ?>" >
								</div>
								<?php
									$no_daftar = @$_GET['id'];
									$query_tampil = "SELECT * FROM tbl_periksa WHERE no_daftar='$no_daftar'";
				                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
				                    $data = mysqli_fetch_array($sql_tampil);
				                    if (isset($data['diagnosa'])){
		                                   echo "
		                                   <label for='diagnosa' class='col-sm-2 col-form-label' style='text-align: left;'>Diagnosa</label>
		                                    <div class='col-sm-4'>
		                                        <input class='form-control form-control-sm' name='diagnosa' id='diagnosa' value='$data[diagnosa]'>
		                                    </div>";
		                                }else{
		                                   echo "
		                                   <label for='diagnosa' class='col-sm-2 col-form-label' style='text-align: left;'>Diagnosa</label>
		                                    <div class='col-sm-4'>
		                                        <input class='form-control form-control-sm' value='Diagnosa Belum Dimasukkan' disabled>
		                                    </div>";
		                                }
		                        ?>							
							</div>								
				        	<div class="form-group row pt-1">
				                <label for="istirahat" class="col-sm-6 col-form-label">Yang bersangkutan benar - benar <b>Sakit</b> dan memerlukan istirahat selama</label>
				                <div class="col-sm-2">
				                	<input type="number" class="form-control form-control-sm " name="istirahat" id="istirahat" value="" placeholder="Lama istirahat" >
				              	</div>
				              	<label for="mulai_tanggal" class="col-sm-2 col-form-label"> hari, terhitung mulai tgl</label>
				                <div class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" name="mulai_tanggal" id="mulai_tanggal" value="">
								</div>
								<label for="akhir_tanggal" class="col-sm-1 col-form-label" style="text-align: left;">s/d Tanggal</label>
								<div class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" name="akhir_tanggal" id="akhir_tanggal" value="">
								</div>				              	
				            </div>
				            Demikian surat ijin sakit ini dibuat agar menjadikan maklum. Terima kasih.
				            <div class="col-sm-12 text-right">
				                <?php echo $kab; ?>, <?php echo ("$hari_ini"); ?>
				                <br>
				                Mengetahui,
				            </div>
				            <br>
				            <br>
				            <table width="100%">
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
							      <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-save"></i> Simpan</button>
							      <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
							    </div>
							</div>
  						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Cari data pasien -->
<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Data Pasien Periksa Untuk Surat Ijin</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	    	</div>
	    	<div class="modal-body">
				<div class="row" style="padding: 0 16px;">
    				<div class="col-md-12 vertical-form">
            			<div class="row data-pengobatan">
                			<div class="position-relative form-group col-md-6">
                    			<label for="nama" class="">Cari Nama Pasien/Nomor RM (tekan Enter) </label>
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
	        		<span aria-hidden="true">&times;</span></button>
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
	                url:"ajax/search_ijinperiksa.php",
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
    });

	$("button[name='tombol_pilihpasien']").click(function() {
        var nam = $(this).data('nam');
        var norm = $(this).data('norm');
        var alm = $(this).data('alm');
        var diag = $(this).data('diag');
        var pek = $(this).data('pek');       

        $("#nama_pas").val(nam);
        $("#nomor_rm").val(norm);
        $("#alm_pas").val(alm);
        $("#diagnosa").val(diag);
        $("#pekerjaan").val(pek);
    });

    $("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');

		Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'akan menghapus SKD atas nama '+nama+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=suratijin",
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
		            window.location.reload(true);
		          }
		        })
              }
            })  
          }
        })
    });

	$("#tambah_ijin").on("submit", function(event){
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
		var mulai_tanggal = $("#mulai_tanggal").val();
		var akhir_tanggal = $("#akhir_tanggal").val();
		var istirahat = $("#istirahat").val();
		var diagnosa = $("#diagnosa").val();
		var pekerjaan = $("#pekerjaan").val();
		var sip = $("#sip").val();
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
	          text: 'Akan menyimpan surat ijin pasien ini ?',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/simpan_suratijin.php",
	              data: "no_surat="+no_surat+"&no_daftar="+no_daftar+"&nomor_rm="+nomor_rm+"&nama_pas="+nama_pas+"&alm_pas="+alm_pas+"&tgl_periksa="+tgl_periksa+"&tpt_lahir="+tpt_lahir+"&lhr_pas="+lhr_pas+"&jk_pas="+jk_pas+"&nm_dokter="+nm_dokter+"&mulai_tanggal="+mulai_tanggal+"&akhir_tanggal="+akhir_tanggal+"&istirahat="+istirahat+"&sip="+sip+"&diagnosa="+diagnosa+"&pekerjaan="+pekerjaan,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Surat ijin berhasil disimpan ',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=suratijin' ;
				           // window.location.reload(true);
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
<script>
    function goBack() {
        window.history.back();
    }
</script>