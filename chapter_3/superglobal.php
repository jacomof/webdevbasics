<?php
//PHP script to show an example of a super global variable.
//These are special variables initialized automatically by PHP to hold information about the system, the session, cookies, the script itself,
//and other useful information controlled by the server.

//Here we reference the _SERVER super variable, which contains information of the server itself, like its IP address and its name.
$ref = $_SERVER['SERVER_NAME'];
//Here we access the server name and the ip of the user being served this site.
echo "Nombre del servidor es: $_SERVER[SERVER_NAME] y la ip del usuario es: $_SERVER[REMOTE_ADDR]";