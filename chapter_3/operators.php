<?php
//PHP script to test different logical and arithmetic operators.

echo "Testing logical operators: \n";
//Less than operator, returns true if the first operand is smaller than the second operand. Else it returns false.
$question = 5 < 2;
if($question){
    echo "yesiyes!\n";
}else
    echo "no&no!\n";

//There are also increment and decrement operators, which are short forms of expressions like
//$var = $var - 1; ($var--)
//&
//$var = $var + 1; ($var++)
echo "Testing decrement operators: \n";
$y=0;
if($y-- == 0) echo $y;