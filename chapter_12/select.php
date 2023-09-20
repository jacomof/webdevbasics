<?php
/*PHP script to demonstrate how to use the select tag inside of an HTML input form.
It generates a drop down menu within the form which we can use to select one or more values from the displayed
list before submitting the form.*/

echo "<html><head><title></title></head>
<h1>Country selection</h1>";

//Input validation and processing of the selection.
if(isset($_GET['country'])){
    echo "I know you!<br>"; 
    //The country jey contains an array since is declared in the form with brackets.
    //We can test its size with the sizeof operator so we can determine if the user has multiple nationalities.
    if(sizeof($_GET['country'])>1){
        echo "You have multiple nationalities. In fact, you're from:<br><ul>";
        //We print each submitted nationality in a list.
        foreach($_GET['country'] as $ctr){
            echo "<li>$ctr </li>";
        }
        print "</ul><br><br>";
    }else{
        //We print the only nationality
        $ctr = $_GET['country'][0];
        echo "Your are from $ctr";
    }
    
}

//Here we create the input form used to submit the selection input type.
//We use brackets in the name of the selection variable so multiple values can be submitted.
//The select input element can contain multiple option element, specifying each of the possible values we can select in the 
//drop down menu it generates.
//To submit multiple values we also have to indicate the multiple property, which will allow the user to select multiple options
//by holding down the control or the shift key.
//We can also specify a default selection.
echo <<<DOC

<form file='select.php' method='get' name='country_form' id='country_form'></form>
<select name='country[]' form='country_form' multiple>
    <option value='USA'>USA</option>
    <option value='Canada'>Canada</option>
    <option value='Mexico'>Mexico</option>
</select>
<br><br>
<input type='submit' value='Submit your country of origin' form='country_form'>
</html>

DOC;