<?php

error_reporting ( E_ALL ) ;
ini_set ( 'display_errors' , 1 ) ;



echo !defined("security") ? die("Error 404") : null;

try {
     $db = new PDO("mysql:host=localhost;dbname=opusartecom_panel;charset=utf8", "opusartecom_panel", "_m={Q1qz*1i#");
} catch ( PDOException $e ){
     print $e->getMessage();
}//  
date_default_timezone_set('Europe/Istanbul');
//Ayarlar NOT : index.php içindeki delete.php ye yönlendiren ajax komutundaki linkide düzenleyin
$firma_adi = "Accascup Panel";
$weblink = "https://opusarte.com.tr/sip/";
$filelink = "https://opusarte.com.tr/sip/";
$siplink = "https://opusarte.com.tr/sip/";
$webfile = "https://opusarte.com.tr/assets/";
$mainlink = "https://opusarte.com.tr/";


?>