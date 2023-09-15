<?php

/*PHP file used to login a user to platespace.*/


require_once "header.php";

//The error variable is used to notify the user of any errors during the log in process
$user = $pwd = $error = "";

if($loggedin){
    //In case the user is already logged in, we prevent him from doing so again.
    die("<div class='main'><h3>You're already logged in as $user. Log out to log in with another account.</h3></div>");
}else{

    //If the user posted information to the page, we validate it to see if it matches with any registered user.
    if(isset($_POST['username'])){

        $user = sanitize_string($_POST['username']);
        $pwd = sanitize_string($_POST['password']);

        //In case no password was provided, we notify the user of this situation through the error variable.
        if(!isset($_POST['password']))
            $error = "You need to provide a password to log in!";
        else
        {

            //We salt and hash the provided password, which will allow us to compare it with the user's saved password.
            $pwd_hash = hash('sha256', $pwd . $user_salt);

            //We select the user in the USERS table whose username matches with the provided username.
            $verify_user_query = "SELECT password FROM USERS WHERE username = '$user'";

            $user_info = execute_query($verify_user_query);

            if($user_info->num_rows == 0)
                //In case no user has the provided username, we notify the user that the provided credentials are incorrect.
                $error = "Username or password incorrect!";
            else{
                
                $db_pwd = ($user_info->fetch_array(MYSQLI_ASSOC))['password'];

                $pwd = hash("sha256", $pwd . $user_salt);

                //We compare the provided password with the one selected from the database
                if($db_pwd === $pwd){

                    $_SESSION['username'] = $user;
                    header('Location: index.php', true, 301);
                    die("<div class='success main'> You have successfully logged in! </div>");

                }else
                    //In case the user exists, but the password doesn't match, we notify the user that the provided credentials are incorrect.
                    $error = "Username or password incorrect!"; 
                
            }
        }

    }
    //Finally, we print the input form for the user to enter their credentials.
    echo <<<_END
    <!--Same input form as in the signup page.-->
    <div class='main'><h3>Please enter your log in details. </h3></div>

    <form enctype="application/x-www-form-urlencoded" action="login.php" method="post" class="main">
    <div class='error'>$error</div>
    <lable for="username-input" class="fieldname">Username:</lable>
    <input  type="text" size="32" placeholder="username" pattern="[a-zA-Z0-9_]+" title="Should contain only alphanumerical characters" 
    name="username" id="username-input">
    <br>
    <lable for="password-input" class="fieldname">Password:</lable>
    <!--The only difference is that we don't provide a minimum size to the password field to prevent giving any hints to a possible attacker.-->
    <input name="password" type="password" size="32">
    <br>
    <input class="submit-button" type="submit" value="Submit">
    </form>

    _END;
}
?>