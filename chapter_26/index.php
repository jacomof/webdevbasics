<?php
require_once "header.php";

echo "<div class='main'>Welcome to Platespace, the leading fake social network for dogs in the world! <br><br>";

if(!$loggedin)
    echo "Please <b>sign up</b> or <b>log in</b> to have access to all of the <b>website's features</b>.";
else
    echo "The user $user is currently logged in.";

echo "</div>";

?>