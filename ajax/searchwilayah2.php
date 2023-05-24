
<div class="table-container">
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>Kelurahan/Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Kodepos</th>
                    <th>Opsi</th>
                        </tr>
            </thead>
            <tbody>

<?php
 include "../koneksi.php";
 /*
echo "
<div class='table-container'>
		<table id='example2' class='table table-striped display tabel-data'>
			<thead>
            <th>Nomor RM</th>
            <th>Nama Pasien</th>
            <th>Jenis Kelamin</th>
            <th>Asuransi</th>
            <th>Tgl Lahir</th>
               
        </tr>
</thead>
		    <tbody>
        ";*/


 $desa=$_POST["desa"];
  $kec=$_POST["kec"];
    $kab_kota =$_POST["kab_kota"];
     $provinsi =$_POST["provinsi"];
     $poscode =$_POST["poscode"];

      $result = "SELECT * FROM regionalvisiter where desa like '%$desa%' OR kec like '%$kec%' OR kab_kota like '%$kab_kota%' OR provinsi like '%$provinsi%' OR poscode like '%$poscode%' ";
 

			$found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
  			while($data = mysqli_fetch_array($found)) {
       
    echo "<tr>
     <td>".$data['desa']."</td>
     <td>".$data['kec']."</td>
     <td>".$data['kab_kota']."</td>
     <td>".$data['provinsi']."</td>     
     <td>".$data['poscode']."</td>
                    <td class='td-opsi'>
                      <button class='btn-transition btn btn-outline-dark btn-sm' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'
                            data-kode_id=".$data['kode_id']."
                            data-desa='$data[desa]'
                            data-kec='$data[kec]'  
                            data-kab_kota='$data[kab_kota]' 
                            data-provinsi='$data[provinsi]' 
                            data-poscode='$data[poscode]'>pilih</button>

                    </td>



  <tr>";
 }


       
 }else{
    echo "<li>Tidak ada artikel yang ditemukan <li>";
 }

?>
</table>

<script>
   
   $("button[name='tombol_daftar']").click(function() {
      

        var kode_id=$(this).data('kode_id');
        var desa = $(this).data('desa');
        var kec = $(this).data('kec');
        var kab_kota= $(this).data('kab_kota');
        var provinsi= $(this).data('provinsi');
        var poscode= $(this).data('poscode');

        $("#kode_id").val(kode_id);
        $("#desa").val(desa);
        $("#kec").val(kec);
        $("#kab_kota").val(kab_kota);
        $("#provinsi").val(provinsi);
    $("#poscode").val(poscode);

     $("#modal_datawilayah").modal("hide");
    });
        $("#kode_id").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert(berhasil);
        }
    })

       

</script>