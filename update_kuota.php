<?php

    include "koneksi.php";

    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    $kuota_daftar = $_GET["kuota_daftar"];
    


    $sql = "UPDATE tb_kuota SET kuota_daftar= '$kuota_daftar'";
    $result = @mysqli_query($conn,$sql);

    header("location:".$_SERVER['HTTP_REFERER']);
?>