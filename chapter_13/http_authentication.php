<?php
$user = 'plati';
$pwd = 'pl@ti';

if(isset($_SERVER["PHP_AUTH_USER"]) &&
    isset($_SERVER["PHP_AUTH_PW"])){
        if($_SERVER["PHP_AUTH_USER"] == $user && 
            $_SERVER["PHP_AUTH_PW"] == $pwd)
                echo "Hello $_SERVER[PHP_AUTH_USER]. You're now logged in! <br><br>";
        else
            die("Invalid username/password combination! <br><br>");
        
}else{
    header('WWW-Authenticate: Basic realm="Restricted Section" charset="UTF-8"');
    header('HTTP/1.0 401: Unauthorized');
    die("Please enter your username and password");
}