<?php
/*Example of the use of the print function. Its the function version of the echo function, and writes a line in the document send to the 
requesting client by the web server.*/

//Just a trivial operation that returns true or false.
$b = 5>2;
$b ? print 'VERO' : print 'FALSO';


//$b ? echo 'heelo' : echo "hello"; This line is wrong,
//can't use echo as a function since it has no return value!
