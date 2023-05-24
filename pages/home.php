<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"></i> Home</li>
  </ol>
</nav>
<div class="page-content">
	<div>
		<div class="col-12"><h5>Selamat Datang <font color="#FF0000"><?php echo $_SESSION['nama_peg']; ?> </font><i class="far fa-smile"></i></h5></div>
	</div>
	
	<div class="konten-home" style="margin-top: 25px;">
		<div class="row" style="margin-bottom: 18px;">
			<div class="col-lg-2" >
				<?php 
					$tgl_ini = date('Y-m-d');
					$query_pasien = "SELECT Count(no_antrian) AS total FROM tbl_daftarpasien WHERE tgl_daftar = '$tgl_ini'";
					$sql_pasien = mysqli_query($conn, $query_pasien) or die ($conn->error);
					$dpasien = mysqli_fetch_array($sql_pasien);
					$tpasien = $dpasien['total'];
				 ?>
				<div class="card text-white" style="background-color: #1ad5d7; ">
			      <div class="card-body" style="padding: 5px 5px;color: black">
			        <h6 class="card-title" style="font-size:12px;">Total Pasien Hari ini</h6>
			        <div class="card-text" align="left" style="font-size: 19px; font-weight: lighter; color: black; height:40px;"><a href="?page=datapendaftaran"><i class="fas fa-user-circle"></i></a>
			        	<b><?php echo number_format($tpasien); ?> Pasien</b>
			        </div>
			      </div>
			    </div>
			</div>
			<div class="col-lg-2">
				<?php 
					$kunj_bulanan = 0; 
					$query_bulan = "SELECT MONTH(tgl_daftar) AS bulan, COUNT(*) AS jumlah_bulanan FROM tbl_daftarpasien WHERE MONTH(tgl_daftar)=MONTH(CURDATE()) GROUP BY month(tgl_daftar)";
					$sql_bulan = mysqli_query($conn, $query_bulan) or die ($conn->error);
					while($bpasient = mysqli_fetch_array($sql_bulan)){
				 		$kunj_bulanan = $bpasient['jumlah_bulanan'];
				 	}
				 ?>
				<div class="card text-white" style="background-color: #90EE90; ">
			      <div class="card-body" style="padding: 5px 5px;color: black">
			        <h6 class="card-title" style="font-size:12px;">Total Pasien Bulan Ini</h6>
			        <div class="card-text" align="left" style="font-size: 19px; font-weight: lighter; color: black; height:40px;"><a href="?page=datapendaftaran"><i class="fas fa-user-check"></i></a>
			        	<b><?php echo number_format($kunj_bulanan); ?>Pasien</b>
			        </div>
			      </div>
			    </div>
			</div>
			<div class="col-lg-2">
				<?php 
					$query_pasient = "SELECT YEAR(tgl_daftar) AS tahun, COUNT(*) AS jumlah_tahunan FROM tbl_daftarpasien WHERE YEAR(tgl_daftar)=YEAR(CURDATE()) GROUP BY YEAR(tgl_daftar)";
					$sql_pasient = mysqli_query($conn, $query_pasient) or die ($conn->error);
					$dpasient = mysqli_fetch_array($sql_pasient);
					$thpasien = $dpasient['jumlah_tahunan'];
				 ?>				 
				<div class="card text-white" style="background-color: #FFA500; ">
			      <div class="card-body" style="padding: 5px 5px;color: black">
			        <h6 class="card-title" style="font-size:12px;">Total Pasien Tahun Ini</h6>
			        <div class="card-text" align="left" style="font-size: 20px; font-weight: lighter; color: black; height:40px;"><a href="?page=datapendaftaran"><i class="fas fa-user-check"></i></a> <b><?php echo number_format($thpasien); ?></b>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>		
			<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Dokter2') { ?>
			<div class="col-lg-2">
				<?php 
					$tgl_ini = date('Y-m-d');
					$query_totransaksi = "SELECT SUM(total_penjualan) AS total_penjualan FROM tbl_transaksi WHERE tgl_transaksi = '$tgl_ini'";
					$sql_totransaksi = mysqli_query($conn, $query_totransaksi) or die ($conn->error);
					$dtransaksi = mysqli_fetch_array($sql_totransaksi);
					//$diskon = $dtransaksi['diskon'];
					$total = $dtransaksi['total_penjualan'];
					$total_transaksi = $dtransaksi['total_penjualan'];
				 ?>
				<div class="card text-white" style="background-color: #58898c;">
			      <div class="card-body" style="padding: 5px 5px;">
			        <h6 class="card-title" style="font-size:12px;">Billing Klinik Hari ini</h6>
			        <div class="card-text" align="left" style="font-size: 20px; font-weight: lighter; height:40px;">
			        	Rp. <?php echo number_format($total_transaksi); ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>			
			<div class="col-lg-2">
				<?php 
					$query_tpembelian = "SELECT SUM(total_pembelian) AS total_pbl FROM tbl_pembelian WHERE tgl_pembelian = '$tgl_ini'";
					$sql_tpembelian = mysqli_query($conn, $query_tpembelian) or die ($conn->error);
					$dpembelian = mysqli_fetch_array($sql_tpembelian);
					$tpembelian = $dpembelian['total_pbl'];
				 ?>
				 <?php 
					$tgl_ini = date('Y-m-d');
					$query_tpenjualan = "SELECT SUM(total_penjualan) AS total FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_ini'";
					$sql_tpenjualan = mysqli_query($conn, $query_tpenjualan) or die ($conn->error);
					$dpenjualan = mysqli_fetch_array($sql_tpenjualan);
					$tpenjualan = $dpenjualan['total'];
				 ?>
				<div class="card text-white" style="background-color: #03ac31;">
			      <div class="card-body" style="padding: 5px 5px;">
			        <h6 class="card-title" style="font-size:12px;">Billing Apotik Hari ini</h6>
			        <div class="card-text" align="left" style="font-size: 12px; font-weight: lighter; height:39px;">
			        	Beli Obat: Rp. <?php echo number_format($tpembelian,0,',','.'); ?> <br>
			        	Jual Obat: Rp. <?php echo number_format($tpenjualan,0,',','.'); ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-2">
				<?php 
					$query_billing = "SELECT SUM(total_penjualan) AS total FROM tbl_daftarpasien AS u INNER JOIN tbl_transaksi AS i ON u.no_daftar = i.no_daftar INNER JOIN tbl_pegawai AS a ON u.id_peg = a.id_peg WHERE MONTH(u.tgl_daftar)";
					$sql_billing = mysqli_query($conn, $query_billing) or die ($conn->error);
					$dbilling = mysqli_fetch_array($sql_billing);
					$tbilling = $dbilling['total'];
				 ?>
				<div class="card text-white" style="background-color: #66CDAA;">
			      <div class="card-body" style="padding: 5px 5px;">
			        <h6 class="card-title" style="font-size:12px;">Total Semua Transaksi</h6>
			        <div class="card-text" align="left" style="font-size: 18px; font-weight: lighter; height:39px"><i class=""></i>Rp. 
			        <?php echo  number_format($tbilling,0,',','.'); ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<?php } ?>
		</div>
	</div>
    <?php 
        $tgl_ini = date('Y-m-d');
        $query_tpenjualan = "SELECT SUM(total_penjualan) AS total FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_ini'";
        $sql_tpenjualan = mysqli_query($conn, $query_tpenjualan) or die ($conn->error);
        $dpenjualan = mysqli_fetch_array($sql_tpenjualan);
        $tpenjualan = $dpenjualan['total'];
     ?>

	<?php
		$thpasien = 0; 
		$query_pasient = "SELECT YEAR(tgl_daftar) AS tahun, COUNT(*) AS jumlah_tahunan FROM tbl_daftarpasien WHERE YEAR(tgl_daftar)=YEAR(CURDATE()) GROUP BY YEAR(tgl_daftar)";
		$sql_pasient = mysqli_query($conn, $query_pasient) or die ($conn->error);
		while($dpasient = mysqli_fetch_array($sql_pasient)){
		$thpasien = $dpasient['jumlah_tahunan'];
		}
	 ?>
    <style>
        .canvas {
            padding: 20px;
            height: 350px;
            /*width: 90%;*/
        }
    </style>
    <div class="canvas">
        <canvas id="myChart">
        
        </canvas>
    </div>
    <?php 
        $tgl_ini = date('Y-m-d');
        $query_tpenjualan = "SELECT count(total_penjualan) AS total FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_ini'";
        $sql_tpenjualan = mysqli_query($conn, $query_tpenjualan) or die ($conn->error);
        $dpenjualan = mysqli_fetch_array($sql_tpenjualan);
        $tpen = $dpenjualan['total'];
     ?>
	<?php 
	 $tgl_ini = date('Y-m-d');
		$query_tpemb = "SELECT COUNT(total_pembelian) AS total_pbl FROM tbl_pembelian WHERE tgl_pembelian = '$tgl_ini'";
		$sql_tpembelian = mysqli_query($conn, $query_tpemb) or die ($conn->error);
		$dpembelian = mysqli_fetch_array($sql_tpembelian);
		$tpem = $dpembelian['total_pbl'];
	 ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
			/* labels: ["EEG","Total Pasien Covid", "Pasien Covid PerBulan"],*/
                datasets: [{
                    label: 'Pola Data Penjualan',
                    fill: false,
                    // borderDash: [5, 5],
                    data: <?php echo json_encode($tpen); ?>,
                    backgroundColor: [
                        'rgba(0, 255, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(0, 255, 0, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Pola Data Pembelian',
                    fill: false,
                    // borderDash: [5, 5],
                    data: <?php echo json_encode($tpem); ?>,
                    backgroundColor: [
                        'rgba(0, 0, 255, 0.1)'
                    ],
                    borderColor: [
                        'rgba(0, 0, 255, 1)'
                    ],
                    borderWidth: 1
                },
                    {
                    label: 'Pasien Hari ini',
                    fill: false,
                    // borderDash: [5, 5],
                    data: <?php echo json_encode($tpasien); ?>,
                    backgroundColor: [
                        'rgba(20, 310, 255, 0.4)'
                    ],
                    borderColor: [
                        'rgba(10, 0, 255, 20)'
                    ],
                    borderWidth: 1
                },
                    {
                    label: 'Data Pasien Tahun ini',
                    fill: false,
                    // borderDash: [5, 5],
                    data: <?php echo json_encode($thpasien); ?>,
                    backgroundColor: [
                        'rgba(255,215,0, 1.7)'
                    ],
                    borderColor: [
                        'rgba(40, 0, 255, 20)'
                    ],
                    borderWidth: 1
                }
                ]
           },


            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
  
		<div class="row" style="margin-bottom: 18px;">
			
		</div>
		
	</div>
</div>
