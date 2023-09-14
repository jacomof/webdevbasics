<?php
$MY_GLOBAL = 5;
place_holder();
other_place_holder();

function place_holder(){
    global $MY_GLOBAL;
    echo "Global variable is: $MY_GLOBAL <br>";
    $MY_GLOBAL++;
}

function other_place_holder(){
    global $MY_GLOBAL;
    echo "Global variable is now: $MY_GLOBAL <br>";
}