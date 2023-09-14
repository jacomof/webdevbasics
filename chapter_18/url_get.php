<?php

if(isset($_GET['url'])){
    $url = 'http://'.$_GET['url'];
    echo file_get_contents(fix_string($url));
}


function fix_string($text){
    $text=strip_tags($text);
    $text=htmlentities($text);
    return stripslashes($text);
}
?>