<?php
echo "<html><head><title></title></head>
<h1>Country selection</h1>";

if(isset($_GET['country'])){
    echo "I know you!<br>"; 
    if(sizeof($_GET['country'])>1){
        echo "You have multiple nationalities. In fact, you're from:<br><ul>";
        foreach($_GET['country'] as $ctr){
            echo "<li>$ctr </li>";
        }
        print "</ul><br><br>";
    }else{
        $ctr = $_GET['country'][0];
        echo "Your are from $ctr";
    }
    
}

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