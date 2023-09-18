<?php
/*PHP script used to showcase how to process a checkbox input type in HTML using PHP.
In this case, we use an input array, so we can submit multiple options with the same name at the same time.*/

echo "<html><head><title>Checkbox array</title></head>";

//We check wether the user has submitted any information.
if(isset($_POST['animals'])){
    //We then concatenate all values in the posted array using the implode function and print the results.
    $animal_string = implode(', ', $_POST['animals']);
    echo "You like the following animals: $animal_string <br><br>";
}

//We create the form to submit the checkbox array.
//The order in which the checkboxes values are sent is the order they appear in the site.
//For instance, if you select Cats and Dogs, the output is Dogs, Cats.
echo <<<_HTML

<form file='checkbox_array.php' method='post'>
<!--To create the array, we assign the same name to the inputs and add brackets at the end to signify the browser should send an
array of values.-->
Dogs <input type='checkbox' name='animals[]' value='Dogs'> <br>
Cats <input type='checkbox' name='animals[]' value='Cats'> <br>
Alligators <input type='checkbox' name='animals[]' value='Alligators'> <br>

<input type='submit' value'Submit your preferred animals!'>
</form></html>
_HTML;

