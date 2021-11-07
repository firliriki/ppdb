<?php
        session_start();
        if (isset($_SESSION['login'])){

        }else{
            header('Location: index.php');
        }

        if(!@$_SERVER['HTTP_REFERER']){
            die("koneksi error!");
        }
?>

<?php
$title = "Change Password";
  include "koneksi.php";
  include "header.php";
?>
    <div id="dashboard">
        <div class="row no-gutters">
            <?php
                include "sidebar.php";
            ?>
            <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Ganti Password</h2>
                </div>
                <!-- error -->

                <?php if(isset($_GET["pesan"])){ ?>
                <div class="alert alert-<?php echo $_GET["type"]; ?>" role="alert"><?php echo $_GET["pesan"]; ?></div>

               <?php } ?>
                    <!-- end error -->

                <?php
                $sql ="SELECT * FROM tb_users WHERE id_user='".$login["id_user"]."'";
                $result = @mysqli_query($conn,$sql);
                $rsDaftar = @mysqli_fetch_array($result);

                ?>

                <form action="simpan_password.php" method="post">
                <div class="form-group">
                <label for="password">Masukan Password Lama</label>
                <input type="hidden" name="id_user" value="<?= @$rsDaftar["id_user"]; ?>">
                 <input type="password" class="form-control" name="password_lm" id="password_lm" aria-describedby="password" value="" required>
                
                <label for="password">Masukan Password Baru</label>
                 <input type="password" class="form-control" name="password" id="password" aria-describedby="password" value="" required>

                 <label for="password">Masukan Kembali Password Baru</label>
                 <input type="password" class="form-control" name="password_b" id="password_b" aria-describedby="password_b" value="" required>
                 </div>
                 <div class="form-group">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>                                
                            </div>
                </form>

            </div>
        </div>
    </div>
    <?php
    include "footer.php";
   ?>