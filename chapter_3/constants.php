<?php
/*PHP script to demonstrate how to use constants. This are named values that will remain constant during the execution of the script.*/

echo "<pre>";

//We specify a constant with the define directive, which takes two arguments: the name of the constant (usually in MACRO_CASE).
define("MAX_HEALTH", 100);
echo strlen(substr(MAX_HEALTH, 0,50));
echo "\n";

//There are also system constants that are defined by PHP automatically.

//__FILE__ is the name of the file being executed.
echo __FILE__ . "\n";
//__DIR__ is the directory of the file being executed.
echo __DIR__ . "\n";
//__LINE__ is the current line of the file being executed.
echo "Line " . __LINE__ . " of file: " . __DIR__;

echo "</pre>";
?>