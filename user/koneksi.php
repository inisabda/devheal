
<?php

require __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
// deklarasi parameter koneksi database
$server   = $_SERVER["DB_HOST"];
$username = $_SERVER["DB_USER"];
$password = $_SERVER["DB_PASSWORD"];
$database = $_SERVER["DB_NAME"];

// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : '.$mysqli->connect_error);
}
?>