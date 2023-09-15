<?php
//Simple php file to check wether the username inputted to the file via HTTP POST 
//exists in platespace's database

require_once "functions.php";

if(isset($_POST['username'])){

    $user = sanitize_string($_POST['username']);

    if(check_user_existance($user))
        echo "true";
    else
        echo "false";

    
}else echo "No parameters!";

?>