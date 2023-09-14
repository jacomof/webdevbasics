<?php
/*PHP script used to demonstrate the use of textarea inputs in HTML. textarea elements are form input elements used to input long texts 
into a website. They differentiate from other form input elment in that they are not a subtype of the input tag, but rather their own dedicated
element for text editing.

You can set, among other properties, their size in columns (cols) and rows (rows) of text, and the way they wrap the text that overflows its 
boundaries (wrap).
The possible values of wrap are:
off -> doesn't wrap the text when it overflows.
soft -> inserts breaking line as needed to avoid overflowing outside of the available, but doen't include those breaking lines when sending the
form to the server. 
*/

//Here we simply display the submitted information using the pre tag to preserve new lines and space sequences.
if(isset($_POST['textareabody'])){
    echo "Successfully submitted paragraph! <br>";
    printf("You submitted the following marvel of literature: <br> 
<pre>
$_POST[textareabody]
</pre>
    <br><br>");
}


//We create the form and include a text area with a width of 20 characters and a height of 30 lines.
//We also set the wrapping to off to allow elements to overflow the available space inside of the textarea.
echo <<<_END

<FORM file='textarea.php' method='post'>
Enter a complete paragraph, please <br>
<TEXTAREA name='textareabody' cols='20' rows='30' wrap='off'>
This is a dummy text. Feel free to delete it :).
</TEXTAREA><BR>
<INPUT type='submit' value='Submit story'> 

</FORM>

_END;

/*There is a bug in firefox preventing the input paragraph to be output correctly through the echo function.
 * It doesn't insert new lines when sending the PHP form with the wrap attribute of the textarea element set to 'hard',
 * which is the expected behavior.
 */