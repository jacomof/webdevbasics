<?php

require_once $_SERVER['DOCUMENT_ROOT']."/test/chapter_8-11/mysql_login.php";

$db_conn = new mysqli($sql_host, $sql_user,
    $sql_pwd, $sql_database);

$table_exists = ($db_conn->query("select TABLE_NAME from information_schema.tables
where TABLE_NAME = 'users';"))->num_rows > 0;

if(!$table_exists){
    $created_table = $db_conn->query("CREATE TABLE users (username varchar(256) PRIMARY KEY,
                    password varchar(256))");
    if(!$created_table)
        die("Problem while accessing users information. Contact support at: 555 555.");
}


if(isset($_POST['username']) && isset($_POST['pwd']))
{
    $username = make_safe($db_conn, $_POST['username']);
    $tmp_salt = random_bytes(10);
    $pwd = hash('sha256', make_safe($db_conn, $_POST['pwd']).$tmp_salt);
    $user_exists = $db_conn->query("SELECT username from users where username='$username'")->num_rows > 0;

    if($user_exists)
        die("User $username already exists!");
    else{
        $user_add_successful = $db_conn->query("INSERT INTO users
        VALUES ('$username', '$pwd', '$tmp_salt')");
        if($user_add_successful){
            echo "User added successfully!<br>";
        }else echo "Error while adding user! $db_conn->error <br>";
        echo "<a href='http://www.joaqwebsite.com/test/chapter13/authentication_v2.php'>Go to site</a>";
    }
}else{
    
    echo <<<_END
        <form file='creating_users_w_hashing_and_salting.php' method='post'>
        Enter user: <input type='text' maxlength='20' name='username' required> <br>
        Enter password: <input type='text' minlength='6' name='pwd' required> <br><br>
        <input type='submit' value='Create User'>
           
    _END;
    
}

function make_safe(mysqli $db_conn, $input)
{
    $input = $db_conn->real_escape_string($input);
    $input = htmlentities($input);
    $input = strip_tags($input);
    return $input;
}