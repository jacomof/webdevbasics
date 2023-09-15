<?php

/*Infinite loop causes page to freaze, as expected, since
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