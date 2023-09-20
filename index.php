<?php




define('security',1);


require_once 'includes/config.php';
require_once 'includes/basic-functions.php';
session_start();
/*Login Control*/
if(isset($_SESSION["adminid"])){
    if(permission_control($_SESSION["adminid"],'b')){
        $adminid = $_SESSION["adminid"];
    }else{
        session_destroy();
        header('Location:'.$siplink.'login');
    }
}else{
    session_destroy();
    header('Location:'.$siplink.'login');
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title><?php echo $firma_adi; ?> Site İçerik Paneli</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="<?php echo $siplink; ?>plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $siplink; ?>plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="<?php echo $siplink; ?>css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo $siplink; ?>css/style.min.css" rel="stylesheet">
    <link href="<?php echo $siplink; ?>css/custom.css" rel="stylesheet">
    <style>
        .odd{
            background-color:#fff1f1!important;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="<?php echo $siplink; ?>plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <strong style="color:#000;">İçerik Paneli</strong>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'anasayfa'; ?>"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Anasayfa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'urunler?target=add12412'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Ürün Ekle</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'urunler'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Ürünler</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'kategori?target=add12412'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Kategori Ekle</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'kategori'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Kategoriler</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'blog?target=add12412'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Blog Ekle</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'blog'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Bloglar</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siplink.'log-out'; ?>"
                                aria-expanded="false">
                                <i class="fa fa-exit" aria-hidden="true"></i>
                                <span class="hide-menu">Çıkış Yap</span>
                            </a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Content  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php 
                /*Content Include*/
                switch ($_GET["page"]) {
                    case 'anasayfa':
                        include_once 'dashboard.php';
                        break;
                    case 'urunler':
                        include_once 'urunler.php';
                        break;
                        case 'blog':
                            include_once 'blog.php';
                            break;
                    case 'log-out':
                        include_once 'log-out.php';
                        break;
                    case 'kategori':
                        include_once 'kategori.php';
                        break;
                    
                    default:
                        include_once '404.php';
                        break;
                }
                ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Content  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2021 © <?php echo $firma_adi; ?>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo $siplink; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $siplink; ?>bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $siplink; ?>js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo $siplink; ?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $siplink; ?>js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo $siplink; ?>js/ckeditor/ckeditor.js"></script>

    <script src="<?php echo $siplink; ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $siplink; ?>js/custom.js"></script>
    
    <script>   
                CKEDITOR.replace( 'description_main' );
            CKEDITOR.replace( 'description_main_sub' );
            CKEDITOR.replace( 'product_spekt' );
            CKEDITOR.replace( 'packet_spekt' );
             
		CKEDITOR.replace('description', {
    filebrowserUploadUrl: 'upload.php', // Resim yükleme URL'si
    extraPlugins: 'uploadimage' // Resim yükleme eklentisi etkinleştirme
});
		  // CKEditor'i başlat
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: 'upload.php', // Resim yükleme URL'si
            extraPlugins: 'uploadimage' // Resim yükleme eklentisi etkinleştirme
        });

        // Sürüklenen resimleri yüklemek için drop event'ini dinleyin
        document.getElementById('editor1').addEventListener('drop', function(event) {
            event.preventDefault();
            var file = event.dataTransfer.files[0];
            uploadImage(file);
        });

        // Resmi yükleme işlemini gerçekleştiren fonksiyon
        function uploadImage(file) {
            var formData = new FormData();
            formData.append('upload', file);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    // Yükleme başarılıysa, resmi CKEditor'e ekleyin
                    var editor = CKEDITOR.instances.editor1;
                    editor.insertHtml('<img src="' + data.url + '" alt="Yüklenen Resim">');
                } else {
                    console.error('Resim yüklenirken bir hata oluştu:', data.message);
                }
            })
            .catch(error => {
                console.error('Resim yüklenirken bir hata oluştu:', error);
            });
        }
       

    </script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    
$(function() {


    $(".anaresimsil").click(function(){

var element = $(this);
//Silinecek linkin id sini alalÄ±m
var del_id = element.attr("id");
//delete.php ye gÃ¶ndermek iÃ§in bir url yapÄ±sÄ± oluÅŸturalÄ±m
var info = 'id=' + del_id;
// Confirm kutusu (ok / cancel) Ok DÃ¶ndÃ¼rÃ¼rse
    if(confirm("Bu işlemin geri dönüşü yoktur.Emin misiniz ?"))
            {
    // ajax fonksiyonumuzu yazalÄ±m
    $.ajax({
    type: "GET",
    url: "<?php echo $siplink; ?>delete.php",
    data: info,
    success: function(){

    // ajax fonksiyonumuz Ã§alÄ±ÅŸtÄ±ktan sonra silinen divi sayfadan kaldÄ±ralÄ±m..
    let anaresim = document.getElementById("anaresim");
    anaresim.remove();

    }
    });     
    

        }

    return false;

});



$(".anaresimsil2").click(function(){

var element = $(this);
//Silinecek linkin id sini alalÄ±m
var del_id = element.attr("id");
var frontdel = element.attr("delid");
//delete.php ye gÃ¶ndermek iÃ§in bir url yapÄ±sÄ± oluÅŸturalÄ±m
var info = 'id=' + del_id;
// Confirm kutusu (ok / cancel) Ok DÃ¶ndÃ¼rÃ¼rse
    if(confirm("Bu işlemin geri dönüşü yoktur.Emin misiniz ?"))
            {
    // ajax fonksiyonumuzu yazalÄ±m
    $.ajax({
    type: "GET",
    url: "<?php echo $siplink; ?>delete.php",
    data: info,
    success: function(){

    // ajax fonksiyonumuz Ã§alÄ±ÅŸtÄ±ktan sonra silinen divi sayfadan kaldÄ±ralÄ±m..
    let anaresim = document.getElementById("anaresim"+frontdel);
    anaresim.remove();
    element.remove();

    }
    });     
    

        }

    return false;

});



$(".delbutton").click(function(){

var element = $(this);
//Silinecek linkin id sini alalÄ±m
var del_id = element.attr("id");
//delete.php ye gÃ¶ndermek iÃ§in bir url yapÄ±sÄ± oluÅŸturalÄ±m
var info = 'id=' + del_id;
// Confirm kutusu (ok / cancel) Ok DÃ¶ndÃ¼rÃ¼rse
    if(confirm("Bu işlemin geri dönüşü yoktur.Emin misiniz ?"))
            {
    // ajax fonksiyonumuzu yazalÄ±m
    $.ajax({
    type: "GET",
    url: "<?php echo $siplink; ?>delete.php",
    data: info,
    success: function(){

    // ajax fonksiyonumuz Ã§alÄ±ÅŸtÄ±ktan sonra silinen divi sayfadan kaldÄ±ralÄ±m..
    

    }
    });     

    $(this).parents(".trow").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

        }

    return false;

});

});
    </script>
 

</body>

</html>