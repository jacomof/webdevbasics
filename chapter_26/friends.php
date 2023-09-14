<?php
/*PHP script to display the complete list of users of platespace that are followers, being followed by and
mutual friends of the currently logged in user.
It does so by displaying three lists: one for the user's followers, a second for the users being followed by the logged in user
and a third for the users that are both followed by and followers of the current user.*/


require_once "header.php";

//If user is not logged in we abort the program.
if(!$loggedin)
    die();

//We get the user whose friend the user wants to see.
if(isset($_GET['view'])){
    $selected_user = sanitize_string($_GET['view']);
    $person_have = "$selected_user has";
    $person_possession = "$selected_user's";
    $person_is = "$selected_user is";
}
else{
    //In case it's not set we default to the currently logged in user
    $person_have = "You have";
    $selected_user = $user;
    $person_possession = "Your";
    $person_is = "You're";
}


//First we get an array with the users' friend status in relation to the currently logged in user and we store it in a local variable.    
$users_status = [];
initialize_members_list(get_users_friend_status($selected_user), $users_status);


//Then we separate the users in the three different classifications.
$followers = [];
$following = [];
$mutual = [];

foreach($users_status as $status){


    //As mentioned in previous sections of the website, each element of the array returned by get_users_friend_status contains two elements:
    //username (index=0) and friends status (index=1). 
    $user_name = stripslashes($status[0]);
    $user_status = $status[1];

    switch($user_status){
        
        case 3:
            //In case the current user in the loop and the selected user are mutual friends
            //(by definition, a mutual friends is a user that follows you, and that is followed by you). This is different in the book,
            //but I like this implementation better since it's more consistent and allows adding links to follow users with no followers. 
            $mutual[] = $user_name;
            $following[] = $user_name;
            $followers[] = $user_name;
            break;

        case 2:
            $following[] = $user_name;
            break;

        case 1:
            $followers[] = $user_name;
            break;

        default:
            break;

    };

}

//Then we start displaying the mentioned lists.

//We search for users who have the is_follower flag to true, but is_following flag to false. 
//This means they follow the current user, but the current user doesn't follow them so they're not mutual friends.
echo "<div class=main> <div class='header'>$person_possession followers</div> <ul class='friends-list'>";

if(sizeof($followers))
    foreach($followers as $fwr)
        echo "<li class='members-list'><a href='members.php?view=$fwr'>$fwr</a></li>";

else
    if($selected_user === $user)
        echo "You have no followers. Make yourself known by <a href='profile.php'>improving your profile</a> or <a href='members.php'> making new friends</a>.";
    else
        echo "$selected_user user has no followers. Make him feel like home and <a href='members.php?view=$selected_user&add=$selected_user'>give him a follow</a>.";

echo "</ul>";


//We search for users who have the is_follower flag to false, but is_following flag to true
//This means the current user follows them, but they do not follow the current user so they're not mutual friends.
echo "<div class='header'>$person_is following</div> <ul class='friends-list'>";

if(sizeof($following))
    foreach($following as $fwg)
        echo "<li class='members-list'><a href='members.php?view=$fwg'>$fwg</a></li>";
else 
    if($selected_user === $user)
        echo "You're not following anyone. Visit the <a href='members.php'>members page</a> and start looking for new friends!";
    else
        echo "$selected_user is no following anyone.";

echo "</ul>";

//Finally we search for users who have both flag true in the array.
//This means the current user follows them and they follow the current user, so they're mutual friends.
echo "<div class='header'>$person_possession mutual friends</div> <ul class='friends-list'>";

if(sizeof($mutual))
    foreach($mutual as $mtl)
        echo "<li class='members-list'><a href='members.php?view=$mtl'>$mtl</a></li>";
else
    echo "$person_have no mutual friends.";

?>

</ul>
</div>
</body>
</html>