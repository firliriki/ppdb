<?php

    include "koneksi.php";

    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    $id_daftar = $_GET["id"];
    $level = $_GET["level"];


    $sql = "UPDATE tb_users SET level= '$level',updated_at=current_timestamp() WHERE id_user=$id_daftar";
    $result = @mysqli_query($conn,$sql);

    header("location:".$_SERVER['HTTP_REFERER']);
?>