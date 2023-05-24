<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-light">
		<li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-capsules"></i> Farmasi</li>
	</ol>
</nav>
<div class="page-content">
	<div class="row" style="margin-bottom: 18px;">
		<div class="col-lg-3">
			<?php 
				$query_pblutang = "SELECT no_faktur FROM tbl_pembelian WHERE status_byr='Belum Lunas'";
				$sql_pblutang = mysqli_query($conn, $query_pblutang) or die ($conn->error);
				$jpblutang = mysqli_num_rows($sql_pblutang);
			 ?>
			<div class="card text-white" style="background-color: #876952;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jml T. Pembelian Belum Lunas</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;"><i class="fas fa-shopping-cart "></i>
		        	<?php echo $jpblutang; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php
				$tgl_ini = date('Y-m-d'); 
				$query_pbljtempo = "SELECT no_faktur FROM tbl_pembelian WHERE status_byr='Belum Lunas' AND jth_tempo='$tgl_ini'";
				$sql_pbljtempo = mysqli_query($conn, $query_pbljtempo) or die ($conn->error);
				$jpbljtempo = mysqli_num_rows($sql_pbljtempo);
			 ?>
			<div class="card text-white" style="background-color: #878452;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Pembelian Jth Tempo Hari ini</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;"><i class="fas fa-shopping-cart "></i>
		        	<?php echo $jpbljtempo; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php 
				$query_jproduk = "SELECT kd_obat FROM tbl_dataobat";
				$sql_jproduk = mysqli_query($conn, $query_jproduk) or die ($conn->error);
				$jproduk = mysqli_num_rows($sql_jproduk);
			 ?>
			<div class="card text-white" style="background-color: #87526d;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jumlah Produk Obat</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;"><i class="fas fa-id-card "></i>
		        <?php echo $jproduk; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php 
				$query_jsupp = "SELECT no_supp FROM tbl_supplier";
				$sql_jsupp = mysqli_query($conn, $query_jsupp) or die ($conn->error);
				$jsupp = mysqli_num_rows($sql_jsupp);
			 ?>
			<div class="card text-white" style="background-color: #008080;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jumlah Supplier</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;"><i class="fas fa-id-card "></i>
		        <?php echo $jsupp; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 18px;">
		<div class="col-lg-3">
			<?php 
				$query_jstok = "SELECT kd_obat FROM tbl_dataobat WHERE stk_obat<=minstk_obat";
				$sql_jstok = mysqli_query($conn, $query_jstok) or die ($conn->error);
				$jstok = mysqli_num_rows($sql_jstok);
			 ?>
			<div class="card text-white" style="background-color: #FFD700;">
		      <div class="card-body" style="padding: 5px 5px;color: black">
		        <h6 class="card-title">Jumlah Stok Obat Hampir Habis</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;">
		        	<?php echo $jstok; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php 
				$query_30 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 30 DAY) AND tbl_stokexpobat.stok > 0";
	    	  	$sql_30 = mysqli_query($conn, $query_30) or die ($conn->error);
	    	  	$jml_30 = mysqli_num_rows($sql_30);
			 ?>
			<div class="card text-white" style="background-color: #5a8752;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jml Obat Exp Date < 30 Hari</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;">
		        <?php echo $jml_30; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php 
				$query_10 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>CURDATE() AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0";
	    	  	$sql_10 = mysqli_query($conn, $query_10) or die ($conn->error);
	    	  	$jml_10 = mysqli_num_rows($sql_10);	
			 ?>
			<div class="card text-white" style="background-color: #8c5731;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jml Obat kadaluarsa < 10 Hari</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;">
		        	<?php echo $jml_10; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
		<div class="col-lg-3">
			<?php 
				$query_exp = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp<=CURDATE() AND tbl_stokexpobat.stok > 0";
				$sql_exp = mysqli_query($conn, $query_exp) or die ($conn->error);
				$jexp = mysqli_num_rows($sql_exp);
			 ?>
			<div class="card text-white" style="background-color: #FF0000;">
		      <div class="card-body" style="padding: 5px 5px;">
		        <h6 class="card-title">Jml Obat Telah Kadaluarsa</h6>
		        <div class="card-text" align="right" style="font-size: 25px; font-weight: lighter;">
		        	<?php echo $jexp; ?>
		        </div>
		        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
		      </div>
		    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-6" id="judul">
			<h4><i class="fas fa-capsules"></i> Farmasi Rawat Jalan</h4>
		</div>
		<div class="col-6 text-right">
			<a href="?page=dataobat">
				<button class="btn btn-sm btn-warning"><i class="fas fa-capsules"></i> Master Data Obat</button>
			</a>
			<a href="?page=datasupplier">
				<button class="btn btn-sm btn-success"><i class="fas fa-users"></i> Master Data Suplier</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<div class="row" style="padding: 0 5px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="daftar" class="table table-hover display tabel-data" width="100%">
					<thead>
						<tr style="font-size: 11px">
							<th><center>Antrian</center></th>					
							<th>No Reg/Resep</th>
							<th>Tgl Periksa</th>
							<th>Nama Pasien</th>
							<th>No RM</th>
							<th>Status Obat</th>
							<th>Panggil</th>				
							<th>Obat Non Racik</th>
							<th>Obat Racikan</th>
						</tr>
					</thead>			
				</table>
			</div>
		</div>
	</div>
	<!-- File audio -->
	<audio id="tingtung" src="assets/audio/tingtung.mp3"></audio>
	<!-- Kode Responsive voice -->
 	<script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
 	<!-- <script src="assets/js/jquery-3.6.0.min.js"></script> -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> -->

<script type="text/javascript">
	$(document).ready(function () {
		var table = $("#daftar").DataTable({
			"ajax": {
			"url" : "ajax/load_antrianobat.php",
			"dataSrc" : ""
		},
		"lengthMenu" : [[20, 30, 40, -2], [20, 30, 40, "All"]],
			"order": [[ 0, "desc" ]],
		"columns" : [
			{"data" : "no_antrian",
			"className": "text-center",
      render: function (data, type) {
                var number = $.fn.dataTable.render
                    .number() //String pecahan misal rupiah ,00 Tambahkan kodenya
                    .display(data);

                if (type === "display") {
                    let color = "";
                    // if (data < 250000) { //kondisi
                    //     color = 'red';
                    // } else if (data < 500000) {
                    //     color = 'orange';
                    // } 
                    return "<span style=\"color:red; font-size: 16px; font-weight:bold;\">A-"+ number +"</span>";
                } 
                return number;
              },
				},
			{"data": "no_daftar"},
			{"data": "tgl_daftar"},
			{"data" : "nama_pas"},
			{"data" : "nomor_rm"},
			{"data" : null,
	      	"width": '100px',
	        "className": 'text-center',
	        "render": function (data, row, type) {
	              // jika tidak ada data "status_obat"
	              let status_obat = '';
	              //jika data "status_obat = Belum dilayani"
	              if (data.status_obat == "Belum dilayani") {
	                // tampilkan button panggil
	                status_obat += "<a style=\"padding: 8px; font-size: 11px;\" class=\"badge badge-pill badge-warning\"> Belum dilayani</a>";
	              } 
	              // jika data "status_obat = Selesai"
	              else if (data.status_obat == "Selesai") {
	                // tampilkan button ulangi panggilan
	                status_obat += "<a style=\"padding: 8px; font-size: 11px; color: #ffff;\" class=\"badge badge-pill badge-success\">Obat diserahkan</a>";
	              }
	              return status_obat;
	      		}
	    	},
	    	{"data" : "no_daftar",
	      	"width": '100px',
	      	"className": 'text-center',
	      	"render": function (data, row, type) {
	      		var btn = "<button class=\"btn btn-success btn-sm btnPanggil\" style=\"font-size:11px\" href=\"#\"><i class=\"fas fa-bullhorn\"></i> Panggil</button>";
	      		return btn;
	      		}
	    	},
	    	{"data" : null,
	    	"width": '100px',
        	"className": 'text-center',
	        "render": function (data, row, type) {
	        		var btn = "<a style=\"margin-right:7px; font-size: 11px;\" title=\"Obat Non Racikan\" class=\"btn btn-primary btn-sm btnNracik\" href=\"#\"><i class=\"fas fa-pills\"></i> Non Racik</a>";
	        		return btn;
	      		}	            
	    	},
			{"data" : null,
			"width": '100px',
        	"className": 'text-center',
	        "render": function (data, row, type) {
	        		var btn = "<a style=\"margin-right:7px; font-size: 11px;\" title=\"Obat Racikan\" class=\"btn-transition btn btn-danger btn-sm btnRacik\" href=\"#\"><i class=\"fas fa-mortar-pestle\"></i> Racikan</a>";
	        		return btn;
	      		}	            
	    	},	
	    ],   
	})
		setInterval(function() {
		table.ajax.reload(null, false);
  	}, 10000); //request update data per 1000 = 1 detik
	$('#daftar tbody').on('click', '.btnPanggil', function() {
		var data = table.row( $(this).parents('tr') ).data();
        var id = data['no_antrian'];
        var bell = document.getElementById('tingtung');

        // mainkan suara bell antrian
        bell.pause();
        bell.currentTime = 0;
        bell.play();
       
        // set delay antara suara bell dengan suara nomor antrian
        durasi_bell = bell.duration * 770;

        // mainkan suara nomor antrian
        setTimeout(function() {
          responsiveVoice.speak("Nomor Antrian A, " +data['no_antrian']+ ", silahkan mengambil Obat", "Indonesian Male", {
            rate: 0.9,
            pitch: 1,
            volume: 1
          });
        }, durasi_bell);

        // proses update data
        // $.ajax({
        //   type: "POST",               // mengirim data dengan method POST
        //   url: "panggilan-antrian/update.php",          // url file proses update data
        //   data: { id: id }            // tentukan data yang dikirim
        // });
      });
	$('#daftar tbody').on('click', '.btnNracik', function() {
      	var data = table.row( $(this).parents('tr') ).data();
      	//var id = data['no_daftar'];
				window.location='?page=farmasiorderobat&id='+data['no_daftar'];
      });
	$('#daftar tbody').on('click', '.btnRacik', function() {
      	var data = table.row( $(this).parents('tr') ).data();
      	//var id = data['no_daftar'];
				window.location='?page=farmasiobatracik&id='+data['no_daftar'];
      });

	});
	</script>
	<script type="text/javascript">
		$("button[name='tombol_detail']").click(function(){
			var kode = $(this).data('kode');
			var nama = $(this).data('nama');
			var keluhan = $(this).data('keluhan');
			var tb = $(this).data('tb');
			var bb = $(this).data('bb');
			var temp = $(this).data('temp');
			var asuransi = $(this).data('asuransi');
			var diagnosa = $(this).data('diagnosa');

			$("#det_kode").html(kode);
			$("#det_nama").html(nama);
			$("#det_keluhan").html(keluhan);
			$("#det_tb").html(tb);
			$("#det_bb").html(bb);
			$("#det_temp").html(temp);
			$("#det_asuransi").html(asuransi);
			$("#det_diagnosa").html(diagnosa);

		});


		$("button[name='tombol_edit']").click(function() {
			var id = $(this).data('id');
			window.location='?page=edit_pendaftaran&id='+id;
		});


		$("button[name='tombol_hapus']").click(function() {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
		// alert(id);
		if(id==id_session) {
			Swal.fire({
				title: 'Error !',
				text: 'Anda tidak bisa menghapus data anda sendiri, mintalah admin atau manajer untuk menghapusnya',
				type: 'error',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK'
			}).then((baik) => {
				if (baik.value) {

				}
			})
		} else {
			Swal.fire({
				title: 'Apakah Anda Yakin?',
				text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya'
			}).then((hapus) => {
				if (hapus.value) {
					$.ajax({
						type: "POST",
						url: "ajax/hapus.php?page=datapendaftaran",
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
									window.location='?page=datapendaftaran';
								}
							})
						}
					})  
				}
			})
		}
	});

		$("button[name='tombol_obatpasien']").click(function() {
			var id = $(this).data('id');
			window.location='?page=farmasiorderobat&id='+id;
		});

		$("button[name='tombol_obatracik']").click(function() {
			var id = $(this).data('id');
			window.location='?page=farmasiobatracik&id='+id;
		});

		$("button[name='tombol_tindakan']").click(function() {
			var id = $(this).data('id');
			window.location='?page=entry_tindakanpasien&id='+id;
		});
	</script>