<?php
/*PHP code showcasing the use of the static modifier inside of a function.
When applied to a local variable in a function, it has the effect of conserving its value in between calls.*/

//Arbitrary function that implements a counter starting from the value three
function counterf(){
    //Static declaration are only executed once: the first time the function is called. In later calls the declaration is ignored.
    static $count = 1+2;
    echo "$count<br>";
    $count++;
}

counterf();
//After this line, you can see that the variable count preserves its value in between calls.
counterf();

//More calls just for testing purposes.
counterf();
counterf();
counterf();