<?php
/*PHP script used to demonstrate the use of the number input type.
This type is used to submit numbers, so we can specify ranges for the input values so that only values
within does numeric ranges will be submitted. Additionally, the input element will only allow the user
to write numbers as inputs.*/


echo "<html><head><title>Number Input</title></head>";

//We just process the input so we repeat the submitted input to the user.
if(isset($_POST['number']))
    echo "Your number is: $_POST[number] <br><br>";

//Here we create the input form used to submit the number input type.
//To specify the ranges, we use the max and min properties of the element
//(min being the minimum value that can be submitted, and max being the maximum value that can be submitted).
echo <<<_DOC

<form file='number_and_range.php' method='post'>
Enter a number: <input type='number' name='number' max='100' min='0' placeholder='22'> <br><br>
<input type='submit' value='Submit number'>
</form>
</html>

_DOC;
    