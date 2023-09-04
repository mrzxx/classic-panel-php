<?php 
/*Kurulum*/
session_start();
define("security",true);
require_once 'includes/config.php';
require_once 'includes/basic-functions.php';
error_reporting ( E_ALL ) ;
ini_set ( 'display_errors' , 1 ) ;
$hata = '';
if($_POST){
    $username = tmz($_POST["username"]);
    $password = md5($_POST["password"]);
    $query = $db->query("SELECT * FROM admins WHERE username='{$username}' AND password='{$password}'")->fetch(PDO::FETCH_ASSOC);
    if($query){
        if(permission_control($query["id"],"b")){
            $_SESSION["adminid"] = $query["id"];  
            header('Location:anasayfa');
        }
    }else{
        $hata = 'Kullanıcı adı veya şifre yanlış.';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site içerik paneli</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $siplink; ?>login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $siplink; ?>login/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $siplink; ?>login/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $siplink; ?>login/css/iofrm-theme6.css">
</head>
<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="#">
                <div class="logo">
                    <img class="logo-size" src="#" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="login/images/graphic2.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3><?php echo $firma_adi; ?> <br></h3>
                        <p>Simdi giris yapın ve verileri görüntüleyin.</p>
                        <form action="login.php" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Kullanıcı Adı" required>
                            <input class="form-control" type="password" name="password" placeholder="Sifre" required>
                            <span style="color:red;display:block;font-weight:bold;">
                            <?php 
                            echo $hata;
                            ?>
                            </span>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Giris</button> <a href="#">Sifremi unuttum</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>