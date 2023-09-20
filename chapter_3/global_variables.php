<?php
/*PHP script to demonstrate how to use global variables.
In PHP, all variables declared outside of a function are considered global.
Inside of a function, they can be accessed by using a "global" declaration:
global $[name variable].*/

//perrito is global since it's declared outside of a any function.
$perrito;
$perrito=6;

//Inside of the function perro, we can access "perrito" by prepending it with the global keyword before accessing its value.
function perro(){
    
    global $perrito;
    echo "perrito inside of perro funtion: $perrito <br>";
    echo "perro function modifies its value to 5 <br>";
    $perrito=5;
    
}

perro();
echo "perrito after the perro function: $perrito <br>";

