<h5><center><i class="fas fa-pills"></i> Komposisi Obat Racik Pasien</center></h5>
<table class="table table-striped display tabel-data">
    <thead>
        <tr class="bg-warning">
            <th>No</th>
            <th>No. Resep</th>
            <th>Nama Obat</th>
            <th>Jml</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <?php 
        require_once "../koneksi.php";
        $no_daftar = @$_GET['id'];
        $tgl_sekarang = date('Y-m-d');
        $totel_bayar = 0;
        //$nama_racikan = 0;
        $keterangan = "Belum ada data";
        $jumlah_puyer = 0;
        $pakai = "Belum ada data";
        $nomor = 1;
        $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.total_penjualan, tbl_racikan.nama_racikan, tbl_racikan.akai, tbl_racikan.keterangan, tbl_racikan.jml_puyer, tbl_racikan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_racikandetail
          LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
          LEFT JOIN tbl_dataobat ON tbl_racikandetail.kd_obat=tbl_dataobat.kd_obat

        WHERE no_daftar ='$no_daftar' ";
        $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
     ?>
    <tbody>
    <?php  
        while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
            $subtotal   = $data_pjlobat['subtotal'];
            $totel_bayar = $totel_bayar + $subtotal;
            $total_racik = $data_pjlobat['total_penjualan'];
            //$nama_racikan = $data_pjlobat['nama_racikan'];
            $keterangan = $data_pjlobat['keterangan'];
            $jumlah_puyer = $data_pjlobat['jml_puyer'];
            $pakai = $data_pjlobat['akai'];
    ?>
        <tr>
            <td><?php echo $data_pjlobat['no']; ?></td>
            <td><?php echo $data_pjlobat['no_pengobatan']; ?></td> 
            <td><?php echo $data_pjlobat['nm_obat']; ?></td>
            <td><?php echo $data_pjlobat['jml_jual']; ?></td>
            <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
            
        </tr>
    <?php } ?>
    <tr>
        <td colspan="4" align="right" bgcolor="#F5F5F5">Total Obat Racik:</td>
        <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totel_bayar,2,',','.'); ?></td>
    </tr>
    </tbody>
</table>        
<table>
    <tr>
        <td width="130"><b>Jumlah Puyer</b></td>
        <td width="10"><b> :</b></td>
        <td> <?php echo $jumlah_puyer; ?> Bungkus</td>
    </tr>
    <tr>
        <td width="130"><b>Aturan Minum</b></td>
        <td width="10"><b> :</b></td>
        <td> <?php echo $pakai; ?></td>
    </tr>
    <tr>
        <td width="130"><b>Keterangan</b></td>
        <td width="10"><b> :</b></td>
        <td><font color='#d33'> <?php echo $keterangan; ?></font></td>
    </tr>
</table>