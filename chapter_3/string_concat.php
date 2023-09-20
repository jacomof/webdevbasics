<?php
/*PHP script to demonstrate how to concatenate strings in php.
We do so with the concatenation operator (.) which appends the second operand to the first and returns the results.*/

$bulletin="News go here! Write something reporter.\n";
$newsflash="Breaking!! Plato is pretty!!!";
$bulletin.=$newsflash;
echo $bulletin;