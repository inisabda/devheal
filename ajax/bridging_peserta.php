<?php
session_start();
include "../koneksi.php";

if (@$_GET['nik'] != "") {
	$nik =   $_GET['nik'];
	$endpoint = "pcare/pesertaByNik/$nik";
	$data = getRequestPcare($endpoint);
	echo $data;
} else {
	$noka =   $_GET['noka'];
	$endpoint = "pcare/pesertaByNoka/$noka";
	$data = getRequestPcare($endpoint);
	echo $data;
}
