<?php

/*PHP document that implements php functions and routines that are used all throughout the website
, including basic features like database access functions and credentials, and string sanitation and cleaning functions for security 
and aesthetic reasons.
It will be included in all php files of the website implementing the final chapter/exercise of the book for convenience
and to follow the "don't repeat yourself" principle.*/


/*-------Basic website configuration snippet-------*/

/*Database connection parameters, necessary to create connection to the plateSpace's database*/
$db_user = 'testApp';
$db_pwd = 'phpApp';
$db_host = 'localhost';
$db_name = 'platespace_db';

//Name of the website
$appname = 'Platespace';

//Value used to salt the users' passwords.
$user_salt = "c749b0a85c5bba47cdfd10c15e917d3f";



/*------------------------------------------------*/


/*We use the connection parameters to create a connection to the database. This way we can interact with the website's database
through the created connection object.*/
$db_conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);

if(!$db_conn){
    die(mysqli_connect_error());
}
    

/*Executes a query in the mysql database referenced by the db_conn object. 
Script dies printing database error if query fails.*/
function execute_query($query_string){

    global $db_conn;
    //We execute the query
    $res = $db_conn->query($query_string);

    //We check wether or not it resulted in an error
    if(!$res)
        //If so, the script dies and prints error
        die($db_conn->error);
    
    return $res;

}

/*As we've done many times following this book's instructions, we sanitize string before using them anywhere on the website
for security and aesthetic reasons.*/
function sanitize_string($input_string){

    global $db_conn;

    //We eliminate any html tags, which can be used to inject malicous code in our website
    $input_string = strip_tags($input_string);

    //We substitute any possible HTML special characters to their respective HTML entities
    //so they render correctly.
    $input_string = htmlentities($input_string);

    //We eliminate any characters that may have been scaped during user input
    $input_string = stripslashes($input_string);
    
    //We scape special php characters (for example, when replacing a $variable with its value) so that
    //database quieries will be performed correctly
    $input_string = $db_conn->real_escape_string($input_string);
    
    return $input_string;

}


//Shows the profile of the user in $user, if exists, using a snippet of HTML code
function show_profile($user){


    //We add a container to style the profile as a block
    echo "<div class='profile-container clearfix'>";

    //Users images are stored in the images folder. We check if the entered user has saved an image in their profile.  
    if(file_exists("./images/$user.jpeg")){

        //In case they do we add it to the html snippet using the img tag, and we move it to the left of whatever text comes next using the float
        //property.
        echo "<img src='./images/$user.jpeg' style='float: left;' class='profile-picture'>";

    }

    //We search in the database for a user with the name in $user
    $user_info = execute_query("SELECT description FROM USERS WHERE username='$user'");
    
    //In case there is one, we output its 'about me' text

    if(($user_info->num_rows) > 0)
    {
        $user_array = $user_info->fetch_array(MYSQLI_ASSOC);
        $prof_text = $user_array['description'];
        echo stripslashes($prof_text); 
    }else{

        die("<div class='error'>User doesn't exist</div>");

    }

    echo "</div>";

}

//Function to destroy a user's session when they logout

function destroy_session(){

    //First we destroy all data in the _SESSION array
    $_SESSION = Array();

    //Then, if we used cookies to manage our session (default behavior), we clear the session's cookie
    if(session_id() != '' || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2000, '/');

    //Finally, we wipe all the data from the session stored in the server by using session_destroy()  
    session_destroy();
    
}


//Function to check for the existance of a user in the databse.
function check_user_existance($curr_user){

    $find_user_query = "SELECT username FROM USERS WHERE username = '$curr_user'";

    $user_found = execute_query($find_user_query);

    if($user_found->num_rows>0)
        return true;
    
    return false;
    
}

//Function to encapsulate in a single funtion the load function of different image types.
function load_image($path, $type){

    $image = null;

    if($type == 'jpg' || $type == 'jpeg')
        $image = imagecreatefromjpeg($path);

    elseif($type == 'png')
        $image = imagecreatefrompng($path);

    elseif($type == 'bmp')
        $image = imagecreatefrombmp($path);

    return $image;

}


//Auxiliary function to initialize a list of users and their following/follower/"mutual friends" status
//from a mysqli result set ($input_list), a string corresponding to the current user ($user) and a second string corresponding
//to the user whose profile is being viewed ($selected_user, optional).
//Returns the $selected_user's status (represented a number) and leaves the list of users' status in $users_status.
function initialize_members_list(array $input_list, array &$users_status, $selected_user=false){

    $selected_user_status = 0; 

    //Each row of the result set has three columns, the users' username, 
    //a flag indicating whether they follow the current logged in user (is_follower) 
    //and a flag indicating whether the current user follows them (is_following).
    foreach($input_list as $row){

        /*We assign an integer to each of the possible states:
            -The user of the current row and the logged in user are mutual friends: 3
            -The logged in user follows the user of the current row: 2
            -The user of the current row follows the logged in user: 1
            -None of the above: 0
        */

        $row_user_status = 0;

        if($row['is_follower'] && $row['is_following'])
            $row_user_status =  3;
        
        elseif($row['is_following'])
            $row_user_status =  2;

        elseif($row['is_follower'])
            $row_user_status =  1;

        if($selected_user === $row['username'])
            $selected_user_status = $row_user_status;
        else
            $users_status[] = array($row['username'], $row_user_status);
    }

    return $selected_user_status;

}

//Unused. Probably should delete.
function map_user_friend_status(int $status){

    switch($status){
        case 3:
            return 'mutual friend';
            break;

        case 2:
            return 'following you';
            break;

        case 1:
            return 'follower';
            break;

        default:
            return '';
    }

}


//Function used to obtain for each user in the DB their friend status in relation 
//to the user passed as a function parameter ($user).
function get_users_friend_status($user){

    //The query joins the followers of and the users being followed by the selected user, and joins them with
    //the complete list of users to detect whether they are followers and/or being followed by the selected user. 
    $user_following_result = 
    execute_query(
    <<<_END
        WITH FOLLOWERS 
        AS(
        
            SELECT username AS follower
            FROM FRIENDS
            WHERE friend = '$user'
        
        ), 
        FOLLOWING AS
        (
            SELECT friend AS following
            FROM FRIENDS
            WHERE username = '$user'
        
        )
        
        SELECT u.username, fr.follower IS NOT NULL AS is_follower, fg.following IS NOT NULL AS is_following
        FROM USERS u
        LEFT JOIN
        FOLLOWERS fr
        ON u.username = fr.follower
        LEFT JOIN 
        FOLLOWING fg 
        ON u.username = fg.following
        WHERE u.username <> '$user';
    _END);

    //We return a numeric array containing one row for each user in the database (execluding the user passed to the function)
    return $user_following_result->fetch_all(MYSQLI_ASSOC);
}



?>
