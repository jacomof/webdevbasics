<?php

if(isset($_POST['url'])){
    $url = 'http://'.$_POST['url'];
    echo file_get_contents(fix_string($url));
}


function fix_string($text){
    $text=strip_tags($text);
    $text=htmlentities($text);
    return stripslashes($text);
}
?>