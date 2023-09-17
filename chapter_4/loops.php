<?php
/*PHP script describing the syntax of the while, for loops and do... while loops wihtin PHP.
While loops are loops that are executed while a certain condition remains true.
We declare them with the "while" keywoard, followed by a boolean expression in parenthesis
and brackets containing the body of the function, which are the statements that are executed on each itiration
of the loop.

Do... While loops are similar to while loops but the condition gets evaluated at the end of each iteration.
This means that the first iteration always executes no matter the conditions.
The while keyword and conditions are written at the end of the loop, after the body.

For loops are similar, but they have two addional elements:
    -A first statement before the condition to declare variables will use as indexes of the iterations.
    -A third statement that indicates what happens to the indexes on each iteration (they may increment, decrement, multiply, etc.)    
*/


/*Infinite loop causes page to freeze, as expected, since
 * php process keeps looping and never returns the page
 */
/*
while(true){
    echo "hello";
    sleep(3);
}
*/
 
//Multiplication table of 12, naive method:
$count = 1;
echo "Multiplication table of 12 is: <br> \n";
while($count <= 12){
    echo "$count --> " . $count*12 . "<br> \n";
    $count++;
}

echo "<br>------------<br>";

//Again, but a little cleaner, using increment operator directly on expression
$count = 0;
echo "Multiplication table of 12 a second time is: <br> \n";

while(++$count <= 12){
    echo "$count --> " . $count*12 . "<br> \n";
}

echo "<br>------------<br>";

//Again, but with for loop
echo "Multiplication table of 12 a third time is: <br> \n";

for($count = 1; $count <= 12; $count++){
    echo "$count --> " . $count*12 . "<br> \n";
}

echo "<br>------------<br>";

//Again, but with do... while loop
$count = 1;
echo "Mutiplication table of 12 a fourth time is: <br> \n";

do 
    echo "$count --> " . $count*12 . "<br> \n";
while(++$count <= 12);

echo "<br>------------<br>";

//Multiplication table of 12, but stoping at 6 using break.
$count = 1;
echo "Mutiplication table of 12, but stopping at 6: <br> \n";

do{
    echo "$count --> " . $count*12 . "<br> \n";
    if($count>=6) break;
}while(++$count <= 12);

echo "<br>------------<br>";

//Multiplication table of 12, but skipping 8
$count = 1;
echo "Mutiplication table of 12, but skipping 8: <br> \n";

do{
    if($count==8) continue;
    echo "$count --> " . $count*12 . "<br> \n";
}while(++$count <= 12);

echo "<br>------------<br>";