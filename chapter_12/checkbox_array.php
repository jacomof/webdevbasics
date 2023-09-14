<?php
echo "<html><head><title>Checkbox array</title></head>";

if(isset($_POST['animals'])){
    $animal_string = implode(', ', $_POST['animals']);
    echo "You like the following animals: $animal_string <br><br>";
}

echo <<<_HTML

<form file='checkbox_array.php' method='post'>
Dogs <input type='checkbox' name='animals[]' value='Dogs'> <br>
Cats <input type='checkbox' name='animals[]' value='Cats'> <br>
Alligators <input type='checkbox' name='animals[]' value='Alligators'> <br>

<input type='submit' value'Submit your preferred animals!'>
</form></html>
_HTML;

#The order in which the checkboxes values are sent is the order they appear in the site.
#For instance, if you select Cats and Dogs, the output is Dogs, Cats.