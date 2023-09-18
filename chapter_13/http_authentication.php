<?php
/*PHP script to demostrate how to use HTTP based authentication in php.*/ 

$user = 'plati';
$pwd = 'pl@ti';

//Input validation of the values posted by the user using HTTP authentication
if(isset($_SERVER["PHP_AUTH_USER"]) &&
    isset($_SERVER["PHP_AUTH_PW"])){
        if($_SERVER["PHP_AUTH_USER"] == $user && 
            $_SERVER["PHP_AUTH_PW"] == $pwd)
                echo "Hello $_SERVER[PHP_AUTH_USER]. You're now logged in! <br><br>";
        else
            die("Invalid username/password combination! <br><br>");
        
}else{
    //If the user hasn't posted his credentials, we ask him to do so with the WWW-Authenticate header
    header('WWW-Authenticate: Basic realm="Restricted Section" charset="UTF-8"');
    //In case we already sent the header, but they didn't match the user and password, we send a 
    //HTTP/1.01 401: Unauthorized header to notify the user his request was rejected.
    header('HTTP/1.0 401: Unauthorized');
    die("Please enter your username and password");
}