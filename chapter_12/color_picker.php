<?php
echo "<html><head><title>Color picker</title></head><body>";

if(isset($_POST['color'])){
    echo "You selected the color $_POST[color] <br><br>";
}

echo <<<_END

<form file='color_picker.php' method='post'>
<div title="Chose the widget to pick a color">
<label for="colorpicker">Pick a color</label>
<input type='color' name='color' value='#729f99' id='colorpicker'>
</div>
<br><br>
<input type='submit' value='Upload color'>
</form>
</body>
</html>
_END;