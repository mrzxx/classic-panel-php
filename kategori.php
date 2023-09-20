<?php 
$tablename = 'category';

$categories_tr = $db->query("SELECT * FROM category WHERE langid=0", PDO::FETCH_ASSOC);



?>
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <?php 
            if(isset($_SESSION["success"])){
            ?>
            <strong style="display:block;color:green;"><?php echo $_SESSION["success"]; ?></strong>
            <?php
            unset($_SESSION["success"]);
            }
            if(isset($_SESSION["failure"])){
            ?>
            <strong style="display:block;color:red;"><?php echo $_SESSION["failure"]; ?></strong>
            <?php
            unset($_SESSION["failure"]);
            }
            ?>

            <h3 class="box-title">Kategoriler Sayfası</h3>
            <?php 
            if($_GET["target"] == 'add12412'){

            ?>
            <p class="text-muted">Kategori EKLE <code></code></p>
            <div class="row">
                <div class="col-md-8">
                    <form enctype="multipart/form-data" style="padding-top:15px;" action="<?php echo $siplink.'operations.php'; ?>" method="POST">
                        <div class="finput">
                            <label for="title2">Kategori Dili</label>
                            <select class="form-control" name="lang" id="title2" required>
                                <option value ="tr">Türkçe</option>
                                <option value ="en">İngilizce</option>
                                <option value ="ar">Arapça</option>
                            </select>
                        </div>
                        <div class="finput">
                            <label for="title2">Kategori'nin Varsa Bağlı Olduğu Orjinal Dili</label>
                            <select class="form-control" name="langid" id="title2" required>
                                <option value ="0" selected>Orjinal Dil(Kendisi)</option>
                                <?php 
                                if ( $categories_tr->rowCount() ){
                                    foreach( $categories_tr as $row ){
                                        
                                        ?>
                                        <option value ="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="finput">
                            <label for="title">Kategori Başlığı</label>
                            <input class="form-control" type="text" name="title" id="title" required>
                        </div>
                        <div class="finput">
                            <label for="description">Kategori Açıklaması</label>
                            <textarea class="form-control" name="description" id="description" rows="10" required></textarea>
                        </div>
                        <div class="finput">
                            <label for="img">Kategori Resim (1920x1080):</label>
                            <input id="img" class="form-control" type="file" name="img" data-filename-placement="inside" required>
                        </div>

                        <div class="finput">
                            <label for="img_alt">Kategori Resim ALT (SEO)</label>
                            <input class="form-control" type="text" name="img_alt" id="img_alt" required>
                        </div>
                        <div class="finput">
                            <label for="seotitle">SEO Title (Zorunlu)</label>
                            <input class="form-control" type="text" name="seotitle" id="seotitle" required>
                        </div>
                        <div class="finput">
                            <label for="seodescription">SEO Desc* (Zorunlu)</label>
                            <input class="form-control" required type="text" name="seodescription" id="seodescription">
                        </div>
                        <div class="finput">
                            <label for="seokeyword">SEO Keyword (isteğe bağlı)</label>
                            <input class="form-control" type="text" name="seokeyword" id="seokeyword">
                        </div>
                        <div class="finput">
                            <label for="url">SEO URL (isteğe bağlı)</label>
                            <input class="form-control" type="text" name="url" id="url">
                        </div>
                        
                        <input type="hidden" name="operation" value="kategori,ekle">
                        <input type="submit" name="submitted" value="KATEGORİ EKLE" class="btn d-grid btn-danger text-white">
                    </form>
                </div>
            </div>
            
            <?php

            }else if($_GET["target"] == 'edit12412'){
                $editid = seo($_GET["editid"]);
                $project = $db->query("SELECT * FROM category WHERE id='{$editid}'")->fetch(PDO::FETCH_ASSOC);
                if($project){
                    $_SESSION["editid"] = $project["id"];
                    ?>
                    <p class="text-muted">Kategori DÜZENLE <code></code></p>
                    <div class="row">
                    <div class="col-md-8">
                    <form enctype="multipart/form-data" style="padding-top:15px;" action="<?php echo $siplink.'operations.php'; ?>" method="POST">
                        <div class="finput">
                            <label for="title2">Kategori Dili</label>
                            <select class="form-control" name="lang" id="title2" required>
                                <option <?php if($project["lang"] == "tr"){echo 'selected';} ?> value ="tr">Türkçe</option>
                                <option <?php if($project["lang"] == "en"){echo 'selected';} ?> value ="en">İngilizce</option>
                            </select>
                        </div>
                        <div class="finput">
                            <label for="title2">Kategori'nin Varsa Bağlı Olduğu Orjinal Dili</label>
                            <select class="form-control" name="langid" id="title2" required>
                                <option value ="0" selected>Orjinal Dil(Kendisi)</option>
                                <?php 
                                if ( $categories_tr->rowCount() ){
                                    foreach( $categories_tr as $row ){
                                        if($row["id"] != $project["id"]){

                                        
                                        ?>
                                        <option value ="<?php echo $row['id']; ?>" <?php if($project["langid"] == $row['id']){echo 'selected';} ?>><?php echo $row['title']; ?></option>
                                        <?php
                                    } }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="finput">
                            <label for="title">Kategori Başlığı</label>
                            <input class="form-control" type="text" name="title" value="<?php echo $project["title"]; ?>" id="title" required>
                        </div>
                        <div class="finput">
                            <label for="description">Kategori Açıklaması</label>
                            <textarea class="form-control" name="description" id="description" rows="10" required><?php echo $project["description"]; ?></textarea>
                        </div>
                        <div class="finput">
                            <label for="img">Kategori Resim (1920x1080):</label>
                            <input id="img" class="form-control" type="file" name="img" data-filename-placement="inside">
                            <?php if($project["img"] != ""){ ?>
                                    <img id="anaresim" width="180" src="<?php echo $mainlink.'assets/img/category/'.$project['img']; ?>" alt=""/>
                                    <a class="anaresimsil" style="display:block;margin-top:10px;color:red;" id="<?php echo $project["id"]; ?>&anaresimsil=1&table=category" href="#">AnaResim Sil (X)</a>
                                    <?php
                                } ?>
                        </div>
                        <div class="finput">
                            <label for="img_alt">Kategori Resim ALT (SEO)</label>
                            <input class="form-control" type="text" name="img_alt" id="img_alt" value="<?php echo $project["img_alt"]; ?>" required>
                        </div>
                        <div class="finput">
                            <label for="seotitle">SEO Title (Zorunlu)</label>
                            <input class="form-control" type="text" name="seotitle" id="seotitle" value="<?php echo $project["seotitle"]; ?>" required>
                        </div>
                        <div class="finput">
                            <label for="seodescription">SEO Desc* (Zorunlu)</label>
                            <input class="form-control" required type="text" name="seodescription" value="<?php echo $project["seodescription"]; ?>" id="seodescription">
                        </div>
                        <div class="finput">
                            <label for="seokeyword">SEO Keyword (isteğe bağlı)</label>
                            <input class="form-control" type="text" name="seokeyword" value="<?php echo $project["seokeyword"]; ?>" id="seokeyword">
                        </div>
                        <div class="finput">
                            <label for="url">SEO URL (isteğe bağlı)</label>
                            <input class="form-control" type="text" name="url" value="<?php echo $project["seourl"]; ?>" id="url">
                        </div>
                        
                        <input type="hidden" name="operation" value="kategori,duzenle">
                        <input type="submit" name="submitted" value="KATEGORİ DÜZENLE" class="btn d-grid btn-danger text-white">
                    </form>
                    </div>
                </div>
                    <?php
                }else{
                    ?>  
                    <p class="text-muted">Kategori ID BULUNAMADI <code></code></p>
                    <?php
                }
                ?>
                
                
                
                <?php
    
                }else{
            ?>
            <p class="text-muted">Listele <code></code></p>
            <div class="table-responsive">
                <table id="table_id">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">img</th>
                            <th class="border-top-0">Başlık</th>
                            <th class="border-top-0">Dil</th>
                            <th class="border-top-0">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                    
                        

                        $rows = $db->query("SELECT * FROM category ORDER BY id",PDO::FETCH_ASSOC);
                        if(1==1){
                            foreach ($rows as $row) {
                                ?>
                                <tr class="trow">
                                    <td><?php echo $row["id"]; ?></td>
                                    <td>
                                        <img width="80" src="<?php echo $webfile.'img/category/'.$row["img"]; ?>" alt="">
                                        
                                    </td>
                                    <td>
                                    <?php echo $row["title"] ?>
                                    </td>
                                    <td><?php echo $row["lang"]; ?></td>
                                    <td><a class="btn btn-primary" href="<?php echo $siplink.'kategori?target=edit12412&editid='.$row["id"] ?>">Düzenle</a>
                                        <a class="btn btn-warning delbutton" id="<?php echo $row["id"]; ?>&table=category" href="#">Sil [X]</a></td>
                                </tr>
                                <?php
                                }
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
            
            <?php
            }
            
            ?>



            



        </div>
    </div>
</div>