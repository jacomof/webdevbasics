<?php
require_once "$_SERVER[DOCUMENT_ROOT]/test/chapter_8-11/mysql_login.php";

$db_conn = new mysqli($sql_host, $sql_user, $sql_pwd, $sql_database);
if($db_conn->connect_errno)
    die("Website malfunction. Contact support at support.me.withyourmoney.com.");

#For security, set this option to only allow cookie's based sessions (sessionIDs sent through the url are ignored)
ini_set("session.use_only_cookies", 1);
session_start();

if(!isset($_SESSION['authenticated'])){
    if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
        $user = sanitize_input($db_conn, $_SERVER['PHP_AUTH_USER']);
        $query_res = $db_conn->query("SELECT password, salt FROM users WHERE username='$user'");
        
        if(!$query_res){
            die("Website malfunction. Contact support at support.me.withyourmoney.com. $db_conn->error");
        }
        if($query_res->num_rows > 0){
            echo "entered user<br>";
            $stored_row = $query_res->fetch_row();
            $stored_pwd = $stored_row[0];
            $salt = $stored_row[1];
            $pwd = hash('sha256', sanitize_input($db_conn, $_SERVER['PHP_AUTH_PW']).$salt);
            echo "calculated hash <br>";
            if($stored_pwd == $pwd){
                #Regenerate id when logingin to prevent session fixation in case url based sessions are enabled
                session_regenerate_id();
                echo "entered pwd <br>";
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
        header("WWW-Authenticate: Basic realm='Restricted user zone'");
        header("HTTP/1.0 401: Unauthorized");
        die("Couldn't authenticate the user");
    }
}else
    echo "You have already been authenticated $_SESSION[username]";
function sanitize_input(mysqli $db_conn, string $input){
    $input = $db_conn->real_escape_string($input);
    $input = htmlentities($input);
    $input = strip_tags($input);
    return $input;
}

