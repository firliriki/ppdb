<?php

function setUpload($source,$target,$type,$size,$jenis,$filename){
    $type_source = strtolower(pathinfo($source["name"],PATHINFO_EXTENSION));
    $size_source = $source["size"];
    $file_target = $target.basename($filename.".".$type_source);

    if(!in_array($type_source,$type)){
        $error = "File $jenis harus ".join(" , ",$type);
        return $error;
        exit;
    }

    if($size_source>$size){
        $error = "Ukuran file $jenis tidak boleh lebih dari $size";
        return $error;
        exit;
    }

    if(!move_uploaded_file($source["tmp_name"], $file_target)){
        $error = "file $jenis gagal di upload !";
        return $error;
        exit;
    }

    return "";
}
?>