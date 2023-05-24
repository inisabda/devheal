<?php
include "../koneksi.php";

if ($_POST) {
    $q = $_POST['search'];
        $result = "select id_akai,aturan_pakai from tbl_akai where id_akai like '%$q%' or aturan_pakai like '%$q%' order by id_akai LIMIT 5 ";
            $found = mysqli_query($conn, $result);
while($row = mysqli_fetch_array($found)) {

/*    $sql_res = mysqli_query("select id_akai,aturan_pakai from tbl_akai where id_akai like '%$q%' or aturan_pakai like '%$q%' order by id_akai LIMIT 5");
    while ($row = mysqli_fetch_array($sql_res)) {*/
        $id_akai = $row['id_akai'];
        $nama = $row['aturan_pakai'];
        $b_id_akai = '<strong>' . $q . '</strong>';
        $b_nama = '<strong>' . $q . '</strong>';
        $final_id_akai = str_ireplace($q, $b_id_akai, $id_akai);
        $final_nama = str_ireplace($q, $b_nama, $nama);
        ?>
        <div class="show" align="left">
            <span class="id"><?php echo $final_id_akai; ?></span>&nbsp;<br/>
            <span class="nama"><?php echo $final_nama ?><br/>
        </div>
        <?php
    }
}
?>

