<?php 
echo !defined("security") ? die("Error 404") : null;

function permission_control($adminid,$require){
    global $db;
    $p_check = $db->query('select * from admins where id = '.$adminid.'')->fetch(PDO::FETCH_ASSOC);
    if ( $p_check ){
        $permission = $p_check["permissions"];
        for ($i=0; $i < strlen($permission); $i++) { 
            if($require == $permission[$i]) return True;
        }
    }
    return False;
}

function tmz($gelend){
    $hatali=array('&quot;','&#39;','&.#39','"',"'","“");
    $duzgun=array("`","`","`","`","`","`");
    $deger=str_replace($hatali,$duzgun,$gelend);
    return $deger;
}

function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
    $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    if (strstr($ip, ',')) {
    $tmp = explode (',', $ip);
    $ip = trim($tmp[0]);
    }
    } else {
    $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

function seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('.', '', $s);
    $s = str_replace('”', '', $s);
    $s = str_replace('“', '', $s);
    $s = str_replace('&', '', $s);
    $s = str_replace('--', '-', $s);
    $s = str_replace('---', '-', $s);
    $s = str_replace('`', '', $s);
    $s = str_replace('’', '', $s);
    $s = str_replace('%', '', $s);
    $s = str_replace('!', '', $s);
    $s = str_replace('‘', '', $s);
    $s = str_replace('–', '-', $s);
    $s = str_replace('?', '', $s);
    $s = str_replace('ä', 'a', $s);
    $s = str_replace('â', 'a', $s);
    $s = str_replace('×', '-', $s);
    $s = str_replace(';', '', $s);
    $s = str_replace('…', '', $s);
    $s = str_replace('Â', 'a', $s);
    $s = trim($s, '-');
    return $s;
}


?>