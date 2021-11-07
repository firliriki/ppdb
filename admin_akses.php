<?php 
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
    session_start();
        if (isset($_SESSION['login'])){

    }else{
    header('Location: index.php');
    }

    $title = "Form Pendaftaran";
    include "header.php";
    include "koneksi.php";   
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

                <!-- Cek Admin -->
                <?php
                $sql_ad ="SELECT * FROM tb_users WHERE id_user='".$login["id_user"]."'";
                $result_ad = @mysqli_query($conn,$sql_ad);
                $rsDaftar_ad = @mysqli_fetch_array($result_ad);
            
                ?>

                <?php
                    if(@$rsDaftar_ad["level"]=="Admin" || @$rsDaftar_ad["level"]=="Super Admin"){
                ?>

                <?php
                if(isset($_GET["id"])){
                    $id_siswa = $_GET["id"];
        
                    $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_user = $id_siswa");
                    $rsDaftar = mysqli_fetch_array($result);
                }

                ?>

                
                <!-- pendaftaran -->
                <form action="simpan_user.php" method="POST">
                    <div class="row">
                        <div class="form col-md-9">
                            <h2>Nama Siswa</h2>
                            <div class="form-group">
								<input type="hidden" name="id_user" value="<?= @$rsDaftar["id_user"]; ?>">
                                <label for="nm_user">NAMA</label>
                                <input type="text" class="form-control" name="nm_user" id="nm_user" aria-describedby="nm_user" value="<?= @$rsDaftar["nm_user"]; ?>">                            
                            </div>
                            <h2>NISN</h2>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="nisn" value="<?= @$rsDaftar["nisn"]; ?>">                            
                            </div>
                            <h2>PASSWORD</h2>
                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="password">             
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>                                
                            </div>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                <h2>Akses Admin Diperlukan!</h2>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>