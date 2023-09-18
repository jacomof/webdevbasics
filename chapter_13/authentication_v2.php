<?php
/*PHP script to showcase how to create a log in system based on the user base of the creating_users_w_hashing_and_salting.php page.*/

require_once $_SERVER['DOCUMENT_ROOT']."/joaq_website/webdevbasics/chapter_8-11/mysql_login.php";

$db_conn = new mysqli($sql_host, $sql_user, $sql_pwd, $sql_database);
if($db_conn->connect_errno)
    die("Website malfunction. Contact support at support.me.withyourmoney.com.");

#For security, set this option to only allow cookie's based sessions (sessionIDs sent through the url are ignored)
ini_set("session.use_only_cookies", 1);

//We then use the session_start function to start a session if it isn't started already. The function does nothing if the session
//a session is already created.
session_start();

//First we check wether the user has already authenticated.
if(!isset($_SESSION['authenticated'])){

    //If the user posted their credentials using the HTTP authentication system, will find them at the _SERVER superglobal with they
    //keys 'PHP_AUTH_USER' (user) and 'PHP_AUTH_PW' (password).
    if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

        //We sanitize the input to prevent sql injection and other security risks.
        $user = sanitize_input($db_conn, $_SERVER['PHP_AUTH_USER']);
        //Check for the user's hashed password and salt in the database.
        $query_res = $db_conn->query("SELECT password, salt FROM users WHERE username='$user'");
        
        if(!$query_res){
            die("Website malfunction. Contact support at support.me.withyourmoney.com. $db_conn->error");
        }
        if($query_res->num_rows > 0){
            echo "entered user<br>";
            $stored_row = $query_res->fetch_row();
            $stored_pwd = $stored_row[0];
            $salt = $stored_row[1];
            //We salt and hash the input password to compare it with the password inside of the DB. 
            $pwd = hash('sha256', sanitize_input($db_conn, $_SERVER['PHP_AUTH_PW']).$salt);
            echo "calculated hash <br>";
            if($stored_pwd == $pwd){
                //Regenerate id when loging in to prevent session fixation in case url based sessions are enabled.
                //This prevents session hijacking.
                session_regenerate_id();
                echo "entered pwd <br>";
                //Finally, we store the user in the session super global variable that contains the users' session information. 
                $_SESSION['username'] = $user; 
                $_SESSION['authenticated'] = true;
                echo "Hello $user. You have been authenticated!";
            }else {
                echo "No password matches the submitted credentials.<br>";
            }
            
        }else{
            echo "No user or password matches the submitted credentials.<br>";
        }
    }else{
        //As in the previous exercise, we use HTTP based authentication through the Authenticate header.
        header("WWW-Authenticate: Basic realm='Restricted user zone'");
        header("HTTP/1.0 401: Unauthorized");
        die("Couldn't authenticate the user");
    }
}else
    //In case the user already loggged in, we just inform of this fact.
    echo "You have already been authenticated $_SESSION[username]";

//Function used for input validation.
function sanitize_input(mysqli $db_conn, string $input){
    $input = $db_conn->real_escape_string($input);
    $input = htmlentities($input);
    $input = strip_tags($input);
    return $input;
}

