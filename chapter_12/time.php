<?php

/*HTML document to demonstrate the use of text to represent the time set on an alarm. No functionality actually implemented, just
a visual representation.*/

echo <<<_END
<html>
<head><title>Joaq's Alarm</title></head>
<body>    
_END;

if(isset($_POST['time'])){
    //We sanitize the string for security.
    $in_time = sanitize_input($_POST['time']);
    echo "You set the alarm at: $in_time
    <br><br>";
}

//We create the form used to submit the initial time of the alarm clock.
echo <<<_END
<form file='time.php' method='post'>
<label> Enter a time to set your alarm: <input type='text' name='time' required autofocus></label><br><br>
<input type='submit' value='send'>
</form>

_END;

//Function used for sanitation.
function sanitize_input($input){
    $input=stripslashes($input);
    $input=htmlentities($input, ENT_IGNORE | ENT_HTML5);
    $input=strip_tags($input);
    return $input;
}