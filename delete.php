<?php
session_start();

define("security",true);
require_once 'includes/config.php';
require_once 'includes/basic-functions.php';

if(isset($_SESSION["adminid"])){

    if(permission_control($_SESSION["adminid"],'d')){


    

if($_GET["anaresimsil"] == 1){

    $id = tmz($_GET['id']);
    $table = tmz($_GET['table']);
    $query2133 = $db->query("SELECT id,img FROM {$table} WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
    $images = $query2133["img"];
    $editid = $query2133["id"];
        if($query2133){

        

        $doupdate = $db->prepare("UPDATE category SET
                img=:img
                WHERE id = :editid");
        $update = $doupdate->execute(array(
            "img" => "",
            "editid" => $editid
        ));
        if($update){
            
            //resim varsa sil
            unlink('../assets/img/'.$table.'/'.$images);
            unlink('../assets/img/'.$table.'/'.$images);
        }

        }   


}else if($_GET["anaresimsil"] == 2){

    $id = tmz($_GET['id']);
    $table = tmz($_GET['table']);
    $query2133 = $db->query("SELECT id,img FROM {$table} WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
    $images = $query2133["img"];
    $editid = $query2133["id"];
        if($query2133){

        

        $doupdate = $db->prepare("UPDATE product SET
                img=:img
                WHERE id = :editid");
        $update = $doupdate->execute(array(
            "img" => "",
            "editid" => $editid
        ));
        if($update){
            
            //resim varsa sil
            unlink('../assets/img/'.$table.'/'.$images);
        }

        }   


}else if($_GET["anaresimsil"] == 3){

    $id = tmz($_GET['id']);
    $table = tmz($_GET['table']);
    $query2133 = $db->query("SELECT id,img FROM {$table} WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
    $images = $query2133["img"];
    $editid = $query2133["id"];
        if($query2133){

        

        $doupdate = $db->prepare("UPDATE blog SET
                img=:img
                WHERE id = :editid");
        $update = $doupdate->execute(array(
            "img" => "",
            "editid" => $editid
        ));
        if($update){
            
            //resim varsa sil
            unlink('../assets/img/'.$table.'/'.$images);
        }

        }   


}else if($_GET["anaresimsil"] == 3000){

    $id = tmz($_GET['id']);
    $table = tmz($_GET['table']);
    $query2133 = $db->query("SELECT * FROM {$table} WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
    $images = $query2133["img"];
    $editid = $query2133["id"];
        if($query2133){

            unlink('../assets/img/product/imgs/'.$images);
            $del3000 = $db->prepare("DELETE FROM img WHERE id = :id");
            $del3001 = $del3000->execute(array('id' => $editid));
        }   


}else if($_GET['id'])
{
    $table = tmz($_GET['table']);
    $id = tmz($_GET['id']);


    if($table == 'product'){
        $query3000 = $db->query("SELECT * FROM img WHERE id={$id}",PDO::FETCH_ASSOC);
        if($query3000){
            foreach ($query3000 as $row) {
                unlink('../assets/img/product/imgs/'.$row["img"]);
                $del3000 = $db->prepare("DELETE FROM img WHERE id = :id");
                $del3001 = $del3000->execute(array('id' => $row["id"]));
            }
        }
    }

    

    $query2133 = $db->query("SELECT img FROM {$table} WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
    $images = $query2133["img"];
    

        $query1609 = $db->prepare("DELETE FROM {$table} WHERE id = :id");
        $delete = $query1609->execute(array(
        'id' => $id
        ));
        if($delete){
            //resim varsa sil
            unlink('../assets/img/'.$table.'/'.$images);
        }
    
    
        
}

}
}

?>
