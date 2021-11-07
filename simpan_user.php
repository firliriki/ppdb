<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
     include "koneksi.php";

     $id   =htmlspecialchars($_POST["id_user"]);
     $nama =htmlspecialchars($_POST["nm_user"]);
     $nisn =htmlspecialchars($_POST["nisn"]);
     $password =htmlspecialchars(md5($_POST["password"]));

    //  cek data
    $id_cek = "SELECT * FROM tb_users WHERE id_user='$id'";
    $res_cek = @mysqli_query($conn,$id_cek);


    if(mysqli_num_rows($res_cek)==0){
    
        $sql = "INSERT INTO tb_users(nm_user,nisn,password) VALUES('$nama','$nisn','$password')";
        $result = @mysqli_query($conn,$sql);

        if($result){
        // jika berhasil
        header("location:data_user.php?pesan=Data Berhasil Disimpan");
        }else{
            header("location:data_user.php?pesan=Nisn Sudah Terdaftar");
        }
        

    } else {
        if($password=="d41d8cd98f00b204e9800998ecf8427e"){
        $sql = "UPDATE tb_users SET nm_user='$nama', nisn='$nisn', updated_at=current_timestamp() WHERE id_user='$id'";
        $result = @mysqli_query($conn,$sql);
        header("location:data_user.php?pesan=Data Berhasil Diupdate");
        }else{
        $sql = "UPDATE tb_users SET nm_user='$nama', nisn='$nisn', password='$password', updated_at=current_timestamp() WHERE id_user='$id'";
        $result = @mysqli_query($conn,$sql);
        header("location:data_user.php?pesan=Data Berhasil Diupdate");
        }
    }
?>