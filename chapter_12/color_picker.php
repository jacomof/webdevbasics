<?php
/*PHP script to showcase how to use the color input type in HTML and how to process it in php.*/

echo "<html><head><title>Color picker</title></head><body>";

if(isset($_POST['color'])){
    //The value of the array will be a string representing the color submitted in hexadecimal notation.
    echo "You selected the color $_POST[color] <br><br>";
}

echo <<<_END

<form file='color_picker.php' method='post'>
<div title="Chose the widget to pick a color">
<!--Here we specify both the color input and a label so we can give it we can identify it visually.-->
<label for="colorpicker">Pick a color</label>
<input type='color' name='color' value='#729f99' id='colorpicker'>
</div>
<br><br>
<input type='submit' value='Upload color'>
</form>
</body>
</html>
_END;