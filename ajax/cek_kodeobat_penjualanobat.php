<?php
# create database connection
$connect = mysqli_connect($_SERVER["DB_HOST"],  $_SERVER["DB_USER"],$_SERVER["DB_PASSWORD"],$_SERVER["DB_NAME"]);
if(!empty($_POST["kode_obat"])) {
  $query = "SELECT * FROM tbl_dataobat WHERE kd_obat='" . $_POST["kode_obat"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='font-size:14px; color:red; font-style:italic'> Kode Obat sudah ada, silahkan masukkan kode lain nya.</span>";
    echo "<script>$('#simpan_pembelian').prop('disabled',true);</script>";
  }else{
    echo "<span style='font-size:14px; color:green; font-style:italic''> Kode Obat bisa dimasukkan. (Kode yang mudah diingat)</span>";
    echo "<script>$('#simpan_pembelian').prop('disabled',false);</script>";
  }
}
?>