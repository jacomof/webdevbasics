<?php
//PHP script used to demonstrate how to skip characters in a string in PHP.
//Skipping a character means to tell the interpreter to interpret a certain character sequence with in a string literally, 
//since certain sequences have special meaning.
//For example, if we want to include a quotation character (') within a string declared with simple quotations, we have to scape like this:
//'hello, his name is \'Pedro\'.'
//Additionally, we can also scape normal characters to give them special meaning, like the tab and "new line" characters: \t and \n respectively.

$count = 5%3;
echo "The remainder of 5 divided by 3 is $count <br>";
echo "\t";
//We can also scape variable included within a string, so its value is not replaced.
echo 'The remainder of 5 divided by 3 is not $count \n';
echo "<br> Now the variable won't show correctly \$count";
//No need to skip the dollar sign if it appers at the end of the string, or followed by a space character.
echo "Trying to print dollar sing: $";