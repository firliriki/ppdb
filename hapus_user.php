<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    session_start();
        if(isset($_SESSION['login'])){
            
    }else{
    header('Location: index.php');
     }

    include "koneksi.php";
    $login = $_SESSION['login'];


    $sql_h ="SELECT * FROM tb_users WHERE id_user='".$login["id_user"]."'";
    $result_ad = @mysqli_query($conn,$sql_h);
    $rsDaftar_ad = @mysqli_fetch_array($result_ad);

     if(@$rsDaftar_ad["level"]=="Admin"||@$rsDaftar_ad["level"]=="Super Admin"){
        $id_siswa = $_GET["id"];

    try {
        mysqli_query($conn,"DELETE FROM tb_users WHERE id_user=$id_siswa");

        header("location:data_user.php?pesan= Data berhasil di hapus !");
    } catch(Exception $err){
        header("location:data_user.php?pesan= Data gagal di hapus !");
    }
    }else{
    
    header("location:data_user.php?pesan= Akses Admin Diperlukan !");
    }
?>