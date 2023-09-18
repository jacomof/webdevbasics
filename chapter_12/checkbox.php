<?php
/*PHP script to showcase how to process checkbox form inputs in PHP.
*/


echo <<<_END

<HTML><HEAD><TITLE>Checkboxes</TITLE></HEAD>
<BODY>

_END;

//Here we check wether any of the checkbox has been submitted, and print a specific message based on the combination of inputted values. 
if(isset($_POST['dog']) && isset($_POST['cat']))
    echo "You're a true animal lover!<BR><BR>";

else if(isset($_POST['dog']))
    echo "You're a doggy person!<BR><BR>";
    
else if(isset($_POST['cat']))
    echo "You're a cat's person!<BR><BR>";
    

//We create the input form used to submit the checkboxes. We create three input elements, each one with its own name, so they'll have their
//own dedicated index in the _POST superglobal.
echo <<<_END
<FORM file='checkbox.php' method='post'>
Dogs<INPUT type='checkbox' name='dog' checked='checked'>
Cats<INPUT type='checkbox' name='cat'>
<BR>
<INPUT type='submit' value='Submit decision'>
</FORM>
</BODY>
</HTML>
_END;