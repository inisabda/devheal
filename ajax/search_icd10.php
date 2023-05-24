<div class="table-container">
        <table id="example" class="table table-hover display tabel-data">
            <thead>
                <tr>
                    <th>Kode ICD</th>
                    <th>Diagnosa ICD 10</th>
                    <th>Deskripsi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>

<?php
error_reporting(0);
 include "../koneksi.php";

    $code=$_POST["code"];
    $diagnosa=$_POST["diagnosa"];
    $deskripsi =$_POST["deskripsi"];
    $id_icd =$_POST["id_icd"];    
    $result = "SELECT * FROM tbl_icd10 where code like '%$code%' OR diagnosa like '%$diagnosa%' ";
	$found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
  			while($data = mysqli_fetch_array($found)) {
       
    echo "
        <tr>
             <td>".$data['code']."</td>
             <td><button class='btn btn-link' style='padding: 4px; font-size: 11px; text-align: left;' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'
                    data-id_icd=".$data['id_icd']."
                    data-code='$data[code]'
                    data-diagnosa='$data[diagnosa]'  
                    data-deskripsi='$data[deskripsi]'>".$data['diagnosa']."
                </button>
             </td>
             <td>".$data['deskripsi']."</td>
             <td class='td-opsi'>
                <button class='btn-transition btn btn-outline-info btn-sm' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'
                    data-id_icd=".$data['id_icd']."
                    data-code='$data[code]'
                    data-diagnosa='$data[diagnosa]'  
                    data-deskripsi='$data[deskripsi]'>Pilih</button>
                </td>
        <tr>";
 }


       
 }else{
    echo "<center><i>Tidak ada jenis diagnosa yang ditemukan ....!!</i></center>";
 }

?>
    </tbody>
</table>
</div>

<script>
    $(document).ready(function() {
        $('#tabel_dataicd10').DataTable({
          // ordering: false,
          lengthMenu : [[30, 50, 100, -1], [30, 50, 100, "All"]],
          order: [[1, "asc"]]
        });
    });
   
   $("button[name='tombol_daftar']").click(function() {
      

        var id_icd=$(this).data('id_icd');
        var code = $(this).data('code');
        var diagnosa = $(this).data('diagnosa');
        var deskripsi= $(this).data('deskripsi');
        

        $("#id_icd").val(id_icd);
        $("#code").val(code);
        $("#diagnosa").val(diagnosa);
        $("#deskripsi").val(deskripsi);
        

     $("#modal_diagnosa").modal("hide");
    });
        $("#id_icd").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert(berhasil);
        }
    })

       

</script>