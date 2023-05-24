<table class="table table-striped display tabel-data">
    <thead>
        <tr class="bg-warning">
            <th>No</th>
            <th>No Resep</th>
            <th>Nama Obat</th>
            <th>Aturan Pakai</th>
            <th>Jml</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <?php
        include "../koneksi.php";
        $no_daftar = @$_GET['id'];
        $totalBayar = 0;
        $keterangan = "Tidak ada data obat";
        $nomor = 1;
        $query_pjlobat = "SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_pengobatan.keterangan, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
          LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
          LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat

        WHERE no_daftar ='$no_daftar' ";
        $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
     ?>
    <tbody>
        <?php  
            while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
            $subtotal   = $data_pjlobat['subtotal'];
            $totalBayar = $totalBayar + $subtotal;
            $keterangan = $data_pjlobat['keterangan'];
        ?>
            <tr>
                <td><?php echo $nomor++; ?>.</td>
                <td><?php echo $data_pjlobat['no_pengobatan']; ?></td>
                <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                <td><?php echo $data_pjlobat['akai']; ?></td>
                <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                <td>Rp. <?php echo number_format($data_pjlobat['hrg_jual'],2,',','.'); ?></td>
                <td>Rp. <?php echo number_format($data_pjlobat['subtotal'],2,',','.'); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="6" align="right" bgcolor="#F5F5F5">Total Obat Oral :</td>
            <td colspan="1" align="left" bgcolor="#F5F5F5">Rp. <?php echo number_format($totalBayar,2,',','.'); ?></td>
        </tr>
    </tbody>                          
</table>
<table>
    <tr>
        <td width="130"><b>Keterangan</b></td>
        <td width="10"><b> :</b></td>
        <td><font color='#d33'> <?php echo $keterangan; ?></font></td>
    </tr>
</table>