<?php

echo <<<_END

<html><head><title>Plato's cookies</title></head>
<h1>Plato's cookies: your website for the best doggy cookies ever</h1>

_END;
session_start();
if(!isset($_SESSION['username'])){
    if(!isset($_POST['username']) || !isset($_POST['pwd'])){
        
        echo <<<_END
            
        <form file="authentication.php" method='post'>
        Enter username: <input type='text' size='20' name='username' required> <br>
        Enter password: <input type='password' minlength='6' name='pwd' required><br><br>
        <input type='submit' value='login'>
        
        </form>            
        _END;
    }else if($_POST['username'] == 'platiAdmin' && $_POST['pwd'] == 'administrator'){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['pwd'] = $_POST['pwd'];
        echo "Hello $_SESSION[username]. You have been authenticated. <br>";
    }else{
        echo "No user matches your credentials. <br>";
    }
}
else if($_SESSION['username'] == 'platiAdmin' and $_SESSION['pwd'] == 'administrator'){
    
    echo "hello Plati!! <br>";
    
}else{
    
    echo "Who are you? You do NOT have access to this site. Fuck-off you weirdo! Stop trying to break in!
Your IP has been logged and will be reported to police. Joke's on you! <br>";
}