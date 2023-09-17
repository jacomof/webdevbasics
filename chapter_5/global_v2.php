<?php
/*PHP script to demonstrate how to use global variables
inside functions. Just redeclare them with 
the keyword global inside of the function.*/

$MY_GLOBAL = 5;
place_holder();
other_place_holder();

function place_holder(){
    //Here, we declare the variable global to indicate that it is the same variable we declared outside of the function.
    global $MY_GLOBAL;
    echo "Global variable is: $MY_GLOBAL <br>";
    //We change the value of the global variable.
    $MY_GLOBAL++;
}

function other_place_holder(){
    //We access the variable of the global variable again to confirm it changed when executing the place_holder function, proving it's in fact
    //the same variable as the one declared in the beginning of the script! 
    global $MY_GLOBAL;
    echo "Global variable is now: $MY_GLOBAL <br>";
}