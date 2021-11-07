<?php
        #config

    $server = "localhost";
    $user   = "root";
    $password = "";
    $port   = "3306";
    $database = "ppdb";

    $conn = @mysqli_connect($server,$user,$password,$database,$port);

    if(!$conn){
        die("<h1> Gagal Terhubung ke database<h1/>");
    }
?>