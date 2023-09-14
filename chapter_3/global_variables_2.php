<?php

global $perrito;
$perrito=6;

function perro(){
    
    global $perrito;
    echo "perrito en función: $perrito <br>";
    $perrito=5;
    
}

perro();
echo "perrito fuera de función: $perrito <br>";
$tipo = gettype("hola esto es un numero: " . 54);
echo "tipo es: $tipo";

