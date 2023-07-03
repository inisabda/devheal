<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-capsules"></i> Data Obat</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-7"><h4><i class="fas fa-capsules"></i> Data Obat Farmasi Rawat Jalan dan Apotek</h4></div>
		<div class="col-5 text-right">
			<a href="?page=info_kadaluarsa">
				<button class="btn btn-sm btn-danger">Info Kadaluarsa Obat</button>
			</a>
			 <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Dokter3' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
			<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#importObat" title="Import data obat">
				<i class="far fa-file-excel"></i> Import Data Obat
			</button>
			<a href="?page=tambah_dataobat">
				<button class="btn btn-sm btn-warning"><i class="fas fa-plus-circle"></i> Tambah Data</button>
			</a>
			<?php } ?>
		</div>
		<div class="col-12">		
			<?php
				if(isset($_GET['berhasil'])){
					echo "<div class='alert alert-warning small' role='alert' id='alert'>
					".$_GET['berhasil']. " Data Obat Berhasil Di Import. </div>" ;
				}
			?>
		</div>
	</div>
	<style>
    ul.nav-pills{
        padding: 12px 15px;
        /*border-bottom: 1px solid #169BB0;*/
    }
    .kotak-data-tab .nav-item{
        font-size: 12px;
        font-weight: lighter;
        padding-bottom: 5px;
        border-bottom: 1px solid #D9DADB;
        margin-right: 15px;
    }
    .kotak-data-tab .nav-link{
        color: #000000;
    }
    .kotak-data-tab .nav-link.active{
        background-color: #B22222;
    }
    .badge-status {
        padding: 5px;
    }
  </style>
    <div class="kotak-data-tab">
    	<ul class="nav nav-pills" id="pills-tab" role="tablist">
    	  <?php 
    	  	$query_30 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 30 DAY) AND tbl_stokexpobat.stok > 0";
    	  	$sql_30 = mysqli_query($conn, $query_30) or die ($conn->error);
    	  	$jml_30 = mysqli_num_rows($sql_30);

    	  	$query_10 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>CURDATE() AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0";
    	  	$sql_10 = mysqli_query($conn, $query_10) or die ($conn->error);
    	  	$jml_10 = mysqli_num_rows($sql_10);

    	  	$query_telahexp = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp<=CURDATE() AND tbl_stokexpobat.stok > 0";
    	  	$sql_telahexp = mysqli_query($conn, $query_telahexp) or die ($conn->error);
    	  	$jml_telahexp = mysqli_num_rows($sql_telahexp);
    	   ?>
          <li class="nav-item">
            <a class="nav-link active" id="tigapuluh_hari-tab" data-toggle="pill" href="#tigapuluh_hari" role="tab" aria-controls="tigapuluh_hari" aria-selected="true">Kurang Dari 30 Hari <sup>( <?php echo $jml_30; ?> )</sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="sepuluh_hari-tab" data-toggle="pill" href="#sepuluh_hari" role="tab" aria-controls="sepuluh_hari" aria-selected="false">Kurang Dari 10 Hari <sup>( <?php echo $jml_10; ?> )</sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="telah_kadaluarsa-tab" data-toggle="pill" href="#telah_kadaluarsa" role="tab" aria-controls="telah_kadaluarsa" aria-selected="false">Telah Kadaluarsa <sup>( <?php echo $jml_telahexp; ?> )</sup></a>
          </li>
    	</ul>
    </div>
	<div class="table-container">
		<div class="row" style="padding: 0 10px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="tabel_dataobat" class="table table-striped display tabel-data">
					<thead>
		        <tr>
		            <th>Kode</th>
		            <th>Nama Obat</th>
		            <th>No. Batch</th>
		            <th>Exp. Date</th>
		            <th>Harga (20%)</th>
                <th>Harga Pokok</th>
		            <th>Stok</th>
                <th>Ket</th>
		            <th>Satuan</th>
		            <th>Kategori</th>
		            <th>Supplier</th>
		            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Dokter3' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
		            <th>Opsi</th>
		        	<?php } ?>
		        </tr>
			    </thead>
			    <tbody>
						<?php 
							$query_tampil = "SELECT * FROM tbl_dataobat ORDER BY nm_obat ASC";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td><?php echo $data['kd_obat']; ?></td>
				 			<td><?php echo $data['nm_obat']; ?></td>
				 			<td><?php echo $data['no_batch']; ?></td>
				 			<td><?php echo tgl_indo($data['exp_obat']); ?></td>
				 			<td>Rp. <?php echo number_format($data['hrg_obat'], 0,",", "."); ?></td>
		          <td>Rp. <?php echo number_format($data['hrgbeli_obat'], 0,",", "."); ?></td>
				 			<td><?php if($data['stk_obat'] == '0'){?>
		                	<span class="badge badge-danger" style="padding: 4px; font-size: 11px;">Kosong</span>
				                <?php }else{?>
				                <?php echo $data['stk_obat'];?>
				                <?php }?></td>
							<td><?php
									if($data['stk_obat'] >= '21'){ 
										echo "<span class='badge badge-success' style='padding: 4px; font-size: 11px;'>Stok Tersedia</span>";}
									else if($data['stk_obat'] >= '1' && $data['stk_obat'] <='20'){												
										echo "<span class='badge badge-warning' style='padding: 4px; font-size: 11px;'>Hampir Habis</span>";}
									else if($data['stk_obat'] == '0'){
										echo "<span class='badge badge-danger' style='padding: 4px; font-size: 11px;'>Stok Habis</span>";}
									?></td>
				 			<td><?php echo $data['sat_obat']; ?></td>
				 			<td><?php echo $data['ktg_obat']; ?></td>
				 			<td><?php echo $data['supplier']; ?></td>
				 			<td class="td-opsi">
				 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail obat" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_obat"
				 				data-kode="<?php echo $data['kd_obat']; ?>"
				 				data-nama="<b><?php echo $data['nm_obat']; ?></b>"
				 				data-batch="<b><?php echo $data['no_batch']; ?></b>"
				 				data-exp="<?php echo tgl_indo($data['exp_obat']); ?>"
				 				data-ktg="<?php echo $data['ktg_obat']; ?>"
				 				data-bentuk="<?php echo $data['bnt_obat']; ?>"
				 				data-satuan="<?php echo $data['sat_obat']; ?>"
				 				data-harbel="<?php echo "Rp".number_format($data['hrgbeli_obat'], 0,",", "."); ?>"
				 				data-harju="<?php echo "Rp".number_format($data['hrg_obat'], 0,",", "."); ?>"
				 				data-stok="<?php echo $data['stk_obat']; ?>"
				 				data-supplier="<b><?php echo $data['supplier']; ?></b>"
				 				data-minstok="<?php echo $data['minstk_obat']; ?>">
                    <i class="fas fa-info-circle"></i>
                </button>
				 				<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2' || $_SESSION['posisi_peg'] == 'Dokter3' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-kode="<?php echo $data['kd_obat']; ?>">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-kode="<?php echo $data['kd_obat']; ?>" data-nama="<?php echo $data['nm_obat']; ?>">
                    <i class="fas fa-trash"></i>
                </button>
            		<?php } ?>
            	</td>
				 		</tr>
				 		<?php } ?>
				 	</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal import data obat-->
<div class="modal fade" id="importObat" tabindex="-1" role="dialog" aria-labelledby="importObatLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importObatLabel">Pilih File Data Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form action="" method="post" id="upload" enctype="multipart/form-data">
				  	<div class="position-relative row form-group">
						<label for="file" class="col-sm-2 col-form-label">File import</label>
						<div class="col-sm-10">
							<input name="file" id="file" type="file" class="form-control-file">
							<small class="form-text text-muted">Pilih file bertipe excel (.xls)</small>
						</div>
		       		</div>
				  	<div class="form-group row">
						<div class="col-sm-12 text-right">
							<button type="button" name="download" class="btn btn-sm btn-warning" onclick="JavaScript:window.location.href='pages/import_data_obat/download_form_import_data_obat.php?file=form_import_data_obat.xls';"><i class="fas fa-download"></i> Download Format</button>
							<button type="submit" name="upload" class="btn btn-sm btn-info">Import</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			</div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detail_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Info Detail Obat</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table class="tabel-detail-obat" style="font-size: 14px;">
        <tr>
          <th>Kode</th>
          <td id="det_kode"></td>
        </tr>
        <tr>
          <th>Nama</th>
          <td id="det_nama"></td>
        </tr>
        <tr>
          <th>No. Batch</th>
          <td id="det_batch"></td>
        </tr>
        <tr>
          <th>Kategori</th>
          <td id="det_kat"></td>
        </tr>
        <tr>
          <th>Bentuk</th>
          <td id="det_bentuk"></td>
        </tr>
        <tr>
          <th>Harga Pokok</th>
          <td id="det_harbel"></td>
        </tr>
        <tr>
          <th>Harga Jual (20%)</th>
          <td id="det_harju"></td>
        </tr>
        <tr>
          <th>Satuan Jual</th>
          <td id="det_satuan"></td>
        </tr>
        <tr>
          <th>Jumlah Min. Stok</th>
          <td id="det_mstok"></td>
        </tr>
        <tr>
          <th>Jumlah Stok</th>
          <td id="det_jstok"></td>
        </tr>
        <tr>
          <th>Nama Supplier</th>
          <td id="det_supplier"></td>
        </tr>
        <tr>
          <th>Kadaluarsa (Stok)</th>
          <td id="det_exp"></td>
        </tr>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">tutup</button>
    </div>
  </div>
</div>
</div>

<script>
	$("button[name='tombol_detail']").click(function(){
		var kode = $(this).data('kode');
		var nama = $(this).data('nama');
		var batch = $(this).data('batch');
		var exp = $(this).data('exp');
		var ktg = $(this).data('ktg');
		var bentuk = $(this).data('bentuk');
		var satuan = $(this).data('satuan');
		var harbel = $(this).data('harbel');
		var harju = $(this).data('harju');
		var stok = $(this).data('stok');
		var supplier = $(this).data('supplier');
		var minstok = $(this).data('minstok');

		$("#det_kode").html(kode);
		$("#det_nama").html(nama);
		$("#det_batch").html(batch);
		$("#det_kat").html(ktg);
		$("#det_bentuk").html(bentuk);
		$("#det_satuan").html(satuan);
		$("#det_harju").html(harju);
		$("#det_harbel").html(harbel);
		$("#det_mstok").html(minstok);
		$("#det_jstok").html(stok);
		$("#det_supplier").html(supplier);
		$("#det_exp").html("");
		$.ajax({
	      type: "GET",
	      url: "ajax/detail.php?page=expstok_obat",
	      data: "kd_obat="+kode,
	      success: function(data_expstok) {
	        var objData = JSON.parse(data_expstok);
	        $.each(objData, function(key, val) {
	          $("#det_exp").append(val.tgl_exp+" (Stok "+val.stok+")<br>");
	        })
	      }
	    });
	});

	$("button[name='tombol_edit']").click(function(){
		var kode = $(this).data('kode');
		window.location='?page=edit_dataobat&kode='+kode;
	});

	$("button[name='tombol_hapus']").click(function(){
		var kode = $(this).data('kode');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan obat ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=dataobat",
              data: "id="+kode,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=dataobat';
		          }
		        })
              }
            })  
          }
        })
	});
</script>
<script type="text/javascript">
    setTimeout(function () {
        // Closing the alert
        $('#alert').alert('close');
    }, 4000);
</script>
<script>
	$(document).ready(function(){
			$("#upload").on("submit", function(event){  
		  	event.preventDefault();
		    var file = $("#file").val();

		    if(file=="") {
		      document.getElementById("file").focus();
		      Swal.fire(
		        'Data Belum Lengkap',
		        'Maaf, tolong pilih file',
		        'warning'
		      )		    
		    } else {
			    Swal.fire({
			    	title: 'Import data obat !!',
              text: 'Apakah anda telah mengisi data dengan benar ?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
			    }).then((ok) => {
			    	if (ok.value) {
			    	$.ajax({
			    		url:"pages/import_data_obat/proses.php",  
	            method:"POST",  
	            data:new FormData(this),  
	            contentType:false,  
	            processData:false,
	            beforeSend:function(){
	               $('#importObat').hide();
	            },
	            success:function(berhasil){
								Swal.fire({
						    	title: 'Proses simpan data !',
					        html: 'Mohon tunggu ...',
					        allowOutsideClick: false,
					        timer: 4000,
					        onOpen: () => {
				            Swal.showLoading()
				        },
					    }).then((ok) => {
								window.location='?page=dataobat&berhasil='+berhasil;
							})
	           },  
			    	})
			    }
			    })
				}
			})
		});
</script>