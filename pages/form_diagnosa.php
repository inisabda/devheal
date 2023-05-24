<?php 
    $no_daftar = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Assesment Pasien</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Assesment Pasien</h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>

<div class="form-container">
		<div class="row" style="padding: 0 40px;">
			<div class="col-md-12 vertical-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
					<div class="row" style="padding: 0 20px;">
			            <div class="col-md-12 mt-2 vertical-form">
			            	<form method="post" id="simpan_periksa" autocomplete="off">
								<?php 
						          $tgl_periksa = gmdate("Y-m-d", time() + 60 * 60 * 7);
						          $hari= substr($tgl_periksa, 8, 2);
						          $bulan = substr($tgl_periksa, 5, 2);
						          $tahun = substr($tgl_periksa, 0, 4);
						          $tgl = $tahun.$bulan.$hari;
						          $carikode = mysqli_query($conn, "SELECT MAX(no_diagnosa) FROM tbl_periksa WHERE tgl_periksa = '$tgl_periksa'") or die (mysql_error());
						          $datakode = mysqli_fetch_array($carikode);
						          if($datakode) {
						              $nilaikode = substr($datakode[0], 13);
						              $kode = (int) $nilaikode;
						              $kode = $kode + 1;
						              $no_diagnosa = "DIA/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
						          } else {
						              $no_diagnosa = "DIA/".$tgl."/001";
						          }
						       ?>

						        <div style="text-align: right;">
						        	No periksa : <b><?php echo $no_diagnosa; ?></b>	Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
						        </div>
								<div class="form-group row pt-3">
								    <!--<label for="no_daftar" class="col-sm-3 col-form-label">No Pasien</label>-->
								    <div class="col-sm-9">
								      <input name="tgl_periksa" id="tgl_periksa" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
								      <input name="no_diagnosa" id="no_diagnosa" type="hidden" class="form-control form-control-sm" value="<?php echo $no_diagnosa; ?>">
								    </div>
							  	</div>
		
								<?php 
				                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
				                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
				                    $data = mysqli_fetch_array($sql_tampil);

				                    //Fungsi Menghitung Umur Pasien
				                    $tanggal_lahir = new DateTime($data['lhr_pas']);
								    $sekarang = new DateTime("today");
								    if ($tanggal_lahir > $sekarang) { 
									    $thn = "0";
									    $bln = "0";
									    $tgl = "0";
								    }
								    $thn = $sekarang->diff($tanggal_lahir)->y;
								    $bln = $sekarang->diff($tanggal_lahir)->m;
								    $tgl = $sekarang->diff($tanggal_lahir)->d;
								    //echo "Umur anda adalah :<br>";
								    //echo $thn." tahun ".$bln." bulan ".$tgl." hari";
				                   ?>

						        <div class="col-md-9" style="text-align: left; font-size: 14px;">
									<br>
								<table class="data_pasien" border="0" cellpadding="0">
									<tr>
		                    			<td width="100"><b>No. Registrasi</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['no_daftar']; ?></td>
		                    		</tr>
		                    		<tr>
		                    			<td width="100"><b>Nomor RM</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['nomor_rm']; ?></td>
		                    		</tr>
		                    		<tr>
		                    			<td width="100"><b>Nama Pasien</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['nama_pas']; ?></td>
		                    			<td><?php echo $data['jk_pas']; ?></td>
		                    		</tr>
		                    		<tr>
		                    			<td width="100"><b>TTL Pasien</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y',strtotime($data['lhr_pas'])); ?> (<?php echo $thn." tahun ".$bln." bulan ";?>)</td>
		                    		</tr>
		                    		<tr>
		                    			<td width="100"><b>Alamat</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['alm_pas']; ?></td>
		                    		</tr>
		                    		<tr>
		                    			<td width="100"><b>Cara Bayar</b></td>
		                    			<td width="10">:</td>
		                    			<td><?php echo $data['asuransi_pas']; ?></td>
		                    		</tr>

		                    	</table>
		               		 	</div>

									
								
					    		<div class="form-group row pt-1">
								    <!-- <label for="no_daftar" class="col-sm-2 col-form-label">No. Registrasi</label> -->
								    <div class="col-sm-4">
								    	<input type="hidden" class="form-control form-control-sm" name="no_daftar" id="no_daftar" value="<?php echo $data['no_daftar']; ?>" disabled>
										</div>
										<!-- <label for="nomor_rm" class="col-sm-2 col-form-label">Nomor RM</label> -->
								    <div class="col-sm-4">
								    	<input type="hidden" class="form-control form-control-sm" name="nomor_rm" id="nomor_rm" value="<?php echo $data['nomor_rm']; ?>" disabled>
									</div>
								</div>

					 			<div class="form-group row pt-1">
								    <!-- <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label> -->
								    <div class="col-sm-4">
								    	<input type="hidden" class="form-control form-control-sm" name="nama_pas" id="nama_pas" value="<?php echo $data['nama_pas']; ?>" disabled>
										</div>
										<!-- <label for="alm_pas" class="col-sm-2 col-form-label">Alamat Pasien</label> -->
								    <div class="col-sm-4">
								    	<input type="hidden" class="form-control form-control-sm" name="alm_pas" id="alm_pas" value="<?php echo $data['alm_pas']; ?>" disabled>
									</div>
								</div>
								<hr>
								
								<div class="form-group row">
									<label for="code" class="col-sm-2 col-form-label">Kode ICD-10</label>
									<div class="col-sm-4">
						               <div class="input-group-append">                      
					    	      			<input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Cari Kode ICD-10" autofocus="">

					    	      			<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_diagnosa" id="lihat_data_diagnosa"><i class="fas fa-search"></i></button>
					    				</div>
									</div>
									<label for="diagnosa" class="col-sm-2 col-form-label" style="text-align: left;">Diagnosa ICD-10</label>
									    <div class="col-sm-4">
											<input type="text" class="form-control form-control-sm" name="diagnosa" id="diagnosa" placeholder="Diagnosa terisi otomatis" value="" disabled>
										</div>
								</div>
             
					            <div class="form-group row pt-1">
					                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
					                <div class="col-sm-4">
								    	<input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi" placeholder="Deskripsi terisi otomatis" value="" disabled>
									</div>

									<label for="dokter" class="col-sm-2 col-form-label" style="text-align: left;">DPJP</label>
									<div class="col-sm-4">
									    <div class="input-group-append">
					            	       <input type="text" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $data['nm_dokter']; ?>" name="nm_dokter" disabled>
										</div>
									</div>
								</div>
								<hr>

					 			<div class="form-group row pt-1">
					                <label for="berat_badan" class="col-sm-1 col-form-label">B. Badan</label>
					                <div class="col-sm-2">
					                	<div class="input-group-append">
					                    	<input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder=".............." >
					                    	<i class="btn btn-secondary btn-sm" >Kg</i>
					                	</div>
					                </div>
					                <label for="tinggi_badan" class="col-sm-1 col-form-label">T.Badan</label>
					                <div class="col-sm-2">
					            	    <div class="input-group-append">
					                    	<input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="..............">
					                    	<i class="btn btn-secondary btn-sm" >Cm</i>
					                    </div>
					          	    </div>
					                <label for="temp" class="col-sm-1 col-form-label">Temperatur</label>
					                <div class="col-sm-2">
					                   <div class="input-group-append">
					                        <input type="number" class="form-control form-control-sm" name="temp" id="temp" placeholder="..............">
					                        <i class="btn btn-secondary btn-sm" >&#176;C</i>
					                   </div>
					                </div>
					                <label for="tekanan_darah" class="col-sm-1 col-form-label">Tensi</label>
				                    <div class="col-sm-2">
				                       <div class="input-group-append">
				                        <input type="text" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" placeholder="..............">
				                        <i class="btn btn-secondary btn-sm" >MmHg</i>
				                        </div>              
				                   	</div>
					            </div>

								<div class="form-group row pt-1">
								    <label for="subjektive" class="col-sm-2 col-form-label"><i>Subject (S)</i></label>
								    <div class="col-sm-4">
							      	   <textarea name="subjektive" id="subjektive" rows="2" class="form-control" placeholder="Masukkan Data Subjective Pasien" style="font-size: 14px;"></textarea>
									</div>
									<label for="objektive" class="col-sm-2 col-form-label" style="text-align: left;"><i>Object (O)</i></label>
					                <div class="col-sm-4">
								    	<textarea name="objektive" id="objektive" rows="2" class="form-control" placeholder="Masukkan Data Objective Pasien" style="font-size: 14px;"></textarea>
					            	</div>
								</div>

					 			<div class="form-group row pt-1">
								    <label for="assesment" class="col-sm-2 col-form-label"><i>Assesment (A)</i></label>
								    <div class="col-sm-4">
							      		<textarea name="assesment" id="assesment" rows="2" class="form-control" placeholder="Masukkan Assesment Pasien" style="font-size: 14px;"></textarea>
										</div>
					                <label for="plan" class="col-sm-2 col-form-label" style="text-align: left;"><i>Plan(P)</i></label>
								    <div class="col-sm-4">
							      		<textarea name="plan" id="plan" rows="2" class="form-control" placeholder="Masukkan Rencana Pengobatan" style="font-size: 14px;"></textarea>
					      			</div>
								</div>

					        	<div class="form-group row pt-1">
					                <label for="butawarna" class="col-sm-2 col-form-label" style="text-align: left;"> Buta Warna </label>
					                <div class="col-sm-4">
					                  <div class="form-check">
					                    <label class="form-check-label" style="font-weight: normal;">
					        	           <input name="butawarna" id="butawarna1" type="radio" class="form-check-input" value="Ya"> 
					        	              Ya</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					                    <label class="form-check-label" style="font-weight: normal; text-align: right;">
					                        <input name="butawarna" id="butawarna2" type="radio" class="form-check-input" value="Tidak" checked>Tidak </label>
					                  </div>
					                </div>
					              	<label for="status_rawat" class="col-sm-2 col-form-label">Status Rawat</label>
									<div class="col-sm-4">
								      <select name="status_rawat" id="status_rawat" class="form-control form-control-sm" >
								      	<option value="Sudah diperiksa" >Sudah diperiksa</option>
								      </select>
									</div>				              	
					            </div>
					            <hr>

				        		<div class="form-group row">
								    <div class="col-sm-12 text-right">
								      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan </button>
								    	<a href="?page=perawatan">
			                            	<button type="button" class="btn btn-warning btn-sm">Kembali</button>
			                        	</a>
								    </div>
								</div>

							</form>
						</div>
    				</div>
			</div>
		</div>
</div>

	<br>
	<div class="row" style="padding: 0 40px;">
		<div class="col-md-12 vertical-form">
			 <h5 align="center"> Hasil assesment pasien</h5>
	        <table id="editable_table" class="table table-bordered table-striped display tabel-data">
	            <thead>
	                <tr class="bg-info">
	                	<th>No Diagnosa</th>
	                    <th>Diagnosa</th>
	                    <th>Subjektif</th>
	                    <th>Objektif</th>
	                    <th>Assesment</th>
	                    <th>Plan</th>
	                    <th>TB</th>
	                    <th>BB</th>
	                    <th>Temp</th>
	                    <th>TD</th>
	                    <th>Buta Warna</th>
	                </tr>
	            </thead>
					<?php 
	           		require_once "koneksi.php";
	           		$no_daftar = @$_GET['id'];
	           		
	                $tgl_sekarang = date('Y-m-d');
	                $query_diagnosa = "SELECT * FROM tbl_periksa WHERE no_daftar='$no_daftar'";
			        $sql_diagnosa = mysqli_query($conn, $query_diagnosa) or die ($conn->error);
			            //$data = mysqli_fetch_array($sql_tampil);
	             	?>
	            <tbody>
	            	<?php  
		                while($data = mysqli_fetch_array($sql_diagnosa)) {
		            ?>
	               	<tr>
	                    <td><?php echo $data['no_diagnosa']; ?></td>
	    				<td><?php echo $data['diagnosa']; ?></td>
	                    <td><?php echo $data['subjektive']; ?></td>
	                    <td><?php echo $data['objektive']; ?></td>
	                    <td><?php echo $data['assesment']; ?></td>
	                    <td><?php echo $data['plan']; ?></td>
	                    <td><?php echo $data['tinggi_badan']; ?> Cm</td>
	                    <td><?php echo $data['berat_badan']; ?> Kg</td>
	                    <td><?php echo $data['temp']; ?> &#176;</td>
	                    <td><?php echo $data['tekanan_darah']; ?> Mmhg</td>
	                    <td><?php echo $data['butawarna']; ?></td>
	                </tr>
	                 <?php } ?>
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="modal fade" id="modal_diagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Data ICD 10</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		    	</div>
		    	<div class="modal-body">
						<div class="row" style="padding: 0 16px;">
        				<div class="col-md-12 vertical-form">
                			<div class="row data-pengobatan">
                    			<div class="position-relative form-group col-md-5">
                        			<label for="code" class="">Cari Code, Diagnosa (tekan Enter) </label>
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


<script>
    $(document).ready(function(){    
         function search(){
               var code=$("#search").val();
               var diagnosa=$("#search").val();
               var deskripsi=$("#search").val();

              if(code!=""){
                $("#result").html('<i class="fa fa-spin fa-spinner"></i>');
                 $.ajax({
                    type:"post",
                    url:"ajax/search_icd10.php",
                    data:"code="+code+"&diagnosa="+diagnosa,
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
	$("button[name='tombol_pilihdiagnosa']").click(function() {
        var cod = $(this).data('cod');
        var nam = $(this).data('nam');
        var desk = $(this).data('desk');
       

        $("#code").val(cod);
        $("#diagnosa").val(nam);
        $("#deskripsi").val(desk);
    });


	$("#btn_simpan").click(function() {
		var no_diagnosa = $("#no_diagnosa").val();
		var no_daftar = $("#no_daftar").val();
		var tgl_periksa = $("#tgl_periksa").val();
		var nama_pas = $("#nama_pas").val();
		var nomor_rm = $("#nomor_rm").val();
		var code = $("#code").val();
		var diagnosa = $("#diagnosa").val();
		var subjektive = $("#subjektive").val();
		var objektive = $("#objektive").val();
		var assesment = $("#assesment").val();
		var plan = $("#plan").val();
		var berat_badan = $("#berat_badan").val();
		var tinggi_badan = $("#tinggi_badan").val();
		var temp = $("#temp").val();
		var tekanan_darah = $("#tekanan_darah").val();
		var status_rawat = $("#status_rawat").val();
		var butawarna = document.querySelector('input[name="butawarna"]:checked').value;


		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	if(code=="") {
			document.getElementById("code").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'Maaf, tolong isi kode ICD-10 terlebih dahulu',
			  'warning'
			)
		
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'Akan memasukan assesment pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/simpan_periksa.php",
	              data: "no_diagnosa="+no_diagnosa+"&no_daftar="+no_daftar+"&tgl_periksa="+tgl_periksa+"&nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&code="+code+"&diagnosa="+diagnosa+"&subjektive="+subjektive+"&objektive="+objektive+"&assesment="+assesment+"&plan="+plan+"&berat_badan="+berat_badan+"&tinggi_badan="+tinggi_badan+"&temp="+temp+"&tekanan_darah="+tekanan_darah+"&butawarna="+butawarna+"&status_rawat="+status_rawat,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Assesment berhasil disimpan ',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=perawatan' ;
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