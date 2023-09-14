<?php
/*PHP program to demonstrate the most basic example of a file upload to the website. It uploads an image and moves it to the current directory
with the name assigned by the user on its local machine.*/

echo <<<_END
    <HTML><HEAD><TITLE>PHP Form Upload </TITLE></HEAD><BODY>
    <FORM method='post' action='form.php' enctype='multipart/form-data'>
    Select file: <INPUT type='file' name='filename' size='10'>
    <INPUT type='submit' value='Upload'>
    </FORM>
_END;

if($_FILES){
    //We retrieve the name.
    $name= $_FILES['filename']['name'];
    //The move_uploaded_file is used to move an uploaded file from its temporal diretory (by default all files are placed in temporal directories 
    //when uploaded in PHP web servers). It takes two arguments: the first is the directory of the temp file (which is contained in the tmp_name
    //element of the $_FILES superglobal array), and the second is the destination path (in this case, the current working directory plus the
    //name in $name).
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    echo "Uploaded image, $name: <BR><IMG src='$name'>";
}

echo "</BODY></HTML";