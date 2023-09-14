<?php
/*This PHP document implements "platespace"'s header, which is a section of the code that is include in all other pages. This is the part 
of the website which is common to all of the site, and contains the website's title, logo and links to the different sections
for navigation.*/



//We first start a session so we can access session information such as user names, passwords, etc.
if(!isset($_SESSION))
    session_start();

//We include in the script  all the auxliary functions that will be reused in every other file. 
require_once 'functions.php';


//We check wether the user is already logged in.
$user_str = " (Guest)";


if(isset($_SESSION['username'])){

    if(!isset($loggedin)) $loggedin = true;
    $user = $_SESSION['username'];
    $user_str = " ($user)";


}else $loggedin = false;


//We write the head section of the page, as well as the canvas element, using the $appname and $user_str variables for the website's title. 
echo <<<_END

<html>
<head>
<title>$appname$user_str</title>
<style>
    @import url('styles/platespace.css')
</style>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<div id="title-container">
<canvas id="title-image" width='700' height='90'>$appname</canvas>
</div>
<script src="scripts/core_script.js"></script>
_END;



//If the user is logged in, we show links to all the websites features (not including the log in/sign up since the user is already past that stage).
if($loggedin)
{

    echo <<<_END
    <div class='header-button-container main'>
        <a href="index.php" class="header-button">Home</a>
        <a href="profile.php" class="header-button">My Profile</a>
        <!--For the members.php website we pass the name of the current user inside the link's url so the site can show the member 
        information correctly relative to the user.-->
        <a href="members.php?view=$user" class="header-button">Members</a>
        <a href="friends.php" class="header-button">Friends</a>
        <a href="messages.php" class="header-button">Messages</a>
        <a href="logout.php" class="header-button">Logout</a>
    </div>
    _END;

}
//If it's not, we only show links to parts of the website the user can log in or sign up.
else{

    echo <<<_END
    <div class='header-button-container main'>
        <a href="index.php" class="header-button">Home</a>
        <a href="login.php" class="header-button">Log in</a>
        <a href="signup.php" class="header-button">Sign up</a>
        <br>
    </div> 
    <span class='info main'>You must be logged in to view this page.</span>
    _END;

}

?>

