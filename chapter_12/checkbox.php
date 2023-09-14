<?php

echo <<<_END

<HTML><HEAD><TITLE>Checkboxes</TITLE></HEAD>
<BODY>

_END;

if(isset($_POST['dog']) && isset($_POST['cat']))
    echo "You're a true animal lover!<BR><BR>";

else if(isset($_POST['dog']))
    echo "You're a doggy person!<BR><BR>";
    
else if(isset($_POST['cat']))
    echo "You're a cat's person!<BR><BR>";
    


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