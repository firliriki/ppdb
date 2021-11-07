<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
    include "koneksi.php";
    include "modul.php";

    if(!$_POST){
        header("location:frm_pendaftaran.php");
    }

    $id                 = htmlspecialchars($_POST["id_daftar"]);
    $nisn               = htmlspecialchars($_POST["nisn"]);
    $nama               = htmlspecialchars($_POST["nama"]);
    $tmp_lahir          = htmlspecialchars($_POST["tmp_lahir"]);
    $tgl_lahir          = date("Y-m-d",strtotime($_POST["tgl_lahir"]));
    $jk                 = htmlspecialchars($_POST["jk"]);
    $alamat             = htmlspecialchars($_POST["alamat"]);
    $kota               = htmlspecialchars($_POST["kota"]);
    $agama              = htmlspecialchars($_POST["agama"]);
    $telp               = htmlspecialchars($_POST["telp"]);
    $nm_ortu_wali       = htmlspecialchars($_POST["nm_ortu_wali"]);
    $alamat_ortu_wali   = htmlspecialchars($_POST["alamat_ortu_wali"]);
    $telp_ortu_wali     = htmlspecialchars($_POST["telp_ortu_wali"]);
    $asal_sekolah       = htmlspecialchars($_POST["asal_sekolah"]);
    $n_uas              = str_replace(",",".",htmlspecialchars($_POST["n_uas"]));
    $n_uan              = str_replace(",",".",htmlspecialchars($_POST["n_uan"]));


    

    if($_FILES["foto"]["name"]!=""){
        $ext = strtolower(pathinfo($_FILES["foto"]["name"],PATHINFO_EXTENSION));
        $foto = basename("foto_$nisn.$ext");
    } else {
        $foto = $_POST["nm_foto"];
    }

    $cekfoto = "uploads/foto/$foto";

    if($id){
            $sql = "UPDATE tb_pendaftaran SET nm_siswa='$nama',tmp_lahir='$tmp_lahir',tgl_lahir='$tgl_lahir',jk='$jk',alamat='$alamat',kota='$kota',agama='$agama',telp='$telp',nm_ortu_wali='$nm_ortu_wali',alamat_ortu_wali='$alamat_ortu_wali',telp_ortu_wali='$telp_ortu_wali',asal_sekolah='$asal_sekolah',n_uas='$n_uas',n_uan='$n_uan',dokumen='doc_$nisn.pdf',foto='$foto',updated_at=current_timestamp() WHERE nisn='$nisn'";
           
            
    } else {
        if (file_exists($foto)){
        $sql = "INSERT INTO tb_pendaftaran(nisn,nm_siswa,tmp_lahir,tgl_lahir,jk,alamat,kota,agama,telp,nm_ortu_wali,alamat_ortu_wali,telp_ortu_wali,asal_sekolah,n_uas,n_uan,dokumen,foto) VALUES('$nisn','$nama','$tmp_lahir','$tgl_lahir','$jk','$alamat','$kota','$agama','$telp','$nm_ortu_wali','$alamat_ortu_wali','$telp_ortu_wali','$asal_sekolah','$n_uas','$n_uan','doc_$nisn.pdf','$foto')";
        } else {
            $sql = "INSERT INTO tb_pendaftaran(nisn,nm_siswa,tmp_lahir,tgl_lahir,jk,alamat,kota,agama,telp,nm_ortu_wali,alamat_ortu_wali,telp_ortu_wali,asal_sekolah,n_uas,n_uan,dokumen) VALUES('$nisn','$nama','$tmp_lahir','$tgl_lahir','$jk','$alamat','$kota','$agama','$telp','$nm_ortu_wali','$alamat_ortu_wali','$telp_ortu_wali','$asal_sekolah','$n_uas','$n_uan','doc_$nisn.pdf')";
        }
    }

    $result = @mysqli_query($conn,$sql);
    if($result){

        $error = "";

        if($_FILES["foto"]["name"]!=""){
        $error .= setUpload($_FILES["foto"],"uploads/foto/",array("jpg","jpeg","png"),500000,"foto","foto_$nisn");
    }

    if($_FILES["dokumen"]["name"]!=""){
        $error .= setUpload($_FILES["dokumen"],"uploads/dokumen/",array("pdf"),900000,"dokumen","doc_$nisn");
    }
    
    if($error){
        header("location:frm_pendaftaran.php?pesan=$error&type=danger");
    } else{
        header("location:frm_pendaftaran.php?pesan=Data Berhasil Disimpan!&type=success");
    }
    
} else  {
        // print_r($result);
        header("location:frm_pendaftaran.php?pesan=Data gagal disimpan !&type=danger");
    }

?>