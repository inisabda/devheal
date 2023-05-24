<?php
# create database connection
$connect = mysqli_connect("localhost","root","","klinik_project");
if(!empty($_POST["ip_kdobat"])) {
  $query = "SELECT * FROM tbl_dataobat WHERE kd_obat='" . $_POST["ip_kdobat"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='font-size:14px; color:red; font-style:italic'> Kode Obat sudah ada, silahkan masukkan kode lain nya.</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }else{
    echo "<span style='font-size:14px; color:green; font-style:italic''> Kode Obat bisa dimasukkan. (Kode yang mudah diingat)</span>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }
}
?>