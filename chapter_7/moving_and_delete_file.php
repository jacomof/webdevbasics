<?php

/*PHP script to demonstrate how to remove files using php.*/

//unlink removes the file with the filename/path passed as input parameter
if(unlink("HellowWorld.txt")) echo "file deleted <br>";

//is_dir checks wether a given file is a directory. Can also be used to check if directory exists
if(!is_dir("img/")) mkdir("img/");

//rename renames or moves a file. Output directory must exist for it to succeed.
rename("task_table_v3.png", "img/task_table_v3.png");