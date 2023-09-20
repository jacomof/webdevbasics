<?php
/*PHP script to showcase how to explicitly cast a variable to a specific type.
To do so, we use the syntax ([type])[expression] where type is a php type and [expression] is a php expression.*/

//Here we cast 5/2 from a floating point value to an int, by discarding the decimal part 
$divi = (int) (5/2);
$resi = 5%2;
echo "The quocient of 5 divided by 2 is: $divi \n <br>";
echo "The residue is $resi \n <br>";