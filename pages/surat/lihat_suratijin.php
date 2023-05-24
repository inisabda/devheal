<?php 
    $no_surat = @$_GET['id'];
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Surat Ijin</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Surat Ijin Pasien</h4></div>
        <div class="col-6 text-right">
            <a href="?page=suratijin">
            	<button type="button" class="btn btn-warning btn-sm">Kembali</button>
        	</a>
        </div>
    </div>

<div class="form-container">
		<div class="row" style="padding: 0 40px;">
			<div class="col-md-12 vertical-form">
					<div class="row" style="padding: 0 20px;">
			            <div class="col-md-12 mt-2 vertical-form">			            	
							<?php 
					          $no_surat = @$_GET['id'];								
								$query_tampil = "SELECT * FROM tbl_suratijin
								WHERE no_surat='$no_surat'";
			                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			                    $data = mysqli_fetch_array($sql_tampil);
			                    $nm_dokter = $data['nm_dokter']
							?>
					      
					        <div style="text-align: right;">
					        	No surat : <b><?php echo $data['no_surat']; ?></b>	Tanggal : <b><?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?></b>
					        </div>
							<div class="form-group row pt-3">
							    <!--<label for="no_daftar" class="col-sm-3 col-form-label">No Pasien</label>-->
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
			                    Email : <?php echo $email; ?>  Telp : <?php echo $no_hp; ?>
						  		
						  	</div>
							<hr>
							<div align="center">
								<h5><u>SURAT KETERANGAN IJIN SAKIT</u></h5>
								<b><p><?php echo $no_surat; ?></p></b>
							</div>
							<div align="left">
								Yang bertanda tangan di bawah ini, bahwa :
							</div>
								
							<div class="form-group row pt-1">
				                <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				                <div class="col-sm-4">
				                	<input type="text" class="form-control form-control-sm" value="<?php echo $data['nama_pas']; ?>" disabled>
								</div>
								<label for="nm_dokter" class="col-sm-2 col-form-label" style="text-align: left;">Dokter</label>
								    <div class="col-sm-4">
										<input type="text" class="form-control form-control-sm" value="<?php echo $data['nm_dokter']; ?>" disabled>
									</div>
							</div>
				 			
				            <div class="form-group row pt-1">
				                <label for="alm_pas" class="col-sm-2 col-form-label">Alamat</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" value="<?php echo $data['alm_pas']; ?>" disabled>
								</div>
								<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: left;">Nomor RM</label>
								<div class="col-sm-4">
								    <div class="input-group-append">
				            	       <input type="text" class="form-control form-control-sm" value="<?php echo $data['nomor_rm']; ?>" disabled >
									</div>
								</div>									
							</div>
							<div class="form-group row pt-1">
				                <label for="tpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				                <span class="col-sm-2">
							    	<input type="text" class="form-control form-control-sm" value="<?php echo $data['tpt_lahir']; ?>" disabled >
							    </span>
							    <span class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" value="<?php echo $data['lhr_pas']; ?>" disabled>
								</span>
								<label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" value="<?php echo $data['pekerjaan']; ?>" disabled>
							      </select>
								</div>
													
							</div>
								
							<div class="form-group row pt-1">
				                <label for="jk_pas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				                <div class="col-sm-4">
							    	<input type="text" class="form-control form-control-sm" value="<?php echo $data['jk_pas']; ?>" disabled>
								</div>
								
								<label for="diagnosa" class="col-sm-2 col-form-label" style="text-align: left;">Diagnosa</label>
								<div class="col-sm-4">
								    <div class="input-group-append">
				            	       <input type="text" class="form-control form-control-sm" value="<?php echo $data['diagnosa']; ?>" disabled>
									</div>
								</div>		
								
							</div>
								
				        	<div class="form-group row pt-1">
				                <label for="istirahat" class="col-sm-6 col-form-label">Yang bersangkutan benar - benar <b>Sakit</b> dan memerlukan istirahat selama</label>
				                <div class="col-sm-2">
				                	<input type="number" class="form-control form-control-sm " value="<?php echo $data['istirahat']; ?>" disabled>
				              	</div>
				              	<label for="mulai_tanggal" class="col-sm-2 col-form-label"> hari, terhitung mulai tgl</label>
				                <div class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" value="<?php echo $data['mulai_tanggal']; ?>" disabled>
								</div>
								<label for="akhir_tanggal" class="col-sm-1 col-form-label" style="text-align: left;">s/d Tanggal</label>
								<div class="col-sm-2">
							    	<input type="date" class="form-control form-control-sm" value="<?php echo $data['akhir_tanggal']; ?>" disabled>
								</div>				              	
				            </div>
				            Demikian surat ijin sakit ini dibuat agar menjadikan maklum. Terima kasih.
				            <div class="col-sm-12 text-right">
				                <?php echo $kab; ?>, <?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?>
				                <br>
				                Mengetahui,
				            </div>
				            <br>
				            <br>
				            <div class="col-sm-12 text-right">
				                 <?php echo $nm_dokter; ?>
				            </div>
				            <hr>
    					</div>
    				</div>
			</div>
		</div>
</div>
</div>
