<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
     include "koneksi.php";


     $nama =htmlspecialchars($_POST["nama"]);
     $nisn =htmlspecialchars($_POST["nisn"]);
     $password =htmlspecialchars(md5($_POST["password"]));

    //  cek data
    $sql_cek = "SELECT * FROM 'tb_users' WHERE nisn='$nisn'";
    $res_cek = @mysqli_query($conn,$sql_cek);

    if(mysqli_num_rows($res_cek)==0){
        $sql = "INSERT INTO tb_users(nm_user,nisn,password) VALUES('$nama','$nisn','$password')";
        $result = @mysqli_query($conn,$sql);

        // print_r($result);
        // jika berhasil
        header("location:/ppdb?pesan=Registrasi Sukses!");

    } else {
        header("location:registrasi.php?pesan=NISN Sudah Terdaftar");
    }
?>