<?php
echo "<html><head><title>Checkbox only last</title></head>";

if(isset($_POST['animal'])){
    echo("You chose the animal: $_POST[animal] <br><br>");
}

echo <<<_END
<form method='post' file='checkbox_only_last.php'>
Dog <input name='animal' type='checkbox' value='dog'> <br>
Cat <input name='animal' type='checkbox' value='cat'> <br>
Bunny <input name='animal' type='checkbox' value='bunny'> <br>
<input type='submit' value='Submit decision'>
</form></html>
_END;

#Since all inputs have the same names, if multiple checkboxes are selected
#only the value at the input selected closes to the end of the html document is send 