<?php
//Test program to try out the exec function in php.
//exec executes a system command and leaves the result in the second argument passed to it.
//It also returns the last line executed.


printf("Result of execution is: %s <br><br>", exec('ls $HOME', $output));

$count = 0;

foreach($output as $line){
    
    echo "$count - $line <br>";
    $count++;

    
}