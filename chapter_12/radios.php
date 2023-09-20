<?php
/*PHP script used to demonstrate the use of radio inputs in HTML forms.
This display several radio buttons of which the user can only select one for the same name.*/

echo "<head><title>Radio buttons</title></head> 
<h1>Fruit selection</h1>";


//Input processing and validation. Here we just check whether the user has submitted any values. 
if(isset($_GET['fruit'])){
    echo "You have made a choice. <br>";
    //Then we just trivially repeat the selected choice for him.
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

//Here we create the input form.
//To create a radio button we use the type 'radio' in an <input> element.
//We then specify a the same name for all radio buttons so if we choose any of them,
//the previously selected button gets deselected. 
echo <<<_HTML
<form file='radios.php' method='get'>
Apples<input type='radio' name='fruit' value='apple'> 
Pineapples<input type='radio' name='fruit' value='pineapple'>
Pears<input type='radio' name='fruit' value='pear'> 
<br> <br>
<input type='submit' value='Submit fruit of choice'>
</form></html>
_HTML;
