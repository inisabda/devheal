<?php 
	session_start();
	include "../koneksi.php";

	$nik =   $_GET['nik'];
	$endpoint = "pcare/pesertaByNik/$nik";
	$data = getRequestPcare($endpoint);
	// var_dump($data); die();
	echo $data;
