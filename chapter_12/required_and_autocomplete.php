<?php

echo <<<_END
<HTML><HEAD><TITLE>Text examples</TITLE>
    
_END;

if(isset($_POST['textbody'])){
    echo "Successfully submitted single line text!<br>";
    echo "Your input is: $_POST[textbody]";
    echo "<br><br>";
}

echo <<<_END

<FORM file='text.php' method='post'>
Enter text in a single line <INPUT type='text' name='textbody' maxlength='24' placeholder='Enter input here' required autocomplete>
<INPUT type='submit' value='Submit text'>
</FORM>

</HTML>
_END;


