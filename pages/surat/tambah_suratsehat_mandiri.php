<?php 
    $no_daftar = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Entry Surat Keterangan Sehat</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Surat Keterangan Sehat</h4></div>
        <div class="col-6 text-right">
            <a href="?page=suratsehat">
                <button class="btn-transition btn btn-outline-success btn-xl">Data SUKET Sehat</button>
            </a>
        </div>
    </div>
	<div class="form-container">
		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk memasukkan surat keterangan sehat</h6>
				<div class="row" style="padding: 0 0px;">
		            <div class="col-md-12 mt-2 vertical-form">
		            	<form method="post" id="simpan_suketsehat" autocomplete="off">
							<?php 
					          $tgl_periksa = gmdate("Y-m-d", time() + 60 * 60 * 7);
					          $hari= substr($tgl_periksa, 8, 2);
					          $bulan = substr($tgl_periksa, 5, 2);
					          $tahun = substr($tgl_periksa, 0, 4);
					          $tgl = $tahun;
					          $carikode = mysqli_query($conn, "SELECT MAX(no_surat) FROM tbl_suratsehat WHERE tgl_periksa = '$tgl_periksa'") or die (mysql_error());
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
							    <div class="col-sm-4">
							      <input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo $tgl_periksa; ?>">
							      <input name="no_surat" id="no_surat" type="hidden" class="form-control form-control-sm" value="<?php echo $no_surat; ?>">
							      <input name="no_daftar" id="no_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
							    </div>
						  	</div>

						  	<div align="center">
						  		<h4><?php echo $nama_klinik; ?></h4>
			                    <?php echo $alamat_klinik; ?>
			                    <br> 
			                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?>
						  		
						  	</div>
							<hr>
							<div align="center">
								<h5><u>SURAT KETERANGAN SEHAT</u></h5>
								<b><p><?php echo $no_surat; ?></p></b>
							</div>
								
							<div align="left">									
									Yang bertanda tangan di bawah ini selaku dokter yang memeriksa di <?php echo $nama_klinik; ?>Husada menerangkan bahwa :
							</div>
								
							<div class="form-group row pt-1">
				                <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				                <div class="col-sm-4">
				                	<div class="input-group-append">
							    		<input type="text" class="form-control form-control-sm" name="nama_pas" id="nama_pas" placeholder="Nama baru/cari tombol sebelah kanan" value="" autofocus="" >
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
							    	<input type="text" class="form-control form-control-sm" name="alm_pas" id="alm_pas" placeholder="Alamat terisi otomatis" value="" >
								</div>
								<label for="nomor_rm" class="col-sm-1 col-form-label">Nomor RM</label>
				                <div class="col-sm-3">
							    	<input type="text" class="form-control form-control-sm" name="nomor_rm" id="nomor_rm" placeholder="Nomor otomatis" >
								</div>					
							</div>
							<div class="form-group row pt-1">
				                <label for="tpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				                <span class="col-sm-2">
							    	<input type="text" class="form-control form-control-sm" name="tpt_lahir" id="tpt_lahir" placeholder="" value="" >
							    </span>
							    <span class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" name="lhr_pas" id="lhr_pas" placeholder="" value="" >
								</span>															
							</div>

							<div class="form-group row pt-1">
				                <label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" name="jk_pas" id="jk_pas" placeholder="Jenis kelamin terisi otomatis" value="" >
								</div>									
							</div>
							<div class="form-group row pt-1">
								<label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
					                <div class="col-sm-4">								    	
								    	<select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm">
								      	<option value="">----------- Pilih Pekerjaan -----------</option>
								      	<option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
								      	<option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
								      	<option value="Wiraswasta">Wiraswasta</option>
								      	<option value="Karyawan BUMD">Karyawan BUMD</option>
								      	<option value="Karyawan BUMN">Karyawan BUMN</option>
										<option value="Karyawan Swasta">Karyawan Swasta</option>
										<option value="Petani/Pekebun">Petani/Pekebun</option>
										<option value="Nelayan">Nelayan</option>
										<option value="PNS">PNS</option>
										<option value="Pensiunan">Pensiunan</option>
										<option value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
										<option value="TNI">TNI</option>
										<option value="POLRI">POLRI</option>
										<option value="Guru">Guru</option>
										<option value="Perawat">Perawat</option>
										<option value="Bidan">Bidan</option>
										<option value="Dokter">Dokter</option>
										<option value="Nakes Lain">Nakes Lain</option>
								      </select>
									</div>
							</div>
							<div class="form-group row pt-1">
								<label for="berat_badan">BB</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									    <input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan"  value="">
									    <i class="btn btn-secondary btn-sm" >Kg</i>
									</div>
								</div>
								<label for="tinggi_badan">TB</label>
									<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" value="">
									  <i class="btn btn-secondary btn-sm" >Cm</i>
									</div>
								</div>
								<label for="temp">Suhu</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="temp" id="temp" value="">
									  <i class="btn btn-secondary btn-sm" >&#176;C</i>
									</div>
								</div>
								<label for="tekanan_darah">Tek. Darah</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="text" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" value="">
									  <i class="btn btn-secondary btn-sm" >MmHg</i>
									</div>              
								</div>
								<label for="tekanan_darah">Nadi</label>
								<div class="col-sm-2">
									<div class="input-group-append">
									  <input type="number" class="form-control form-control-sm" name="nadi" id="nadi" value="">
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
									<input type="text" name="keperluan" id="keperluan" class="form-control form-control-sm">
								</div>
								<label for="butawarna" class="col-sm-1 col-form-label">buta warna</label>
								<div class="col-sm-2">
									<input type="text" name="butawarna" id="butawarna" class="form-control form-control-sm">
								</div>
							</div>
				        	dan berlaku 1 bulan sejak surat keterangan ini di keluarkan.
				            <br>Demikian surat keterangan sehat ini dibuat agar dipergunakan sebagaimana semestinya. Terima kasih.
				            <div class="col-sm-12 text-right">
				                <?php echo $kab; ?>, <?php echo date('d-m-Y', strtotime($tgl_periksa)); ?>
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
							      <button type="submit" class="btn btn-info btn-sm">Simpan </button>
							    </div>
							</div>
  						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal cari pasien -->
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
        var nadi = $(this).data('nadi');       

        $("#nama_pas").val(nam);
        $("#nomor_rm").val(nom);
        $("#tgl_periksa").val(tgl);
        $("#berat_badan").val(bb);
        $("#tinggi_badan").val(tb);
        $("#tekanan_darah").val(td);
        $("#temp").val(suhu);
        $("#nadi").val(nadi);

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
              url: "ajax/hapus.php?page=suratsehat",
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


	$("#simpan_suketsehat").on("submit", function(event){
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
	              url: "ajax/simpan_suratsehat.php",
	              data: "no_surat="+no_surat+"&no_daftar="+no_daftar+"&nomor_rm="+nomor_rm+"&nama_pas="+nama_pas+"&alm_pas="+alm_pas+"&tgl_periksa="+tgl_periksa+"&tpt_lahir="+tpt_lahir+"&lhr_pas="+lhr_pas+"&jk_pas="+jk_pas+"&nm_dokter="+nm_dokter+"&berat_badan="+berat_badan+"&tinggi_badan="+tinggi_badan+"&temp="+temp+"&tekanan_darah="+tekanan_darah+"&nadi="+nadi+"&pekerjaan="+pekerjaan+"&keperluan="+keperluan+"&kesimpulan="+kesimpulan+"&sip="+sip+"&butawarna="+butawarna,
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