<?php

require __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
$host       =   $_SERVER["DB_HOST"];
$user       =   $_SERVER["DB_USER"];
$password   =   "";
$database   =   $_SERVER["DB_NAME"];
$db1 = mysqli_connect($host, $user, $password, $database);

// query SQL untuk insert data
?>
