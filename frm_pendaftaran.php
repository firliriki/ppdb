<?php 
    session_start();
        if (isset($_SESSION['login'])){

    }else{
    header('Location: index.php');
    }

    $title = "Form Pendaftaran";
    include "header.php";   
?>
    <div id="dashboard">
        <div class="row no-gutters">
            <?php 
                include "sidebar.php";
            ?>
            <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Form Pendaftaran</h2>
                </div>

                <!-- error -->

                <?php if(isset($_GET["pesan"])){ ?>
                <div class="alert alert-<?php echo $_GET["type"]; ?>" role="alert"><?php echo $_GET["pesan"]; ?></div>

               <?php } ?>
                    <!-- end error -->
                

               <?php

                $kuota = "SELECT * FROM tb_kuota";
                $k_res = @mysqli_query($conn,$kuota);
                $rsKuota = @mysqli_fetch_array($k_res);

                $sql ="SELECT * FROM tb_pendaftaran WHERE nisn='".$login["nisn"]."'";
                $result = @mysqli_query($conn,$sql);
                $rsDaftar = @mysqli_fetch_array($result);

                if(@$rsKuota["kuota_daftar"]==0){

                
                ?>

                <?php
                    if(@$rsDaftar["status"]==0){
                ?>
                
                <!-- pendaftaran -->
                <form action="simpan_pendaftaran.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="foto col-md-3">
                            <?php if(@$rsDaftar["foto"]){ ?> 
                            <img id="avatar" src="uploads/foto/<?php echo $rsDaftar["foto"]; ?>" alt="" width="100%">
                            <?php } else { ?>
                            <img id="avatar" src="assets/images/No-image.png" alt="" width="100%">
                           <?php } ?>
                           <input style="display:none" type="file" class="form-control-file" name="foto" id="foto">
                           <input type="hidden" name="nm_foto" value="<?php echo $rsDaftar["foto"]; ?>">

                           <?php if(@$rsDaftar["dokumen"]) { 
                               $dok = @$rsDaftar["dokumen"];
                               $cekdok = "uploads/dokumen/$dok";

                               if (file_exists($cekdok)){
                            ?>
                                <a class="btn btn-warning d-block" target="blank" href="uploads/dokumen/<?php echo $rsDaftar["dokumen"]; ?>">LIHAT DOKUMEN</a>
                            <?php } ?>
                                <a class="btn btn-success d-block mt-2" style="position: sticky; margin: 5px 0; top: 450px; width: 245px; object-fit: cover; " href="update_status.php?id=<?php echo $rsDaftar["id_daftar"]; ?>&status=1">SERAHKAN</a>
                            <?php } ?>
                        </div>
                        <div class="form col-md-9">
                            <h2>Identitas Siswa</h2>
                            <div class="form-group">
								<input type="hidden" name="id_daftar" value="<?= @$rsDaftar["id_daftar"]; ?>">
                                <label for="nisn">NISN *</label>
                                <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="nisn" readonly value="<?= $login["nisn"]; ?>">                            
                            </div>
                            <div class="form-group">
                                <label for="nama">NAMA *</label>
                                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" value="<?= isset($rsDaftar["nm_siswa"]) ? $rsDaftar["nm_siswa"] : $login["nm_user"]; ?>" required>                            
                            </div>
                            <div class="form-group">
                                <label for="nama">TEMPAT LAHIR , TANGGAL LAHIR *</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" aria-describedby="tmp_lahir" value="<?= @$rsDaftar["tmp_lahir"]; ?>" required>                                     
                                    </div>
                                    <div class="col-md-6">
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                        <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" aria-describedby="tgl_lahir" value="<?= @$rsDaftar["tgl_lahir"]; ?>" required>                                     
                                        </div>
                                    </div>
                                    </div>
                                </div>                           
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="jk">JENIS KELAMIN *</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jk1" name="jk" class="custom-control-input" value="1" <?php echo @$rsDaftar["jk"]==1 ? "checked" : ""; ?>>
                                        <label class="custom-control-label" for="jk1">Laki-Laki</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jk2" name="jk" class="custom-control-input" value="2" <?php echo @$rsDaftar["jk"]==2 ? "checked" : ""; ?>>
                                        <label class="custom-control-label" for="jk2">Perempuan</label>
                                    </div>
                                </div>                             
                            </div>
                            <div class="form-group">
                                <label for="alamat">ALAMAT *</label>
                                <textarea class="form-control" name="alamat" id="alamat" aria-describedby="alamat" rows="5" required><?= @$rsDaftar["alamat"]; ?></textarea>             
                            </div>
                            <div class="form-group">
                                <label for="kota">KOTA *</label>
                                <input type="text" class="form-control" name="kota" id="kota" aria-describedby="kota" value="<?= @$rsDaftar["kota"]; ?>" required>                            
                            </div>
                            <div class="form-group">
                                <label for="agama">AGAMA *</label>
                                <select id="agama" class="form-control" name="agama" required>
                                    <option selected>- Pilih Agama -</option>
                                    <?php 
                                        $agama = ["Islam","Kristen","Katolik","Hindu","Budha","Kong Hu Chu"];
                                        foreach($agama as $agm){
                                    ?>  
                                        <option <?php echo @$rsDaftar["agama"]==$agm ? "selected" : ""; ?> value="<?= $agm; ?>"><?= $agm; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>                           
                            </div> 
                            <div class="form-group">
                                <label for="telp">NO HANDPHONE / WA *</label>
                                <input type="text" class="form-control" name="telp" id="telp" aria-describedby="telp" value="<?= @$rsDaftar["telp"]; ?>" required>                            
                            </div>
                            <h2>Identitas Orang Tua / Wali</h2>
                            <div class="form-group">
                                <label for="nm_ortu_wali">NAMA *</label>
                                <input type="text" class="form-control" name="nm_ortu_wali" id="nm_ortu_wali" aria-describedby="nm_ortu_wali" value="<?= @$rsDaftar["nm_ortu_wali"]; ?>" required>                            
                            </div>
                            <div class="form-group">
                                <label for="alamat_ortu_wali">ALAMAT ORANG TUA *</label>
                                <textarea class="form-control" name="alamat_ortu_wali" id="alamat_ortu_wali" aria-describedby="alamat_ortu_wali"><?= @$rsDaftar["alamat_ortu_wali"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="telp_ortu_wali">TELEPON</label>
                                <input type="text" class="form-control" name="telp_ortu_wali" id="telp_ortu_wali" aria-describedby="telp_ortu_wali" value="<?= @$rsDaftar["telp_ortu_wali"]; ?>">                            
                            </div>                                                                            
                            <h2>Identitas Sekolah</h2>
                            <div class="form-group">
                                <label for="asal_sekolah">ASAL SEKOLAH *</label>
                                <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" aria-describedby="asal_sekolah" value="<?= @$rsDaftar["asal_sekolah"]; ?>" required>                            
                            </div>
                            <div class="form-row">                          
                                <div class="form-group col-md-6">
                                    <label for="n_uas">NILAI UJIAN SEKOLAH *</label>
                                    <input type="text" class="form-control" name="n_uas" id="n_uas" aria-describedby="n_uas" value="<?= @$rsDaftar["n_uas"]; ?>" required>                            
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="n_uan">NILAI UJIAN NASIONAL</label>
                                    <input type="text" class="form-control" name="n_uan" id="n_uan" aria-describedby="n_uan" value="<?= @$rsDaftar["n_uan"]; ?>">                            
                                </div>                                                           
                            </div>
                            <h2>Dokumen</h2> 
                            <div class="form-group">
                                <label for="dokumen">DOKUMEN</label>
                                <p>Silahkan Upload dokumen yang berisi ( Ijazah, Kartu Keluarga, Kartu NISN , Surat Keterangan Lulus ) dalam bentuk PDF</p>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>                                
                            </div>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                    <!-- terima kasih -->
                <div class="alert alert-succes" role="alert">
                <h2>Terima Kasih</h2>
                <p>Selamat anda sudah berhasil melakukan pendaftaran , silahkan tunggu pengumuman !</p>
                </div> 
                <?php } ?>
                <?php } else { ?>
                    <!-- terima kasih -->
                <div class="alert" role="alert">
                <h2>Mohon Maaf!</h2>
                <p> Kuota Pendaftaran Sudah Terpenuhi !</p>
                <?php
                    if(@$rsDaftar["status"]==1){
                ?>
                <p>Anda sudah berhasil melakukan pendaftaran , silahkan tunggu pengumuman !</p>
                </div> 
                <?php }
                }
                ?>
            
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>