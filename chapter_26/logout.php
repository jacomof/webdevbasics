<?php

/*PHP script to log out of the page. It simply destroys the sessions using the function we defined in the functions.php file and redirects 
the user to the home page.*/

require_once 'header.php';

if($loggedin){

    destroy_session();
    echo "<span class='success main'>You've succesfully logged out of platespace. See you soon!</span>";
    header('Location: index.php', true, 301);

}else{
    //If the user somehow got to the log out page and had already logged out (or never had logged in), we notify them that they 
    //can no longer log out.
    echo "<span class='error main'>Cannot log out. You already logged out or you haven't log in yet!</span>";

}
?>