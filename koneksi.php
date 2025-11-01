<?php
// ini untuk protokol TCP/IP
$ipserver = "localhost";
$port = 3306;

// ini untuk mySQL Handshake
$username = "root";
$password = "";
$database = "speda_db";

$connection = null;

try{
    $connection = new mysqli($ipserver, $username, $password, $database, $port);
    // echo "berhasil konek";
} catch(Exception $e){
    echo "gagal konek"; 
}

?>