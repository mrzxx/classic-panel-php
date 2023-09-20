<?php 


define('security',1);
require_once 'includes/config.php';
require_once 'includes/basic-functions.php';
require_once 'includes/class.upload.php';
session_start();


$adminid = $_SESSION["adminid"];
if(isset($_POST["submitted"]) AND isset($_POST["operation"]) AND permission_control($adminid,'b')){

    //for security
    $editid = $_SESSION["editid"];
    unset($_SESSION["editid"]);
    //for security

    try {
        
        $operation = explode(',',$_POST["operation"]);
        $wpage = $operation[0];
        $dothis = $operation[1];

    } catch (\Throwable $th) {
        //throw $th;
    }

    $datenow = date('Y-m-d');

    switch ($wpage) {
        case 'kategori':
            if($dothis == 'ekle'){

                $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                $img = '';

                @$foo = new Upload($_FILES["img"]);
                if ($foo->uploaded) {
                    $rsmbaslik = seo($_POST["title"]);
                    $foo->file_new_name_body = $rsmbaslik;
                    $resim=$foo->file_new_name_body;
                    $foo->image_resize = true;
                    $foo->image_convert = 'jpg';
                    //$foo->jpeg_quality = 65;
                    $foo->image_x = 1920;
                    $foo->image_ratio_y = true;
                    $foo->Process('../assets/img/category/');

                    // $foo->file_new_name_body = $rsmbaslik;
                    // $resim=$foo->file_new_name_body;
                    // $foo->image_resize = true;
                    // $foo->image_convert = 'jpg';
                    // //$foo->jpeg_quality = 65;
                    // $foo->image_x = 526;
                    // $foo->image_ratio_y = true;
                    // $foo->Process('../assets/images/blog/little/');
                    
                    if ( $foo->processed ) {
                        $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                        $img = $foo->file_dst_name;
                    }else{
                        $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                    }
                }

                $doinsert = $db->prepare("INSERT INTO category SET
                title=?,
                description=?,
                img=?,
                img_alt=?,
                lang=?,
                langid=?,
                seotitle=?,
                seodescription=?,
                seourl=?,
                seokeyword=?");
                $insert = $doinsert->execute(array(
                    $_POST["title"],
                    $_POST["description"],
                    $img,
                    $_POST["img_alt"],
                    $_POST["lang"],
                    $_POST["langid"],
                    $seotitle,
                    $_POST["seodescription"],
                    $url,
                    $_POST["seokeyword"]
                ));
                if($insert){
                    $_SESSION["success"] = $_SESSION["success"]."kategori veritabanına başarı ile eklendi.";
                    header('Location:'.$siplink.'kategori');
                }else{
                    $_SESSION["failure"] = "kategori veritabanına eklenirken bir hata meydana geldi.";
                    header('Location:'.$siplink.'kategori');
                }

            }elseif($dothis == 'duzenle'){


                $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                $img = '';
                $getimg = $db->query("SELECT img FROM category WHERE id={$editid}")->fetch(PDO::FETCH_ASSOC);
                $img = $getimg["img"];

                @$foo = new Upload($_FILES["img"]);
                if ($foo->uploaded) {
                    $rsmbaslik = seo($_POST["title"]);
                    $foo->file_new_name_body = $rsmbaslik;
                    $resim=$foo->file_new_name_body;
                    $foo->image_resize = true;
                    $foo->image_convert = 'jpg';
                    //$foo->jpeg_quality = 65;
                    $foo->image_x = 1920;
                    $foo->image_ratio_y = true;
                    $foo->Process('../assets/img/category/');
                    
                    if ( $foo->processed ) {
                        $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                        unlink('../assets/img/category/'.$img);
                        $img = $foo->file_dst_name;
                    }else{
                        $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                    }
                }


                $doupdate = $db->prepare("UPDATE category SET
                title=:title,
                description=:description,
                img=:img,
                img_alt=:img_alt,
                lang=:lang,
                langid=:langid,
                seotitle=:seotitle,
                seodescription=:seodescription,
                seokeyword=:seokeyword,
                seourl=:seourl
                WHERE id = :editid");
                $update = $doupdate->execute(array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "img" => $img,
                    "img_alt" => $_POST["img_alt"],
                    "lang" => $_POST["lang"],
                    "langid" => $_POST["langid"],
                    "seotitle" => $seotitle,
                    "seodescription" => $_POST["seodescription"],
                    "seourl" => $url,
                    "seokeyword" => $_POST["seokeyword"],
                    "editid" => $editid
                ));
                if($update){
                    $_SESSION["success"] = $_SESSION["success"]."kategori başarı ile güncellendi.";
                    header('Location:'.$siplink.'kategori');
                }else{
                    $_SESSION["failure"] = "kategori güncellenirken bir hata meydana geldi.";
                    header('Location:'.$siplink.'kategori');
                }

            }
            break;
            case 'urun':
                if($dothis == 'ekle'){
                    $active = ($_POST["active"] != 1) ? 0 : 1;
                    $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                    $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                    $img = '';
    
                    @$foo = new Upload($_FILES["img"]);
                    if ($foo->uploaded) {
                        $rsmbaslik = seo($_POST["title"]);
                        $foo->file_new_name_body = $rsmbaslik;
                        $resim=$foo->file_new_name_body;
                        //$foo->image_resize = true;
                        $foo->image_convert = 'jpg';
                        //$foo->jpeg_quality = 65;
                        //$foo->image_x = 1920;
                        //$foo->image_ratio_y = true;
                        $foo->Process('../assets/img/product/big/');
    
                        $foo->file_new_name_body = $rsmbaslik;
                        $resim=$foo->file_new_name_body;
                        $foo->image_resize = true;
                        $foo->image_convert = 'jpg';
                        $foo->jpeg_quality = 65;
                        $foo->image_x = 1366;
                        $foo->image_ratio_y = true;
                        $foo->Process('../assets/img/product/little/');
                        
                        if ( $foo->processed ) {
                            $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                            $img = $foo->file_dst_name;
                        }else{
                            $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                        }
                    }


    
                    $doinsert = $db->prepare("INSERT INTO product SET
                    title=?,
                    description=?,
                    img=?,
                    img_alt=?,
                    lang=?,
                    langid=?,
                    category=?,
                    dimensions=?,
                    active=?,
                    seotitle=?,
                    seodescription=?,
                    seourl=?,
                    seokeyword=?");
                    $insert = $doinsert->execute(array(
                        $_POST["title"],
                        $_POST["description"],
                        $img,
                        $_POST["img_alt"],
                        $_POST["lang"],
                        0,
                        $_POST["category"],
                        $_POST["dimensions"],
                        $active,
                        $seotitle,
                        $_POST["seodescription"],
                        $url,
                        $_POST["seokeyword"]
                    ));
                    if($insert){
                        $_SESSION["success"] = $_SESSION["success"]."urunler veritabanına başarı ile eklendi.";
                        header('Location:'.$siplink.'urunler');
                    }else{
                        $_SESSION["failure"] = "urunler veritabanına eklenirken bir hata meydana geldi.";
                        header('Location:'.$siplink.'urunler');
                    }
    
                }elseif($dothis == 'duzenle'){
    
                    $active = ($_POST["active"] != 1) ? 0 : 1;
                    $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                    $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                    $img = '';
                    $getimg = $db->query("SELECT img FROM product WHERE id={$editid}")->fetch(PDO::FETCH_ASSOC);
                    $img = $getimg["img"];
    
                    @$foo = new Upload($_FILES["img"]);
                    if ($foo->uploaded) {
                        $rsmbaslik = seo($_POST["title"]);
                        $foo->file_new_name_body = $rsmbaslik;
                        $resim=$foo->file_new_name_body;
                        $foo->image_resize = true;
                        $foo->image_convert = 'jpg';
                        //$foo->jpeg_quality = 65;
                        $foo->image_x = 1920;
                        $foo->image_ratio_y = true;
                        $foo->Process('../assets/img/product/');
                        
                        if ( $foo->processed ) {
                            $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                            unlink('../assets/img/product/'.$img);
                            $img = $foo->file_dst_name;
                        }else{
                            $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                        }
                    }
    
    
                    $doupdate = $db->prepare("UPDATE product SET
                    title=:title,
                    description=:description,
                    img=:img,
                    img_alt=:img_alt,
                    lang=:lang,
                    langid=:langid,
                    category=:category,
                    dimensions=:dimensions,
                    active=:active,
                    seotitle=:seotitle,
                    seodescription=:seodescription,
                    seourl=:seourl,
                    seokeyword=:seokeyword
                    WHERE id = :editid");
                    $update = $doupdate->execute(array(
                        "title" => $_POST["title"],
                        "description" => $_POST["description"],
                        "img" => $img,
                        "img_alt" => $_POST["img_alt"],
                        "lang" => $_POST["lang"],
                        "langid" => $_POST["langid"],
                        "category" => $_POST["category"],
                        "dimensions" => $_POST["dimensions"],
                        "active" => $active,
                        "seotitle" => $seotitle,
                        "seodescription" => $_POST["seodescription"],
                        "seourl" => $url,
                        "seokeyword" => $_POST["seokeyword"],
                        "editid" => $editid
                    ));
                    if($update){
                        $_SESSION["success"] = $_SESSION["success"]."urunler başarı ile güncellendi.";






                        header('Location:'.$siplink.'urunler');
                    }else{
                        $_SESSION["failure"] = "urunler güncellenirken bir hata meydana geldi.";
                        header('Location:'.$siplink.'urunler');
                    }
    
                }
                break;

                case 'blog':
                    if($dothis == 'ekle'){
                        $active = ($_POST["active"] != 1) ? 0 : 1;
                        $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                        $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                        $img = '';
        
                        @$foo = new Upload($_FILES["img"]);
                        if ($foo->uploaded) {
                            $rsmbaslik = seo($_POST["title"]);
                            $foo->file_new_name_body = $rsmbaslik;
                            $resim=$foo->file_new_name_body;
                            $foo->image_resize = true;
                            $foo->image_convert = 'jpg';
                            //$foo->jpeg_quality = 65;
                            $foo->image_x = 1920;
                            $foo->image_ratio_y = true;
                            $foo->Process('../assets/img/blog/');
        
                            // $foo->file_new_name_body = $rsmbaslik;
                            // $resim=$foo->file_new_name_body;
                            // $foo->image_resize = true;
                            // $foo->image_convert = 'jpg';
                            // //$foo->jpeg_quality = 65;
                            // $foo->image_x = 526;
                            // $foo->image_ratio_y = true;
                            // $foo->Process('../assets/images/blog/little/');
                            
                            if ( $foo->processed ) {
                                $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                                $img = $foo->file_dst_name;
                            }else{
                                $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                            }
                        }
                        $date = date('Y.m.d');
                        $doinsert = $db->prepare("INSERT INTO blog SET
                        title=?,
                        description=?,
                        img=?,
                        img_alt=?,
                        lang=?,
                        langid=?,
                        seotitle=?,
                        seodescription=?,
                        seourl=?,
                        seokeyword=?,
                        adate=?,
                        active=?");
                        $insert = $doinsert->execute(array(
                            $_POST["title"],
                            $_POST["description"],
                            $img,
                            $_POST["img_alt"],
                            $_POST["lang"],
                            $_POST["langid"],
                            $seotitle,
                            $_POST["seodescription"],
                            $url,
                            $_POST["seokeyword"],
                            $date,
                            $active
                        ));
                        if($insert){
                            $_SESSION["success"] = $_SESSION["success"]."blog veritabanına başarı ile eklendi.";
                            header('Location:'.$siplink.'blog');
                        }else{
                            $_SESSION["failure"] = "blog veritabanına eklenirken bir hata meydana geldi.";
                            header('Location:'.$siplink.'blog');
                        }
        
                    }elseif($dothis == 'duzenle'){
        
                        $active = ($_POST["active"] != 1) ? 0 : 1;
                        $seotitle = ($_POST["seotitle"] == '') ? $_POST["title"] : $_POST["seotitle"];
                        $url = ($_POST["url"] == '') ? seo($_POST["title"]) : $_POST["url"];
                        $img = '';
                        $getimg = $db->query("SELECT img FROM blog WHERE id={$editid}")->fetch(PDO::FETCH_ASSOC);
                        $img = $getimg["img"];
        
                        @$foo = new Upload($_FILES["img"]);
                        if ($foo->uploaded) {
                            $rsmbaslik = seo($_POST["title"]);
                            $foo->file_new_name_body = $rsmbaslik;
                            $resim=$foo->file_new_name_body;
                            $foo->image_resize = true;
                            $foo->image_convert = 'jpg';
                            //$foo->jpeg_quality = 65;
                            $foo->image_x = 1920;
                            $foo->image_ratio_y = true;
                            $foo->Process('../assets/img/blog/');
                            
                            if ( $foo->processed ) {
                                $_SESSION["success"] = "Resim Başarı ile yüklendi.";
                                unlink('../assets/img/blog/'.$img);
                                $img = $foo->file_dst_name;
                            }else{
                                $_SESSION["failure"] = "Resim yüklerken bir hata meydana geldi.".$foo->error;
                            }
                        }
        
        
                        $doupdate = $db->prepare("UPDATE blog SET
                        title=:title,
                        description=:description,
                        img=:img,
                        img_alt=:img_alt,
                        lang=:lang,
                        langid=:langid,
                        seotitle=:seotitle,
                        seodescription=:seodescription,
                        seokeyword=:seokeyword,
                        seourl=:seourl,
                        active=:active
                        WHERE id = :editid");
                        $update = $doupdate->execute(array(
                            "title" => $_POST["title"],
                            "description" => $_POST["description"],
                            "img" => $img,
                            "img_alt" => $_POST["img_alt"],
                            "lang" => $_POST["lang"],
                            "langid" => $_POST["langid"],
                            "seotitle" => $seotitle,
                            "seodescription" => $_POST["seodescription"],
                            "seourl" => $url,
                            "seokeyword" => $_POST["seokeyword"],
                            "active" => $active,
                            "editid" => $editid
                        ));
                        if($update){
                            $_SESSION["success"] = $_SESSION["success"]."blog başarı ile güncellendi.";
                            header('Location:'.$siplink.'blog');
                        }else{
                            $_SESSION["failure"] = "blog güncellenirken bir hata meydana geldi.";
                            header('Location:'.$siplink.'blog');
                        }
        
                    }
                    break;
        
        default:
            # code...
            break;
    }
    

}

?>