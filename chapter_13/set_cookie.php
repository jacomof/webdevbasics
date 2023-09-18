<?php
/*PHP script to demonstrate how to create cookies with the setcookie functions.*/

$msg="";

//This snippet creates a cookie called accessed_site using the setcookie function, if it doesn't exist. When the page is refreshed
//the message "You have already been here :O" will be displayed
//Remember that cookies are created after the php has already finished execution, so detection of cookies can only
//happen if the site is refreshed or another link in the site is followed (and naturally not in the current instance of the page)
if(!isset($_COOKIE["accessed_site"]))

    //This function takes several values as arguments and creates a cookie. The first argument is the name of the cookie, the second argument is
    //the value of the cookie, and the third argument is the expiration timestamp of the cookie. 
    setcookie("accessed_site", "accessed", time()+60*60);
else
    $msg="<b>You have already been here :O</b><br>";

//Uncomment this to delete cookie. Setting the expires_or_options parameter of the setcookie function to a UNIX timestamp 
//in the past instructs 
//the browser to delete it.
/*

//To delete a cookie, we set it's expiration date to a time in the past.
setcookie("accessed_site", "accessed", time()-60);
if(isset($_COOKIE["accessed_site"]))
    $msg="<b>You have already been here :O</b><br>"; 
*/
    
echo <<<_HTML
<html>
<head><title>Cookies</title></head>
<body>
<h1>Messing with the cookies</h1>
$msg
</body>
</html>
_HTML;
    
    