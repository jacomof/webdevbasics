<?php

$random_array = array(1,2,3,4,5);
echo "Processing array: " . implode(", ",$random_array) . "<br>";
$val = sum_array($random_array);
echo "The sum of the array elements is: " . $val . "<br>";
echo "First element of the array is now: " . $random_array[0];


function sum_array(&$arr){
    $sum = 0;
    for($i = 0; $i < sizeof($arr); $i++)     
        $sum += $arr[$i];
    
    $arr[0] = -1;    
    return $sum;
}