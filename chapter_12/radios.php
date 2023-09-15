<?php
echo "<head><title>Radio buttons</title></head> 
<h1>Fruit selection</h1>";

if(isset($_GET['fruit'])){
    echo "You have made a choice. <br>";
    if($_GET['fruit'] == 'apple'){
        echo "You like apples :)!";
        print "<br>";
            
    }else if($_GET['fruit'] == 'pineapple'){
        echo "You like pineapples :)!";
        print "<br>";
        
    }else if($_GET['fruit'] == 'pear'){
        echo "You like pears :)!";
        print "<br>";
        
    }
    else
        echo "Incorrect input value! <br>";
    echo "<br>";
}
echo <<<_HTML
<form file='radios.php' method='get'>
Apples<input type='radio' name='fruit' value='apple'> 
Pineapples<input type='radio' name='fruit' value='pineapple'>
Pears<input type='radio' name='fruit' value='pear'> 
<br> <br>
<input type='submit' value='Submit fruit of choice'>
</form></html>
_HTML;
