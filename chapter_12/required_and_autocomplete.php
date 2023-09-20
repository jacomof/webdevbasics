<?php
/*PHP script used to demonstrated the required and autocomple properties of HTML Forms' different input elements.*/


echo <<<_END
<HTML><HEAD><TITLE>Text examples</TITLE>
    
_END;

//Input validation and processing.
//We just test wether the user submitted anything, but we should do input validation here.
if(isset($_POST['textbody'])){
    echo "Successfully submitted single line text!<br>";
    echo "Your input is: $_POST[textbody]";
    echo "<br><br>";
}

//We create the input form with an text input, and specify both the required and autocomplete properties.
//autocomplete indicates that the browser should remember previous values submitted by the user in the form.
//required means that the browser should not let the user to submit the form unless they have specified a value for the field.
echo <<<_END

<FORM file='text.php' method='post'>
Enter text in a single line <INPUT type='text' name='textbody' maxlength='24' placeholder='Enter input here' required autocomplete>
<INPUT type='submit' value='Submit text'>
</FORM>

</HTML>
_END;


