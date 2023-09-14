<?php
/*Script to demonstrate file handling in PHP*/

//The fopen() function opens a file with a certain access mode. Options are: 'r' (read), 'w' (write), 'r+' (read and write, place file pointer
// at the beggining of the file, return FALSE if it the file doesn't exist) 
//,'w+' (read and write, truncate file to zero length and place the file pointer at the beginning, attempt to create if it doesn't
//exist), 'a' (append, writing only, file pointer at the end of the file) & 'a+' (append, read and writing, place file pointer at 
//the end of the file and create file if it doesn't exist)
//returns a file handle, which is a number that identifies the opened file.

echo "<pre>";

//Write to file, truncating contents. Can't read!
$fh = fopen('HelloWorld.txt', 'w');
fwrite($fh, "Hello world\n");
fwrite($fh, "read my soul\n");
fwrite($fh, "talk out loud\n");
fwrite($fh, "ending now!");

/*The following commented code throws an error, since we can't read the file (because of the w flag)!
$liner = fgets($fh);
echo "Line of file is: "+$liner;
*/
fclose($fh);


//Read file; fgets reads a line of the file or a given number
//of bytes. It fails if it doesn't exist.
$fh2 = fopen('HelloWorld.txt', 'r');
$liner2 = fgets($fh2);
/*This throws an error, since we can't write to the file (r flag)
fwrite($fh2, "Trying to write, failing miserably.");
 */
fclose($fh2);

echo "Line of file is: $liner2 \n";

//Read and write file, using plus sign (w+). Truncate if it exists.

$fh3 = fopen('HelloWorld.txt', 'w+');
fwrite($fh3, "Reading and writing away!\n");
//fseek places a file's file pointer to a given position, 
//specified by the second and third arguments.
//The 1st arg is the file handle
//The 2nd arg is the offset
//The 3rd file is the position mode. SEEK_END places the fp
//at the end of the file, while SEEK_CURR leaves it at the current position.
//SEEK_SET places it at the beginning of the file. The offset is 
//then added to these base locations to calculate the final fp.
fseek($fh3, 0, SEEK_SET);
$liner3 = fgets($fh3);
echo "New line of file is: $liner3 \n";
fclose($fh3);

//Append file, with the a flag. Only allows for writing
$fh4 = fopen('HelloWorld.txt', 'a');
fwrite($fh4, "Appending a line, with null disgrace.\n");
fclose($fh4);

//Append file, witht the a flag. Plus sign allows for
//reading and writing
$fh5 = fopen('HelloWorld.txt', 'a+');
fwrite($fh5, "Appending yet another line to the pile.\n");

//Loop through the entire file
fseek($fh5, 0, SEEK_SET);
$liner4 = fgets($fh5);
while($liner4){
    
    echo "$liner4";
    $liner4 = fgets($fh5);
}
fclose($fh5);

//file_get_contents reads the entire contents of a file all at once
//(no file handle needed) Does the sames as the previous loop.

$cont = file_get_contents('HelloWorld.txt'); 
echo "$cont";

//flock blocks a file so that only one php program can write to
//it at the same time (they must also implement the lock for
//it to work)
$fh6 = fopen('HelloWorld.txt', 'w+');
flock($fh6, LOCK_EX);
fwrite($fh6, "Writing in an exclusive manner!");
flock($fh6, LOCK_UN);
fclose($fh6);

?>