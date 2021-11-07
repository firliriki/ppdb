<?php
if(!@$_SERVER['HTTP_REFERER']){
    die("koneksi error!");
}
?>
<html>
    <head>
        <title>Pengumuman</title>
    </head>
    <body>
        <?php
            include "koneksi.php";

            
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
        <h5>Pengumuman Pendaftaran</h5>
        <table id="data" width="100%">
            <thead>
                <tr>
                    <th rowspan="2">NISN</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Asal Sekolah</th>
                    <th colspan="3">Nilai</th>
                </tr>
                <tr>
                    <th>UAN</th>
                    <th>UAS</th>
                    <th>RATA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT *,((n_uan+n_uas)/2) as rata FROM tb_pendaftaran WHERE verifikasi=1 ORDER BY rata DESC,n_uan DESC,n_uas DESC";
                    $result = @mysqli_query($conn,$sql);
                    $pos = 1;
                    while($rsDaftar = @mysqli_fetch_array($result)):
                        $rata = ($rsDaftar["n_uan"]+$rsDaftar["n_uas"])/2;
                ?>
                    <tr class="<?= $pos>3 ? "merah" : ""?>">
                        <td width="15%"><?= $rsDaftar["nisn"] ?></td>
                        <td><?= $rsDaftar["nm_siswa"] ?></td>
                        <td><?= $rsDaftar["asal_sekolah"] ?></td>
                        <td style="width:8%;text-align: center;"><?= number_format($rsDaftar["n_uan"],"2",",",".") ?></td>
                        <td style="width:8%;text-align: center;"><?= number_format($rsDaftar["n_uas"],"2",",",".") ?></td>
                        <td style="width:8%;text-align: center;"><?= number_format($rata,"2",",",".") ?></td>
                    </tr>
                    <?php
                        $pos++;
                        endwhile;
                    ?>
            </tbody>
        </table>
        <?php
                $html = ob_get_contents();
                ob_end_clean();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
        ?>
    </body>
</html>