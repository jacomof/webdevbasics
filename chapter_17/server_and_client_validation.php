<?php
$display_form = true;
echo <<<_END
<html>
    <head><title>Client side validation</title>
    <style>
        .signup{
            border: 1px solid #999999;
            font: normal 14px helvetica;
            color: #444444;
        }
    </style>
    <script>
        function validateForm(form){
            fail=""
            fail+=validateForename(form.forename.value);
            fail+=validateSurname(form.surname.value);
            fail+=validateUsername(form.username.value);
            fail+=validatePassword(form.password.value);
            fail+=validateAge(form.age.value);
            fail+=validateEmail(form.email.value);
            if(fail=="") return true;
            else {alert(fail); return false;}
        }
    </script>
    </head>
    <body>
_END;

if(isset($_POST['forename']) 
&& isset($_POST['surname']) 
&& isset($_POST['username']) 
&& isset($_POST['age'])
&& isset($_POST['email'])){

    $validation_result = validate_forename(fix_input($_POST['forename']))
    . validate_surname(fix_input($_POST['surname']))
    . validate_username(fix_input($_POST['username']))
    . validate_password(fix_input($_POST['password']))
    . validate_age(fix_input($_POST['age']))
    . validate_email(fix_input($_POST['email']));

    if(strlen($validation_result) == 0){
        $display_form = false;
        echo <<<_END
            <p>Validation process <b>successful</b>! <br></p>
        _END;
    }else
        echo <<<_END
        <pre>
        $validation_result
        </pre>
        _END;

}

if($display_form)
    echo <<<_END
    <script src="scripts/validation.js"></script>
        <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eee">
            <th colspan="2" align="center">Signup form</th>
            <form method="post" file="server_side_validation.php" onsubmit="return validateForm(this)">
                <tr><td>Forename</td><td><input type="text" maxlength="32" name="forename"></td></tr>
                <tr><td>Surname</td><td><input type="text" maxlength="32" name="surname"></td></tr>
                <tr><td>Username</td><td><input type="text" maxlength="16" name="username"></td></tr>
                <tr><td>Password</td><td><input type="text" maxlength="64" name="password"></td></tr>
                <tr><td>Age</td><td><input type="number" max="200" min="-5" name="age"></td></tr>
                <tr><td>Email</td><td><input type="text" maxlength="64" name="email"></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" value="Signup"></td></tr>
            </form>
        </table>
    _END;

echo <<<_END
    </body>
</html>
_END;

function fix_input($field){
    return htmlentities($field);
}

function validate_forename($forename){
    if(!strlen($forename)){
        return "No forename was entered!\n";
    }return "";
}

function validate_surname($surname){
    if(!strlen($surname)){
        return "No surname was entered!\n";
    }return "";
}

function validate_username($username){
    if(!strlen($username))
        return "No username was entered!\n";
    if(strlen($username) < 5)
        return "Username entered is too short!\n";
    if(preg_match("/[^\w\d]/", $username))
        return "Username contains incorrect characters!\n";
    return "";
}

function validate_password($pwd){
    if(!strlen($pwd))
        return "No password was entered!\n";
    $ret_msg = "";
    if(strlen($pwd) < 5)
        $ret_msg .= "The password entered is too short!\n";
    if(!(preg_match("/[A-Z]/", $pwd) && preg_match("/[a-z]/", $pwd) && preg_match("/\d/", $pwd)))
        $ret_msg .= "The password must contain at least a lower case letter, an upper case letter and a number!\n";    
    return $ret_msg;
}

function validate_age($age){
    if(!strlen($age))
        return "No age was entered!\n";
    if(!is_numeric($age))
        return "Non-numeric input entered inside of the age field!\n";
    if($age < 0 || $age > 120)
        return "Entered age is not inside the correct range!\n";
    return "";
    
}

function validate_email($email){
    if(!strlen($email))
        return "No email was entered!\n";
    if(!strpos($email, ".")){
        return ". character missing or incorrectly placed at the beginning of the email!\n";
    }
    if(!strpos($email, "@")){
        return "@ character missing or incorrectly placed at the beginning of the email!\n";
    }
    if(preg_match("/[^\w\d\.@]/", $email))
        return "Invalid character used inside the email. Accepted characters are: letters, digits, dots(.) and at signs (@).\n";
}
?>





