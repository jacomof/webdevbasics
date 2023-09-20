<?php
//PHP script to demonstrate the use of the placeholder property of some form input types.
//This property contains a text that is displayed as a placeholder when no input has been specfied yet in the element.
//The text is displayed in a different color to distinguish it from normal input.

echo <<<_END
<HTML><HEAD><TITLE>Text examples</TITLE>
    
_END;

//Minimal input processing to repeat the submitted input to the user.
if(isset($_POST['textbody'])){
    echo "Successfully submitted single line text!<br>";
    echo "Your input is: $_POST[textbody]";
    echo "<br><br>";
}


//Here we construct the form, which, until modified, will display "Enter input here" in the text input field.
echo <<<_END

<FORM file='text.php' method='post'>
Enter text in a single line <INPUT type='text' name='textbody' maxlength='24' placeholder='Enter input here'>
<INPUT type='submit' value='Submit text'>
</FORM>

</HTML>
_END;


