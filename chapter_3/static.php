<?php
function counterf(){
    static $count = 1+2;
    echo $count;
    $count++;
}

counterf();
echo "<br>";
counterf();
$Hola = 5;
$hola = 2;
echo "<br>";
echo $Hola;
echo "<br>";
echo $hola;