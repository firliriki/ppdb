<?php
if(!@$_SERVER['HTTP_REFERER']){
    die("koneksi error!");
}
include "koneksi.php";

if(!$_POST){
    header("location:frm_pendaftaran.php");
}

$id_user            = htmlspecialchars($_POST["id_user"]);
$pass_lm            = htmlspecialchars(md5($_POST["password_lm"]));
$pass               = htmlspecialchars(md5($_POST["password"]));
$pass_b              = htmlspecialchars(md5($_POST["password_b"]));

$ps_cek = "SELECT password FROM tb_users WHERE id_user='$id_user'";
$rs_ps = @mysqli_query($conn,$ps_cek);
$rs_dt = mysqli_fetch_array($rs_ps);

if ($pass_lm==$rs_dt["password"]){
    
    if($pass==$pass_b){
        $sql = "UPDATE tb_users SET password='$pass', updated_at=current_timestamp() WHERE id_user='$id_user'";
        $result = @mysqli_query($conn,$sql);

        if($result){
        header("location:dashboard.php?pesan=Password berhasil disimpan !&type=success");
        } else {
        header("location:update_password.php?pesan=Password gagal diubah !&type=danger");
        }
    } else {
        header("location:update_password.php?pesan=Ketik ulang password baru & sesuaikan!&type=danger");
     } 

}  else {
    header("location:update_password.php?pesan=Password lama salah!&type=danger");
}




?>