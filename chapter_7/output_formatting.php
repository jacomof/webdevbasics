<?php

/*
 * Formatting:
 * 
 * A format is a way of specifying how a variable will be converted to text by php when displaying it inside a browser.
 * More generally, it's a way of specifying the set of characters that will be replaced by a variable's occurrence inside of a string
 * of characters. 
 * 
 * In php a format has the following structure:
 * %['p|0|][n]d|f|s|b...
 * - d|f|s|b... specify the type that should be used to interpret a variables' value: d for integers, f for fp numbers, s for strings, etc...
 * n the number of characters used to pad or justify the variable: positive numbers pad to the left of the variable, and negative numbers to
 * the right.
 * 'p, being p any character, is the character used for the padding (a blank space by default). The simple quote needs to preceed
 * the character, unless padding is performed with 0s.  
 */

echo "<pre>";

//-->Numeric formatting

$wallet = 5;

echo "-------Integer formatting------- \n";

echo "Vanilla integer:\n";
printf("Your wallet's balance is: [%d] \n\n", $wallet);

echo "Integer with padding:\n";
printf("Your wallet's balance is: [%5d] \n\n", $wallet);

echo "Integer with padding on the right side: \n";
printf("Your wallet's balance is: [%-5d] \n\n", $wallet);

echo "Integer with character padding:\n";
printf("Your wallet's balance is: [%'$5d] \n", $wallet);

echo "Integer with character padding on the right side:\n";
printf("Your wallet's balance is: [%'$-5d] \n", $wallet);

$account = 2000.1515151515;

echo "\n\n-------Floating point numbers formatting------- \n";
printf("Your account's balance is: [%f] \n", $account);

echo "Floating point numbers precision formatting \n";
printf("Your account's balance rounds to: [%.2f]\n\n", $account);

echo "Floating point numbers precision and padding \n";
printf("Your account's balance round to [%10.2f]\n", $account);

echo "\n\n-------Some other formats-------\n";
echo "Binary format: \n";
printf("Your wallet's balance in binary is: %b$\n", $wallet);
printf("Your account's balance in binary is: %b$\n\n", $account);

echo "Hexadecimal format: \n";
printf("Your wallet's balance in hexadecimal (lowercase) is: %x \n", $wallet);



echo "---------------String formatting----------- \n";

$name = "Mary Jhonson Smithsonian";

echo "Vanilla formatting:\n";
printf("The lady's name is: %s\n\n", $name);

echo "Setting string length (justifying): \n";
printf("The lady's name is: [%30s]\n", $name);
printf("The lady's name, with character padding, is: [%'#30s]\n\n", $name);

echo "Setting string cutoff length: \n";
printf("The lady's name is: [%.10s]\n", $name);
printf("The lady's name is: [%5.10s]\n\n", $name);

echo "--------------sprintf function------------\n";

echo "sprintf does the same as printf, but returns a string rather than printing the results in the web page.\n\n";

$message = sprintf("The lady's name is: %'~30.40s\n", $name);

echo $message;
