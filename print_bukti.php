<?php
      session_start();
      if (isset($_SESSION['login'])){

      }else{
          header('Location: index.php');
      }

      $login = @$_SESSION["login"];

      include "koneksi.php";

    ?>
<html>
    <head>
        <title>Pengumuman</title>
    </head>
    <body>
    <?php
        // session_start();

        $sql_ver ="SELECT * FROM tb_pendaftaran WHERE nisn='".$login["nisn"]."'";
        $result_ver = @mysqli_query($conn,$sql_ver);
        $rsDaftar = @mysqli_fetch_array($result_ver);
        
        if(@$rsDaftar["verifikasi"]==1){
                    

            
            include "vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
        ?>
        <style>
            @page { margin: 0 2%; }
            h5 { background: #000; padding: 10px 0; text-align: center; color: #fff;}
            table#data { border-collapse: collapse; border: 1px solid #000;}
            table#data th,table#data td {padding: 5px; border-collapse: collapse; border: 1px solid #000; }
            table#data th { background: #555; color: #fff; }
        </style>
        <table width="100%">
            <tr>
                <td width="10%">
                    <img src="assets/images/logo.png" alt="" width="100">
                </td>
                <td style="width:90%;text-align: center;">
                    <h2>SMA NEGERI 1 SRAGEN</h2>
                    <p>Jl Sukowati no.41 Sragen <br/>www.sman1srg.com , Email : mail@sman1srg.com, Telp :(0271) 696969 </p>
                </td>
            </tr>
        </table>
        <div class="kep" style="text-align: center;">
            <h2>SURAT KEPUTUSAN</h2>
            <h4>berdasarkan Nilai rata-rata siswa maka siswa dengan atas nama :</h4>
        <table width="100%">
        <?php
                    $sql = "SELECT *,((n_uan+n_uas)/2) as rata FROM tb_pendaftaran WHERE nisn='".$login["nisn"]."'";
                    $result = @mysqli_query($conn,$sql);
                    $rsDaftar = @mysqli_fetch_array($result);
                    $rata = ($rsDaftar["n_uan"]+$rsDaftar["n_uas"])/2;
        ?>
           <tr>
            <th>Nama           </th>
            <td>:    <?= $rsDaftar["nm_siswa"]?></td>
            </tr>
            <tr>
            <th>Nisn           </th>
            <td>:    <?= $rsDaftar["nisn"]?></td>
            </tr>
            <tr>
            <th>Rata-Rata Nilai</th>
            <td>:    <?= $rata?></td>
            </tr>
        </table>
            <p>Telah dinyatakan</p>
            <?php if($rata>=80){
            ?>
            <h1 style="color: green;">DITERIMA</h1>
            <h2>Sebagai Siswa baru SMA 1 Sragen</h2>
            <?php
            } else{
                ?>
                <h1 style="color: red;">Ditolak</h1>
            <?php
            }
            ?>
            </div>

            <p style="text-align: left;">Silahkan scan QR code untuk mendownload brosur kegiatan siswa baru</p>
            <barcode code="brosur_kegiatan.php?nama=<?= $rsDaftar["nm_siswa"] ?>" type="QR" class="barcode" size="0.8" error="M" disableborders="1" />
        <?php
                $html = ob_get_contents();
                ob_end_clean();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
        ?>
        <?php
        }else {
        
        ?>
        <h2>Data anda belum diverifikasi!!</h2>
        <?php
        }
        ?>
    </body>
</html>