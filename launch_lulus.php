<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }

    include "koneksi.php";

    $jml =@htmlspecialchars($_POST["jml"]);
    $min =@htmlspecialchars($_POST["min"]);
   
    $sql = " SELECT nisn FROM tb_pendaftaran WHERE verifikasi=1 ORDER BY ((n_uan+n_uas)/2) DESC,n_uan DESC,n_uas DESC LIMIT 0,$jml";
    
     $result = @mysqli_query($conn,$sql);
     
     $i=0;
     while($rsDaftar = @mysqli_fetch_array($result)):
     $nisn = $rsDaftar["nisn"];
    {   
        if($i<=$jml){
       $sqls ="UPDATE `tb_pendaftaran` SET lulus=1,updated_at=current_timestamp() WHERE nisn='$nisn'";
    $results = @mysqli_query($conn,$sqls);
    	} else {
            break;
        }
    $i++;

    }
endwhile;

// print_r($sqls);
// exit;

    header("location:".$_SERVER['HTTP_REFERER']);
?>