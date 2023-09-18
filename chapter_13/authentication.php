<?php
/*PHP script to showcase a log in system using a fixed password and username.*/


echo <<<_END

<html><head><title>Plato's cookies</title></head>
<h1>Plato's cookies: your website for the best doggy cookies ever</h1>

_END;

//First we start the session using the session_start function. In case the session is already created the function does nothing.
session_start();

//We check if the user already logged in.
if(!isset($_SESSION['username'])){

    //Then we check if the user submitted their crendentials using a POST request.
    if(!isset($_POST['username']) || !isset($_POST['pwd'])){

        //If they haven't we display the form used to submit the users' credentials.
        echo <<<_END
            
        <form file="authentication.php" method='post'>
        Enter username: <input type='text' size='20' name='username' required> <br>
        Enter password: <input type='password' minlength='6' name='pwd' required><br><br>
        <input type='submit' value='login'>
        
        </form>            
        _END;
    
    //If they have, we validate them using the fixed password and username.
    //Input sanitation would be needed here, but for simplicity's sake we'll avoid it.
    }else if($_POST['username'] == 'platiAdmin' && $_POST['pwd'] == 'administrator'){

        //If correct, we update the _SESSION superglobal to indicate that the user has logged in correctly.
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['pwd'] = $_POST['pwd'];
        echo "Hello $_SESSION[username]. You have been authenticated. <br>";
    }else{
        echo "No user matches your credentials. <br>";
    }
}

//If the user is already signed in, we salute them!
else if($_SESSION['username'] == 'platiAdmin' and $_SESSION['pwd'] == 'administrator')    
    echo "hello Plati!! <br>";
    
else{

    //If the user has their session information already set, but it doen't match the fixed credentials, we warn them of their mischief!
    echo "Who are you? You do NOT have access to this site. Fuck-off you weirdo! Stop trying to break in!
Your IP has been logged and will be reported to police. Joke's on you! <br>";

}