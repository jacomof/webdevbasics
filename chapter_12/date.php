<?php
echo "<html><head><title>Birthday</title></head>";
if(isset($_POST['date'])){
    $dt = new DateTime($_POST['date']);
    $dt->add(DateInterval::createFromDateString("1 day"));
    printf("The date after the date you selected is: %s<br><br>",$dt->format("Y-m-d"));
}

echo <<<_FORM

<form file='date.php' method='post'>
Enter your birthday: <input type='date' name='date' value='2023-05-22'> <br><br>
<input type='submit' value='Submit date'>
</form>
</html>
_FORM;