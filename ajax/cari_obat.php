
<?php 
    session_start();
    include "../koneksi.php";
if ($_POST) {
    $q = $_POST['search'];

    $sql_res  = mysqli_query($conn, "select kd_obat, nm_obat, stk_obat from tbl_obatracik where kd_obat like '%$q%' or nm_obat like '%$q%' order by kd_obat LIMIT 5");

        while ($row = mysqli_fetch_array($sql_res)) {
        $kd_obat = $row['kd_obat'];
        $nama = $row['nm_obat'];
        /* $hrg_obat = $row['hrg_obat'];*/
        $stok = $row['stk_obat'];
        $b_kd_obat = '<strong>' . $q . '</strong>';
        $b_nama = '<strong>' . $q . '</strong>';
        $b_stok = '<strong>' . $q . '</strong>';
        $final_kd_obat = str_ireplace($q, $b_kd_obat, $kd_obat);
        $final_nama = str_ireplace($q, $b_nama, $nama);
        $final_stok = str_ireplace($q, $b_stok, $stok);
        ?>
        <div class="show" align="left">
            <span class="id"><?php echo $final_kd_obat; ?></span>&nbsp;<br/>
            <span class="nama"><?php echo $final_nama ?></span><br/>
            <span class="stok"><?php echo $final_stok ?></span><br/>
        </div>
        <?php
    }
}
?>

