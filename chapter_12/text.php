<?php
/*PHP script used to demonstrate the basic use of the text subtype of the input element. This subtype allows the user to submit lines of text.
It has several properties, like the size in characters of the field (size), the maximum length that is allowed to be submitted
(maxlength), the pattern property to specify a regular expression that needs to be satisfied for the text to be submitted, etc.*/


echo <<<_END
<HTML><HEAD><TITLE>Text examples</TITLE>
    
_END;

//Here we just display the text that was submitted using the form.
if(isset($_POST['textbody'])){
    echo "Successfully submitted single line text!<br>";
    echo "Your input is: $_POST[textbody]";
    echo "<br><br>";
}

//We create a form with an text input subtype. We specify a maximum length of 24, a pattern to accept only ascii letters and a size of
//roughly 30 characters for the input field. 
echo <<<_END
<FORM file='text.php' method='post'>
Enter text in a single line <INPUT type='text' name='textbody' maxlength='24' pattern='[a-zA-Z]' size='30'">
<INPUT type='submit' value='Submit text'>
</FORM>

</HTML>
_END;


