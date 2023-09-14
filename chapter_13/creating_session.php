<?php
#Just a test program to create a session. This allows the website to use the _SESSION array,
#but only after the session has been created with teh session_start function.
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Plati';
}else{
    
    echo "Your username is: $_SESSION[username]<br>";
    
}

