<div class="table-container">
    <table id="example" class="table table-striped display tabel-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Tempat, Tgl Lahir</th>
                <th>J.Kelamin</th>
                <th>Pekerjaan</th>
                <th>Nomor RM</th>
                <th></th>                    
            </tr>
        </thead>
        <tbody>
            <?php
                error_reporting(0);
                include "../koneksi.php";
                $nama_pas=$_POST["nama_pas"];
                $nomor_rm=$_POST["nomor_rm"];
                $alm_pas=$_POST["alm_pas"];
                $tpt_lahir=$_POST["tpt_lahir"];
                $lhr_pas=$_POST["lhr_pas"];
                $jk_pas=$_POST["jk_pas"];
                $pekerjaan=$_POST["pekerjaan"];
                $nomor = 1;
                
                $result = "SELECT * FROM tbl_pasien where nama_pas like '%$nama_pas%' OR nomor_rm like '%$nomor_rm%' ";
             	$found = mysqli_query($conn, $result);    
                if(mysqli_num_rows($found) > 0) {
                    /* if($found > 0){*/
              	while($data = mysqli_fetch_array($found)) { 
                     
                echo "<tr>
                        <td>".$nomor++.".</td>
                        <td><button class='btn btn-link' style='padding: 4px; font-size: 11px; text-align: left;' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'
                            data-nama_pas='$data[nama_pas]'
                            data-alm_pas='$data[alm_pas]'
                            data-tpt_lahir='$data[tpt_lahir]'
                            data-lhr_pas='$data[lhr_pas]'
                            data-jk_pas='$data[jk_pas]'
                            data-pekerjaan='$data[pekerjaan]'
                            data-nomor_rm='$data[nomor_rm]'>".$data['nama_pas']."
                            </button></td>
                        <td>".$data['alm_pas']."</td>
                        <td>".$data['tpt_lahir'].", ".date('d-m-Y', strtotime($data['lhr_pas']))."</td>
                        <td>".$data['jk_pas']."</td>
                        <td>".$data['pekerjaan']."</td>
                        <td>".$data['nomor_rm']."</td>                   
                        <td class='td-opsi'>
                            <button class='btn-transition btn btn-outline-info btn-sm' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'                   
                            data-nama_pas='$data[nama_pas]'
                            data-alm_pas='$data[alm_pas]'
                            data-tpt_lahir='$data[tpt_lahir]'
                            data-lhr_pas='$data[lhr_pas]'
                            data-jk_pas='$data[jk_pas]'
                            data-pekerjaan='$data[pekerjaan]'
                            data-nomor_rm='$data[nomor_rm]'>Pilih</button>
                        </td>
                      <tr>";
                 }
                       
                 }else{
                    echo "<center><i>Nama Pasien tidak ditemukan ....!!</i></center>";
                 }
            ?>
        </tbody>
    </table>
</div>

<script>
   
   $("button[name='tombol_daftar']").click(function() {      

        var nama_pas = $(this).data('nama_pas');
        var nomor_rm = $(this).data('nomor_rm');
        var alm_pas = $(this).data('alm_pas');
        var tpt_lahir = $(this).data('tpt_lahir');
        var lhr_pas = $(this).data('lhr_pas');
        //var diagnosa = $(this).data('diagnosa');
        var pekerjaan = $(this).data('pekerjaan');
        var jk_pas = $(this).data('jk_pas');        

        $("#nama_pas").val(nama_pas);
        $("#nomor_rm").val(nomor_rm);
        $("#alm_pas").val(alm_pas);
        $("#tpt_lahir").val(tpt_lahir);
        $("#lhr_pas").val(lhr_pas);
        $("#jk_pas").val(jk_pas);  
        $("#pekerjaan").val(pekerjaan);        

     $("#modal_pasien").modal("hide");
    });
        $("#nama_pas").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert(berhasil);
        }
    })

</script>