<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Surat Keterangan Sakit</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul">
			<h4>Data Surat Keterangan Sakit</h4>
		</div>
	</div>
	<div class="table-container">
  		<div class="row" style="padding: 0 16px;">
			<div class="col-md-12 vertical-form table-responsive">
				<br>
				<table id="example" class="table table-striped display tabel-data">
					<thead>
				        <tr>
				            <th>#</th>
				            <th>No Surat</th>
				            <th>Nama_Pasien</th>
				            <th>RM</th>
				            <th>Alamat</th>
				            <th>Hasil Periksa</th>
				            <th>Diagnosa</th>
				            <th>Nama Dokter</th>
				            <th>Tgl Periksa</th>
				            <th>Opsi</th>
				        </tr>
				    </thead>
				    <tbody>
						<?php 
							//$no = 1;
							$query_tampil = "SELECT * FROM tbl_suratsakit";
							$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
							while($data = mysqli_fetch_array($sql_tampil)) {
						 ?>
				 		<tr>
				 			<td width="1%"><?php echo $data['no']; ?>.</td>
				 			<td><?php echo $data['no_surat']; ?></td>
				 			<td><?php echo $data['nama_pas']; ?></td>
				 			<td><?php echo $data['nomor_rm']; ?></td>
				 			<td><?php echo $data['alm_pas']; ?></td>
				 			<td><button type="button" class="btn btn-link btn-sm" style='padding: 4px; font-size: 11px; text-align: left;' title='Lihat data vital sign' id="tombol_detailttv" name="tombol_detailttv" 
					 				data-no_daftar="<?php echo $data['no_daftar']; ?>"
					 				data-nama_pas="<?php echo $data['nama_pas']; ?>"
					 				data-tgl_periksa="<?php echo date('d-m-Y', strtotime($data['tgl_periksa'])); ?>"
					 				data-nomor_rm="<?php echo $data['nomor_rm']; ?>"
					 				data-lhr_pas="<?php echo $data['tpt_lahir']; ?>, <?php echo date('d-m-Y', strtotime($data['lhr_pas'])); ?>"
					 				data-toggle="modal" data-target="#detail_ttv"
					 				data-assesment="<?php echo $data['assesment']; ?>"
					 				data-objektive="<?php echo $data['objektive']; ?>"
					 				data-diagnosa="<?php echo $data['diagnosa']; ?>">Hasil Periksa</button></td>
				 			<td><?php echo $data['diagnosa']; ?></td>
				 			<td><?php echo $data['nm_dokter']; ?></td>
				 			<td><?php echo date('d-m-Y',strtotime($data['tgl_periksa'])); ?></td>
				 			<td class="td-opsi">
				 				<a href="pages_cetak_surat/cetak_suratsakit.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
				 				<button class="btn-transition btn btn-outline-dark btn-sm" title="Cetak" id="tombol_print" name="tombol_print"><i class="fas fa-print"></i></button></a>
								<!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['nomor_rm']; ?>">
								<i class="fas fa-edit"></i>
								</button> -->
								<button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
				                  <i class="fas fa-trash"></i></button></td>
						</tr>
						 <?php } ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="detail_ttv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Hasil Periksa Surat Keterangan Sakit</h5>
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
                </tr>
                <tr>
                    <td><b>Tempat Tanggal  Lahir</b></td>
                    <td><b>=</b></td>
                    <td id="lhr_pasdetail"></td>
                <tr>
                    <td><b>No RM</b></td>
                    <td><b>=</b></td>
                    <td id="nomor_rmdetail"></td>
                </tr>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tekanan Darah</th>
                        <th>Nadi</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Suhu</th>
                        <th>Nadi</th>
                </thead>
                <tbody id="data_detailttv">
                    <!-- diisi dengan ajax jquery -->
                </tbody>
                <table>
            		<tr>
            			<td>Assesment</td>
            			<td>:</td>
            			<td id="assesment"></td>
            		</tr>
            		<tr>
            			<td>Objektive</td>
            			<td>:</td>
            			<td id="objektive"></td>
            		<tr>
            			<td>Diagnosa</td>
            			<td>:</td>
            			<td id="diagnosa"></td>
            		</tr>
                </table>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'akan menghapus surat keterangan sakit atas nama '+nama+'?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=suratsakit",
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

	$("button[name='tombol_detailttv']").click(function() {
		var no_daftar = $(this).data("no_daftar");
		var tgl_periksa = $(this).data("tgl_periksa");
		var nomor_rm = $(this).data("nomor_rm");
		var nama_pas = $(this).data("nama_pas");
		var lhr_pas = $(this).data("lhr_pas");
		var assesment = $(this).data("assesment");
		var objektive = $(this).data("objektive");
		var diagnosa = $(this).data("diagnosa");
		
		$("#no_daftardetail").html(no_daftar);
		$("#tgl_periksadetail").html(tgl_periksa);
		$("#nomor_rmdetail").html(nomor_rm);
		$("#nama_pasdetail").html(nama_pas);
		$("#lhr_pasdetail").html(lhr_pas);
		$("#assesment").html(assesment);
		$("#diagnosa").html(diagnosa);
		$("#objektive").html(objektive);
		
		$("#data_detailttv").html("");
		$.ajax({
			type: "GET",
			url: "ajax/detail.php?page=suratsakit",
			data: "no_daftar="+no_daftar,
			success : function(data) {
				// console.log(data);
				var objData = JSON.parse(data);
				$.each(objData, function(key,val){
					// $("#data_detailttv").append(val.tekanan_darah+"/"+val.tinggi_badan+"/"+val.berat_badan+"/"+val.temp+"/"+val.subtotal+"<br>");
					var baris_baru = '';
					baris_baru += '<tr>';
					baris_baru += 	'<td class="text-center">'+val.tekanan_darah+' MmHg</td>';
					baris_baru += 	'<td class="text-center">'+val.nadi+' x/mnt</td>';
					baris_baru += 	'<td class="text-center">'+val.tinggi_badan+' Cm</td>';
					baris_baru += 	'<td class="text-center">'+val.berat_badan+' Kg</td>';
					baris_baru += 	'<td>'+val.temp+' &#176;C</td>';
					baris_baru += 	'<td>'+val.nadi+'</td>';
					baris_baru += '</tr>';
					$("#data_detailttv").append(baris_baru);
					//$("#total_penjualandetail").html(total_penjualan);
				})
			}
		});
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=tambah_suratsehat&id='+id;
	});

</script>
