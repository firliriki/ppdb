<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
    session_start();

include "koneksi.php";

//cek data dari login
$nisn       = htmlspecialchars($_POST["nisn"]);
$password   = htmlspecialchars($_POST["password"]);

//cek data
$sql  = "SELECT * FROM tb_users WHERE nisn ='$nisn'";
$result = @mysqli_query($conn,$sql);
$rsLogin = @mysqli_fetch_array($result);

if(mysqli_num_rows($result)>0){

    #cek data
    if(md5($password)==$rsLogin["password"]){
        $_SESSION["login"] = $rsLogin;

        header("location:dashboard.php");
    }
    else {
        header("location:/ppdb/?pesan=Password Salah !");
    }
} else {
    header("location:/ppdb/?pesan=NISN tidak terdaftar !");
}

?>