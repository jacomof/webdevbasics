<?php

echo "<html><head><title>Number Input</title></head>";

if(isset($_POST['number']))
    echo "Your number is: $_POST[number] <br><br>";

echo <<<_DOC

<form file='number_and_range.php' method='post'>
Enter a number: <input type='number' name='number' max='100' min='0' placeholder='22'> <br><br>
<input type='submit' value='Submit number'>
</form>
</html>

_DOC;
    