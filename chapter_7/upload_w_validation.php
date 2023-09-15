<?php
/*PHP document to demonstrate the validation and proceesing of an input form with file data.*/ 

echo <<<_END
    <html><head><title>PHP Form Upload with validation</title></head>
    <body>
        <form method='post' action='upload_w_validation.php' enctype='multipart/form-data'>
        Select a file (jpeg, gif, tif or png)<input type='file' name='filename' size='10'>
        <input type='submit' value='upload'>
        </form>
_END;

//The file superglobal variable has the information and data of all uploaded files. The first dimension of this array is the name of the file.
//The second dimension are their properties.
if($_FILES){

    //Files are uploaded into a temporal directory in the webserver whose name is accessible using the tmp_name element of the file.
    $tmp_nm = $_FILES['filename']['tmp_name'];
    echo "tmp_name is: $tmp_nm";
    
    //File type validation
    switch($_FILES['filename']['type']){
        case 'image/jpeg': $ext='jpeg'; break;
        case 'image/gif': $ext='gif'; break;
        case 'image/tif': $ext='tif'; break;
        case 'image/png': $ext='png'; break;
        default: $ext=''; break;
    }

    if($ext){
        //We retrieve the file's name.
        $name = $_FILES['filename']['name'];
        //We move the uploaded file to the current working directory (the directory where this script is contained, with the name in $name)
        move_uploaded_file($_FILES['filename']['tmp_name'], $name);
        echo "<br>Uploaded image, $name: <img src='$name'>";
    }else echo "Wrong file type uploaded!<br>";
}

echo "</body></html>";