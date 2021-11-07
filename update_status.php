<?php

    include "koneksi.php";

    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    $id_daftar = $_GET["id"];
    $status = $_GET["status"];


    $sql = "UPDATE tb_pendaftaran SET status = $status,updated_at=current_timestamp() WHERE id_daftar=$id_daftar";
    $result = @mysqli_query($conn,$sql);

    header("location:".$_SERVER['HTTP_REFERER']);
?>