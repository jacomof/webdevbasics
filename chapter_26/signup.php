<?php

/*PHP file to sign up to platespace. It has a form where users can enter their log in details, which are then submitted, validated
and inserted inside of the USERS table. It also uses an AJAX call to check if the user already exists in the database, just 
like the book suggested, and alerts and prevents the user from signing up if they do.

The structure of the page is different than the rest, which is a work around to be able to use php to redirect to the login page
once a user has been successfully created. As you can see, the require once header is only included after the input validation,
because the redirection is done with HTTP headers and they need to be sent before the page generates any output.*/

require_once "functions.php";

$posted_user = $pwd = $error = "";

session_start();


//First we check wether the user is already logged in, in which case we prevent him to create new users as we want to promote
//a one account -> one user policy. This is not a hard restriction mechanism, just a soft annoyance to prevent malicious behavior.
if(isset($_SESSION['username'])){

    //In case he's already logged in, we print the header and die explaining the situation to the user.
    require_once "header.php";

    die("<div class='main'><h3>Logged in as $user. Cannot create new accounts if you are already logged in. 
    Log out to create new accounts.</h3></div>");

}else{

    //If the user is not logged in, we check if it has posted any user name or password to sign up.
    if(isset($_POST['username'])){

        //As always, we sanitize the input for security
        $posted_user = sanitize_string($_POST['username']);
        $pwd = sanitize_string($_POST['password']);

        //Now we validate!

        //If the user posted a user with no password, we print an error in the form
        if(!isset($_POST['password']))
            $error = "Can't sign up a user with no password!";
        //We do the same if the user tryes entering an excessively large username
        elseif(strlen($posted_user) > 32)
            $error = "Username too long!";
        elseif(strlen($posted_user) == 0){
            $error = "Username empty!";
        }
        //Or if the password is too short!
        elseif(strlen($pwd) < 6)
            $error = "Password too short!";
        else
        {
            //We check if the user exists, in which case we print an error in the form too. 
            if(check_user_existance($posted_user))
                $error = "User already exists!";

            else{

                //We generate a salted hash of the password to store it securely.
                $pwd = hash("sha256", $pwd . $user_salt);

                //We generate and execute the user creation query, which inserts the username and salted hash in the USERS database.
                $insert_user_query = "INSERT INTO USERS (username, password) VALUES('$posted_user', '$pwd')";
                execute_query($insert_user_query);

                //Finally, we redirect to the login page, using the header "Location", which causes the browser to redirect to the page 
                //specified in the header's value. Aditionally, with the header function we can replace the response code with one of our choosing 
                //(in this case we use the code 301 which indicates a permanent redirect, rather than a temporary one (code 302) which is 
                //the defualt value for this header)
                header('Location: login.php', true, 301);
                //Is always recommended to terminate the script after a redirection, in case the user agent doesn't support (or simply ignores)
                //redirection mechanism and prevent a possibly dangerous escenario in which we assume the page won't print the rest of its output
                //(and hence, we don't implement security mechanisms to the output). A very clare example of this is when we use redirects to
                //prevent users from viewing and interacting with the web administration page. A hacker can just use a custom browser or user
                //other type of tools that avoids redirections and have a free pass to all of the website's admin features!
                die();
                
            }
        }

    }

    require_once "header.php";

    echo <<<_END
    <div class='main'><h3>Please enter a username (only alphanumerical characters allowed, and a maximum of 32 characters) 
    and a password of a minimum of 6 characters. </h3></div>

    <!--Simple form to input a username and password. The form is send when we click the submit button to the current file.
    We also use lables for accessibility and to give a visual name to the fields. 
    Additionally, we use a simple javascript code snippet on the onsubmit event to prevent form submission if username entered
    is not availabel-->
    <form enctype="application/x-www-form-urlencoded" action="signup.php" method="post" class="main"
    onsubmit="if(used_username) {event.preventDefault(); alert('Username not available!')}">
    <div class='error'>$error</div>
    <lable for="username-input" class="fieldname">Username:</lable>
    <!--It's good practice to implement input validation in the form, so users are aware of mistakes before even trying to submit.
    In this case we validate that the username is less than 33 characters long and that it only has alphanumerical characters or
    underscores.-->
    <input  type="text" size="32" placeholder="username" pattern="[a-zA-Z0-9_]+" title="Should contain only alphanumerical characters" 
    name="username" id="username-input" onBlur="checkUserExistance(this.value)" onKeyDown="changeUsernameInputColor()" value="$posted_user">
    <br>
    <lable for="password-input" class="fieldname">Password:</lable>
    <input name="password" type="password" minlength="6" size="32">
    <br>
    <input class="submit-button" type="submit" value="Submit">
    </form>

    _END;
}
?>