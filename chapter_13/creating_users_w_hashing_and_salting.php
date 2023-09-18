<?php
/*PHP script to demonstrate how to create a user in a web application securely using a username, password, salting and a MySQL
database.*/

//We include the database log in credentials. 
require_once $_SERVER['DOCUMENT_ROOT']."/joaq_website/webdevbasics/chapter_8-11/mysql_login.php";

//We create the database connection.
$db_conn = new mysqli($sql_host, $sql_user,
    $sql_pwd, $sql_database);

//We execute a query to check if the users table exists;
$table_exists = ($db_conn->query("select TABLE_NAME from information_schema.tables
where TABLE_NAME = 'users';"))->num_rows > 0;

//If it doesn't we create it.
if(!$table_exists){
    $created_table = $db_conn->query("CREATE TABLE users (username varchar(256) PRIMARY KEY,
                    password varchar(256))");
    if(!$created_table)
        die("Problem while accessing users information. Contact support at: 555 555.");
}


//Input validation of the provided credentials.
if(isset($_POST['username']) && isset($_POST['pwd']))
{
    //We sanitize the string to avoid sql injections and other security risks.
    $username = make_safe($db_conn, $_POST['username']);
    //We calculate the salt
    $tmp_salt = random_bytes(10);
    //And hash the password using it.
    $pwd = hash('sha256', make_safe($db_conn, $_POST['pwd']).$tmp_salt);
    //We execute query to see if user exists in the database.
    $user_exists = $db_conn->query("SELECT username from users where username='$username'")->num_rows > 0;

    //If it does we don't create it.
    if($user_exists)
        die("User $username already exists!");
    else{
        //Else we add it to the database.
        $user_add_successful = $db_conn->query("INSERT INTO users
        VALUES ('$username', '$pwd', '$tmp_salt')");
        if($user_add_successful){
            echo "User added successfully!<br>";
        }else echo "Error while adding user! $db_conn->error <br>";
        echo "<a href='authentication_v2.php'>Go to site</a>";
    }
}else{
    //We print the input form to submit the users' credentials.
    echo <<<_END
        <form file='creating_users_w_hashing_and_salting.php' method='post'>
        <!--We provide minimal client side input validation by especifying a maximum length for the user and a minimum length for the password.-->
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