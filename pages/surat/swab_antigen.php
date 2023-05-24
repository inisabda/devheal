<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Surat Keterangan Sehat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4>Data Surat Keterangan Laborat (SWAB)</h4>
		</div>			
	</div>
		<div class="table-container">
      	<div class="row" style="padding: 0 16px;">
			<div class="col-md-12 vertical-form table-responsive">
				<br>
				<table id="tabel_datadaftar" class="table table-hover display tabel-data">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>No Surat</th>
				            <th>Nama Pasien</th>
				            <th>No. RM</th>
				            <th>Alamat</th>
				            <th>Hasil SWAB</th>
				            <th>Tgl Periksa</th>
				            <th>Opsi</th>
				        </tr>
				    </thead>
				    <tbody>
						<?php 
							//$no = 1;
							$query_tampil = "SELECT * FROM tbl_swab_antigen ORDER BY no DESC";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
					 		<tr>
					 			<td><?php echo $data['no']; ?>.</td>
					 			<td><?php echo $data['no_surat']; ?></td>
					 			<td><?php echo $data['nama_pas']; ?></td>
					 			<td><?php echo $data['nomor_rm']; ?></td>
					 			<td><?php echo $data['alm_pas']; ?></td>
					 			<td>
					 				<button type="button" class="btn btn-link btn-sm" style='padding: 4px; font-size: 11px; text-align: left;' title='Lihat Hasil Swab' id="tombol_detailswab" name="tombol_detailswab" 
					 				data-no_daftar="<?php echo $data['no_daftar']; ?>"
					 				data-nama_pas="<?php echo $data['nama_pas']; ?>"
					 				data-tgl_periksa="<?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?>"
					 				data-nomor_rm="<?php echo $data['nomor_rm']; ?>"
					 				data-nm_dokter="<?php echo $data['nm_dokter']; ?>"
					 				data-lhr_pas="<?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y', strtotime($data['lhr_pas'])); ?>"					 				
					 				data-toggle="modal" data-target="#detail_swab">Hasil SWAB</button></td>
					 			<td><?php echo date('d-m-Y',strtotime($data['tgl_periksa'])); ?></td>
					 			<td class="td-opsi">
					 				<a href="pages_cetak_surat/cetak_swab.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
					 					<button class="btn-transition btn btn-outline-dark btn-sm" title="Cetak Hasil Swab" id="tombol_print" name="tombol_print"><i class="fas fa-print"></i></button>
					 				</a>
				              		<button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no']; ?>" data-nama="<?php echo $data['nama_pas']; ?>"><i class="fas fa-trash"></i></button>
				          		</td>
						 	</tr>
						 <?php } ?>
				    </tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
<div class="modal fade" id="detail_swab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Hasil Swab</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table border="0" cellpadding="0">
                <tr>
                    <td><b>No Reg</b></td>
                    <td><b>=</b></td>
                    <td id="no_daftardetail"></td>
                </tr>
                <tr>
                    <td><b>Tanggal Periksa</b></td>
                    <td><b>=</b></td>
                    <td id="tgl_periksadetail"></td>
                </tr>
                <tr>
                    <td><b>Nama Pasien</b></td>
                    <td><b>=</b></td>
                    <td id="nama_pasdetail"></td>
                <tr>
                <tr>
                    <td><b>Tempat Tanggal  Lahir</b></td>
                    <td><b>=</b></td>
                    <td id="lhr_pasdetail"></td>
                <tr>
                    <td><b>No RM</b></td>
                    <td><b>=</b></td>
                    <td id="nomor_rmdetail"></td>
                </tr>
                <tr>
                    <td><b>Dokter</b></td>
                    <td><b>=</b></td>
                    <td id="nm_dokterdetail"></td>
                </tr>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis Pemeriksaan</th>
                        <th>Hasil Pemeriksaan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody id="data_detailswab">
                    <!-- diisi dengan ajax jquery -->
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>

<script>
	$("button[name='tombol_detailswab']").click(function() {
		var no_daftar = $(this).data("no_daftar");
		var tgl_periksa = $(this).data("tgl_periksa");
		var nomor_rm = $(this).data("nomor_rm");
		var nama_pas = $(this).data("nama_pas");
		var lhr_pas = $(this).data("lhr_pas");
		var nm_dokter = $(this).data("nm_dokter");
		
		$("#no_daftardetail").html(no_daftar);
		$("#tgl_periksadetail").html(tgl_periksa);
		$("#nomor_rmdetail").html(nomor_rm);
		$("#nama_pasdetail").html(nama_pas);
		$("#lhr_pasdetail").html(lhr_pas);
		$("#nm_dokterdetail").html(nm_dokter);
		
		$("#data_detailswab").html("");
		$.ajax({
			type: "GET",
			url: "ajax/detail.php?page=swab",
			data: "no_daftar="+no_daftar,
			success : function(data) {
				// console.log(data);
				var objData = JSON.parse(data);
				$.each(objData, function(key,val){
					// $("#data_detailttv").append(val.tekanan_darah+"/"+val.tinggi_badan+"/"+val.berat_badan+"/"+val.temp+"/"+val.subtotal+"<br>");
					var baris_baru = '';
					baris_baru += '<tr>';
					baris_baru += 	'<td class="text-left">'+val.nm_lab+'</td>';
					baris_baru += 	'<td class="text-left">'+val.hasil_lab+'</td>';
					baris_baru += 	'<td class="text-left">'+val.keterangan+'</td>';
					baris_baru += '</tr>';

					//total_penjualan = total_penjualan + Number(val.subtotal);
					$("#data_detailswab").append(baris_baru);
					//$("#total_penjualandetail").html(total_penjualan);
				})
			}
		});
	});

	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'akan menghapus Surat Keterangan Hasil Swab atas nama '+nama+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=swab",
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

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_suratsehat&id='+id;
	});

</script>
