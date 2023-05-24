<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Racikan Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=racikanobat">
				<button class="btn btn-sm btn-info">Obat Racikan Baru</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
		   	<tr>
					<th>No</th>
      		<th>Kode</th>
          <th>Nama Obat</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Opsi</th>
        </tr>
		  </thead>
		<tbody>
		<?php 
			/*$query_tampil = "SELECT * FROM tbl_nama_racikan INNER JOIN  tbl_nama_racikandetail ON tbl_nama_racikan.kd_racik = tbl_nama_racikandetail.kd_racik INNER JOIN  tbl_dataobat ON tbl_nama_racikandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_nama_racikan.status = 'aktif' ORDER BY tbl_nama_racikan.nama_racikan ASC";*/
			$no = 1;
      $query_tampil = "SELECT * FROM tbl_nama_racikan  WHERE status = 'aktif' ";
      $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($dutang = mysqli_fetch_array($sql_tampil)) {
		?>
		 		<tr>
				 	<td><?php echo $no++."."; ?></td>
		 			<td><?php echo $dutang['kd_racik']; ?></td>
          <td><?php echo $dutang['nama_racikan']; ?></td>
          <td><?php echo $dutang['stk_obat']; ?></td>
          <td>Rp. <?php echo number_format($dutang['total_penjualan'],2,',','.'); ?></td>
		 			<td width="10%" class="td-opsi">
                  <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                  <i class="fas fa-info-circle"></i>
                  </button> -->
                  <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
	                <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->
	                <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $dutang['kd_racik']; ?>">
                      <i class="fas fa-user-edit"></i>
                  </button>
                  <button class="btn-transition btn btn-outline-primary btn-sm" title="detail racikan" id="tombol_detailracikan" name="tombol_detailracikan" data-toggle="modal" data-target="#detail_racikan" data-kd_racik="<?php echo $dutang['kd_racik']; ?>" data-tgl_racik="<?php echo tgl_indo($dutang['tgl_racik']); ?>" data-nama_racikan="<?php echo $dutang['nama_racikan']; ?>"data-stk_obat="<?php echo $dutang['stk_obat']; ?>">
                  	<i class="fas fa-info-circle"></i>
                  </button>
                  <button class="btn-transition btn btn-outline-danger btn-sm" title="Hapus" id="tombol_racik" name="tombol_racik" data-kd_racik="<?php echo $dutang['kd_racik']; ?>" data-nama_racikan="<?php echo $dutang['nama_racikan']; ?>">
                  	<i class="fas fa-trash"></i>
                  </button>
                  <!-- <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button> -->
          </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
	</div>
</div>



<div class="modal fade" id="detail_racikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Obat Racikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<table class="tabel-profil">
        		<tr>
        			<th>Kode Racikan</th>
        			<td id="kd_racikdetail">PJL00001</td>
        			<th>Tanggal</th>
        			<td id="tgl_racikdetail">20/11/19</td>
        		</tr>
         		<tr>
        			<th>Nama Racikan</th>
        			<td id="nama_racikandetail">Nama Racikan</td>
                    <th>Stok</th>
                    <td id="stk_obatdetail">Stok</td>
        		</tr>
        	</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody id="data_detailracikan">
					<!-- diisi dengan ajax jquery -->
				</tbody>
						<tfoot>
					<tr>
						<th colspan="4" class="text-right">Total :</th>
						<th class="text-right">
							<span id="total_pembeliandetail"></span>
						</th>
					</tr>
				</tfoot>
			</table>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
</div>

<script>
		$("button[name='tombol_detailracikan']").click(function() {
			var kd_racik = $(this).data("kd_racik");
			var tgl_racik = $(this).data("tgl_racik");
			var nama_racikan = $(this).data("nama_racikan");
			var stk_obat = $(this).data("stk_obat");
		$("#kd_racikdetail").html(kd_racik);
		$("#tgl_racikdetail").html(tgl_racik);
		$("#nama_racikandetail").html(nama_racikan);
		$("#stk_obatdetail").html(stk_obat);
		$("#data_detailracikan").html("");
		$.ajax({
			type: "GET",
			url: "ajax/detail.php?page=racikan",
			data: "kd_racik="+kd_racik,
			success : function(data) {
				// console.log(data);
			var total_pembelian = 0;
				var objData = JSON.parse(data);
				$.each(objData, function(key,val){
					// $("#data_detailpjl").append(val.nm_obat+"/"+val.hrg_jual+"/"+val.jml_jual+"/"+val.sat_jual+"/"+val.subtotal+"<br>");
					var baris_baru = '';
					baris_baru += '<tr>';
					baris_baru += '<td>'+val.nm_obat+'</td>';
					baris_baru += '<td class="text-right">'+val.hrg_jual+'</td>';
					baris_baru += '<td class="text-center">'+val.jumlah+'</td>';
					baris_baru += '<td>'+val.sat_jual+'</td>';
					baris_baru += '<td class="text-right">'+val.subtotal+'</td>';
					baris_baru += '</tr>';
					total_pembelian = total_pembelian + Number(val.subtotal);
					$("#data_detailracikan").append(baris_baru);
					$("#total_pembeliandetail").html(total_pembelian);

				})
			}
		});
	});

	$("button[name='tombol_edit']").click(function(){
		var id = $(this).data('id');
		window.location='?page=edit_racikan&id='+id;
	});

 $("button[name='tombol_racik']").click(function() {
        var kd_racik = $(this).data("kd_racik");
        var nama_racikan = $(this).data("nama_racikan");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'akan menghapus obat '+nama_racikan+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Hapus'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=racik",
              data: "kd_racik="+kd_racik,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Obat racikan berhasil di hapus',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                    }).then((ok) => {
			          if (ok.value) {
			            window.location='?page=tabelracikan';
			          }
			        })
              }
            })  
          }
        })
    });

</script>