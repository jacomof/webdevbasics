<?php
echo "Testing logical operators: \n";
$question = 5 < 2;
if($question){
    echo "yesiyes!\n";
}else
    echo "no&no!\n";

echo "Testing decrement operators: \n";
$y=0;
if($y-- == 0) echo $y;