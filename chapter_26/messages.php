<?php
/*PHP file to display and send messages to a user. The application is unconventional in the sense that it displays the messages
of all users to the specified user at the same time, like a sort of group chat centered in them.
There are, however, two types of messages: public and private. Public messages to a user can be viewed by all, while
private messages can only be viewed by the sender and the receiver/specified user.*/

require_once "header.php";


if(!$loggedin)
    die();




if(isset($_GET['view'])){

    $selected_user = sanitize_string($_GET['view']);
    $person = "$selected_user's";

}else{

    $selected_user = $user;
    $person = "Your";

}

//Input validation of posted messages, to include them in the database
if(isset($_POST['message_content'])){

    $mcontent = sanitize_string($_POST['message_content']);
    
    //We eliminate trailing whitespaces.
    $mcontent = preg_replace('/[\s\t]+$/', '', $mcontent);

    if(strlen($mcontent)){


        $current_time = time();
        $sender = $user;
        $receiver = $selected_user;

        //If the message is public, or if no modality specified, we insert the message
        //with the "private" flag set to 0 (false).
        $private_flag = (!isset($_POST['message_modality']) || $_POST['message_modality'] === 'public') ? 0 : 1;
        
        execute_query("INSERT INTO MESSAGES(sender,receiver,content,private,sent_timestamp)
        VALUES('$sender', '$receiver', '$mcontent', $private_flag, $current_time)");

    }else
        $error = "Input message empty.";

}

//Input validation for erasing a message.
//We only delete the message if the erase post parameter is set and if the user coincides with the selected user's messages
//(that is, if the user is deleting its own messages).
if(isset($_GET['erase']) && ($user === $selected_user)){

    //echo "entered here";
    $erase_msg_id = sanitize_string($_GET['erase']);
    execute_query("DELETE FROM MESSAGES WHERE id = '$erase_msg_id'");

}

echo "<div class='main'><h3>$person messages</h3>";

show_profile($selected_user);

//We create an input form to submit messages.
echo <<<_END
    <form enctype="application/x-www-form-urlencoded" action="messages.php?view=$selected_user" method="post" class="profile-input">
        <!--In case an error ocurred during file or description submission, we report it here.-->
        <textarea cols='75' rows='4' name='message_content'></textarea>
        <div class='radio-button-panel'>
            <!--We display two radio buttons for the user to select if they want their sent message to be viewed by all or only the receiver.--> 
            <div class='radio-button-container'> 
                <input type='radio' id='public-radio' name='message_modality' value='public' checked> <label for='public-radio'>Public</lable>
            </div> 
            <div class='radio-button-container private'> 
                <input type='radio' id='private-radio' name='message_modality' value='private'> <label for='public-radio'>Private</lable>
            </div> 
            <div class='radio-button-container message-submit-button'>
                <input type='submit' value='Post Message'>
            </div>
        </div>
    </form>
    _END;


//In this section of the code we display the list of messages of the selected users, giving the option to delete them if the selected user
// is the same as the user logged in (that is, the user is viewing their own messages).

//We select all messages of the selected user.
$message_list = (execute_query("SELECT * FROM MESSAGES WHERE RECEIVER='$selected_user'"))->fetch_all(MYSQLI_ASSOC);

//Then we iterate on the obtained list using a foreach statement.
foreach($message_list as $msg){

    //We retrieve the date that was saved as a unix timestamp, and format it nicely as a string using the built in date function.
    $date_string = date("M jS 'y g:ia", $msg['sent_timestamp']);
    
    //We gather the rest of the parameters of the message from the current row.
    $sender = $msg['sender'];
    $content = $msg['content'];
    $receiver = $msg['receiver'];
    $msg_id = $msg['id'];

    echo "<div class='message'>";

    //If the message is private (private flag set to 1), then we only display it if the receiver or sender 
    //is equal to the currently logged in user. We also change its style to visually differentiate them from public messages.
    if($msg['private']){
        if(($receiver === $user) || ($sender === $user))
            echo "$date_string: $sender whispered: <span class='private'>\"$content\"</span>";
    
    //We display public messages to all user
    }else
        echo "$date_string: $sender wrote: \"$content\"";

    //Finally, we give the option to erase the message if the receiver is the currently logged in user (meaning a user can delete the
    //messages directed to him from his message board).
    if($receiver === $user)
        echo " [<a href='messages.php?erase=$msg_id'>erase</a>]";

    echo "</div>";
}

//Finally, we display a button to refresh the displayed messages (the button will just refresh the page to load new messages
//by reexecuting the php code).
echo "<form  action='messages.php?view=$selected_user'><input class='refresh-messages-button' type='submit' value='Refresh Messages'></form>";

?>

</div>
</body>
</html>