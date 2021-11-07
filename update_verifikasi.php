<?php

    include "koneksi.php";

    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    $id_daftar = $_GET["id"];
    $verifikasi = $_GET["verifikasi"];


    $sql = "UPDATE tb_pendaftaran SET verifikasi= $verifikasi,updated_at=current_timestamp() WHERE id_daftar=$id_daftar";
    $result = @mysqli_query($conn,$sql);

    header("location:".$_SERVER['HTTP_REFERER']);
?>