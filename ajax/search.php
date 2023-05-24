
<div class="table-container">
    <table id="example" class="table table-striped display tabel-data">
        <thead>
            <tr>
                <th>No.</th>
                <th>Opsi</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>No RM</th>
                <th>Jenis Kelamin</th>      
                <th>NIK</th>
                <th>No HP</th>
                <th>Riwayat Kunjungan</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include "../koneksi.php";

            $nama_pas=$_POST["nama_pas"];
            $nomor_rm=$_POST["nomor_rm"];
            $no_hp =$_POST["no_hp"];
            $nik =$_POST["nik"];
            $no_urut = 0;

            $result = "SELECT * FROM tbl_pasien where nama_pas like '%$nama_pas%' OR nomor_rm like '%$nomor_rm%' OR no_hp like '%$no_hp%' OR nik like '%$nik%' ";
            $found = mysqli_query($conn, $result);
            if(mysqli_num_rows($found) > 0) {

                /* if($found > 0){*/
                 while($data = mysqli_fetch_array($found)) {
                     $no_urut++;
                     echo "<tr>
                     <td>$no_urut .</td>
                     <td class='td-opsi'><button class='btn btn-danger btn-sm' title='Lanjut pendaftaran' id='tombol_daftar' name='tombol_daftar' data-id=".$data['id_pas']."> Proses</button></td>
                     <td>".$data['nama_pas']."</td>
                     <td width='20%'>".$data['alm_pas']."</td>
                     <td>".$data['tpt_lahir'].", ".date('d-m-Y', strtotime($data['lhr_pas']))."</td>
                     <td>".$data['nomor_rm']."</td>
                     <td>".$data['jk_pas']."</td>
                     <td>".$data['nik']."</td>                    
                     <td>".$data['no_hp']."</td>
                     <td class='td-opsi'><button class='btn-transition btn btn-outline-danger btn-lg' title='Riwayat Kunjungan' id='tombol_kunjungan' name='tombol_kunjungan' data-id=".$data['id_pas']."> Riwayat Kunjungan</button></td>
                     <tr>";
                 }

             }else{
                echo "<center><font color='#d33'>Pasien tidak ditemukan / belum terdaftar ...!!!</font></center>";
            }

            ?>
        </tbody>
    </table>
</div>

<script>

    $("button[name='tombol_daftar']").click(function() {
        var id = $(this).data('id');
        window.location='?page=daftar_pasien&id='+id;
    });

    $("button[name='tombol_kunjungan']").click(function() {
        var id = $(this).data('id');
        window.open('?page=riwayatperiksa&id='+id, '_blank');
    });
</script>