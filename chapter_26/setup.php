<?php

require_once "functions.php";


//We create the USERS table using the following query 
$create_users_query =
<<<_END
    CREATE TABLE IF NOT EXISTS USERS
    (username VARCHAR(32) PRIMARY KEY, 
    password VARCHAR(1024), 
    description TEXT,
    INDEX(username(6)));
_END;
execute_query($create_users_query);

//We create the FRIENDS table using the following query
$create_friends_query = 
<<<_END
    CREATE TABLE IF NOT EXISTS FRIENDS
    (username VARCHAR(32), 
    friend VARCHAR(32), 
    PRIMARY KEY(username, friend));
_END;
execute_query($create_friends_query);

//We create the MESSAGES table using the following query
$create_messages_query = 
<<<_END
    CREATE TABLE IF NOT EXISTS MESSAGES
    (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sender VARCHAR(32), 
    receiver VARCHAR(32),  
    content TEXT, 
    private BOOLEAN,
    INDEX(sender(6)),
    INDEX(receiver(6)));
_END;
execute_query($create_messages_query);

?>