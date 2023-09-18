<?php
/*PHP script used to showcase how to process a checkbox input type in HTML using PHP.
In this case, we don't use an input array, so only one option may be submitted at the same time.*/

echo "<html><head><title>Checkbox only last</title></head>";

//We check if the the checkbox has been submitted.
if(isset($_POST['animal'])){
    //We print the value of the checkbox.
    echo("You chose the animal: $_POST[animal] <br><br>");
}

#Since all inputs have the same names, if multiple checkboxes are selected
#only the value at the input selected closes to the end of the html document is send 
echo <<<_END
<form method='post' file='checkbox_only_last.php'>
<!--We specify a normal input name so the browser submits a single value.-->
Dog <input name='animal' type='checkbox' value='dog'> <br>
Cat <input name='animal' type='checkbox' value='cat'> <br>
Bunny <input name='animal' type='checkbox' value='bunny'> <br>
<input type='submit' value='Submit decision'>
</form></html>
_END;

