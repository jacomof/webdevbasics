<?php

/*PHP script used to display the members of the site. In this page users can select other users in order to view their 
profile and also browse a list of all the users of the site. This list of users allows them to follow and stop following
users, and also shows the user the friend status of each of the users in the list. Each user can be a follower of, be followed by
or be mutual friends with another user (meaning both of them follow each other).*/

require_once "header.php";

//We declare the variable used to hold errors.
$error="";

echo "<div class='main'>";

//If usser isn't logged in, the program aborts as they are not supposed to view this information.
if(!$loggedin)
    die();

//Input validation and execution of a user's drop request (to stop following another user).
if(isset($_GET['drop'])){

    $drop_target =  sanitize_string($_GET['drop']);
    //Query to delete the target user from the group of users followed by the logged in user. 
    execute_query("DELETE FROM FRIENDS WHERE username='$user' AND friend='$drop_target'");

}

if(isset($_GET['add'])){

    $add_target =  sanitize_string($_GET['add']);

    //Query to add the target user to the group of users followed by the logged in user.
    execute_query("INSERT INTO FRIENDS(username, friend) VALUES('$user', '$add_target')");

}

//We execute a SQL query to obtain for each user in the DB their following and follower status in relation to the current logged in user.
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

$user_following_result_array = $user_following_result->fetch_all(MYSQLI_ASSOC);

//List used to hold the friend status of each user of the site in relation to the current logged in user
$users_status = [];

echo "<div class='error'>$error</div>"; 

//If a user is selected, we show their profile and their friend status in relation to the current logged in user
if(isset($_GET['view'])){
    
    $selected_user = sanitize_string($_GET['view']);
    

    //Here we initilize the users status in relation to the current logged in user ($user_status, passed by reference) and 
    //get the user status of the selected user.
    //The function doesn't include the selected user in $user_status since the function returns this information information.
    $selected_user_friend_status = initialize_members_list($user_following_result_array, $users_status, $selected_user);

    $profile_user = $selected_user === $user ? "Your" : $selected_user . "'s";

    echo "<h3>$profile_user Profile</h3>";

    show_profile($selected_user);

    if($profile_user !== "Your"){

        //We also add a link to the selected user's messages in the form of a member button.
        echo <<<_END
            <div id='members-selected-users-button-container'>
                <a class='header-button' href='messages.php?view=$selected_user'>$selected_user's messages</a>
                <a class='header-button' href='friends.php?view=$selected_user'>$selected_user's friends</a>
            </div>
            _END;
        

        //And links to add or drop the user as a friend.
        switch($selected_user_friend_status){
            
            case 3:
                echo "$selected_user and you are mutual friends<a class='header-button list-button' href='members.php?drop=$selected_user&view=$selected_user&view=$selected_user'>Drop</a>";
                break;

            case 2:
                echo "You're following $selected_user<a class='header-button list-button' href='members.php?drop=$selected_user&view=$selected_user'>Drop</a>";
                break;

            case 1:
                echo "$selected_user follows you<a class='header-button list-button' href='members.php?add=$selected_user&view=$selected_user'>Reciprocate</a>";
                break;

            default:
                //Here we apply element specific style directly to override the classes margins. 
                //We use element specific styles because it's only one rule and it applies only to this element.
                echo "<a class='header-button list-button' style='margin-left: 0;' href='members.php?add=$selected_user&view=$selected_user'>Follow</a>";
                break;

        };
    }

}else
    //Here we also initialize the list of users' status, but with no user selected 
    initialize_members_list($user_following_result_array, $users_status);


//Finally, we display a list of the rest of the users (excluding the selected user and the currently logged in user)
//using the user status list and HTML list elements.
echo "<h3>Other Members</h3><ul>";

foreach($users_status as $row_user){

    $mname = stripslashes($row_user[0]);
    $mstatus = $row_user[1];

    echo "<li class='members-list'><a href='members.php?view=$mname'>$mname</a>";

    switch($mstatus){
        
        case 3:
            echo "&harr; $mname and you are mutual friends.<a class='header-button list-button' href='members.php?drop=$mname&view=$selected_user'>Drop</a></li>";
            break;

        case 2:
            echo "&rarr; You're following $mname.<a class='header-button list-button' href='members.php?drop=$mname&view=$selected_user'>Drop</a></li>";
            break;

        case 1:
            echo "&larr; $mname follows you.<a class='header-button list-button' href='members.php?add=$mname&view=$selected_user'>Reciprocate</a></li>";
            break;
        
        default:
            echo "<a class='header-button list-button' href='members.php?add=$mname&view=$selected_user'>Follow</a></li>";
            break;

    };
    
}
?>
</ul>
</div>
</body>
</html>