<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Laporan Pasien</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-12"><h4><i class="fas fa-print"></i> Laporan Data <?php echo $nama_klinik; ?></h4>
        </div>
    </div>
    <div class="table-container">
        <div class="row" style="padding: 0 100px;">
            <div class="col-md-12 vertical-form table-responsive">
                <table class="table table-striped display">
                    <thead>
                        <tr>
                            <th width="2%">No.</th>  
                            <th width="50%">Nama Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Laporan Kunjungan Pasien Rawat Jalan Per Bulan</td>
                            <td><a href="?page=laporpasien"><button class="btn btn-sm btn-success">Proses</button></a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Laporan Pendapatan Klinik Rawat Jalan Per Bulan</td>
                            <td><a href="?page=laporpendapatan"><button class="btn btn-sm btn-success">Proses</button></a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Laporan Penjualan Obat Apotek Per Bulan</td>
                            <td><a href="?page=laporpenjualan_apotek"><button class="btn btn-sm btn-success">Proses</button></a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Laporan Pembelian Obat Apotek Per Bulan</td>
                            <td><a href="?page=laporpembelian_apotek"><button class="btn btn-sm btn-success">Proses</button></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
