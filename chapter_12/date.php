<?php
/*PHP script to showcase the use and processing of dates form input data.*/

echo "<html><head><title>Birthday</title></head>";
if(isset($_POST['date'])){
    //Here we use the DateTime class to construct a new representation of the submitted date (initially just a string containing the date information).
    $dt = new DateTime($_POST['date']);
    //Here we use the class to add a day to the date time object.
    $dt->add(DateInterval::createFromDateString("1 day"));
    //We then transform the DateTime again to a string (a process called formatting), so we can print it.
    printf("The date after the date you selected is: %s<br><br>",$dt->format("Y-m-d"));
}

//We create the form used to submit the date withe the <input type='date'> form input element. 
echo <<<_FORM

<form file='date.php' method='post'>
Enter your birthday: <input type='date' name='date' value='2023-05-22'> <br><br>
<input type='submit' value='Submit date'>
</form>
</html>
_FORM;