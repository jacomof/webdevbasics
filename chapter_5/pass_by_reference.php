<?php
/*PHP script to show how to pass a variable by reference.
In PHP we can pass arguments to functions in two ways: by value, or by reference.
When passing and object by value, we simply specify the variable name and PHP will create a copy of this variable,
so if we change the value of the argument the original variable will remain untouched.
When passing variables by reference, PHP doesn't make a copy of the value of the variable. Rather, it passes a reference to the variable
so when the arguments changes within the function, the variable also changes. To pass a variable by reference use the ampersand (&) symbol
before the variable's name.*/


$random_array = array(1,2,3,4,5);
echo "Processing array: " . implode(", ",$random_array) . "<br>";


//Here we pass arr by value, so it doesn't get modified after the function has executed.
$val = sum_array($random_array);
echo "The sum of the array elements is: " . $val . "<br>";
echo "First element of the array is now: " . $random_array[0] . "<br>";


//Here we pass arr by reference, so it gets modified in the end of the function.
$val = sum_array_ref($random_array);
echo "The sum of the array elements is: " . $val . "<br>";
echo "First element of the array is now: " . $random_array[0];


function sum_array($arr){
    $sum = 0;
    for($i = 0; $i < sizeof($arr); $i++)     
        $sum += $arr[$i];
    
    $arr[0] = -1;    
    return $sum;
}


function sum_array_ref(&$arr){
    $sum = 0;
    for($i = 0; $i < sizeof($arr); $i++)     
        $sum += $arr[$i];
    
    $arr[0] = -1;    
    return $sum;
}